<?php  
class Product extends ViewModel{
	public $productCategory;
	public $product;
	function __construct(){
		$this->productCategory = $this->getModel('ProductCategoryDAL');
		$this->product = $this->getModel('ProductDAL');
	}
	public function Index(){
		$listCateJSON = json_decode($this->productCategory->getListCate(),true);
		$listProductJSON = json_decode($this->product->getProduct(),true);
		$this->loadView('Shared','Layout',[
			'title'=>'Product',
			'page'=>'Product/Index',
			'listCate'=>$listCateJSON,
			'listProduct'=>$listProductJSON
		]);
	}
	public function Detail($productID){
		$productJSON = json_decode($this->product->getProductByID($productID),true);
		$relatedProductJSON = json_decode($this->product->getRelatedProduct($productJSON['IDCate']),true);
		$this->loadView('Shared','Layout',[
			'title'=>$productJSON['ProductName'],
			'page'=>'Product/Detail',
			'single'=>$productJSON,
			'relatedProduct'=>$relatedProductJSON
		]);
	}
}
?>