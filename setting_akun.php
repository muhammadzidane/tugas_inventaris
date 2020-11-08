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
			if (isset($_GET['berhasil-ubah-password'])) {
				echo $_GET['berhasil-ubah-password'];
			}


			?>
		</div>
		<div class="cards">
			<div class="d-flex columns mx-auto">
				<div class="column-pink-1"><i class="fas fa-id-card fa-5x"></i></div>
				<div class="column-pink-2 text-center pt-3">
					<h4 class="font-neue pt-5"><?php echo $sess_username; ?></h4>
				</div>
			</div>
			<div class="d-flex justify-content-between">
				<div id="tambahAkun" class="d-flex columns ">
					<div class="column-orange-1"><i class="fas fa-user-plus fa-5x"></i></div>
					<div class="column-orange-2 text-center pt-3">
						<h4 class="font-neue pt-5">Tambahkan Akun</h4>
					</div>
				</div>
				<div id="ubahPassword" class="d-flex columns ">
					<div class="column-orange-1"><i class="fas fa-user-edit fa-5x"></i></div>
					<div class="column-orange-2 text-center pt-3">
						<h4 class="font-neue pt-5">Ubah Password</h4>
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
		<div class="d-flex justify-content-between filsearch">
			<div class="search-icon">
				<input id="searchUsername" type="text" name="searchBarang" autocomplete="off"
				placeholder="Cari Username">
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
		<div id="tabelUsers"></div>
	</div>
	<footer>
		<p class="text-white pt-2 ml-3">Tugas Inventaris 2020</p>
	</footer>
	<script>
		"use strict";

		function pageLink(button) {
			let dataPage 				= $(button).data("page");
			let pageListChildrenLength 	= $("#page-list").children().length;
			$.ajax({
				url 	: "files_backend_ajax/backend_setting_akun.php",
				type 	: "POST",
				data 	: { pageListTabelUsers : dataPage, pageListChildrenLength : pageListChildrenLength },
				success : function(responseText) {
					$("#tabelUsers").html(responseText);
				}
			});

			for (let i = 1; i <= pageListChildrenLength; i++) {
				if (dataPage == i) {
					$(".page-circle").removeClass("page-actived");	
					$(button).addClass("page-actived");
				}
			}
		}

		function buttonUbahRole(event, button){
			let dataUsername  		= $(button).data("username");

			$.ajax({
				url 	: "files_backend_ajax/backend_setting_akun.php",
				type 	: "POST",
				data 	: { dataUsername : dataUsername },
				success : function(responseText) {
					$("#tabelUsers").html(responseText);
				}
			});
		}

		function buttonBatalUbahRole(event, button) {
			$.ajax({
				url 		:"files_backend_ajax/backend_setting_akun.php",
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
					url 	: "files_backend_ajax/backend_setting_akun.php",
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
					url 		:"files_backend_ajax/backend_setting_akun.php",
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
		$("#pesanLoad").hide();

		// Jika role moderator maka hide modul tambah user baru
		<?php if ($sess_role == "moderator") { ?>
			$("#tambahAkun").parent().addClass("justify-content-around");
			$("#tambahAkun").remove();
			$("#tabelUsers").prev().remove();
			$("#tabelUsers").remove();
		<?php } ?>

		// Muncul tabel saat pertama load
		$.ajax({
			url 		:"files_backend_ajax/backend_setting_akun.php",
			type 		: "POST",
			data 		: { tabelUsers : true },
			success		:function(responseText) {	
				$("#tabelUsers").html(responseText);
			}	
		});


		<?php if (isset($_GET["berhasil-tambah-akun"])) { ?>
			$("#pesanLoad").show();
			$("#pesanLoad").html("<?php echo $_GET["berhasil-tambah-akun"]; ?>");
		<?php } ?> // END IF PHP

		<?php if (isset($_GET["berhasil-ubah-password"])) { ?>
			$("#pesanLoad").show();
			$("#pesanLoad").html("<?php echo $_GET["berhasil-ubah-password"]; ?>");
		<?php } ?> // END IF PHP

		<?php if (isset($_GET["hapus"])) { ?>
			$("#pesanLoad").show();
			$("#pesanLoad").html("<?php echo $_GET["hapus"]; ?>");
		<?php } ?> // END IF PHP

		<?php if (isset($_GET["ubah-role"])) { ?>
			$("#pesanLoad").show();
			$("#pesanLoad").html("<?php echo $_GET["ubah-role"]; ?>");
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
			$.post("files_backend_ajax/backend_setting_akun.php",{
				searchUsername 	: inputVal
			},function(responseText) {
				if (responseText == "Username tidak ditemukan") {
					$("#pesan").html(responseText);
					$("#pesan").show();
				}
				else {
					$("#pesan").hide();
					$("#tabelUsers").html(responseText);
				}
				console.log(responseText);
			});
		});

		// Pagination username
		$.ajax({
			url 	: "files_backend_ajax/backend_setting_akun.php",
			type 	: "POST",
			data 	: { paginationTabelUsername : true },
			success : function(responseText) {
				$("#page-list").html(responseText);
			}
		});

		// Page Next
		$("#page-next").click(function() {
			let dataPage 						= $(".page-actived").data("page") + 1;
			let pageListChildrenLength 			= $("#page-list").children().length;
			$.ajax({
				url 	: "files_backend_ajax/backend_setting_akun.php",
				type 	: "POST",
				data 	: { pageNext : dataPage },
				success : function(responseText) {
					$("#tabelUsers").html(responseText);
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