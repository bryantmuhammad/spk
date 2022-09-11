<?php
require_once "../include/functions.php";
$id = $_POST['id'];

$data = ambilData("SELECT * FROM sub_kriteria INNER JOIN kriteria USING(id_kriteria) WHERE sub_kriteria.id_sub_kriteria = {$id}")[0];
echo json_encode($data);
