<?php
$data = ambilData("SELECT * FROM produk");


if (isset($_POST['submit'])) {

    if (tambahNilai($_POST) > 0) {
        echo "<script>
                Swal.fire({
                    position: 'center',
                    icon: 'success',
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
                    icon: 'error',
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


<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Nilai</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="index.php">Dashboard</a></div>
                <div class="breadcrumb-item">Nilai</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="mytable" class="table table-bordered table-md">
                                    <thead>
                                        <tr>
                                        <tr>
                                            <th class="text-center">Nama Produk</th>
                                            <?php
                                            $arraykriteria = [];
                                            $kriteria = ambilData("SELECT * FROM kriteria");
                                            foreach ($kriteria as $k) :
                                                $arraykriteria[] = $k['id_kriteria'];
                                                ?>
                                                <th class="text-center"><?= $k['nama'] ?></th>
                                            <?php endforeach; ?>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data as $d) : ?>
                                            <tr>
                                                <td class="text-center"><?= $d['nama'] ?></td>

                                                <?php foreach ($arraykriteria as $ak) :
                                                        $query = "SELECT sub_kriteria.nama_sub FROM nilai INNER JOIN sub_kriteria USING(id_sub_kriteria) INNER JOIN kriteria USING(id_kriteria) WHERE nilai.id_produk = {$d['id_produk']} AND 
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
                                                    <button class="btn btn-success" data-id="<?= $d['id_produk'] ?>" onclick="editNilai($(this).data('id'))" data-toggle="modal" data-target="#exampleModalCenter">
                                                        <i class="fa fa-pen"></i>
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Nilai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="idproduk" id="idproduk">
                            <?php foreach ($kriteria as $k) :
                                $nama = makeId($k['nama']);

                                ?>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label><?= $k['nama'] ?></label>
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

</div>