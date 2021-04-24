<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $model['title']; ?></title>
	<link rel="icon" href="<?php echo IMAGE_URL; ?>/icon.png" >
	<link rel="stylesheet" href="<?php echo CSS_URL; ?>/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo CSS_URL; ?>/owl.carousel.min.css">
	<link rel="stylesheet" href="<?php echo CSS_URL; ?>/jquery.exzoom.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
	<!-- header start -->
	<div class="header" id="scroll-header">
		<!-- header-top start -->
		<div class="header-top" id="test">
			<i class="fas fa-bell notify">
				<!-- <div class="count-notify"><label>0</label></div> -->
			</i>
			<i class="fas fa-shopping-cart cart">
				
			</i>
			<?php if (empty($_SESSION['USER_SESSION'])): ?>
				<a href="<?php echo BASE_URL; ?>Login/Index">Login</a>
				<a href="<?php echo BASE_URL; ?>Login/Index">Register</a>
			<?php else: ?>
				<div style="display:flex;justify-content:center;align-items:center;">
					<?php if ($_SESSION['USER_TYPE_SESSION']==1): ?>
						<i style="color:red;margin-right:5px;" class="fab fa-galactic-senate fa-2x"></i>
						<label style="margin:0;color:red;font-weight:bold"><?php echo $_SESSION['USER_SESSION']; ?></label>
					<?php else: ?>
						<i style="color:red;margin-right:5px;" class="fab fa-studiovinari fa-2x"></i>
						<label style="margin:0;"><?php echo $_SESSION['USER_SESSION']; ?></label>
					<?php endif; ?>
					<i id="toggle-account" style="margin-bottom:4px;margin-left:5px;" class="fas fa-sort-down"></i>
				</div>
				<div class="toggle-account">
					<div class="account-navigation">
						<a href="<?php echo BASE_URL; ?>Account/Index">
							<span></span>
							<span></span>
							<span></span>
							<span></span>
							Account
						</a>
						<a href="<?php echo BASE_URL; ?>Account/UpdatePass">
							<span></span>
							<span></span>
							<span></span>
							<span></span>
							Change password
						</a>
						<a href="<?php echo BASE_URL; ?>Cart/Index">
							<span></span>
							<span></span>
							<span></span>
							<span></span>
							My cart
						</a>
						<a href="<?php echo BASE_URL; ?>Account/History">
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
				<a id="toggle-search" style="cursor:pointer;">
					<span></span>
					<span></span>
					<span></span>
					<span></span>
					Search
				</a>
				<div class="toggle-search" style="display:none;">
					<form class="search-form" action="<?php echo BASE_URL; ?>Home/Searching" method="POST">
						<div class="form-group row" style="width:100%;">
							<div class="col-sm-12">
								<input type="text" class="form-control" name="searchName" placeholder="Type product name you want to search here ...">
							</div>
						</div>
						<div class="form-group row col-md-12">
							<input type="checkbox" class="form-check-input" name="advancedCheck">
							<label>Advanced searching</label>
						</div>
						<div class="form-group row col-md-12">
							<label class="col-sm-3 col-form-label">Category</label>
							<div class="col-sm-9">
								<select class="form-control" name="selectBox">
									<option selected><label>All</label></option>
									<option><label>Mobiles</label></option>
									<option><label>Tablets</label></option>
									<option><label>Cameras</label></option>
									<option><label>Laptops</label></option>
								</select>
							</div>
						</div>
						<div class="form-group row col-md-12">
							<label class="col-sm-3 col-form-label">Price</label>
							<input class="col-sm-4 form-control" type="text" name="priceFrom" value='0' />
							<label class="col-sm-1 col-form-label">to</label>
							<input class="col-sm-4 form-control" type="text" name="priceTo" value='10.000.000' />
						</div>
						<button class="btn btn-primary" name="searchProduct">Search</button>
					</form>
				</div>
				<a href="<?php echo BASE_URL; ?>Contact/Index">
					<span></span>
					<span></span>
					<span></span>
					<span></span>
					Contact
				</a>
				<?php if (!empty($_SESSION['USER_SESSION']) && $_SESSION['USER_TYPE_SESSION'] == 1): ?>
					<a id="admin-menu" href="<?php echo ADMIN_BASE_URL; ?>">
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
		if (file_exists($link.$model['page'].'.php')){
			require_once($link.$model['page'].'.php');
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
	<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
	<!-- data table bootstrap -->
	<script>
		$(document).ready(function() {
    		$('#dataTable').DataTable();
		});
	</script>
	
	<!-- owl-carousel -->
	<script src="<?php echo JS_URL; ?>/owl.carousel.min.js"></script>
	<script>
		function myMap() {
			var mapProp= {
  				center:new google.maps.LatLng(10.76125, 106.68292),
  				zoom:9,
			};
			var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
		}
	</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8hqJBEeWT872P0Uvsj-WX5tpUnsWivb0&callback=myMap"></script>
	<script>
		
		$('.owl-carousel').owlCarousel({
			autoplay: 1000,
			autoplayHoverPause: true,
			items: 4,
			nav: true,
			loop: true,
			responsiveClass:true,
			responsive:{
				0:{
					items:1,
					nav:true
				},
				501:{
					items:2,
					nav:true
				},
				701:{
					items:3,
					nav:true
				},
				801:{
					items:4,
					nav:true
				}
			}
		});
	</script>

	<!-- jquery exzoom -->
	<script src="<?php echo JS_URL; ?>/jquery.exzoom.js"></script>
	<script>
		$(function(){
			$("#exzoom").exzoom({
				"autoPlay": false
			});
		});
	</script>
</body>
</html>