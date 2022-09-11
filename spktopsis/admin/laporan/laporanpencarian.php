<?php

$idcustomer = $_SESSION['user'];

if (isset($_SESSION['customer'])) :
    $data = ambilData("SELECT * FROM laporan_pencarian WHERE laporan_pencarian.id_customer = {$idcustomer} GROUP BY laporan_pencarian.id_laporan_pencarian");
else :
    $data = ambilData("SELECT * FROM laporan_pencarian GROUP BY laporan_pencarian.id_laporan_pencarian");
endif;

if (isset($_POST['submit'])) {

    if (rating($_POST) > 0) {
        echo "<script>
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Berhasil memberi penilaian',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    document.location.href = 'index.php?page=laporanpencarian'
                })
            </script>";
    } else {
        echo "<script>
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Gagal memberi penilaian',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    document.location.href = 'index.php?page=laporanpencarian'
                })
            </script>";
    }
}

?>


<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Laporan Pencarian</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="index.php">Dashboard</a></div>
                <div class="breadcrumb-item">Laporan Pencarian</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="laporan/cetak/pencarian.php" class="btn btn-success" target="_blank">
                                <i class="fa fa-print"></i>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="mytable" class="table table-bordered table-md">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Detail</th>
                                            <th class="text-center">Rating</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no  = 0;
                                        foreach ($data as $d) :
                                            $rating = ambilData("SELECT * FROM rating WHERE id_laporan_pencarian = '{$d['id_laporan_pencarian']}'");


                                            ?>
                                            <tr>
                                                <td class="text-center"><?= ++$no ?></td>
                                                <td class="text-center">
                                                    <a href="index.php?page=detailpencarian&id=<?= $d['id_laporan_pencarian'] ?>">
                                                        <button class="btn btn-success">Detail</button>
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    <?php if (!count($rating)) : ?>
                                                        <?php if (isset($_SESSION['customer'])) : ?>
                                                            <button class="btn btn-primary" data-id="<?= $d['id_laporan_pencarian'] ?>" onclick="rating($(this).data('id'))" data-toggle="modal" data-target="#exampleModalCenter">Beri Penilaian</button>
                                                        <?php else : ?>
                                                            Belum Memberi Penilaian
                                                        <?php endif; ?>

                                                    <?php else : ?>
                                                        <?= $rating[0]['rating'] ?>
                                                    <?php endif; ?>
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



    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Beri Penilaian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post">
                    <input type="hidden" name="idlaporanpencarian" id="idlaporanpencarian">
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Rating</label>
                                    <select name="rating" id="rating" class="form-control">
                                        <option value="Sangat Kurang">Sangat Kurang</option>
                                        <option value="Kurang">Kurang</option>
                                        <option value="Cukup">Cukup</option>
                                        <option value="Baik">Baik</option>
                                        <option value="Sangat Baik">Sangat Baik</option>
                                    </select>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="submit" class="btn btn-primary">Beri Penilaian</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>


<script>
    function rating(idlaporanpencarian) {
        $("#idlaporanpencarian").val(idlaporanpencarian)
    }
</script>