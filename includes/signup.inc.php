<?php 

require 'connection.php';

if(!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {

	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$username = strtolower($_POST['username']);
	$email = $_POST['email'];
	$password = $_POST['password'];

	$password_hashed = password_hash($password, PASSWORD_DEFAULT);

	$sql = "SELECT email FROM users WHERE email='$email'";
	$result = mysqli_query($connection, $sql);
	$check = mysqli_num_rows($result);

	if($check > 0) {
		header("Location: ../signup.php?info=exist");
		die();
	} else {
		$sql = "INSERT INTO users (firstname, lastname, username, email, password) VALUES ('$firstname', '$lastname', '$username','$email', '$password_hashed')";
		$result = mysqli_query($connection, $sql);
		header ("Location: ../signup.php?info=ok");
	}

	$email = test_input($_POST["email"]);
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  		// $emailErr = "Invalid email format";
  		header("Location: ../signup.php?info=invalid_email");
  		die(); 
	} else {
		$sql = "INSERT INTO users (firstname, lastname, username, email, password) VALUES ('$firstname', '$lastname', '$username','$email', '$password_hashed')";
		$result = mysqli_query($connection, $sql);
		header ("Location: ../signup.php?info=ok");
	}

} else {
	header ("Location: ../signup.php?info=error");
}



?>