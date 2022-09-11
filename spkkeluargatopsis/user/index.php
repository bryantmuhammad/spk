<?php
$data = ambilData("SELECT * FROM users");


if (isset($_POST['submit'])) {

    if (editUser($_POST) > 0) {
        echo "<script>
                Swal.fire({
                    position: 'center',
                    type: 'success',
                    title: 'Data berhasil dirubah',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    document.location.href = 'index.php?page=user'
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
                    document.location.href = 'index.php?page=user'
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
                    <h1 class="m-0 text-dark">User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">User</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <a href="index.php?page=tambahuser"><button class="btn btn-primary mb-4 btn-block">Tambah User</button></a>

            <table id="mytable" class="table table-bordered table-md">
                <thead>

                    <tr>
                        <th class="text-center">Username</th>

                        <th class="text-center">Nama</th>
                        <th class="text-center">Hak Akses</th>
                        <th class="text-center">Action</th>
                    </tr>

                </thead>
                <tbody>
                    <?php foreach ($data as $d) :

                        $hak = 'Admin';
                        if ($d['hak_akses'] == 2) $hak = 'Kepala Desa';
                        ?>
                        <tr>
                            <td class="text-center"><?= $d['username'] ?></td>

                            <td class="text-center"><?= $d['nama'] ?></td>
                            <td class="text-center"><?= $hak ?></td>
                            <td class="text-center">
                                <button class="btn btn-success" data-id="<?= $d['username'] ?>" onclick="editUsers($(this).data('id'))" data-toggle="modal" data-target="#exampleModalCenter">
                                    <i class="fa fa-pen"></i>
                                </button>
                                <button class="btn btn-danger" data-id="<?= $d['username'] ?>" onclick="hapusData($(this).data('id'),'user/ajax/hapususer.php','user')">
                                    <i class="fa fa-trash"></i>
                                </button>
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
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" id="username" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Hak Akses</label>
                                <select name="hak" id="hak" class="form-control">
                                    <option value="1">Admin</option>
                                    <option value="2">Kepala Desa</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <hr>
                            <p>*Abaikan jika tidak ingin mengganti password</p>
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




<script>

</script>