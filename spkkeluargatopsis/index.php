<?php
require_once "include/header.php";
require_once "include/sidebar.php";




if (isset($_GET["page"])) {
    $page = $_GET["page"];
    switch ($page) {
            //surat
        case "kriteria":
            require_once "kriteria/index.php";
            break;
        case "tambahkriteria":
            require_once "kriteria/tambahkriteria.php";
            break;
        case "user":
            require_once "user/index.php";
            break;
        case "tambahuser":
            require_once "user/tambahuser.php";
            break;
        case "subkriteria":
            require_once "subkriteria/index.php";
            break;
        case "tambahsubkriteria":
            require_once "subkriteria/tambahsubkriteria.php";
            break;
        case "keluarga":
            require_once "keluarga/index.php";
            break;
        case "tambahkeluarga":
            require_once "keluarga/tambahkeluarga.php";
            break;
        case "nilai":
            require_once "nilai/index.php";
            break;

        case "perhitungan":
            require_once "perhitungan/index.php";
            break;
        case "tanggalpendaftaran":
            require_once "pendaftaran/tanggal.php";
            break;
    }
} else {
    ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Dashboard</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active"><a href="index.php">Home</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <?php
                                        $jumlah = ambilData("SELECT COUNT(id_kriteria) as jumlah FROM kriteria")[0]["jumlah"];

                                        ?>
                                    <h3><?= $jumlah ?></h3>

                                    <p>Kriteria</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-paperclip"></i>
                                </div>
                                <a href="index.php?page=kriteria" class="small-box-footer">Info Detail <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <?php
                                        $jumlah = ambilData("SELECT COUNT(id_sub_kriteria) as jumlah FROM sub_kriteria")[0]["jumlah"];

                                        ?>
                                    <h3><?= $jumlah ?></h3>

                                    <p>Sub Kriteria</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-paperclip"></i>
                                </div>
                                <a href="index.php?page=subkriteria" class="small-box-footer">Info Detail <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <?php
                                        $jumlah = ambilData("SELECT COUNT(nik) as jumlah FROM keluarga")[0]["jumlah"];

                                        ?>
                                    <h3><?= $jumlah ?></h3>
                                    <p>Keluarga</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-users"></i>
                                </div>
                                <a href="index.php?page=keluarga" class="small-box-footer">Info Detail <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <?php
                                        $jumlah = ambilData("SELECT COUNT(username) as jumlah FROM users")[0]["jumlah"];
                                        ?>
                                    <h3><?= $jumlah ?></h3>
                                    <p>User</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-user"></i>
                                </div>
                                <a href="index.php?page=user" class="small-box-footer">Info Detail <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->

                        <!-- ./col -->
                    </div>
                    <!-- /.row -->
                    <!-- Main row -->
                </div>
            </section>
            <!-- /.content -->

        </div>
        <!-- /.content-wrapper -->
    <?php
    }
    require_once "include/footer.php";
    ?>