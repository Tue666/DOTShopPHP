<?php  
class OrderDAL extends Database{
	public function insertOrder($customerID,$customerName,$customerAddress,$customerPhone,$customerEmail){
		$query = "INSERT orders VALUES (NULL,$customerID,'$customerName','$customerPhone','$customerAddress','$customerEmail',NOW(),1)";
		if (mysqli_query($this->connectionString,$query)){
			return json_encode(mysqli_insert_id($this->connectionString));
		}
	}
}
?>