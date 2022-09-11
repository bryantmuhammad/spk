<?php
require_once "admin/include/function.php";


$error = 0;

if (isset($_POST['email'])) {
    $email      = $_POST['email'];
    $password   = $_POST['password'];
    $captcha    = $_POST['g-recaptcha-response'];
    $cek_captcha = cekCaptcha($captcha);


    if ($cek_captcha) {

        $cek = ambilData("SELECT * FROM admin WHERE email = '{$email}'");
        if ($cek) {
            $cek = $cek[0];
            if (password_verify($password, $cek['password'])) {

                $_SESSION['login'] = true;
                $_SESSION['user'] = $cek['id_admin'];
                echo "<script>document.location.href='admin/index.php'</script>";
                die;
            } else {
                $error = 1;
            }
        }

        $cek = ambilData("SELECT * FROM customer WHERE email = '{$email}'");


        if ($cek) {
            $cek = $cek[0];
            if (password_verify($password, $cek['password'])) {
                $_SESSION['login']  = true;
                $_SESSION['customer'] = true;
                $_SESSION['user']   = $cek['id_customer'];
                echo "<script>document.location.href='admin/index.php'</script>";
                die;
            } else {
                $error = 1;
            }
        }

        $error = 1;
    } else {
        $error = 2;
    }
}



function cekCaptcha($response)
{
    $secret     = '6LdxD0MeAAAAACgFJhhiquxC5pCJTX2JVneAlqt0';
    $credential = array(
        'secret' => $secret,
        'response' => $response
    );


    $verify = curl_init();
    curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
    curl_setopt($verify, CURLOPT_POST, true);
    curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($credential));
    curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($verify);

    $status = json_decode($response, true);
    return $status['success'];
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login 40% Cofee SPK</title>

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
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                            <!-- <img src="assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle"> -->
                        </div>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Login 40% Coffee</h4>
                            </div>

                            <div class="card-body">
                                <form method="POST" action="" class="needs-validation" novalidate="">
                                    <div class="form-group">
                                        <?php if ($error) : ?>
                                            <?php if ($error == 1) : ?>
                                                <div class="alert alert-danger" role="alert">
                                                    <h4 class="alert-heading">Login Gagal!</h4>
                                                    <p>Email / Password Salah.</p>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($error == 2) : ?>
                                                <div class="alert alert-danger" role="alert">
                                                    <h4 class="alert-heading">Login Gagal!</h4>
                                                    <p>Captcha Salah.</p>
                                                </div>
                                            <?php endif; ?>

                                        <?php endif; ?>
                                        <label for="email">Email</label>
                                        <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                                        <div class="invalid-feedback">
                                            Please fill in your email
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password" class="control-label">Password</label>
                                            <!-- <div class="float-right">
                                                <a href="auth-forgot-password.html" class="text-small">
                                                    Forgot Password?
                                                </a>
                                            </div> -->
                                        </div>
                                        <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                                        <div class="invalid-feedback">
                                            please fill in your password
                                        </div>
                                        <a href="daftar.php">Daftar Akun</a>
                                    </div>

                                    <div class="form-group">
                                        <div class="g-recaptcha" data-sitekey="6LdxD0MeAAAAAHEOhyCcNZmKMJUD9V9Xblspz6CA" data-callback="enableBtn"></div>
                                    </div>


                                    <div class="form-group">
                                        <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Login
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
    <script src="assets/js/stisla.js"></script>

    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="admin/assets/js/scripts.js"></script>
    <script src="admin/assets/js/custom.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>

    <!-- Page Specific JS File -->
</body>

</html>