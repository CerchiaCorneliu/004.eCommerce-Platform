<?php 

session_start(); 

require 'connection.php';

if(!empty($_POST['product_name']) && !empty($_POST['price']) && !empty($_POST['quantity']) && !empty($_POST['user_id']) && isset($_POST['product_name']) && isset($_POST['price']) && isset($_POST['quantity']) && isset($_POST['user_id'])) {

	$product_name = $_POST['product_name'];
	$price = $_POST['price'];
	$quantity = $_POST['quantity'];
	$user_id = $_POST['user_id'];

	$sql = "SELECT product_name FROM cart WHERE user_id=".$_SESSION['id']." AND product_name='$product_name'";
	$result = mysqli_query($connection, $sql);
	$check = mysqli_num_rows($result);

	if($check > 0) {
		header("Location: ../home.php?info=exist");
		die();
	} else {
		$sql = "INSERT INTO cart (product_name, price, quantity, user_id) VALUES ('$product_name', '$price', '$quantity','$user_id')";
		$result = mysqli_query($connection, $sql);
		header ("Location: ../mycart.php?info=ok");
	}

} else {
	header ("Location: ../home.php?info=error");
}














 ?>