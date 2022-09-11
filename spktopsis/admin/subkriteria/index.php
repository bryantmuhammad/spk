<?php
$data = ambilData("SELECT * FROM sub_kriteria INNER JOIN kriteria USING(id_kriteria) ORDER BY sub_kriteria.id_kriteria ASC");


if (isset($_POST['submit'])) {

    if (editSubKriteria($_POST) > 0) {
        echo "<script>
                Swal.fire({
                    position: 'center',
                    icon: 'success',
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
                    icon: 'error',
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


<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Sub Kriteria</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="index.php">Dashboard</a></div>
                <div class="breadcrumb-item">Sub Kriteria</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="index.php?page=tambahsubkriteria">
                                <button class="btn btn-primary float-right">Tambah Sub Kriteria</button>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
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
                                                <td class="text-center"><?= $d['nama'] ?></td>
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

                    </div>
                </div>

            </div>
        </div>
    </section>




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
                <form action="" id="formsubkriteria" method="post">
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
                                            <option value="<?= $k['id_kriteria'] ?>"><?= $k['nama'] ?></option>

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

</div>