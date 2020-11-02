<?php 

$conn 	= mysqli_connect("localhost","root","","tugas_inventaris");

$kode_karyawan 	=  "00000001";
$result 		= "SELECT * FROM tb_barang_inventaris_karyawan WHERE kode_karyawan='$kode_karyawan' LIMIT 5;";
$query 			= mysqli_query($conn, $result);
while ($data = mysqli_fetch_assoc($query)) {
	echo "<pre>";
	var_dump($data);
	echo "</pre>";
}

?>