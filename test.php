<?php 

$conn 	 			 = mysqli_connect("localhost","root","","tugas_inventaris");
$result 				 = "";
$result 				.= "SELECT * FROM tb_barang_inventaris_karyawan WHERE kode_barang = '00003801';";
$query 				 = mysqli_query($conn, $result);

$result 		 = "";
while ($data = mysqli_fetch_assoc($query)) {
	$result 		.= "UPDATE tb_barang_inventaris_karyawan SET ";
	$result 		.= "kode_barang = 'val_kode_barang',";
	$result 		.= "jenis_barang = 'val_jenis_barang',";
	$result 		.= "nama_barang = 'val_nama_barang',";
	$result 		.= "kondisi_barang = 'val_kondisi_barang',";
	$result 		.= "harga_satuan = 'val_harga_satuan',";
	$result 		.= "total_harga = 'total_harga',";
	$result 		.= "foto_barang = 'val_foto_barang'";
	$result 		.= "WHERE kode_karyawan = 'kode_karyawan' AND kode_barang = 'val_url_kode_barang';";
}

echo "<pre>";
var_dump($result);
echo "</pre>";
?>