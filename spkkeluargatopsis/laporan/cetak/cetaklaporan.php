<?php
require_once "../../include/function.php";
$data       = ambilData("SELECT * FROM keluarga");

$kriteria = ambilData("SELECT * FROM kriteria");


$nilaisub   = [];
$produk     = [];
$bobot      = [];
$atribut    = [];


foreach ($kriteria as $k) {
    // $temp = [];
    $idkriteria     = $k['id_kriteria'];
    //Nilai sub kriteria tertinggi
    $nilaipalingtinggi = ambilData("SELECT MAX(bobot_sub) as tinggi FROM sub_kriteria WHERE id_kriteria = {$idkriteria}")[0]['tinggi'];



    //Nilai yang dipilih, Mendapatkan bobot sub tertinggi
    $namakriteria    = makeId($k['nama_kriteria']);
    // $idsubkriteri   = $_POST[$namakriteria];
    // $nilaidicari    = ambilData("SELECT bobot_sub FROM sub_kriteria WHERE id_sub_kriteria = {$idsubkriteri}")[0]['bobot_sub'];


    $bobot[$namakriteria]            = (float) $k['bobot'];

    $atribut[$namakriteria]          = $k['atribut'];

    // $produk[$namakriteria] = [];

    // cari nilai sebenarnya berdasarkan pencarian 
    $subkriteria = ambilData("SELECT * FROM sub_kriteria WHERE id_kriteria = {$idkriteria}");

    foreach ($subkriteria as $sub) {

        $nilaisub[$namakriteria][$sub['id_sub_kriteria']] =  (int) $sub['bobot_sub'];
    }
}


$pembagi = $produk;


$link = 'laporan/cetak/cetaklaporan.php';
if (isset($_GET['rt'])) {
    $rt = $_GET['rt'];
    if ($rt !== '0') {
        $link = 'laporan/cetak/cetaklaporan.php?rt=' . $rt;
        $nilai = ambilData("SELECT keluarga.kepala_keluarga as namaproduk,nilai.id_sub_kriteria,kriteria.nama_kriteria FROM nilai LEFT JOIN keluarga USING(nik) LEFT JOIN sub_kriteria USING(id_sub_kriteria) LEFT JOIN kriteria USING(id_kriteria) WHERE keluarga.rt = '{$rt}'");
    } else {
        $nilai = ambilData("SELECT keluarga.kepala_keluarga as namaproduk,nilai.id_sub_kriteria,kriteria.nama_kriteria FROM nilai LEFT JOIN keluarga USING(nik) LEFT JOIN sub_kriteria USING(id_sub_kriteria) LEFT JOIN kriteria USING(id_kriteria)");
    }
} else {
    $nilai = ambilData("SELECT keluarga.kepala_keluarga as namaproduk,nilai.id_sub_kriteria,kriteria.nama_kriteria FROM nilai LEFT JOIN keluarga USING(nik) LEFT JOIN sub_kriteria USING(id_sub_kriteria) LEFT JOIN kriteria USING(id_kriteria)");
}


$daftarproduk = [];
foreach ($nilai as $n) {

    $namakriteria    = makeId($n['nama_kriteria']);
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
    $namakriteria = makeId($k['nama_kriteria']);
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
    $namakriteria = makeId($k['nama_kriteria']);
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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Penerima Bantuan</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body onload="window.print();">

    <table>
        <div class="kontain">
            <div class="isi" style="position:relative;">
                <img src="../../assets/img/logo-ngawi.png" alt="" style="float:left;height:115px;position:absolute;left:-40px;">
                <p style="text-align:center"><span style="font-family:Times New Roman,Times,serif">
                        <font size="8">Padukuhan Ngaglik</font>
                    </span></p>
                <p style="text-align:center"><span style="font-size:15px">Sinduadi, Mlati, Sleman, Yogyakarta, Kode Pos: 55284
                    </span></p>
            </div>
        </div>

        <hr style="border:1.5px solid black;">

        <h4 class="text-center mt-5" style="text-decoration:underline;">LAPORAN CALON PENERIMA BANTUAN</h4>
        <?php if (isset($_GET['tglawal']) && isset($_GET['tglakhir'])) { ?>
            <h6 class="text-center"><?= $_GET['tglawal'] . " / " . $_GET['tglakhir'] ?></h6>
        <?php } ?>
        <hr>

        <table id="mytables" class="table table-bordered table-md">
            <thead>
                <tr>
                    <th class="text-center">Kepala Keluarga</th>
                    <?php foreach ($kriteria as $k) : ?>
                        <th class="text-center"><?= $k['nama_kriteria'] ?></th>
                    <?php endforeach; ?>
                    <th class="text-center">Nilai</th>
                    <th class="text-center">Ranking</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($hasil as $key => $val) :

                    ?>
                    <tr>
                        <td class="text-center"><?= $key ?></td>
                        <?php foreach ($kriteria as $k) :

                                $query = "SELECT nik FROM keluarga WHERE kepala_keluarga = '{$key}'";

                                $nik = ambilData($query)[0]['nik'];

                                $query = "SELECT sub_kriteria.nama_sub FROM nilai INNER JOIN sub_kriteria USING(id_sub_kriteria) WHERE id_kriteria = {$k['id_kriteria']} AND nilai.nik = '{$nik}'";

                                $namasub = ambilData($query)[0]['nama_sub'];
                                ?>

                            <td class="text-center"><?= $namasub ?></td>
                        <?php endforeach; ?>
                        <td class="text-center"><?= $val ?></td>
                        <td class="text-center"><?= $i++ ?></td>

                    </tr>
                <?php endforeach; ?>

            </tbody>

        </table>




</body>

</html>