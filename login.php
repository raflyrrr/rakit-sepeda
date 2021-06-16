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
}
// Code for User login
if (isset($_POST['login'])) {
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' and password='$password'");
	$num = mysqli_fetch_array($query);
	if ($num > 0) {
		$extra = "index.php";
		$_SESSION['login'] = $_POST['email'];
		$_SESSION['id'] = $num['id'];
		$_SESSION['username'] = $num['name'];
		$uip = $_SERVER['REMOTE_ADDR'];
		$status = 1;
		$log = mysqli_query($con, "insert into userlog(userEmail,userip,status) values('" . $_SESSION['login'] . "','$uip','$status')");
		$host = $_SERVER['HTTP_HOST'];
		$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		header("location:http://$host$uri/$extra");
		exit();
	} else {
		$extra = "login.php";
		$email = $_POST['email'];
		$uip = $_SERVER['REMOTE_ADDR'];
		$status = 0;
		$log = mysqli_query($con, "insert into userlog(userEmail,userip,status) values('$email','$uip','$status')");
		$host  = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		header("location:http://$host$uri/$extra");
		$_SESSION['errmsg'] = "Id atau Password yang anda masukkan salah!";
		exit();
	}
}


?>


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

	<title>Rakitsepedayuk | Log In</title>

	<!-- Bootstrap Core CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">

	<!-- Fonts -->
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">



</head>

<body>



	<header class="header-style-1">

		<?php include('includes/top-header.php'); ?>

	</header>
	<div class="container">
		<div class="row">
			<!-- Sign-in -->
			<div class="col-md-6 col-sm-6 mt-4 sign-in">
				<h4>Log In</h4>
				<br>
				<form method="post">
					<span style="color:red;">
						<?php
						echo htmlentities($_SESSION['errmsg']);
						?>
						<?php
						echo htmlentities($_SESSION['errmsg'] = "");
						?>
					</span>
					<div class="form-group">
						<label class="info-title" for="exampleInputEmail1">Email Address</label>
						<input type="email" name="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1">
					</div>
					<div class="form-group mt-2">
						<label class="info-title" for="exampleInputPassword1">Password</label>
						<input type="password" name="password" class="form-control unicase-form-control text-input" id="exampleInputPassword1">
					</div>
					<button type="submit" class="btn btn-primary mt-3 btn-login" name="login">Login</button>
				</form>
			</div>
		</div><!-- /.row -->
	</div>
	<?php include('includes/footer.php'); ?>



</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</html>