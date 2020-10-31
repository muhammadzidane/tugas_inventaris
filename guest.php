<?php 
session_start();
$conn 				= mysqli_connect("localhost","root","","daftar_inventaris");
$username 			= (isset($_POST['username'])) ? $_POST['username'] : "";
$password 			= (isset($_POST['password'])) ? sha1($_POST['password']) : "";
$sess_username 		= (isset($_SESSION['username']) ? $_SESSION['username'] : "");
$sess_username 		= $_POST['username'];
$result 			= "SELECT * FROM tb_users WHERE username LIKE '$username' AND password LIKE '$password'";
$query 				= mysqli_query($conn,$result);
if (!$query) {
	die(mysqli_error($conn));
}

if (mysqli_affected_rows($conn) === 0) {
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
	<script type="text/javascript" src="bootstrap/js/popper.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
	<style>
		body {
			background-color: #F8F8F8;
		}
		nav {
			height: 50px;
		}
		.tableFirstChild {
			background-color: navy;
			color: #FFE400;
		}
		.container-manual {
			width: 94%;
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
		}
		table tr:hover {
			background-color: #FFE400;
			color: #FFFFFF;
			cursor: pointer;
		}
		.bg-tomato {
			background-color: tomato;
		}
		.mr-login {
			/*margin-left: 70em; */
		}
		.daftar-pegawai {
			margin: 55px auto;
			text-align: center;
			border-bottom: 3px solid black;
			width: 300px;
		}
		.filsearch { margin: 11px 0px; }
		.c-pointer { cursor: pointer; }
		.columns {
			width: 320px;
			margin: 100px 0px;
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
	<header>
		<div class="judul text-center mt-3 font-neue">Daftar Inventaris Karyawan IT+</div>
		<div class="judul-tanggal mb-1 text-center font-neue">Tahun 2020</div>	
	</header>

	<nav class="navbar navbar-expand-md bg-tomato">
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link text-white" href="">Daftar Pegawai</a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-white" href="">Laporan Barang Investasi</a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-white" href="">Barang Masuk</a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-white" href="">Barang Keluar</a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-white" href="">Setting Akun</a>
			</li>
		</ul>
		<div class="text-white ml-auto" id="waktu"></div>
		<button class="btn btn-info ml-3">
			Logout
			<i class="fas fa-sign-out-alt"></i>
		</button>
	</nav>
	<div class="container">
		<h1 class="judul font-neue daftar-pegawai">Daftar Pegawai</h1>
		<div class="border-daftar-pegawai"></div>
		<img class="logo" src="logo.png">
		<div>
			<div class="d-flex columns">
				<div class="column1"><i class="fas fa-users fa-5x"></i></div>
				<div class="column2 text-center">
					<p>10</p>
					<p>Total Karyawan</p>
				</div>
			</div>
		</div>
		<div class="d-flex justify-content-between filsearch">
			<div>
				<label class="c-pointer" for="jabatan">Filter Jabatan :</label>
				<select class="c-pointer" id="jabatan">
					<option disabled>-Filter Jabatan-</option>
					<option>Bos</option>
					<option>Gudang</option>
					<option>Programmer</option>
					<option>Designer</option>
				</select>
			</div>
			<div>
				<input id="search" type="text" name="search">
				<label for="search">Search</label>
			</div>
		</div>
		<table class="table">
			<tr class="tableFirstChild">
				<th>Nomer Pegawai</th>
				<th>Nama</th>
				<th>Username</th>
				<th>Jabatan</th>
				<th>Barang Investasi</th>
				<th>Batas Waktu Barang</th>	
			</tr>
			<?php 
			for ($i=1; $i <=10 ; $i++) { 
				echo "<tr>";
				echo "<td>$i</td>";
				echo "<td>Muhammad Zidane</td>";
				echo "<td>zidaneGanteng20</td>";
				echo "<td>Bos</td>";
				echo "<td>Laptop</td>";
				echo "<td>2019-2020</td>"; 
				echo "</tr>"; 
			}
			?>
		</table>
	</div>
	<footer>
		<p class="text-white pt-2 ml-3">Tugas Inventaris 2020</p>
	</footer>
	<script>
		"use strict";

		$(document).ready(function() {

			//Ajax saat terjadi event Load \\

		});
	</script>
</body>
</html>