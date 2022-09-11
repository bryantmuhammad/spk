<?php
require_once "include/functions.php";
$error = 0;
if (isset($_POST['submit'])) {

    $username = clearData($_POST['username']);
    $password = $_POST['password'];

    $cek = ambilData("SELECT * FROM spv WHERE username = '{$username}'");
    if (count($cek)) {
        if (password_verify($password, $cek[0]['password'])) {
            $_SESSION['login'] = [
                "id" => $cek[0]['id_spv'],
                "role" => 1
            ];
            echo "<script>document.location.href='index.php'</script>";
        }
    }

    $cek = ambilData("SELECT * FROM karyawan WHERE nip = '{$username}'");
    if (count($cek)) {
        if (password_verify($password, $cek[0]['password'])) {
            $_SESSION['login'] = [
                "id" => $cek[0]['id_karyawan'],
                "role" => 2
            ];
            echo "<script>document.location.href='index.php'</script>";
        }
    }


    $cek = ambilData("SELECT * FROM pemilik WHERE username = '{$username}'");
    if (count($cek)) {
        if (password_verify($password, $cek[0]['password'])) {
            $_SESSION['login'] = [
                "id" => $cek[0]['id_pemilik'],
                "role" => 3
            ];
            echo "<script>document.location.href='index.php'</script>";
        }
    }
    $error = 1;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login </title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="assets/login.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

</head>

<body>



    <div class="login-reg-panel">
        <div class="login-info-box">
            <h2>Have an account?</h2>
            <p>Lorem ipsum dolor sit amet</p>
            <label id="label-register" for="log-reg-show">Login</label>
            <input type="radio" name="active-log-panel" id="log-reg-show" checked="checked">
        </div>

        <div class="register-info-box">
            <h2>Selamat Datang Di Halaman Login</h2>
            <p>Bekerja dengan hati</p>

        </div>

        <div class="white-panel">

            <form action="" method="post">
                <div class="login-show">
                    <?php if ($error) : ?>
                        <div class="alert alert-danger" role="alert">
                            Username/Password salah silahkan coba lagi
                        </div>
                    <?php endif; ?>
                    <h2>LOGIN</h2>
                    <input type="text" name="username" id="username" placeholder="Email">
                    <input type="password" name="password" id="password" placeholder="Password">
                    <input type="submit" name="submit" value="Login" class="btn btn-success btn-block">
                    <!-- <a href="">Forgot password?</a> -->
                </div>
            </form>
            <div class="register-show">
                <h2>REGISTER</h2>
                <input type="text" placeholder="Email">
                <input type="password" placeholder="Password">
                <input type="password" placeholder="Confirm Password">
                <input type="button" value="Register">
            </div>
        </div>
    </div>



</body>
<script>
    $(document).ready(function() {
        $('.login-info-box').fadeOut();
        $('.login-show').addClass('show-log-panel');
    });
</script>

</html>