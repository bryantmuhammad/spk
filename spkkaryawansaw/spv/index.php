<?php
$data = ambilData("SELECT * FROM spv");
if (isset($_POST["submit"])) {

    if (editSpv($_POST) > 0) {
        echo "<script>
        Swal.fire({
            position: 'center',
            type: 'success',
            title: 'Data berhasil dirubah',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            document.location.href = 'index.php?page=spv'
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
            document.location.href = 'index.php?page=spv'
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
                    <h1 class="m-0 text-dark">SPV</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">SPV</li>
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
                <a href="?page=tambahspv"><button class="btn btn-info mb-4 btn-block">Tambah SPV</button></a>
            <?php } else if ($role == 3) { ?>
                <a href="cetak/cetakspv.php" target="_blank"><button class="btn btn-info mb-4 btn-block"><i class="fa fa-print"></i></button></a>
            <?php } ?>
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">NIP</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Jabatan</th>
                        <th class="text-center">Username</th>
                        <th class="text-center">Divisi</th>
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
                            <td class="text-center"><?= $d["jabatan"] ?></td>
                            <td class="text-center"><?= $d["username"] ?></td>
                            <td class="text-center"><?= $d["divisi"] ?></td>
                            <?php if ($role == 1) : ?>
                                <td class="text-center">
                                    <button class="btn btn-success" data-toggle="modal" data-id="<?= $d['id_spv'] ?>" data-target="#exampleModalCenter" onclick="editSpv($(this).data('id'))"><i class="fas fa-pen"></i></button>
                                    | <button class="btn btn-danger" data-id="<?= $d['id_spv'] ?>" onclick="hapusData($(this).data('id'),'ajax/hapus/hapusspv.php','kri')"><i class="fas fa-trash"></i></button>
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
                <h5 class="modal-title" id="exampleModalLongTitle">Edit SPV</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" method="post" action="" id="formspv" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" id="idspv" name="idspv">
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
                                <label class="col-form-label" for="username"> Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Masukan Username" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-form-label" for="jabatan"> Jabatan</label>
                                <select name="jabatan" id="jabatan" class="form-control">
                                    <option value="0">- Pilih Jabatan -</option>
                                    <option value="Desainer">Desainer</option>
                                    <option value="Pemasaran">Pemasaran</option>
                                    <option value="Keuangan">Keuangan</option>
                                    <option value="Produksi">Produksi</option>
                                    <option value="Produksi">Kasir</option>
                                    <option value="Produksi">Keamanan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-form-label" for="divisi"> Divis</label>
                                <select name="divisi" id="divisi" class="form-control">
                                    <option value="0">- Pilih Divisi -</option>
                                    <option value="Marketing Manager">Marketing Manager</option>
                                    <option value="PPIC Manager">PPIC Manager</option>
                                    <option value="Operational Manager">Operational Manager</option>
                                    <option value="Accounting Manager">Accounting Manager</option>
                                </select>
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