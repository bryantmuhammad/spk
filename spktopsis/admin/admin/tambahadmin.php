<?php

if (isset($_POST['submit'])) {

    $email = $_POST['email'];
    $cekEmailCustomer = ambilData("SELECT id_customer FROM customer WHERE email = '{$email}'");

    if (count($cekEmailCustomer)) {
        echo "<script>
        Swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'Email Sudah Digunakan',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            document.location.href = 'index.php?page=tambahadmin'
        })
    </script>";
    } else {
        $cekEmailAdmin = ambilData("SELECT id_admin FROM admin WHERE email = '{$email}'");
        if (count($cekEmailAdmin)) {
            echo "<script>
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'Email Sudah Digunakan',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                document.location.href = 'index.php?page=tambahadmin'
            })
        </script>";
        } else {

            if (tambahAdmin($_POST) > 0) {
                echo "<script>
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Data berhasil ditambahkan',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        document.location.href = 'index.php?page=tambahadmin'
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
                        document.location.href = 'index.php?page=tambahadmin'
                    })
                </script>";
            }
        }
    }
}
?>


<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Admin</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="index.php?page=admin">Admin</a></div>
                <div class="breadcrumb-item">Tambah Admin</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <form class="" id="formadmin" method="post" action="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Nama Admin</label>
                                            <input type="text" name="nama" id="nama" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Email Admin</label>
                                            <input type="email" name="email" id="email" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" name="password" id="password" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>JK</label>
                                            <select name="jk" id="jk" class="form-control">
                                                <option value="Laki - Laki">Laki - laki</option>
                                                <option value="Wanita">Wanita</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Jabatan</label>
                                            <select name="jabatan" id="jabatan" class="form-control">
                                                <option value="1">Admin</option>
                                                <option value="2">Owner</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="10"></textarea>
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