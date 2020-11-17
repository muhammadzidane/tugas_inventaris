<?php 

$conn 	= mysqli_connect("localhost","root","","tugas_inventaris");
require_once 'php_functions.php';

// Ambil values dari <input>
$val_kode_barang 			= (isset($_POST['kodeBarang'])) ? sql_protect($_POST['kodeBarang']) : '';
$val_jenis_barang 		= (isset($_POST['jenisBarang'])) ? sql_protect($_POST['jenisBarang']) : '';
$val_nama_barang	 		= (isset($_POST['namaBarang'])) ? sql_protect(ucwords($_POST['namaBarang'])) : '';
$val_kondisi_barang 		= (isset($_POST['kondisiBarang'])) ? sql_protect($_POST['kondisiBarang']) : '';
$val_jumlah_barang 		= (isset($_POST['jumlahBarang'])) ? sql_protect($_POST['jumlahBarang']) : '';
$val_harga_satuan 		= (isset($_POST['hargaSatuan'])) ? sql_protect($_POST['hargaSatuan']) : '';
$val_foto_barang 			= (isset($_POST['fotoBarang'])) ? sql_protect(strtolower($_POST['fotoBarang'])) : '';
$val_tanggal_masuk 		= (isset($_POST['tanggalMasuk'])) ? sql_protect($_POST['tanggalMasuk']) : '';
$val_total_harga 			= (int) $val_harga_satuan * (int) $val_jumlah_barang;

// Muncul tabel saat Load pertama kali  
if (isset($_POST['tabelBarang'])) {
	$result 	= "SELECT * FROM tb_barang ORDER BY nama_barang ASC LIMIT 10;"; 
	tabel_barang($result, "tb_barang");	
}

// Total barang barang 
echo jumlah_barang("totalSemuaBarang" ,"tb_barang", "semua");
echo jumlah_barang("totalBarangElektronik" ,"tb_barang", "Elektronik");
echo jumlah_barang("totalBarangAlatTulis" ,"tb_barang", "Alat Tulis");
echo jumlah_barang("totalBarangKendaraan" ,"tb_barang", "Kendaraan");
echo jumlah_barang("totalBarangLainnya" ,"tb_barang", "Lainnya");

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

if (isset($_POST["validasiDuplikatKeyEdit"])) {
	$kode_awal 	= $_POST["valAwalKode"];
	$kode 		= $_POST["validasiDuplikatKeyEdit"];
	$query 		= mysqli_query($conn, "SELECT * FROM tb_barang WHERE kode_barang='$kode';");

	if ($kode == $kode_awal) {
		$hasil = "berhasil";
	}
	else if (mysqli_affected_rows($conn) == 1) {
		$hasil = "Kode yang sama sudah digunakan, harap gunakan yang lain";
	}
	else {
		$hasil = "berhasil";
	}
	echo $hasil;
}

// Insert data barang
if (isset($_POST['submitTambahBarang'])) {
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
		header("Location: ../data_barang.php?berhasil_ditambah=$val_nama_barang berhasil di tambahkan");
	}
	else {
		echo mysqli_error($conn);
	}
}

// Tambah barang yang sama
if (isset($_POST["tambahBarangYangSama"])) {
	$kode_barang 					 = $_POST["tambahBarangYangSama"];
	$result 					 		 = "SELECT * FROM tb_barang WHERE kode_barang ='$kode_barang';";
	$query 						 	 = mysqli_query($conn, $result);
	$data 						 	 = mysqli_fetch_assoc($query);
	$jenis_barang 					 = $data["jenis_barang"];
	$nama_barang 					 = $data["nama_barang"];
	$kondisi_barang 				 = $data["kondisi_barang"];
	$jumlah_barang 				 = $data["jumlah_barang"];
	$harga_satuan 				 	 = $data["harga_satuan"];
	$total_harga 				 	 = $data["total_harga"];
	$foto_barang 					 = $data["foto_barang"];
	$val_jumlah_tambah_barang 	 = $_POST['valJumlah'];
	$val_tanggal_masuk 			 = $_POST['valTanggalMasuk'];

	$total_harga_baru 			 = $harga_satuan * $val_jumlah_tambah_barang;
	$total_harga_baru 			+= $total_harga;
	$jumlah_barang_baru 		 	 = $jumlah_barang + $val_jumlah_tambah_barang;
	$total_harga_tb_b_masuk 	 = $val_jumlah_tambah_barang * $harga_satuan;


	$result 		 = "";
	$result 		.= "UPDATE tb_barang SET ";
	$result 		.= "jumlah_barang = '$jumlah_barang_baru',";
	$result 		.= "total_harga = '$total_harga_baru'";
	$result 		.= "WHERE kode_barang = '$kode_barang';";

	$result 		.= "INSERT INTO tb_barang_masuk VALUES(";
	$result 		.= "'$kode_barang',";
	$result 		.= "'$jenis_barang',";
	$result 		.= "'$nama_barang',";
	$result 		.= "'$kondisi_barang',";
	$result 		.= "'$val_jumlah_tambah_barang',";
	$result 		.= "'$harga_satuan',";
	$result 		.= "'$total_harga_tb_b_masuk',";
	$result 		.= "'$foto_barang',";
	$result 		.= "'$val_tanggal_masuk'";
	$result 		.= ");";

	$query 			 = mysqli_multi_query($conn, $result);
	if ($query) {
		echo "$nama_barang berhasil di tambah";
	}
	else {
		echo mysqli_error($conn);
	}
}

// Update barang
if (isset($_POST['submitEditBarang'])) {
	$val_url_barang		= $_POST['submitEditBarang'];
	$val_url_barang 		= explode("-", $val_url_barang);
	
	$kode_awal_barang 	= $val_url_barang[0];
	$nama_awal_barang 	= $val_url_barang[1];

	$result 			 		= "SELECT * FROM tb_barang_inventaris_karyawan WHERE kode_barang = '$kode_awal_barang';";
	$query 				 	= mysqli_query($conn, $result);

	$result 		 			= "";

	while($data = mysqli_fetch_assoc($query)) {
		$kode_karyawan 	= $data["kode_karyawan"];
		$nama_karyawan 	= $data["nama_karyawan"];
		$jumlah_barang 	= $data["jumlah_barang"];
		$total_harga 		= $val_harga_satuan * $jumlah_barang;

		$result 		.= "UPDATE tb_barang_inventaris_karyawan SET ";
		$result 		.= "kode_barang = '$val_kode_barang',";
		$result 		.= "jenis_barang = '$val_jenis_barang',";
		$result 		.= "nama_barang = '$val_nama_barang',";
		$result 		.= "kondisi_barang = '$val_kondisi_barang',";
		$result 		.= "harga_satuan = '$val_harga_satuan',";
		$result 		.= "total_harga = '$total_harga',";
		$result 		.= "foto_barang = '$val_foto_barang'";
		$result 		.= "WHERE kode_karyawan = '$kode_karyawan' AND kode_barang = '$kode_awal_barang';";
	}
	
	$result 		.= "UPDATE tb_barang SET ";
	$result 		.= "kode_barang = '$val_kode_barang',";
	$result 		.= "jenis_barang = '$val_jenis_barang',";
	$result 		.= "nama_barang = '$val_nama_barang',";
	$result 		.= "kondisi_barang = '$val_kondisi_barang',";
	$result 		.= "jumlah_barang = '$val_jumlah_barang',";
	$result 		.= "harga_satuan = '$val_harga_satuan',";
	$result 		.= "total_harga = '$val_total_harga',";
	$result 		.= "foto_barang = '$val_foto_barang'";
	$result 		.= "WHERE kode_barang = '$kode_awal_barang';";

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
	$result 		.= "WHERE kode_barang = '$kode_awal_barang';";

	$result 		.= "UPDATE tb_barang_keluar SET ";
	$result 		.= "kode_barang = '$val_kode_barang',";
	$result 		.= "jenis_barang = '$val_jenis_barang',";
	$result 		.= "nama_barang = '$val_nama_barang',";
	$result 		.= "kondisi_barang = '$val_kondisi_barang',";
	$result 		.= "jumlah_barang = '$val_jumlah_barang',";
	$result 		.= "harga_satuan = '$val_harga_satuan',";
	$result 		.= "total_harga = '$val_total_harga',";
	$result 		.= "foto_barang = '$val_foto_barang'";
	$result 		.= "WHERE kode_barang = '$kode_awal_barang';";

	$query 		 = mysqli_multi_query($conn, $result);
	if ($query) {
		header("Location: ../data_barang.php?berhasil_diedit=$nama_awal_barang berhasil di ubah");
	}
	else {
		echo mysqli_error($conn);
	}
}

// Search tabel barang
echo searchTabel("searchTabelDataBarang", "tb_barang", "nama_barang", "tabel_barang", "Nama barang tidak ditemukan", null);

// Hapus barang
echo query_hapus("hapusBarang", "tb_barang", "kode_barang", "nama_barang");

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