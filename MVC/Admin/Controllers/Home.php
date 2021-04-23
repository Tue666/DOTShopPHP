<?php  
class Home extends ViewModel{
	public function __construct(){
		if (empty($_SESSION['USER_SESSION'])){
			header('Location:'.BASE_URL.'Login/Index');
		}
	}
	public function Index(){
		$this->loadView('Shared','Layout',[
			'title'=>'Dashboard',
			'page'=>'Home/Index',
		],1);
	}
}
?>