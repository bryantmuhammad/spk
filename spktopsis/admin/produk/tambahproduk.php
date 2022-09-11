<?php

if (isset($_POST['submit'])) {


    $nama = clearData($_POST['nama']);
    $cek = ambilData("SELECT * FROM produk WHERE nama = '{$nama}'");

    if (count($cek)) {
        echo "<script>
        Swal.fire({
            position: 'center',
            icon: 'info',
            title: 'Produk sudah ada',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            document.location.href = 'index.php?page=tambahproduk'
        })
    </script>";
    } else {
        if (tambahProduk($_POST) > 0) {
            echo "<script>
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Data berhasil ditambahkan',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    document.location.href = 'index.php?page=tambahproduk'
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
                    document.location.href = 'index.php?page=tambahproduk'
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
            <h1>Tambah Produk</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="index.php?page=produk">Produk</a></div>
                <div class="breadcrumb-item">Tambah Produk</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <form class="" id="formproduk" method="post" action="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Nama Produk</label>
                                            <input type="text" name="nama" id="nama" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Harga Produk</label>
                                            <input type="number" min="1" name="harga" id="harga" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Deskripsi</label>
                                            <textarea name="deskripsi" id="deskripsi" class="form-control" cols="30" rows="10"></textarea>
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