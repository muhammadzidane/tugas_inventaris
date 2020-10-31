<?php 
session_start();
$conn 				= mysqli_connect("localhost","root","","daftar_inventaris");

$sess_username 		= (isset($_SESSION['username'])) ? $_SESSION['username'] : "";
$sess_role 			= (isset($_SESSION['role'])) ? $_SESSION['role'] : "";


if ($sess_username === "") {
	header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
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
		.logo {
			width: 140px;
			display: block;
			margin: 50px auto;
		}
		.judul-tanggal{
			font-size: 20px;
		}
		.tableFirstChild {
			background-color: navy;
			color: #FFFFFF;
		}
		li a:hover {
			background-color: #ff3333;
			border-top: 3px solid #DEDBC1;
			opacity: 0.5;
		}
		table tr:hover {
			background-color: #FFE400;
			color: #FFFFFF;
			cursor: pointer;
		}
		.actived {
			background-color: #ff3333;
			border-top: 3px solid #FCB913; 
		}
		#pesan {
			background-color: tomato;
			box-shadow: 1px 1px 4px black;
			color: #FFFFFF;
			width: 80%;
			height: 35px;
			text-align: center;
			margin: 0 auto;
			padding-top: 3px;
		}
		#pesanSearch {
			background-color: tomato;
			box-shadow: 1px 1px 4px black;
			color: #FFFFFF;
			width: 30%;
			height: 35px;
			text-align: center;
			margin: 0	 auto;
			padding-top: 3px;
		}
		.bg-tomato {
			background-color: tomato;
		}
		.daftar-pegawai {
			margin: 55px auto;
			text-align: center;
			border-bottom: 3px solid black;
			width: 300px;
		}
		.columns:hover {
			cursor: pointer;
			box-shadow: 0px 0px 10px 2px black;
		}
		.filsearch { margin: 11px 0px; }
		.c-pointer { cursor: pointer; }
		.columns {
			width: 320px;
			margin: 20px 0px;
			box-shadow: 1px 1px 6px black;
		}
		.column1 {
			padding-top: 32px;
			text-align: center;
			color: #ffffff;
			width: 150px;
			height: 160px;
			background-color: #ff9f43;
		}
		.column2 {
			width: 200px;
			height: 160px;
			background-color: #ffffff;
			border-bottom: 3px solid #ff9f43;
		}
		.column-pink-1 {
			padding-top: 32px;
			text-align: center;
			color: #ffffff;
			width: 150px;
			height: 160px;
			background-color: #ff6464;
		}
		.column-pink-2 {
			width: 200px;
			height: 160px;
			background-color: #ffffff;
		}
		.h-user {
			padding-top: 64px;
		}
		#page-list {
			display: inline-flex;
		}
		.font-neue { font-family: 'Bebas Neue'; }
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
		.page-actived {
			background-color: #FFBB00;
			color: #FFFFFF;
		}
		.search-icon {
			position: relative;
		}
		.search-icon i{
			color: blue;
			position: absolute;
			top: 10px;
			left: 190px;
		}
		.search-icon input {
			border-radius: 20px;
			border: 1px solid green;
			padding: 5px 25px;
		}
		.search-icon input:focus {
			outline: none;
		}
		.search-icon input:hover{
			box-shadow: 0px 0px 8px #4772CB;
			border: 2px solid #37A7D4;
		}
		.filsearch { margin: 11px 0px; }
		footer {
			background-color: #24305E;
			width: 100%;
			height: 50px;
			margin-top: 100px; 
		}
	</style>
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
		<button id="logout" class=" btn btn-info ml-3">
			Logout
			<i class="fas fa-sign-out-alt"></i>
		</button>
	</nav>
	<div id="daftarPegawai" class="container">
		<h1 class="judul font-neue daftar-pegawai">Setting Akun</h1>
		<div id="pesan" class="my-5">
			<?php 
			if (isset($_GET['berhasil-ubah-password'])) {
				echo $_GET['berhasil-ubah-password'];
			}
			?>
		</div>
		<div class="d-flex columns mx-auto">
			<div class="column-pink-1"><i class="fas fa-id-card fa-5x pt-2"></i></div>
			<div class="column-pink-2 text-center">
				<h4 class="font-neue h-user"><?php echo $sess_username; ?></h4>
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
				<div class="column1"><i class="fas fa-laptop fa-5x pt-2"></i></div>
				<div class="column2 text-center">
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
				<div class="column1"><i class="fas fa-motorcycle fa-5x pt-2"></i></div>
				<div class="column2 text-center">
					<h2 id="totalBarangKendaraan" class="font-neue pt-5"></h2>
					<h4 class="font-neue pt-2">Kendaraan</h4>
				</div>
			</div>
			<div class="d-flex columns mb-5">
				<div class="column1"><i class="fas fa-box-open fa-5x pt-2"></i></div>
				<div class="column2 text-center">
					<h2 id="totalBarangLainnya" class="font-neue pt-5"></h2>
					<h4 class="font-neue pt-2">Lainnya</h4>
				</div>
			</div>
		</div>
		<div class="d-flex justify-content-between filsearch">
			<div class="search-icon">
				<input id="searchUsername" type="text" name="searchBarang" autocomplete="off"
				placeholder="Cari Username">
				<i class="fas fa-search"></i>
			</div>
			<div id="pesanSearch"></div>
			<ul class="pagination float-right">
				<div id="page-list"></div>
				<li id="page-next" class="page-item">
					<span class="page-circle"><i class="fas fa-caret-right"></i></span>
				</li>
			</ul>
		</div>
		<div id="tabelUsers"></div>
	</div>
	<footer>
		<p class="text-white pt-2 ml-3">Tugas Inventaris 2020</p>
	</footer>
	<script>
		"use strict";


		function buttonUbahRole(event, button){
			let dataUsername  		= $(button).data("username");

			$.ajax({
				url 	: "backend_setting_akun.php",
				type 	: "POST",
				data 	: { dataUsername : dataUsername },
				success : function(responseText) {
					$("#tabelUsers").html(responseText);
				}
			});
		}

		function buttonBatalUbahRole(event, button) {
			$.ajax({
				url 		:"backend_setting_akun.php",
				type 		: "POST",
				data 		: { tabelUsers : true },
				success		:function(responseText) {	
					$("#pesan").hide();
					$("#tabelUsers").html(responseText);
				}	
			});
		}

		function buttonUpdateJenisRole(event, button) {
			let dataUsername 		= $(button).data("username");
			let confirmUpdate 		= confirm("Apakah anda yakin ingin mengubah jenis role?");
			let valSelectJenisRole 	= $("#selectJenisRole").val();
			if (confirmUpdate) {
				$.ajax({
					url 	: "backend_setting_akun.php",
					type 	: "POST",
					data 	: { 
						updateJenisRole 	: true,
						valUsername 		: dataUsername,
						valSelectJenisRole 	: valSelectJenisRole
					},
					success : function(responseText) {
						location.assign("setting_akun.php?ubah-role=" + encodeURIComponent(responseText));
					}
				});		
			}
		}

		function buttonHapusUser(event, button) {
			let dataUsername  		= $(button).data("username");
			let confirmHapusUser 	= confirm("Apakah anda yakin ingin menghapus user ?");

			if (confirmHapusUser) {
				$.ajax({
					url 		:"backend_setting_akun.php",
					type 		: "POST",
					data 		: { hapusUser : dataUsername },
					success		:function(responseText) {	
						location.assign(`setting_akun.php?hapus=${encodeURIComponent(responseText)}`);	
					}	
				});		
			} 
		}
	// Load Event =========================================>>
	$(document).ready(function() {
		$("#pesan").hide();
		$("#pesanSearch").hide();

		// Muncul tabel saat pertama load
		$.ajax({
			url 		:"backend_setting_akun.php",
			type 		: "POST",
			data 		: { tabelUsers : true },
			success		:function(responseText) {	
				$("#tabelUsers").html(responseText);
			}	
		});

		<?php if (isset($_GET["berhasil-ubah-password"])) { ?>
			$("#pesan").show();
			$("#pesan").html("<?php echo $_GET["berhasil-ubah-password"]; ?>");
		<?php } ?> // END IF PHP

		<?php if (isset($_GET["berhasil-tambah-akun"])) { ?>
			$("#pesan").show();
			$("#pesan").html("<?php echo $_GET["berhasil-tambah-akun"]; ?>");
		<?php } ?> // END IF PHP

		<?php if (isset($_GET["hapus"])) { ?>
			$("#pesan").show();
			$("#pesan").html("<?php echo $_GET["hapus"]; ?>");
		<?php } ?> // END IF PHP


		$("#tambahAkun").click(function() {
			location.assign("tambah_akun.php");
		});

		$("#ubahPassword").click(function() {
			location.assign("ubah_password.php?username=" + "<?php echo $sess_username; ?>");
		});

		// Search nama barang
		$("#searchUsername").keyup(function() {
			let inputVal = $("#searchUsername").val().trim()
			$.post("backend_setting_akun.php",{
				searchUsername 	: inputVal
			},function(responseText) {
				if (responseText == "Username tidak ditemukan") {
					$("#pesanSearch").html(responseText);
					$("#pesanSearch").show();
				}
				else {
					$("#pesanSearch").hide();
					$("#tabelUsers").html(responseText);
				}
				console.log(responseText);
			});
		});

		// Logout
		$("#logout").click(function() {
			location.replace("index.php");
		});
	});
</script>
</body>
</html>