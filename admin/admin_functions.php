<?php  include('../db/db.php'); ?>

<?php

// Create admin
if (isset($_POST['create_admin'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$role = $_POST['role'];
	$query = "INSERT INTO users (username, password, roll) VALUES('$username', '$password', '$role')";
	$dbh->exec($query);
	header("location: users.php");
}

?>