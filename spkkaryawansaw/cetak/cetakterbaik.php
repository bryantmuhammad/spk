<?php

require_once "../include/functions.php";
$divisi        = $_GET['divisi'];
$periode    = $_GET['periode'];
$tahun      = $_GET['tahun'];

$query = "SELECT hasil.urutan,karyawan.nama,karyawan.nip,karyawan.jk FROM hasil INNER JOIN karyawan USING(id_karyawan) 
    WHERE hasil.periode = {$periode} AND hasil.tahun = '{$tahun}' AND karyawan.divisi = '{$divisi}' ORDER BY hasil.urutan ASC";

$resultSpk = ambilData($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Karyawan Terbaik </title>
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
            <h1 style="text-align: center;">Laporan Karyawan Terbaik</h1>
            <h5 style="text-align: center;">Divisi : <?= $divisi ?></h5>
            <h5 style="text-align: center;">Tahun : <?= $tahun ?></h5>

        </table>

        <br></br>
        <table id="example" class="table table-striped table-bordered mt-4" style="width:100%">
            <thead>
                <tr style=font-family:Times New Roman,Times,serif: align="center">
                    <th class="text-center">NIP</th>
                    <th class="text-center">Nama Karyawan</th>
                    <th class="text-center">JK</th>
                    <th class="text-center">Urutan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($resultSpk as $s) :
                ?>
                    <tr>
                        <td class="text-center"><?= $s['nip'] ?></td>
                        <td class="text-center"><?= $s['nama'] ?></td>
                        <td class="text-center"><?= $s['jk'] ?></td>
                        <td class="text-center"><?= $s['urutan'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>



    </div>
</body>

</html>