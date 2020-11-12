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
	<div id='form'>
		<div class='header-form font-neue'><h3>Tambahkan Barang Baru</h3></div>
		<div id="closeForm">&times;</div>
		<div class='form-group'>
			<label for='kode_barang'>Kode Barang</label>
			<input id='kode_barang' class='form-control' type='text'>
			<div class='pesanTambahBarang'></div>
		</div>
		<div class='form-group'>
			<label for='jenis_barang'>Jenis Barang</label>
			<select id='jenis_barang' class='form-control'>
				<option disabled>-Jenis Barang-</option>
				<option>Elektronik</option>
				<option>Alat Tulis</option>
				<option>Kendaraan</option>
				<option>Lainnya</option>
			</select>
		</div>
		<div class='form-group'>
			<label for='nama_barang'>Nama Barang</label>
			<input id='nama_barang' class='form-control' type='text'>
			<div class='pesanTambahBarang'></div>
		</div>
		<div class='form-group'>
			<label for='kondisi_barang'>Kondisi Barang</label>
			<select id='kondisi_barang' class='form-control'>
				<option disabled>-Kondisi Barang-</option>
				<option>Baru</option>
				<option>Bekas</option>
			</select>
		</div>
		<div class='form-group'>
			<label for='jumlah_barang'>Jumlah Barang</label>
			<input id='jumlah_barang' class='form-control' type='text'>
			<div class='pesanTambahBarang'></div>
		</div>
		<div class='form-group'>
			<label for='harga_satuan'>Harga Satuan</label>
			<input id='harga_satuan' class='form-control' type='text'>
			<div class='pesanTambahBarang'></div>
		</div>
		<div class='form-group'>
			<label for='foto_barang'>Foto Barang</label>
			<input id='foto_barang' class='form-control' type='text'>
			<div class='pesanTambahBarang'></div>
		</div>
		<div class='form-group'>
			<label for='tanggal_masuk'>Tanggal Masuk</label>
			<input id='tanggal_masuk' class='form-control' type='date'>
			<div class='pesanTambahBarang'></div>
		</div>
		<div class='form-group float-right'>
			<button id='acceptTambahBarang' class='btn btn-primary'>Tambah</button>
			<button id='batalTambahBarang' class='btn btn-danger'>Batal</button>
		</div>
	</div>
	<script src="src_moduls/tambah_barang.js"></script>
	<script src="src_moduls/js_functions.js"></script>
</body>
</html>