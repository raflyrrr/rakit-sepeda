<?php
session_start();
error_reporting(0);
include('includes/config.php');
$cid = intval($_GET['cid']);
if (isset($_GET['action']) && $_GET['action'] == "add") {
	$id = intval($_GET['id']);
	if (isset($_SESSION['cart'][$id])) {
		$_SESSION['cart'][$id]['quantity']++;
	} else {
		$sql_p = "SELECT * FROM products WHERE id={$id}";
		$query_p = mysqli_query($con, $sql_p);
		if (mysqli_num_rows($query_p) != 0) {
			$row_p = mysqli_fetch_array($query_p);
			$_SESSION['cart'][$row_p['id']] = array("quantity" => 1, "price" => $row_p['productPrice']);
			echo "<script>alert('Produk berhasil masuk kedalam keranjang.')</script>";
			echo "<script type='text/javascript'> document.location ='my-cart.php'; </script>";
		} else {
			$message = "Product ID is invalid";
		}
	}
}
// COde for Wishlist
if (isset($_GET['pid']) && $_GET['action'] == "wishlist") {
	if (strlen($_SESSION['login']) == 0) {
		header('location:login.php');
	} else {
		mysqli_query($con, "insert into wishlist(userId,productId) values('" . $_SESSION['id'] . "','" . $_GET['pid'] . "')");
		echo "<script>alert('Product aaded in wishlist');</script>";
		header('location:my-wishlist.php');
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

	<title>Rakitsepedayuk</title>
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">


</head>

<body>
	<header>
		<?php include('includes/top-header.php'); ?>
	</header>
	</div>
	<div class="body-content outer-top-xs">
		<div class='container'>
			<div class='row outer-bottom-sm'>
				<div class="col-md-3 sidebar">
					<?php include('includes/side-menu.php'); ?>
				</div>
				<div class='col-md-9 mt-4'>
					<div id="category" class="category-carousel hidden-xs">
						<?php $sql = mysqli_query($con, "select categoryName  from category where id='$cid'");
						while ($row = mysqli_fetch_array($sql)) {
						?>
							<div class="excerpt hidden-sm hidden-md">
								<?php echo htmlentities($row['categoryName']); ?>
							</div>
						<?php } ?>
					</div>
					<div class="search-result-container">
						<div id="myTabContent" class="tab-content">
							<div class="tab-pane active " id="grid-container">
								<div class="category-product">
									<div class="row">
										<?php
										$ret = mysqli_query($con, "select * from products where category='$cid'");
										$num = mysqli_num_rows($ret);
										if ($num > 0) {
											while ($row = mysqli_fetch_array($ret)) { ?>
												<div class="col-sm-6 col-md-12" data-aos="fade">
													<hr>
													<div class="col-md-2">
														<div class="product-image">
															<a href="https://google.com/search?q=<?php echo htmlentities($row['productName']) ?>" target="_blank"><img src="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>" alt="" width="180" height="180"></a>
														</div><!-- /.product-image -->
													</div>

													<div class="col-md-12 product-info text-left mt-2">
														<h3 class="name">
															<a href="https://google.com/search?q=<?php echo htmlentities($row['productName']) ?>" target="_blank"><?php echo htmlentities($row['productName']); ?></a>
														</h3>
														<div class="product-price">
															<span class="price">
																Rp. <?php echo number_format($row['productPrice']); ?> </span>
														</div><!-- /.product-price -->

													</div><!-- /.product-info -->
													<div class="cart mt-2 ">
														<li class="add-cart-button btn-group">
															<?php if ($row['productAvailability'] == 'In Stock') { ?>
																<a href="category.php?page=product&action=add&id=<?php echo $row['id']; ?>">
																	<button class="btn btn-primary" type=" button"><i class="fa fa-shopping-cart"></i></button></a>
															<?php } else { ?>
																<div class="action" style="color:red">Stok Habis</div>
															<?php } ?>

														</li>
														</ul>
													</div><!-- /.cart -->

												</div>
											<?php }
										} else { ?>

											<div class="col-sm-6 col-md-4 wow fadeInUp">
												<h3>Tidak ada Produk</h3>
											</div>

										<?php } ?>









										<div class="footer-all"></div>
									</div><!-- /.row -->
								</div><!-- /.category-product -->

							</div><!-- /.tab-pane -->



						</div><!-- /.search-result-container -->

					</div><!-- /.col -->
				</div>
			</div>

		</div>
	</div>
	<?php include('includes/footer.php'); ?>



</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
	AOS.init();
</script>

</html>