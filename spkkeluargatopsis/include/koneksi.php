<?php
define("host", "localhost");
define("username", "root");
define("password", "");
define("dbname", "spk_keluarga");

$koneksi = mysqli_connect(host, username, password, dbname) or die("Gagal menghubungkan ke database");
