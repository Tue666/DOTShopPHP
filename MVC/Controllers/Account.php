<?php  
class Account extends ViewModel{
	public $account;
	public function __construct(){
		if (empty($_SESSION['USER_SESSION'])){
			header('Location:'.BASE_URL.'Login/Index');
		}
		$this->account = $this->getModel('AccountDAL');
	}
	public function Index(){
		$accountJSON = json_decode($this->account->getAccountByName($_SESSION['USER_SESSION']),true);
		$this->loadView('Shared','Layout',[
			'title'=>'Account',
			'page'=>'Account/Index',
			'account'=>$accountJSON
		]);
	}
	public function UpdatePass(){
		$this->loadView('Shared','Layout',[
			'title'=>'Update Password',
			'page'=>'Account/UpdatePass'
		]);
	}
	public function History(){
		$product = $this->getModel('ProductDAL');
		$account = $this->getModel('AccountDAL');
		$order = $this->getModel('OrderDAL');
		$orderDetail = $this->getModel('OrderDetailDAL');
		$listOrderJSON = json_decode($order->getOrderByAccountID($account->getIDByName($_SESSION['USER_SESSION'])),true);
		$history = array();
		foreach ($listOrderJSON as $key => $value) {
			$listOrderDetailJSON = json_decode($orderDetail->getOrderDetailByOrderID($value['ID']),true);
			$totalPrice = 0;
			$products = array();
			foreach ($listOrderDetailJSON as $key => $value1) {
				$totalPrice += $value1['Quantity'] * $value1['Price'];
				array_push($products, [
					'productID'=>$value1['ProductID'],
					'productName'=>json_decode($product->getProductNameByID($value1['ProductID']),true),
					'quantity'=>$value1['Quantity'],
					'price'=>$value1['Price']
				]);
			}
			$historyItem = array(
				'OrderID'=>$value['ID'],
				'Created'=>$value['CreatedDay'],
				'Products'=>$products,
				'TotalPrice'=>$totalPrice,
				'Status'=>$value['Status']
			);
			array_push($history, $historyItem);
		}
		$this->loadView('Shared','Layout',[
			'title'=>'History',
			'page'=>'Account/History',
			'listTransaction'=>$history
		]);
	}
	public function Purchased(){
		$product = $this->getModel('ProductDAL');
		$account = $this->getModel('AccountDAL');
		$order = $this->getModel('OrderDAL');
		$orderDetail = $this->getModel('OrderDetailDAL');
		$listOrderJSON = json_decode($order->getOrderByAccountID($account->getIDByName($_SESSION['USER_SESSION'])),true);
		$purchased = array();
		foreach ($listOrderJSON as $key => $value) {
			$listOrderDetailJSON = json_decode($orderDetail->getOrderDetailByOrderID($value['ID']),true);
			foreach ($listOrderDetailJSON as $key => $value1) {
				$productItem = json_decode($product->getProductByID($value1['ProductID']),true);
				array_push($purchased, $productItem);
			}
		}
		$this->loadView('Shared','Layout',[
			'title'=>'Purchased',
			'page'=>'Account/Purchased',
			'purchased'=>$purchased
		]);
	}
}
?>