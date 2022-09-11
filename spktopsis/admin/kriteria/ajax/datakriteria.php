<?php
require_once "../../include/function.php";

$idkriteria = $_POST['idkriteria'];

$data = ambilData("SELECT * FROM kriteria WHERE id_kriteria = {$idkriteria}")[0];
echo json_encode($data);
