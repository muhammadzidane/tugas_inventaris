<?php  
$conn 	= mysqli_connect("localhost","root","","daftar_inventaris");

// Validasi Username
if (isset($_POST['validasiUsername'])) {
	$val_username 	= $_POST['validasiUsername'];
	$result 		= "SELECT * FROM tb_users WHERE username='$val_username';";
	$query 			= mysqli_query($conn, $result);

	if (mysqli_affected_rows($conn) == 1) {
		echo "Username sudah digunakan, harap gunakan yang lain";
	}
	else {
		echo "berhasil";
	}
} 

// Tambahkan

?>