<?php 
session_start();
require_once 'php_functions.php';

// Mengambil value-value dari <input>\
$kode_karyawan 		 	= (isset($_POST['kodeKaryawan'])) ? sql_protect($_POST['kodeKaryawan']) : ""; 
$nama_karyawan 		 	= (isset($_POST['namaKaryawan'])) ? sql_protect($_POST['namaKaryawan']) : ""; 
$posisi_jabatan 			= (isset($_POST['posisiJabatan'])) ? sql_protect($_POST['posisiJabatan']) : ""; 
$email 	 					= (isset($_POST['email'])) ? sql_protect($_POST['email']) : ""; 
$pendidikan_terakhir 	= (isset($_POST['pendidikanTerakhir'])) ? sql_protect($_POST['pendidikanTerakhir']) : ""; 
$alamat 		 				= (isset($_POST['alamat'])) ? sql_protect($_POST['alamat']) : ""; 
$foto 				 		= (isset($_POST['foto'])) ? sql_protect($_POST['foto']) : "";

// Tampilkan tabel karyawan saat load
if (isset($_POST['tabelKaryawan'])) {
	$result 	= "SELECT * FROM tb_karyawan ORDER BY nama_karyawan ASC LIMIT 10;";
	tabel_karyawan($result);
}

hidePageNext("tb_karyawan", null);

// Total Karyawan
if (isset($_POST['totalKaryawan'])) {
	$result 	= "SELECT * FROM tb_karyawan;";
	$query 		= mysqli_query($conn, $result);

	echo mysqli_affected_rows($conn);
}

// Validasi duplikat key Tambah Karyawan
echo validasi_duplikat_key("validasiDuplikatKey", "tb_karyawan", "kode_karyawan");

if (isset($_POST['validasiDuplikatKeyEdit'])) {
	$val_kode_awal_barang	= $_POST['valAwalKode'];
	$kode_karyawan 			= $_POST['validasiDuplikatKeyEdit'];
	$query 						= mysqli_query($conn, "SELECT * FROM tb_karyawan WHERE kode_karyawan='$kode_karyawan';");
	
	if ($val_kode_awal_barang == $kode_karyawan){
		echo "berhasil";
	}
	else if (mysqli_affected_rows($conn) == 1) {
		echo "Kode yang sama sudah digunakan, harap gunakan yang lain";
	}
	else if (mysqli_affected_rows($conn) != 1){
		echo "berhasil";
	}
}


// Edit karyawan
if (isset($_POST['submitEditKaryawan'])) {
	$arr_url_karyawan 	= $_POST['submitEditKaryawan'];
	$arr_url_karyawan 	= explode("-", $arr_url_karyawan);
	$kode_awal_karyawan 	= $arr_url_karyawan[0];
	$nama_awal_karyawan 	= $arr_url_karyawan[1];

	$result 	 	 	 = "";
	$result 			.= "UPDATE tb_karyawan SET ";
	$result 			.= "kode_karyawan = '$kode_karyawan',";
	$result 			.= "nama_karyawan = '$nama_karyawan',";
	$result 			.= "posisi_jabatan = '$posisi_jabatan',";
	$result 			.= "email = '$email',";
	$result 			.= "pendidikan_terakhir = '$pendidikan_terakhir',";
	$result 			.= "alamat = '$alamat',";
	$result 			.= "foto = '$foto'";
	$result 			.= "WHERE kode_karyawan = '$kode_awal_karyawan';";

	$result 			.= "UPDATE tb_barang_inventaris_karyawan SET ";
	$result 			.= "kode_karyawan = '$kode_karyawan',";
	$result 			.= "nama_karyawan = '$nama_karyawan'";
	$result 			.= "WHERE kode_karyawan = '$kode_awal_karyawan';";

	$result 			.= "UPDATE tb_barang_keluar SET ";
	$result 			.= "kode_karyawan = '$kode_karyawan',";
	$result 			.= "nama_karyawan = '$nama_karyawan'";
	$result 			.= "WHERE kode_karyawan = '$kode_awal_karyawan';";

	$query 			 = mysqli_multi_query($conn, $result);
	if ($query) {
		header("Location: ../daftar_pegawai.php?berhasil_diedit=$nama_awal_karyawan berhasil di ubah");
	}
	else {
		echo mysqli_error($conn);
	}
}

// Hapus karyawan
echo query_hapus("hapusKaryawan", "tb_karyawan", "kode_karyawan", "nama_karyawan");

// Tambah Karyawan 
if (isset($_POST['submitTambahKaryawan'])) {
	$result 	 = "";
	$result 	.= "INSERT INTO tb_karyawan VALUES(";
	$result 	.= "'$kode_karyawan',";
	$result 	.= "'$nama_karyawan',";
	$result 	.= "'$posisi_jabatan',";
	$result 	.= "'$email',";
	$result 	.= "'$pendidikan_terakhir',";
	$result 	.= "'$alamat',";
	$result 	.= "'$foto'";
	$result 	.= ");";

	$query 	 	 = mysqli_query($conn, $result);
	if ($query) {
		header("Location: ../daftar_pegawai.php?berhasil_ditambah=$nama_karyawan berhasil ditambahkan");
	}
}

// Search karyawan	
echo searchTabel("searchTabelKaryawan", "tb_karyawan", "nama_karyawan", "tabel_karyawan", "Nama karyawan tidak ditemukan", null);

// Pagination tabel karyawan
echo pagination_links("paginationTabelKaryawan","tb_karyawan");
echo page_click("pageListTabelKaryawan", "tb_karyawan", "nama_karyawan", "tabel_karyawan");
echo page_next("pageNext", "tb_karyawan", "nama_karyawan", "tabel_karyawan");
?>