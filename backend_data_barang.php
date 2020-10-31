<?php 

$conn 	= mysqli_connect("localhost","root","","tugas_inventaris");

require_once 'php_functions.php';

// Ambil values dari <input>
$val_url_kode_barang 	= (isset($_POST['valUrlKodeBarang'])) ? sql_protect($_POST['valUrlKodeBarang']) : '';
$val_url_nama_barang 	= (isset($_POST['valUrlNamaBarang'])) ? sql_protect($_POST['valUrlNamaBarang']) : '';
$val_kode_barang 		= (isset($_POST['valKodeBarang'])) ? sql_protect($_POST['valKodeBarang']) : '';
$val_jenis_barang 		= (isset($_POST['valJenisBarang'])) ? sql_protect($_POST['valJenisBarang']) : '';
$val_nama_barang	 	= (isset($_POST['valNamaBarang'])) ? sql_protect(ucwords($_POST['valNamaBarang'])) : '';
$val_kondisi_barang 	= (isset($_POST['valKondisiBarang'])) ? sql_protect($_POST['valKondisiBarang']) : '';
$val_jumlah_barang 		= (isset($_POST['valJumlahBarang'])) ? sql_protect($_POST['valJumlahBarang']) : '';
$val_harga_satuan 		= (isset($_POST['valHargaSatuan'])) ? sql_protect($_POST['valHargaSatuan']) : '';
$val_foto_barang 		= (isset($_POST['valFotoBarang'])) ? sql_protect(strtolower($_POST['valFotoBarang'])) : '';
$val_tanggal_masuk 		= (isset($_POST['valTanggalMasuk'])) ? sql_protect($_POST['valTanggalMasuk']) : '';
$val_total_harga 		= (int) $val_harga_satuan * (int) $val_jumlah_barang;

// Muncul tabel saat Load pertama kali  
if (isset($_POST['tabelBarang'])) {
	$result 	= "SELECT * FROM tb_barang ORDER BY nama_barang ASC LIMIT 5;"; 
	tabel_barang($result, "tb_barang");	
}

// Total barang barang
$jumlah_semua_barang 		= (isset($_POST['totalSemuaBarang'])) ? jumlah_barang("semua") : '';
$jumlah_barang_elektronik 	= (isset($_POST['totalBarangElektronik'])) ? jumlah_barang("Elektronik") : '';
$jumlah_barang_alat_tulis 	= (isset($_POST['totalBarangAlatTulis'])) ? jumlah_barang("Alat Tulis") : '';
$jumlah_barang_kendaraan 	= (isset($_POST['totalBarangKendaraan'])) ? jumlah_barang("Kendaraan") : '';
$jumlah_barang_lainnya 		= (isset($_POST['totalBarangLainnya'])) ? jumlah_barang("Lainnya") : '';

echo $jumlah_semua_barang;
echo $jumlah_barang_elektronik;
echo $jumlah_barang_alat_tulis;
echo $jumlah_barang_kendaraan;
echo $jumlah_barang_lainnya;

if (isset($_POST["totalPengeluaran"])) {
	$result 			= "SELECT * FROM tb_barang;";
	$query 				= mysqli_query($conn, $result);
	$total_pengeluaran 	= (int) "";
	
	while ($data = mysqli_fetch_assoc($query)) {
		$total_pengeluaran += $data["total_harga"];
	}

	echo "Rp " . number_format($total_pengeluaran,0,".",".") . ",-";
}

// Validasi duplikat key 
echo validasi_duplikat_key("validasiDuplikatKey","tb_barang","kode_barang");
echo validasi_duplikat_key_get("validasiDuplikatKeyGet", "getKodeBarang", "tb_barang", "kode_barang");

// Insert data barang
if (isset($_POST['acceptTambahBarang'])) {
	$result 	 	 = "";
	$result 		.= "INSERT INTO tb_barang VALUES(";
	$result 		.= "'$val_kode_barang',";
	$result 		.= "'$val_jenis_barang',";
	$result 		.= "'$val_nama_barang',";
	$result 		.= "'$val_kondisi_barang',";
	$result 		.= "'$val_jumlah_barang',";
	$result 		.= "'$val_harga_satuan',";
	$result 		.= "'$val_total_harga',";
	$result 		.= "'$val_foto_barang'";
	$result 		.= ");";

	$result 		.= "INSERT INTO tb_barang_masuk VALUES(";
	$result 		.= "'$val_kode_barang',";
	$result 		.= "'$val_jenis_barang',";
	$result 		.= "'$val_nama_barang',";
	$result 		.= "'$val_kondisi_barang',";
	$result 		.= "'$val_jumlah_barang',";
	$result 		.= "'$val_harga_satuan',";
	$result 		.= "'$val_total_harga',";
	$result 		.= "'$val_foto_barang',";
	$result 		.= "'$val_tanggal_masuk'";
	$result 		.= ");";

	$query 		 = mysqli_multi_query($conn, $result);
	if ($query) {
		echo "$val_nama_barang berhasil di tambahkan";
	}
	else {
		echo mysqli_error($conn);
	}
}

// Update barang
if (isset($_POST['updateBarang'])) {
	$result 		 = "";
	$result 		.= "UPDATE tb_barang SET ";
	$result 		.= "kode_barang = '$val_kode_barang',";
	$result 		.= "jenis_barang = '$val_jenis_barang',";
	$result 		.= "nama_barang = '$val_nama_barang',";
	$result 		.= "kondisi_barang = '$val_kondisi_barang',";
	$result 		.= "jumlah_barang = '$val_jumlah_barang',";
	$result 		.= "harga_satuan = '$val_harga_satuan',";
	$result 		.= "total_harga = '$val_total_harga',";
	$result 		.= "foto_barang = '$val_foto_barang'";
	$result 		.= "WHERE kode_barang = '$val_url_kode_barang';";

	$result 		.= "UPDATE tb_barang_masuk SET ";
	$result 		.= "kode_barang = '$val_kode_barang',";
	$result 		.= "jenis_barang = '$val_jenis_barang',";
	$result 		.= "nama_barang = '$val_nama_barang',";
	$result 		.= "kondisi_barang = '$val_kondisi_barang',";
	$result 		.= "jumlah_barang = '$val_jumlah_barang',";
	$result 		.= "harga_satuan = '$val_harga_satuan',";
	$result 		.= "total_harga = '$val_total_harga',";
	$result 		.= "foto_barang = '$val_foto_barang',";
	$result 		.= "tanggal_masuk = '$val_tanggal_masuk'";
	$result 		.= "WHERE kode_barang = '$val_url_kode_barang';";

	$query 			 = mysqli_multi_query($conn, $result);
	if ($query) {
		echo "$val_url_nama_barang berhasil di ubah";
	}
	else {
		echo mysqli_error($conn);
	}
}

// Search tabel barang
echo searchTabel("searchBarang", "tb_barang", "nama_barang", "tabel_barang", "Nama Barang Tidak Ditemukan");

// Hapus barang
if (isset($_POST['hapusBarang'])) {
	echo query_hapus("hapusBarang", "tb_barang", "kode_barang", "nama_barang");
}

// Pagination tabel barang
echo pagination_links("paginationTabelBarang","tb_barang");
echo page_click("pageListTabelBarang", "tb_barang", "nama_barang", "tabel_barang");
echo page_next("pageNext", "tb_barang", "nama_barang", "tabel_barang");

// Filter barang barang
echo filter_barang('filterSemua', "tb_barang","Semua");
echo filter_barang('filterElektronik', "tb_barang","Elektronik");
echo filter_barang('filterKendaraan', "tb_barang","Kendaraan");
echo filter_barang('filterAlatTulis', "tb_barang","Alat Tulis");
echo filter_barang('filterLainnya', "tb_barang","Lainnya");

?>