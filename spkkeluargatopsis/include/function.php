<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once "koneksi.php";

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



        $query = "UPDATE kriteria SET nama_kriteria = '{$nama}', bobot = {$bobot}, atribut = '{$atribut}' WHERE id_kriteria = {$idkriteria}";
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

        $query = "INSERT INTO produk VALUES('','{$nama}','{$deskripsi}')";
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

        $idproduk                   = clearData($data['idproduk']);
        $nama                   = clearData($data['nama']);
        $deskripsi              = clearData($data['deskripsi']);

        $query = "UPDATE produk SET nama = '{$nama}', deskripsi = '{$deskripsi}' WHERE id_produk = {$idproduk}";
        mysqli_query($koneksi, $query);

        return mysqli_affected_rows($koneksi);
    }
}

function tambahAdmin($data)
{
    global $koneksi, $validator;

    // make it
    $validation = $validator->make($_POST, [
        'nama'                  => 'required',
        'email'                 => 'required|email',
        'password'              => 'required',
        'tanggal'               => 'required|date',
        'nohp'                  => 'required|numeric',
        'bidang'                => 'required',
        'alamat'                => 'required'
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

        $nama       = clearData($data['nama']);
        $email      = clearData($data['email']);
        $tanggal    = clearData($data['tanggal']);
        $nohp       = clearData($data['nohp']);
        $bidang     = clearData($data['bidang']);
        $alamat     = clearData($data['alamat']);
        $password   = $data['password'];
        $password   = password_hash($password, PASSWORD_BCRYPT);


        $query = "INSERT INTO pengurus VALUES('','{$email}','{$password}','{$nama}','{$bidang}','{$tanggal}','{$alamat}','{$nohp}')";
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
        'email'                 => 'required|email',
        'tanggal'               => 'required|date',
        'nohp'                  => 'required|numeric',
        'bidang'                => 'required',
        'alamat'                => 'required'
    ]);

    // then validate
    $validation->validate();

    if ($validation->fails()) {
        return 0;
    } else {
        // validation passes

        $nama       = clearData($data['nama']);
        $idpengurus = clearData($data['idpengurus']);
        $email      = clearData($data['email']);
        $tanggal    = clearData($data['tanggal']);
        $nohp       = clearData($data['nohp']);
        $bidang     = clearData($data['bidang']);
        $alamat     = clearData($data['alamat']);



        $password   = $data['password'];



        $query = "UPDATE pengurus SET email = '{$email}', nama = '{$nama}', bidang = '{$bidang}', tanggal_lahir = '{$tanggal}', alamat = '{$alamat}', no_hp = '{$nohp}'";


        if ($password) {
            $password   = password_hash($password, PASSWORD_BCRYPT);
            $query .= ", password = '{$password}'";
        }

        $query .= " WHERE id_pengurus = {$idpengurus}";

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

    $kriteria   = ambilData("SELECT * FROM kriteria");
    $nik        = $data['nik'];
    mysqli_query($koneksi, "DELETE FROM nilai WHERE nik = '{$nik}'");


    $i          = 0;
    $count      = count($kriteria);
    foreach ($kriteria as $k) {
        $nama       = makeId($k['nama_kriteria']);
        $query      = "INSERT INTO nilai VALUES('',{$nik},{$data[$nama]})";

        mysqli_query($koneksi, $query);
    }


    return mysqli_affected_rows($koneksi);
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

function tambahKeluarga($data)
{

    global $koneksi, $validator;

    // make it
    $validation = $validator->make($_POST, [
        'nik'                  => 'required',
        'nokk'                 => 'required',

    ]);

    // then validate
    $validation->validate();

    if ($validation->fails()) {
        return 0;
    } else {
        // validation passes

        $nik                    = clearData($data['nik']);
        $nokk                   = clearData($data['nokk']);
        $kepalakeluarga         = clearData($data['kepalakeluarga']);
        $rt                     = clearData($data['rt']);
        $jk                     = clearData($data['jk']);


        $query = "INSERT INTO keluarga VALUES('{$nik}','{$nokk}','{$kepalakeluarga}','{$rt}','{$jk}')";
        mysqli_query($koneksi, $query);
        return mysqli_affected_rows($koneksi);
    }
}


function editKeluarga($data)
{

    global $koneksi, $validator;

    // make it
    $validation = $validator->make($_POST, [
        'nik'                  => 'required',
        'nokk'                 => 'required',

    ]);

    // then validate
    $validation->validate();

    if ($validation->fails()) {
        return 0;
    } else {
        // validation passes

        $nik                    = clearData($data['nik']);
        $nokk                   = clearData($data['nokk']);
        $kepalakeluarga         = clearData($data['kepalakeluarga']);
        $rt                     = clearData($data['rt']);
        $jk                     = clearData($data['jk']);

        $query = "UPDATE keluarga SET no_kk = '{$nokk}',kepala_keluarga = '{$kepalakeluarga}', rt = '{$rt}', jenis_kelamin = '{$jk}' WHERE nik = '{$nik}'";
        mysqli_query($koneksi, $query);
        return mysqli_affected_rows($koneksi);
    }
}


function tambahUser($data)
{

    global $koneksi, $validator;

    // make it
    $validation = $validator->make($_POST, [
        'username'                  => 'required',
        'nama'                      => 'required',
    ]);

    // then validate
    $validation->validate();

    if ($validation->fails()) {
        return 0;
    } else {
        // validation passes

        $username                    = clearData($data['username']);
        $nama                        = clearData($data['nama']);
        $hak_akses                        = clearData($data['hak']);
        $password = $data['password'];
        $password = password_hash($password, PASSWORD_BCRYPT);

        $query = "INSERT INTO users VALUES('{$username}','{$password}','{$nama}',{$hak_akses})";

        mysqli_query($koneksi, $query);
        return mysqli_affected_rows($koneksi);
    }
}

function editUser($data)
{

    global $koneksi, $validator;

    // make it
    $validation = $validator->make($_POST, [
        'username'                  => 'required',
        'nama'                      => 'required',
    ]);

    // then validate
    $validation->validate();

    if ($validation->fails()) {
        return 0;
    } else {
        // validation passes


        $username                           = clearData($data['username']);
        $nama                               = clearData($data['nama']);
        $hak_akses                          = clearData($data['hak']);

        $query = "UPDATE users SET username = '{$username}', nama = '{$nama}', hak_akses = {$hak_akses}";

        $password = $data['password'];

        if ($password) {

            $password = password_hash($password, PASSWORD_BCRYPT);

            $query .= ", password = '{$password}'";
        }


        $query .= " WHERE username = '{$username}'";



        mysqli_query($koneksi, $query);
        return mysqli_affected_rows($koneksi);
    }
}
