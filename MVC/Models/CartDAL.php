<?php
class CartDAL extends Database{
    public function addCart($userID,$productID,$productName,$productImage,$quantity,$maxQuantity,$price){
        $query = "INSERT cart VALUES (NULL,$userID,$productID,'$productName','$productImage',$quantity,$maxQuantity,$price)";
        return json_encode(mysqli_query($this->connectionString,$query));
    }
    public function removeItem($userID,$productID){
        $query = "DELETE FROM cart WHERE UserID = $userID AND ProductID = $productID";
        return json_encode(mysqli_query($this->connectionString,$query));
    }
    public function clearCart($userID){
        $query = "DELETE FROM cart WHERE UserID = $userID";
        return json_encode(mysqli_query($this->connectionString,$query));
    }
    public function updateQuantity($userID,$productID,$newQuantity,$singlePrice){
        $query = "UPDATE cart SET Quantity = $newQuantity, Price = $newQuantity*$singlePrice WHERE UserID = $userID AND ProductID = $productID";
        return json_encode(mysqli_query($this->connectionString,$query));
    }
    public function getCartByUserID($userID){
        $query = "SELECT * FROM cart WHERE UserID = $userID";
        $result = mysqli_query($this->connectionString,$query);
        $array = array();
        while ($rows = mysqli_fetch_assoc($result)){
            $array[] = $rows;
        }
        return json_encode($array);
    }
}
?>