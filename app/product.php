<?php
class product extends db{
	public function addproduct($brand, $name, $price){
		$sql = "INSERT INTO products(brand, name, price) VALUES ('$brand', '$name', '$price')";
		// var_dump($sql);
		$result = self::$conn->query($sql);
		return $result;
	}

	public function deleteproduct($id){
		$sql = "DELETE FROM products WHERE id = $id";
		var_dump($sql);
		$result = self::$conn->query($sql);
		return $result;
	}

	public function getProductById($id){
		$sql = "SELECT * FROM products WHERE id = $id";
		$result = self::$conn->query($sql);
		return $this->getData($result);
	}	

	public function editproduct($brand, $name, $price, $id){
		$sql = "UPDATE products SET brand = '$brand', name = '$name', price = '$price' WHERE id = $id";
		var_dump($sql);
		$result = self::$conn->query($sql);
		return $result;
	}
}