<?php
require('../vendor/autoload.php');

use Rakit\Validation\Validator;

$validator  = new Validator;

require_once "include/function.php";
require_once "include/header.php";
require_once "include/sidebar.php";


if (isset($_GET['page'])) {
    $page = $_GET['page'];

    switch ($page) {
        case "admin":
            require_once "admin/index.php";
            break;
        case "tambahadmin":
            require_once "admin/tambahadmin.php";
            break;
        case "customer":
            require_once "customer/index.php";
            break;
        case "tambahcustomer":
            require_once "customer/tambahcustomer.php";
            break;
        case "kriteria":
            require_once "kriteria/index.php";
            break;
        case "tambahkriteria":
            require_once "kriteria/tambahkriteria.php";
            break;
        case "subkriteria":
            require_once "subkriteria/index.php";
            break;
        case "tambahsubkriteria":
            require_once "subkriteria/tambahsubkriteria.php";
            break;
        case "produk":
            require_once "produk/index.php";
            break;
        case "nilai":
            require_once "nilai/index.php";
            break;
        case "tambahproduk":
            require_once "produk/tambahproduk.php";
            break;
        case "menu":
            require_once "menu/index.php";
            break;
        case "laporanproduk":
            require_once "laporan/laporanproduk.php";
            break;
        case "laporankriteria":
            require_once "laporan/laporankriteria.php";
            break;
        case "laporansubkriteria":
            require_once "laporan/laporansubkriteria.php";
            break;
        case "laporanpencarian":
            require_once "laporan/laporanpencarian.php";
            break;
        case "detailpencarian":
            require_once "laporan/detailpencarian.php";
            break;
    }
} else {


    ?>
        <!-- Main Content -->
        <div class="main-content">
            <section class="section">

                <?php if ($role !== 3) : ?>
                    <div class="section-header">
                        <h1>Dashboard</h1>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-primary">
                                    <i class="far fa-user"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Total Kriteria</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php
                                                $total = ambilData("SELECT COUNT(id_kriteria) as jumlah FROM kriteria")[0]['jumlah'];
                                                ?>
                                        <?= $total ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-danger">
                                    <i class="far fa-newspaper"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Sub Kriteria</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php
                                                $total = ambilData("SELECT COUNT(id_sub_kriteria) as jumlah FROM sub_kriteria")[0]['jumlah'];
                                                ?>
                                        <?= $total ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-warning">
                                    <i class="far fa-file"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Produk</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php
                                                $total = ambilData("SELECT COUNT(id_produk) as jumlah FROM produk")[0]['jumlah'];
                                                ?>
                                        <?= $total ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-info">
                                    <i class="far fa-file"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Admin</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php
                                                $total = ambilData("SELECT COUNT(id_admin) as jumlah FROM admin")[0]['jumlah'];
                                                ?>
                                        <?= $total ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                <?php else : ?>
                    <div class="section-header">
                        <h1>Selamat Datang</h1>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">

                                <div class="card-body">
                                    <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            <li data-target="#carouselExampleIndicators2" data-slide-to="0" class="active"></li>
                                            <li data-target="#carouselExampleIndicators2" data-slide-to="1"></li>
                                            <li data-target="#carouselExampleIndicators2" data-slide-to="2"></li>
                                            <li data-target="#carouselExampleIndicators2" data-slide-to="3"></li>
                                            <li data-target="#carouselExampleIndicators2" data-slide-to="3"></li>
                                        </ol>
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <img class="d-block w-100" src="assets/bg1.jpg" alt="First slide" style="height: 1000px;">

                                            </div>
                                            <div class="carousel-item">
                                                <img class="d-block w-100" src="assets/bg2.jpg" alt="Second slide" style="height: 1000px;">

                                            </div>
                                            <div class="carousel-item">
                                                <img class="d-block w-100" src="assets/bg3.jpg" alt="Third slide" style="height: 1000px;">

                                            </div>
                                            <div class="carousel-item">
                                                <img class="d-block w-100" src="assets/bg4.jpg" alt="Four slide" style="height: 1000px;">

                                            </div>
                                            <div class="carousel-item">
                                                <img class="d-block w-100" src="assets/bg4.jpg" alt="five slide" style="height: 1000px;">

                                            </div>
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleIndicators2" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleIndicators2" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php endif; ?>



            </section>
        </div>
    <?php
    }
    require_once "include/footer.php";
    ?>