<?php 

$conn 	= mysqli_connect("localhost","root","","tugas_inventaris");

require_once 'php_functions.php';

// Ambil values dari <input>
$val_url_kode_barang 	= (isset($_POST['valUrlKodeBarang'])) ? sql_protect($_POST['valUrlKodeBarang']) : '';
$val_url_nama_barang 	= (isset($_POST['valUrlNamaBarang'])) ? sql_protect($_POST['valUrlNamaBarang']) : '';
$val_kode_barang 			= (isset($_POST['valKodeBarang'])) ? sql_protect($_POST['valKodeBarang']) : '';
$val_jenis_barang 		= (isset($_POST['valJenisBarang'])) ? sql_protect($_POST['valJenisBarang']) : '';
$val_nama_barang	 		= (isset($_POST['valNamaBarang'])) ? sql_protect(ucwords($_POST['valNamaBarang'])) : '';
$val_kondisi_barang 		= (isset($_POST['valKondisiBarang'])) ? sql_protect($_POST['valKondisiBarang']) : '';
$val_jumlah_barang 		= (isset($_POST['valJumlahBarang'])) ? sql_protect($_POST['valJumlahBarang']) : '';
$val_harga_satuan 		= (isset($_POST['valHargaSatuan'])) ? sql_protect($_POST['valHargaSatuan']) : '';
$val_foto_barang 			= (isset($_POST['valFotoBarang'])) ? sql_protect(strtolower($_POST['valFotoBarang'])) : '';
$val_tanggal_masuk 		= (isset($_POST['valTanggalMasuk'])) ? sql_protect($_POST['valTanggalMasuk']) : '';
$val_total_harga 			= (int) $val_harga_satuan * (int) $val_jumlah_barang;

// Muncul tabel saat Load pertama kali  
if (isset($_POST['tabelBarangKeluar'])) {
	$result 	= "SELECT * FROM tb_barang_keluar ORDER BY tanggal_keluar DESC LIMIT 10;"; 
	tabel_barang($result,"tb_barang_keluar");	
}

// Search tabel barang
echo searchTabel("searchTabelBarangKeluar", "tb_barang_keluar", "nama_barang", "tabel_barang", "Nama Barang Tidak Ditemukan", null);

// Pagination tabel barang
echo pagination_links("paginationTabelBarangKeluar","tb_barang_keluar");
echo page_click("pageListTabelBarangKeluar", "tb_barang_keluar", "nama_barang", "tabel_barang");
echo page_next("pageNext", "tb_barang_keluar", "nama_barang", "tabel_barang");

// Filter barang barang
echo filter_barang('filterSemua',"tb_barang_keluar" ,"Semua");
echo filter_barang('filterElektronik',"tb_barang_keluar" ,"Elektronik");
echo filter_barang('filterKendaraan',"tb_barang_keluar" ,"Kendaraan");
echo filter_barang('filterAlatTulis',"tb_barang_keluar" ,"Alat Tulis");
echo filter_barang('filterLainnya',"tb_barang_keluar" ,"Lainnya");


?>