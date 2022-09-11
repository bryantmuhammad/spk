<?php
$data = ambilData("SELECT surat.file,surat.id_surat,surat.nomor_surat,surat.asal_surat,surat.isi_ringkas,surat.awal_berlaku,surat.akhir_berlaku,loker.nama_loker,jenis_surat.jenis,loker.keterangan_loker,surat.laci,surat.slide,surat.keterangan FROM surat INNER JOIN jenis_surat USING(id_jenis) INNER JOIN loker USING(id_loker)");
if (isset($_POST["submit"])) {
    // $jenis = clearData($_POST['jenissurat']);
    // if (cekDuplicate(ambilData("SELECT * FROM jenis_surat WHERE jenis = '{$jenis}'"))) {
    //     echo "<script>
    //     Swal.fire({
    //         position: 'center',
    //         type: 'warning',
    //         title: 'Data sudah ada',
    //         showConfirmButton: false,
    //         timer: 1500
    //     }).then(() => {
    //         document.location.href = 'index.php?page=jst'
    //     })

    //     </script>";
    // } else {
    if (editSurat($_POST) > 0) {
        echo "<script>
        Swal.fire({
            position: 'center',
            type: 'success',
            title: 'Data berhasil dirubah',
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
            title: 'Data gagal dirubah',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            document.location.href = 'index.php?page=dts'
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
                    <h1 class="m-0 text-dark">Surat</h1>
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

            <a href="index.php?page=tbs"><button class="btn btn-primary mb-4 btn-block">Tambah Surat</button></a>
            <a href="cetak/cetaksurat.php" target="_blank"><button class="btn btn-success mb-2" style="margin-left: auto;"><i class="fa fa-print"></i></button></a>

            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Asal Surat</th>
                        <th class="text-center">No Surat</th>
                        <th class="text-center">Isi Ringkas</th>
                        <th class="text-center">Jenis Surat</th>
                        <th class="text-center">Loker</th>
                        <th class="text-center">Tanggal Surat</th>
                        <th class="text-center">Laci</th>
                        <th class="text-center">Slide</th>
                        <th class="text-center">Keterangan</th>
                        <th class="text-center">surat</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach ($data as $d) : ?>
                        <tr>
                            <td class="text-center"><?= ++$no; ?></td>
                            <td class="text-center"><?= $d["asal_surat"] ?></td>
                            <td class="text-center"><?= $d["nomor_surat"] ?></td>
                            <td class="text-center"><?= $d["isi_ringkas"] ?></td>
                            <td class="text-center"><?= $d["jenis"] ?></td>
                            <td class="text-center" data-toggle="tooltip" data-placement="bottom" title="<?= $d['keterangan_loker'] ?>"><?= $d["nama_loker"] ?></td>
                            <td class="text-center"><?= $d["awal_berlaku"] . " / " . $d["akhir_berlaku"] ?></td>
                            <td class="text-center"><?= $d["laci"] ?></td>
                            <td class="text-center"><?= $d["slide"] ?></td>
                            <td class="text-center"><?= $d["keterangan"] ?></td>
                            <td class="text-center">
                                <button class="btn btn-success" data-target="#modalPdf" data-toggle="modal" onclick="loadPesan($(this).data('id'))" data-id="<?= $d['id_surat'] ?>">Lihat Pesan</button>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-success" data-toggle="modal" data-id="<?= $d['id_surat'] ?>" data-target="#exampleModalCenter" onclick="editSurat($(this).data('id'))"><i class="fas fa-pen"></i></button>
                                | <button class="btn btn-danger" data-id="<?= $d['id_surat'] ?>" onclick="hapusData($(this).data('id'),'ajax/hapussurat.php','dts')"><i class="fas fa-trash"></i></button>

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
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Surat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" method="post" action="" id="formloker" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" id="idsurat" name="idsurat">
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
                                <textarea class="form-control" rows="3" name="isiringkas" id="isiringkas" placeholder="Masukan isi surat"></textarea>
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
                                <textarea class="form-control" rows="3" name="keterangan" id="keterangan" placeholder="Keterangan...."></textarea>
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
                                <input type="file" class="form-control" id="gambar" name="gambar">
                                <!-- <img src="" alt="" id="preview" class="img-thumbnail mt-4" height="200" width="250"> -->
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

<div class="modal fade" id="modalPdf" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Preview Surat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" id="kosong">

            </div>
            <div class="modal-footer">
                <button type="submit" name="submit" class="btn btn-primary">Edit</button>
            </div>

        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>