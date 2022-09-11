<?php

require_once "../include/functions.php";


$data = ambilData("SELECT * FROM kriteria");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Kriteria </title>
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
            <h1 style="text-align: center;">Laporan Kriteria</h1>


        </table>

        <br></br>
        <table id="example" class="table table-striped table-bordered mt-4" style="width:100%">
            <thead>
                <tr style=font-family:Times New Roman,Times,serif: align="center">
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Nama Kriteria</th>
                    <th class="text-center">Jenis Kriteria</th>
                    <th class="text-center">Presentase</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;
                foreach ($data as $d) : ?>
                    <tr>
                        <td class="text-center"><?= ++$no; ?></td>
                        <td class="text-center"><?= $d["nama_kriteria"] ?></td>
                        <td class="text-center"><?= $d["jenis"] ?></td>
                        <td class="text-center"><?= $d["presentase"] ?></td>

                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>



    </div>
</body>

</html>