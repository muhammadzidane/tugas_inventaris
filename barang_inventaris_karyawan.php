<?php 
session_start();
$conn 					= mysqli_connect("localhost","root","","tugas_inventaris");
require_once 'files_backend_ajax/php_functions.php';
cek_session();

$sess_role 				= (isset($_SESSION['role'])) ? $_SESSION['role'] : "";
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
			if (isset($_GET['berhasil-ubah-password'])) {
				echo $_GET['berhasil-ubah-password'];
			}
			?>
		</div>
		<div class="d-flex columns mx-auto">
			<div class="column-pink-1"><i class="fas fa-id-card fa-5x pt-2"></i></div>
			<div class="column-pink-2 text-center">
				<h4 class="font-neue h-user pt-5"><?= $url_nama_karyawan; ?></h4>
				<h5 class="font-neue"><?= $url_kode_karyawan; ?></h5>
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
	<script>
		"use strict";


	function pageLink(button) {
		let dataPage 					= $(button).data("page");
		let pageListChildrenLength = $("#page-list").children().length;
		$.ajax({
			url 	: "files_backend_ajax/backend_barang_inventaris_karyawan.php",
			type 	: "POST",
			data 	: { 
				pageListTabelBarang 		: dataPage,
				kodeKaryawan				: "<?= $url_kode_karyawan ?>", 
				pageListChildrenLength 	: pageListChildrenLength 
			},
			success : function(responseText) {
				$("#tabelBarangInvKaryawan").html(responseText);
			}
		});

		for (let i = 1; i <= pageListChildrenLength; i++) {
			if (dataPage == i) {
				$(".page-circle").removeClass("page-actived");	
				$(button).addClass("page-actived");
			}
		}
	}

	// Batal tambah barang
	function buttonBatal(event, button){
		$("#tambahBarangInv").click();
	}

	// Tambah barang
	function buttonTambahBarang(event, button) {
		let jumlahBarang 		 = $(button).parent().prev().prev().prev().prev();
		let dataKodeBarang 	 = $(button).data("kode");
		let valJumlahBarang 	 = $(button).parent().prev().prev().prev().prev().text();
		let removeTRNextAll   = $(button).parent().parent().nextAll();
		let removeTRPrevUntil = $(button).parent().parent().prevUntil(".tableFirstChild");
		let tableAppend 		 = "";
		tableAppend 			+= "<tr>";
		tableAppend				+= "<td></td>";
		tableAppend				+= "<td></td>";
		tableAppend				+=	"<td></td>";
		tableAppend				+=	"<td></td>";
		tableAppend				+=	"<td>";
		tableAppend				+=	"<input id='jumlahTambahBarang' placeholder='Jumlah'";
		tableAppend				+=	"class='form-control form-control-sm' type='number' min='0'>";
		tableAppend				+=	"</td>";
		tableAppend				+=	"<td><input id='tanggal_masuk' class='form-control form-control-sm' type='date'></td>";
		tableAppend				+=	"<td></td>";
		tableAppend				+=	"<td><button onclick='buttonQueryTambah(event, this);'";
		tableAppend				+=	`class='btn btn-primary' data-kode='${dataKodeBarang}' data-jumlah-awal='${valJumlahBarang}'>Tambah</button></td>`;
		tableAppend				+=	"<td><button onclick='buttonBatal(event, this);' class='btn btn-warning text-white'>Batal</button></td>";
		tableAppend 			+= "</tr>";
		removeTRNextAll.remove();
		removeTRPrevUntil.remove();
		$("table").append(tableAppend);
		$("#jumlahTambahBarang").keyup(function() {
			let valKUJumlahTambahBarang = $(this).val();

			for (let i = 1; i <= valJumlahBarang; i++) {
				if (valKUJumlahTambahBarang == i) {
					jumlahBarang.html(valJumlahBarang - i);
				}
			}
			for (let i = valJumlahBarang; i <= 0; i--) {	
				if (valKUJumlahTambahBarang == i) {
					jumlahBarang.html(valJumlahBarang + i);
				}
			}
			
			if (valKUJumlahTambahBarang == 0) {
				jumlahBarang.html(valJumlahBarang);
			}
			$(this).attr("max", valJumlahBarang);
		});

		$("#jumlahTambahBarang").click(function() {
			$(this).keyup();
		});
	}
	
	// Ajax tambah barang
	function buttonQueryTambah(event, button) {
		let jumlahAwalBarang 	= $(button).data("jumlah-awal");
		let valJumlahBarang  	= $("#jumlahTambahBarang").val();
		let valTanggalMasuk  	= $("#tanggal_masuk").val();
		let dataKodeBarang 		= $(button).data("kode");
		let confirmTambah 		= confirm("Apakah anda yakin ingin menambahkan barang?");
		if (confirmTambah) {
			if (valJumlahBarang == 0 || "" || valTanggalMasuk == "") {
				event.preventDefault();	
			}
			else {
				$.ajax({
					url 		: "files_backend_ajax/backend_barang_inventaris_karyawan.php",
					type 		: "POST",
					data 		: {
						queryTambahBarang	: dataKodeBarang,
						valJumlahBarang 	: valJumlahBarang,
						valTanggalMasuk 	: valTanggalMasuk,
						jumlahAwalBarang 	: jumlahAwalBarang,
						kodeKaryawan 		: "<?= $url_kode_karyawan; ?>",
						namaKaryawan 		: "<?= $url_nama_karyawan; ?>"
					},
					success 	: function(responseText) {
						let nama_karyawan = "&nama_karyawan=<?= $url_nama_karyawan ?>";
						let kode_karyawan = "&kode_karyawan=<?= $url_kode_karyawan ?>";
						location.assign("barang_inventaris_karyawan.php?berhasil-tambah-barang=" + encodeURIComponent(responseText) + nama_karyawan + kode_karyawan);
					}
				});
			}
		}
	}

	// Hapus barang
	function buttonHapusBarang(event, button) {
		let confirmHapusBarang = confirm("Apakah anda yakin ingin menghapus data barang?");
		if (confirmHapusBarang) {
			let dataKodeBarang = $(button).data("kode");
			$.ajax({
				url 		: "files_backend_ajax/backend_data_barang.php",
				type 		: "POST",
				data 		: { hapusBarangInvKaryawan : dataKodeBarang },
				success	: function(responseText) {
					$("#pesan").show();
					$("#pesan").html(responseText);
					// Tampilkan tabel saat berhasil menghapus barang
					$.post('files_backend_ajax/backend_daftar_karyawan.php',{ tabelBarangInvKaryawan : "<?= $url_kode_karyawan; ?>" },
						function(responseText){
							$("#tabelBarangInvKaryawan").html(responseText);
						}
						);
				}
			});
		}
	}		

	// Load Event =========================================>>
	$(document).ready(function() {
		$("#pesan").hide();
		$("#pesanLoad").hide();

		// Muncul tabel saat pertama load
		$.ajax({
			url 		: "files_backend_ajax/backend_barang_inventaris_karyawan.php",
			type 		: "POST",
			data 		: { tabelBarangInvKaryawan : "<?= $url_kode_karyawan; ?>" },
			success		:function(responseText) {	
				$("#tabelBarangInvKaryawan").html(responseText);
				$(".buttonTambah").hide();
			}	
		});

		<?php 
		if (isset($_GET['berhasil-tambah-barang'])) {
			$berhasilTambahBarang = $_GET['berhasil-tambah-barang']; ?> // End PHP
			$("#pesanLoad").show();
			$("#pesanLoad").html("<?php echo $berhasilTambahBarang; ?>");
		<?php } ?>// End IF


		// Search nama barang
		$("#searchBarang").keyup(function() {
			let inputVal = $("#searchBarang").val().trim()
			$.post("files_backend_ajax/backend_barang_inventaris_karyawan.php",{
				searchBarang 	: inputVal, kodeKaryawan : "<?= $url_kode_karyawan; ?>"
			},function(responseText) {
				if (responseText == "Barang Tidak Ditemukan") {
					$("#pesan").html(responseText);
					$("#pesan").show();
				}
				else {
					$("#pesan").hide();
					$("#tabelBarangInvKaryawan").html(responseText);
					$(".buttonTambah").hide();
				}
			});
		});

		// Pagination Tabel Barang
		$.ajax({
			url 	: "files_backend_ajax/backend_barang_inventaris_karyawan.php",
			type 	: "POST",
			data 	: { paginationTabelBarang : "<?= $url_kode_karyawan; ?>" },
			success : function(responseText) {
				$("#page-list").html(responseText);
			}
		});

		// Page Next
		$("#page-next").click(function() {
			let dataPage 						= $(".page-actived").data("page") + 1;
			let pageListChildrenLength 	= $("#page-list").children().length;
			$.ajax({
				url 	: "files_backend_ajax/backend_barang_inventaris_karyawan.php",
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

		// Jumlah Semua Barang
		$.post("files_backend_ajax/backend_daftar_karyawan.php",{ totalSemuaBarang : "<?= $url_kode_karyawan; ?>" },function(responseText) {	
			$("#totalSemuaBarang").html(responseText);
		});
		
		// Jumlah Barang Elektronik
		$.post("files_backend_ajax/backend_daftar_karyawan.php",{ totalBarangElektronik : "<?= $url_kode_karyawan; ?>" },function(responseText) {	
			$("#totalBarangElektronik").html(responseText);
		});
		
		// Jumlah Barang Alat Tulis
		$.post("files_backend_ajax/backend_daftar_karyawan.php",{	totalBarangAlatTulis : "<?= $url_kode_karyawan; ?>" },function(responseText) {	
			$("#totalBarangAlatTulis").html(responseText);
		});
		
		// Jumlah Barang Kendaraan
		$.post("files_backend_ajax/backend_daftar_karyawan.php",{ totalBarangKendaraan : "<?= $url_kode_karyawan; ?>" },function(responseText) {
			$("#totalBarangKendaraan").html(responseText);
		});
		
		// Jumlah Barang Lainnya
		$.post("files_backend_ajax/backend_daftar_karyawan.php",{	totalBarangLainnya 	: "<?= $url_kode_karyawan; ?>" },function(responseText) {
			$("#totalBarangLainnya").html(responseText);
		});

		// Tambah barang inventaris untuk karyawan
		$("#tambahBarangInv").click(function(e) {
			$("#dataBarang").html("Data Barang").addClass("judul font-neue w-25").css("font-size", "30px");
			$("#batalTambahBarangInv").html("<button class='btn btn-warning text-white ml-1'>Batal</button>");
			$.ajax({
				url 		: "files_backend_ajax/backend_barang_inventaris_karyawan.php",
				type 		: "POST",
				data 		: { showTabelDataBarang : true },
				success		:function(responseText) {	
					$("#tabelBarangInvKaryawan").html(responseText);
					$(".buttonEdit").remove();
					$(".buttonHapus").remove();
				}
			});
		});

		$("#batalTambahBarangInv").click(function() {
			$(this).html("");
			$("#dataBarang").html("");
			$.ajax({
				url 		: "files_backend_ajax/backend_barang_inventaris_karyawan.php",
				type 		: "POST",
				data 		: { tabelBarangInvKaryawan : "<?= $url_kode_karyawan; ?>" },
				success		:function(responseText) {	
					$("#tabelBarangInvKaryawan").html(responseText);
					$(".buttonTambah").remove();
				}	
			});
		});
	});
</script>
</body>
</html>