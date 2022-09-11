<?php
$data = ambilData("SELECT * FROM keluarga");



if (isset($_POST['submit'])) {
    if (editKeluarga($_POST) > 0) {
        echo "<script>
                Swal.fire({
                    position: 'center',
                    type: 'success',
                    title: 'Data berhasil dirubah',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    document.location.href = 'index.php?page=keluarga'
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
                    document.location.href = 'index.php?page=keluarga'
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
                    <h1 class="m-0 text-dark">Keluarga</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Keluarga</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <a href="index.php?page=tambahkeluarga"><button class="btn btn-primary mb-4 btn-block, padding : 15px 32px">Tambah Keluarga</button></a>

            <table id="mytable" class="table table-bordered table-md">
                <thead>
                    <tr>
                    <tr>
                        <th class="text-center">NIK</th>
                        <th class="text-center">No KK</th>
                        <th class="text-center">Kepala Keluarga</th>
                        <th class="text-center">RT</th>
                        <th class="text-center">JK</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $d) : ?>
                        <tr>
                            <td class="text-center"><?= $d['nik'] ?></td>
                            <td class="text-center"><?= $d['no_kk'] ?></td>
                            <td class="text-center"><?= $d['kepala_keluarga'] ?></td>
                            <td class="text-center"><?= $d['rt'] ?></td>
                            <td class="text-center"><?= $d['jenis_kelamin'] ?></td>
                            <td class="text-center">
                                <button class="btn btn-success" data-id="<?= $d['nik'] ?>" onclick="editKeluarga($(this).data('id'))" data-toggle="modal" data-target="#exampleModalCenter">
                                    <i class="fa fa-pen"></i>
                                </button>
                                <button class="btn btn-danger" data-id="<?= $d['nik'] ?>" onclick="hapusData($(this).data('id'),'keluarga/ajax/hapuskeluarga.php','keluarga')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>

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
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Keluarga</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>NIK</label>
                                <input type="text" name="nik" id="nik" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>No KK</label>
                                <input type="text" name="nokk" id="nokk" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Kepala Keluarga</label>
                                <input type="text" name="kepalakeluarga" id="kepalakeluarga" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>RT</label>
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
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>



<script>

</script>