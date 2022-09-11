<?php
if (isset($_POST["submit"])) {
    $noSurat = clearData($_POST['nomorsurat']);
    if (cekDuplicate(ambilData("SELECT * FROM surat WHERE nomor_surat = {$noSurat}"))) {
        echo "<script>
        Swal.fire({
            position: 'center',
            type: 'warning',
            title: 'Data sudah ada',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            document.location.href = 'index.php?page=tbs'
        })
        </script>";
    } else {
        if (tambahSurat($_POST) > 0) {
            echo "<script>
        Swal.fire({
            position: 'center',
            type: 'success',
            title: 'Data berhasil ditambahkan',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            document.location.href = 'index.php?page=dts'
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
            document.location.href = 'index.php?page=tbs'
        })
        
        </script>";
        }
    }
}
?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Surat Masuk</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Surat Masuk</li>
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
                <form role="form" method="post" action="" id="formsurat" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label class="col-form-label" for="inputSuccess"> Asal Surat</label>
                                <input type="text" class="form-control " id="asalsurat" name="asalsurat" placeholder="Enter ...">

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label" for="nomorsurat"> Nomor Surat</label>
                                <input type="text" class="form-control" id="nomorsurat" name="nomorsurat" placeholder="Enter ...">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- textarea -->
                            <div class="form-group">
                                <label>Isi Ringkas</label>
                                <textarea class="form-control" rows="3" name="isiringkas" placeholder="Masukan isi surat"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <!-- textarea -->
                            <div class="form-group">
                                <label>Dituju Kepada</label>
                                <input type="text" class="form-control " id="ditujukepada" name="ditujukepada" placeholder="Enter ...">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Jenis Surat</label>
                                <select class="form-control" name="jenis" id="jenis">
                                    <option value="0">- Pilih -</option>
                                    <?php
                                    $dataJenis = ambilData("SELECT * FROM jenis_surat");

                                    foreach ($dataJenis as $d) :
                                    ?>
                                        <option value="<?= $d['id_jenis'] ?>"><?= $d['jenis'] ?></option>
                                    <?php endforeach; ?>

                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Loker</label>
                                <select class="form-control" name="loker" id="loker">
                                    <option value="0">- Pilih -</option>
                                    <?php
                                    $dataLoker = ambilData("SELECT * FROM loker");

                                    foreach ($dataLoker as $d) :
                                    ?>
                                        <option value="<?= $d['id_loker'] ?>"><?= $d['nama_loker'] ?></option>
                                    <?php endforeach; ?>

                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label" for="slide"> Slide</label>
                                <select name="slide" id="slide" class="form-control">
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
                                    <option value="F">F</option>
                                    <option value="G">G</option>
                                    <option value="H">H</option>
                                    <option value="I">I</option>
                                    <option value="J">J</option>
                                    <option value="K">K</option>
                                    <option value="L">L</option>
                                    <option value="M">M</option>
                                    <option value="N">N</option>
                                    <option value="O">O</option>
                                    <option value="P">P</option>
                                    <option value="Q">Q</option>
                                    <option value="R">R</option>
                                    <option value="S">S</option>
                                    <option value="T">T</option>
                                    <option value="U">U</option>
                                    <option value="V">V</option>
                                    <option value="W">W</option>
                                    <option value="X">X</option>
                                    <option value="Y">Y</option>
                                    <option value="Z">Z</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label" for="laci"> Laci</label>
                                <select name="laci" id="laci" class="form-control">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <!-- textarea -->
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control" rows="3" name="keterangan" placeholder="Keterangan...."></textarea>
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label class="col-form-label" for="tanggalmasuk"> Tanggal Awal Berlaku</label>
                                <input type="date" class="form-control" id="tanggalmasuk" name="tanggalmasuk">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label" for="tanggalexp"> Tanggal Akhir Berlaku</label>
                                <input type="date" class="form-control" id="tanggalexp" name="tanggalexp">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-form-label" for="tanggalexp"> Akan Dimusnahkan Pada</label>
                                <input type="date" class="form-control" id="dimusnahkan" name="dimusnahkan">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-form-label" for="tanggalexp"> Gambar Surat(scan)</label>
                                <p class="text-danger" style="font-size:12px;">*pdf</p>
                                <input type="file" class="form-control" id="gambar" name="gambar" required>
                                <!-- <img src="" alt="" id="preview" class="img-thumbnail mt-4" height="200" width="250"> -->
                            </div>
                        </div>



                    </div>


                    <button name="submit" type="submit" class="btn btn-primary btn-block">Tambah Surat</button>


                </form>
            </div>
            <!-- /.card-body -->
        </div>


</div>
</section>
<!-- /.content -->

</div>
<!-- /.content-wrapper -->