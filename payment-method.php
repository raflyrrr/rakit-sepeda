<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
	header('location:login.php');
} else {
	if (isset($_POST['submit'])) {

		mysqli_query($con, "update orders set 	paymentMethod='" . $_POST['paymethod'] . "' where userId='" . $_SESSION['id'] . "' and paymentMethod is null ");
		unset($_SESSION['cart']);
		header('location:order-history.php');
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

		<title>Rakitsepedayuk</title>
		<link rel="stylesheet" href="assets/css/style.css">
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">


	</head>

	<body class="cnt-home">


		<header class="header-style-1">
			<?php include('includes/top-header.php'); ?>
		</header>

		<div class="body-content outer-top-bd">
			<div class="container">
				<div class="checkout-box faq-page inner-bottom-sm">
					<div class="row mt-4">
						<div class="col-md-12">
							<h2>Metode Pembayaran</h2>
							<!-- checkout-step-01  -->


							<!-- panel-body  -->
							<div class="panel-body">
								<div class="mt-4">
									Untuk pembayaran silahkan dapat transfer di rekening dibawah ini :
									<br>
									<br>
									<img src="assets/images/bca.svg" width="80px" class="me-3">Bank BCA
									<br>
									<p class="mt-2">No. Rekening 0123-123-123-123 atas nama <span class="norek">Rakitsepedayuk</span></p>
								</div>
								<form name="payment" method="post">
									<input type="radio" name="paymethod" value="Debit / Credit card" checked> Debit / Credit card <br /><br />
									<input type="submit" value="Submit" name="submit" class="btn btn-primary">
								</form>
							</div>
							<!-- panel-body  -->

							<!-- checkout-step-01  -->


						</div>
					</div><!-- /.row -->
				</div><!-- /.checkout-box -->
			</div><!-- /.container -->
		</div><!-- /.body-content -->
		<?php include('includes/footer.php'); ?>

		<script src="assets/js/jquery-1.11.1.min.js"></script>
		<script src="assets/js/scripts.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

	</body>

	</html>
<?php } ?>