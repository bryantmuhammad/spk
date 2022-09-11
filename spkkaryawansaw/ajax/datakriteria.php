<?php
require_once "../include/functions.php";
$id = $_POST['id'];

$data = ambilData("SELECT * FROM kriteria WHERE id_kriteria = {$id}")[0];
echo json_encode($data);
