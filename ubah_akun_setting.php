<?php 
session_start();
require_once 'files_backend_ajax/php_functions.php';
cek_session();
$username 		= $_SESSION['username'];
$result 			= "SELECT * FROM tb_users WHERE username ='$username';";
$query 			= mysqli_query($conn, $result);
$data 			= mysqli_fetch_assoc($query);

$username 		= $data['username'];
$email 			= $data['email'];
$jenis_role 	= $data['role'];

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ubah Akun Setting</title>
	<link href='https://fonts.googleapis.com/css?family=Bebas Neue' rel='stylesheet'>
	<link rel="stylesheet" type="text/css" href="global_css.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/fontawesome-5.13.1/css/all.min.css">
	<script type="text/javascript" src="bootstrap/js/jquery.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
</head>
<body>
	<form id='form-tambah-barang' action="setting_akun.php" method="post">
		<div class='header-form font-neue'><h3>Ubah Akun Setting</h3></div>
		<div id="closeForm">&times;</div>
		<div class='form-group'>
			<label for='username'>Ubah Username</label>
			<input id='username' class='form-control' type='text'>
			<div class="pesan"></div>
			<div id="checkAndTimesUsername"></div>
		</div>
		<div class='form-group'>
			<label for='email'>Ubah Email</label>
			<input id='email' class='form-control' type='email'>
			<div class="pesan"></div>
			<div id="checkAndTimesEmail"></div>
		</div>
		<div class='form-group'>
			<label for='password'>Password Baru</label>
			<input id='password' class='form-control' type='password' autocomplete="off">
			<div class="pesan"></div>
			<div id="checkAndTimesPassword"></div>
		</div>
		<div class='form-group'>
			<label for='ulangiPassword'>Ulangi Password Baru</label>
			<input id='ulangiPassword' class='form-control' type='password' autocomplete="off">
			<div class="pesan"></div>
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
			<button id='tambahAkun' class='btn btn-primary'>Ubah</button>
			<button id='batal' class='btn btn-danger'>Batal</button>
		</div>
	</form>
	<script>
		$(document).ready(function() {
			$("#username").val("<?php echo $username; ?>");
			$("#email").val("<?php echo $email; ?>");
			$("#role").val("<?php echo $jenis_role; ?>");

			let pesanValidasi = [];

			// Validasi username
			$("#username").keyup(function() {
				let valUsername 	= $(this).val();
				if (valUsername.length <= 3 || valUsername.length > 12 ) {
					$(this).next().html("minimal 4 karakter, dan maksimal 12");
					$("#checkAndTimesUsername").html("<i class='far fa-times-circle text-danger'></i>");
					pesanValidasi[0] = true;
				}
				else if (valUsername.length > 3) {
					$("#checkAndTimesUsername").html("<i class='far fa-check-circle text-success'></i>")
					$(this).next().html("");
					$.ajax({
						url 		: "files_backend_ajax/backend_setting_akun.php",
						type 		: "POST",
						data 		: { validasiUsername : valUsername },
						success 	: function(responseText) {
							if (responseText != "berhasil") {
								$("#checkAndTimesUsername").html("<i class='far fa-times-circle text-danger'></i>");
								$("#username").next().html(responseText);
								pesanValidasi[0] = true;
							}
							else {
								pesanValidasi[0] = false;	
							}
						}
					});
				}
				
				if (valUsername.length == "") {
					$("#checkAndTimesUsername").html("");
				}
			});

			// Validasi email
			$("#email").keyup(function() {
				let valEmail 	= $(this).val();
				let polaEmail 	= /.+@{1}gmail|yahoo\..+/;
				if (polaEmail.test(valEmail)) {
					$(this).next().html("");
					$("#checkAndTimesEmail").html("<i class='far fa-check-circle text-success'></i>");
					pesanValidasi[1] = false;	
				} 
				else {
					$(this).next().html("Harap masukan Email dengan benar");
					$("#checkAndTimesEmail").html("<i class='far fa-times-circle text-danger'></i>");
					pesanValidasi[1] = true;
				}
			});

			// Validasi password
			$("#password").keyup(function() {
				let valPassword = $(this).val();
				if (valPassword.length <= 5) {
					$(this).next().html("Minimal 6 karakter");
					$("#checkAndTimesPassword").html("<i class='far fa-times-circle text-danger'></i>");
					pesanValidasi[2] = true;
				}
				else {
					$(this).next().html("");
					$("#checkAndTimesPassword").html("<i class='far fa-check-circle text-success'></i>");
					pesanValidasi[2] = false;	
				}
			});

			// Validasi ulangi password
			$("#ulangiPassword").keyup(function() {
				let valUlangiPassword 	= $(this).val();
				let valPassword 		= $("#password").val(); 
				if (valUlangiPassword != valPassword) {
					$(this).next().html("Password tidak sama");
					$("#checkAndTimesUlangiPassword").html("<i class='far fa-times-circle text-danger'></i>");
					pesanValidasi[3] = true;
				}
				else {
					$(this).next().html("");
					$("#checkAndTimesUlangiPassword").html("<i class='far fa-check-circle text-success'></i>");
					pesanValidasi[3] = false;
				}
			});

			// Button tambah akun
			$("#tambahAkun").click(function(e) {
				let confirmEditAkun 		= confirm("Apakah anda yakin ingin mengubah data akun ?");
				if (confirmEditAkun) {	
					let valUsername 		= $("#username").val();
					let valEmail 			= $("#email").val();
					let valPassword 		= $("#password").val();
					let valUlangiPassword 	= $("#ulangiPassword").val();
					let valJenisRole 		= $("#jenisRole").val();

					function validasiTambahAkun(variabel, value) {
						if (variabel === "") {
							e.preventDefault();
							$(value).next().html("<small>Tidak boleh kosong</small>").addClass('pesan');
							$(value).focus(function() {
								$(value).next().html("");
							});
							pesanValidasi[4] = true; 
						}
						else {
							pesanValidasi[4] = false;	
						}
					}
					validasiTambahAkun(valUsername,"#username");
					validasiTambahAkun(valEmail,"#email");
					validasiTambahAkun(valPassword, "#password");
					validasiTambahAkun(valUlangiPassword,"#ulangiPassword");

					// Jika tidak ada pesan validasi maka update akun
					if ($(".pesan").text() == "") {
						$.ajax({
							url 		: "files_backend_ajax/backend_setting_akun.php",
							type 		: "POST",
							data 		: {
								updateTBUsers 	: true,
								valUsername 	: valUsername,
								valPassword 	: valPassword,
								valEmail 		: valEmail,
								valJenisRole 	: valJenisRole
							},
							success  : function(responseText) {
								location.assign(`setting_akun.php?ubah_akun_setting=${responseText}`);
							}
						});
					}
					else {
						e.preventDefault();
					}
				}
				else {
					e.preventDefault();
				}
			});

			// Button Batalkan Tambah Barang
			$("#buttonBatal").click(function() {
				location.replace("setting_akun.php");
			});

			// Button Batalkan Tambah Barang (Simbol Close)
			$("#closeForm").click(function() {
				location.replace("setting_akun.php");
			});
		});
	</script>
</body>
</html>