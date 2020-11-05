<?php 

$conn 	= mysqli_connect("localhost","root","","tugas_inventaris");
$result 				 = "";
$result	 				.= "UPDATE tb_barang SET ";
$result 					.= "jumlah_barang = 'hasil_jumlah_barang',";
$result 					.= "total_harga = 'total_harga_tb_barang'";
$result 					.= "WHERE kode_barang = 'kode_barang';";

$result 					.= "INSERT INTO tb_barang_keluar VALUES(";
$result 					.= "'kode_karyawan',";
$result 					.= "'nama_karyawan',";
$result 					.= "'kode_barang',";
$result 					.= "'jenis_barang',";
$result 					.= "'nama_barang',";
$result 					.= "'kondisi_barang',";
$result 					.= "'val_jumlah_barang',";
$result 					.= "'harga_satuan',";
$result 					.= "'total_harga_tb_b_keluar',";
$result 					.= "'foto_barang',";
$result 					.= "'2020-11-04'";
$result 					.= ");";
$queryTambahBarang 	 		 = $result;

$result 				 = "";
$result	 				.= "UPDATE tb_barang_inventaris_karyawan SET ";
$result 					.= "jumlah_barang = 'jumlah_barang',";
$result 					.= "total_harga = 'total_harga'";
$result 					.= "WHERE kode_barang = 'kode_barang';";
$result 					.= $queryTambahBarang;

var_dump($result);
?>