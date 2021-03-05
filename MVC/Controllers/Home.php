<?php  
class Home extends ViewModel{
	public function Index(){
		$this->loadView('Shared','Layout',[
			'page'=>'Home/Index'
		]);
	}
}
?>