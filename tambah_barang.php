<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Tambah Barang</title>
	<link href='https://fonts.googleapis.com/css?family=Bebas Neue' rel='stylesheet'>
	<link rel="stylesheet" type="text/css" href="global_css.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/fontawesome-5.13.1/css/all.min.css">
	<script type="text/javascript" src="bootstrap/js/jquery.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
</head>
<body>
	<form id='form' action="files_backend_ajax/backend_data_barang.php" method="POST">
		<div class='header-form font-neue'><h3>Tambahkan Barang Baru</h3></div>
		<a href="data_barang.php"><div id="closeForm">&times;</div></a>
		<div class='form-group'>
			<label for='kodeBarang'>Kode Barang</label>
			<input id='kodeBarang' name='kodeBarang' class='form-control' type='text'>
			<div class='pesanValidasi'></div>
		</div>
		<div class='form-group'>
			<label for='jenisBarang'>Jenis Barang</label>
			<select id='jenisBarang' name='jenisBarang' class='form-control'>
				<option disabled>-Jenis Barang-</option>
				<option>Elektronik</option>
				<option>Alat Tulis</option>
				<option>Kendaraan</option>
				<option>Lainnya</option>
			</select>
		</div>
		<div class='form-group'>
			<label for='namaBarang'>Nama Barang</label>
			<input id='namaBarang' name='namaBarang' class='form-control' type='text'>
			<div class='pesanValidasi'></div>
		</div>
		<div class='form-group'>
			<label for='kondisiBarang'>Kondisi Barang</label>
			<select id='kondisiBarang' name='kondisiBarang' class='form-control'>
				<option disabled>-Kondisi Barang-</option>
				<option>Baru</option>
				<option>Bekas</option>
			</select>
		</div>
		<div class='form-group'>
			<label for='jumlahBarang'>Jumlah Barang</label>
			<input id='jumlahBarang' name='jumlahBarang' class='form-control' type='text'>
			<div class='pesanValidasi'></div>
		</div>
		<div class='form-group'>
			<label for='hargaSatuan'>Harga Satuan</label>
			<input id='hargaSatuan' name='hargaSatuan' class='form-control' type='text'>
			<div class='pesanValidasi'></div>
		</div>
		<div class='form-group'>
			<label for='fotoBarang'>Foto Barang</label>
			<input id='fotoBarang' name='fotoBarang' class='form-control' type='text'>
			<div class='pesanValidasi'></div>
		</div>
		<div class='form-group'>
			<label for='tanggalMasuk'>Tanggal Masuk</label>
			<input id='tanggalMasuk' name='tanggalMasuk' class='form-control' type='date'>
			<div class='pesanValidasi'></div>
		</div>
		<div class='form-group float-right'>
			<button id='acceptTambahBarang' class='btn btn-primary'>Tambah</button>
			<input type="hidden" name="submitTambahBarang">
			<button id='buttonBatal' class='btn btn-danger'>Batal</button>
		</div>
	</form>
	<script src="src_moduls/tambah_barang.js"></script>
	<script src="src_moduls/js_functions.js"></script>
</body>
</html>