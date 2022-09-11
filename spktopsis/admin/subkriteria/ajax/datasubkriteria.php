<?php
require_once "../../include/function.php";

$idsubkriteria = $_POST['idsubkriteria'];

$data = ambilData("SELECT * FROM sub_kriteria WHERE id_sub_kriteria = {$idsubkriteria}")[0];
echo json_encode($data);
