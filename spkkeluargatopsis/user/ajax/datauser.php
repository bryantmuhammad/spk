<?php
require_once "../../include/function.php";

$username = $_POST['username'];
$data = ambilData("SELECT * FROM users WHERE username = '{$username}'")[0];
echo json_encode($data);
