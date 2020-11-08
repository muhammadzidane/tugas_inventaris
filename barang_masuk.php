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
	<title>Barang Masuk</title>
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
				<a class="nav-link text-white actived" href="barang_masuk.php">Barang Masuk</a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-white" href="barang_keluar.php">Barang Keluar</a>
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
		<h1 class="judul font-neue">Barang Masuk</h1>
		<div class="cards">
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
		</div>
		<div>
			<select id="filterJenisBarang">
				<option>Filter Semua</option>
				<option>Elektronik</option>
				<option>Alat Tulis</option>
				<option>Kendaraan</option>
				<option>Lainnya</option>
			</select>
			<div id="tabelBarang"></div>
		</div>
	</div>
	<footer>
		<p class="text-white pt-2 ml-3">Tugas Inventaris 2020</p>
	</footer>
	<script>
		"use strict";
	// Non Load Event ====================================================================== >>

	function pageLink(button) {
		let dataPage 				= $(button).data("page");
		let pageListChildrenLength 	= $("#page-list").children().length;
		$.ajax({
			url 		: "files_backend_ajax/backend_barang_masuk.php",
			type 		: "POST",
			data 		: { pageListTabelBarangMasuk : dataPage, pageListChildrenLength : pageListChildrenLength },
			success	: function(responseText) {
				$("#tabelBarang").html(responseText);
			}
		});

		for (let i = 1; i <= pageListChildrenLength; i++) {
			if (dataPage == i) {
				$(".page-circle").removeClass("page-actived");	
				$(button).addClass("page-actived");
			}
		}
	}

	// Load event ========================================================================== >>
	$(document).ready(function() {
		// Muncul Tabel Saat Load Pertama Kali
		$.ajax({
			url 		:"files_backend_ajax/backend_barang_masuk.php",
			type 		: "POST",
			data 		: { tabelBarangMasuk : true },
			success		:function(responseText) {	
				$("#pesan").hide();
				$("#tabelBarang").html(responseText);
			}
		});

		function totalBarang(post, selector) {
			$.post("files_backend_ajax/backend_barang_masuk.php",{
				post 	: true
			},function(responseText) {	
				$(selector).html(responseText);
			});	
		}

		// Filter Jenis Barang
		$("#filterJenisBarang").change(function() {
			let valFilterJenisBarang = $("#filterJenisBarang").val();
			switch(valFilterJenisBarang) {
				case "Filter Semua" : 
				$.post("files_backend_ajax/backend_barang_masuk.php",{ filterSemua : true }, function(responseText) {
					$("#tabelBarang").html(responseText);
				});
				break;
				case "Elektronik" : 
				$.post("files_backend_ajax/backend_barang_masuk.php",{ filterElektronik : true }, function(responseText) {
					$("#tabelBarang").html(responseText);
				});
				break;
				case "Alat Tulis" : 
				$.post("files_backend_ajax/backend_barang_masuk.php",{ filterAlatTulis : true }, function(responseText) {
					$("#tabelBarang").html(responseText);
				});
				break;
				case "Kendaraan" : 
				$.post("files_backend_ajax/backend_barang_masuk.php",{ filterKendaraan : true }, function(responseText) {
					$("#tabelBarang").html(responseText);
				});
				break;
				case "Lainnya" : 
				$.post("files_backend_ajax/backend_barang_masuk.php",{ filterLainnya : true }, function(responseText) {
					$("#tabelBarang").html(responseText);
				});
				break;			
			}
		});

		// Search nama barang
		$("#searchBarang").keyup(function() {
			let inputVal = $("#searchBarang").val().trim()
			$.post("files_backend_ajax/backend_barang_masuk.php",{
				searchBarang 	: inputVal
			},function(responseText) {
				if (responseText === "Nama Barang Tidak Ditemukan") {
					$("#pesan").html(responseText);
					$("#pesan").show();
				}
				else {
					$("#pesan").hide();
					$("#tabelBarang").html(responseText);
				}
			});
		});

		$("#tambahBarang").click(function() {
			location.assign("tambah_barang.php");
		});

		// Jam 
		setInterval(function(){
			let waktu = new Date();	
			$("#waktu").html(waktu.toTimeString());
		})

		// Pagination Tabel Barang
		$.ajax({
			url 	: "files_backend_ajax/backend_barang_masuk.php",
			type 	: "POST",
			data 	: { paginationTabelBarangMasuk : true },
			success : function(responseText) {
				$("#page-list").html(responseText);
			}
		});

		$("#page-next").click(function() {
			let dataPage 						= $(".page-actived").data("page") + 1;
			let pageListChildrenLength 	= $("#page-list").children().length;
			$.ajax({
				url 	: "files_backend_ajax/backend_barang_masuk.php",
				type 	: "POST",
				data 	: { pageNext : dataPage },
				success : function(responseText) {
					$("#tabelBarang").html(responseText);
					for (let i = 1; i <= pageListChildrenLength; i++) {
						if (dataPage == i) {
							$(".page-circle").removeClass("page-actived");
							$(`#page-${i}.page-circle`).addClass("page-actived");
						}
					}
				}
			});
		});

		// Logout
		$("#logout").click(function() {
			location.replace("index.php");
		});
	});// END LOAD EVENT
</script>
</body>
</html>