<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="stylesheet" href="<?php echo CSS_URL; ?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
	<!-- login-container-start -->
	<div class="login-container">
		<!-- login-wrapper-start -->
		<div class="login-wrapper">
			<!-- login-form-start -->
			<form class="login-form" action="<?php echo BASE_URL; ?>Login/Login" method="POST">
				<i class="fas fa-user-circle"></i>
				<input class="user-input" type="text" name="login-username" placeholder="Username ..." required>
				<input class="user-input" type="password" name="login-password" placeholder="Password ..." required>
				<div class="option-1">
					<label class="remember-me"><input type="checkbox">Remember Me</label>
					<a href="#">Forgot your password</a>
				</div>
				<input class="btn" type="submit" name="login-btn" value="LOGIN">
				<div class="option-2">
					<label>Not have account?<a href="#">Create here</a></label>
				</div>
			</form>
			<!-- login-form-end -->
			<!-- regis-form-start -->
			<form class="regis-form" action="<?php echo BASE_URL; ?>Login/Register" method="POST">
				<i class="fas fa-user-plus"></i>
				<input id="checkUserName" autocomplete="off" class="user-input" type="text" name="regis-un" placeholder="Username ..." required>
				<div id="showMessage" style="margin-bottom:10px;color:red;font-style:italic;"></div>
				<input class="user-input" type="password" name="regis-ps" placeholder="Password ..." required>
				<input class="user-input" type="password" name="regis-confirmps" placeholder="Confirm password ..." required>
				<input class="btn" type="submit" name="register-btn" value="REGISTER">
				<div class="option-2">
					<label>Have account?<a href="#">Login here</a></label>
				</div>
			</form>
			<!-- regis-form-end -->
			<!-- message start -->
			<?php if (isset($model['message']) && isset($model['type'])): ?>
				<?php $color = ($model['type'] == 'error')?"red":"green"; ?>
				<label style="font-size:1.1em;color:<?php echo $color; ?>;font-style:italic;">
					<?php
						echo $model['message'];
					?>
				</label>
			<?php endif; ?>
			<!-- message end -->
		</div>
		<!-- login-wrapper-end -->
	</div>
	<!-- login-container-end -->
	<div>
		<ul class="bubbles">
			<li><h1></h1></li>
			<li><h1></h1></li>
			<li><h3>hehe :))</h3></li>
			<li><h1></h1></li>
			<li><h1></h1></li>
			<li><h1></h1></li>
			<li><h1></h1></li>
			<li><h1></h1></li>
			<li><h3>Xin chào :))</h3></li>
			<li><h1></h1></li>
			<li><h1></h1></li>
			<li><h1></h1></li>
		</ul>
	</div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="<?php echo JS_URL; ?>/login.js"></script>
</body>
</html>