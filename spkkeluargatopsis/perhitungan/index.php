<?php

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
if (isset($_POST['submit'])) {
    $rt = $_POST['rt'];
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



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Perhitungan Nilai</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Perhitungan Nilai</li>
                    </ol>


                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="" method="post">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="rt">RT</label>
                            <select name="rt" id="rt" class="form-control">
                                <option value="0">Semua</option>
                                <?php
                                $rt = ambilData("SELECT DISTINCT(rt) FROM keluarga");
                                foreach ($rt as $r) :
                                    ?>
                                    <option value="<?= $r['rt'] ?>"><?= $r['rt'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button class="btn btn-primary" name="submit" type="submit">Submit</button>
                    </div>
            </form>
        </div>

        <h4>Table Pembagi</h4>
        <img src="assets/img/pembagi.png" alt="">
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
                    <th class="text-center">Nama Kepala Keluarga</th>
                    <?php
                    $arraykriteria  = [];
                    $kriteria       = ambilData("SELECT * FROM kriteria");
                    foreach ($kriteria as $k) :
                        $arraykriteria[] = $k['id_kriteria'];
                        ?>
                        <th class="text-center"><?= $k['nama_kriteria'] ?></th>
                    <?php endforeach; ?>

                </tr>

            </thead>
            <tbody>
                <?php foreach ($daftarproduk as $d) : ?>
                    <tr>
                        <td class="text-center"><?= $d ?></td>

                        <?php
                            foreach ($kriteria as $k) :

                                $namakriteria = makeId($k['nama_kriteria']);
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
        <img src="assets/img/ternormalisasi.png" alt="">
        <table id="mytables" class="table table-bordered table-md">
            <thead>
                <tr>
                    <th class="text-center">Nama Kepala Keluarga</th>
                    <?php
                    $arraykriteria = [];
                    $kriteria = ambilData("SELECT * FROM kriteria");
                    foreach ($kriteria as $k) :
                        $arraykriteria[] = $k['id_kriteria'];
                        ?>
                        <th class="text-center"><?= $k['nama_kriteria'] ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($daftarproduk as $d) : ?>
                    <tr>
                        <td class="text-center"><?= $d ?></td>

                        <?php
                            foreach ($kriteria as $k) :

                                $namakriteria = makeId($k['nama_kriteria']);
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
        <img src="assets/img/ternormalisasiterbobot.png" alt="">
        <table id="mytables" class="table table-bordered table-md">
            <thead>
                <tr>
                    <th class="text-center">Nama Kepala Keluarga</th>
                    <?php
                    $arraykriteria = [];
                    $kriteria = ambilData("SELECT * FROM kriteria");
                    foreach ($kriteria as $k) :
                        $arraykriteria[] = $k['id_kriteria'];
                        ?>
                        <th class="text-center"><?= $k['nama_kriteria'] ?></th>
                    <?php endforeach; ?>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($daftarproduk as $d) : ?>
                    <tr>
                        <td class="text-center"><?= $d ?></td>

                        <?php
                            foreach ($kriteria as $k) :

                                $namakriteria = makeId($k['nama_kriteria']);
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
        <h6>Diambil dari Nilai Ternormalisasi Terbobot</h6>
        <h6>Positif = Max | Benefit, Min | Cost</h6>
        <h6>Negatif = Max | Cost, Min | Benefit</h6>
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
        <img src="assets/img/dpositif.png" alt="">
        <img src="assets/img/dnegatif.png" alt="">
        <table id="mytables" class="table table-bordered table-md">
            <thead>
                <tr>
                    <th class="text-center">Kepala Keluarga</th>
                    <th class="text-center">Nilai (D+)</th>
                    <th class="text-center">Kepala Keluarga</th>
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

        <h4>Hasil Akhir</h4>
        <img src="assets/img/hasil.png" alt="">
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
        <a href="<?= $link ?>" target="_blank"><button class="btn btn-success mb-2" style="margin-left: auto;"><i class="fa fa-print"></i></button></a>


        <br>
        <br>





</div>


</div>
</section>
<!-- /.content -->

</div>
<!-- /.content-wrapper -->


<!-- modal edit -->