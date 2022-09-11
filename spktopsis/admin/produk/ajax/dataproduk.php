<?php
require_once "../../include/function.php";

$idproduk = $_POST['idproduk'];

$data = ambilData("SELECT * FROM produk WHERE id_produk = {$idproduk}")[0];
echo json_encode($data);
