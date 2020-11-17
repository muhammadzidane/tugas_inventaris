<?php
session_start();
require_once 'files_backend_ajax/php_functions.php';
cek_session();

// Mengambil value dari database untuk mengisi tag <input> value 
$url_kode_barang 	= (isset($_GET['kode-barang'])) ? $_GET['kode-barang'] : "";
$url_nama_barang 	= (isset($_GET['nama-barang'])) ? $_GET['nama-barang'] : "";
$result 				= "SELECT * FROM tb_barang WHERE kode_barang='$url_kode_barang';";
$query 				= mysqli_query($conn, $result);

while ($data = mysqli_fetch_assoc($query)) {
	$jenis_barang 		= $data['jenis_barang'];
	$nama_barang 		= $data['nama_barang'];
	$kondisi_barang	= $data['kondisi_barang'];
	$harga_satuan 		= $data['harga_satuan'];
	$jumlah_barang 	= $data['jumlah_barang'];
	$foto_barang 		= $data['foto_barang'];
}

$result 				= "SELECT * FROM tb_barang_masuk WHERE kode_barang='$url_kode_barang';";
$query 				= mysqli_query($conn, $result);
$data 				= mysqli_fetch_assoc($query);
$tanggal_masuk 	= $data['tanggal_masuk'];

$arr_url_barang = array($url_kode_barang, $url_nama_barang);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Edit Barang</title>
	<link href='https://fonts.googleapis.com/css?family=Bebas Neue' rel='stylesheet'>
	<link rel="stylesheet" type="text/css" href="global_css.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/fontawesome-5.13.1/css/all.min.css">
	<script type="text/javascript" src="bootstrap/js/jquery.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
</head>
<body>
	<form id='form' action="files_backend_ajax/backend_data_barang.php" method="POST">
		<div class='header-form font-neue'><h3>Edit Barang</h3></div>
		<a href="data_barang.php"><div id="closeForm">&times;</div></a>
		<div class='form-group'>
			<label for='kodeBarang'>Kode Barang</label>
			<input id='kodeBarang' name='kodeBarang' class='form-control' type='text' value="<?php echo $url_kode_barang; ?>">
			<div class='pesanValidasi'></div>
		</div>
		<div class='form-group'>
			<label for='jenisBarang'>Jenis Barang</label>
			<select  id='jenisBarang' name='jenisBarang' class='form-control'>
				<option disabled>-Jenis Barang-</option>				
				<?php 
				$arr_jenis_barang = array("Elektronik", "Alat Tulis", "Kendaraan", "Lainnya");

				$result 				= "SELECT * FROM tb_barang WHERE kode_barang='$url_kode_barang';";
				$query 				= mysqli_query($conn, $result);

				$data 				= mysqli_fetch_assoc($query);
				$jenis_barang 		= $data["jenis_barang"];
				$kode_barang 		= $data["kode_barang"];

				foreach ($arr_jenis_barang as $key => $value) {
					if ($jenis_barang == $value) {
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
			<label for='namaBarang'>Nama Barang</label>
			<input id='namaBarang' name='namaBarang' class='form-control' type='text' value="<?php echo $nama_barang; ?>">
			<div class='pesanValidasi'></div>
		</div>
		<div class='form-group'>
			<label for='kondisiBarang'>Kondisi Barang</label>
			<select id='kondisiBarang' name='kondisiBarang' class='form-control'>
				<option disabled>-Kondisi Barang-</option>	
				<?php 
					$arr_kondisi_barang 	= array("Baru", "Bekas");

					foreach ($arr_kondisi_barang as $key => $value) {
						if ($kondisi_barang == $value) {
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
			<label for='hargaSatuan'>Harga Satuan</label>
			<input id='hargaSatuan' name='hargaSatuan' class='form-control' type='text' value="<?php echo $harga_satuan; ?>">
			<div class='pesanValidasi'></div>
		</div>
		<div class='form-group'>
			<label for='jumlahBarang'>Jumlah Barang</label>
			<input id='jumlahBarang' name='jumlahBarang' class='form-control' type='text' value="<?php echo $jumlah_barang; ?>">
			<div class='pesanValidasi'></div>
		</div>
		<div class='form-group'>
			<label for='fotoBarang'>Foto Barang</label>
			<input id='fotoBarang' name='fotoBarang' class='form-control' type='text' value="<?php echo $foto_barang; ?>">
			<div class='pesanValidasi'></div>
		</div>
		<div class='form-group'>
			<label for='tanggalMasuk'>Tanggal Masuk</label>
			<input id='tanggalMasuk' name='tanggalMasuk' class='form-control' type='date' value="<?php echo $tanggal_masuk; ?>">
			<div class='pesanValidasi'></div>
		</div>
		<div class='form-group float-right'>
			<input type="submit" id='submitEditBarang' class='btn btn-primary' value="Edit">
			<input type="hidden" name="submitEditBarang" value="<?= implode('-', $arr_url_barang) ?>">
			<button id='buttonBatal' class='btn btn-danger'>Batal</button>
		</div>
	</form>
	<script src="src_moduls/edit_barang.js"></script>
	<script src="src_moduls/js_functions.js"></script>
</body>
</html>