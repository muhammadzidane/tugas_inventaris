<?php 
	
session_start();
require_once 'files_backend_ajax/php_functions.php';
cek_session();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Tambah Akun Baru</title>
	<link href='https://fonts.googleapis.com/css?family=Bebas Neue' rel='stylesheet'>
	<link rel="stylesheet" type="text/css" href="global_css.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/fontawesome-5.13.1/css/all.min.css">
	<script type="text/javascript" src="bootstrap/js/jquery.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
</head>
<body>
	<form action="files_backend_ajax/backend_setting_akun.php" method="POST" id='form'>
		<div class='header-form font-neue'><h3>Tambahkan Akun Baru</h3></div>
		<a href="setting_akun.php"><div id="closeForm">&times;</div></a>
		<div class='form-group'>
			<label>Username</label>
			<input id="username" name='username' class='form-control' type='text'>
			<div class='pesanValidasi' class="pesanPeringatan"></div>
			<div id="checkAndTimesUsername"></div>
		</div>
		<div class='form-group'>
			<label for='email'>Email</label>
			<input id="email" name='email' class='form-control' type='email'>
			<div class='pesanValidasi'></div>
			<div id="checkAndTimesEmail"></div>
		</div>
		<div class='form-group'>
			<label for='password'>Password</label>
			<input id="password" name='password' class='form-control' type='password' autocomplete="off">
			<div class='pesanValidasi'></div>
			<div id="checkAndTimesPassword"></div>
		</div>
		<div class='form-group'>
			<label for='ulangiPassword'>Ulangi Password</label>
			<input id="ulangiPassword" name='ulangiPassword' class='form-control' type='password' autocomplete="off">
			<div class='pesanValidasi'></div>
			<div id="checkAndTimesUlangiPassword"></div>
		</div>
		<div class='form-group'>
			<label for='jenisRole'>Jenis Role</label>
			<select id="jenisRole" name='jenisRole' class='form-control'>
				<option disabled>-Role-</option>
				<option value="superuser">Superuser</option>
				<option value="moderator">Moderator</option>
			</select>
		</div>
		<div class='form-group float-right'>
			<button type="submit" name="submitTambahAkun" id='buttonTambahAkun' class='btn btn-primary'>Tambah Akun</button>
			<button id='buttonBatal' class='btn btn-danger'>Batal</button>
		</div>
	</form>
	<script src="src_moduls/tambah_akun.js"></script>
	<script src="src_moduls/js_functions.js"></script>
</body>
</html>