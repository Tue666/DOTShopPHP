<?php
	if (empty($_SESSION['USER_SESSION'])) {
		header('Location:'.BASE_URL.'Login/Index');
	}
?>
	<div class="content">
		<div class="cart-wrapper">
			<div class="payment">
				
			</div>
			<div class="cart-container">
				
			</div>
		</div>
	</div>