<?php

if (isset($_POST['submit'])) {
    if (tambahUser($_POST) > 0) {
        echo "<script>
            Swal.fire({
                position: 'center',
                type: 'success',
                title: 'Data berhasil ditambahkan',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                document.location.href = 'index.php?page=tambahuser'
            })
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                position: 'center',
                type: 'error',
                title: 'Data gagal ditambahkan',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                document.location.href = 'index.php?page=tambahuser'
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
                    <h1 class="m-0 text-dark">Tambah Kriteria</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Kriteria</li>
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
                <form role="form" method="post" action="" id="formsurat" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" id="username" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Hak Akses</label>
                                <select name="hak" id="hak" class="form-control">
                                    <option value="1">Admin</option>
                                    <option value="2">Kepala Desa</option>
                                </select>
                            </div>
                        </div>




                        <button name="submit" type="submit" class="btn btn-primary btn-block,  padding:15px 32px ">Tambah User</button>


                </form>
            </div>
            <!-- /.card-body -->
        </div>


</div>
</section>
<!-- /.content -->

</div>
<!-- /.content-wrapper -->