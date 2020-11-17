<?php 
session_start();
require_once 'files_backend_ajax/php_functions.php';
cek_session();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Tambahkan Karyawan Baru</title>
	<link href='https://fonts.googleapis.com/css?family=Bebas Neue' rel='stylesheet'>
	<link rel="stylesheet" type="text/css" href="global_css.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/fontawesome-5.13.1/css/all.min.css">
	<script type="text/javascript" src="bootstrap/js/jquery.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
</head>
<body>
	<form id='form' action="files_backend_ajax/backend_daftar_karyawan.php" method="POST">
		<div class='header-form font-neue'><h3>Tambahkan Karyawan Baru</h3></div>
		<a href="daftar_pegawai.php"><div id="closeForm">&times;</div></a>
		<div class='form-group'>
			<label for='kodeKaryawan'>Kode Karyawan</label>
			<input id='kodeKaryawan' name='kodeKaryawan' class='form-control' type='text'>
			<div class='pesanValidasi'></div>
		</div>
		<div class='form-group'>
			<label for='namaKaryawan'>Nama Karyawan</label>
			<input id='namaKaryawan' name='namaKaryawan' class='form-control' type='text'>
			<div class='pesanValidasi'></div>
		</div>
		<div class='form-group'>
			<label for='posisiJabatan'>Posisi Jabatan</label>
			<select id='posisiJabatan' name='posisiJabatan' class='form-control'>
				<option disabled>-Posisi Jabatan-</option>
				<option>Programmer</option>
				<option>UI/UX Designer</option>
				<option>Software Engineer</option>
				<option>Akutansi</option>
				<option>Customer Service</option>
				<option>Direktur</option>
				<option>Seketaris</option>
				<option>HRD</option>
			</select>
		</div>
		<div class='form-group'>
			<label for='email'>Email</label>
			<input id='email' name='email' class='form-control' type='text'>
			<div class='pesanValidasi'></div>
		</div>
		<div class='form-group'>
			<label for='pendidikanTerakhir'>Pendidikan Terakhir</label>
			<input id='pendidikanTerakhir' name='pendidikanTerakhir' class='form-control' type='text'>
			<div class='pesanValidasi'></div>
		</div>
		<div class='form-group'>
			<label for='alamat'>Alamat</label>
			<input id='alamat' name='alamat' class='form-control' type='text'>
			<div class='pesanValidasi'></div>
		</div>
		<div class='form-group'>
			<label for='foto'>Foto</label>
			<input id='foto' name='foto' class='form-control' type='text'>
			<div class='pesanValidasi'></div>
		</div>
		<div class='form-group float-right'>
			<button type="submit" id='acceptTambah' class='btn btn-primary'>Tambah</button>
			<input type="hidden" name="submitTambahKaryawan" value="kontol">
			<button id='buttonBatal' class='btn btn-danger'>Batal</button>
		</div>
	</form>
	<script src="src_moduls/tambah_karyawan.js"></script>
	<script src="src_moduls/js_functions.js"></script>
</body>
</html>