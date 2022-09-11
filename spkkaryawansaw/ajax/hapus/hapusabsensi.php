<?php
require_once "../../include/koneksi.php";
$id = $_POST['id'];
mysqli_query($koneksi, "DELETE FROM absensi WHERE id_absensi = {$id}");

echo json_encode(["hasil" => mysqli_affected_rows($koneksi)]);
