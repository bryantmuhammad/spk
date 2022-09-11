<?php
$data = ambilData("SELECT * FROM kriteria");
if (isset($_POST["submit"])) {

    if (editKriteria($_POST) > 0) {
        echo "<script>
        Swal.fire({
            position: 'center',
            type: 'success',
            title: 'Data berhasil dirubah',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            document.location.href = 'index.php?page=kri'
        })
        
        </script>";
    } else {
        echo "<script>
        Swal.fire({
            position: 'center',
            type: 'error',
            title: 'Data gagal dirubah',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            document.location.href = 'index.php?page=kri'
        })
        
        </script>";
    }
    // }
}
?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Kriteria</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Surat</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">



            <?php if ($role == 1) { ?>
                <a href="index.php?page=tkri"><button class="btn btn-info mb-4 btn-block">Tambah Kriteria</button></a>
            <?php } else if ($role == 3) { ?>
                <a href="cetak/cetakkriteria.php" target="_blank"><button class="btn btn-info mb-4 btn-block"><i class="fa fa-print"></i></button></a>
            <?php } ?>
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama Kriteria</th>
                        <th class="text-center">Jenis Kriteria</th>
                        <th class="text-center">Presentase</th>
                        <?php if ($role == 1) : ?>
                            <th class="text-center">Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach ($data as $d) : ?>
                        <tr>
                            <td class="text-center"><?= ++$no; ?></td>
                            <td class="text-center"><?= $d["nama_kriteria"] ?></td>
                            <td class="text-center"><?= $d["jenis"] ?></td>
                            <td class="text-center"><?= $d["presentase"] ?></td>
                            <?php if ($role == 1) : ?>
                                <td class="text-center">
                                    <button class="btn btn-success" data-toggle="modal" data-id="<?= $d['id_kriteria'] ?>" data-target="#exampleModalCenter" onclick="editKriteria($(this).data('id'))"><i class="fas fa-pen"></i></button>
                                    | <button class="btn btn-danger" data-id="<?= $d['id_kriteria'] ?>" onclick="hapusData($(this).data('id'),'ajax/hapus/hapuskriteria.php','kri')"><i class="fas fa-trash"></i></button>

                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>



        </div>


</div>
</section>
<!-- /.content -->

</div>
<!-- /.content-wrapper -->


<!-- modal edit -->

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Kriteria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" method="post" action="" id="formkriteria" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" id="idkriteria" name="idkriteria">
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label class="col-form-label" for="nama"> Nama Kriteria</label>
                                <input type="text" class="form-control " id="nama" name="nama" placeholder="Enter ...">

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label" for="presentase"> Presentase</label>
                                <input type="text" class="form-control" id="presentase" name="presentase" placeholder="Enter ...">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-form-label" for="presentase"> Jenis </label>
                                <select name="jenis" id="jenis" class="form-control">
                                    <option value="0">- Pilih Jenis -</option>
                                    <option value="Benefit">Benefit</option>
                                    <option value="Cost">Cost</option>
                                </select>
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