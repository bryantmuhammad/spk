<?php
if (isset($_POST["submit"])) {
    if (tambahSubKriteria($_POST) > 0) {
        echo "<script>
        Swal.fire({
            position: 'center',
            type: 'success',
            title: 'Data berhasil ditambahkan',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            document.location.href = 'index.php?page=tsub'
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
            document.location.href = 'index.php?page=tsub'
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
                    <h1 class="m-0 text-dark">Sub Kriteria</h1>
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
                <form role="form" method="post" action="" id="formkriteria" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label class="col-form-label" for="nama"> Nama Sub Kriteria</label>
                                <input type="text" class="form-control " id="nama" name="nama" placeholder="Masukan Nama Kriteria" autocomplete="off">

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label" for="presentase"> Bobot</label>
                                <input type="text" class="form-control" id="bobot" name="bobot" placeholder="Masukan Bobot" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-form-label" for="presentase"> Kriteria </label>
                                <select name="idkriteria" id="idkriteria" class="form-control">
                                    <option value="0">- Pilih Jenis -</option>
                                    <?php
                                    $data = ambilData("SELECT * FROM kriteria");
                                    foreach ($data as $d) :
                                    ?>
                                        <option value="<?= $d['id_kriteria'] ?>"><?= $d['nama_kriteria'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
            </div>


            <button name="submit" type="submit" class="btn btn-primary btn-block">Tambah Kriteria</button>


            </form>
        </div>
        <!-- /.card-body -->
</div>


</div>
</section>
<!-- /.content -->

</div>
<!-- /.content-wrapper -->