<?php
$conn 		= mysqli_connect("localhost","root","","daftar_inventaris");
$username 	= (isset($_POST['username'])) ? $_POST['username'] : "";
$password 	= (isset($_POST['password'])) ? sha1($_POST['password']) : "";

// AJAX index.php (Halaman Login) ===================================================================== >>
// AJAX dari index.php
if (isset($_POST["halaman_login"])) {	
	$result 	= "SELECT * FROM tb_users WHERE username LIKE '$username' AND password LIKE '$password';";
	$query 		= mysqli_query($conn,$result);

	if (mysqli_affected_rows($conn) === 0) {
		echo "<small>Username/Password tidak sesuai*</small>";		
	}
	else if (mysqli_affected_rows($conn) === 1){
		session_start();
		$data 					= mysqli_fetch_assoc($query);
		$role 					= $data['role'];
		$_SESSION['username'] 	= $username;
		$_SESSION['role'] 		= $role;
	}
}

// AJAX Halaman home.php =============================================================== >>
// AJAX Total Karyawan (home.php)

function tabel_karyawan($post, $result, $affected_rows) {
	global $conn;
	if (isset($_POST[$post])) {
		$arr_tabel_karyawan = array(
			"<table  class='table shadow'>",
			"<tr class='tableFirstChild'>",
			"<th>Kode Karyawan</th>",
			"<th>Nama Karyawan</th>",
			"<th>Posisi</th>",
			"<th>Pendidikan Terakhir</th>",
			"<th>Email</th>",
			"<th>Nomer Handphone</th>",
			"<th>Alamat Lengkap</th>",
			"<th colspan='2' class='text-center'>Action</th>",
			"</tr>"
		);
		$query 			= mysqli_query($conn,$result);

		if (mysqli_affected_rows($conn) === 0) {
			echo $affected_rows;
		}
		else {
			for ($i=0; $i < count($arr_tabel_karyawan) ; $i++) { 
				echo $arr_tabel_karyawan[$i];
			}

			while ($data = mysqli_fetch_assoc($query)) {
				echo "<tr>";
				echo "<td>{$data['kode_karyawan']}</td>";
				echo "<td>{$data['nama_karyawan']}</td>";
				echo "<td>{$data['posisi_jabatan']}</td>";
				echo "<td>{$data['pendidikan_terakhir']}</td>";
				echo "<td>{$data['email']}</td>";
				echo "<td>{$data['nomer_handphone']}</td>";
				echo "<td>{$data['alamat_lengkap']}</td>";
				echo "<td><button class='btn btn-success'>Edit</td>";
				echo "<td><button class='hapusKaryawan btn btn-danger'>Hapus</td>";
				echo "</tr>";
			}
			echo "</table>";
		}
	}
}
// AJAX Tabel Karyawan \\
$result 	= "SELECT * FROM tb_karyawan ORDER BY nama_karyawan ASC;";
tabel_karyawan("tabelKaryawan",$result,null);

// AJAX Total Karyawan
if (isset($_POST['totalKaryawan'])) {
	$result 	= "SELECT * FROM tb_karyawan;";
	$query 		= mysqli_query($conn,$result);
	echo mysqli_affected_rows($conn);
}

// AJAX Search Tabel Karyawan
$searchValKaryawan 	= (isset($_POST['searchValKaryawan'])) ? $_POST['searchValKaryawan'] : "";
$result 			= "SELECT * FROM tb_karyawan WHERE nama_karyawan 
LIKE '%$searchValKaryawan%' ORDER BY nama_karyawan ASC;";
tabel_karyawan("searchTabelKaryawan",$result,"User Tidak Ditemukan"); 

// AJAX data_barang.php ========================================================== >>
// Function AJAX Total Barang-Barang
function total_barang($post, $jenis_barang, $semua_barang) {
	global $conn;
	if (isset($_POST[$post])) {
		if ($semua_barang) {
			$result 	= "SELECT * FROM tb_barang;";	
		}
		else {
			$result 	= "SELECT * FROM tb_barang WHERE jenis_barang ='$jenis_barang;'";
		}
		$query 			= mysqli_query($conn,$result);
		$total_barang 	= (int) "";	 
		while ($data = mysqli_fetch_assoc($query)) {
			$total_barang += (int) $data['jumlah_barang'];
		}
		return $total_barang;
	}	
}

// AJAX Total Barang Elektronik
echo total_barang('totalSemuaBarang','Elektronik',true);
echo total_barang('totalBarangElektronik','Elektronik',false);
echo total_barang('totalBarangAlatTulis','Alat Tulis',false);
echo total_barang('totalBarangKendaraan','Kendaraan',false);
echo total_barang('totalBarangLainnya','Lainnya',false);

// Function Tampilan Tabel Barang
function tabel_barang($post, $result, $affected_rows) {
	global $conn;
	if (isset($_POST[$post])) {
		$arr_tabel_data_barang = array(
			"<table  class='table shadow'>",
			"<tr class='tableFirstChild'>",	
			"<th>Kode Barang</th>",
			"<th>Jenis Barang</th>",
			"<th>Nama Barang</th>",
			"<th>Merk Barang</th>",
			"<th>Kondisi Barang</th>",
			"<th>Harga Satuan</th>",
			"<th>Total Harga</th>",
			"<th>Jumlah Barang</th>",
			"<th>Foto Barang</th>",
			"<th colspan='2' class='text-center'>Action</th>",
			"</tr>"
		);
		$query 		= mysqli_query($conn,$result);

		if (mysqli_affected_rows($conn) === 0) {
			echo $affected_rows;
		}
		else {
			for ($i=0; $i < count($arr_tabel_data_barang) ; $i++) { 
				echo $arr_tabel_data_barang[$i];
			}

			while ($data = mysqli_fetch_assoc($query)) {
				$harga_satuan 	= number_format($data['harga_satuan'],0,".",".");
				$total_harga 	= number_format($data['total_harga'],0,".",".");
				echo "<tr>";
				echo "<td>{$data['kode_barang']}</td>";
				echo "<td>{$data['jenis_barang']}</td>";
				echo "<td>{$data['nama_barang']}</td>";
				echo "<td>{$data['merk_barang']}</td>";
				echo "<td>{$data['kondisi_barang']}</td>";
				echo "<td>Rp$harga_satuan</td>";
				echo "<td>Rp$total_harga</td>";
				echo "<td>{$data['jumlah_barang']}</td>";
				echo "<td>{$data['foto_barang']}</td>";
				echo "<td><button class='btn btn-success'>Edit</button>";
				echo "<td><button class='btn btn-success'>Hapus</button>";
				echo "</tr>";
			}
			echo "</table>";
		}
	}
}
// AJAX Saat Pertama Kali Website Load   
$result 	= "SELECT * FROM tb_barang;";
tabel_barang('tabelBarang',$result,null);
tabel_barang('filterSemua',$result,null);

// AJAX Filter Barang Elektronik
$result 	= "SELECT * FROM tb_barang WHERE jenis_barang ='Elektronik';";
tabel_barang('filterElektronik',$result,null);

// AJAX Filter Barang Alat Tulis
$result 	= "SELECT * FROM tb_barang WHERE jenis_barang ='Alat Tulis';";
tabel_barang('filterAlatTulis',$result,null);

// AJAX Filter Barang Kendaraan
$result 	= "SELECT * FROM tb_barang WHERE jenis_barang ='Kendaraan';";
tabel_barang('filterKendaraan',$result,null);

// AJAX Filter Barang Lainnya
$result 	= "SELECT * FROM tb_barang WHERE jenis_barang ='Lainnya';";
tabel_barang('filterLainnya',$result,null);

// AJAX Search Barang
$valSearchBarang 	= (isset($_POST['searchValBarang'])) ? $_POST['searchValBarang'] : ""; 
$result 			= "SELECT * FROM tb_barang WHERE nama_barang LIKE '%$valSearchBarang%';";
tabel_barang('searchTabelBarang',$result,"Nama Barang Tidak Ditemukan");
?>