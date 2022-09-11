<?php
session_start();
require_once "koneksi.php";

function ambilData($query)
{
    global $koneksi;
    $q = mysqli_query($koneksi, $query);
    $d = [];
    while ($data = mysqli_fetch_assoc($q)) {
        $d[] = $data;
    }
    return $d;
}


function clearData($data)
{
    global $koneksi;
    $data = ucwords(mysqli_real_escape_string($koneksi, htmlspecialchars($data)));
    return $data;
}

function tambahKriteria($data)
{
    global $koneksi;

    $nama       = clearData($data['nama']);
    $presentase = clearData($data['presentase']);
    $jenis      = clearData($data['jenis']);



    $query = "INSERT INTO kriteria VALUES('','{$nama}','{$jenis}',{$presentase})";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

function editKriteria($data)
{
    global $koneksi;
    $nama       = clearData($data['nama']);
    $presentase = clearData($data['presentase']);
    $jenis      = clearData($data['jenis']);
    $idkriteria = $data['idkriteria'];

    $query = "UPDATE kriteria SET nama_kriteria = '{$nama}', jenis = '{$jenis}', presentase = {$presentase} WHERE id_kriteria = {$idkriteria}";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

function tambahSubKriteria($data)
{
    global $koneksi;
    $nama               = clearData($data['nama']);
    $bobot              = clearData($data['bobot']);
    $idkriteria         = clearData($data['idkriteria']);

    $query = "INSERT INTO sub_kriteria VALUES('','{$nama}',{$bobot},{$idkriteria})";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

function editSubKriteria($data)
{
    global $koneksi;
    $nama               = clearData($data['nama']);
    $bobot              = clearData($data['bobot']);
    $idkriteria         = clearData($data['idkriteria']);
    $idsubkriteria      = $data['idsubkriteria'];

    $query = "UPDATE sub_kriteria SET nama_sub_kriteria = '{$nama}',bobot = {$bobot},id_kriteria = {$idkriteria} WHERE id_sub_kriteria = {$idsubkriteria}";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

function cekDuplicate($query)
{

    if (count($query)) {
        return 1;
    }
    return 0;
}

function upload()
{
    //cek semua data yang dibutuhkan
    $namaGambar = $_FILES["gambar"]["name"];
    $temp = $_FILES["gambar"]["tmp_name"];
    $ukuran = $_FILES["gambar"]["size"];
    $error = $_FILES["gambar"]["error"];

    //buat seleksi pada gambar
    //cek apakah ada gambar 
    if ($error === 4) {
        echo "<script>alert('Tidak ada file yang diupload');</script>";
        return false;
    }
    //izinkan eksistensi file
    $gambarValid = ['pdf'];
    //pecah string gambar menjadi array dipisahkan setelah tanda .
    $namaGambarValid = explode('.', $namaGambar);
    //ambil array diindex terakhir lalu ubah menjadi hurufkecil
    $jenisFile = strtolower(end($namaGambarValid));

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
    move_uploaded_file($temp, 'assets/surat/' . $gambarBaru);

    return $gambarBaru;
}


function tambahKaryawan($data)
{
    global $koneksi;

    $nama = clearData($data['nama']);
    $nip = clearData($data['nip']);
    $divisi = clearData($data['divisi']);
    $jk = clearData($data['jk']);
    $jabatan = clearData($data['jabatan']);
    $alamat = clearData($data['alamat']);
    $password = password_hash($data['password'], PASSWORD_DEFAULT);
    $cek = ambilData("SELECT nip FROM karyawan WHERE nip = '{$nip}'");
    if (count($cek)) return false;

    $query = "INSERT INTO karyawan VALUES('','{$nip}','{$nama}','{$jabatan}','{$divisi}','{$jk}','{$alamat}','{$password}')";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}


function editKaryawan($data)
{
    global $koneksi;
    $nama = clearData($data['nama']);
    $nip = clearData($data['nip']);
    $divisi = clearData($data['divisi']);
    $jk = clearData($data['jk']);
    $jabatan = clearData($data['jabatan']);
    $alamat = clearData($data['alamat']);
    $idkaryawan = $data['idkaryawan'];


    $query = "UPDATE karyawan SET nip = '{$nip}', nama = '{$nama}', divisi = '{$divisi}', jabatan = '{$jabatan}', jk = '{$jk}', alamat = '{$alamat}'";
    if ($data['password']) {
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $query .= ", password = '{$password}'";
    }

    $query .= " WHERE id_karyawan = {$idkaryawan}";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

function tambahNilai($data)
{
    global $koneksi;
    $periode    = clearData($data['periode']);
    $tahun      = clearData($data['tahun']);


    foreach ($data['sub'] as $key => $val) {
        foreach ($val as $v) {
            $query  = "INSERT INTO hasil_penilaian VALUES ('',{$key},{$v},{$periode},'{$tahun}')";
            mysqli_query($koneksi, $query);
        }
    }

    return mysqli_affected_rows($koneksi);
}



function editNilai($data)
{
    global $koneksi;

    $periode    = clearData($data['periode']);
    $tahun      = clearData($data['tahun']);
    $jabatan      = clearData($data['jabatan']);
    $return = 0;
    if (isset($data['sub'])) {
        $query = "INSERT INTO hasil_penilaian VALUES";
        foreach ($data['sub'] as $key => $val) {
            foreach ($val as $v) {
                $query .= "('',{$key},{$v},{$periode},'{$tahun}'),";
            }
        }
        $query = rtrim($query, ",");
        mysqli_query($koneksi, $query);
        $return += mysqli_affected_rows($koneksi);
    }


    foreach ($data['subE'] as $key => $val) {
        mysqli_query($koneksi, "UPDATE hasil_penilaian SET id_sub_kriteria = {$val[0]} WHERE id_nilai = {$key}");
        $return += mysqli_affected_rows($koneksi);
    }

    $arr = [
        "hasil" => $return,
        "periode" => $periode,
        "tahun" => $tahun,
        "jabatan" => $jabatan
    ];
    return $arr;
}


function tambahSpv($data)
{
    global $koneksi;
    $nama = clearData($data['nama']);
    $nip = clearData($data['nip']);
    $username = clearData($data['username']);
    $jabatan = clearData($data['jabatan']);
    $divisi = clearData($data['divisi']);
    $password = $data['password'];


    $cek = ambilData("SELECT username FROM spv WHERE username = '{$username}'");

    if (count($cek)) {
        return 0;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO spv VALUES('','{$nip}','{$username}','{$password}','{$nama}','{$jabatan}','{$divisi}')";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}


function editSpv($data)
{
    global $koneksi;
    $nama = clearData($data['nama']);
    $nip = clearData($data['nip']);
    $username = clearData($data['username']);
    $jabatan = clearData($data['jabatan']);
    $divisi = clearData($data['divisi']);
    $password = $data['password'];
    $idspv = $data['idspv'];
    $query = "UPDATE spv SET nip = '{$nip}', username = '{$username}', nama = '{$nama}', jabatan = '{$jabatan}',divisi = '{$divisi}'";
    if ($password) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $query .= ", password = '{$password}'";
    }

    $query .= " WHERE id_spv = {$idspv}";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}


function editPasswordKaryawan($data)
{
    global $koneksi;

    $idkaryawan = $data['idkaryawan'];
    $password   = $data['password'];
    $password = password_hash($password, PASSWORD_DEFAULT);

    $query = "UPDATE karyawan SET password = '{$password}' WHERE id_karyawan = {$idkaryawan}";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}


function editPemilik($data)
{
    global $koneksi;
    $idpemilik = clearData($data['idpemilik']);
    $nama = clearData($data['nama']);
    $username = clearData($data['username']);
    $jk = clearData($data['jk']);
    $alamat = clearData($data['alamat']);
    $password = $data['password'];


    $query = "UPDATE pemilik SET nama = '{$nama}', alamat = '{$alamat}', jk = '{$jk}', username = '{$username}'";
    if ($password) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $query .= ", password = '{$password}'";
    }

    $query .= " WHERE id_pemilik = {$idpemilik}";

    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}


function divisi()
{
    $divisi = ambilData("SELECT divisi FROM spv WHERE id_spv = {$_SESSION['login']['id']}")[0]['divisi'];

    if ($divisi == "Marketing Manager") {
        $arr = ["Desainer", "Marketing Officer", "Marketing Brand Dan Produk", "Pemasaran"];
    } else if ($divisi == "PPIC Manager") {
        $arr = ["Pelipat", "Tukang Potong", "Produksi"];
    } else if ($divisi == "Operational Manager") {
        $arr = ["Umum Dan Administrasi", "Keamanan"];
    } else if ($divisi == "Accounting Manager") {
        $arr = ["kasir", "Keuangan"];
    }

    return $arr;
}
