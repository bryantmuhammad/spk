<?php
$data = ambilData("SELECT * FROM sub_kriteria INNER JOIN kriteria USING(id_kriteria) ORDER BY sub_kriteria.id_kriteria ASC");




?>


<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Laporan Sub Kriteria</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="index.php">Dashboard</a></div>
                <div class="breadcrumb-item">Laporan Sub Kriteria</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="laporan/cetak/subkriteria.php" class="btn btn-success" target="_blank">
                                <i class="fa fa-print"></i>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
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
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>






</div>