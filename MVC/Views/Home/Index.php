	<div class="content">
		<div class="wrapper">
			<!-- slider start -->
			<div class="slider">
				<div class="slides">
					<div class="slide first">
						<img src="<?php echo IMAGE_URL; ?>/1.png" alt="">
					</div>
					<div class="slide">
						<img src="<?php echo IMAGE_URL; ?>/2.png" alt="">
					</div>
					<div class="slide">
						<img src="<?php echo IMAGE_URL; ?>/3.png" alt="">
					</div>
				</div>
			</div>
			<!-- slider end -->
			<!-- buttons start -->
			<div class="buttons">
				<span id="btn1" onclick="clickSlide(0,false)" class="active"></span>
				<span id="btn2" onclick="clickSlide(1,false)"></span>
				<span id="btn3" onclick="clickSlide(2,false)"></span>
			</div>
			<!-- buttons end -->
			<!-- products start -->
			<div class="products">

				<!-- hot-products start -->
				<h5>
					Hot Product
					<span></span>
				</h5>
				<?php foreach ($model['listHot'] as $item): ?>
					<div class="product-card">
						<label class="hot">HOT</label>
						<div class="image-move move">
							<img src="<?php echo IMAGE_URL.'/'.$item['Image']; ?>" alt="">
						</div>
						<div class="image-card">
							<a href="<?php echo BASE_URL.'Product/Detail/'.$item['ID']; ?>"><img src="<?php echo IMAGE_URL.'/'.$item['Image']; ?>" alt=""></a>
						</div>
						<div class="content-card">
							<h5><?php echo $item['ProductName']; ?></h5>
							<h6>Price: <?php echo number_format($item['Price'], 0, '', ','); ?> đ</h6>
							<div class="btn-content-card">
								<a class="view-card" href="<?php echo BASE_URL.'Product/Detail/'.$item['ID']; ?>">View</a>
								<div class="hover-card">
									<i class="fas fa-cart-arrow-down"></i>
									<button style="width: 100%" class="add-cart-card">Add Cart
									</button>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
				<a href="#" style="text-decoration: none;display:block;"> View more <i class="fas fa-angle-double-right"></i></a>
				<!-- hot-products end -->

				<!-- new-products start -->
				<h5>
					New Product
					<span></span>
				</h5>
				<?php foreach ($model['listNew'] as $item): ?>
					<div class="product-card">
						<label class="new">NEW</label>
						<div class="image-move move">
							<img src="<?php echo IMAGE_URL.'/'.$item['Image']; ?>" alt="">
						</div>
						<div class="image-card">
							<a href="<?php echo BASE_URL.'Product/Detail/'.$item['ID']; ?>"><img src="<?php echo IMAGE_URL.'/'.$item['Image']; ?>" alt=""></a>
						</div>
						<div class="content-card">
							<h5><?php echo $item['ProductName']; ?></h5>
							<h6>Price: <?php echo number_format($item['Price'], 0, '', ','); ?> đ</h6>
							<div class="btn-content-card">
								<a class="view-card" href="<?php echo BASE_URL.'Product/Detail/'.$item['ID']; ?>">View</a>
								<div class="hover-card">
									<i class="fas fa-cart-arrow-down"></i>
									<button style="width: 100%" class="add-cart-card">Add Cart
									</button>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
				<a href="#" style="text-decoration: none;display:block;"> View more <i class="fas fa-angle-double-right"></i></a>
				<!-- new-products end -->

			</div>
			<!-- products end -->
		</div>
	</div>