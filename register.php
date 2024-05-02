<?php
session_start();
require 'function/functions.php';
require 'function/loginRegister.php';

// cek cookie dan session
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];
    $result = mysqli_query($koneksi, "SELECT username FROM users WHERE id_user = $id");
    $row = mysqli_fetch_assoc($result);
    if ($key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
    }
}

if (isset($_SESSION["login"])) {
    header("Location: dashboard");
    exit;
} elseif (isset($_COOKIE['login'])) {
    header("Location: dashboard");
    exit;
}

// register
if (isset($_POST['sign-up'])) {
    if (register($_POST) > 0) {
        echo "
    <script>
        swal('Berhasil','Akun anda berhasil didaftarkan!','success');
    </script>
    ";
    } else {
        echo mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags, title, stylesheets, scripts -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aplikasi Manajemen Keuangan - </title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <style>
        .container {
            align-items: center;
            padding-left: 300px;
        }

        body {
            background: rgb(228, 173, 72);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: "roboto", sans-serif;
        }
    </style>
</head>

<body>
    <!-- Signup form HTML code -->

    <body>
        <div class="container">
            <div class="row justify-content-md-center mt-12">
                <div class="col-sm-8 border-box">
                    <div class="row">
                        <div class="col-sm-6 p-0">
                            <div class="card">
                                <div class="card-header">
                                    <div class="signup">
                                        <h4 class="aktif">SIGN UP</h4>
                                    </div>

                                    <div>
                                        <h4> / </h4>
                                    </div>

                                    <div class="login">
                                        <h4>
                                            <a style="text-decoration:none" href="login.php">LOGIN</a>
                                        </h4>
                                    </div>
                                </div>

                                <div class="icon-user">
                                    <h4 class="fa fa-user"> </h4>
                                </div>
                                <div class="card-body">
                                    <form method="POST">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                            </div>
                                            <input type="text" name="email-registrasi" class="form-control" placeholder="Email" autocomplete="off" required>
                                        </div>

                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                            </div>
                                            <input type="text" name="username-registrasi" class="form-control" placeholder="Username" autocomplete="off" required>
                                        </div>

                                        <!-- Bagian Password -->
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                            </div>
                                            <input type="password" name="password-registrasi" id="password-registrasi" class="form-control" placeholder="Password" autocomplete="off" required>
                                            <!-- Tombol ikon untuk melihat/menyembunyikan password -->
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="password-registrasi"><i class="fa fa-eye"></i></button>
                                            </div>
                                        </div>

                                        <!-- Bagian Confirm Password -->
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                            </div>
                                            <input type="password" name="password-confirm" id="password-confirm" class="form-control" placeholder="Confirm password" autocomplete="off" required>
                                            <!-- Tombol ikon untuk melihat/menyembunyikan password -->
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="password-confirm"><i class="fa fa-eye"></i></button>
                                            </div>
                                        </div>

                                        <button type="submit" name="sign-up" class="btn btn-primary">Sign Up</button>

                                    </form>
                                </div>
                            </div>
                            <div class="img"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="js/slidelogin.js"></script>
        <script>
            // Tambahkan event listener untuk tombol ikon
            $(document).ready(function() {
                $('.toggle-password').click(function() {
                    // Ambil target input password yang sesuai
                    var targetId = $(this).data('target');
                    var passwordField = $('#' + targetId);
                    // Ambil ikon
                    var icon = $(this).find('i');

                    // Toggle tampilan password
                    if (passwordField.attr('type') === 'password') {
                        passwordField.attr('type', 'text');
                        // Ubah ikon menjadi ikon mata terbuka
                        icon.removeClass('fa-eye').addClass('fa-eye-slash');
                    } else {
                        passwordField.attr('type', 'password');
                        // Ubah ikon menjadi ikon mata tertutup
                        icon.removeClass('fa-eye-slash').addClass('fa-eye');
                    }
                });
            });
        </script>
    </body>

</html>