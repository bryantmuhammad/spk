<?php

$karyawan = ambilData("SELECT * FROM karyawan WHERE id_karyawan = {$_SESSION['login']['id']}")[0];
if (isset($_POST["submit"])) {
    if (editPasswordKaryawan($_POST) > 0) {
        echo "<script>
        Swal.fire({
            position: 'center',
            type: 'success',
            title: 'Password berhasil diganti',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            document.location.href = 'index.php?page=profilkaryawan'
        })
        
        </script>";
    } else {
        echo "<script>
        Swal.fire({
            position: 'center',
            type: 'error',
            title: 'Password gagal diganti',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            document.location.href = 'index.php?page=profilkaryawan'
        })
        
        </script>";
    }
}
?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Profil Karyawan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Profil Karyawan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">


            <div class="card-body">

                <div class="row">
                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label class="col-form-label" for="nip"> NIP</label>
                            <input type="text" class="form-control" value="<?= $karyawan['nip'] ?>" placeholder="Masukan NIP Karyawan" autocomplete="off" readonly>

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-form-label" for="nama"> Nama Karyawan</label>
                            <input type="text" class="form-control" value="<?= $karyawan['nama'] ?>" placeholder="Masukan Nama Karyawan" autocomplete="off" readonly>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-form-label" for="nama"> Divisi</label>
                            <input type="text" class="form-control" value="<?= $karyawan['divisi'] ?>" placeholder="Masukan Nama Karyawan" autocomplete="off" readonly>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-form-label" for="nama"> JK</label>
                            <input type="text" class="form-control" value="<?= $karyawan['jk'] ?>" placeholder="Masukan Nama Karyawan" autocomplete="off" readonly>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-form-label" for="nama"> Jabatan</label>
                            <input type="text" class="form-control" value="<?= $karyawan['jabatan'] ?>" placeholder="Masukan Nama Karyawan" autocomplete="off" readonly>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-form-label" for="alamat"> Alamat </label>
                            <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="10" readonly><?= $karyawan['alamat'] ?></textarea>
                        </div>
                    </div>
                </div>
            </div>


            <button name="submit" type="submit" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModalCenter">Edit Password</button>



        </div>
        <!-- /.card-body -->
</div>


</div>
</section>
<!-- /.content -->

</div>


<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Karyawan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" method="post" action="" id="formkriteria" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" id="idkaryawan" name="idkaryawan" value="<?= $karyawan['id_karyawan'] ?>">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- text input -->
                            <div class="form-group">
                                <label class="col-form-label" for="nip"> NIP</label>
                                <input type="text" class="form-control " id="nip" name="nip" placeholder="Masukan NIP Karyawan" value="<?= $karyawan['nip'] ?>" autocomplete="off" readonly>

                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-form-label" for="nama"> Nama Karyawan</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama Karyawan" value="<?= $karyawan['nama'] ?>" autocomplete="off" readonly>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <hr>
                                <p>*Ganti Password</p>
                                <label class="col-form-label" for="password"> Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Masukan Password" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->