<?php  
class Ajax extends ViewModel{
	public function updateView(){
		$product = $this->getModel('ProductDAL');
		$product->updateView($_POST['productID']);
		array_push($_SESSION['VISITED_SESSION'], $_POST['productID']);
	}
	public function sendFeedback(){
		$type = 'danger';
		$message = 'Send failed :D. Something my error, try again.';
		$contact = $this->getModel('ContactDAL');
		$account = $this->getModel('AccountDAL');
		$userID = json_decode($account->getIDByName($_POST['userName']),true);
		if (json_decode($contact->addFeedback($userID,$_POST['name'],$_POST['email'],$_POST['phone'],$_POST['title'],$_POST['content']),true)){
			$type = 'success';
			$message = 'Send success. Check your history to see the response.';
		}
		$data = array(
			'type'=>$type,
			'message'=>$message
		);
		echo json_encode($data);
	}
	public function submitFeedback(){
		$contact = $this->getModel('ContactDAL');
		$feedback = json_decode($contact->getFeedbackByID($_POST['feedbackID']),true);
		$response = $feedback['Content'].'^'.$_POST['response'];
		if (json_decode($contact->updateContent($_POST['feedbackID'],$response),true)){
			json_decode($contact->updateResponse($_POST['feedbackID']),true);
			echo true;
		}
		echo false;
	}
	public function loadFeedback(){
		$contact = $this->getModel('ContactDAL');
		$feedback = json_decode($contact->getFeedbackByID($_POST['feedbackID']),true);
		$content = explode('^',$feedback['Content']);
		$output = '<div class="message mb-2" >';
		$count = 0;
		foreach ($content as $item){
			if ($count % 2 == 0){
				$output .= 
				'
				<div class="p-0 mb-3">
					<div class="p-0 m-0">
						<label class="m-0 text-secondary">'.$feedback['Name'].'</label>
					</div>
					<div class="col-md-12 m-0 user-mess">
						<label>'.$content[$count].'</label>
					</div>
				</div>
				';
			}
			else{
				$output .= 
				'
				<div class="p-0 mb-3">
					<div class="p-0 m-0 d-flex justify-content-end">
						<label class="m-0 text-danger">Admin</label>
					</div>
					<div class="col-md-12 m-0 admin-mess">
						<label>'.$content[$count].'</label>
					</div>
				</div>
				';
			}
			$count = $count + 1;
		}
		$output .= '</div>';
		if (!$feedback['Response'] && !$feedback['Status']){
			$output .=
			'
			<form>
            	<textarea class="form-control" id="responseContact" rows="3"></textarea>
            	<div style="padding:0;display:flex;justify-content:flex-end;">
                	<a onclick="sendFeedback('.$feedback['ID'].')" title="Send" class="btn btn-primary">Send</a>
            	</div>      
        	</form>
			';
		}
		if ($feedback['Status']){
			$output .=
			'
				<div class="d-flex justify-content-center">
					<label class="text-danger font-weight-bold">The admin has turned off this conversation <i class="fas fa-comment-slash"></i></label>
				</div>
			';
		}
		echo $output;
	}
	public function checkExist(){
		$account = $this->getModel('AccountDAL');
		$userName = $_POST['userName'];
		if (json_decode($account->checkExist($userName))) {
			echo "This name is already existed";
		}
	}
	public function getSession(){
		if (empty($_SESSION['USER_SESSION'])){
			echo "";
		}
		else{
			echo $_SESSION['USER_SESSION'];
		}
	}
	public function updatePassword(){
		$account = $this->getModel('AccountDAL');
		$checkLoginJSON = json_decode($account->checkLogin($_SESSION['USER_SESSION']),true);
		$pass = $_POST['pass'];
		$newpass = $_POST['newpass'];
		$confirmnewpass = $_POST['confirmnewpass'];
		$message = '';
		$type = '';
		if (!empty($pass)&&!empty($newpass)&&!empty($confirmnewpass)){
			if (password_verify($pass, $checkLoginJSON['PassWord'])){
				if ($newpass == $confirmnewpass){
					$account->updatePassword($_SESSION['USER_SESSION'],password_hash($newpass, PASSWORD_DEFAULT));
					$message = 'Update success :D.';
					$type = 'success';
				}
				else{
					$message = 'New password are not synchronized :D.';
					$type = 'danger';
				}
			}
			else{
				$message = 'Old password is incorrect :D.';
				$type = 'danger';
			}
		}
		else{
			$message = 'Fill all the field please :D.';
			$type = 'danger';
		}
		$data = array(
			'message'=>$message,
			'type'=>$type
		);
		echo json_encode($data);
	}
	public function updateAccount(){
		$account = $this->getModel('AccountDAL');
		echo $account->updateAccount($_SESSION['USER_SESSION'],$_POST['name'],$_POST['email'],$_POST['phone'],$_POST['address']);
	}
	public function loadCartHover() {
		$output = '';
		if (empty($_SESSION['USER_SESSION'])) {
			$output = '
				<div class="show-cart">
					<div class="cart-content">
						<h5>Login to use this action!</h5>
					</div>
					<div class="cart-button" style="margin:5px">
						<button class="btn btn-danger" onclick="location.href=\''.BASE_URL.'Login/Index\';">Login / Register</button>
					</div>
				</div>
			';
		}
		else {
			if (empty($_SESSION['CART_SESSION'])) {
				$output = '
					<div class="show-cart">
						<label>No items here.</label>
					</div>
				';
			}
			else {
				$output = '
					<div class="count-product"><label>'.count($_SESSION['CART_SESSION']).'</label></div>
					<div class="show-cart">
						<div class="cart-content">
				';
				foreach ($_SESSION['CART_SESSION'] as $key => $value) {
					$output .= '
						<div class="cart-item">
							<div class="item-img">
								<a href="'.BASE_URL.'Product/Detail/'.$value['ID'].'"><img src="'.IMAGE_URL.'/'.$value['Image'].'" alt=""></a>
							</div>
							<div class="item-infor">
								<label>Name: '.$value['Name'].'</label>
								<label>Quantity: '.$value['Quantity'].'</label>
							</div>
						</div>
					';
				}
				$output .= '
						</div>
						<div class="cart-button" style="margin:5px">
							<button class="btn btn-danger" onclick="location.href=\''.BASE_URL.'Cart/Index\';">View Cart</button>
						</div>
					</div>
				';
			}
		}
		echo $output;
	}
	public function showCheckOut(){
		$output = '
			<form style="width:60%;" action="'.BASE_URL.'Cart/Payment" method="POST">
				<div class="form-group">
					<label>Name: </label>
					<input type="text" class="form-control" name="shipName" placeholder="Enter your name ..." required>
				</div>
				<div class="form-group">
					<label>Address: </label>
					<input type="text" class="form-control" name="shipAddress" placeholder="Enter your address ..." required>
				</div>
				<div class="form-group">
					<label>Phone: </label>
					<input type="text" class="form-control" name="shipPhone" placeholder="Enter your phone ..." required>
				</div>
				<div class="form-group">
					<label>Email: </label>
					<input type="email" class="form-control" name="shipEmail" placeholder="Enter your email ..." required>
				</div>
				<button type="submit" name="payment" class="btn btn-success">Order now</button>
				<a onclick="hideCheckOut();" class="btn btn-danger">Cancel</a>
			</form>
		';
		echo $output;
	}
	public function loadCart(){
		if (empty($_SESSION['CART_SESSION'])) {
			$output = '
				<img style="width:20%;" src="'.IMAGE_URL.'/shop.png" />
				<label style="margin:10px;">No items here</label>
				<button class="btn btn-success" onclick="location.href=\''.BASE_URL.'\'"><i class="fab fa-shopify"></i> Buy more</button>
			';
		}
		else {
			$totalPrice = 0;
			foreach ($_SESSION['CART_SESSION'] as $key => $value) {
				$totalPrice += $value['Quantity'] * $value['Price'];
			}
			if (count($_SESSION['CART_SESSION']) == 1) {
				$output = '
				<div class="cart-action">
					<label>There is '.count($_SESSION['CART_SESSION']).' item in cart => Total: <span>'.number_format($totalPrice,'0','',',').'</span> đ</label>
				';
			}
			else if (count($_SESSION['CART_SESSION']) > 1) {
				$output = '
				<div class="cart-action">
					<label>There are '.count($_SESSION['CART_SESSION']).' items in cart => Total: <span>'.number_format($totalPrice,'0','',',').'</span> đ</label>
				';
			}
			$output .= '
					<div class="action">
						<button onclick="showCheckOut();" class="btn btn-primary"><i class="fas fa-credit-card"></i> Check Out!</button>
						<button onclick="allowClear();" class="btn btn-danger"><i class="fas fa-broom"></i> Clear</button>
					</div>
				</div>
				<div class="cart-detail">
					<table class="table">
						<thead class="thead-dark">
							<tr>
								<th scope="col">#</th>
								<th scope="col">Name</th>
								<th scope="col">Image</th>
								<th scope="col">Quantity</th>
								<th scope="col">Price</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
			';
			$identity = 1;
			foreach ($_SESSION['CART_SESSION'] as $key => $value) {
				$output .= '
							<tr>
								<th scope="row"><label>'.$identity.'</label></th>
								<td><label>'.$value['Name'].'</label></td>
								<td><a href="'.BASE_URL.'Product/Detail/'.$value['ID'].'"><img style="width:110px;height:90px;" src="'.IMAGE_URL.'/'.$value['Image'].'" alt=""></a></td>
								<td>
									<div class="group-input" style="color:#111;">
										<input onchange="updateQuantity('.$value['ID'].',event)" type="text" value="'.$value['Quantity'].'">
									</div>
								</td>
								<td><label>'.number_format($value['Quantity']*$value['Price'],'0','',',').' đ</label></td>
								<td>
									<button onclick="passDataRemove('.$value['ID'].',\''.$value['Name'].'\');" class="btn btn-danger">Remove</button>
								</td>
							</tr>
				';
				$identity = $identity + 1;
			}
			$output .= '
							<tr>
								<td colspan="6"><button class="btn btn-success" onclick="location.href=\''.BASE_URL.'\'"><i class="fab fa-shopify"></i> Buy more</button></td>
							</tr>
						</tbody>
					</table>
				</div>
			';
		}
		echo $output;
	}
	public function updateQuantity(){
		$product = $this->getModel('ProductDAL');
		$productByIDJSON = json_decode($product->getProductByID($_POST['productID']),true);
		if ($_POST['newQuantity'] < 1) {
			$_POST['newQuantity'] = 1;
		}
		if ($_POST['newQuantity'] > $productByIDJSON['Quantity']) {
			$_POST['newQuantity'] = $productByIDJSON['Quantity'];
		}
		foreach ($_SESSION['CART_SESSION'] as $key => &$value) {
			if ($value['ID'] == $_POST['productID']) {
				$value['Quantity'] = $_POST['newQuantity'];
			}
		}
	}
	public function clearCart(){
		unset($_SESSION['CART_SESSION']);
	}
	public function removeCart(){
		foreach ($_SESSION['CART_SESSION'] as $key => $value) {
			if ($value['ID'] == $_POST['productID']) {
				unset($_SESSION['CART_SESSION'][$key]);
			}
		}
	}
	public function addCart(){
		$product = $this->getModel('ProductDAL');
		$productByIDJSON = json_decode($product->getProductByID($_POST['productID']),true);
		$cartItem = array(
			'ID'=>$productByIDJSON['ID'],
			'Name'=>$productByIDJSON['ProductName'],
			'Image'=>$productByIDJSON['Image'],
			'Quantity'=>$_POST['quantity'],
			'Price'=>$productByIDJSON['Price'] * $_POST['quantity']
		);
		if ($productByIDJSON['Quantity'] > 0) {
			$cart = $_SESSION['CART_SESSION'];
			if (!empty($cart)) {
				$listItem = $cart;
				$flag = false;
				foreach ($listItem as $key => $value) {
					if ($listItem[$key]['ID'] == $cartItem['ID']) {
						$flag = true;
						$listItem[$key]['Quantity'] +=  $cartItem['Quantity'];
						if ($listItem[$key]['Quantity'] > $productByIDJSON['Quantity']) {
							$listItem[$key]['Quantity'] = $productByIDJSON['Quantity'];
						}
					}
				}
				if (!$flag) {
					array_push($listItem, $cartItem);
				}
				$_SESSION['CART_SESSION'] = $listItem;
			}
			else {
				$listItem = array();
				array_push($listItem, $cartItem);
				$_SESSION['CART_SESSION'] = $listItem;
			}
			echo 2;
		}
		else {
			echo 1;
		}
	}
}
?>