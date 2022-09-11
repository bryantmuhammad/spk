<?php
require_once "../../include/function.php";

$idkriteria = $_POST['id'];
mysqli_query($koneksi, "DELETE FROM kriteria WHERE id_kriteria = {$idkriteria}");
echo json_encode(['hasil' => mysqli_affected_rows($koneksi)]);
