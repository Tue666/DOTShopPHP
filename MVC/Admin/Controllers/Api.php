<?php
class Api extends ViewModel{
    protected $products;
    public function __construct(){
        $this->products = $this->getModel('ProductDAL');
        $this->account = $this->getModel('AccountDAL');
	}

    /* ------------------------ Accounts API Start ------------------------ */
    // url/Admin/Api/Login
    public function Login(){
        $bodyJSON = file_get_contents('php://input');
        $obj = json_decode($bodyJSON,true);

        $checkLoginJSON = json_decode($this->account->checkLogin($obj["UserName"]),true);
		if ($checkLoginJSON['Status']!=-1){
			if ($checkLoginJSON['Status']!=1){
				echo "{\"token\":\"not activated\"}";
			}
			else{
				if (password_verify($obj["PassWord"],$checkLoginJSON['PassWord'])) {
                    $accountJSON = json_decode($this->account->getAccountByName($obj["UserName"]),true);
					$token = array();
                    $token["ID"] = $accountJSON["ID"];
                    $token["UserName"] = $accountJSON["UserName"];
                    $token["Name"] = $accountJSON["Name"];
                    $token["Email"] = $accountJSON["Email"];
                    $token["Type"] = $accountJSON["Type"];
                    $token["Expire"] = time() + (7*24*60*60); // Token period is 7 days 24 hours 60 minutes 60 seconds

                    $JWT = JWT::encode($token,"SECRET_KEY");
                    echo JsonHelper::getJson("token",$JWT);
				}
				else{
					echo "{\"token\":\"wrong\"}";
				}
			}
		}
		else{
            echo "{\"token\":\"wrong\"}";
		}
    }
    /* ------------------------ Accounts API End ------------------------ */

    /* ------------------------ Products API Start ------------------------ */
    // url/Admin/Api/ListProducts
    public function ListProducts(){
        print_r($this->products->getListProduct());
    }
    // url/Admin/Api/Product/$id
    public function Product($productID){
        print_r($this->products->getProductByID($productID));
    }
    // url/Admin/Api/TopView/$number
    public function TopView($number){
        print_r($this->products->getTopView($number));
    }
    // url/Admin/Api/TopHot/$number
    public function TopHot($number){
        print_r($this->products->getTopHot($number));
    }
    // url/Admin/Api/TopNew/$number
    public function TopNew($number){
        print_r($this->products->getTopView($number));
    }
    // url/Admin/Api/Related/$productCateID
    public function Related($productCateID){
        print_r($this->products->getRelatedProduct($productCateID));
    }
    // url/Admin/Api/ProductsByCate/$cateID
    public function ProductsByCate($cateID){
        print_r($this->products->getProductByCateID($cateID));
    }
    /* ------------------------ Products API End ------------------------ */

    /* ------------------------ Product Categories API Start ------------------------ */
    // url/Admin/Api/ListCate
    public function ListCate(){
        $categories = $this->getModel('ProductCategoryDAL');
        print_r($categories->getListCate());
    }
    /* ------------------------ Product Categories API End ------------------------ */

    /* ------------------------ Cart API Start ------------------------ */
    // url/Admin/Api/ListCart
    public function ListCart(){
        $bodyJSON = file_get_contents('php://input');
        $obj = json_decode($bodyJSON,true);
        
        try{
            $token = JWT::decode($obj['Token'],'SECRET_KEY',true);
            if ($token->Expire < time()){
                echo "TOKEN has expired";
            }
            else{
                $cart = $this->getModel('CartDAL');
                print_r($cart->getCartByUserID($token->ID));
            }
        }
        catch (Exeption $e){
            echo $e;
        }
    }
    // url/Admin/Api/AddCart
    public function AddCart(){
        $bodyJSON = file_get_contents('php://input');
        $obj = json_decode($bodyJSON,true);
        
        try{
            $token = JWT::decode($obj['Token'],'SECRET_KEY',true);
            if ($token->Expire < time()){
                echo "TOKEN has expired";
            }
            else{
                $cart = $this->getModel('CartDAL');
                $productJSON = json_decode($this->products->getProductByID($obj['ProductID']),true);
                if ($cart->addCart($token->ID,$obj['ProductID'],$productJSON['ProductName'],$productJSON['Image'],$obj['Quantity'],$productJSON['Quantity'],$obj['Quantity']*$productJSON['Price'])){
                    echo true;
                }
                else{
                    echo false;
                }
            }
        }
        catch (Exeption $e){
            echo $e;
        }
    }
    // url/Admin/Api/RemoveItem
    public function RemoveItem(){
        $bodyJSON = file_get_contents('php://input');
        $obj = json_decode($bodyJSON,true);
        
        try{
            $token = JWT::decode($obj['Token'],'SECRET_KEY',true);
            if ($token->Expire < time()){
                echo "TOKEN has expired";
            }
            else{
                $cart = $this->getModel('CartDAL');
                if ($cart->removeItem($token->ID,$obj['ProductID'])){
                    echo true;
                }
                else{
                    echo false;
                }
            }
        }
        catch (Exeption $e){
            echo $e;
        }
    }
    // url/Admin/Api/ClearCart
    public function ClearCart(){
        $bodyJSON = file_get_contents('php://input');
        $obj = json_decode($bodyJSON,true);
        
        try{
            $token = JWT::decode($obj['Token'],'SECRET_KEY',true);
            if ($token->Expire < time()){
                echo "TOKEN has expired";
            }
            else{
                $cart = $this->getModel('CartDAL');
                if ($cart->clearCart($token->ID)){
                    echo true;
                }
                else{
                    echo false;
                }
            }
        }
        catch (Exeption $e){
            echo $e;
        }
    }
    /* ------------------------ Cart API End ------------------------ */
}
?>