<?php  
class OrderDAL extends Database{
	public function insertOrder($customerID,$customerName,$customerAddress,$customerPhone,$customerEmail){
		$query = "INSERT orders VALUES (NULL,$customerID,'$customerName','$customerPhone','$customerAddress','$customerEmail',NOW(),0)";
		if (mysqli_query($this->connectionString,$query)){
			return json_encode(mysqli_insert_id($this->connectionString));
		}
	}
	public function getOrderByAccountID($accountID){
		$query = "SELECT ID,CreatedDay,Status FROM orders WHERE CustomerID = $accountID ORDER BY CreatedDay DESC";
		$result = mysqli_query($this->connectionString,$query);
		$array = array();
		while ($rows = mysqli_fetch_assoc($result)) {
			$array[] = $rows;
		}
		return json_encode($array);
	}
}
?>