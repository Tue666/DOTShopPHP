<?php
	if (empty($_SESSION['USER_SESSION'])) {
		header('Location:'.BASE_URL.'Login/Index');
	}
?>
	<div class="content">
		<!-- cart-wrapper start -->
		<div class="cart-wrapper">
			<!-- payment start -->
			<div class="payment">
				
			</div>
			<!-- payment end -->
			<div class="cart-container">
				
			</div>
		</div>
		<!-- cart-wrapper end -->
	</div>