<?php 

$connection = mysqli_connect('localhost', 'root', '', 'authentication');

if (!$connection) {
	die('Connection to database failed!');
}

?>