<?php
$data = ambilData("SELECT * FROM sub_kriteria INNER JOIN kriteria USING(id_kriteria) ORDER BY sub_kriteria.id_kriteria ASC");


if (isset($_POST['submit'])) {

    if (editSubKriteria($_POST) > 0) {
        echo "<script>
                Swal.fire({
                    position: 'center',
                    type: 'success',
                    title: 'Data berhasil dirubah',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    document.location.href = 'index.php?page=subkriteria'
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
                    document.location.href = 'index.php?page=subkriteria'
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
                        <li class="breadcrumb-item active">Sub Kriteria</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <a href="index.php?page=tambahsubkriteria"><button class="btn btn-primary mb-4 ">Tambah Sub Kriteria</button></a>

            <table id="mytable" class="table table-bordered table-md">
                <thead>
                    <tr>
                    <tr>
                        <th class="text-center">Nama Sub Kriteria</th>
                        <th class="text-center">Bobot Sub Kriteria</th>
                        <th class="text-center">Kriteria</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $d) : ?>
                        <tr>
                            <td class="text-center"><?= $d['nama_sub'] ?></td>

                            <td class="text-center"><?= $d['bobot_sub'] ?></td>
                            <td class="text-center"><?= $d['nama_kriteria'] ?></td>
                            <td class="text-center">
                                <button class="btn btn-success" data-id="<?= $d['id_sub_kriteria'] ?>" onclick="editSubKriteria($(this).data('id'))" data-toggle="modal" data-target="#exampleModalCenter">
                                    <i class="fa fa-pen"></i>
                                </button>
                                <button class="btn btn-danger" data-id="<?= $d['id_sub_kriteria'] ?>" onclick="hapusData($(this).data('id'),'subkriteria/ajax/hapussubkriteria.php','subkriteria')">
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
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Sub Kriteria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="idsubkriteria" id="idsubkriteria">
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