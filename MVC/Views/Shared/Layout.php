<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Trang chủ</title>
	<link rel="stylesheet" href="<?php echo CSS_URL; ?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
	<!-- header start -->
	<div class="header" id="scroll-header">
		<!-- header-top start -->
		<div class="header-top" id="test">
			<i class="fas fa-bell cart">
				<div class="count-product"><label>0</label></div>
			</i>
			<i class="fas fa-shopping-cart cart">
			<?php if (empty($_SESSION['USER_SESSION'])): ?>
				<div class="show-cart">
					<div class="cart-content">
						<h5>Login to use this action!</h5>
					</div>
					<div class="cart-button" style="margin:5px">
						<button class="btn btn-danger" onclick="location.href='<?php echo BASE_URL; ?>Login/Index';">Login / Register</button>
					</div>
				</div>
			<?php else: ?>
				<div class="count-product"><label>2</label></div>
				<div class="show-cart">
					<div class="cart-content">
						<div class="cart-item">
							<div class="item-img">
								<img src="<?php echo IMAGE_URL; ?>/phone1.png" alt="">
							</div>
							<div class="item-infor">
								<label>Name: Product Name 1</label>
								<label>Price: 20000</label>
							</div>
						</div>
						<div class="cart-item">
							<div class="item-img">
								<img src="<?php echo IMAGE_URL; ?>/phone1.png" alt="">
							</div>
							<div class="item-infor">
								<label>Name: Product Name 2</label>
								<label>Price: 50000</label>
							</div>
						</div>
					</div>
					<div class="cart-button" style="margin:5px">
						<button class="btn btn-danger">View Cart</button>
					</div>
				</div>
			<?php endif; ?>
			</i>
			<?php if (empty($_SESSION['USER_SESSION'])): ?>
				<a href="<?php echo BASE_URL; ?>Login/Index">Login</a>
				<a href="<?php echo BASE_URL; ?>Login/Index">Register</a>
			<?php else: ?>
				<div style="display:flex;justify-content:center;align-items:center;">
					<label style="margin:0;"><?php echo $_SESSION['USER_SESSION']; ?></label>
					<i id="toggle-account" style="margin-bottom:4px;margin-left:5px;" class="fas fa-sort-down"></i>
				</div>
				<div class="toggle-account">
					<div class="account-navigation">
						<a href="#">
							<span></span>
							<span></span>
							<span></span>
							<span></span>
							Account information
						</a>
						<a href="#">
							<span></span>
							<span></span>
							<span></span>
							<span></span>
							Update Account
						</a>
						<a href="#">
							<span></span>
							<span></span>
							<span></span>
							<span></span>
							Change password
						</a>
						<a href="#">
							<span></span>
							<span></span>
							<span></span>
							<span></span>
							History
						</a>
						<button style="margin-top:10px;" onclick="location.href='<?php echo BASE_URL; ?>Login/Logout'" class="btn btn-danger">Log Out</button>
					</div>
				</div>
			<?php endif; ?>
		</div>
		<!-- header-top end -->

		<!-- header-bottom start -->
		<div class="header-bottom">
			<!-- animate-logo start-->
			<div class="animate-logo">
				<a href="<?php echo BASE_URL; ?>"><label style="color:orange;margin:0;">D.O.T</label> SHOP</a>
				<a href="<?php echo BASE_URL; ?>"><label style="color:orange;margin:0;">MOBILE</label> SHOP</a>
				<a href="<?php echo BASE_URL; ?>"><label style="color:orange;margin:0;">DESIGN:</label> 9HT</a>
			</div>
			<!-- animate-logo end-->

			<!-- menu-toggle start -->
			<div class="menu-toggle">
				<div class="bar"></div>
				<div class="bar"></div>
				<div class="bar"></div>
			</div>
			<!-- menu-toggle end -->

			<!-- navigation start -->
			<div class="navigation">
				<a class="active" href="<?php echo BASE_URL; ?>">
					<span></span>
					<span></span>
					<span></span>
					<span></span>
					Home
				</a>
				<a href="<?php echo BASE_URL?>Product/Index">
					<span></span>
					<span></span>
					<span></span>
					<span></span>
					Products
				</a>
				<a href="#">
					<span></span>
					<span></span>
					<span></span>
					<span></span>
					Search
				</a>
				<a href="#">
					<span></span>
					<span></span>
					<span></span>
					<span></span>
					Contact
				</a>
				<?php if (!empty($_SESSION['USER_SESSION']) && $_SESSION['USER_SESSION'] == 'admin'): ?>
					<a id="admin-menu" href="#">
						<span></span>
						<span></span>
						<span></span>
						<span></span>
						Admin
					</a>
				<?php endif; ?>
			</div>
			<!-- navigation end -->

		</div>
		<!-- header-bottom end -->
	</div>
	<!-- header end -->

	<!-- content start -->
	<?php 
		if (file_exists('./MVC/Views/'.$model['page'].'.php')){
			require_once('./MVC/Views/'.$model['page'].'.php');
		}
		else{
			require_once('./MVC/Views/Shared/404.php');
		}
	?>
	<!-- content end -->

	<!-- footer start -->
	<div class="footer">
		
	</div>
	<!-- footer end -->

	<!-- button-to-top start -->
		<div class="scroll-top">
			<i class="fas fa-chevron-up"></i>
		</div>
	<!-- button-to-top end -->

	<script>
		// var count = 2;
		// setInterval(function(){
		// 	document.getElementById('radio' + count).checked = true;
		// 	count++;
		// 	if (count == 4) {
		// 		count = 1;
		// 	}
		// },4000);
	</script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="<?php echo JS_URL; ?>/layout.js"></script>
</body>
</html>