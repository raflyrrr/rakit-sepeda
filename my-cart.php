<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (isset($_POST['submit'])) {
	if (!empty($_SESSION['cart'])) {
		foreach ($_POST['quantity'] as $key => $val) {
			if ($val == 0) {
				unset($_SESSION['cart'][$key]);
			} else {
				$_SESSION['cart'][$key]['quantity'] = $val;
			}
		}
	}
}
// Code for Remove a Product from Cart
if (isset($_POST['remove_code'])) {

	if (!empty($_SESSION['cart'])) {
		foreach ($_POST['remove_code'] as $key) {

			unset($_SESSION['cart'][$key]);
		}
		echo "<script>alert('Keranjang berhasil diupdate');</script>";
	}
}
// code for insert product in order table

if (isset($_POST['ordersubmit'])) {

	if (strlen($_SESSION['login']) == 0) {
		header('location:login.php');
	} else {

		$quantity = $_POST['quantity'];
		$pdd = $_SESSION['pid'];
		$value = array_combine($pdd, $quantity);


		foreach ($value as $qty => $val34) {



			mysqli_query($con, "insert into orders(userId,productId,quantity) values('" . $_SESSION['id'] . "','$qty','$val34')");
			header('location:payment-method.php');
		}
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

	<title>Keranjang Saya</title>
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">


</head>

<body class="cnt-home">



	<!-- ============================================== HEADER ============================================== -->
	<header>
		<?php include('includes/top-header.php'); ?>
	</header>
	<!-- ============================================== HEADER : END ============================================== -->
	<div class="body-content outer-top-xs">
		<div class="container">
			<div class="row inner-bottom-sm">
				<div class="shopping-cart">
					<div class="col-md-12 col-sm-12 mt-4 shopping-cart-table">
						<div class="table-responsive">
							<form name="cart" method="post">
								<?php
								if (!empty($_SESSION['cart'])) {
								?>
									<table class="table table-bordered">
										<thead>
											<tr>
												<th class="cart-romove item">Hapus</th>
												<th class="cart-description item">Gambar</th>
												<th class="cart-product-name item">Nama Produk</th>
												<th class="cart-qty item">Jumlah</th>
												<th class="cart-total last-item">Total Harga</th>
											</tr>
										</thead><!-- /thead -->
										<tfoot>
											<tr>
												<td colspan="6">
													<div class="shopping-cart-btn">
														<span class="">
															<a href="index.php" class="btn btn-primary login">Lanjutkan Belanja</a>
															<button type="submit" name="ordersubmit" class="btn btn-success pull-right">Checkout</button>
															<input type="submit" name="submit" value="Update Keranjang" class="btn btn-primary pull-right me-2">
														</span>
													</div><!-- /.shopping-cart-btn -->
												</td>
											</tr>
										</tfoot>
										<tbody>
											<?php
											$pdtid = array();
											$sql = "SELECT * FROM products WHERE id IN(";
											foreach ($_SESSION['cart'] as $id => $value) {
												$sql .= $id . ",";
											}
											$sql = substr($sql, 0, -1) . ") ORDER BY id ASC";
											$query = mysqli_query($con, $sql);
											$totalprice = 0;
											$totalqunty = 0;
											if (!empty($query)) {
												while ($row = mysqli_fetch_array($query)) {
													$quantity = $_SESSION['cart'][$row['id']]['quantity'];
													$subtotal = $_SESSION['cart'][$row['id']]['quantity'] * $row['productPrice'];
													$totalprice += $subtotal;
													$_SESSION['qnty'] = $totalqunty += $quantity;

													array_push($pdtid, $row['id']);
													//print_r($_SESSION['pid'])=$pdtid;exit;
											?>

													<tr>
														<td class="romove-item"><input type="checkbox" name="remove_code[]" value="<?php echo htmlentities($row['id']); ?>" /></td>
														<td class="cart-image">
															<a class="entry-thumbnail" href="detail.html">
																<img src="admin/productimages/<?php echo $row['id']; ?>/<?php echo $row['productImage1']; ?>" alt="" width="114" height="146">
															</a>
														</td>
														<td class="product-info-cart">
															<h5><a href="product-details.php?pid=<?php echo htmlentities($pd = $row['id']); ?>"><?php echo $row['productName'];

																																													$_SESSION['sid'] = $pd;
																																													?></a></h5>
														</td>
														<td class="cart-product-quantity">
															<div class="quant-input">
																<div class="arrows">
																	<div class="arrow plus gradient"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>
																	<div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
																</div>
																<input type="text" value="<?php echo $_SESSION['cart'][$row['id']]['quantity']; ?>" name="quantity[<?php echo $row['id']; ?>]">

															</div>
														</td>
														<td class="cart-product-grand-total"><span class="cart-grand-total-price"><?php echo "Rp. ". number_format ($_SESSION['cart'][$row['id']]['quantity'] * $row['productPrice']); ?></span></td>
													</tr>

											<?php }
											}
											$_SESSION['pid'] = $pdtid;
											?>

										</tbody><!-- /tbody -->
									</table><!-- /table -->

						</div>
					</div><!-- /.shopping-cart-table -->
					<div class="col-md-4 col-sm-12 cart-shopping-total pull-right">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>

										<div class="cart-grand-total">
											Total Harga : <span class="inner-left-sm"><?php echo $_SESSION['tp'] = number_format($totalprice); ?></span>
										</div>
									</th>
								</tr>
							</thead><!-- /thead -->
						</table>
					<?php } else {
									echo "Keranjang belanja anda kosong.";
								} ?>
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>
	<?php include('includes/footer.php'); ?>


	<script src="assets/js/jquery-1.11.1.min.js"></script>
	<script src="assets/js/scripts.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>