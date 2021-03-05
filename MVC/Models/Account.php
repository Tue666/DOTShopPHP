<?php  
class Account extends Database{
	public function checkExist($userName){
		$query = "SELECT * FROM account WHERE UserName = '$userName'";
		$rows = mysqli_query($this->connectionString,$query);
		return json_encode(mysqli_num_rows($rows)>0);
	}
	public function insertAccount($userName,$passWord){
		$query = "INSERT account VALUES (NULL,'$userName','$passWord')";
		return json_encode(mysqli_query($this->connectionString,$query));
	}
	public function checkLogin($userName){
		$query = "SELECT PassWord FROM account WHERE UserName = '$userName' LIMIT 1";
		$rows = mysqli_query($this->connectionString,$query);
		$result = mysqli_fetch_assoc($rows);
		return isset($result['PassWord'])?$result['PassWord']:'';
	}
}
?>