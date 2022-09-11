<?php
require_once "admin/include/function.php";
$tanda = 0;
if (isset($_POST['submit'])) {
    $nama       = $_POST['nama'];
    $email      = $_POST['email'];
    $password   = $_POST['password'];
    $jk         = $_POST['jk'];
    $alamat     = $_POST['alamat'];




    $cek = ambilData("SELECT * FROM customer WHERE email = '{$email}'");
    if (count($cek)) {
        $tanda = 2;
    } else {
        $cek = ambilData("SELECT * FROM admin WHERE email = '{$email}'");
        if (count($cek)) {
            $tanda = 2;
        } else {
            $password       = password_hash($password, PASSWORD_BCRYPT);
            $query = "INSERT INTO customer VALUES('','{$nama}','{$jk}','{$alamat}','{$email}','{$password}')";

            mysqli_query($koneksi, $query);

            $tanda = 1;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Daftar Customer 40% Cofee</title>

    <!-- General CSS Files -->
    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">



    <!-- Template CSS -->
    <link rel="stylesheet" href="admin/assets/css/style.css">
    <link rel="stylesheet" href="admin/assets/css/components.css">

</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">


                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Daftar Akun</h4>
                            </div>

                            <div class="card-body">
                                <form method="POST" action="">
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <?php if ($tanda == 1) { ?>
                                                <div class="alert alert-success" role="alert">
                                                    <h4 class="alert-heading">Akun berhasil didaftarkan!</h4>
                                                </div>
                                            <?php } else if ($tanda == 2) { ?>
                                                <div class="alert alert-danger" role="alert">
                                                    <h4 class="alert-heading">Email sudah digunakan!</h4>
                                                    <hr>
                                                    <p class="mb-0">Gunakan email lain untuk mendaftar.</p>
                                                </div>
                                            <?php } ?>

                                            <label for="nama">Nama</label>
                                            <input id="nama" type="text" class="form-control" name="nama" autofocus required>
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="email">Email</label>
                                            <input id="email" type="email" class="form-control" name="email" required>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label for="password" class="d-block">Password</label>
                                            <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password" required>
                                            <div id="pwindicator" class="pwindicator">
                                                <div class="bar"></div>
                                                <div class="label"></div>
                                            </div>
                                        </div>
                                        <div class="form-group col-12">
                                            <label>JK</label>
                                            <select class="form-control selectric" name="jk" required>
                                                <option value="Laki - Laki">Laki - Laki</option>
                                                <option value="Wanita">Wanita</option>

                                            </select>
                                        </div>
                                        <div class="form-group col-12">
                                            <label>Alamat</label>
                                            <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="10" required></textarea>
                                            <a href="index.php">Login</a>
                                        </div>

                                    </div>



                                    <div class="form-group">
                                        <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">
                                            Daftar Akun
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="simple-footer">
                            Copyright &copy; Admin 40% Coffee
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="../assets/js/stisla.js"></script>

    <script src="admin/assets/js/scripts.js"></script>
    <script src="admin/assets/js/custom.js"></script>

</body>

</html>