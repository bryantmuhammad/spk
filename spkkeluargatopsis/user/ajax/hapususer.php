<?php
require_once "../../include/function.php";

$iduser = $_POST['id'];
mysqli_query($koneksi, "DELETE FROM users WHERE username = {$iduser}");
echo json_encode(['hasil' => mysqli_affected_rows($koneksi)]);
