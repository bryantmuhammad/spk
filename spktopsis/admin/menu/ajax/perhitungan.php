<?php
require_once "../../include/function.php";
$kriteria = ambilData("SELECT * FROM kriteria");




$nilaisub   = [];
$produk     = [];
$bobot      = [];
$atribut    = [];


foreach ($kriteria as $k) {
    // $temp = [];
    $namakriteria    = makeId($k['nama']);
    $idsubkriteria   = $_POST[$namakriteria];
    if ($_POST[$namakriteria] == 0) {
        echo "
        <div class='alert alert-danger' role='alert'>
            <h4 class='alert-heading'>Mohon Isi Kriteria Dengan Benar!</h4>
        </div>";
        die;
    }
    $idkriteria     = $k['id_kriteria'];
    //Nilai sub kriteria tertinggi
    $nilaipalingtinggi = ambilData("SELECT MAX(bobot_sub) as tinggi FROM sub_kriteria WHERE id_kriteria = {$idkriteria}")[0]['tinggi'];



    //Nilai yang dipilih, Mendapatkan bobot sub tertinggi


    $nilaidicari    = ambilData("SELECT bobot_sub FROM sub_kriteria WHERE id_sub_kriteria = {$idsubkriteria}")[0]['bobot_sub'];


    $bobot[$namakriteria]            = (float) $k['bobot'];
    $atribut[$namakriteria]          = $k['atribut'];

    // $produk[$namakriteria] = [];

    // cari nilai sebenarnya berdasarkan pencarian 
    $subkriteria = ambilData("SELECT * FROM sub_kriteria WHERE id_kriteria = {$idkriteria}");

    foreach ($subkriteria as $sub) {

        if ($sub['id_sub_kriteria'] == $idsubkriteria) {
            $nilaisub[$namakriteria][$sub['id_sub_kriteria']] =  (int) $nilaipalingtinggi;
        } else {
            // cari selisih antara nilai yang dicari
            $selisih                            = abs((int) $nilaidicari - (int) $sub['bobot_sub']);
            $selisih                            = (int) $nilaipalingtinggi - $selisih;
            $nilaisub[$namakriteria][$sub['id_sub_kriteria']]  =  $selisih;
        }
    }
}




$pembagi = $produk;

$nilai = ambilData("SELECT produk.nama as namaproduk,nilai.id_sub_kriteria,kriteria.nama,produk.harga FROM nilai LEFT JOIN produk USING(id_produk) LEFT JOIN sub_kriteria USING(id_sub_kriteria) LEFT JOIN kriteria USING(id_kriteria)");


$daftarproduk = [];
foreach ($nilai as $n) {

    $namakriteria    = strtolower($n['nama']);
    $tempnilai      = $nilaisub[$namakriteria][$n['id_sub_kriteria']];
    $produk[$namakriteria][$n['namaproduk']] =  $tempnilai;

    $daftarproduk[] = $n['namaproduk'];
}


$produk1 = $produk;

$daftarproduk = array_unique($daftarproduk);
//mencari pembagi
// var_dump($produk);



foreach ($produk as $key => $value) {
    // $pembagi[$key]
    $temp = 0;
    foreach ($value as $namaproduk => $v) {
        $temp += pow($v, 2);
    }

    $temp = sqrt($temp);
    $pembagi[$key] = $temp;
}


// matriks yang ternomalisasi

foreach ($produk as $key => $val) {

    foreach ($val as $namaproduk => $nilai) {
        $produk[$key][$namaproduk] = $nilai / $pembagi[$key];
    }
}

$produk2 = $produk;


// matriks ternormalisasi terbobot

foreach ($produk as $key => $val) {

    foreach ($val as $namaproduk => $nilai) {
        $produk[$key][$namaproduk] = $nilai * $bobot[$key];
    }
}


$produk3 = $produk;

// var_dump($pembagi);

// matriks solusi ideal positif
$idealpositif = [];

foreach ($kriteria as $k) {
    $namakriteria = makeId($k['nama']);
    $jenisatribut = $atribut[$namakriteria];
    if ($jenisatribut == 'Benefit') {

        $idealpositif[$namakriteria] = max($produk[$namakriteria]);
    } else {
        $idealpositif[$namakriteria] = min($produk[$namakriteria]);
    }
}



// matriks solusi ideal negatif
$idealnegatif = [];

foreach ($kriteria as $k) {
    $namakriteria = makeId($k['nama']);
    $jenisatribut = $atribut[$namakriteria];
    if ($jenisatribut == 'Benefit') {
        $idealnegatif[$namakriteria] = min($produk[$namakriteria]);
    } else {
        $idealnegatif[$namakriteria] = max($produk[$namakriteria]);
    }
}


// =================================================================================================================

//Jarak setiap nilai
$jarak = [];




foreach ($daftarproduk as $d) {
    //cari produk

    $temp = 0;

    foreach ($idealpositif as $key => $val) {

        // $produk[$key][$d]
        $nilai = $produk[$key][$d];
        $temp += pow(($val - $nilai), 2);
    }


    $jarak[$d] = sqrt($temp);
}



$jaraknegatif = [];
foreach ($daftarproduk as $d) {
    //cari produk

    $temp = 0;

    foreach ($idealnegatif as $key => $val) {

        // $produk[$key][$d]
        $nilai = $produk[$key][$d];
        $temp += pow(($val - $nilai), 2);
    }


    $jaraknegatif[$d] = sqrt($temp);
}



$hasil = [];
foreach ($daftarproduk as $d) {
    //cari produk

    $tempPositif = $jarak[$d];
    $tempNegatif = $jaraknegatif[$d];

    $tt = $tempNegatif / ($tempNegatif + $tempPositif);


    $hasil[$d] = $tt;
}

// rsort($hasil);
arsort($hasil);
$rinci = isset($_POST['rinci']) ? 1 : 0;
?>


<?php if ($rinci == 1) : ?>
    <h4>Table Pembagi</h4>
    <table id="mytables" class="table table-bordered table-md">
        <thead>
            <tr>

                <?php foreach ($pembagi as $key => $k) :
                    $nama = revereseId($key);
                ?>
                    <th class="text-center"><?= $nama ?></th>
                <?php endforeach; ?>

            </tr>

        </thead>
        <tbody>
            <tr>
                <?php foreach ($pembagi as $key => $k) : ?>
                    <td class="text-center"><?= $k ?></td>
                <?php endforeach; ?>
            </tr>
        </tbody>
    </table>

    <br>
    <br>

    <h4>Table Nilai</h4>
    <table id="mytables" class="table table-bordered table-md">
        <thead>
            <tr>
                <th class="text-center">Nama Produk</th>
                <?php
                $arraykriteria  = [];
                $kriteria       = ambilData("SELECT * FROM kriteria");
                foreach ($kriteria as $k) :
                    $arraykriteria[] = $k['id_kriteria'];
                ?>
                    <th class="text-center"><?= $k['nama'] ?></th>
                <?php endforeach; ?>

            </tr>

        </thead>
        <tbody>
            <?php foreach ($daftarproduk as $d) : ?>
                <tr>
                    <td class="text-center"><?= $d ?></td>

                    <?php
                    foreach ($kriteria as $k) :

                        $namakriteria = makeId($k['nama']);
                        if (!array_key_exists($d, $produk1[$namakriteria])) {
                            echo "Perhitungan gagal, pastikan anda mengisi nilai sub kriteria terlebih dahulu";
                            die;
                        }
                        $nilai      = $produk1[$namakriteria][$d];

                    ?>
                        <td class="text-center"><?= $nilai ?></td>

                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <br>
    <br>

    <h4>Table Normalisasi</h4>
    <table id="mytables" class="table table-bordered table-md">
        <thead>
            <tr>
                <th class="text-center">Nama Produk</th>
                <?php
                $arraykriteria = [];
                $kriteria = ambilData("SELECT * FROM kriteria");
                foreach ($kriteria as $k) :
                    $arraykriteria[] = $k['id_kriteria'];
                ?>
                    <th class="text-center"><?= $k['nama'] ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($daftarproduk as $d) : ?>
                <tr>
                    <td class="text-center"><?= $d ?></td>

                    <?php
                    foreach ($kriteria as $k) :

                        $namakriteria = makeId($k['nama']);
                        $nilai = $produk2[$namakriteria][$d];
                    ?>
                        <td class="text-center"><?= $nilai ?></td>

                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <br>
    <br>

    <h4>Table Normalisasi Terbobot</h4>
    <table id="mytables" class="table table-bordered table-md">
        <thead>
            <tr>
                <th class="text-center">Nama Produk</th>
                <?php
                $arraykriteria = [];
                $kriteria = ambilData("SELECT * FROM kriteria");
                foreach ($kriteria as $k) :
                    $arraykriteria[] = $k['id_kriteria'];
                ?>
                    <th class="text-center"><?= $k['nama'] ?></th>
                <?php endforeach; ?>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($daftarproduk as $d) : ?>
                <tr>
                    <td class="text-center"><?= $d ?></td>

                    <?php
                    foreach ($kriteria as $k) :

                        $namakriteria = makeId($k['nama']);
                        $nilai = $produk3[$namakriteria][$d];
                    ?>
                        <td class="text-center"><?= $nilai ?></td>

                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <br>
    <br>

    <h4>Table Ideal Positif & Negatif</h4>
    <table id="mytables" class="table table-bordered table-md">
        <thead>
            <tr>
                <th class="text-center">Jenis</th>
                <?php foreach ($idealpositif as $key => $val) :
                    $nama = revereseId($key);
                ?>
                    <th class="text-center"><?= $nama ?></th>
                <?php endforeach; ?>

            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center">Positif</td>
                <?php foreach ($idealpositif as $key => $val) : ?>

                    <td class="text-center"><?= $val ?></td>

                <?php endforeach; ?>
            </tr>

            <tr>
                <td class="text-center">Negatif</td>
                <?php foreach ($idealnegatif as $key => $val) : ?>

                    <td class="text-center"><?= $val ?></td>

                <?php endforeach; ?>
            </tr>

        </tbody>
    </table>

    <br>
    <br>


    <h4>Jarak Alternatif</h4>
    <table id="mytables" class="table table-bordered table-md">
        <thead>
            <tr>
                <th class="text-center">Produk</th>
                <th class="text-center">Nilai (D+)</th>
                <th class="text-center">Produk</th>
                <th class="text-center">Nilai (D-)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($daftarproduk as $key => $val) :
                $nilai = $jarak[$val];
                $nilainegatif = $jaraknegatif[$val];
            ?>
                <tr>
                    <td class="text-center"><?= $val ?></td>
                    <td class="text-center"><?= $nilai ?></td>
                    <td class="text-center"><?= $val ?></td>
                    <td class="text-center"><?= $nilainegatif ?></td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>

    <br>
    <br>
<?php endif; ?>

<h4>Hasil Akhir</h4>
<table id="mytables" class="table table-bordered table-md">
    <thead>
        <tr>
            <th class="text-center">Produk</th>
            <?php foreach ($kriteria as $k) : ?>
                <th class="text-center"><?= $k['nama'] ?></th>
            <?php endforeach; ?>
            <th class="text-center">Harga</th>
            <th class="text-center">Nilai</th>
            <th class="text-center">Ranking</th>
        </tr>
    </thead>
    <tbody>

        <?php
        $i = 1;
        $x = 0;
        $result = 5;
        $arrin = [];
        foreach ($hasil as $key => $val) :

            $harga = 0;
            if ($x < 5) :
        ?>
                <tr>
                    <td class="text-center"><?= $key ?></td>
                    <?php

                    foreach ($kriteria as $k) :

                        $query      = "SELECT id_produk FROM produk WHERE nama = '{$key}'";

                        $idproduk   = ambilData($query)[0]['id_produk'];
                        $harga      = ambilData("SELECT harga FROM produk WHERE id_produk = {$idproduk}")[0]['harga'];
                        $query      = "SELECT sub_kriteria.nama_sub FROM nilai INNER JOIN sub_kriteria USING(id_sub_kriteria) WHERE id_kriteria = {$k['id_kriteria']} AND nilai.id_produk = {$idproduk}";
                        $namasub    = ambilData($query)[0]['nama_sub'];


                        // $arrin[] = "<input type='hidden' name='produk[]' value=''>";
                    ?>

                        <td class="text-center"><?= $namasub ?></td>
                    <?php endforeach; ?>
                    <td class="text-center"><?= rupiah($harga) ?></td>
                    <td class="text-center"><?= $val ?></td>
                    <td class="text-center"><?= $i++ ?></td>

                </tr>
        <?php
                $arrin[] = $idproduk;
                $x++;
            endif;
        endforeach;

        ?>



    </tbody>
</table>
<form action="" id="formproduk">
    <?php foreach ($arrin as $a) : ?>
        <input type="hidden" name="produk[]" value="<?= $a ?>">
    <?php endforeach; ?>
</form>
<br>
<br>


<button class="btn btn-success btn-block" onclick="simpanPenilaian()">Simpan</button>