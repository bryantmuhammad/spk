<?php
require_once "include/header.php";
require_once "include/sidebar.php";




if (isset($_GET["page"])) {
    $page = $_GET["page"];
    switch ($page) {
            //Kriteria
        case "kri":
            require_once "kriteria/index.php";
            break;
        case "tkri":
            require_once "kriteria/tambahkriteria.php";
            break;
            // sub kriteria
        case "sub":
            require_once "subkriteria/index.php";
            break;
        case "tsub":
            require_once "subkriteria/tambahsubkriteria.php";
            break;
            // Karaywan

        case "hasilakhir":
            require_once "perhitungan/hasilakhir.php";
            break;
        case "karyawan":
            require_once "karyawan/index.php";
            break;
        case "tambahkaryawan":
            require_once "karyawan/tambahkaryawan.php";
            break;
            //nilai
        case "nilai":
            require_once "nilai/index.php";
            break;
        case "tambahnilai":
            require_once "nilai/tambahnilai.php";
            break;
        case "uploadabsensi":
            require_once "karyawan/upload.php";
            break;
        case "lihatabsensi":
            require_once "karyawan/lihatabsensi.php";
            break;
        case "perhitungan":
            require_once "perhitungan/index.php";
            break;
            // SPV
        case "spv":
            require_once "spv/index.php";
            break;
        case "tambahspv":
            require_once "spv/tambahspv.php";
            break;
            // hasil
        case "hasil":
            require_once "hasil/index.php";
            break;
        case "profilkaryawan":
            require_once "profil/profilkaryawan.php";
            break;
        case "pemilik":
            require_once "pemilik/index.php";
            break;
        case "profilpemilik":
            require_once "profil/profilpemilik.php";
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
                    <?php if ($_SESSION['login']['role'] == 1 || $_SESSION['login']['role'] == 3) : ?>
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <?php
                                    $jumlah = ambilData("SELECT count(id_kriteria) AS jumlah FROM kriteria")[0]['jumlah'];
                                    ?>
                                    <h3><?= $jumlah ?></h3>

                                    <p>Data Kriteria</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-paperclip"></i>
                                </div>
                                <a href="index.php?page=kri" class="small-box-footer">Kriteria <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <?php
                                    $jumlah = ambilData("SELECT count(id_sub_kriteria) AS jumlah FROM sub_kriteria")[0]['jumlah'];
                                    ?>
                                    <h3><?= $jumlah ?></h3>

                                    <p>Data Sub Kriteria</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-paperclip"></i>
                                </div>
                                <a href="index.php?page=sub" class="small-box-footer">Sub Kriteria <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <?php
                                    $jumlah = ambilData("SELECT count(id_spv) AS jumlah FROM spv")[0]['jumlah'];
                                    ?>
                                    <h3><?= $jumlah ?></h3>

                                    <p>SPV</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-paperclip"></i>
                                </div>
                                <a href="index.php?page=spv" class="small-box-footer">SPV <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <?php
                                    $jumlah = ambilData("SELECT count(id_karyawan) AS jumlah FROM karyawan")[0]['jumlah'];
                                    ?>
                                    <h3><?= $jumlah ?></h3>

                                    <p>Data Karyawan</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-paperclip"></i>
                                </div>
                                <a href="index.php?page=karyawan" class="small-box-footer">Kriteria <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($_SESSION['login']['role'] == 2) : ?>

                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3>Absensi</h3>

                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-paperclip"></i>
                                    </div>
                                    <a href="index.php?page=lihatabsensi&id=<?= $nip ?>" class="small-box-footer">Kriteria <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3>Hasil</h3>

                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-paperclip"></i>
                                    </div>
                                    <a href="index.php?page=lihatabsensi&id=<?= $nip ?>" class="small-box-footer">Kriteria <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

        </section>
        <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->
<?php
}
require_once "include/footer.php";
?>