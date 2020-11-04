<?php 

$conn 	= mysqli_connect("localhost","root","","tugas_inventaris");

function kontol() {
	global $kontol;
	$kontol = "kontol";
}
kontol();
echo $kontol;
?>