<?php 

session_start();
require 'connection.php';

if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])) {

	$email = $_POST['email'];
	$password = $_POST['password'];
	
	$sql = "SELECT * FROM users WHERE email = '$email'";
	$result = mysqli_query($connection, $sql);
	
	$row = $result->fetch_assoc();
	$hash = $row['password'];
	
	$check = password_verify($password, $hash);
	
	if ($check == 0) {
		header("Location: ../signin.php?info=incorrect");
		die();
	} else {
		$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$hash'";
		$result = mysqli_query($connection, $sql);

		if (!$row = $result->fetch_assoc()) {
			echo 'Incorrect email or password!';
		} else {
			$_SESSION['id'] = $row['id'];
			$_SESSION['firstname'] = $row['firstname'];
			$_SESSION['lastname'] = $row['lastname'];
			$_SESSION['username'] = $row['username'];
			$_SESSION['email'] = $row['email'];
		}
		
	}

}

header("Location: ../signin.php");

?>