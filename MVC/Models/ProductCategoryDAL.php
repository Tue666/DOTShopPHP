<?php  
class ProductCategoryDAL extends Database{
	public function getListCate(){
		$query = "SELECT ID,CateName FROM productcategory WHERE STATUS = true ORDER BY DisplayOrder";
		$result = mysqli_query($this->connectionString,$query);
		$array = array();
		while ($rows = mysqli_fetch_assoc($result)) {
			$array[] = $rows;
		}
		return json_encode($array);
	}
}
?>