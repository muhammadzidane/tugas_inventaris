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

if (isset($_POST["queryTambahBarang"])) {
	$kode_barang 	 	 	 = $_POST["queryTambahBarang"];
	$kode_karyawan 		 = $_POST["kodeKaryawan"];
	$nama_karyawan 		 = $_POST["namaKaryawan"];
	$val_jumlah_barang 	 = $_POST["valJumlahBarang"];
	$jumlah_awal_barang 	 =	$_POST["jumlahAwalBarang"];
	$hasil_jumlah_barang  = (int) $jumlah_awal_barang - (int) $val_jumlah_barang;

	$result 	= "SELECT * FROM tb_barang WHERE kode_barang = '$kode_barang';";
	$query 	= mysqli_query($conn, $result);
	$data = mysqli_fetch_assoc($query);
	$jenis_barang 				 = $data["jenis_barang"];
	$nama_barang 			  	 = $data["nama_barang"];
	$kondisi_barang 		 	 = $data["kondisi_barang"];
	$harga_satuan 				 = $data["harga_satuan"];
	$hasil_harga_satuan 	 	 = $data["harga_satuan"];
	$hasil_harga_satuan  	*= $hasil_jumlah_barang;
	$total_harga_tb_barang 	 = $hasil_harga_satuan;
	$foto_barang 			 	 = $data["foto_barang"];
	$total_harga_tb_b_keluar = $val_jumlah_barang * $harga_satuan;

	function queryTambahBarang() {
		global $conn;

		$kode_barang 	 	 	 = $_POST["queryTambahBarang"];
		$kode_karyawan 		 = $_POST["kodeKaryawan"];
		$nama_karyawan 		 = $_POST["namaKaryawan"];
		$val_jumlah_barang 	 = $_POST["valJumlahBarang"];
		$jumlah_awal_barang 	 =	$_POST["jumlahAwalBarang"];
		$hasil_jumlah_barang  = (int) $jumlah_awal_barang - (int) $val_jumlah_barang;

		$result 	= "SELECT * FROM tb_barang WHERE kode_barang = '$kode_barang';";
		$query 	= mysqli_query($conn, $result);
		$data = mysqli_fetch_assoc($query);
		$jenis_barang 				 = $data["jenis_barang"];
		$nama_barang 			  	 = $data["nama_barang"];
		$kondisi_barang 		 	 = $data["kondisi_barang"];
		$harga_satuan 				 = $data["harga_satuan"];
		$hasil_harga_satuan 	 	 = $data["harga_satuan"];
		$hasil_harga_satuan  	*= $hasil_jumlah_barang;
		$total_harga_tb_barang 	 = $hasil_harga_satuan;
		$foto_barang 			 	 = $data["foto_barang"];
		$total_harga_tb_b_keluar = $val_jumlah_barang * $harga_satuan;

		$result 			 	 	 = "";
		$result	 				.= "UPDATE tb_barang SET ";
		$result 					.= "jumlah_barang = '$hasil_jumlah_barang',";
		$result 					.= "total_harga = '$total_harga_tb_barang'";
		$result 					.= "WHERE kode_barang = '$kode_barang';";

		$result 					.= "INSERT INTO tb_barang_inventaris_karyawan VALUES(";
		$result 					.= "'$kode_karyawan',";
		$result 					.= "'$nama_karyawan',";
		$result 					.= "'$kode_barang',";
		$result 					.= "'$jenis_barang',";
		$result 					.= "'$nama_barang',";
		$result 					.= "'$kondisi_barang',";
		$result 					.= "'$val_jumlah_barang',";
		$result 					.= "'$harga_satuan',";
		$result 					.= "'$total_harga_tb_b_keluar',";
		$result 					.= "'$foto_barang'";
		$result 					.= ");";
		$query 					 = mysqli_multi_query($conn, $result);
		// return $query;
	}

	$result					 = "SELECT * FROM tb_barang_inventaris_karyawan WHERE kode_barang='$kode_barang' AND kode_karyawan = '$kode_karyawan';";
	$query 					 = mysqli_query($conn, $result);
	
	if (mysqli_affected_rows($conn) == 1) {
		$result					 = "SELECT * FROM tb_barang_inventaris_karyawan WHERE kode_barang='$kode_barang';";
		$query 				 	 = mysqli_query($conn, $result);
		$data 					 = mysqli_fetch_assoc($query);
		$jumlah_barang 		 = $data["jumlah_barang"];
		$jumlah_barang 		+= $val_jumlah_barang;
		$total_harga 			 = $data["total_harga"];
		$total_harga 			*= $jumlah_barang;

		$result 			 	 	 = "";
		$result	 				.= "UPDATE tb_barang_inventaris_karyawan SET ";
		$result 					.= "jumlah_barang = '$jumlah_barang',";
		$result 					.= "total_harga = '$total_harga'";
		$result 					.= "WHERE kode_barang = '$kode_barang';";
		$query 					 = mysqli_query($conn, $result);
		queryTambahBarang(); 
		echo "data sudah ada";
	}
	else {
		$result					 = "";
		$result 					.= "INSERT INTO tb_barang_keluar VALUES(";
		$result 					.= "'$kode_karyawan',";
		$result 					.= "'$nama_karyawan',";
		$result 					.= "'$kode_barang',";
		$result 					.= "'$jenis_barang',";
		$result 					.= "'$nama_barang',";
		$result 					.= "'$kondisi_barang',";
		$result 					.= "'$val_jumlah_barang',";
		$result 					.= "'$harga_satuan',";
		$result 					.= "'$total_harga_tb_b_keluar',";
		$result 					.= "'$foto_barang',";
		$result 					.= "'2020-11-04'";
		$result 					.= ");";
		$query 					 = mysqli_query($conn, $result);
		queryTambahBarang();

		if ($query) {
			echo "data baru di tambahkan";
		}
		else {
			echo mysqli_error($conn);
		} 
	}

	// if ($query) {
	// 	echo "$nama_barang berhasil ditambahkan";
	// }
	// else {
	// 	echo mysqli_error($conn);
	// }

}
?>