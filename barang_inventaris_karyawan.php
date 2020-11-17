<?php 
session_start();
require_once 'files_backend_ajax/php_functions.php';
cek_session();

$url_kode_karyawan 	= (isset($_GET["kode_karyawan"])) ? $_GET["kode_karyawan"] : "";
$url_nama_karyawan 	= (isset($_GET["nama_karyawan"])) ? $_GET["nama_karyawan"] : "";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Website Inventaris</title>
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
		<div class="navbar-text text-white ml-auto" id="waktu"></div>
		<a href="index.php">
			<button id="logout" class=" btn btn-warning btn-sm ml-3">
				Logout
				<i class="fas fa-sign-out-alt"></i>
			</button>
		</a>
	</nav>
	<div id="daftarPegawai" class="container">
		<h1 class="judul font-neue">Barang Inventaris Karyawan</h1>
		<div id="pesanLoad" class="my-5">
			<?php 
			tampilkan_pesan_load("berhasil-tambah-barang");
			tampilkan_pesan_load("berhasil_dihapus");
			tampilkan_pesan_load("berhasil_ditambah");
			?>
		</div>
		<div class="d-flex columns mx-auto">
			<div class="column-pink-1"><i class="fas fa-id-card fa-5x pt-2"></i></div>
			<div class="column-pink-2 text-center">
				<h4 id="namaKaryawan" class="font-neue h-user pt-5"><?= $url_nama_karyawan; ?></h4>
				<h5 id="kodeKaryawan" class="font-neue"><?= $url_kode_karyawan; ?></h5>
			</div>
		</div>
		<div class="d-flex justify-content-between">
			<div class="d-flex columns">
				<div class="column-pink-1"><i class="fas fa-boxes fa-5x pt-2"></i></div>
				<div class="column-pink-2 text-center">
					<h2 id="totalSemuaBarang" class="font-neue pt-5"></h2>
					<h4 class="font-neue pt-2">Total Semua Barang</h4>
				</div>
			</div>
			<div class="d-flex columns">
				<div class="column-orange-1"><i class="fas fa-laptop fa-5x pt-2"></i></div>
				<div class="column-orange-2 text-center">
					<h2 id="totalBarangElektronik" class="font-neue pt-5"></h2>
					<h4 class="font-neue pt-2">Elektronik</h4>
				</div>
			</div>
			<div class="d-flex columns">
				<div class="column-pink-1"><i class="fas fa-pencil-ruler fa-5x pt-2"></i></div>
				<div class="column-pink-2 text-center">
					<h2 id="totalBarangAlatTulis" class="font-neue pt-5"></h2>
					<h4 class="font-neue pt-2">Alat Tulis</h4>
				</div>
			</div>
		</div>
		<div class="d-flex justify-content-around">
			<div class="d-flex columns mb-5">
				<div class="column-orange-1"><i class="fas fa-motorcycle fa-5x pt-2"></i></div>
				<div class="column-orange-2 text-center">
					<h2 id="totalBarangKendaraan" class="font-neue pt-5"></h2>
					<h4 class="font-neue pt-2">Kendaraan</h4>
				</div>
			</div>
			<div class="d-flex columns mb-5">
				<div class="column-orange-1"><i class="fas fa-box-open fa-5x pt-2"></i></div>
				<div class="column-orange-2 text-center">
					<h2 id="totalBarangLainnya" class="font-neue pt-5"></h2>
					<h4 class="font-neue pt-2">Lainnya</h4>
				</div>
			</div>
		</div>
		<button id="tambahBarangInv" class="btn btn-primary"><i class="fas fa-box-open"></i>+ Tambahkan Barang Inventaris Baru</button>
		<span id="batalTambahBarangInv"></span>
		<h4 id="dataBarang"></h4>
		<div class="d-flex justify-content-between filsearch">
			<div class="search-icon">
				<input id="searchBarang" type="text" name="searchBarang" autocomplete="off"
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
		<div id="tabelBarangInvKaryawan"></div>
	</div>
	<footer>
		<p class="text-white pt-2 ml-3">Tugas Inventaris 2020</p>
	</footer>
	<script src="src_moduls/js_functions.js"></script>
	<script src="src_moduls/barang_inventaris_karyawan.js"></script>
</body>
</html>