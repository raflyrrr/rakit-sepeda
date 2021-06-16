<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
	header('location:login.php');
} else {

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



		<header class="header-style-1">
			<?php include('includes/top-header.php'); ?>
		</header>

		<div class="body-content outer-top-xs">
			<div class="container">
				<div class="row inner-bottom-sm">
					<div class="shopping-cart">
						<div class="col-md-12 col-sm-12 shopping-cart-table mt-4">
							<div class="table-responsive">
								<form name="cart" method="post">

									<table class="table table-bordered">
										<thead>
											<tr>
												<th class="cart-romove item">No</th>
												<th class="cart-description item">Gambar</th>
												<th class="cart-product-name item">Nama Produk</th>
												<th class="cart-qty item">Jumlah</th>
												<th class="cart-total item">Total Harga</th>
												<th class="cart-total item">Metode Pembayaran</th>
												<th class="cart-description item">Tanggal Pemesanan</th>
												<th class="cart-total last-item">Status</th>
											</tr>
										</thead><!-- /thead -->

										<tbody>

											<?php $query = mysqli_query($con, "select products.productImage1 as pimg1,products.productName as pname,products.id as proid,orders.productId as opid,orders.quantity as qty,products.productPrice as pprice,orders.orderStatus as orstatus, orders.paymentMethod as paym,orders.orderDate as odate,orders.id as orderid from orders join products on orders.productId=products.id where orders.userId='" . $_SESSION['id'] . "' and orders.paymentMethod is not null");
											$cnt = 1;
											while ($row = mysqli_fetch_array($query)) {
											?>
												<tr>
													<td><?php echo $cnt; ?></td>
													<td class="cart-image">
														<a class="entry-thumbnail" href="detail.html">
															<img src="admin/productimages/<?php echo $row['proid']; ?>/<?php echo $row['pimg1']; ?>" alt="" width="80" height="80">
														</a>
													</td>
													<td class="product-info-cart">
														<h5 class='cart-product-description'><a href="product-details.php?pid=<?php echo $row['opid']; ?>">
																<?php echo $row['pname']; ?></a></h5>


													</td>
													<td class="cart-product-quantity">
														<?php echo $qty = $row['qty']; ?>
													</td>
													<td class="cart-product-grand-total"><?php echo number_format(($qty * $row['pprice'])); ?></td>
													<td class="cart-product-sub-total"><?php echo $row['paym']; ?> </td>
													<td class="cart-product-sub-total"><?php echo $row['odate']; ?> </td>

													<td>
													<?php echo $row['orstatus'] ?>
													</td>
												</tr>
											<?php $cnt = $cnt + 1;
											} ?>

										</tbody><!-- /tbody -->
									</table><!-- /table -->

							</div>
						</div>

					</div><!-- /.shopping-cart -->
				</div> <!-- /.row -->
				</form>
			</div><!-- /.body-content -->
			<?php include('includes/footer.php'); ?>
			<script src="assets/js/jquery-1.11.1.min.js"></script>
			<script src="assets/js/scripts.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>


	</html>
<?php } ?>