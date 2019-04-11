<?php 
	require "app/users.php";
	session_start();
	unset($_SESSION['user']);
	header('location:./');
?>
