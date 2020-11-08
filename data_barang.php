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
	<title>Data Barang</title>
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
				<a class="nav-link text-white actived" href="data_barang.php">Data Barang</a>
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
			<button id="logout" class=" btn btn-warning btn-sm">
				Logout
				<i class="fas fa-sign-out-alt"></i>
			</button>
		</a>
	</nav>
	<div class="container">
		<h1 class="judul font-neue">Data Barang</h1>
		<div id="pesanLoad"></div>
		<div class="cards">
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
			<div class="d-flex justify-content-between">
				<div class="d-flex columns">
					<div class="column-orange-1"><i class="fas fa-motorcycle fa-5x pt-2"></i></div>
					<div class="column-orange-2 text-center">
						<h2 id="totalBarangKendaraan" class="font-neue pt-5"></h2>
						<h4 class="font-neue pt-2">Kendaraan</h4>
					</div>
				</div>
				<div class="d-flex columns">
					<div class="column-pink-1"><i class="fas fa-hand-holding-usd fa-5x pt-2"></i></div>
					<div class="column-pink-2 text-center">
						<h2 id="totalPengeluaran" class="font-neue pt-5"></h2>
						<h4 class="font-neue pt-2">Total Pengeluaran</h4>
					</div>
				</div>
				<div class="d-flex columns">
					<div class="column-orange-1"><i class="fas fa-box-open fa-5x pt-2"></i></div>
					<div class="column-orange-2 text-center">
						<h2 id="totalBarangLainnya" class="font-neue pt-5"></h2>
						<h4 class="font-neue pt-2">Lainnya</h4>
					</div>
				</div>
			</div>
		</div>
		<button id="tambahBarang" class="btn btn-primary"><i class="fas fa-box-open"></i>+</i> Tambahkan Barang</button>
		<div id="formTambahBarang"></div>
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
	// Tambah barang
	function buttonTambahBarang(event, button) {
		let dataKodeBarang 		= $(button).data("kode");
		let dataJumlahBarang 	= $(button).data("jumlah");
		let dataTotalHarga 		= $(button).data("total");

		location.assign(
			"tambah_barang_yang_sama.php?kode_barang=" + dataKodeBarang +
			"&jumlah_barang=" + dataJumlahBarang +
			"&total_harga=" + dataTotalHarga
			);
	}

	// Edit Barang
	function buttonEditBarang(event, button) {
		let dataKodeBarang  = $(button).data('kode');
		let dataNamaBarang 	= $(button).data('nama');
		location.assign(`edit_barang.php?kode-barang=${dataKodeBarang}&nama-barang=${dataNamaBarang}`);
	}

	function buttonHapusBarang(event, button) {
		let confirmHapusBarang = confirm("Apakah anda yakin ingin menghapus data barang?");
		if (confirmHapusBarang) {
			let dataKodeBarang = $(button).data("kode");
			$.ajax({
				url 		: "files_backend_ajax/backend_data_barang.php",
				type 		: "POST",
				data 		: { hapusBarang : dataKodeBarang },
				success	: function(responseText) {
					$("#pesan").show();
					$("#pesan").html(responseText);
					// Tampilkan tabel saat berhasil menghapus barang
					$.post('files_backend_ajax/backend_data_barang.php',{ tabelBarang : true },function(responseText){
						$("#tabelBarang").html(responseText);
					});
				}
			});
		}
	}		

	function pageLink(button) {
		let dataPage 				= $(button).data("page");
		let pageListChildrenLength 	= $("#page-list").children().length;
		$.ajax({
			url 		: "files_backend_ajax/backend_data_barang.php",
			type 		: "POST",
			data 		: { pageListTabelBarang : dataPage, pageListChildrenLength : pageListChildrenLength },
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
		$("#pesanLoad").hide();
		$("#pesan").hide();


		// Muncul Tabel Saat Load Pertama Kali
		$.ajax({
			url 		:"files_backend_ajax/backend_data_barang.php",
			type 		: "POST",
			data 		: { tabelBarang : true },
			success		:function(responseText) {	
				$("#tabelBarang").html(responseText);
				// Pesan edit/tampah barang jika berhasil mengubah/metambah data barang 
				
				let getUrlTambahOrEdit = location.search.substr(1,15);
				if (getUrlTambahOrEdit == "berhasil-tambah"){
					let getUrlTambah 	= "<?php if (isset($_GET['berhasil-tambah'])) { echo $_GET['berhasil-tambah']; } ?>";
					$("#pesanLoad").show();
					$("#pesanLoad").html(getUrlTambah);
				} 

				let getUrlEdit = location.search.substr(1,13);
				if (getUrlEdit == "berhasil-edit") { 
					let getUrlEdit 	= "<?php if (isset($_GET['berhasil-edit'])) { echo $_GET['berhasil-edit']; } ?>";
					$("#pesanLoad").show();
					$("#pesanLoad").html(getUrlEdit);
				}

				let getUrlTambahBarangSama = location.search.substr(1,23);
				if (getUrlTambahBarangSama == "tambah_barang_yang_sama") { 
					let getUrlTambahBarangSama 	= "<?php if (isset($_GET['tambah_barang_yang_sama'])) { echo $_GET['tambah_barang_yang_sama']; } ?>";
					$("#pesanLoad").show();
					$("#pesanLoad").html(getUrlTambahBarangSama);
				}
				
				// Jika role moderator, maka remove beberapa modul
				<?php if ($sess_role == "moderator") { ?>
					$("#tambahBarang").remove();
					$("#THActions").remove();
					$(".buttonTambah").remove();
					$(".buttonEdit").remove();
					$(".buttonHapus").remove();
					$(".tableFirstChild").children().last().attr("colspan", "2");
				<?php } ?>
			}
		});

		function totalBarang(post, selector) {
			$.post("files_backend_ajax/backend_data_barang.php",{
				post 	: true
			},function(responseText) {	
				$(selector).html(responseText);
			});	
		}
		
		// Jumlah Semua Barang
		$.post("files_backend_ajax/backend_data_barang.php",{ totalSemuaBarang : true },function(responseText) {	
			$("#totalSemuaBarang").html(responseText);
		});
		
		// Jumlah Barang Elektronik
		$.post("files_backend_ajax/backend_data_barang.php",{ totalBarangElektronik : true },function(responseText) {	
			$("#totalBarangElektronik").html(responseText);
		});
		
		// Jumlah Barang Alat Tulis
		$.post("files_backend_ajax/backend_data_barang.php",{	totalBarangAlatTulis : true },function(responseText) {	
			$("#totalBarangAlatTulis").html(responseText);
		});
		
		// Jumlah Barang Kendaraan
		$.post("files_backend_ajax/backend_data_barang.php",{ totalBarangKendaraan : true },function(responseText) {
			$("#totalBarangKendaraan").html(responseText);
		});
		
		// Jumlah Barang Lainnya
		$.post("files_backend_ajax/backend_data_barang.php",{	totalBarangLainnya 	: true },function(responseText) {
			$("#totalBarangLainnya").html(responseText);
		});

		// Total pengeluaran
		$.post("files_backend_ajax/backend_data_barang.php",{	totalPengeluaran : true },function(responseText) {
			$("#totalPengeluaran").html(responseText);
		});


		// Filter Jenis Barang
		$("#filterJenisBarang").change(function() {
			let valFilterJenisBarang = $("#filterJenisBarang").val();
			switch(valFilterJenisBarang) {
				case "Filter Semua" : 
				$.post("files_backend_ajax/backend_data_barang.php",{ filterSemua : true }, function(responseText) {
					$("#tabelBarang").html(responseText);
				});
				break;
				case "Elektronik" : 
				$.post("files_backend_ajax/backend_data_barang.php",{ filterElektronik : true }, function(responseText) {
					$("#tabelBarang").html(responseText);
				});
				break;
				case "Alat Tulis" : 
				$.post("files_backend_ajax/backend_data_barang.php",{ filterAlatTulis : true }, function(responseText) {
					$("#tabelBarang").html(responseText);
				});
				break;
				case "Kendaraan" : 
				$.post("files_backend_ajax/backend_data_barang.php",{ filterKendaraan : true }, function(responseText) {
					$("#tabelBarang").html(responseText);
				});
				break;
				case "Lainnya" : 
				$.post("files_backend_ajax/backend_data_barang.php",{ filterLainnya : true }, function(responseText) {
					$("#tabelBarang").html(responseText);
				});
				break;			
			}
		});

		// Search nama barang
		$("#searchBarang").keyup(function() {
			let inputVal = $("#searchBarang").val().trim()
			$.post("files_backend_ajax/backend_data_barang.php",{
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

		// Pagination Tabel Barang
		$.ajax({
			url 	: "files_backend_ajax/backend_data_barang.php",
			type 	: "POST",
			data 	: { paginationTabelBarang : true },
			success : function(responseText) {
				$("#page-list").html(responseText);
			}
		});

		$("#page-next").click(function() {
			let dataPage 				= $(".page-actived").data("page") + 1;
			let pageListChildrenLength 	= $("#page-list").children().length;
			$.ajax({
				url 	: "files_backend_ajax/backend_data_barang.php",
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

	}); // END EVENT LOAD
</script>
</body>
</html>