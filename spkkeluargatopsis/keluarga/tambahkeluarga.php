<?php

if (isset($_POST['submit'])) {
    if (tambahKeluarga($_POST) > 0) {
        echo "<script>
            Swal.fire({
                position: 'center',
                type: 'success',
                title: 'Data berhasil ditambahkan',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                document.location.href = 'index.php?page=tambahkeluarga'
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
                document.location.href = 'index.php?page=tambahkeluarga'
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
                    <h1 class="m-0 text-dark">Tambah Keluarga</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Keluarga</li>
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
                <form role="form" method="post" action="" id="formkeluarga" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>NIK <span style="color:red;">*</span></label>
                                <input type="text" name="nik" id="nik" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>No KK <span style="color:red;">*</span></label>
                                <input type="text" name="nokk" id="nokk" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Kepala Keluarga <span style="color:red;">*</span></label>
                                <input type="text" name="kepalakeluarga" id="kepalakeluarga" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>RT <span style="color:red;">*</span></label>
                                <input type="text" name="rt" id="rt" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Jenis Kelamin <span style="color:red;">*</span></label>
                                <select name="jk" id="jk" class="form-control">
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <button name="submit" type="submit" class="btn btn-primary btn-block, padding:15px 32px">Tambah Keluarga</button>

                </form>
            </div>
            <!-- /.card-body -->
        </div>


</div>
</section>
<!-- /.content -->

</div>
<!-- /.content-wrapper -->