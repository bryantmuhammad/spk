<?php
if (isset($_POST["submit"])) {
    if (tambahSpv($_POST) > 0) {
        echo "<script>
        Swal.fire({
            position: 'center',
            type: 'success',
            title: 'Data berhasil ditambahkan',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            document.location.href = 'index.php?page=tambahspv'
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
            document.location.href = 'index.php?page=tambahspv'
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
                    <h1 class="m-0 text-dark">Tambah SPV</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Tambah SPV</li>
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
                <form role="form" method="post" action="" id="formspv" enctype="multipart/form-data">
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
                                <label class="col-form-label" for="username"> Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Masukan Username" autocomplete="off">
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
                    </div>
            </div>


            <button name="submit" type="submit" class="btn btn-primary btn-block">Tambah SPV</button>


            </form>
        </div>
        <!-- /.card-body -->
</div>


</div>
</section>
<!-- /.content -->

</div>
<!-- /.content-wrapper -->