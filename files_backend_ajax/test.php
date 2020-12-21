<?php  
$conn 		= mysqli_connect("localhost","root","","tugas_inventaris");	
$result 	= "SELECT * FROM tb_barang_keluar;";
$query 		= mysqli_query($conn, $result);

$counter 	= 2;
for ($i=10; $i <= mysqli_affected_rows($conn) ; $i+=10) {
	echo $i;
}
?>