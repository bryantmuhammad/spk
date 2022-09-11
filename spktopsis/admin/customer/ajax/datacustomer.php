<?php
require_once "../../include/function.php";
$idcustomer = $_POST['idcustomer'];

$data = ambilData("SELECT * FROM customer WHERE id_customer = {$idcustomer}")[0];
echo json_encode($data);
