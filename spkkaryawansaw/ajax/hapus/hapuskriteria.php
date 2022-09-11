<?php
require_once "../../include/koneksi.php";
$id = $_POST['id'];
mysqli_query($koneksi, "DELETE FROM kriteria WHERE id_kriteria = {$id}");

echo json_encode(["hasil" => mysqli_affected_rows($koneksi)]);
