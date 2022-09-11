<?php
require_once "../../include/function.php";
$idproduk = $_POST['idproduk'];


$kriteria = ambilData("SELECT * FROM kriteria");

$arr = [];
foreach ($kriteria as $k) :
    $nama = strtolower($k['nama']);
    $idkriteria = $k['id_kriteria'];
    $subkriteria = ambilData("SELECT nilai.id_sub_kriteria FROM nilai INNER JOIN sub_kriteria USING(id_sub_kriteria) WHERE sub_kriteria.id_kriteria = {$idkriteria} AND nilai.id_produk = {$idproduk}");
    if (count($subkriteria)) {
        $arr[$nama] = $subkriteria[0]['id_sub_kriteria'];
    } else {
        $arr[$nama] = '0';
    }
// $arr[$nama] = 
endforeach;

echo json_encode($arr);
