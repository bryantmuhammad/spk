<?php
$data = ambilData("SELECT * FROM kriteria");


if (isset($_POST['submit'])) {

    if (editKriteria($_POST) > 0) {
        echo "<script>
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Data berhasil dirubah',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    document.location.href = 'index.php?page=kriteria'
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
                    document.location.href = 'index.php?page=kriteria'
                })
            </script>";
    }
}

?>


<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Kriteria</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="index.php">Dashboard</a></div>
                <div class="breadcrumb-item">Kriteria</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="index.php?page=tambahkriteria">
                                <button class="btn btn-primary float-right">Tambah Kriteria</button>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="mytable" class="table table-bordered table-md">
                                    <thead>
                                        <tr>
                                        <tr>
                                            <th class="text-center">Nama Kriteria</th>
                                            <th class="text-center">Bobot</th>
                                            <th class="text-center">Atribut</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data as $d) : ?>
                                            <tr>
                                                <td class="text-center"><?= $d['nama'] ?></td>
                                                <td class="text-center"><?= $d['bobot'] ?></td>
                                                <td class="text-center"><?= $d['atribut'] ?></td>
                                                <td class="text-center">
                                                    <button class="btn btn-success" data-id="<?= $d['id_kriteria'] ?>" onclick="editKriteria($(this).data('id'))" data-toggle="modal" data-target="#exampleModalCenter">
                                                        <i class="fa fa-pen"></i>
                                                    </button>
                                                    <button class="btn btn-danger" data-id="<?= $d['id_kriteria'] ?>" onclick="hapusData($(this).data('id'),'kriteria/ajax/hapuskriteria.php','kriteria')">
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Kriteria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" id="formkriteria" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="idkriteria" id="idkriteria">
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
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>