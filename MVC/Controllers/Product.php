<?php  
class Product extends ViewModel{
	public function Index(){
		$this->loadView('Shared','Layout',[
			'page'=>'Product/Index'
		]);
	}
}
?>