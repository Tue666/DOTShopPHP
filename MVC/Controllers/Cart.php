<?php  
class Cart extends ViewModel{
	public function Index(){
		$this->loadView('Shared','Layout',[
			'page'=>'Cart/Index'
		]);
	}
	public function Payment(){
		$product = $this->getModel('ProductDAL');
		$account = $this->getModel('AccountDAL');
		$order = $this->getModel('OrderDAL');
		$orderDetail = $this->getModel('OrderDetailDAL');
		try {
			$orderID = $order->insertOrder(json_decode($account->getIDByName($_SESSION['USER_SESSION'])),$_POST['shipName'],$_POST['shipAddress'],$_POST['shipPhone'],$_POST['shipEmail']);
			foreach ($_SESSION['CART_SESSION'] as $key => $value) {
				$orderDetail->insertOrderDetail($orderID,$value['ID'],$value['Quantity'],$value['Price']);
				$product->updateCount($value['ID']);
			}
			unset($_SESSION['CART_SESSION']);
			$this->loadView('Shared','Layout',[
				'page'=>'Shared/Success'
			]);
		} catch (Exception $e) {
			$this->loadView('Shared','Layout',[
				'page'=>'Shared/Failed'
			]);
		}
	}
}
?>