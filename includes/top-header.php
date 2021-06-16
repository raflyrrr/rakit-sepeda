<?php

if (isset($_Get['action'])) {
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
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="container">
		<a class="navbar-brand" href="index.php">Rakitsepedayuk</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<form class="mx-2 my-auto d-inline w-100" name="search" method="POST" action="search-result.php">
				<div class="input-group">
					<input class="form-control searchbar" type="search" placeholder="Cari barang disini..." aria-label="Search" name="product">
					<span class="input-group-append">
						<button class="btn btn-outline-secondary border border-left-0" type="submit" name="search">
							<i class="fa fa-search"></i>
						</button>
					</span>
				</div>
			</form>
			<ul class="navbar-nav mb-2 mb-lg-0">
				<?php
				if (!empty($_SESSION['cart'])) {
				?>
					<li><a href="my-cart.php" class="cart d-flex">Cart
							<div class="cart-icon ms-1 me-1"><i class="fa fa-shopping-cart"></i></div>
							<?php echo $_SESSION['qnty'] ?>
						</a></li>
				<?php } else { ?>
					<li><a href="my-cart.php" class="cart d-flex">Cart
							<div class="cart-icon ms-1 me-1"><i class="fa fa-shopping-cart"></i></div>
							0
						</a></li>
				<?php } ?>
			</ul>
			<ul class="navbar-nav mb-2 mb-lg-0">
				<?php if (strlen($_SESSION['login'])) {   ?>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<i class="fa fa-user"></i> Hi, <?php echo htmlentities($_SESSION['username']); ?>
						</a>
						<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
							<li><a class="dropdown-item" href="order-history.php"></i>Riwayat Pemesanan</a></li>
							<li><a class="dropdown-item" href="logout.php"></i>Logout</a></li>
						</ul>
					<?php } ?>
					<?php if (strlen($_SESSION['login']) == 0) {   ?>
					<li><a href="login.php" class="login">Login</a></li>
					<li><a href="register.php" class="register">Register</a></li>
				<?php } else { ?>
				<?php } ?>
				</li>
			</ul>
		</div>
	</div>
</nav>