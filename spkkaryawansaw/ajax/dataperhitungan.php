<?php
require_once "../include/functions.php";
$periode    = $_POST['periode'];
$tahun      = $_POST['tahun'];
$divisi     = $_POST['divisi'];
$tanda      = isset($_POST['tanda']) ? $_POST['tanda'] : 0;
$nilaiFinal = [];
$absensiKaryawan = [];
$temp = [];
// Cari data nilai dengan divisi yang sudah dipilih
// Jika ada data yang kosong maka keluarkan



$karyawan = ambilData("SELECT karyawan.* FROM karyawan LEFT JOIN hasil_penilaian USING(id_karyawan) LEFT JOIN sub_kriteria USING(id_sub_kriteria) 
WHERE hasil_penilaian.tahun = '{$tahun}' AND hasil_penilaian.periode = {$periode} AND karyawan.divisi = '{$divisi}' GROUP BY id_karyawan");


// $absensiKaryawan = [
//     "id_karyawan" => "asd",
//     "total_masuk" => "??",
//     "bobot" => "??"

// ];

if (!$tanda) :
    $bobotAbsensi = ambilData("SELECT presentase FROM kriteria WHERE nama_kriteria = 'Absensi'")[0]['presentase'];

    $dataKriteria = ambilData("SELECT * FROM kriteria WHERE id_kriteria != 3");
    if (count($karyawan)) :
        $cekData = 0;
        foreach ($karyawan as $k) :
            $jumlahAbsensi = ambilData("SELECT SUM(hadir) AS jumlah FROM absensi WHERE nip = '{$k['nip']}' AND periode = {$periode} AND tahun = '{$tahun}'");

            $bobot = 0;
            if (count($jumlahAbsensi)) {
                if ($jumlahAbsensi[0]['jumlah'] < 24) {
                    $bobot = 1;
                } else if ($jumlahAbsensi[0]['jumlah'] >= 24 && $jumlahAbsensi[0]['jumlah'] <= 48) {
                    $bobot = 2;
                } else if ($jumlahAbsensi[0]['jumlah'] > 48) {
                    $bobot = 3;
                }
            }

            $absensiKaryawan[$k['id_karyawan']] = [
                "jumlah" => $jumlahAbsensi[0]['jumlah'],
                "bobot" => $bobot
            ];


            foreach ($dataKriteria as $d) :
                //cek apakah sudah ada data nya di nilai
                //jika sudah edit jika belum tambah
                $cekNilai = ambilData("SELECT hasil_penilaian.id_nilai,hasil_penilaian.id_sub_kriteria FROM karyawan LEFT JOIN hasil_penilaian USING(id_karyawan) LEFT JOIN sub_kriteria USING(id_sub_kriteria) 
                                WHERE hasil_penilaian.tahun = '{$tahun}' AND hasil_penilaian.periode = {$periode} AND sub_kriteria.id_kriteria = {$d['id_kriteria']} 
                                AND hasil_penilaian.id_karyawan = {$k['id_karyawan']}");
                if (!count($cekNilai)) :
                    $cekData += 1;
                endif;
            endforeach;
        endforeach;


        if (!$cekData) :
?>
            <h3 class="text-center">Table Nilai</h3>
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>

                    <tr>
                        <th class="text-center">NIP</th>
                        <th class="text-center">Nama Karyawan</th>
                        <?php foreach ($dataKriteria as $d) : ?>
                            <th class="text-center"><?= $d['nama_kriteria'] . "(" . $d['jenis'] . ")" ?></th>
                        <?php endforeach; ?>
                        <th class="text-center">Absensi</th>
                    </tr>
                </thead>


                <?php foreach ($karyawan as $k) : ?>
                    <tr>
                        <td class="text-center"><?= $k["nama"] ?></td>
                        <td class="text-center"><?= $k["divisi"] ?></td>
                        <?php foreach ($dataKriteria as $d) :
                            //cek apakah sudah ada data nya di nilai
                            //jika sudah edit jika belum tambah
                            $cekNilai = ambilData("SELECT hasil_penilaian.id_nilai,hasil_penilaian.id_sub_kriteria,sub_kriteria.nama_sub_kriteria FROM karyawan LEFT JOIN hasil_penilaian USING(id_karyawan) LEFT JOIN sub_kriteria USING(id_sub_kriteria) 
                                        WHERE hasil_penilaian.tahun = '{$tahun}' AND hasil_penilaian.periode = {$periode} AND sub_kriteria.id_kriteria = {$d['id_kriteria']} 
                                        AND hasil_penilaian.id_karyawan = {$k['id_karyawan']}");

                            $cekNilai = $cekNilai[0];
                        ?>
                            <td class="text-center">
                                <?= $cekNilai['nama_sub_kriteria'] ?>
                            </td>
                        <?php endforeach; ?>
                        <td class="text-center"><?= $absensiKaryawan[$k['id_karyawan']]['jumlah'] ?></td>
                    </tr>
                <?php endforeach; ?>

            </table>

        <?php else : ?>
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Ada Nilai Karyawan Yang Masih Kosong!</h4>
                <p>Silahkan lengkapi data karyawan terlebih dahulu. <a href="index.php?page=nilai">Lenkgapi</a></p>
            </div>
            <?php die; ?>
        <?php endif; ?>
    <?php else : ?>
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Data nilai karyawan masih kosong!</h4>
            <p>Silahkan isi data nilai karyawan terlebih dahulu.</p>
        </div>
        <?php die; ?>
    <?php endif; ?>



    <!-- table kovenrsi nilai -->
    <h3 class="text-center">Table Konversi</h3>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>

            <tr>
                <th class="text-center">NIP</th>
                <th class="text-center">Nama Karyawan</th>
                <?php foreach ($dataKriteria as $d) : ?>
                    <th class="text-center"><?= $d['nama_kriteria'] . "(" . $d['jenis'] . ")" ?></th>
                <?php endforeach; ?>
                <th class="text-center">Absensi</th>
            </tr>
        </thead>


        <?php foreach ($karyawan as $k) :
            $nilaiFinal[] = [
                "id_karyawan" => $k['id_karyawan'],
                "total" => 0
            ];
        ?>
            <tr>
                <td class="text-center"><?= $k["nama"] ?></td>
                <td class="text-center"><?= $k["divisi"] ?></td>
                <?php foreach ($dataKriteria as $d) :
                    $cekNilai = ambilData("SELECT hasil_penilaian.id_nilai,hasil_penilaian.id_sub_kriteria,sub_kriteria.bobot,sub_kriteria.id_kriteria FROM karyawan LEFT JOIN hasil_penilaian USING(id_karyawan) LEFT JOIN sub_kriteria USING(id_sub_kriteria) 
                                        WHERE hasil_penilaian.tahun = '{$tahun}' AND hasil_penilaian.periode = {$periode} AND sub_kriteria.id_kriteria = {$d['id_kriteria']} 
                                        AND hasil_penilaian.id_karyawan = {$k['id_karyawan']}");

                    $cekNilai = $cekNilai[0];
                    $temp[$cekNilai['id_kriteria']][$k['id_karyawan']] = $cekNilai['bobot'];
                ?>
                    <td class="text-center">
                        <?= $cekNilai['bobot'] ?>
                    </td>
                <?php endforeach; ?>
                <td class="text-center"><?= $absensiKaryawan[$k['id_karyawan']]['bobot'] ?></td>
            </tr>
        <?php endforeach; ?>

    </table>

    <?php

    ?>
    <!-- table kovenrsi normalisasi -->

    <h3 class="text-center">Table Normalisasi</h3>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>

            <tr>
                <th class="text-center">NIP</th>
                <th class="text-center">Nama Karyawan</th>
                <?php foreach ($dataKriteria as $d) : ?>
                    <th class="text-center"><?= $d['nama_kriteria'] . "(" . $d['jenis'] . ")" ?></th>
                <?php endforeach; ?>
                <th class="text-center">Absensi</th>
            </tr>
        </thead>


        <?php
        $i = 0;
        foreach ($karyawan as $k) : ?>
            <tr>
                <td class="text-center"><?= $k["nama"] ?></td>
                <td class="text-center"><?= $k["divisi"] ?></td>
                <?php foreach ($dataKriteria as $d) :

                    $nilaiKaryawan = $temp[$d['id_kriteria']][$k['id_karyawan']];
                    if ($d['jenis'] == "Cost") {
                        // masukan rumus cost
                        $nilaiTerkecil = min($temp[$d['id_kriteria']]);
                        $nilai = $nilaiTerkecil / $nilaiKaryawan;
                    } else {
                        // masukan nilai absensi
                        $nilaiTerbesar = max($temp[$d['id_kriteria']]);
                        $nilai =  $nilaiKaryawan / $nilaiTerbesar;
                    }

                    $nilaiFinal[$i]["total"] +=  $nilai * $d['presentase'];

                ?>
                    <td class="text-center">
                        <?= $nilai ?>
                    </td>
                <?php endforeach; ?>
                <?php
                $nilaiAbsensi = $absensiKaryawan[$k['id_karyawan']]['bobot'];
                $tempAbsensi = [];
                // Cari Nilai Absensi Terbesar
                foreach ($absensiKaryawan as $a) {
                    $tempAbsensi[] = $a['bobot'];
                }
                $nilaiAbsensiTerbesar = max($tempAbsensi);
                $nilaiAbsensi = $nilaiAbsensi / $nilaiAbsensiTerbesar;
                $nilaiFinal[$i]["total"] += $nilaiAbsensi * $bobotAbsensi;
                ?>
                <td class="text-center"><?= $nilaiAbsensi ?></td>
            </tr>
        <?php
            $i++;
        endforeach;
        ?>

    </table>

    <?php


    // cek dulu apakah sudah ada di data hasil atau belum
    // jika ada cek apakah data nilai sekarang sama dengan data nilai yang ada di database

    $cekHasil = ambilData("SELECT id_hasil FROM hasil WHERE periode = {$periode} AND tahun = '{$tahun}'");

    if (!count($cekHasil) || (count($nilaiFinal) !== count($cekHasil))) {

        if (!count($cekHasil)) {
            mysqli_query($koneksi, "DELETE FROM hasil WHERE periode = {$periode} AND tahun = '{$tahun}'");
        }
        // sorting nilai
        $size = count($nilaiFinal) - 1;
        for ($i = 0; $i < $size; $i++) {
            for ($j = 0; $j < $size - $i; $j++) {
                $k = $j + 1;
                $jumlah1 = $nilaiFinal[$k]['total'];
                $jumlah2 = $nilaiFinal[$j]['total'];
                if ($jumlah1 > $jumlah2) {
                    list($nilaiFinal[$j], $nilaiFinal[$k]) = array($nilaiFinal[$k], $nilaiFinal[$j]);
                }
            }
        }

        $i = 0;
        $last = count($nilaiFinal);
        $query = "INSERT INTO hasil VALUES";
        foreach ($nilaiFinal as $n) {
            if (++$i == $last) {
                $query .= "('',{$i},{$n['id_karyawan']},NOW(),{$periode},'{$tahun}',{$n['total']})";
            } else {
                $query .= "('',{$i},{$n['id_karyawan']},NOW(),{$periode},'{$tahun}',{$n['total']}),";
            }
        }

        mysqli_query($koneksi, $query);
    }
    ?>

    <h3 class="text-center">Hasil Akhir</h3>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th class="text-center">NIP</th>
                <th class="text-center">Nama Karyawan</th>
                <th class="text-center">JK</th>
                <th class="text-center">Nilai</th>
                <th class="text-center">Urutan</th>
            </tr>
        </thead>

        <?php
        $query = "SELECT hasil.nilai,hasil.urutan,karyawan.nama,karyawan.nip,karyawan.jk FROM hasil INNER JOIN karyawan USING(id_karyawan) 
    WHERE hasil.periode = {$periode} AND hasil.tahun = '{$tahun}' ORDER BY hasil.urutan ASC";

        $resultSpk = ambilData($query);
        foreach ($resultSpk as $s) :
        ?>
            <tr>
                <td class="text-center"><?= $s['nip'] ?></td>
                <td class="text-center"><?= $s['nama'] ?></td>
                <td class="text-center"><?= $s['jk'] ?></td>
                <td class="text-center"><?= $s['nilai'] ?></td>
                <td class="text-center"><?= $s['urutan'] ?></td>
            </tr>

        <?php endforeach; ?>
    </table>

<?php else : ?>
    <a class="btn btn-warning" href="cetak/cetakterbaik.php?divisi=<?= $divisi ?>&periode=<?= $periode ?>&tahun=<?= $tahun ?>" target="_blank">
        <i class="fa fa-print"></i>
    </a>
    <h3 class="text-center">Penilaian Karyawan Terbaik</h3>
    <table id="tablespk" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th class="text-center">NIP</th>
                <th class="text-center">Nama Karyawan</th>
                <th class="text-center">JK</th>
                <th class="text-center">Urutan</th>
            </tr>
        </thead>

        <?php
        $query = "SELECT hasil.urutan,karyawan.nama,karyawan.nip,karyawan.jk FROM hasil INNER JOIN karyawan USING(id_karyawan) 
    WHERE hasil.periode = {$periode} AND hasil.tahun = '{$tahun}' AND karyawan.divisi = '{$divisi}' ORDER BY hasil.urutan ASC";
        $resultSpk = ambilData($query);
        foreach ($resultSpk as $s) :
        ?>
            <tr>
                <td class="text-center"><?= $s['nip'] ?></td>
                <td class="text-center"><?= $s['nama'] ?></td>
                <td class="text-center"><?= $s['jk'] ?></td>
                <td class="text-center"><?= $s['urutan'] ?></td>
            </tr>

        <?php endforeach; ?>
    </table>
<?php endif; ?>