<?php  
$conn 	= mysqli_connect("localhost","root","","tugas_inventaris");
require_once 'php_functions.php';


if (isset($_POST['showTabelDataBarang'])) {
	$result 	= "SELECT * FROM tb_barang ORDER BY nama_barang ASC LIMIT 5;"; 
	tabel_barang($result, "tb_barang");	
}

if (isset($_POST["tabelBarangInvKaryawan"])) {
	$kode_karyawan 	=  $_POST["tabelBarangInvKaryawan"];
	$result 				= "SELECT * FROM tb_barang_inventaris_karyawan WHERE kode_karyawan='$kode_karyawan';";
	tabel_barang($result, "tb_barang_inventaris_karyawan");
}

// Search karyawan	
echo searchTabel("searchBarang", "tb_barang_inventaris_karyawan", "nama_barang", "tabel_barang", "User Tidak Ditemukan");


?>