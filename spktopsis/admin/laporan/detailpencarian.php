<?php

$idlaporan  = $_GET['id'];
$data       = ambilData("SELECT * FROM laporan_pencarian INNER JOIN sub_kriteria USING(id_sub_kriteria) INNER JOIN kriteria USING(id_kriteria) WHERE laporan_pencarian.id_laporan_pencarian = '{$idlaporan}'");


$produk = ambilData("SELECT * FROM laporan_produk INNER JOIN produk USING(id_produk) WHERE laporan_produk.id_laporan_pencarian = '{$idlaporan}'");
?>


<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Laporan Detail Pencarian</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="index.php">Dashboard</a></div>
                <div class="breadcrumb-item">Laporan Detail Pencarian</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="laporan/cetak/detailpencarian.php?id=<?= $idlaporan ?>" class="btn btn-success" target="_blank">
                                <i class="fa fa-print"></i>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="mytable" class="table table-bordered table-md">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Kriteria</th>
                                            <th class="text-center">Sub Kriteria</th>


                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php foreach ($data as $d) : ?>

                                            <tr>

                                                <td class="text-center">
                                                    <?= $d['nama'] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $d['nama_sub'] ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>


                                    </tbody>


                                </table>
                                <br>
                                <br>

                                <table id="mytable" class="table table-bordered table-md">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Nama Produk</th>
                                            <th class="text-center">Harga Produk</th>
                                            <th class="text-center">Ranking</th>


                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $i = 0;
                                        foreach ($produk as $d) : ?>

                                            <tr>

                                                <td class="text-center">
                                                    <?= $d['nama'] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= rupiah($d['harga']) ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= ++$i ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>


                                    </tbody>


                                </table>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>






</div>