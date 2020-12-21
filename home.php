<?php 
session_start();
require_once 'files_backend_ajax/php_functions.php';
cek_session();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link href='https://fonts.googleapis.com/css?family=Bebas Neue' rel='stylesheet'>
	<link rel="stylesheet" type="text/css" href="global_css.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/fontawesome-5.13.1/css/all.min.css">
	<script type="text/javascript" src="bootstrap/js/jquery.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
</head>
</head>
<body>
	<nav class="navbar navbar-expand-sm bg-tomato sticky-top">
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link text-white actived" href="home.php">Home</a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-white" href="daftar_pegawai.php">Daftar Pegawai</a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-white" href="data_barang.php">Data Barang</a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-white" href="barang_masuk.php">Barang Masuk</a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-white" href="barang_keluar.php">Barang Keluar</a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-white" href="setting_akun.php">Setting Akun</a>
			</li>
		</ul>
		<a href="index.php" class="ml-auto">
			<button id="logout" class="btn btn-warning btn-sm">
				Logout
				<i class="fas fa-sign-out-alt"></i>
			</button>
		</a>
	</nav>
	<div class="container">
		<div class="judul font-neue w-25">Daftar Inventaris Karyawan IT+</div>
		<div class="cards">
			<div class="justify-content-between d-flex">
				<a class="header-modul-location" href="daftar_pegawai.php">
					<div id="daftarPegawai" class="d-flex columns">
						<div class="column-pink-1 "><i class="fas fa-users fa-5x"></i></div>
						<div class="column-pink-2 text-center pt-3">
							<h4 class="font-neue link-nav pt-5">Daftar Pegawai</h4>
						</div>
					</div>
				</a>
				<a class="header-modul-location" href="data_barang.php">
					<div id="dataBarang" class="d-flex columns">
						<div class="column-orange-1"><i class="fas fa-boxes fa-5x"></i></div>
						<div class="column-orange-2 text-center pt-3">
							<h4 class="font-neue link-nav pt-5">Data Barang</h4>
						</div>
					</div>
				</a>
				<a class="header-modul-location" href="barang_masuk.php">
					<div id="barangMasuk" class="d-flex columns">
						<div class="column-pink-1"><i class="fas fa-box-open fa-5x"></i><i class="fas fa-plus"></i></div>
						<div class="column-pink-2 text-center pt-3">
							<h4 class="font-neue link-nav pt-5">Barang Masuk</h4>
						</div>
					</div>
				</a>
			</div>		
			<div class="justify-content-around d-flex">
				<a class="header-modul-location" href="barang_keluar.php">
					<div id="barangKeluar" class="d-flex columns">
						<div class="column-orange-1"><i class="fas fa-box-open fa-5x"></i><i class="fas fa-minus"></i></div>
						<div class="column-orange-2 text-center pt-3">
							<h4 class="font-neue link-nav pt-5">Barang Keluar</h4>
						</div>
					</div>
				</a>
				<a class="header-modul-location" href="setting_akun.php">
					<div id="settingAkun" class="d-flex columns">
						<div class="column-orange-1"><i class="fas fa-user-cog fa-5x"></i></div>
						<div class="column-orange-2 text-center pt-3">
							<h4 class="font-neue link-nav pt-5">Setting Akun</h4>
						</div>
					</div>
				</a>
			</div>
		</div>
	</div>
	<footer>
		<p class="text-white pt-2 ml-3">Tugas Inventaris 2020</p>
	</footer>
</body>
</html>