<?php

require_once "include/functions.php";
require 'vendor/autoload.php';
date_default_timezone_set("Asia/Jakarta");

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;




$date = date("Y-m-d");
if (!isset($_SESSION['login'])) echo "<script>document.location.href='login.php'</script>";
$role = $_SESSION['login']['role'];
$namaPengguna = "";
if ($role == 1) {
    $namaPengguna = ambilData("SELECT nama FROM spv WHERE id_spv = {$_SESSION['login']['id']}")[0]['nama'];
} else if ($role == 2) {
    $namaPengguna = ambilData("SELECT nama FROM karyawan WHERE id_karyawan = {$_SESSION['login']['id']}")[0]['nama'];
} else if ($role == 3) {
    $namaPengguna = ambilData("SELECT nama FROM pemilik")[0]['nama'];
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SPK Karyawan</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

    <link rel="stylesheet" href="assets/plugins/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="assets/plugins/datatable/css/datatables.min.css">
    <link rel="stylesheet" href="assets/dist/chart/Chart.min.css">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">



    <!-- jQuery -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->

    <!-- Bootstrap 4 -->
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="assets/plugins/chart.js/Chart.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/dist/js/adminlte.js"></script>
    <script src="assets/plugins/jquery-validation/jquery.validate.js"></script>
    <script src="assets/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="assets/plugins/datatable/js/datatables.min.js"></script>
    <script src="assets/dist/chart/Chart.min.js"></script>

    <script src="assets/dist/js/script.js?<?= date("H i s") ?>"></script>
    <script>
        jQuery.extend(jQuery.validator.messages, {
            required: "Field tidak boleh kosong.",
            remote: "Please fix this field.",
            email: "Please enter a valid email address.",
            url: "Please enter a valid URL.",
            date: "Please enter a valid date.",
            dateISO: "Please enter a valid date (ISO).",
            number: "Field hanya boleh diisi dengan angka.",
            digits: "Hanya boleh angka.",
            creditcard: "Please enter a valid credit card number.",
            equalTo: "Please enter the same value again.",
            accept: "Please enter a value with a valid extension.",
            maxlength: jQuery.validator.format("Maksimal {0} angka."),
            minlength: jQuery.validator.format("Mohon masukan {0} angka."),
            rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
            range: jQuery.validator.format("Please enter a value between {0} and {1}."),
            max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
            min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
        });

        jQuery.validator.addMethod("lettersonly", function(value, element) {
            return this.optional(element) || /^[A-Z a-z /S]+$/g.test(value);
        }, "Tidak boleh angka");
    </script>


    <style>
        svg {
            position: absolute;
            width: 240px;
            height: 120px;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            margin: auto;
        }

        .credit {
            position: absolute;
            bottom: 50px;
            width: 100%;
            text-align: center;
        }

        .credit a {
            color: #FDB515;
            font: 800 75% "Open Sans", sans-serif;
            text-transform: uppercase;
            text-decoration: none;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->

                <!-- Notifications Dropdown Menu -->
                <?php if ($role == 2) : ?>
                    <a class="nav-link" href="?page=profilkaryawan">Profil</a>
                <?php endif; ?>
                <?php if ($role == 3) : ?>
                    <a class="nav-link" href="?page=profilpemilik">Profil</a>
                <?php endif; ?>
                <a class="nav-link" href="logout.php" onclick="return confirm('Yakin ingin keluar?')">Logout</a>
            </ul>
        </nav>
        <!-- /.navbar -->