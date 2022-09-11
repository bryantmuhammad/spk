<?php
require_once "../../include/koneksi.php";
$id = $_POST['id'];
mysqli_query($koneksi, "DELETE FROM sub_kriteria WHERE id_sub_kriteria = {$id}");

echo json_encode(["hasil" => mysqli_affected_rows($koneksi)]);
