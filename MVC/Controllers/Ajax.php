<?php  
class Ajax extends ViewModel{
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
}
?>