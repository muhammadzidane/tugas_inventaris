<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Tambah Akun Baru</title>
	<link href='https://fonts.googleapis.com/css?family=Bebas Neue' rel='stylesheet'>
	<link rel="stylesheet" type="text/css" href="global_css.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/fontawesome-5.13.1/css/all.min.css">
	<script type="text/javascript" src="bootstrap/js/jquery.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
	<style>
		/* Form Tambah Barang */
		#form-tambah-akun {
			background-color: #FFFFFF;
			box-shadow: 0 0 4px black;
			width: 550px;
			height: 700px;
			margin: 55px auto;
		}
		.header-form {
			text-align: center;
			color: #FFFFFF;
			background-color: #24305E;
			padding: 28px;
		}
		.pesan {
			position: absolute;
			font-size: 10px;
			color: tomato;
		}
		.pesanPeringatan {
			font-size: 10px;
			color: #79d70f;
		}

		.form-group{
			margin: 10px;
		}
		#tambahBarang {
			color: #FFFFFF;
			padding: 6px 12px;
			box-shadow: 0px 0px 4px black;
		}
		#form-tambah-akun .form-group {
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
		#checkAndTimesUsername {
			font-size: 21px;
			position: absolute;
			margin-left: 439px;
			top: 212px;
		}
		#checkAndTimesEmail {
			font-size: 21px;
			position: absolute;
			margin-left: 439px;
			top: 307px;	
		}
		#checkAndTimesPassword {
			font-size: 21px;
			position: absolute;
			margin-left: 439px;
			top: 401px;	
		}
		#checkAndTimesUlangiPassword {
			font-size: 21px;
			position: absolute;
			margin-left: 439px;
			top: 496px;	
		}
		.font-neue { font-family: 'Bebas Neue'; }
		.-size: 13px;
		color: tomato;
	}
</style>
</head>
<body>
	<form id='form-tambah-akun'>
		<div class='header-form font-neue'><h3>Tambahkan Akun Baru</h3></div>
		<div id="closeForm">&times;</div>
		<div class='form-group'>
			<label>Username</label>
			<input id='username' class='form-control' type='text'>
			<div class='pesan' class="pesanPeringatan"></div>
			<div id="checkAndTimesUsername"></div>
		</div>
		<div class='form-group'>
			<label for='email'>Email</label>
			<input id='email' class='form-control' type='email'>
			<div class='pesan'></div>
			<div id="checkAndTimesEmail"></div>
		</div>
		<div class='form-group'>
			<label for='password'>Password</label>
			<input id='password' class='form-control' type='password' autocomplete="off">
			<div class='pesan'></div>
			<div id="checkAndTimesPassword"></div>
		</div>
		<div class='form-group'>
			<label for='ulangiPassword'>Ulangi Password</label>
			<input id='ulangiPassword' class='form-control' type='password' autocomplete="off">
			<div class='pesan'></div>
			<div id="checkAndTimesUlangiPassword"></div>
		</div>
		<div class='form-group'>
			<label for='jenisRole'>Jenis Role</label>
			<select id='jenisRole' class='form-control'>
				<option disabled>-Role-</option>
				<option value="superuser">Superuser</option>
				<option value="moderator">Moderator</option>
			</select>
		</div>
		<div class='form-group float-right'>
			<button id='buttonTambahAkun' class='btn btn-primary'>Tambah Akun</button>
			<button id='buttonBatal' class='btn btn-danger'>Batal</button>
		</div>
	</form>
	<script>
		$(document).ready(function() {	

			// Validasi username
			$("#username").keyup(function() {
				let valUsername 	= $(this).val();
				if (valUsername.length <= 3 || valUsername.length > 12 ) {
					$(this).next().html("minimal 4 karakter, dan maksimal 12");
					$("#checkAndTimesUsername").html("<i class='far fa-times-circle text-danger'></i>");
				}
				else if (valUsername.length > 3) {
					$("#checkAndTimesUsername").html("<i class='far fa-check-circle text-success'></i>");
					$(this).next().html("");
					$.ajax({
						url 		: "backend_setting_akun.php",
						type 		: "POST",
						data 		: { validasiUsername : valUsername },
						success 	: function(responseText) {
							if (responseText != "berhasil") {
								$("#checkAndTimesUsername").html("<i class='far fa-times-circle text-danger'></i>");
								$("#username").next().html(responseText);
							}
							else {	
								$("#checkAndTimesUsername").html("<i class='far fa-check-circle text-success'></i>");	
							}
						}
					});
				}
				
				if (valUsername == "") {
					$(this).next().html("");
				}
			});

			// Validasi email
			$("#email").keyup(function() {
				let valEmail 	= $(this).val();
				let polaEmail 	= /.+@{1}gmail|yahoo\..+/;
				if (polaEmail.test(valEmail)) {
					$(this).next().html("");
					$("#checkAndTimesEmail").html("<i class='far fa-check-circle text-success'></i>");	
				} 
				else {
					$(this).next().html("Harap masukan Email dengan benar");
					$("#checkAndTimesEmail").html("<i class='far fa-times-circle text-danger'></i>");
				}
			});

			// Validasi password
			$("#password").keyup(function() {
				let valPassword = $(this).val();
				if (valPassword.length <= 5) {
					$(this).next().html("Minimal 6 karakter");
					$("#checkAndTimesPassword").html("<i class='far fa-times-circle text-danger'></i>");
				}
				else {
					$(this).next().html("");
					$("#checkAndTimesPassword").html("<i class='far fa-check-circle text-success'></i>");	
				}
			});

			// Validasi ulangi password
			$("#ulangiPassword").keyup(function() {
				let valUlangiPassword 	= $(this).val();
				let valPassword 		= $("#password").val(); 
				if (valUlangiPassword != valPassword) {
					$(this).next().html("Password tidak sama");
					$("#checkAndTimesUlangiPassword").html("<i class='far fa-times-circle text-danger'></i>");
				}
				else {
					$(this).next().html("");
					$("#checkAndTimesUlangiPassword").html("<i class='far fa-check-circle text-success'></i>");
				}
			});

			// Button tambah akun
			$("#buttonTambahAkun").click(function(e) {
				let valUsername 		= $("#username").val();
				let valEmail 			= $("#email").val();
				let valPassword 		= $("#password").val();
				let valUlangiPassword 	= $("#ulangiPassword").val();
				let valJenisRole 		= $("#jenisRole").val();
				validasiKosong(valUsername,"#username");
				validasiKosong(valEmail,"#email");
				validasiKosong(valPassword, "#password");
				validasiKosong(valUlangiPassword,"#ulangiPassword");

				if ($(".pesan").text() == "") {
					$.ajax({
						url 		: "backend_setting_akun.php",
						type 		: "POST",
						data 		: {
							insertTBUsers 	: true,
							valUsername 	: valUsername,
							valPassword 	: valPassword,
							valEmail 		: valEmail,
							valJenisRole 	: valJenisRole
						},
						success  : function(responseText) {
							location.assign("setting_akun.php?berhasil-tambah-akun=" + encodeURIComponent(responseText));
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
				e.preventDefault();
				location.replace("setting_akun.php");
			});
		});
	</script>
	<script src="jquery_functions/js_functions.js"></script>
</body>
</html>