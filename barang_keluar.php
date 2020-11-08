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
	<script>
		"use strict";

	// Non Load Event ====================================================================== >>

	function pageLink(button) {
		let dataPage 				= $(button).data("page");
		let pageListChildrenLength 	= $("#page-list").children().length;
		$.ajax({
			url 		: "files_backend_ajax/backend_barang_keluar.php",
			type 		: "POST",
			data 		: { pageListTabelBarangKeluar : dataPage, pageListChildrenLength : pageListChildrenLength },
			success	: function(responseText) {
				$("#tabelBarangKeluar").html(responseText);
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
			url 		:"files_backend_ajax/backend_barang_keluar.php",
			type 		: "POST",
			data 		: { tabelBarangKeluar : true },
			success		:function(responseText) {	
				$("#pesan").hide();
				$("#tabelBarangKeluar").html(responseText);
				// Pesan edit/tampah barang jika berhasil mengubah/metambah data barang 
				
				let getUrlTambahOrEdit = location.search.substr(1,6);
				if (getUrlTambahOrEdit == "tambah"){
					let getUrlTambah 	= '<?php if (isset($_GET['tambah'])) { echo $_GET['tambah']; } ?>';
					$("#pesan").show();
					$("#pesan").html(getUrlTambah);
				} 

				let getUrlEdit = location.search.substr(1,4);
				if (getUrlEdit == "edit") { // Edit
					let getUrlEdit 	= '<?php if (isset($_GET['edit'])) { echo $_GET['edit']; } ?>';
					$("#pesan").show();
					$("#pesan").html(getUrlEdit);
				}
			}
		});
		
		// Jumlah Semua Barang
		$.post("files_backend_ajax/backend_barang_keluar.php",{ totalSemuaBarang : true },function(responseText) {	
			$("#totalSemuaBarang").html(responseText);
		});
		
		// Jumlah Barang Elektronik
		$.post("files_backend_ajax/backend_barang_keluar.php",{ totalBarangElektronik : true },function(responseText) {	
			$("#totalBarangElektronik").html(responseText);
		});
		
		// Jumlah Barang Alat Tulis
		$.post("files_backend_ajax/backend_barang_keluar.php",{	totalBarangAlatTulis : true },function(responseText) {	
			$("#totalBarangAlatTulis").html(responseText);
		});
		
		// Jumlah Barang Kendaraan
		$.post("files_backend_ajax/backend_barang_keluar.php",{ totalBarangKendaraan : true },function(responseText) {
			$("#totalBarangKendaraan").html(responseText);
		});
		
		// Jumlah Barang Lainnya
		$.post("files_backend_ajax/backend_barang_keluar.php",{	totalBarangLainnya 	: true },function(responseText) {
			$("#totalBarangLainnya").html(responseText);
		});

		// Filter Jenis Barang
		$("#filterJenisBarang").change(function() {
			let valFilterJenisBarang = $("#filterJenisBarang").val();
			switch(valFilterJenisBarang) {
				case "Filter Semua" : 
				$.post("files_backend_ajax/backend_barang_keluar.php",{ filterSemua : true }, function(responseText) {
					$("#tabelBarangKeluar").html(responseText);
				});
				break;
				case "Elektronik" : 
				$.post("files_backend_ajax/backend_barang_keluar.php",{ filterElektronik : true }, function(responseText) {
					$("#tabelBarangKeluar").html(responseText);
				});
				break;
				case "Alat Tulis" : 
				$.post("files_backend_ajax/backend_barang_keluar.php",{ filterAlatTulis : true }, function(responseText) {
					$("#tabelBarangKeluar").html(responseText);
				});
				break;
				case "Kendaraan" : 
				$.post("files_backend_ajax/backend_barang_keluar.php",{ filterKendaraan : true }, function(responseText) {
					$("#tabelBarangKeluar").html(responseText);
				});
				break;
				case "Lainnya" : 
				$.post("files_backend_ajax/backend_barang_keluar.php",{ filterLainnya : true }, function(responseText) {
					$("#tabelBarangKeluar").html(responseText);
				});
				break;			
			}
		});

		// Search nama barang
		$("#searchBarang").keyup(function() {
			let inputVal = $("#searchBarang").val().trim()
			$.post("files_backend_ajax/backend_barang_keluar.php",{
				searchBarang 	: inputVal
			},function(responseText) {
				if (responseText === "Nama Barang Tidak Ditemukan") {
					$("#pesan").html(responseText);
					$("#pesan").show();
				}
				else {
					$("#pesan").hide();
					$("#tabelBarangKeluar").html(responseText);
				}
			});
		});

		// Jam 
		setInterval(function(){
			let waktu = new Date();	
			$("#waktu").html(waktu.toTimeString());
		})

		// Pagination Tabel Barang
		$.ajax({
			url 	: "files_backend_ajax/backend_barang_keluar.php",
			type 	: "POST",
			data 	: { paginationTabelBarangKeluar : true },
			success : function(responseText) {
				$("#page-list").html(responseText);
			}
		});

		$("#page-next").click(function() {
			$.ajax({
				url 	: "files_backend_ajax/backend_barang_keluar.php",
				type 	: "POST",
				data 	: { pageNext : true },
				success : function(responseText) {
					let pageListChildrenLength 	= $("#page-list").children().length;
					let dataPage 				= $(".page-actived").data("page") + 1;
					$("#tabelBarangKeluar").html(responseText);
					for (let i = 1; i <= pageListChildrenLength; i++) {
						if (dataPage == i) {
							$(".page-circle").removeClass("page-actived");
							$(`#page-${i}.page-circle`).addClass("page-actived");
						}
					}
				}
			});
		});
	}); // END EVENT LOAD
</script>
</body>
</html>