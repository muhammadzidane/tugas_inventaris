<?php 
$conn 			= mysqli_connect("localhost","root","","tugas_inventaris");

require_once 'php_functions.php';

// Mengambil value dari database untuk mengisi tag <input> value 
$url_kode_barang 	= (isset($_GET['kode-barang'])) ? $_GET['kode-barang'] : "";
$url_nama_barang 	= (isset($_GET['nama-barang'])) ? $_GET['nama-barang'] : "";
$result 			= "SELECT * FROM tb_barang WHERE kode_barang='$url_kode_barang';";
$query 			= mysqli_query($conn, $result);

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

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Edit Barang</title>
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
			height: 980px;
			margin: 55px auto;
		}
		.header-form {
			text-align: center;
			color: #FFFFFF;
			background-color: #24305E;
			padding: 28px;
		}
		.pesanEditBarang {
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
		<div class='header-form font-neue'><h3>Edit Barang</h3></div>
		<div id="closeForm">&times;</div>
		<div class='form-group'>
			<label for='kode_barang'>Kode Barang</label>
			<input id='kode_barang' class='form-control' type='text' value="<?php echo $url_kode_barang; ?>">
			<div class='pesanEditBarang'></div>
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
			<input id='nama_barang' class='form-control' type='text' value="<?php echo $nama_barang; ?>">
			<div class='pesanEditBarang'></div>
		</div>
		<div class='form-group'>
			<label for='kondisi_barang'>Kondisi Barang</label>
			<select id='kondisi_barang' class='form-control' value="<?php echo $kondisi_barang; ?>">
				<option disabled>-Kondisi Barang-</option>
				<option>Baru</option>
				<option>Bekas</option>
			</select>
		</div>
		<div class='form-group'>
			<label for='harga_satuan'>Harga Satuan</label>
			<input id='harga_satuan' class='form-control' type='text' value="<?php echo $harga_satuan; ?>">
			<div class='pesanEditBarang'></div>
		</div>
		<div class='form-group'>
			<label for='jumlah_barang'>Jumlah Barang</label>
			<input id='jumlah_barang' class='form-control' type='text' value="<?php echo $jumlah_barang; ?>">
			<div class='pesanEditBarang'></div>
		</div>
		<div class='form-group'>
			<label for='foto_barang'>Foto Barang</label>
			<input id='foto_barang' class='form-control' type='text' value="<?php echo $foto_barang; ?>">
			<div class='pesanEditBarang'></div>
		</div>
		<div class='form-group'>
			<label for='tanggal_masuk'>Tanggal Masuk</label>
			<input id='tanggal_masuk' class='form-control' type='date' value="<?php echo $tanggal_masuk; ?>">
			<div class='pesanEditBarang'></div>
		</div>
		<div class='form-group float-right'>
			<button id='acceptEditBarang' class='btn btn-primary'>Edit</button>
			<button id='buttonBatalEdit' class='btn btn-danger'>Batal</button>
		</div>
	</div>
	<script>
		$(document).ready(function() {

			$("#jenis_barang").val("<?php echo $jenis_barang; ?>");
			$("#kondisi_barang").val("<?php echo $kondisi_barang; ?>");

			$("#acceptEditBarang").click(function(e) {
				let confirmTambahBarang = confirm("Apakah Anda Yakin Ingin Menambahkan Data Barang?");
				let valKodeBarang 		= $("#kode_barang").val();
				let valJenisBarang 		= $("#jenis_barang").val();
				let valNamaBarang 		= $("#nama_barang").val();
				let valMerkBarang			= $("#merk_barang").val();
				let valKondisiBarang 	= $("#kondisi_barang").val();
				let valHargaSatuan 		= $("#harga_satuan").val();
				let valJumlahBarang 		= $("#jumlah_barang").val();
				let valFotoBarang 		= $("#foto_barang").val();
				let valTanggalMasuk	 	= $("#tanggal_masuk").val();
				
				if (confirmTambahBarang) {
					validasiNomer(valKodeBarang, "#kode_barang", 8);
					validasiNomer(valHargaSatuan, "#harga_satuan", undefined);
					validasiNomer(valJumlahBarang, "#jumlah_barang", undefined);
					validasiKosong(valKodeBarang,"#kode_barang");
					validasiKosong(valJenisBarang, "#jenis_barang");
					validasiKosong(valNamaBarang, "#nama_barang");
					validasiKosong(valMerkBarang, "#merk_barang");
					validasiKosong(valKondisiBarang, "#kondisi_barang");
					validasiKosong(valHargaSatuan, "#harga_satuan");
					validasiKosong(valJumlahBarang, "#jumlah_barang");
					validasiKosong(valFotoBarang, "#foto_barang");
					validasiKosong(valTanggalMasuk, "#tanggal_masuk");

					if ($(".pesanEditBarang").text() == "") {
						$.ajax({
							url 	: "backend_data_barang.php",
							type 	: "POST",
							data 	: { validasiDuplikatKeyGet : valKodeBarang, getKodeBarang : "<?php echo $url_kode_barang; ?>"},
							success : function(responseText) {
								if (responseText == "berhasil") {
									$.post('backend_data_barang.php',{
										updateBarang 			: true, 
										valUrlKodeBarang 		: "<?php echo $url_kode_barang; ?>",
										valUrlNamaBarang 		: "<?php echo $url_nama_barang; ?>",
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
											location.assign(`data_barang.php?edit=${encodeURIComponent(responseText)}`);	
											console.log(responseText);	
										}
									);
								}
								else {
									console.log(responseText);
									e.preventDefault();
									$("#kode_barang").next().html(`<small>${ responseText }</small>`).addClass('pesanValidasi');
								}
							}					
						});
					}
				}
			});
			// Button Batalkan Tambah Barang
			$("#buttonBatalEdit").click(function() {
				location.replace("data_barang.php");
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