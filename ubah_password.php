<?php 
session_start();

$conn 			= mysqli_connect("localhost","root","","tugas_inventaris");

// Mengambil value dari database untuk mengisi tag <input> value 
$kode_karyawan 	= (isset($_GET['kode_karyawan'])) ? $_GET['kode_karyawan'] : "";
$username 		= (isset($_GET['username'])) ? $_GET['username'] : "";
$result 		= "SELECT * FROM tb_karyawan WHERE kode_karyawan='$kode_karyawan';";
$query 			= mysqli_query($conn, $result);


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ubah Password</title>
	<link href='https://fonts.googleapis.com/css?family=Bebas Neue' rel='stylesheet'>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/fontawesome-5.13.1/css/all.min.css">
	<script type="text/javascript" src="bootstrap/js/jquery.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
	<style>

		/* Form Tambah Barang */
		#formUbahPassword {
			background-color: #FFFFFF;
			box-shadow: 0 0 4px black;
			width: 550px;
			height: 595px;
			margin: 55px auto;
		}
		.header-form {
			text-align: center;
			color: #FFFFFF;
			background-color: #24305E;
			padding: 28px;
		}
		#pesanEditBarang {
			position: absolute;
		}

		.form-group{
			margin: 10px;
		}
		#tambahBarang {
			color: #FFFFFF;
			padding: 6px 12px;
			box-shadow: 0px 0px 4px black;
		}
		#formUbahPassword .form-group {
			margin: 25px 40px;
		}
		#closeForm {
			position: absolute;
			top: 49px;
			color: white;
			font-size: 25px;
			margin-left: 528px;
			cursor: pointer;
		}
		.font-neue { font-family: 'Bebas Neue'; }
		.pesanValidasi {
			position: absolute;
			font-size: 13px;
			color: tomato;
		}
	</style>
</head>
<body>
	<form id='formUbahPassword'>
		<div class='header-form font-neue'><h3>Ubah Password</h3></div>
		<div id="closeForm">&times;</div>
		<div class='form-group'>
			<label for='username'>Username</label>
			<input id='username' class='form-control' type='text' autocomplete="off" value="<?php echo $username; ?>" readonly>
			<div class='pesanValidasi'></div>
		</div>
		<div class='form-group'>
			<label for='masukanPasswordLama'>Masukan Password Lama</label>
			<input id='masukanPasswordLama' class='form-control' type='password' autocomplete="off">
			<div class='pesanValidasi'></div>
		</div>
		<div class='form-group'>
			<label for='passwordBaru'>Password Baru</label>
			<input id='passwordBaru' class='form-control' type='password' autocomplete="off" >
			<div class='pesanValidasi'></div>
		</div>
		<div class='form-group'>
			<label for='ulangiPassword'>Ulangi Password</label>
			<input id='ulangiPassword' class='form-control' type='password' autocomplete="off">
			<div class='pesanValidasi'></div>
		</div>
		<div class='form-group float-right'>
			<button type="submit" id='buttonUbah' class='btn btn-primary'>Ubah</button>
			<button type="submit" id='buttonBatal' class='btn btn-danger'>Batal</button>
		</div>
	</form>
	<script>
		$(document).ready(function() {

			$("#masukanPasswordLama").focus(function() {
				$("#masukanPasswordLama").next().html("");
			});

			$("#buttonUbah").click(function(e) {
				let confirmUbahPassword 	= confirm("Apakah anda yakin ingin mengubah password?");
				let valUsername 				= $("#username").val();
				let valMasukanPasswordLama = $("#masukanPasswordLama").val();
				let valPasswordBaru 			= $("#passwordBaru").val();
				let valUlangiPassword 		= $("#ulangiPassword").val();


				if (valMasukanPasswordLama == "") {
					$("#masukanPasswordLama").next().html("<small>Tidak boleh kosong</small>");
				}
				else {
					$.ajax({
						url 	: "files_backend_ajax/backend_setting_akun.php",
						type 	: "POST",
						data 	: { 
							validasiPassword 			: true, 
							valUsername 				: "<?php echo $username; ?>",
							valMasukanPasswordLama 	: valMasukanPasswordLama, 
						},
						success : function (responseText) {
							if (responseText == "berhasil") {
								$("#masukanPasswordLama").next().html("");
							}
							else {
								$("#masukanPasswordLama").next().html(responseText);
							}
						}
					});
				}


				if (valPasswordBaru != valUlangiPassword) {
					$("#ulangiPassword").next().html("<small>Password tidak sama</small>");
				}
				else {
					$("#ulangiPassword").next().html("");	
				}
				
				validasiMinimalLength(valPasswordBaru, "#passwordBaru", 6);
				validasiMinimalLength(valUlangiPassword, "#ulangiPassword", 6);
				validasiKosong(valPasswordBaru, "#passwordBaru");
				validasiKosong(valUlangiPassword, "#ulangiPassword");

				if ($(".pesanValidasi").text() == "") {
					$.ajax({
						url 		: "files_backend_ajax/backend_setting_akun.php",
						type 		: "POST",
						data 		: { 
							updatePassword 	: true, 
							valPasswordBaru 	: valPasswordBaru,
							valUsername 		: valUsername
						},
						success 	: function(responseText) {
							location.assign("setting_akun.php?berhasil-ubah-password=" + encodeURIComponent(responseText));
						}
					});
				}
				else {
					e.preventDefault();
				}

			});
			// Button Batalkan Tambah Barang
			$("#buttonBatal").click(function(e) {
				e.preventDefault();
				location.assign("setting_akun.php");
			});

			// Button Batalkan Tambah Barang (Simbol Close)
			$("#closeForm").click(function(e) {
				$("#buttonBatal").click();
			});
		});
	</script>
	<script type="text/javascript" src="jquery_functions/js_functions.js"></script>
</body>
</html>