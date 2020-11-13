<?php 
session_start();
$conn 		= mysqli_connect("localhost","root","","tugas_inventaris");

require_once 'php_functions.php';

// Mengambil value-value dari <input>
$url_kode_karyawan	 	= (isset($_POST['urlKodeKaryawan'])) ? $_POST['urlKodeKaryawan'] : ""; 
$url_nama_karyawan		= (isset($_POST['urlNamaKaryawan'])) ? $_POST['urlNamaKaryawan'] : ""; 
$kode_karyawan 		 	= (isset($_POST['kodeKaryawan'])) ? $_POST['kodeKaryawan'] : ""; 
$nama_karyawan 		 	= (isset($_POST['namaKaryawan'])) ? $_POST['namaKaryawan'] : ""; 
$posisi_jabatan 			= (isset($_POST['posisiJabatan'])) ? $_POST['posisiJabatan'] : ""; 
$email 	 					= (isset($_POST['email'])) ? $_POST['email'] : ""; 
$pendidikan_terakhir 	= (isset($_POST['pendidikanTerakhir'])) ? $_POST['pendidikanTerakhir'] : ""; 
$alamat 		 				= (isset($_POST['alamat'])) ? $_POST['alamat'] : ""; 
$foto 				 		= (isset($_POST['foto'])) ? $_POST['foto'] : "";

$kode_karyawan 		 	= htmlentities(strip_tags(trim($kode_karyawan))); 
$nama_karyawan 		 	= htmlentities(strip_tags(trim(ucwords($nama_karyawan))));
$email 	 			 		= htmlentities(strip_tags(trim(strtolower($email)))); 
$pendidikan_terakhir 	= htmlentities(strip_tags(trim(strtoupper($pendidikan_terakhir)))); 
$alamat 		 	 			= htmlentities(strip_tags(trim(ucwords($alamat)))); 
$foto 				 		= htmlentities(strip_tags(trim(strtolower($foto))));

// Tampilkan tabel karyawan saat load
if (isset($_POST['tabelKaryawan'])) {
	$result 	= "SELECT * FROM tb_karyawan ORDER BY nama_karyawan ASC LIMIT 5;";
	tabel_karyawan($result);
}

// Total Karyawan
if (isset($_POST['totalKaryawan'])) {
	$result 	= "SELECT * FROM tb_karyawan;";
	$query 		= mysqli_query($conn, $result);

	echo mysqli_affected_rows($conn);
}


// Validasi duplikat key tambah
if (isset($_POST['validasiDuplikatKey'])) {
	$sess_kode_karyawan	= $_SESSION['kode_karyawan'];
	$kode_karyawan 		= $_POST['validasiDuplikatKey'];
	$query 					= mysqli_query($conn, "SELECT * FROM tb_karyawan WHERE kode_karyawan='$kode_karyawan';");
	
	if ($sess_kode_karyawan == $kode_karyawan){
		echo "berhasil";
		unset($_SESSION['kode_karyawan']);	
	}
	else if (mysqli_affected_rows($conn) == 1) {
		echo "Kode yang sama sudah digunakan, harap gunakan yang lain";
	}
	else if (mysqli_affected_rows($conn) != 1){
		echo "berhasil";
	}
}

// Validasi duplikat key Tambah Karyawan
echo validasi_duplikat_key("validasiDuplikatKeyTambahKaryawan", "tb_karyawan", "kode_karyawan");


// Edit karyawan
if (isset($_POST['acceptEdit'])) {
	$result 	 	 	 = "";
	$result 			.= "UPDATE tb_karyawan SET ";
	$result 			.= "kode_karyawan = '$kode_karyawan',";
	$result 			.= "nama_karyawan = '$nama_karyawan',";
	$result 			.= "posisi_jabatan = '$posisi_jabatan',";
	$result 			.= "email = '$email',";
	$result 			.= "pendidikan_terakhir = '$pendidikan_terakhir',";
	$result 			.= "alamat = '$alamat',";
	$result 			.= "foto = '$foto'";
	$result 			.= "WHERE kode_karyawan = '$url_kode_karyawan';";

	$result 			.= "UPDATE tb_barang_inventaris_karyawan SET ";
	$result 			.= "kode_karyawan = '$kode_karyawan',";
	$result 			.= "nama_karyawan = '$nama_karyawan'";
	$result 			.= "WHERE kode_karyawan = '$url_kode_karyawan';";

	$result 			.= "UPDATE tb_barang_keluar SET ";
	$result 			.= "kode_karyawan = '$kode_karyawan',";
	$result 			.= "nama_karyawan = '$nama_karyawan'";
	$result 			.= "WHERE kode_karyawan = '$url_kode_karyawan';";

	$query 			 = mysqli_multi_query($conn, $result);
	if ($query) {
		echo "$url_nama_karyawan berhasil di ubah";
	}
	else {
		echo mysqli_connect($conn);
	}
}

// Hapus karyawan
if (isset($_POST['hapusKaryawan'])) {
	echo query_hapus("hapusKaryawan", "tb_karyawan", "kode_karyawan", "nama_karyawan");
}

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
echo searchTabel("searchKaryawan", "tb_karyawan", "nama_karyawan", "tabel_karyawan", "User Tidak Ditemukan", null);

// Pagination tabel karyawan
echo pagination_links("paginationTabelKaryawan","tb_karyawan");
echo page_click("pageListTabelKaryawan", "tb_karyawan", "nama_karyawan", "tabel_karyawan");
echo page_next("pageNext", "tb_karyawan", "nama_karyawan", "tabel_karyawan");


// barang_inventaris_karyawan.php
// Validasi duplikat key tambah barang inventaris untuk karyawan
echo validasi_duplikat_key("validasiDuplikatKeyTambahInv", "tb_barang", "kode_barang");
?>