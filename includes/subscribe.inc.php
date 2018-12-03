<?php 

require 'connection.php';

if(!empty($_POST['emailsub']) && isset($_POST['emailsub'])){

	$email = $_POST['emailsub'];

	$sql = "SELECT email FROM subscribe WHERE email='$email'";
	$result = mysqli_query($connection, $sql);
	$check = mysqli_num_rows($result);

	if($check > 0) {
		header("Location: ../home.php?info=existsubscribed");
		die();
	} else {
		$sql = "INSERT INTO subscribe (email) VALUES ('$email')";
		$result = mysqli_query($connection, $sql);
		header ("Location: ../home.php?info=subscribed");
	}

	$email = test_input($_POST["emailsub"]);
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  		// $emailErr = "Invalid email format";
  		header("Location: ../home.php?info=invalid_email_subscribe");
  		die(); 
	} else {
		$sql = "INSERT INTO subscribe (email) VALUES ('$email')";
		$result = mysqli_query($connection, $sql);
		header ("Location: ../home.php?info=subscribed");
	}

} else {
	header ("Location: ../home.php?info=unsubscribed");
}

?>