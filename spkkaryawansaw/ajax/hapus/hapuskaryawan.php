<?php
require_once "../../include/koneksi.php";
$id = $_POST['id'];
mysqli_query($koneksi, "DELETE FROM karyawan WHERE id_karyawan = {$id}");
mysqli_query($koneksi, "DELETE FROM hasil WHERE id_karyawan = {$id}");
mysqli_query($koneksi, "DELETE FROM hasil_penilaian WHERE id_karyawan = {$id}");


echo json_encode(["hasil" => 1]);
