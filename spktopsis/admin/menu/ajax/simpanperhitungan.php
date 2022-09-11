<?php
require_once "../../include/function.php";




$idcustomer = $_SESSION['user'];

$id = generateRandomString();

foreach ($_POST as $key => $val) {
    $query = "INSERT INTO laporan_pencarian VALUES('{$id}',{$idcustomer},{$val})";
    mysqli_query($koneksi, $query);
}


echo json_encode([
    'res' => mysqli_affected_rows($koneksi),
    'id' => $id
]);
