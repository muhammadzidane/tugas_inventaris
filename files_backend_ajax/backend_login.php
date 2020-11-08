<?php 

session_start();
$conn 	= mysqli_connect('localhost','root','','tugas_inventaris');

// AJAX dari index.php (Halaman Login) \\
if (isset($_POST["halaman_login"])) {
	$username 		= (isset($_POST['username'])) ? $_POST['username'] : "";
	$password 		= (isset($_POST['password'])) ? sha1($_POST['password']) : "";


	$result 	= "SELECT * FROM tb_users WHERE username = '$username' AND password = '$password';";
	$query 		= mysqli_query($conn, $result);

	if (mysqli_affected_rows($conn) == 0) {
		echo "<small>Username/Password tidak sesuai*</small>";		
	}
	else if (mysqli_affected_rows($conn) == 1) {
		$data 					= mysqli_fetch_assoc($query);
		$role 					= $data['role'];		 
		$_SESSION['username'] 	= $username;
		$_SESSION['role'] 		= $role;
	}
	// else {
		// echo "kontol";
	// }
}

?>