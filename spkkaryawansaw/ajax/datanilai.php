<?php
require_once "../include/functions.php";
$tahun      = $_POST['tahun'];
$periode    = $_POST['periode'];
$jabatan     = $_POST['jabatan'];
$karyawan = ambilData("SELECT karyawan.* FROM karyawan LEFT JOIN hasil_penilaian USING(id_karyawan) LEFT JOIN sub_kriteria USING(id_sub_kriteria) 
WHERE hasil_penilaian.tahun = '{$tahun}' AND hasil_penilaian.periode = {$periode} AND karyawan.jabatan = '{$jabatan}' GROUP BY id_karyawan");



$dataKriteria = ambilData("SELECT * FROM kriteria WHERE id_kriteria != 3");
if (count($karyawan)) :
?>

    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th class="text-center">NIP</th>
                <th class="text-center">Nama Karyawan</th>
                <?php foreach ($dataKriteria as $d) : ?>
                    <th class="text-center"><?= $d['nama_kriteria'] . "(" . $d['jenis'] . ")" ?></th>
                <?php endforeach; ?>

            </tr>
        </thead>


        <?php foreach ($karyawan as $k) : ?>
            <tr>
                <td class="text-center"><?= $k["nama"] ?></td>
                <td class="text-center"><?= $k["divisi"] ?></td>
                <?php foreach ($dataKriteria as $d) :
                    //cek apakah sudah ada data nya di nilai
                    //jika sudah edit jika belum tambah
                    $cekNilai = ambilData("SELECT hasil_penilaian.id_nilai,hasil_penilaian.id_sub_kriteria FROM karyawan LEFT JOIN hasil_penilaian USING(id_karyawan) LEFT JOIN sub_kriteria USING(id_sub_kriteria) 
                                        WHERE hasil_penilaian.tahun = '{$tahun}' AND hasil_penilaian.periode = {$periode} AND sub_kriteria.id_kriteria = {$d['id_kriteria']} 
                                        AND hasil_penilaian.id_karyawan = {$k['id_karyawan']}");
                    if (count($cekNilai)) :
                        $cekNilai = $cekNilai[0];
                ?>
                        <td class="text-center">
                            <select name="subE[<?= $cekNilai['id_nilai'] ?>][]" class="form-control">
                                <?php
                                $dataSub = ambilData("SELECT nama_sub_kriteria,id_sub_kriteria FROM sub_kriteria WHERE id_kriteria = {$d['id_kriteria']}");
                                foreach ($dataSub as $s) :
                                ?>
                                    <option value="<?= $s['id_sub_kriteria'] ?>" <?= $cekNilai['id_sub_kriteria'] == $s['id_sub_kriteria'] ? 'selected' : '' ?>><?= $s['nama_sub_kriteria'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    <?php else : ?>
                        <td class="text-center">
                            <select name="sub[<?= $k['id_karyawan'] ?>][]" class="form-control" required>
                                <option value="" selected>- Pilih Nilai -</option>
                                <?php
                                $dataSub = ambilData("SELECT nama_sub_kriteria,id_sub_kriteria FROM sub_kriteria WHERE id_kriteria = {$d['id_kriteria']}");
                                foreach ($dataSub as $s) :
                                ?>
                                    <option value="<?= $s['id_sub_kriteria'] ?>"><?= $s['nama_sub_kriteria'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    <?php endif; ?>



                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>

    </table>
    <input type="hidden" name="periode" value="<?= $periode ?>">
    <input type="hidden" name="tahun" value="<?= $tahun ?>">
    <input type="hidden" name="jabatan" value="<?= $jabatan ?>">
    <button name="submit" type="submit" class="btn btn-danger mb-4 btn-block">Perbarui Data Nilai</button>
<?php else : ?>
    <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Tidak ada data!</h4>
        <p>Silahkan tambah data terlebih dahulu.</p>

    </div>
<?php endif; ?>