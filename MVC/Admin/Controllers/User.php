<?php 
class User extends ViewModel{
    public function __construct(){
        if (empty($_SESSION['USER_SESSION'])){
			header('Location:'.BASE_URL.'Login/Index');
		}
    }
    public function Index(){
        $account = $this->getModel('AccountDAL');
        $listAccountJSON = json_decode($account->getListAccount(),true);
        $this->loadView('Shared','Layout',[
            'title'=>'Users',
            'page'=>'User/Index',
            'listAccount'=>$listAccountJSON
        ],1);
    }
}
?>