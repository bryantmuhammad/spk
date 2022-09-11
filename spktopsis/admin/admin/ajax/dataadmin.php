<?php
require_once "../../include/function.php";
$idadmin = $_POST['idadmin'];

$data = ambilData("SELECT * FROM admin WHERE id_admin = {$idadmin}")[0];
echo json_encode($data);
