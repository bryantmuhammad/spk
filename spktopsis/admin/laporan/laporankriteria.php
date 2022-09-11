<?php
$data = ambilData("SELECT * FROM kriteria");



?>


<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Laporan Kriteria</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="index.php">Dashboard</a></div>
                <div class="breadcrumb-item">Laporan Kriteria</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="laporan/cetak/kriteria.php" class="btn btn-success" target="_blank">
                                <i class="fa fa-print"></i>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="mytable" class="table table-bordered table-md">
                                    <thead>

                                        <tr>
                                            <th class="text-center">Nama Kriteria</th>
                                            <th class="text-center">Bobot</th>
                                            <th class="text-center">Atribut</th>

                                        </tr>

                                    </thead>
                                    <tbody>
                                        <?php foreach ($data as $d) : ?>
                                            <tr>
                                                <td class="text-center"><?= $d['nama'] ?></td>
                                                <td class="text-center"><?= $d['bobot'] ?></td>
                                                <td class="text-center"><?= $d['atribut'] ?></td>


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