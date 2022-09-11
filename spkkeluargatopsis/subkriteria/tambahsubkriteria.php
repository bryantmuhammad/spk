<?php

if (isset($_POST['submit'])) {
    if (tambahSubKriteria($_POST) > 0) {
        echo "<script>
            Swal.fire({
                position: 'center',
                type: 'success',
                title: 'Data berhasil ditambahkan',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                document.location.href = 'index.php?page=tambahsubkriteria'
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
                document.location.href = 'index.php?page=tambahsubkriteria'
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
                    <h1 class="m-0 text-dark">Tambah Sub Kriteria</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Sub Kriteria</li>
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
                                <label>Nama Sub Kriteria</label>
                                <input type="text" name="nama" id="nama" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Bobot Sub Kriteria</label>
                                <input type="text" name="bobot" id="bobot" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Kriteria</label>
                                <select name="kriteria" id="kriteria" class="form-control">
                                    <?php $kriteria = ambilData("SELECT * FROM kriteria");
                                    foreach ($kriteria as $k) :
                                        ?>
                                        <option value="<?= $k['id_kriteria'] ?>"><?= $k['nama_kriteria'] ?></option>

                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>




                        <button name="submit" type="submit" class="btn btn-primary btn-block, padding:15px 32px ">Tambah Sub Kriteria</button>


                </form>
            </div>
            <!-- /.card-body -->
        </div>


</div>
</section>
<!-- /.content -->

</div>
<!-- /.content-wrapper -->