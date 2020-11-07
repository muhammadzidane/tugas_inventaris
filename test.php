<?php 

$conn 	 			 = mysqli_connect("localhost","root","","tugas_inventaris");
$result 				 = "";

$val_kode_barang = "kontol";
function queryUpdateBarang($tabelDB) {
	global $result;
	$result 		.= "UPDATE $tabelDB SET ";
	$result 		.= "kode_barang = '$val_kode_barang',";
	$result 		.= "jenis_barang = 'val_jenis_barang',";
	$result 		.= "nama_barang = 'val_nama_barang',";
	$result 		.= "kondisi_barang = 'val_kondisi_barang',";
	$result 		.= "harga_satuan = 'val_harga_satuan',";
	$result 		.= "total_harga = 'total_harga',";

	if ($tabelDB == "tb_barang_masuk") {
		$result 		.= "foto_barang = 'val_foto_barang',";
		$result 		.= "tanggal_masuk = 'val_tanggal_masuk'";
	}
	else {
		$result 		.= "foto_barang = 'val_foto_barang'";
	}
	$result 		.= "WHERE kode_karyawan = 'kode_karyawan' AND kode_barang = 'val_url_kode_barang';";
}
queryUpdateBarang("tb_barang_masuk");
// queryUpdateBarang("tb_barang_masuk");
var_dump($result);

// echo "<pre>";
// var_dump($result);
// echo "</pre>";
?>