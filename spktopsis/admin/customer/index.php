<?php
$data = ambilData("SELECT * FROM customer");


if (isset($_POST['submit'])) {

    $email              = $_POST['email'];
    $idcustomer            = $_POST['idcustomer'];

    $cekEmailCustomer   = ambilData("SELECT id_customer FROM customer WHERE email = '{$email}' AND id_customer != {$idcustomer}");
    if (count($cekEmailCustomer)) {
        echo "<script>
        Swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'Email Sudah Digunakan',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            document.location.href = 'index.php?page=customer'
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
                document.location.href = 'index.php?page=customer'
            })
        </script>";
        } else {

            if (editCustomer($_POST) > 0) {
                echo "<script>
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Data berhasil dirubah',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            document.location.href = 'index.php?page=customer'
                        })
                    </script>";
            } else {
                echo "<script>
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Data gagal dirubah',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            document.location.href = 'index.php?page=customer'
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
            <h1>Customer</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="index.php">Dashboard</a></div>
                <div class="breadcrumb-item">Customer</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="index.php?page=tambahcustomer">
                                <button class="btn btn-primary float-right">Tambah Customer</button>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="mytable" class="table table-bordered table-md">
                                    <thead>
                                        <tr>
                                        <tr>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">JK</th>
                                            <th class="text-center">Alamat</th>
                                            <th class="text-center">Email</th>

                                            <th class="text-center">Action</th>
                                        </tr>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data as $d) :

                                            ?>
                                            <tr>
                                                <td class="text-center"><?= $d['nama'] ?></td>
                                                <td class="text-center"><?= $d['jk'] ?></td>
                                                <td class="text-center"><?= $d['alamat'] ?></td>
                                                <td class="text-center"><?= $d['email'] ?></td>
                                                <td class="text-center">
                                                    <button class="btn btn-success" data-id="<?= $d['id_customer'] ?>" onclick="editCustomer($(this).data('id'))" data-toggle="modal" data-target="#exampleModalCenter">
                                                        <i class="fa fa-pen"></i>
                                                    </button>
                                                    <button class="btn btn-danger" data-id="<?= $d['id_customer'] ?>" onclick="hapusData($(this).data('id'),'customer/ajax/hapuscustomer.php','customer')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
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




    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="idcustomer" id="idcustomer">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Nama Admin</label>
                                    <input type="text" name="nama" id="nama" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Email Admin</label>
                                    <input type="email" name="email" id="email" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-lg-12">
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
                                    <label>Alamat</label>
                                    <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="10"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <hr>
                                <p>*Abaikan jika tidak ingin mengganti passowrd</p>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" id="password" class="form-control">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>