<?php


session_start();
date_default_timezone_set('Asia/Jakarta');
// define('HOST', 'localhost');
// define("DBNAME", 'spk_cofee');
// define('USERNAME', 'root');
// define('PASSWORD', '');
define('HOST', 'localhost');
define("DBNAME", 'percent1_spk_cofee');
define('USERNAME', 'percent1_root');
define('PASSWORD', 'Gqf)}Q&A%nA=');


$koneksi    = mysqli_connect(HOST, USERNAME, PASSWORD, DBNAME) or die('DATABASE GAGAL TERHUBUNG');



function ambilData($query)
{
    global $koneksi;
    $data = [];

    $q = mysqli_query($koneksi, $query);
    while ($d = mysqli_fetch_assoc($q)) {
        $data[] = $d;
    }
    return $data;
}


function upload($tanda = 0, $name = 'file')
{
    //cek semua data yang dibutuhkan
    $namaGambar = $_FILES[$name]["name"];
    $temp       = $_FILES[$name]["tmp_name"];
    $ukuran     = $_FILES[$name]["size"];
    $error      = $_FILES[$name]["error"];


    //buat seleksi pada gambar
    //cek apakah ada gambar 
    if ($error === 4) {
        echo "<script>alert('Tidak ada file yang diupload');</script>";
        return false;
    }
    //izinkan eksistensi file
    $gambarValid        = ['jpeg', 'jpg', 'png', 'jfif'];
    //pecah string gambar menjadi array dipisahkan setelah tanda .
    $namaGambarValid    = explode('.', $namaGambar);
    //ambil array diindex terakhir lalu ubah menjadi hurufkecil
    $jenisFile          = strtolower(end($namaGambarValid));

    //cek jika tidak ada jenis file didalam array 
    if (!in_array($jenisFile, $gambarValid)) {
        echo "<script>
        Swal.fire({
            position: 'center',
            type: 'error',
            title: 'Jenis file tidak sesuai',
            showConfirmButton: false,
            timer: 1000
        })
        </script>";
        return false;
    }

    //cek ukuran gambar
    if ($ukuran > 10000000) {
        echo "<script>
        Swal.fire({
            position: 'center',
            type: 'error',
            title: 'Ukuran file maksimal 10mb',
            showConfirmButton: false,
            timer: 1000
        })
        </script>";
        return false;
    }

    //buat nama dengan string acak
    $gambarBaru = uniqid();
    $gambarBaru .= '.';
    $gambarBaru .= $jenisFile;

    //pindahkan gambar dari folder sementara ke folder tujuan
    if (!$tanda) {
        move_uploaded_file($temp, 'assets/gambar/produk/' . $gambarBaru);
    } else if ($tanda == 1) {
        move_uploaded_file($temp, '../admin/assets/gambar/undangan/' . $gambarBaru);
    } else if ($tanda == 2) {
        move_uploaded_file($temp, '../admin/assets/gambar/desainundangan/' . $gambarBaru);
    }



    return $gambarBaru;
}


function makeId($namaasli)
{
    $nama = preg_replace('/\s+/', '_', $namaasli);
    $nama = strtolower($nama);

    return $nama;
}


function revereseId($namaasli)
{
    $nama = preg_replace('/[_]+/', ' ', $namaasli);
    $nama = ucwords($nama);

    return $nama;
}

function generateRandomString($length = 10)
{
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function rupiah($angka)
{

    $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}


function clearData($data)
{
    global $koneksi;
    $data = ucwords(mysqli_real_escape_string($koneksi, htmlspecialchars($data)));
    return $data;
}


function tambahKriteria($data)
{
    global $koneksi, $validator;

    // make it
    $validation = $validator->make($_POST, [
        'nama'                  => 'required',
        'bobot'                 => 'required',
        'atribut'              => 'required',
    ]);

    // then validate
    $validation->validate();

    if ($validation->fails()) {
        // handling errors
        // $errors = $validation->errors();
        // echo "<pre>";
        // print_r($errors->firstOfAll());
        // echo "</pre>";
        // exit;

        return 0;
    } else {
        // validation passes

        $nama           = clearData($data['nama']);
        $bobot          = clearData($data['bobot']);
        $atribut        = clearData($data['atribut']);



        $query = "INSERT INTO kriteria VALUES('','{$nama}',{$bobot},'{$atribut}')";
        mysqli_query($koneksi, $query);

        return mysqli_affected_rows($koneksi);
    }
}

function editKriteria($data)
{
    global $koneksi, $validator;

    // make it
    $validation = $validator->make($_POST, [
        'nama'                  => 'required',
        'bobot'                 => 'required',
        'atribut'               => 'required',
    ]);

    // then validate
    $validation->validate();

    if ($validation->fails()) {
        // handling errors
        // $errors = $validation->errors();
        // echo "<pre>";
        // print_r($errors->firstOfAll());
        // echo "</pre>";
        // exit;

        return 0;
    } else {
        // validation passes

        $idkriteria           = clearData($data['idkriteria']);
        $nama           = clearData($data['nama']);
        $bobot          = clearData($data['bobot']);
        $atribut        = clearData($data['atribut']);



        $query = "UPDATE kriteria SET nama = '{$nama}', bobot = {$bobot}, atribut = '{$atribut}' WHERE id_kriteria = {$idkriteria}";
        mysqli_query($koneksi, $query);

        return mysqli_affected_rows($koneksi);
    }
}

function tambahSubKriteria($data)
{
    global $koneksi, $validator;

    // make it
    $validation = $validator->make($_POST, [
        'nama'                  => 'required',
        'bobot'              => 'required',
    ]);

    // then validate
    $validation->validate();

    if ($validation->fails()) {
        // handling errors
        // $errors = $validation->errors();
        // echo "<pre>";
        // print_r($errors->firstOfAll());
        // echo "</pre>";
        // exit;

        return 0;
    } else {
        // validation passes

        $nama               = clearData($data['nama']);
        $bobot              = clearData($data['bobot']);

        $kriteria           = clearData($data['kriteria']);



        $query = "INSERT INTO sub_kriteria VALUES('',{$kriteria},'{$nama}',{$bobot})";
        mysqli_query($koneksi, $query);

        return mysqli_affected_rows($koneksi);
    }
}



function editSubKriteria($data)
{
    global $koneksi, $validator;

    // make it
    $validation = $validator->make($_POST, [
        'nama'                  => 'required',
        'bobot'                 => 'required',
    ]);

    // then validate
    $validation->validate();

    if ($validation->fails()) {
        // handling errors
        // $errors = $validation->errors();
        // echo "<pre>";
        // print_r($errors->firstOfAll());
        // echo "</pre>";
        // exit;

        return 0;
    } else {
        // validation passes

        $idsubkriteria               = clearData($data['idsubkriteria']);
        $nama               = clearData($data['nama']);
        $bobot              = clearData($data['bobot']);
        $kriteria           = clearData($data['kriteria']);



        $query = "UPDATE sub_kriteria SET id_kriteria = {$kriteria}, nama_sub = '{$nama}', bobot_sub = {$bobot} WHERE id_sub_kriteria = {$idsubkriteria}";

        mysqli_query($koneksi, $query);

        return mysqli_affected_rows($koneksi);
    }
}


function tambahProduk($data)
{
    global $koneksi, $validator;

    // make it
    $validation = $validator->make($_POST, [
        'nama'                  => 'required',
        'deskripsi'             => 'required',
        'harga'             => 'required',

    ]);

    // then validate
    $validation->validate();

    if ($validation->fails()) {
        // handling errors
        // $errors = $validation->errors();
        // echo "<pre>";
        // print_r($errors->firstOfAll());
        // echo "</pre>";
        // exit;

        return 0;
    } else {
        // validation passes

        $nama                   = clearData($data['nama']);
        $deskripsi              = clearData($data['deskripsi']);
        $harga              = clearData($data['harga']);

        $query = "INSERT INTO produk VALUES('','{$nama}','{$deskripsi}',{$harga})";
        mysqli_query($koneksi, $query);

        return mysqli_affected_rows($koneksi);
    }
}


function editProduk($data)
{
    global $koneksi, $validator;

    // make it
    $validation = $validator->make($_POST, [
        'nama'                  => 'required',
        'deskripsi'             => 'required',

    ]);

    // then validate
    $validation->validate();

    if ($validation->fails()) {
        // handling errors
        // $errors = $validation->errors();
        // echo "<pre>";
        // print_r($errors->firstOfAll());
        // echo "</pre>";
        // exit;

        return 0;
    } else {
        // validation passes

        $idproduk               = clearData($data['idproduk']);
        $nama                   = clearData($data['nama']);
        $deskripsi              = clearData($data['deskripsi']);
        $harga                  = clearData($data['harga']);

        $query = "UPDATE produk SET nama = '{$nama}', deskripsi = '{$deskripsi}', harga = {$harga} WHERE id_produk = {$idproduk}";
        mysqli_query($koneksi, $query);

        return mysqli_affected_rows($koneksi);
    }
}



function editTanggal($data)
{
    global $koneksi;

    $idtanggalpendaftaran   = $data['idtanggalpendaftaran'];
    $mulai                  = clearData($data['mulai']);
    $selesai                = clearData($data['selesai']);


    $query = "UPDATE tanggal_pendaftaran SET tanggal_mulai = '{$mulai}', tanggal_selesai = '{$selesai}' WHERE id_tanggal_pendaftaran = {$idtanggalpendaftaran}";



    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}


function tambahNilai($data)
{
    global $koneksi;



    $kriteria = ambilData("SELECT * FROM kriteria");

    $idproduk   = $data['idproduk'];
    mysqli_query($koneksi, "DELETE FROM nilai WHERE id_produk = {$idproduk}");


    $i          = 0;
    $count      = count($kriteria);
    foreach ($kriteria as $k) {


        $nama       = strtolower($k['nama']);
        $query      = "INSERT INTO nilai VALUES('',{$idproduk},{$data[$nama]})";
        mysqli_query($koneksi, $query);
    }




    return mysqli_affected_rows($koneksi);
}


function tambahAdmin($data)
{
    global $koneksi, $validator;

    // make it
    $validation = $validator->make($_POST, [
        'nama'                  => 'required',
        'email'                 => 'required',
        'alamat'              => 'required',
    ]);

    // then validate
    $validation->validate();

    if ($validation->fails()) {
        // handling errors
        // $errors = $validation->errors();
        // echo "<pre>";
        // print_r($errors->firstOfAll());
        // echo "</pre>";
        // exit;

        return 0;
    } else {
        // validation passes

        $nama           = clearData($data['nama']);
        $email          = clearData($data['email']);
        $jk             = clearData($data['jk']);
        $alamat         = clearData($data['alamat']);
        $jabatan           = clearData($data['jabatan']);
        $password       = $data['password'];
        $password       = password_hash($password, PASSWORD_BCRYPT);


        $query = "INSERT INTO admin VALUES('','{$nama}','{$jk}','{$alamat}','{$email}','{$password}',{$jabatan})";
        mysqli_query($koneksi, $query);

        return mysqli_affected_rows($koneksi);
    }
}


function editAdmin($data)
{
    global $koneksi, $validator;

    // make it
    $validation = $validator->make($_POST, [
        'nama'                  => 'required',
        'email'                 => 'required',
        'alamat'                => 'required',
    ]);

    // then validate
    $validation->validate();

    if ($validation->fails()) {
        // handling errors
        // $errors = $validation->errors();
        // echo "<pre>";
        // print_r($errors->firstOfAll());
        // echo "</pre>";
        // exit;

        return 0;
    } else {
        // validation passes

        $idadmin        = clearData($data['idadmin']);
        $nama           = clearData($data['nama']);
        $email          = clearData($data['email']);
        $jk             = clearData($data['jk']);
        $alamat         = clearData($data['alamat']);
        $jabatan         = clearData($data['jabatan']);


        $query = "UPDATE admin SET nama = '{$nama}', jk = '{$jk}', alamat = '{$alamat}', email = '{$email}', role = {$jabatan}";

        $password       = $data['password'];

        if ($password) {
            $password       = password_hash($password, PASSWORD_BCRYPT);
            $query .= ", password = '{$password}'";
        }


        $query .= " WHERE id_admin = {$idadmin}";

        mysqli_query($koneksi, $query);

        return mysqli_affected_rows($koneksi);
    }
}


function tambahCustomer($data)
{
    global $koneksi, $validator;

    // make it
    $validation = $validator->make($_POST, [
        'nama'                  => 'required',
        'email'                 => 'required',
        'alamat'                => 'required',
    ]);

    // then validate
    $validation->validate();

    if ($validation->fails()) {
        // handling errors
        // $errors = $validation->errors();
        // echo "<pre>";
        // print_r($errors->firstOfAll());
        // echo "</pre>";
        // exit;

        return 0;
    } else {
        // validation passes

        $nama           = clearData($data['nama']);
        $email          = clearData($data['email']);
        $jk             = clearData($data['jk']);
        $alamat         = clearData($data['alamat']);
        $password       = $data['password'];
        $password       = password_hash($password, PASSWORD_BCRYPT);


        $query = "INSERT INTO customer VALUES('','{$nama}','{$jk}','{$alamat}','{$email}','{$password}')";
        mysqli_query($koneksi, $query);

        return mysqli_affected_rows($koneksi);
    }
}


function editCustomer($data)
{
    global $koneksi, $validator;

    // make it
    $validation = $validator->make($_POST, [
        'nama'                  => 'required',
        'email'                 => 'required',
        'alamat'                => 'required',
    ]);

    // then validate
    $validation->validate();

    if ($validation->fails()) {
        // handling errors
        // $errors = $validation->errors();
        // echo "<pre>";
        // print_r($errors->firstOfAll());
        // echo "</pre>";
        // exit;

        return 0;
    } else {
        // validation passes
        $idcustomer        = clearData($data['idcustomer']);
        $nama           = clearData($data['nama']);
        $email          = clearData($data['email']);
        $jk             = clearData($data['jk']);
        $alamat         = clearData($data['alamat']);



        $query = "UPDATE customer SET nama = '{$nama}', jk = '{$jk}', alamat = '{$alamat}', email = '{$email}'";

        $password       = $data['password'];
        if ($password) {
            $password       = password_hash($password, PASSWORD_BCRYPT);
            $query .= ", password = '{$password}'";
        }

        $query .= " WHERE id_customer = {$idcustomer}";

        mysqli_query($koneksi, $query);

        return mysqli_affected_rows($koneksi);
    }
}


function rating($data)
{
    global $koneksi;
    $rating = $data['rating'];
    $idlaporanpencarian = $data['idlaporanpencarian'];

    $query = "INSERT INTO rating VALUES('','{$rating}','{$idlaporanpencarian}')";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}
