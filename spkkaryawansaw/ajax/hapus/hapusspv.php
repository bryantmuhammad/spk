<?php
require_once "../../include/koneksi.php";
$id = $_POST['id'];
mysqli_query($koneksi, "DELETE FROM spv WHERE id_spv = {$id}");

echo json_encode(["hasil" => mysqli_affected_rows($koneksi)]);
