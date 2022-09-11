<?php
require_once "../include/functions.php";
$id = $_POST['id'];

$data = ambilData("SELECT * FROM pemilik WHERE id_pemilik = {$id}")[0];
echo json_encode($data);
