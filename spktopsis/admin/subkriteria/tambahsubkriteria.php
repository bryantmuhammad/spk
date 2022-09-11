<?php

if (isset($_POST['submit'])) {

    $nama       = clearData($_POST['nama']);
    $kriteria   = clearData($_POST['kriteria']);
    $cek = ambilData("SELECT id_sub_kriteria FROM sub_kriteria WHERE nama_sub = '{$nama}' AND id_kriteria = {$kriteria}");

    if (count($cek)) {
        echo "<script>
        Swal.fire({
            position: 'center',
            icon: 'info',
            title: 'Sub Kriteria sudah ada',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            document.location.href = 'index.php?page=tambahsubkriteria'
        })
    </script>";
    } else {
        if (tambahSubKriteria($_POST) > 0) {
            echo "<script>
            Swal.fire({
                position: 'center',
                icon: 'success',
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
                icon: 'error',
                title: 'Data gagal ditambahkan',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                document.location.href = 'index.php?page=tambahsubkriteria'
            })
        </script>";
        }
    }
}
?>


<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Sub Kriteria</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="index.php?page=subkriteria">Sub Kriteria</a></div>
                <div class="breadcrumb-item">Tambah Sub Kriteria</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <form class="" id="formsubkriteria" method="post" action="">
                            <div class="card-body">
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
                                                    <option value="<?= $k['id_kriteria'] ?>"><?= $k['nama'] ?></option>

                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>


                                </div>


                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>