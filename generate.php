<?php 
	$conn 		= mysqli_connect("localhost","root","","daftar_inventaris");
	$result 	= "INSERT INTO tb_karyawan VALUES ('00000002', 'Angga Muhammad Saefulloh', 'HRD', 'angga@gmail.com', '081938187182', 'jl.kentut', 'SMK', 'angga.jpg'), ('00000003', 'Erlangga', 'Akutansi', 'erlangga@gmail.com', '089578261928', 'Jl. Jembut', 'S1 Akutansi', 'erlangga.jpg');";
	$query 		= mysqli_query($conn,$result);
	if (!$query) {
	 	echo "GAGAL";
	}else {
		echo "BERHASIL";
	} 

?>