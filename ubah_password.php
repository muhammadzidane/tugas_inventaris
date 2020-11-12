<?php 
session_start();

$conn 			= mysqli_connect("localhost","root","","tugas_inventaris");

// Mengambil value dari database untuk mengisi tag <input> value 
$kode_karyawan 	= (isset($_GET['kode_karyawan'])) ? $_GET['kode_karyawan'] : "";
$username 		= (isset($_GET['username'])) ? $_GET['username'] : "";
$result 		= "SELECT * FROM tb_karyawan WHERE kode_karyawan='$kode_karyawan';";
$query 			= mysqli_query($conn, $result);


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ubah Password</title>
	<link href='https://fonts.googleapis.com/css?family=Bebas Neue' rel='stylesheet'>
	<link rel="stylesheet" type="text/css" href="global_css.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/fontawesome-5.13.1/css/all.min.css">
	<script type="text/javascript" src="bootstrap/js/jquery.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
</head>
<body>
	<form action='setting_akun.php' method="GET" id='form'>
		<div class='header-form font-neue'><h3>Ubah Password</h3></div>
		<div id="closeForm">&times;</div>
		<div class='form-group'>
			<label for='username'>Username</label>
			<input id='username' class='form-control' type='text' autocomplete="off" value="<?php echo $username; ?>" readonly>
			<div class='pesanValidasi'></div>
		</div>
		<div class='form-group'>
			<label for='masukanPasswordLama'>Masukan Password Lama</label>
			<input id='masukanPasswordLama' class='form-control' type='password' autocomplete="off">
			<div class='pesanValidasi'></div>
		</div>
		<div class='form-group'>
			<label for='passwordBaru'>Password Baru</label>
			<input id='passwordBaru' class='form-control' type='password' autocomplete="off" >
			<div class='pesanValidasi'></div>
		</div>
		<div class='form-group'>
			<label for='ulangiPassword'>Ulangi Password</label>
			<input id='ulangiPassword' class='form-control' type='password' autocomplete="off">
			<div class='pesanValidasi'></div>
		</div>
		<div class='form-group float-right'>
			<button id='buttonUbah' class='btn btn-primary'>Ubah</button>
			<button id='buttonBatal' class='btn btn-danger'>Batal</button>
		</div>
	</form>
	<script src="src_moduls/ubah_password.js"></script>
	<script src="src_moduls/js_functions.js"></script>
</body>
</html>