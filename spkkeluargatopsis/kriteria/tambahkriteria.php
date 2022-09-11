<?php

if (isset($_POST['submit'])) {
    if (tambahKriteria($_POST) > 0) {
        echo "<script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Data berhasil ditambahkan',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                document.location.href = 'index.php?page=tambahkriteria'
            })
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Data gagal ditambahkan',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                document.location.href = 'index.php?page=tambahkriteria'
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
                                <label>Nama Kriteria</label>
                                <input type="text" name="nama" id="nama" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Bobot Kriteria</label>
                                <input type="text" name="bobot" id="bobot" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Atribut</label>
                                <select name="atribut" id="atribut" class="form-control">
                                    <option value="Benefit">Benefit</option>
                                    <option value="Cost">Cost</option>
                                </select>
                            </div>
                        </div>
                    </div>



                    <button name="submit" type="submit" class="btn btn-primary btn-block, padding:15px 32px">Tambah Kriteria</button>


                </form>
            </div>
            <!-- /.card-body -->
        </div>


</div>
</section>
<!-- /.content -->

</div>
<!-- /.content-wrapper -->