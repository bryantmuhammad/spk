<?php
require_once "../../include/function.php";

$idsubkriteria = $_POST['id'];
mysqli_query($koneksi, "DELETE FROM sub_kriteria WHERE id_sub_kriteria = {$idsubkriteria}");
echo json_encode(['hasil' => mysqli_affected_rows($koneksi)]);
