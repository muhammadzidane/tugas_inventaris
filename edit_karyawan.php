<?php 
session_start();
require_once 'files_backend_ajax/php_functions.php';
cek_session();

// Mengambil value dari database untuk mengisi tag <input> value 
$val_url_kode_karyawan 	= (isset($_GET['kode_karyawan'])) ? $_GET['kode_karyawan'] : "";
$val_url_nama_karyawan 	= (isset($_GET['nama_karyawan'])) ? $_GET['nama_karyawan'] : "";

$result 				= "SELECT * FROM tb_karyawan WHERE kode_karyawan='$val_url_kode_karyawan';";
$query 				= mysqli_query($conn, $result);

while ($data = mysqli_fetch_assoc($query)) {
	$kode_karyawan 			= $data['kode_karyawan'];
	$nama_karyawan 			= $data['nama_karyawan'];
	$posisi_jabatan 			= $data['posisi_jabatan'];
	$email 						= $data['email'];
	$pendidikan_terakhir 	= $data['pendidikan_terakhir'];
	$alamat 						= $data['alamat'];
	$foto 						= $data['foto'];
}

$arr_posisi_jabatan = array(
	"Programmer", "UI/UX Designer", "Software Engineer", 
	"Akutansi", "Customer Service", "Direktur", "Seketaris", "HRD"
);

$arr_url_karyawan = array($val_url_kode_karyawan, $val_url_nama_karyawan);
$arr_url_karyawan = implode("-", $arr_url_karyawan);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Edit Karyawan</title>
	<link href='https://fonts.googleapis.com/css?family=Bebas Neue' rel='stylesheet'>
	<link rel="stylesheet" type="text/css" href="global_css.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/fontawesome-5.13.1/css/all.min.css">
	<script type="text/javascript" src="bootstrap/js/jquery.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
</head>
<body>
	<form id='form' action="files_backend_ajax/backend_daftar_karyawan.php" method="POST">
		<div class='header-form font-neue'><h3>Edit Karyawan</h3></div>
		<a href="daftar_pegawai.php"><div id="closeForm">&times;</div></a>
		<div class='form-group'>
			<label for='kodeKaryawan'>Kode Karyawan</label>
			<input id='kodeKaryawan' name='kodeKaryawan' class='form-control' type='text' value="<?php echo $kode_karyawan; ?>">
			<div class='pesanValidasi'></div>
		</div>
		<div class='form-group'>
			<label for='namaKaryawan'>Nama Karyawan</label>
			<input id='namaKaryawan' name='namaKaryawan' class='form-control' type='text' value="<?php echo $nama_karyawan; ?>">
			<div class='pesanValidasi'></div>
		</div>
		<div class='form-group'>
			<label for='posisiJabatan'>Posisi Jabatan</label>
			<select id='posisiJabatan' name='posisiJabatan' class='form-control'>
				<option disabled>-Posisi Jabatan-</option>
				<?php 

				foreach ($arr_posisi_jabatan as $key => $value) {
					if ($posisi_jabatan == $value) {
						echo "<option selected>";
					}
					else {
						echo "<option>";	
					}
					echo "$value</option>";
				}
				?>
			</select>
		</div>
		<div class='form-group'>
			<label for='email'>Email</label>
			<input id='email' name='email' class='form-control' type='text' value="<?php echo $email; ?>">
			<div class='pesanValidasi'></div>
		</div>
		<div class='form-group'>
			<label for='pendidikanTerakhir'>Pendidikan Terakhir</label>
			<input id='pendidikanTerakhir' name="pendidikanTerakhir" class='form-control' type='text' value="<?php echo $pendidikan_terakhir; ?>">
			<div class='pesanValidasi'></div>
		</div>
		<div class='form-group'>
			<label for='alamat'>Alamat</label>
			<input id='alamat' name='alamat' class='form-control' type='text' value="<?php echo $alamat; ?>">
			<div class='pesanValidasi'></div>
		</div>
		<div class='form-group'>
			<label for='foto'>Foto</label>
			<input id='foto' name='foto' class='form-control' type='text' value="<?php echo $foto; ?>">
			<div class='pesanValidasi'></div>
		</div>
		<div class='form-group float-right'>
			<button type="submit" id='buttonEdit' class='btn btn-primary'>Edit</button>
			<input type="hidden" name="submitEditKaryawan" value="<?= $arr_url_karyawan; ?>">
			<button id='buttonBatal' class='btn btn-danger'>Batal</button>
		</div>
	</form>
	<script src=src_moduls/edit_karyawan.js></script>
	<script src="src_moduls/js_functions.js"></script>
</body>
</html>