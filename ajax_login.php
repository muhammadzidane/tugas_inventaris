<?php
$conn 		= mysqli_connect("localhost","root","","daftar_inventaris");

// AJAX dari index.php (Halaman Login) \\
if (isset($_POST["halaman_login"])) {
	$username 		= (isset($_POST['username'])) ? $_POST['username'] : "";
	$password 		= (isset($_POST['password'])) ? sha1($_POST['password']) : "";

	
	$result 	= "SELECT * FROM role_superuser WHERE username = '$username' AND password = '$password'";
	$query 		= mysqli_query($conn,$result);

	if (mysqli_affected_rows($conn) == 0) {
		echo "<small>Username/Password tidak sesuai*</small>";		
	}
	
}

// AJAX dari test.php (Hanya Test) \\
// if (isset($_POST['test'])) {
	// echo "<h1>Hello World !!!!!</h1>";
// }
?>
