<?php
class productype extends db{
	public function addprotype($brand){
		$sql ="INSERT INTO producttype(brand) VALUES ('$brand')";
		$result = self::$conn->query($sql);
		return $result;
	}
}
?>