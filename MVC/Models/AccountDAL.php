<?php  
class AccountDAL extends Database{
	public function checkExist($userName){
		$query = "SELECT * FROM account WHERE UserName = '$userName'";
		$result = mysqli_query($this->connectionString,$query);
		return json_encode(mysqli_num_rows($result)>0);
	}
	public function insertAccount($userName,$passWord){
		$query = "INSERT account VALUES (NULL,'$userName','$passWord',NULL,NULL,NULL,NULL,NULL,NULL,NOW(),0,1)";
		return json_encode(mysqli_query($this->connectionString,$query));
	}
	public function checkLogin($userName){
		$query = "SELECT PassWord,Status FROM account WHERE UserName = '$userName' LIMIT 1";
		$result = mysqli_query($this->connectionString,$query);
		$rows = mysqli_fetch_assoc($result);
		$PassWord;
		$Status;
		if (isset($rows['PassWord'])){
			$PassWord = $rows['PassWord'];
			$Status = $rows['Status'];
		}
		else{
			$PassWord = '';
			$Status = -1;
		}
		return json_encode(['PassWord'=>$PassWord,'Status'=>$Status]);
	}
	public function getTypeByName($userName){
		$query = "SELECT Type FROM account WHERE UserName = '$userName' LIMIT 1";
		$result = mysqli_query($this->connectionString,$query);
		$rows = mysqli_fetch_assoc($result);
		return json_decode(isset($rows['Type'])?$rows['Type']:0);
	}
	public function getIDByName($userName){
		$query = "SELECT ID FROM account WHERE UserName = '$userName' LIMIT 1";
		$result = mysqli_query($this->connectionString,$query);
		$rows = mysqli_fetch_assoc($result);
		return json_decode(isset($rows['ID'])?$rows['ID']:0);
	}
}
?>