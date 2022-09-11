<?php

require_once "../include/functions.php";
$nip        = $_GET['nip'];
$periode    = $_GET['periode'];
$tahun      = $_GET['tahun'];

$absensi = ambilData("SELECT * FROM absensi INNER JOIN karyawan USING(nip) WHERE karyawan.nip = '{$nip}'");
$nama = $absensi[0]['nama'];



$bulan = [];
$angka = [];
$status = '';
if ($periode == 1) {
    $status = "Januari - Maret";
    $bulan = [
        "Januari",
        "Februari",
        "Maret"
    ];
    $angka = [1, 2, 3];
} else if ($periode == 2) {
    $status = "April - Juni";
    $bulan = [
        "April",
        "Mei",
        "Juni"
    ];
    $angka = [4, 5, 6];
} else if ($periode == 3) {
    $status = "Juli - September";
    $bulan = [
        "Juli",
        "Agustus",
        "September"
    ];
    $angka = [7, 8, 9];
} else {
    $status = "Oktober - Desmber";
    $bulan = [
        "Oktober",
        "November",
        "Desember"
    ];
    $angka = [10, 11, 12];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Absensi </title>
    <!-- Bootstrap -->
    <link href="../assets/plugins/bootstrap/js/bootstrap.min.css" rel="stylesheet">

    <style>
        .coba {
            margin-left: 40px;
        }
    </style>
</head>


<body onload="window.print();">
    <div class="container mt-5">
        <table>
            <div class="kontain">

                <div class="isi" style="position:relative;">

                    <p style="text-align:center"><span style="font-family:Times New Roman,Times,serif">
                            <font size="8"> PT. Aseli Dagadu Djogdja</font>
                        </span></p>


                    <p style="text-align:center"><span style="font-size:15px">Jl. IKIP PGRI I Sonosewu Jl. Sonopakis Kidul No.50, Sonosewu, Ngestiharjo, Kec. Kasihan, Bantul, Daerah Istimewa Yogyakarta 55184</span></p>


                </div>
            </div>

            <hr style="border:1.5px solid black;">
            <p>&nbsp;</p>
            <h1 style="text-align: center;">Laporan Absensi</h1>
            <h5 style="text-align: center;">Nama : <?= $nama ?></h5>
            <h5 style="text-align: center;">NIP : <?= $nip ?></h5>
            <h5 style="text-align: center;">Tahun : <?= $tahun ?></h5>

        </table>

        <br></br>
        <table id="example" class="table table-striped table-bordered mt-4" style="width:100%">
            <thead>
                <tr style=font-family:Times New Roman,Times,serif: align="center">
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Keterangan</th>
                    <th class="text-center">Periode</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($absensi as $d) :
                ?>
                    <tr>
                        <td class="text-center"><?= $d["tanggal"] ?></td>
                        <td class="text-center"><?= $d["keterangan"] ?></td>
                        <td class="text-center"><?= $status ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>



    </div>
</body>

</html>