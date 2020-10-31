<?php 
session_start();

$conn 			= mysqli_connect("localhost","root","","tugas_inventaris");

// Mengambil value dari database untuk mengisi tag <input> value 
$kode_karyawan 	= (isset($_GET['kode_karyawan'])) ? $_GET['kode_karyawan'] : "";
$nama_karyawan 	= (isset($_GET['nama_karyawan'])) ? $_GET['nama_karyawan'] : "";
$result 		= "SELECT * FROM tb_karyawan WHERE kode_karyawan='$kode_karyawan';";
$query 			= mysqli_query($conn, $result);

while ($data = mysqli_fetch_assoc($query)) {
	$kode_karyawan 			= $data['kode_karyawan'];
	$nama_karyawan 			= $data['nama_karyawan'];
	$posisi_jabatan 		= $data['posisi_jabatan'];
	$email 					= $data['email'];
	$pendidikan_terakhir 	= $data['pendidikan_terakhir'];
	$alamat 				= $data['alamat'];
	$foto 					= $data['foto'];
}
var_dump($nama_karyawan);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Edit Karyawan</title>
	<link href='https://fonts.googleapis.com/css?family=Bebas Neue' rel='stylesheet'>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="fontawesome-5.13.1/css/all.min.css">
	<script type="text/javascript" src="bootstrap/js/jquery.js"></script>
	<style>
		/* Form Tambah Barang */
		#form-tambah-barang {
			background-color: #FFFFFF;
			box-shadow: 0 0 4px black;
			width: 550px;
			height: 890px;
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
		#form-tambah-barang .form-group {
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
			font-size: 13px;
			color: tomato;
		}
	</style>
</head>
<body>
	<div id='form-tambah-barang'>
		<div class='header-form font-neue'><h3>Edit Karyawan</h3></div>
		<div id="closeForm">&times;</div>
		<div class='form-group'>
			<label for='kode_karyawan'>Kode Karyawan</label>
			<input id='kode_karyawan' class='form-control' type='text' value="<?php echo $kode_karyawan; ?>">
			<div class='pesanValidasi'></div>
		</div>
		<div class='form-group'>
			<label for='nama_karyawan'>Nama Karyawan</label>
			<input id='nama_karyawan' class='form-control' type='text' value="<?php echo $nama_karyawan; ?>">
			<div class='pesanValidasi'></div>
		</div>
		<div class='form-group'>
			<label for='posisi_jabatan'>Posisi Jabatan</label>
			<select id='posisi_jabatan' class='form-control'>
				<option disabled>-Posisi Jabatan-</option>
				<option>Programmer</option>
				<option>UI/UX Designer</option>
				<option>Software Engineer</option>
				<option>Akutansi</option>
				<option>Customer Service</option>
				<option>Direktur</option>
				<option>Seketaris</option>
				<option>HRD</option>
			</select>
		</div>
		<div class='form-group'>
			<label for='email'>Email</label>
			<input id='email' class='form-control' type='text' value="<?php echo $email; ?>">
			<div class='pesanValidasi'></div>
		</div>
		<div class='form-group'>
			<label for='pendidikan_terakhir'>Pendidikan Terakhir</label>
			<input id='pendidikan_terakhir' class='form-control' type='text' value="<?php echo $pendidikan_terakhir; ?>">
			<div class='pesanValidasi'></div>
		</div>
		<div class='form-group'>
			<label for='alamat'>Alamat</label>
			<input id='alamat' class='form-control' type='text' value="<?php echo $alamat; ?>">
			<div class='pesanValidasi'></div>
		</div>
		<div class='form-group'>
			<label for='foto'>Foto</label>
			<input id='foto' class='form-control' type='text' value="<?php echo $foto; ?>">
			<div class='pesanValidasi'></div>
		</div>
		<div class='form-group float-right'>
			<button id='acceptEdit' class='btn btn-primary'>Edit</button>
			<button id='buttonBatalEdit' class='btn btn-danger'>Batal</button>
		</div>
	</div>
	<script>
		$(document).ready(function() {

			$("#posisi_jabatan").val("<?= $posisi_jabatan; ?>"); // Nilai pertama posisi jabatan saat load event berjalan 

			$("#acceptEdit").click(function(e) {
				let confirmEdit = confirm("Apakah Anda Yakin Ingin Menambahkan Data Barang?");
				if (confirmEdit) {
					let valKodeKaryawan 			= $("#kode_karyawan").val();
					let valNamaKaryawan 			= $("#nama_karyawan").val();
					let valPosisiJabatan 		= $("#posisi_jabatan").val();
					let valEmail 					= $("#email").val();
					let valPendidikanTerakhir	= $("#pendidikan_terakhir").val();
					let valAlamat 					= $("#alamat").val();
					let valFoto 					= $("#foto").val();
					validasiKosong(valKodeKaryawan,"#kode_karyawan");
					validasiNomer(valKodeKaryawan, "#kode_karyawan", 8)
					validasiKosong(valNamaKaryawan, "#nama_karyawan");
					validasiKosong(valEmail, "#email");
					validasiEmailEventClick(valEmail, "#email");
					validasiKosong(valPendidikanTerakhir, "#pendidikan_terakhir");
					validasiKosong(valAlamat, "#alamat");
					validasiKosong(valFoto, "#foto");

					if ($(".pesanValidasi").text() == "") {
						
						<?php 
							$_SESSION['kode_karyawan'] = $kode_karyawan;
						?>	

						$.ajax({
							url 	: "backend_daftar_karyawan.php",
							type 	: "POST",
							data 	: { validasiDuplikatKey : valKodeKaryawan },
							success : function(responseText, success) {
								if (responseText == "berhasil") {
									$.post('backend_daftar_karyawan.php',{
										acceptEdit 				: true, 
										urlKodeKaryawan 		: "<?php echo $kode_karyawan; ?>",
										urlNamaKaryawan 		: "<?php echo $nama_karyawan; ?>",
										valKodeKaryawan 		: valKodeKaryawan,
										valNamaKaryawan 		: valNamaKaryawan,
										valPosisiJabatan 		: valPosisiJabatan,
										valEmail 				: valEmail,
										valPendidikanTerakhir: valPendidikanTerakhir,
										valAlamat 				: valAlamat,
										valFoto 					: valFoto }, 
										function(responseText) {
											location.assign(`daftar_pegawai.php?berhasil_edit=${ responseText }`);
										}
										);
								}
								else {
									$("#kode_karyawan").next().html(`<small>${ responseText }</small>`).addClass('pesanValidasi');
									e.preventDefault();
								}
							}					
						});
					}
				}
		// 	});

	});
		// Button Batalkan Tambah Barang
		$("#buttonBatalEdit").click(function() {
			location.replace("daftar_pegawai.php");
		});

		// Button Batalkan Tambah Barang (Simbol Close)
		$("#closeForm").click(function() {
			$("#buttonBatalEdit").click();
		});
	});
</script>
<script src="jquery_functions/js_functions.js"></script>
</body>
</html>