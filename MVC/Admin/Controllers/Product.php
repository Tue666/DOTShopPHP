<?php 
class Product extends ViewModel{
    public function __construct(){
        if (empty($_SESSION['USER_SESSION'])){
			header('Location:'.BASE_URL.'Login/Index');
		}
    }
    public function Index(){
        $product = $this->getModel('ProductDAL');
        $productCate = $this->getModel('ProductCategoryDAL');
        $listProductJSON = json_decode($product->getListProduct(),true);
        $listProductCateJSON = json_decode($productCate->getListCate(),true);
        $this->loadView('Shared','Layout',[
            'title'=>'Products',
            'page'=>'Product/Index',
            'listProduct'=>$listProductJSON,
            'listProductCate'=>$listProductCateJSON
        ],1);
    }
}
?>