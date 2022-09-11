<?php
$data = ambilData("SELECT * FROM karyawan");
if (isset($_POST["submit"])) {

    if (editKaryawan($_POST) > 0) {
        echo "<script>
        Swal.fire({
            position: 'center',
            type: 'success',
            title: 'Data berhasil dirubah',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            document.location.href = 'index.php?page=karyawan'
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
            document.location.href = 'index.php?page=karyawan'
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
                    <h1 class="m-0 text-dark">Karyawan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Karyawan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">


            <?php if ($role == 1) { ?>
                <a href="?page=tambahkaryawan"><button class="btn btn-info mb-4 btn-block">Tambah Karyawan</button></a>
                <a href="?page=uploadabsensi">
                    <button class="btn btn-warning mb-4 btn">Upload Excel</button>
                </a>
            <?php } else if ($role == 3) { ?>
                <a href="cetak/cetakkaryawan.php" target="_blank"><button class="btn btn-info mb-4 btn-block"><i class="fa fa-print"></i></button></a>
            <?php } ?>




            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">NIP</th>
                        <th class="text-center">Nama Karyawan</th>
                        <th class="text-center">JK</th>
                        <th class="text-center">Alamat</th>
                        <th class="text-center">Jabatan</th>
                        <th class="text-center">Divisi</th>
                        <th class="text-center">Absensi</th>
                        <?php if ($role == 1) : ?>
                            <th class="text-center">Aksi</th>
                        <?php endif; ?>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach ($data as $d) : ?>
                        <tr>
                            <td class="text-center"><?= ++$no; ?></td>
                            <td class="text-center"><?= $d["nip"] ?></td>
                            <td class="text-center"><?= $d["nama"] ?></td>
                            <td class="text-center"><?= $d["jk"] ?></td>
                            <td class="text-center"><?= $d["alamat"] ?></td>
                            <td class="text-center"><?= $d["jabatan"] ?></td>
                            <td class="text-center"><?= $d["divisi"] ?></td>
                            <td class="text-center">
                                <a href="?page=lihatabsensi&id=<?= $d['nip'] ?>">
                                    <button class="btn btn-danger">Lihat</button>
                                </a>
                            </td>
                            <?php if ($role == 1) : ?>
                                <td class="text-center">
                                    <button class="btn btn-success" data-toggle="modal" data-id="<?= $d['id_karyawan'] ?>" data-target="#exampleModalCenter" onclick="editKaryawan($(this).data('id'))"><i class="fas fa-pen"></i></button>
                                    | <button class="btn btn-danger" data-id="<?= $d['id_karyawan'] ?>" onclick="hapusData($(this).data('id'),'ajax/hapus/hapuskaryawan.php','karyawan')"><i class="fas fa-trash"></i></button>
                                </td>
                            <?php endif; ?>

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
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Karyawant</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" method="post" action="" id="formkriteria" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" id="idkaryawan" name="idkaryawan">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- text input -->
                            <div class="form-group">
                                <label class="col-form-label" for="nip"> NIP</label>
                                <input type="text" class="form-control " id="nip" name="nip" placeholder="Masukan NIP Karyawan" autocomplete="off">

                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-form-label" for="nama"> Nama Karyawan</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama Karyawan" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-form-label" for="presentase"> Divisi </label>
                                <select name="divisi" id="divisi" class="form-control">
                                    <option value="0">- Pilih Divisi -</option>
                                    <option value="Karyawan Tetap">Karyawan Tetap</option>
                                    <option value="Karyawan Kontrak">Karyawan Kontrak</option>
                                    <option value="Karyawan Honorer">Karyawan Honorer</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-form-label" for="jk"> Jenis Kelamin </label>
                                <select name="jk" id="jk" class="form-control">
                                    <option value="0">- Pilih Jenis Kelamin -</option>
                                    <option value="Laki-laki">Laki - laki</option>
                                    <option value="Wanita">Wanita</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-form-label" for="jabatan"> Jabatan</label>
                                <select name="jabatan" id="jabatan" class="form-control">
                                    <option value="0">- Pilih Jabatan -</option>
                                    <option value="Desainer">Desainer</option>
                                    <option value="Pemsaran">Desanier</option>
                                    <option value="Keuangan">Keuangan</option>
                                    <option value="Produksi">Produksi</option>
                                    <option value="Produksi">Kasir</option>
                                    <option value="Produksi">Keamanan</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-form-label" for="alamat"> Alamat </label>
                                <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="10"></textarea>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <hr>
                                <p>*Kosongkan jika tidak ingin mengganti password</p>
                                <label class="col-form-label" for="password"> Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Masukan Password" autocomplete="off">
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