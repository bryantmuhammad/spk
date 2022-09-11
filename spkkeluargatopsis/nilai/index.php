<?php
$data = ambilData("SELECT * FROM keluarga");


if (isset($_POST['submit'])) {

    if (tambahNilai($_POST) > 0) {
        echo "<script>
                Swal.fire({
                    position: 'center',
                    type: 'success',
                    title: 'Data berhasil dirubah',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    document.location.href = 'index.php?page=nilai'
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
                    document.location.href = 'index.php?page=nilai'
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
                    <h1 class="m-0 text-dark">Nilai</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Nilai</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">


            <table id="mytable" class="table table-bordered table-md">
                <thead>
                    <tr>
                    <tr>
                        <th class="text-center">Kepala Keluarga</th>
                        <?php
                        $arraykriteria = [];
                        $kriteria = ambilData("SELECT * FROM kriteria");
                        foreach ($kriteria as $k) :
                            $arraykriteria[] = $k['id_kriteria'];
                            ?>
                            <th class="text-center"><?= $k['nama_kriteria'] ?></th>
                        <?php endforeach; ?>
                        <th class="text-center">Aksi</th>
                    </tr>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $d) : ?>
                        <tr>
                            <td class="text-center"><?= $d['kepala_keluarga'] ?></td>

                            <?php foreach ($arraykriteria as $ak) :
                                    $query = "SELECT sub_kriteria.nama_sub FROM nilai INNER JOIN sub_kriteria USING(id_sub_kriteria) INNER JOIN kriteria USING(id_kriteria) WHERE nilai.nik = {$d['nik']} AND 
                                                kriteria.id_kriteria = {$ak}";

                                    $nilai = ambilData($query);
                                    if (count($nilai)) :
                                        ?>
                                    <td class="text-center"><?= $nilai[0]['nama_sub'] ?></td>
                                <?php else : ?>
                                    <td class="text-center">Belum Diisi</td>
                                <?php endif; ?>

                            <?php endforeach; ?>

                            <td class="text-center">
                                <button class="btn btn-success" data-id="<?= $d['nik'] ?>" onclick="editNilai($(this).data('id'))" data-toggle="modal" data-target="#exampleModalCenter">
                                    <i class="fa fa-pen"></i>
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
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Nilai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="nik" id="nik">
                        <?php foreach ($kriteria as $k) :
                            $nama = makeId($k['nama_kriteria']);
                            ?>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label><?= $k['nama_kriteria'] ?></label>
                                    <select name="<?= $nama ?>" class="form-control" id="<?= $nama ?>">
                                        <option value="0">- Belum Memilih - </option>
                                        <?php
                                            $subkriteria = ambilData("SELECT * FROM sub_kriteria WHERE id_kriteria = {$k['id_kriteria']}");
                                            foreach ($subkriteria as $s) :
                                                ?>
                                            <option value="<?= $s['id_sub_kriteria'] ?>"><?= $s['nama_sub'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        <?php endforeach; ?>




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