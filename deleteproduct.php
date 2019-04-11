<?php
$id = $_GET['id'];
spl_autoload_register(function ($class_name){
    require "app/" .$class_name . ".php";
});
$product = new product();
$product->deleteproduct($id);
header("location:admin.php");
?>