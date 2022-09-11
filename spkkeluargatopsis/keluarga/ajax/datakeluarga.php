<?php
require_once "../../include/function.php";
$nik = clearData($_POST['nik']);

$data = ambilData("SELECT * FROM keluarga WHERE nik = '{$nik}'")[0];

echo json_encode($data);
