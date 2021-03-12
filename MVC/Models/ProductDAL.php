<?php  
class ProductDAL extends Database{
	public function updateView($productID){
		$query = "UPDATE product SET View = View + 1 WHERE ID = $productID";
		$result = mysqli_query($this->connectionString,$query);
		return json_encode(mysqli_num_rows($result) > 0);
	}
	public function updateCount($productID){
		$query = "UPDATE product SET Count = Count + 1 WHERE ID = $productID";
		return json_encode(mysqli_query($this->connectionString,$query));
	}
	public function getProduct(){
		$query = "SELECT ID,ProductName,IDCate,Image,Price FROM product WHERE STATUS = true";
		$result = mysqli_query($this->connectionString,$query);
		$array = array();
		while ($rows = mysqli_fetch_assoc($result)) {
			$array[] = $rows;
		}
		return json_encode($array);
	}
	public function getTopHot($number){
		$query = "SELECT ID,ProductName,IDCate,Image,Price FROM product WHERE STATUS = true ORDER BY Count DESC LIMIT $number";
		$result = mysqli_query($this->connectionString,$query);
		$array = array();
		while ($rows = mysqli_fetch_assoc($result)) {
			$array[] = $rows;
		}
		return json_encode($array);
	}
	public function getTopNew($number){
		$query = "SELECT ID,ProductName,IDCate,Image,Price FROM product WHERE STATUS = true ORDER BY CreatedDay DESC LIMIT 8";
		$result = mysqli_query($this->connectionString,$query);
		$array = array();
		while ($rows = mysqli_fetch_assoc($result)) {
			$array[] = $rows;
		}
		return json_encode($array);
	}
	public function getTopView($number){
		$query = "SELECT ID,ProductName,IDCate,Image,Price,View FROM product WHERE STATUS = true ORDER BY View DESC LIMIT 8";
		$result = mysqli_query($this->connectionString,$query);
		$array = array();
		while ($rows = mysqli_fetch_assoc($result)) {
			$array[] = $rows;
		}
		return json_encode($array);
	}
	public function getProductByID($productID){
		$query = "SELECT * FROM product WHERE ID = $productID LIMIT 1";
		$result = mysqli_query($this->connectionString,$query);
		return json_encode(mysqli_fetch_assoc($result));
	}
	public function getRelatedProduct($productCateID){
		$query = "SELECT ID,ProductName,Image,Price FROM product WHERE IDCate = $productCateID";
		$result = mysqli_query($this->connectionString,$query);
		$array = array();
		while ($rows = mysqli_fetch_assoc($result)) {
			$array[] = $rows;
		}
		return json_encode($array);
	}
}
?>