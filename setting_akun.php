<?php 
session_start();
require_once 'files_backend_ajax/php_functions.php';
cek_session();

$sess_role 				= (isset($_SESSION['role'])) ? $_SESSION['role'] : "";
$sess_username 		= (isset($_SESSION['username'])) ? $_SESSION['username'] : "";

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Setting Akun</title>
	<link href='https://fonts.googleapis.com/css?family=Bebas Neue' rel='stylesheet'>
	<link rel="stylesheet" type="text/css" href="global_css.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/fontawesome-5.13.1/css/all.min.css">
	<script type="text/javascript" src="bootstrap/js/jquery.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
</head>
<body>
	<nav class="navbar navbar-expand-sm bg-tomato fixed-top">
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
				<a class="nav-link text-white" href="barang_keluar.php">Barang Keluar</a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-white actived" href="setting_akun.php">Setting Akun</a>
			</li>
		</ul>
		<a href="index.php" class="ml-auto">
			<button id="logout" class=" btn btn-warning btn-sm">
				Logout
				<i class="fas fa-sign-out-alt"></i>
			</button>
		</a>
	</nav>
	<div id="daftarPegawai" class="container">
		<h1 class="judul font-neue">Setting Akun</h1>
		<div id="pesanLoad">
			<?php 
			tampilkan_pesan_load("berhasil-ubah-password");
			tampilkan_pesan_load("berhasil-tambah-akun");
			tampilkan_pesan_load("hapus");
			tampilkan_pesan_load("ubah-role");
			?>
		</div>
		<div class="cards">
			<div class="d-flex columns mx-auto">
				<div class="column-pink-1"><i class="fas fa-id-card fa-5x"></i></div>
				<div class="column-pink-2 text-center pt-3">
					<h4 id='username' class="font-neue pt-5"><?php echo $sess_username; ?></h4>
				</div>
			</div>
			
			<?php 

			if ($sess_role == "superuser") {
				echo "<div class='d-flex justify-content-between'>";
			}
			else {
				echo "<div class='d-flex justify-content-around'>";
			}

			$tambah_akun  = "";
			$tambah_akun .= "<div id='tambahAkun' class='d-flex columns'>";
			$tambah_akun .= "<div class='column-orange-1'><i class='fas fa-user-plus fa-5x'></i></div>";
			$tambah_akun .= "<div class='column-orange-2 text-center pt-3'>";
			$tambah_akun .= "<h4 class='font-neue pt-5'>Tambahkan Akun</h4>";
			$tambah_akun .= "</div>";

			hapusModuls($tambah_akun);
			?>
			<div id='ubahPassword' class='d-flex columns '>
				<div class='column-orange-1'><i class='fas fa-user-edit fa-5x'></i></div>
				<div class='column-orange-2 text-center pt-3'>
					<h4 class='font-neue pt-5'>Ubah Password</h4>
				</div>
			</div>
			<div class="d-flex columns ">
				<div class="column-orange-1"><i class="fas fa-user-lock fa-5x"></i></div>
				<div class="column-orange-2 text-center pt-3">
					<h4 class="font-neue pt-5">Lupa Password</h4>
				</div>
			</div>
		</div>

	</div>
	<?php 
	$tabel_users  		 = "";
	$tabel_users 		.= "<div class='d-flex justify-content-between filsearch'>";
	$tabel_users 		.= "<div class='search-icon'>";
	$tabel_users 		.= "<input id='searchUsername' type='text' name='searchBarang' autocomplete='off'";
	$tabel_users 		.= "placeholder='Cari Username'>";
	$tabel_users 		.= "<i class='fas fa-search'></i>";
	$tabel_users 		.= "</div>";
	$tabel_users 		.= "<div id='pesan'></div>";
	$tabel_users 		.= "<ul class='pagination float-right'>";
	$tabel_users 		.= "<div id='page-list'></div>";
	$tabel_users 		.= "<li id='page-next' class='page-item'>";
	$tabel_users 		.= "<span class='page-circle'><i class='fas fa-caret-right'></i></span>";
	$tabel_users 		.= "</li>";
	$tabel_users 		.= "</ul>";
	$tabel_users 		.= "</div>";
	$tabel_users 		.= "<div id='tabelUsers'></div>";
	hapusModuls($tabel_users);
	?>
</div>
<footer>
	<p class="text-white pt-2 ml-3">Tugas Inventaris 2020</p>
</footer>
<script src="src_moduls/setting_akun.js"></script>
<script src="src_moduls/js_functions.js"></script>
</body>
</html>