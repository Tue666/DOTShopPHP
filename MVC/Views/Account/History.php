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
					<div class="col-md-9 border-left border-dark">
						<div class="row">
							<div class="col-md-12">
								<table class="table">
									<thead class="thead-dark">
										<tr>
											<th scope="col">ID</th>
											<th scope="col">Created</th>
											<th scope="col">Products</th>
											<th scope="col">Total price</th>
											<th scope="col">Status</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($model['listTransaction'] as $key => $value): ?>
											<tr>
												<th style="width:5%;" scope="row"><label><?php echo $value['OrderID']; ?></label></th>
												<th style="width:15%;"><label><?php echo $value['Created']; ?></label></th>
												<th style="width:46%;">
													<label>
														<?php foreach ($value['Products'] as $item): ?>
															<a class="a" href="<?php echo BASE_URL.'Product/Detail/'.$item['productID']; ?>"><?php echo '- '.$item['productName'].' ('.$item['quantity'].' item - '.number_format($item['price']*$item['quantity'],'0','',',').').<br />'; ?></a>
														<?php endforeach; ?>
												    </label>
											    </th>
												<th style="width:18%;"><label><?php echo number_format($value['TotalPrice'],'0','',','); ?></label></th>
												<th style="width:16%;">
													<?php if ($value['Status']==0): ?>
														<label style="color:red;">In Processing</label>
													<?php else: ?>
														<label style="color:green;">Success</label>
													<?php endif; ?>
													
												</th>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>