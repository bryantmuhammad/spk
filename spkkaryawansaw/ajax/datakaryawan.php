<?php
require_once "../include/functions.php";
$id = $_POST['id'];

$data = ambilData("SELECT * FROM karyawan WHERE id_karyawan = {$id}")[0];
echo json_encode($data);
