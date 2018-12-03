<?php

session_start();  

require 'connection.php';

if(!empty($_GET['product_name']) && isset($_GET['product_name'])) {
	$product_name = $_GET['product_name'];
	$sql = "DELETE FROM cart WHERE product_name = '$product_name' AND user_id=".$_SESSION['id'];
	$result = mysqli_query($connection, $sql);

	if($result) {
		header ("Location: ../mycart.php?info=ok");
		die();
	} else {
		echo "Error deleting record:". mysqli_error($connection);
	}

} else {
	header ("Location: ../home.php?info=error");
}

?>