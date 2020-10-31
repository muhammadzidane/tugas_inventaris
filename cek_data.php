<?php 
	$conn 		= mysqli_connect("localhost","root","","daftar_inventaris");
	$username 	= (isset($_POST['username'])) ? $_POST['username'] : "";
	$password 	= (isset($_POST['password'])) ? sha1($_POST['password']) : "";
	$result 	= "SELECT * FROM role_superuser WHERE username LIKE '$username' AND password LIKE '$password'";
	$query 		= mysqli_query($conn,$result);

	if (mysqli_affected_rows($conn) === 0) {
		header("Location: index.php");
	}
?>