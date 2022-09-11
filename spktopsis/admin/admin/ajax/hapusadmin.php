<?php
require_once "../../include/function.php";
$id = $_POST['id'];
mysqli_query($koneksi, "DELETE FROM admin WHERE id_admin = {$id}");
echo json_encode(['hasil' => mysqli_affected_rows($koneksi)]);
