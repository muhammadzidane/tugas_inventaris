<!DOCTYPE html>
<html>
<head>
	<link href='https://fonts.googleapis.com/css?family=Bebas Neue' rel='stylesheet'>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="fontawesome-5.13.1/css/all.min.css">
	<script type="text/javascript" src="bootstrap/js/jquery.js"></script>
	<script type="text/javascript" src="bootstrap/js/popper.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
	<title>tes</title>
</head>
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
		.column0 {
			padding-top: 32px;
			text-align: center;
			color: #ffffff;
			width: 150px;
			height: 380px;
			background-color: #ff9f43;
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
			padding-top: 64px; 
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
<body class="container">
	<div class="d-flex justify-content-between">
		<div id="tambahAkun" class="d-flex columns my-5">
			<div class="column1"><i class="fas fa-user-plus fa-5x"></i></div>
			<div class="column2 text-center">
				<h4 class="font-neue">Tambahkan Akun</h4>
			</div>
		</div>
		<div id="ubahAkunSetting" class="d-flex columns my-5">
			<div class="column1"><i class="fas fa-user-edit fa-5x"></i></div>
			<div class="column2 text-center">
				<h4 class="font-neue">Akun Saya</h4>
			</div>
		</div>
		<div class="d-flex columns my-5">
			<div class="column1"><i class="fas fa-user-lock fa-5x"></i></div>
			<div class="column2 text-center">
				<h4 class="font-neue">Lupa Password</h4>
			</div>
		</div>
	</div>

	<div class="btn btn-primary shadow">tes</div>
</body>
</html>