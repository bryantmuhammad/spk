<?php
require_once "../../include/function.php";

$nik = $_POST['id'];
mysqli_query($koneksi, "DELETE FROM keluarga WHERE nik = {$nik}");
echo json_encode(['hasil' => mysqli_affected_rows($koneksi)]);
