<?php
session_start();
error_reporting(0);
include('includes/config.php');
// Code user Registration
if (isset($_POST['submit'])) {
    $name = $_POST['fullname'];
    $email = $_POST['emailid'];
    $contactno = $_POST['contactno'];
    $password = md5($_POST['password']);
    $query = mysqli_query($con, "insert into users(name,email,contactno,password) values('$name','$email','$contactno','$password')");
    if ($query) {
        echo "<script>alert('Berhasil mendaftar akun');</script>";
    } else {
        echo "<script>alert('Tidak berhasil mendaftar akun');</script>";
    }
} ?>

<!DOCTYPE html>
<html lang="en">


<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="eCommerce,Rakitsepeda">
    <meta name="robots" content="all">

    <title>Rakitsepedayuk | Register</title>

    <!-- Bootstrap Core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script type="text/javascript">
        function valid() {
            if (document.register.password.value != document.register.confirmpassword.value) {
                alert("Password dan Konfirmasi password harus sama");
                document.register.confirmpassword.focus();
                return false;
            }
            return true;
        }
    </script>
    <script>
        function userAvailability() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "check_availability.php",
                data: 'email=' + $("#email").val(),
                type: "POST",
                success: function(data) {
                    $("#user-availability-status1").html(data);
                    $("#loaderIcon").hide();
                },
                error: function() {}
            });
        }
    </script>


</head>

<body>

    <header>
        <?php include('includes/top-header.php'); ?>

    <div class="container">
        <div class="row">

            <!-- create a new account -->
            <div class="col-md-6 col-sm-6 mt-4 create-new-account">
                <h4 class="checkout-subtitle">Daftar akun baru</h4>
                <form class="register-form outer-top-xs" role="form" method="post" name="register" onSubmit="return valid();">
                    <div class="form-group mt-3">
                        <label class="info-title" for="fullname">Nama Lengkap</label>
                        <input type="text" class="form-control unicase-form-control text-input" id="fullname" name="fullname" required="required">
                    </div>


                    <div class="form-group mt-3">
                        <label class="info-title" for="exampleInputEmail2">Email Address</label>
                        <input type="email" class="form-control unicase-form-control text-input" id="email" onBlur="userAvailability()" name="emailid" required>
                        <span id="user-availability-status1" style="font-size:12px;"></span>
                    </div>

                    <div class="form-group mt-3">
                        <label class="info-title" for="contactno">Contact No</label>
                        <input type="text" class="form-control unicase-form-control text-input" id="contactno" name="contactno" maxlength="10" required>
                    </div>

                    <div class="form-group mt-3">
                        <label class="info-title" for="password">Password</label>
                        <input type="password" class="form-control unicase-form-control text-input" id="password" name="password" required>
                    </div>

                    <div class="form-group mt-3">
                        <label class="info-title" for="confirmpassword">Konfirmasi Password</label>
                        <input type="password" class="form-control unicase-form-control text-input" id="confirmpassword" name="confirmpassword" required>
                    </div>


                    <button type="submit" name="submit" class="btn btn-primary mt-3 btn-login" id="submit">Daftar</button>
                </form>
            </div>
            <!-- create a new account -->
        </div>
    </div>
    <?php include ('includes/footer.php')?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</html>