	<div class="content">
		<!-- product-wrapper start -->
		<div class="product-wrapper">
			<!-- product-navigation start -->
			<div class="product-navigation">
				<ul>
					<li class="active" data-filter="all">All</li>
					<?php foreach ($model['listCate'] as $item): ?>
						<li data-filter=<?php echo $item['ID']; ?>><?php echo $item['CateName']; ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<!-- product-navigation end -->
			<!-- products start -->
			<div class="products" style='flew-wrap:wrap;'>
				<?php foreach ($model['listProduct'] as $item): ?>
					<div class="product-card <?php echo $item['IDCate']; ?>">
						<?php if (isset($_SESSION['VISITED_SESSION'])&&in_array($item['ID'],$_SESSION['VISITED_SESSION'])): ?>
							<label class="visited">Seen  <i class="fas fa-check-double"></i></label>
						<?php endif; ?>
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
								<a onclick="updateView(<?php echo $item['ID'] ?>)" class="view-card" href="<?php echo BASE_URL.'Product/Detail/'.$item['ID']; ?>">View</a>
								<div class="hover-card">
									<i class="fas fa-cart-arrow-down"></i>
									<button onclick="addCart(<?php echo $item['ID']; ?>,1)" style="width: 100%" class="add-cart-card dm">Add Cart
									</button>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
				</div>
			</div>
			<!-- products end -->
		</div>
		<!-- product-wrapper end -->
	</div>