<?php  

	$url_kode_karyawan = (isset($_GET['kode_karyawan'])) ? $_GET['kode_karyawan'] : "";
	$url_nama_karyawan = (isset($_GET['nama_karyawan'])) ? $_GET['nama_karyawan'] : "";

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Tambah Barang</title>
	<link href='https://fonts.googleapis.com/css?family=Bebas Neue' rel='stylesheet'>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="fontawesome-5.13.1/css/all.min.css">
	<script type="text/javascript" src="bootstrap/js/jquery.js"></script>
	<script type="text/javascript" src="bootstrap/js/popper.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript src=jquery-com-3.5.1.js"></script>
	<style>
		/* Form Tambah Barang */
		#form-tambah-barang {
			background-color: #FFFFFF;
			box-shadow: 0 0 4px black;
			width: 550px;
			height: 1075px;
			margin: 55px auto;
		}
		.header-form {
			text-align: center;
			color: #FFFFFF;
			background-color: #24305E;
			padding: 28px;
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
			position: absolute;
			font-size: 13px;
			color: tomato;
		}
	</style>
</head>
<body>
	<div id='form-tambah-barang'>
		<div class='header-form font-neue'>
			<h3>Tambahkan Barang Inventaris</h3>
		</div>
		<div id="closeForm">&times;</div>
		<div class='form-group'>
			<label for='kode_karyawan'>Kode Karyawan</label>
			<input id='kode_karyawan' class='form-control' type='text' value="<?= $url_kode_karyawan ?>" readonly>
		</div>
		<div class='form-group'>
			<label for='nama_karyawan'>Nama Karyawan</label>
			<input id='nama_karyawan' class='form-control' type='text' value="<?= $url_nama_karyawan ?>" readonly>
		</div>
		<div class='form-group'>
			<label for='kode_barang'>Kode Barang</label>
			<input id='kode_barang' class='form-control' type='text'>
			<div class='pesanValidasi'></div>
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
			<div class='pesanValidasi'></div>
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
			<label for='harga_satuan'>Harga Satuan</label>
			<input id='harga_satuan' class='form-control' type='text'>
			<div class='pesanValidasi'></div>
		</div>
		<div class='form-group'>
			<label for='jumlah_barang'>Jumlah Barang</label>
			<input id='jumlah_barang' class='form-control' type='text'>
			<div class='pesanValidasi'></div>
		</div>
		<div class='form-group'>
			<label for='foto_barang'>Foto Barang</label>
			<input id='foto_barang' class='form-control' type='text'>
			<div class='pesanValidasi'></div>
		</div>
		<div class='form-group float-right'>
			<button id='acceptTambahBarang' class='btn btn-primary'>Tambah</button>
			<button id='batalTambahBarang' class='btn btn-danger'>Batal</button>
		</div>
	</div>
	<script>
		$("#acceptTambahBarang").click(function(e) {
			let confirmTambahBarang = confirm("Apakah Anda Yakin Ingin Menambahkan Data Barang?");
			if (confirmTambahBarang) {
				let valKodeBarang 		= $("#kode_barang").val();
				let valJenisBarang 		= $("#jenis_barang").val();
				let valNamaBarang 		= $("#nama_barang").val();
				let valMerkBarang			= $("#merk_barang").val();
				let valKondisiBarang 	= $("#kondisi_barang").val();
				let valHargaSatuan 		= $("#harga_satuan").val();
				let valJumlahBarang 		= $("#jumlah_barang").val();
				let valFotoBarang 		= $("#foto_barang").val();
				let valTanggalMasuk 		= $("#tanggal_masuk").val();	

				validasiNomer(valKodeBarang, "#kode_barang", 8);
				validasiNomer(valHargaSatuan, "#harga_satuan", undefined);
				validasiNomer(valJumlahBarang, "#jumlah_barang", undefined);

				validasiKosong(valKodeBarang,"#kode_barang");
				validasiKosong(valJenisBarang, "#jenis_barang");
				validasiKosong(valNamaBarang, "#nama_barang");
				validasiKosong(valKondisiBarang, "#kondisi_barang");
				validasiKosong(valJumlahBarang, "#jumlah_barang");
				validasiKosong(valHargaSatuan, "#harga_satuan");
				validasiKosong(valFotoBarang, "#foto_barang");

				if ($(".pesanValidasi").text() == "") {
					$.ajax({
						url 	: "backend_tambah_barang_inventaris.php",
						type 	: "POST",
						data 	: { validasiDuplikatKeyTambahInv : valKodeBarang },
						success : function(responseText) {
							if (responseText === "berhasil") {
								$.post('backend_daftar_karyawan.php',{ 
									acceptTambahBarang 	: true,
									urlKodeKaryawan		: "<?= $url_kode_karyawan; ?>",
									urlNamaKaryawan		: "<?= $url_nama_karyawan;?>",
									valKodeBarang 			: valKodeBarang,
									valJenisBarang 		: valJenisBarang,
									valNamaBarang 			: valNamaBarang,
									valMerkBarang 			: valMerkBarang,
									valKondisiBarang 		: valKondisiBarang,
									valHargaSatuan 		: valHargaSatuan,
									valJumlahBarang 		: valJumlahBarang,
									valFotoBarang 			: valFotoBarang,
									valTanggalMasuk 		: valTanggalMasuk }, 
									function(responseText) {
										console.log(responseText);
										history.back();		
									}
								);
							}
							else {
								$("#kode_barang").next().html(`<small>${ responseText }</small>`).addClass('pesanValidasi');
							}
						}
					});
				}
				else {
					e.preventDefault();
				}
			}

		});


		// Button Batalkan Tambah Barang
		$("#batalTambahBarang").click(function() {
			location.replace("data_barang.php");
		});

		// Button Batalkan Tambah Barang (Simbol Close)
		$("#closeForm").click(function() {
			$("#batalTambahBarang").click();
		});
	</script>
	<script src="jquery_functions/js_functions.js"></script>
</body>
</html>