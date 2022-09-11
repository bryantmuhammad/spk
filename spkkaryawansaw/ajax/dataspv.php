<?php
require_once "../include/functions.php";
$id = $_POST['id'];

$data = ambilData("SELECT * FROM spv WHERE id_spv = {$id}")[0];
echo json_encode($data);
