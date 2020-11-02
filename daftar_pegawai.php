<?php 
session_start();
$conn 				= mysqli_connect("localhost","root","","tugas_inventaris");

$sess_username 	= (isset($_SESSION['username'])) ? $_SESSION['username'] : "";
$sess_role 		= (isset($_SESSION['role'])) ? $_SESSION['role'] : "";


if ($sess_username == "") {
	header("Location: index.php");
}

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
		.tableFirstChild {
			background-color: navy;
			color: #FFFFFF;
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
		.page-circle {
			cursor: pointer;
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
			background-color: #FFBB00 ;
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
		.search-icon input:hover{
			box-shadow: 0px 0px 8px #4772CB;
			border: 2px solid #37A7D4;
		}
		.search-icon input:focus{
			outline: none;
		}
		#pesan {
			background-color: tomato;
			box-shadow: 1px 1px 4px black;
			color: #FFFFFF;
			width: 480px;
			height: 35px;
			text-align: center;
			padding-top: 3px;
		}
		.bg-tomato {
			background-color: tomato;
		}
		.editKaryawan {
			border: transparent;
			background-color: #F8F8F8F8;
			border-bottom: 1px solid tomato;
			width: 100%;
		}
		.form-group{
			margin: 10px;
		}
		.daftar-pegawai {
			margin: 55px auto;
			text-align: center;
			border-bottom: 3px solid black;
			width: 300px;
		}
		#tambahKaryawan {
			color: #FFFFFF;
			padding: 6px 12px;
			box-shadow: 0px 0px 4px black;
		}
		#form-tambah-karyawan {
			background-color: #FFFFFF;
			box-shadow: 0 0 4px black;
			width: 550px;
			height: 910px;
			margin: 55px auto;
		}
		#form-tambah-karyawan .form-group {
			margin: 25px 40px;
		}
		.header-form {
			text-align: center;
			color: #FFFFFF;
			background-color: #24305E;
			padding: 28px;
		}
		#pesanTambahKaryawan {
			position: absolute;
		}
		.pesanValidasi {
			font-size: 13px;
			color: tomato;
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
		#page-list {
			display: inline-flex;
		}
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
		<h1 class="judul font-neue daftar-pegawai">Daftar Pegawai</h1>
		<div>
			<div class="d-flex columns my-5">
				<div class="column1"><i class="fas fa-users fa-5x"></i></div>
				<div class="column2 text-center">
					<h2 id="totalKaryawan" class="font-neue pt-5"></h2>
					<h4 class="font-neue pt-2">Total Karyawan</h4>
				</div>
			</div>
		</div>
		<button id="tambahKaryawan" class="btn btn-primary"><i class="fas fa-user-plus"></i>Tambahkan Karyawan</button>
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
	<script>
		"use strict";
		// Button Edit Karyawan
		function buttonEditKaryawan(event, button) {
			event.stopPropagation();
			let dataKodeKaryawan  	= $(button).data('kode');
			let dataNamaKaryawan  	= $(button).data('nama');
			let getUrlValue 		= `?kode_karyawan=${dataKodeKaryawan}&nama_karyawan=${dataNamaKaryawan}`;			
			location.assign("edit_karyawan.php" + getUrlValue);
		};

	// Button Hapus Karyawan
	function buttonHapusKaryawan(event, button) {
		event.stopPropagation();
		let confirmHapusKaryawan 	= confirm("Apakah Anda Yakin Ingin Menghapus Karyawan?");
		let kodeKaryawan 			= $(button).data("kode");
		if (confirmHapusKaryawan) {
			// Query hapus karyawan
			$.post("backend_daftar_karyawan.php",{ hapusKaryawan : kodeKaryawan }, function(responseText, success) {
				$("#pesan").show();
				$("#pesan").html(responseText);
			});

			// Load ulang tabel saat karyawan berhasil di hapus
			$.post("backend_daftar_karyawan.php",{ tabelKaryawan : true }, function(responseText) {
				$("#tabelKaryawan").html(responseText);
			});

			// Total karyawan berubah saat di hapus
			$.post("backend_daftar_karyawan.php", {totalKaryawan : true}, function(responseText) {	
				$("#totalKaryawan").html(responseText);
			});
		}
	}

	function pageLink(button) {
		let dataPage 				= $(button).data("page");
		let pageListChildrenLength 	= $("#page-list").children().length;
		$.ajax({
			url 	: "backend_daftar_karyawan.php",
			type 	: "POST",
			data 	: { pageListTabelKaryawan : dataPage, pageListChildrenLength : pageListChildrenLength },
			success : function(responseText) {
				$("#tabelKaryawan").html(responseText);
			}
		});

		for (let i = 1; i <= pageListChildrenLength; i++) {
			if (dataPage == i) {
				$(".page-circle").removeClass("page-actived");	
				$(button).addClass("page-actived");
			}
		}
	}

	// Load Event =========================================>>
	$(document).ready(function() {

		// Muncul Tabel Saat Load Pertama Kali
		$.post("backend_daftar_karyawan.php",{
			tabelKaryawan 	: true
		},function(responseText) {
			$("#tabelKaryawan").html(responseText);	
			<?php 
			if (isset($_GET['berhasil_edit'])) {
				$berhasil_edit = $_GET['berhasil_edit']; ?> // End PHP
				$("#pesan").show();
				$("#pesan").html("<?php echo $berhasil_edit; ?>");
			<?php } // End IF
			if (isset($_GET['berhasil_ditambah'])) {
				$berhasil_ditambah = $_GET['berhasil_ditambah']; ?> // End PHP
				$("#pesan").show();
				$("#pesan").html("<?php echo $berhasil_ditambah; ?>");
			<?php } ?> // End IF 
			$("#pesan").hide();	

			$(".TRKaryawan").click(function() {
				let dataKodeKaryawan 	= $(this).data("kode");
				let dataNamaKaryawan 	= $(this).data("nama");
				location.assign("barang_inventaris_karyawan.php?kode_karyawan=" + dataKodeKaryawan + "&nama_karyawan=" + dataNamaKaryawan);
			});
		});
		
		// Total Karyawan
		$.post("backend_daftar_karyawan.php",{totalKaryawan : true},function(responseText) {	
			$("#totalKaryawan").html(responseText);
		});
		
		// Search Tabel
		// $("#pesan").hide(); // Hide Saat Load Pertama Kali
		$("#search").keyup(function() {
			let valSearch = $("#search").val().trim()
			$.post("backend_daftar_karyawan.php",{
				searchKaryawan 	: valSearch
			},function(responseText) {
				if (responseText == "User Tidak Ditemukan") {
					$("#pesan").html(responseText);
					$("#pesan").show();
				}
				else {
					$("#pesan").hide();
					$("#tabelKaryawan").html(responseText);
				}
			});
		});

		// Tambah Karyawan Baru
		$("#tambahKaryawan").click(function() {
			location.assign("tambah_karyawan.php");
		});

		// Pagination Tabel Karyawan
		$.ajax({
			url 	: "backend_daftar_karyawan.php",
			type 	: "POST",
			data 	: { paginationTabelKaryawan : true },
			success : function(responseText) {
				$("#page-list").html(responseText);
			}
		});

		// Page Next
		$("#page-next").click(function() {
			let dataPage 						= $(".page-actived").data("page") + 1;
			let pageListChildrenLength 			= $("#page-list").children().length;
			$.ajax({
				url 	: "backend_daftar_karyawan.php",
				type 	: "POST",
				data 	: { pageNext : dataPage },
				success : function(responseText) {
					$("#tabelKaryawan").html(responseText);
					for (let i = 1; i <= pageListChildrenLength; i++) {
						if (dataPage == i) {
							$(".page-circle").removeClass("page-actived");
							$(`#page-${i}.page-circle`).addClass("page-actived");
						}
					}
				}
			});
		});
		
		// // Logout
		// $("#logout").click(function() {
		// 	location.replace("index.php");
		// });
	});
</script>
</body>
</html>