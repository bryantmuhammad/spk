<?php
require_once "../../include/function.php";

$idproduk = $_POST['id'];
mysqli_query($koneksi, "DELETE FROM produk WHERE id_produk = {$idproduk}");
echo json_encode(['hasil' => mysqli_affected_rows($koneksi)]);
