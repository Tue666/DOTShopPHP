<?php  
class OrderDetailDAL extends Database{
	public function insertOrderDetail($orderID,$productID,$quantity,$price){
		$query = "INSERT orderdetail VALUES ($orderID,$productID,'$quantity','$price')";
		return json_encode(mysqli_query($this->connectionString,$query));
	}
}
?>