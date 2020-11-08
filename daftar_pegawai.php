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
		<div class="cards">
			<div class="d-flex columns">
				<div class="column-orange-1"><i class="fas fa-users fa-5x pt-2"></i></div>
				<div class="column-orange-2 text-center">
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
			$.post("files_backend_ajax/backend_daftar_karyawan.php",{ hapusKaryawan : kodeKaryawan }, function(responseText, success) {
				$("#pesan").show();
				$("#pesan").html(responseText);
			});

			// Load ulang tabel saat karyawan berhasil di hapus
			$.post("files_backend_ajax/backend_daftar_karyawan.php",{ tabelKaryawan : true }, function(responseText) {
				$("#tabelKaryawan").html(responseText);
			});

			// Total karyawan berubah saat di hapus
			$.post("files_backend_ajax/backend_daftar_karyawan.php", {totalKaryawan : true}, function(responseText) {	
				$("#totalKaryawan").html(responseText);
			});
		}
	}

	function pageLink(button) {
		let dataPage 				= $(button).data("page");
		let pageListChildrenLength 	= $("#page-list").children().length;
		$.ajax({
			url 	: "files_backend_ajax/backend_daftar_karyawan.php",
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
		$("#pesan").hide();

		// Muncul Tabel Saat Load Pertama Kali
		$.post("files_backend_ajax/backend_daftar_karyawan.php",{
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

			$(".TRKaryawan").click(function() {
				let dataKodeKaryawan 	= $(this).data("kode");
				let dataNamaKaryawan 	= $(this).data("nama");
				location.assign("barang_inventaris_karyawan.php?kode_karyawan=" + dataKodeKaryawan + "&nama_karyawan=" + dataNamaKaryawan);
			});

			// Jika role moderator, maka remove beberapa modul
			<?php if ($sess_role == "moderator") { ?>
				$("#tambahKaryawan").remove();
				$("#THActions").remove();
				$(".TDEdit").remove();
				$(".TDHapus").remove();
				$(".buttonHapus").remove();
				console.log($("buttonEdit"));
			<?php } ?>
		});
		
		// Total Karyawan
		$.post("files_backend_ajax/backend_daftar_karyawan.php",{totalKaryawan : true},function(responseText) {	
			$("#totalKaryawan").html(responseText);
		});
		
		// Search Tabel
		// $("#pesan").hide(); // Hide Saat Load Pertama Kali
		$("#search").keyup(function() {
			let valSearch = $("#search").val().trim()
			$.post("files_backend_ajax/backend_daftar_karyawan.php",{
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
			url 	: "files_backend_ajax/backend_daftar_karyawan.php",
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
				url 	: "files_backend_ajax/backend_daftar_karyawan.php",
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
	});
</script>
</body>
</html>