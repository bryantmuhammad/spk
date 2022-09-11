<?php
require_once "../../include/function.php";
$id = $_POST['id'];
mysqli_query($koneksi, "DELETE FROM customer WHERE id_customer = {$id}");
echo json_encode(['hasil' => mysqli_affected_rows($koneksi)]);
