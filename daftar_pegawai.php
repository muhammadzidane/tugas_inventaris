<?php 
session_start();
require_once 'files_backend_ajax/php_functions.php';
cek_session();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Daftar Pegawai</title>
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
				<a class="nav-link text-white actived" href="daftar_pegawai.php">Daftar Pegawai</a>
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
			<button id="logout" class=" btn btn-warning btn-sm ">
				Logout
				<i class="fas fa-sign-out-alt"></i>
			</button>
		</a>
	</nav>
	<div class="container">
		<div class="judul font-neue">Daftar Pegawai</div>
		<div id="pesanLoad">
			<?php 
			tampilkan_pesan_load("berhasil_diedit");
			tampilkan_pesan_load("berhasil_dihapus");
			tampilkan_pesan_load("berhasil_ditambah");
			?>
		</div>
		<div class="cards">
			<div class="d-flex columns">
				<div class="column-orange-1"><i class="fas fa-users fa-5x pt-2"></i></div>
				<div class="column-orange-2 text-center">
					<h2 id="totalKaryawan" class="font-neue pt-5"></h2>
					<h4 class="font-neue pt-2">Total Karyawan</h4>
				</div>
			</div>
		</div>
		<?php
			$button_tambah_karyawan 	 = "<a href='tambah_karyawan.php'><button id='tambahKaryawan'";
			$button_tambah_karyawan 	.= "class='btn btn-primary'><i class='fas fa-user-plus'></i>Tambahkan Karyawan</button></a>'";
			hapusModuls($button_tambah_karyawan);
		?>
		<div class="d-flex justify-content-between filsearch">
			<div class="search-icon">
				<input id="search" type="text" name="search" autocomplete="off" placeholder="Cari Nama Karyawan">
				<i class="fas fa-search"></i>
			</div>
			<div id="pesan" class="pesan"></div>
			<ul class="pagination float-right">
				<div id="page-list"></div>
				<li id="page-next" class="page-item">
					<span class="page-circle"><i class="fas fa-caret-right"></i></span>
				</li>
			</ul>
		</div>
		<div id="tabelKaryawan"></div>
	</div>
	<footer>
		<div id="test"></div>
		<p class="text-white pt-2 ml-3">Tugas Inventaris 2020</p>
	</footer>
	<script src="src_moduls/js_functions.js"></script>
	<script src="src_moduls/daftar_pegawai.js"></script>
</body>
</html>