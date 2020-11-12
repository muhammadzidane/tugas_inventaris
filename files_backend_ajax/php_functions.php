<?php 
$conn 	= mysqli_connect("localhost","root","","tugas_inventaris");

function tabel_barang($result, $tabelDB) {
	global $conn;
	echo "<table  class='table shadow shadow-sm'>";
	echo "<tr class='tableFirstChild'>";
	
	if ($tabelDB == "tb_barang_keluar") {
		echo "<th>Kode Karyawan</th>";
		echo "<th>Nama Karyawan</th>";			
	}

	echo "<th>Kode Barang</th>";
	echo "<th>Jenis Barang</th>";
	echo "<th>Nama Barang</th>";
	echo "<th>Kondisi Barang</th>";
	echo "<th>Jumlah Barang</th>";
	echo "<th>Harga Satuan</th>";
	echo "<th>Total Harga</th>";
	echo "<th>Foto Barang</th>";

	if ($tabelDB == "tb_barang_masuk") {
		echo "<th>Tanggal Masuk</th>";
	}

	if ($tabelDB == "tb_barang_keluar") {
		echo "<th>Tanggal Keluar</th>";
	}

	if ($tabelDB == "tb_barang" OR $tabelDB == "tb_barang_inventaris_karyawan") {
		echo "<th id='THActions' colspan='3' class='text-center'>Actions</th>";
	}
	
	echo "</tr>";

	$query 			= mysqli_query($conn, $result);

	while ($data = mysqli_fetch_assoc($query)) {

		$harga_satuan 	= number_format($data['harga_satuan'],0,".",".");
		$total_harga 	= number_format($data['total_harga'],0,".",".");

		echo "<tr>";

		if ($tabelDB == "tb_barang_keluar") {
			echo "<td>{$data['kode_karyawan']}</td>";
			echo "<td>{$data['nama_karyawan']}</td>";			
		}

		echo "<td>{$data['kode_barang']}</td>";
		echo "<td>{$data['jenis_barang']}</td>";
		echo "<td>{$data['nama_barang']}</td>";
		echo "<td>{$data['kondisi_barang']}</td>";
		echo "<td>{$data['jumlah_barang']}</td>";
		echo "<td>Rp$harga_satuan,-</td>";
		echo "<td>Rp$total_harga,-</td>";
		echo "<td>{$data['foto_barang']}</td>";

		if ($tabelDB == "tb_barang") {
			echo "<td><button class ='buttonTambah btn btn-success' onclick='buttonTambahBarang(event, this);'
			data-kode='{$data['kode_barang']}' data-jumlah='{$data['jumlah_barang']}' data-total='{$data['total_harga']}'>Tambah</button</td>";
			echo "<td class='buttonEdit'><button onclick='buttonEditBarang(event, this);' 
			data-kode='{$data['kode_barang']}' data-nama='{$data['nama_barang']}' class='btn btn-warning text-white'>Edit</td>";
			echo "<td class='buttonHapus'><button onclick='buttonHapusBarang(event, this);' 
			data-kode='{$data['kode_barang']}' class='hapusBarang btn btn-danger'>Hapus</td>";
			echo "</tr>";
		}

		if ($tabelDB == "tb_barang_inventaris_karyawan") {
			echo "<td class='buttonTambah'><button class='btn btn-success' onclick='buttonTambahBarang(event, this);'
			data-kode='{$data['kode_barang']}' data-jumlah='{$data['jumlah_barang']}' data-total='{$data['total_harga']}'>Tambah</button</td>";
			echo "<td class='hapus'><button onclick='buttonHapusBarang(event, this);' 
			data-kode='{$data['kode_barang']}' class='hapusBarang btn btn-danger'>Hapus</td>";
			echo "</tr>";

		}

		if ($tabelDB == "tb_barang_masuk") {
			echo "<td>{$data['tanggal_masuk']}</td>";
		}

		if ($tabelDB == "tb_barang_keluar") {
			echo "<td>{$data['tanggal_keluar']}</td>";
		}
	}
	echo "</table>";
}

function tabel_karyawan($result) {
	global $conn;
	echo "<table  class='table shadow shadow-sm'>";
	echo "<tr class='tableFirstChild'>";
	echo "<th>Kode Karyawan</th>";
	echo "<th>Nama Karyawan</th>";
	echo "<th>Posisi</th>";
	echo "<th>Email</th>";
	echo "<th>Pendidikan Terakhir</th>";
	echo "<th>Alamat Lengkap</th>";
	echo "<th>Foto</th>";
	echo "<th id='THActions' colspan='2' class='text-center'>Action</th>";
	echo "</tr>";
	$query 			= mysqli_query($conn, $result);

	while ($data = mysqli_fetch_assoc($query)) {
		echo "<tr class='TRKaryawan' data-kode='{$data['kode_karyawan']}' data-nama='{$data['nama_karyawan']}'>";
		echo "<td>{$data['kode_karyawan']}</td>";
		echo "<td>{$data['nama_karyawan']}</td>";
		echo "<td>{$data['posisi_jabatan']}</td>";
		echo "<td>{$data['email']}</td>";
		echo "<td>{$data['pendidikan_terakhir']}</td>";
		echo "<td>{$data['alamat']}</td>";
		echo "<td>{$data['foto']}</td>";
		echo "<td class='TDEdit'><button onclick='buttonEditKaryawan(event, this);' 
		data-kode='{$data['kode_karyawan']}' data-nama='{$data['nama_karyawan']}' class='btn btn-success'>Edit</td>";
		echo "<td class='TDHapus'><button id='hapus' onclick='buttonHapusKaryawan(event, this);' 
		data-kode='{$data['kode_karyawan']}' class='hapusKaryawan btn btn-danger'>Hapus</td>";
		echo "</tr>";
	}
	echo "</table>";
}

function tabel_users($result) {
	global $conn;
	$arr_tabel_users = array(
		"<table  class='table shadow shadow-sm'>",
		"<tr class='tableFirstChild'>",
		"<th>Username</th>",
		"<th>Email</th>",
		"<th>Jenis Role</th>",
		"<th colspan='2' class='text-center'>Action</th>",
		"</tr>"
	);
	$query 			= mysqli_query($conn, $result);

	foreach ($arr_tabel_users as $key => $value) {
		echo $value;
	}

	while ($data = mysqli_fetch_assoc($query)) {
		echo "<tr>";
		echo "<td>{$data['username']}</td>";
		echo "<td>{$data['email']}</td>";
		echo "<td>{$data['role']}</td>";
		echo "<td><button id='ubah_role' onclick='buttonUbahRole(event, this);' 
		data-username='{$data['username']}'  class='btn btn-success'>Ubah Role</td>";
		echo "<td><button id='hapus' onclick='buttonHapusUser(event, this);' 
		data-username='{$data['username']}' class='hapusUser btn btn-danger'>Hapus</td>";
		echo "</tr>";
	}
	echo "</table>";
}

function sql_protect($string) {
	$values = htmlentities(strip_tags(trim($string)));
	return $values;
}

function searchTabel($post, $nama_tabel, $kondisi, $function_tabel, $pesan, $kode_karyawan) {
	global $conn;	
	if (isset($_POST[$post])) {
		$val_search 	= mysqli_real_escape_string($conn, $_POST[$post]);

		if ($nama_tabel == "tb_barang_inventaris_karyawan") {
			$result 		= "SELECT * FROM $nama_tabel WHERE $kondisi LIKE '%$val_search%' AND kode_karyawan LIKE '%$kode_karyawan%';";
		}
		else {
			$result 		= "SELECT * FROM $nama_tabel WHERE $kondisi LIKE '%$val_search%';";	
		}
		$query 			= mysqli_query($conn, $result);

		if (mysqli_affected_rows($conn) >= 1) {
			if ($function_tabel == "tabel_barang") {
				$function_tabel = $function_tabel($result, $nama_tabel);
				return $function_tabel;
			}
			else {
				$function_tabel = $function_tabel($result);
				return $function_tabel;	
			}
		}
		else {
			return $pesan;
		}
	}
}

function jumlah_barang($post, $tabelDB, $jenis_barang) {
	global $conn;
	if (isset($_POST[$post])) {
		$jumlah_barang = (int) "";

		if ($tabelDB == "tb_barang") {
			if ($jenis_barang === "semua") {
				$result 	= "SELECT jumlah_barang FROM $tabelDB;";
			}
			else {
				$result 	= "SELECT jumlah_barang FROM $tabelDB WHERE jenis_barang = '$jenis_barang';";
			}
		}
		else { // Else untuk ( $tabelDB == "tb_barang_inventaris_karyawan" )
		$kode_karyawan = $_POST[$post]; 

		if ($jenis_barang === "semua") {
			$result 	= "SELECT jumlah_barang FROM $tabelDB WHERE kode_karyawan='$kode_karyawan';";
		}
		else {
			$result 	= "SELECT jumlah_barang FROM $tabelDB WHERE jenis_barang = '$jenis_barang' AND kode_karyawan='$kode_karyawan';";
		}	
	}

	$query 		= mysqli_query($conn, $result);

	while ($data = mysqli_fetch_assoc($query)) {
		$jumlah_barang += $data['jumlah_barang'];
	}
	return $jumlah_barang;
}
}

// Validasi duplikat key 
function validasi_duplikat_key($post, $nama_tabel, $kondisi){
	global $conn;
	if (isset($_POST[$post])) {
		$kode 		= $_POST[$post];
		$query 		= mysqli_query($conn, "SELECT * FROM $nama_tabel WHERE $kondisi='$kode';");

		if (mysqli_affected_rows($conn) == 1) {
			$hasil = "Kode yang sama sudah digunakan, harap gunakan yang lain";
		}
		else {
			$hasil = "berhasil";
		}
		return $hasil;
	}
}

function validasi_duplikat_key_get($post, $get_url, $nama_tabel, $kondisi){
	global $conn;
	if (isset($_POST[$post])) {
		$kode 			= $_POST[$post];
		$get_url_kode 	= $_POST[$get_url];
		$query 			= mysqli_query($conn, "SELECT * FROM $nama_tabel WHERE $kondisi='$kode';");

		if ($kode == $get_url_kode) {
			$hasil = "berhasil";
		}
		else if (mysqli_affected_rows($conn) == 1) {
			$hasil = "Kode yang sama sudah digunakan, harap gunakan yang lain";
		}
		else {
			$hasil = "berhasil";
		}
		return $hasil;
	}
}

// Query hapus
function query_hapus($post, $nama_tabel, $kondisi, $nama){
	global $conn;
	if (isset($_POST[$post])) {
		$kode 			 = $_POST[$post];
		$result 			 = "SELECT * FROM $nama_tabel WHERE $kondisi ='$kode';";
		$query 			 = mysqli_query($conn, $result);
		$data 			 = mysqli_fetch_assoc($query);
		$nama 			 = $data[$nama];
		$harga_satuan 	 = $data["harga_satuan"];
		$jumlah_awal 	 = (isset($_POST["valJumlahAwalBarang"])) ? (int) $_POST["valJumlahAwalBarang"] : "";
		$jumlah_barang	 = (isset($_POST["valJumlah"])) ? (int) $_POST["valJumlah"] : "";
		$hasil 			 = $jumlah_awal - $jumlah_barang;
		$total_harga 	 = $hasil * $harga_satuan;
		
		$result 	 		 = "";

		if ($nama_tabel == "tb_karyawan") {
			$result 		.= "DELETE FROM tb_karyawan WHERE $kondisi = '$kode';";
			$result 		.= "DELETE FROM tb_barang_inventaris_karyawan WHERE $kondisi = '$kode';";
			$query 		 = mysqli_multi_query($conn, $result);
		}
		
		if ($nama_tabel == "tb_barang") {

			if ($hasil == 0) {
				$result 			.= "DELETE FROM tb_barang WHERE $kondisi = '$kode';";
			}
			else {
				$result 			.= "UPDATE tb_barang SET jumlah_barang = '$hasil',";
				$result 			.= "total_harga = '$total_harga'";
				$result 			.= "WHERE $kondisi = '$kode';";
			}

			$query 		 	 = mysqli_query($conn, $result);
		}

		if ($nama_tabel == "tb_barang_inventaris_karyawan") {
			if ($hasil == 0) {
				$result 			.= "DELETE FROM tb_barang_inventaris_karyawan WHERE $kondisi = '$kode';";
			}
			else {
				$result 			.= "UPDATE tb_barang_inventaris_karyawan SET jumlah_barang = '$hasil',";
				$result 			.= "total_harga = '$total_harga'";
				$result 			.= "WHERE $kondisi = '$kode';";
			}

			$query 		 	 = mysqli_query($conn, $result);
		}

		if ($query) {
			return "$nama berhasil di hapus";
		}
		else {
			return mysqli_error($conn);
		}
	}
}

// Filter barang barang
function filter_barang($post, $nama_tabel, $jenis_barang) {
	if (isset($_POST[$post])) {
		if ($jenis_barang == "Semua") {
			$result 	= "SELECT * FROM $nama_tabel LIMIT 5";
		}
		else {
			$result 	= "SELECT * FROM $nama_tabel WHERE jenis_barang ='$jenis_barang';";
		}
		$tabel 		= tabel_barang($result, $nama_tabel);
		return $tabel;
	}
}

// Pagination event click
function pagination_links($post, $nama_tabel){
	global $conn;
	if (isset($_POST[$post])) {

		if ($nama_tabel == "tb_barang_inventaris_karyawan") {
			$kode_karyawan 	= $_POST[$post];  
			$result 				= "SELECT * FROM $nama_tabel WHERE kode_karyawan = '$kode_karyawan';";
		}
		else {
			$result 	= "SELECT * FROM $nama_tabel;";
		}

		$query 	= mysqli_query($conn, $result);

		$hasil 	= "";

		if (mysqli_affected_rows($conn) >= 1) {
			$hasil .= "<li class='page-item'><span id='page-1' class='page-circle page-actived' onclick='pageLink(this);' data-page='1'>1</span></li>";
		}

		$counter = 2;
		for ($i=5; $i <= mysqli_affected_rows($conn); $i+=5) { 
			if (mysqli_affected_rows($conn) > $i) {
				$hasil .= "<li class='page-item'><span id='page-$counter' class='page-circle' onclick='pageLink(this);' data-page='$counter'>$counter</span></li>";
				$counter++;
			}
		}
		return $hasil;
	}
}

function page_click($post, $nama_tabel, $order_by, $nama_function) {
	global $conn;
	if (isset($_POST[$post])) {
		$kode_karyawan 		= (isset($_POST["kodeKaryawan"])) ? $_POST["kodeKaryawan"] : "";
		$data_page 				= $_POST[$post];
		$page_list_length 	= $_POST['pageListChildrenLength'];

		$result 					= "SELECT * FROM $nama_tabel;";
		$query 					= mysqli_query($conn, $result);
		$counter 			   = 0;

		for ($i=0; $i <= mysqli_affected_rows($conn); $i+=5) { 
			$counter++;
			if ($data_page == $counter) {
				if ($nama_tabel == "tb_barang_inventaris_karyawan") {
					$result 		 = "";
					$result 		.= "SELECT * FROM $nama_tabel WHERE kode_karyawan LIKE '$kode_karyawan'";
					$result 		.= "ORDER BY $order_by ASC LIMIT $i, 5;";
					$query 		 = mysqli_query($conn, $result);
				}
				else {
					$result 		 = "SELECT * FROM $nama_tabel ORDER BY $order_by ASC LIMIT $i, 5;";
				}

				$nama_function 	= $nama_function($result, $nama_tabel);
				return $nama_function;
			}
		}
	}
}

// Page Next
function page_next($post, $nama_tabel, $order_by, $nama_function) {
	global $conn;
	if (isset($_POST[$post])) {
		$data_page 	= $_POST[$post];
		$result 	= "SELECT * FROM $nama_tabel;";
		$query 		= mysqli_query($conn, $result);
		$counter 	= 2;
		for ($i=5; $i <= mysqli_affected_rows($conn) ; $i+=5) { 
			if ($data_page == $counter) {
				$result 	= "SELECT * FROM $nama_tabel ORDER BY $order_by ASC LIMIT $i,5;";
			}
			$counter++;
		}
		$nama_function = $nama_function($result, $nama_tabel);
		return $nama_function;
	}
}

// Mengecek session, jika tidak ada maka header ke halaman login
function cek_session() {
	$sess_username 		= (isset($_SESSION['username'])) ? $_SESSION['username'] : "";
	if ($sess_username == "") {
		header("Location: index.php");
	}
}

// Tampilkan Pesan Load
function tampilkan_pesan_load($getVal){
	if (isset($_GET[$getVal])) {
		echo $_GET[$getVal];
	}
}


function hapusModuls($innerHTML) {
	$sess_role 		= (isset($_SESSION['role'])) ? $_SESSION['role'] : "";
	if ($sess_role == "superuser") {
		echo $innerHTML;
	}
} 

?>