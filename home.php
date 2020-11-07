<?php 
session_start();
require_once 'php_functions.php';
cek_session();

$sess_role 			= (isset($_SESSION['role'])) ? $_SESSION['role'] : "";

?>
<!DOCTYPE html>
<html>
<head>
	<title>Website Inventaris</title>
	<link href='https://fonts.googleapis.com/css?family=Bebas Neue' rel='stylesheet'>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="fontawesome-5.13.1/css/all.min.css">
	<script type="text/javascript" src="bootstrap/js/jquery.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
	<style>
		body {
			background-color: #F8F8F8;
		}
		nav {
			height: 44px;
		}
		.judul{
			font-size: 32px;
		}
		.header-modul-location, .header-modul-location:hover{
			text-decoration: none;
			color: black;
		}
		.judul-tanggal{
			font-size: 24px;
			border-bottom: 3px solid black;
			margin: 0 auto;
			width: 50%;
		}
		.actived {
			background-color: #ff3333;
			border-top: 3px solid #FCB913; 
		}
		.page-circle {
			text-align: center;
			color: black;
			padding: 8px 16px;
			margin: 0 1px;
			border-radius: 100%;
		}
		.page-circle:hover {
			background-color: tomato;
			color: #FFFFFF;
			text-decoration: none; 
		}
		.bg-tomato {
			background-color: tomato;
		}
		.form-group{
			margin: 10px;
		}
		.home-header {
			margin: 55px auto;
			text-align: center;
			border-bottom: 3px solid black;
			width: 300px;
		}
		.columns {
			width: 320px;
			margin: 20px 0px;
			box-shadow: 1px 1px 6px black;
			cursor: pointer;
		}
		.columns:hover {
			box-shadow: 0px 0px 10px 2px black;
		}
		.column-orange-1 {
			padding-top: 32px;
			text-align: center;
			color: #ffffff;
			width: 150px;
			height: 160px;
			background-color: #ff9f43;
		}
		.column-orang-2 {
			width: 200px;
			height: 160px;
			background-color: #ffffff;
			border-bottom: 3px solid #ff9f43;
		}
		.link-nav {
			margin: 60px 0px;
		}
		.column-yellow-1 {
			padding-top: 32px;
			text-align: center;
			color: #ffffff;
			width: 150px;
			height: 160px;
			background-color: #FFBB00;
		}
		.column-yellow-2 {
			width: 200px;
			height: 160px;
			background-color: #ffffff;
			border-top: 3px solid #FFBB00;
		}
		.filsearch { margin: 11px 0px; }
		.c-pointer { cursor: pointer; }
		.font-neue { font-family: 'Bebas Neue'; }
		footer {
			background-color: #24305E;
			width: 100%;
			height: 50px;
			margin-top: 100px; 
		}
	</style>
</head>
<body>
	<header>
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
			<div class="navbar-text text-white ml-auto" id="waktu"></div>
			<a href="index.php">
				<button id="logout" class=" btn btn-info ml-3">
					Logout
					<i class="fas fa-sign-out-alt"></i>
				</button>
			</a>
		</nav>
	</header>
	<main>
		<div class="container">
			<header>
				<div class="judul text-center mt-3 font-neue">Daftar Inventaris Karyawan IT+</div>
				<div class="judul-tanggal mb-1 text-center font-neue">Tahun 2020</div>
			</header>
			<div id class="justify-content-between d-flex">
				<a class="header-modul-location" href="daftar_pegawai.php">
					<div id="daftarPegawai" class="d-flex columns my-5">
						<div class="column-yellow-1"><i class="fas fa-users fa-5x"></i></div>
						<div class="column-yellow-2 text-center">
							<h3 class="font-neue link-nav">Daftar Pegawai</h3>
						</div>
					</div>
				</a>
				<a class="header-modul-location" href="data_barang.php">
					<div id="dataBarang" class="d-flex columns my-5">
						<div class="column-orange-1"><i class="fas fa-boxes fa-5x"></i></div>
						<div class="column-orang-2 text-center">
							<h3 class="font-neue link-nav">Data Barang</h3>
						</div>
					</div>
				</a>
				<a class="header-modul-location" href="barang_masuk.php">
					<div id="barangMasuk" class="d-flex columns my-5">
						<div class="column-yellow-1"><i class="fas fa-box-open fa-5x"></i><i class="fas fa-plus"></i></div>
						<div class="column-yellow-2 text-center">
							<h3 class="font-neue link-nav">Barang Masuk</h3>
						</div>
					</div>
				</a>
			</div>		
			<div class="justify-content-around d-flex">
				<a class="header-modul-location" href="barang_keluar.php">
					<div id="barangKeluar" class="d-flex columns my-5">
						<div class="column-orange-1"><i class="fas fa-box-open fa-5x"></i><i class="fas fa-minus"></i></div>
						<div class="column-orang-2 text-center">
							<h3 class="font-neue link-nav">Barang Keluar</h3>
						</div>
					</div>
				</a>
				<a class="header-modul-location" href="setting_akun.php">
					<div id="settingAkun" class="d-flex columns my-5">
						<div class="column-orange-1"><i class="fas fa-user-cog fa-5x"></i></div>
						<div class="column-orang-2 text-center">
							<h3 class="font-neue link-nav">Setting Akun</h3>
						</div>
					</div>
				</a>
			</div>
		</div>
	</main>
	<footer>
		<p class="text-white pt-2 ml-3">Tugas Inventaris 2020</p>
	</footer>
</body>
</html>