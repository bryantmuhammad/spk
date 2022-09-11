<?php
require_once "../../include/function.php";


$data = ambilData("SELECT * FROM sub_kriteria INNER JOIN kriteria USING(id_kriteria) ORDER BY sub_kriteria.id_kriteria ASC");

$pengurus = ambilData("SELECT * FROM admin WHERE id_admin = {$_SESSION['user']}")[0];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Sub Kriteria</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body onload="window.print();">

    <table>
        <div class="kontain">
            <div class="isi" style="position:relative;">
                <img src="../../assets/img/logo-ngawi.png" alt="" style="float:left;height:115px;position:absolute;left:-40px;">
                <p style="text-align:center"><span style="font-family:Times New Roman,Times,serif">
                        <font size="8">40% Coffee</font>
                    </span></p>
                <p style="text-align:center"><span style="font-size:15px">Jl Sumberjaya no 10 Pertigaan Warung Asem, Tambun Selatan Kota Bekasi, Jawa Barat 17510</span></p>
            </div>
        </div>

        <hr style="border:1.5px solid black;">

        <h4 class="text-center mt-5" style="text-decoration:underline;">LAPORAN SUB KRITERIA</h4>

        <hr>
        <table id="mytable" class="table table-bordered table-md">
            <thead>

                <tr>
                    <th class="text-center">Nama Sub Kriteria</th>
                    <th class="text-center">Bobot Sub Kriteria</th>
                    <th class="text-center">Kriteria</th>

                </tr>

            </thead>
            <tbody>
                <?php foreach ($data as $d) : ?>
                    <tr>
                        <td class="text-center"><?= $d['nama_sub'] ?></td>
                        <td class="text-center"><?= $d['bobot_sub'] ?></td>
                        <td class="text-center"><?= $d['nama'] ?></td>

                    </tr>
                <?php endforeach; ?>
            </tbody>


        </table>


        <p class="text-right">
            Bekasi, <?= date("Y-m-d") ?>
        </p>

        <br>
        <br>
        <br>
        <br>
        <p class="text-right" style="font-weight: bold;">
            <?= $pengurus['nama'] ?>
        </p>

</body>

</html>