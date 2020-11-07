<?php 
session_start();
require_once 'php_functions.php';
cek_session();

$sess_role 		= (isset($_SESSION['role'])) ? $_SESSION['role'] : "";

?>
<!DOCTYPE html>
<html>
<head>
	<title>Website Inventaris</title>
	<link href='https://fonts.googleapis.com/css?family=Bebas Neue' rel='stylesheet'>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="fontawesome-5.13.1/css/all.min.css">
	<script type="text/javascript" src="bootstrap/js/jquery.js"></script>
	<script type="text/javascript" src="bootstrap/js/popper.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript src=jquery-com-3.5.1.js"></script>
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
		#pesan {
			background-color: tomato;
			box-shadow: 1px 1px 4px black;
			color: #FFFFFF;
			width: 50%;
			height: 35px;
			text-align: center;
			padding-top: 3px;
		}
		.bg-tomato {
			background-color: tomato;
		}
		.judul-border {
			margin: 55px auto;
			text-align: center;
			border-bottom: 3px solid black;
			width: 200px;
		}
		.filsearch { margin: 11px 0px; }
		.c-pointer { cursor: pointer; }
		.columns {
			width: 350px;
			margin: 15px 0px;
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
		.columnt-pink-2 {
			width: 200px;
			height: 160px;
			background-color: #ffffff;
			border-top: 3px solid #ff6464;
		}
		.edit-barang {
			border: transparent;
			background-color: #F8F8F8F8;
			border-bottom: 1px solid tomato;
			width: 100%;
		}

		/* Pagination */
		#page-list {
			cursor: pointer;
			display: inline-flex;
		}
		#page-next {
			cursor: pointer;
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
		<div class="navbar-text text-white ml-auto" id="waktu"></div>
		<button id="logout" class=" btn btn-outline-warning ml-3">
			Logout
			<i class="fas fa-sign-out-alt"></i>
		</button>
	</nav>
	<div class="container">
		<h1 class="judul font-neue judul-border">Barang Keluar</h1>
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
			url 		: "backend_barang_keluar.php",
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
			url 		:"backend_barang_keluar.php",
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
		$.post("backend_barang_keluar.php",{ totalSemuaBarang : true },function(responseText) {	
			$("#totalSemuaBarang").html(responseText);
		});
		
		// Jumlah Barang Elektronik
		$.post("backend_barang_keluar.php",{ totalBarangElektronik : true },function(responseText) {	
			$("#totalBarangElektronik").html(responseText);
		});
		
		// Jumlah Barang Alat Tulis
		$.post("backend_barang_keluar.php",{	totalBarangAlatTulis : true },function(responseText) {	
			$("#totalBarangAlatTulis").html(responseText);
		});
		
		// Jumlah Barang Kendaraan
		$.post("backend_barang_keluar.php",{ totalBarangKendaraan : true },function(responseText) {
			$("#totalBarangKendaraan").html(responseText);
		});
		
		// Jumlah Barang Lainnya
		$.post("backend_barang_keluar.php",{	totalBarangLainnya 	: true },function(responseText) {
			$("#totalBarangLainnya").html(responseText);
		});

		// Filter Jenis Barang
		$("#filterJenisBarang").change(function() {
			let valFilterJenisBarang = $("#filterJenisBarang").val();
			switch(valFilterJenisBarang) {
				case "Filter Semua" : 
				$.post("backend_barang_keluar.php",{ filterSemua : true }, function(responseText) {
					$("#tabelBarangKeluar").html(responseText);
				});
				break;
				case "Elektronik" : 
				$.post("backend_barang_keluar.php",{ filterElektronik : true }, function(responseText) {
					$("#tabelBarangKeluar").html(responseText);
				});
				break;
				case "Alat Tulis" : 
				$.post("backend_barang_keluar.php",{ filterAlatTulis : true }, function(responseText) {
					$("#tabelBarangKeluar").html(responseText);
				});
				break;
				case "Kendaraan" : 
				$.post("backend_barang_keluar.php",{ filterKendaraan : true }, function(responseText) {
					$("#tabelBarangKeluar").html(responseText);
				});
				break;
				case "Lainnya" : 
				$.post("backend_barang_keluar.php",{ filterLainnya : true }, function(responseText) {
					$("#tabelBarangKeluar").html(responseText);
				});
				break;			
			}
		});

		// Search nama barang
		$("#searchBarang").keyup(function() {
			let inputVal = $("#searchBarang").val().trim()
			$.post("backend_barang_keluar.php",{
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
			url 	: "backend_barang_keluar.php",
			type 	: "POST",
			data 	: { paginationTabelBarangKeluar : true },
			success : function(responseText) {
				$("#page-list").html(responseText);
			}
		});

		$("#page-next").click(function() {
			$.ajax({
				url 	: "backend_barang_keluar.php",
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

		// Logout
		$("#logout").click(function() {
			location.replace("index.php");
		});

	}); // END EVENT LOAD
</script>
</body>
</html>