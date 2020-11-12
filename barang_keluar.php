<?php 
session_start();
require_once 'files_backend_ajax/php_functions.php';
cek_session();

$sess_role 		= (isset($_SESSION['role'])) ? $_SESSION['role'] : "";

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Barang Keluar</title>
	<link href='https://fonts.googleapis.com/css?family=Bebas Neue' rel='stylesheet'>
	<link rel="stylesheet" type="text/css" href="global_css.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/fontawesome-5.13.1/css/all.min.css">
	<script type="text/javascript" src="bootstrap/js/jquery.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
</head>
<body>
	<nav class="navbar navbar-expand-sm bg-tomato sticky-top">
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link text-white" href="home.php">Home</a>
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
				<a class="nav-link text-white actived" href="barang_keluar.php">Barang Keluar</a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-white" href="setting_akun.php">Setting Akun</a>
			</li>
		</ul>
		<a href="index.php" class="ml-auto">
			<button id="logout" class=" btn btn-warning btn-sm">
				Logout
				<i class="fas fa-sign-out-alt"></i>
			</button>
		</a>
	</nav>
	<div class="container">
		<h1 class="judul font-neue">Barang Keluar</h1>
		<div class="cards">
			<div class="d-flex justify-content-between filsearch">
				<div class="search-icon">
					<input id="searchBarang" type="text" autocomplete="off"
					placeholder="Cari Nama Barang">
					<i class="fas fa-search"></i>
				</div>

				<div id="pesan"></div>
				<ul class="pagination float-right">
					<div id="page-list"></div>
					<li id="page-next" class="page-item">
						<span class="page-circle"><i class="fas fa-caret-right"></i></span>
					</li>
				</ul>
			</div>
			<div>
				<select id="filterJenisBarang">
					<option>Filter Semua</option>
					<option>Elektronik</option>
					<option>Alat Tulis</option>
					<option>Kendaraan</option>
					<option>Lainnya</option>
				</select>
				<div id="tabelBarangKeluar"></div>
			</div>
		</div>
	</div>
	<footer>
		<p class="text-white pt-2 ml-3">Tugas Inventaris 2020</p>
	</footer>
	<script src="src_moduls/barang_keluar.js"></script>
</body>
</html>