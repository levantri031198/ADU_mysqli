<?php
require "app/products.php";
$name = $_POST['name'];
$price = $_POST['price'];
$brand = $_POST['brand'];
//$img = $_FILES['fileUpload']['name'];
spl_autoload_register(function ($class_name){
    require "app/" .$class_name . ".php";
});
$product = new product();
$product->addproduct($brand, $name, $price, '');

$target_dir = "./public/img/";
//$target_img = $target_dir . basename($_FILES['fileUpload']);

//move_uploaded_file($_FILES['fileUpload'], $target_img);

header('location:index.php');
?>