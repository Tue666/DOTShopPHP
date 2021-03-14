	<div class="content">
		<div class="history-wrapper">
			<div class="container">
				<div class="row">
					<div class="col-md-3">
						<div class="row">
							<div class="col-md-12">
								<button onclick="location.href='<?php echo BASE_URL; ?>Account/History';" class="btn btn-light">Transaction history</button>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col-md-12">
								<button onclick="location.href='<?php echo BASE_URL; ?>Account/Purchased';" class="btn btn-light">Purchased products</button>
							</div>
						</div>
					</div>
					<div class="col-md-9 border-left border-dark" style="flex-wrap:wrap;display: flex;">
						<?php foreach ($model['purchased'] as $key => $value): ?>
							<div class="purchased-item">
								<div class="purchased-image">
									<a href="<?php echo BASE_URL.'Product/Detail/'.$value['ID']; ?>"><img src="<?php echo IMAGE_URL.'/'.$value['Image']; ?>" alt=""></a>
								</div>
								<div class="purchased-name">
									<label style="font-size:1.2em;font-weight:bold;color:#e23434;text-align:center;"><?php echo $value['ProductName']; ?></label>
								</div>
								<div class="purchased-ratings">
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star-half-alt"></i>
									<small>(69 ratings)</small>
								</div>
								<?php if ($value['Discount'] > 0): ?>
									<div class="purchased-new-price">
										<label style="font-size:1.2em;font-weight:bold;margin:0;"><?php echo number_format($value['Price']*($value['Discount']/100),'0','',','); ?></label>
										<small>-<?php echo $value['Discount']; ?>%</small>
									</div>
									<div class="purchased-old-price">
										<label style="margin:0;text-decoration:line-through;"><?php echo number_format($value['Price']); ?></label>
									</div>
								<?php else: ?>
									<label style="font-size:1.2em;font-weight:bold;margin:0;"><?php echo number_format($value['Price'],'0','',','); ?></label>
								<?php endif; ?>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>