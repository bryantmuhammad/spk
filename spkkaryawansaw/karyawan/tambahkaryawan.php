<?php
if (isset($_POST["submit"])) {
    if (tambahKaryawan($_POST) > 0) {
        echo "<script>
        Swal.fire({
            position: 'center',
            type: 'success',
            title: 'Data berhasil ditambahkan',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            document.location.href = 'index.php?page=tambahkaryawan'
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
            document.location.href = 'index.php?page=tambahkaryawan'
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
                    <h1 class="m-0 text-dark">Tambah Karyawan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Karyawan</li>
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
                <form role="form" method="post" action="" id="formkriteria" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label class="col-form-label" for="nip"> NIP</label>
                                <input type="text" class="form-control " id="nip" name="nip" placeholder="Masukan NIP Karyawan" autocomplete="off">

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label" for="nama"> Nama Karyawan</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama Karyawan" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-sm-6">
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

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label" for="jk"> Jenis Kelamin </label>
                                <select name="jk" id="jk" class="form-control">
                                    <option value="0">- Pilih Jenis Kelamin -</option>
                                    <option value="Laki-laki">Laki - laki</option>
                                    <option value="Wanita">Wanita</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
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
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label" for="password"> Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Masukan Password" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-form-label" for="alamat"> Alamat </label>
                                <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
            </div>


            <button name="submit" type="submit" class="btn btn-primary btn-block">Tambah Karyawan</button>


            </form>
        </div>
        <!-- /.card-body -->
</div>


</div>
</section>
<!-- /.content -->

</div>
<!-- /.content-wrapper -->