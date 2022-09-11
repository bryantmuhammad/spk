<?php
require_once "../../include/function.php";




$idcustomer = $_SESSION['user'];

$id = $_POST['idlaporan'];

foreach ($_POST['produk'] as $key => $val) {
    $query = "INSERT INTO laporan_produk VALUES('',{$val},'{$id}')";
    mysqli_query($koneksi, $query);
}


echo json_encode(['res' => mysqli_affected_rows($koneksi)]);
