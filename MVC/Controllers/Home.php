<?php  
class Home extends ViewModel{
	public $product;
	function __construct(){
		$this->product = $this->getModel('ProductDAL');
	}
	public function Index(){
		$listHotJSON = json_decode($this->product->getTopHot(8),true);
		$listNewJSON = json_decode($this->product->getTopNew(8),true);
		$this->loadView('Shared','Layout',[
			'page'=>'Home/Index',
			'listHot'=>$listHotJSON,
			'listNew'=>$listNewJSON
		]);
	}
}
?>