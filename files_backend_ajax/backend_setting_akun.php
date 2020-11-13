<?php  
$conn 	= mysqli_connect("localhost","root","","tugas_inventaris");

require_once 'php_functions.php';

// Tabel users
if (isset($_POST["tabelUsers"])) {
	$result 	= "SELECT * FROM tb_users;";
	tabel_users($result);
}

// Validasi Username
if (isset($_POST['validasiUsername'])) {
	$val_username 	= $_POST['validasiUsername'];
	$result 			= "SELECT * FROM tb_users WHERE username='$val_username';";
	$query 			= mysqli_query($conn, $result);

	if (mysqli_affected_rows($conn) == 1) {
		echo "Username sudah digunakan, harap gunakan yang lain";
	}
	else {
		echo "berhasil";
	}
} 

// Tambahkan akun
if (isset($_POST["submitTambahAkun"])) {
	$val_username 		= $_POST["username"];
	$val_password 	 	= sha1($_POST["password"]);
	$val_email 		 	= $_POST["email"];
	$val_jenis_role  	= $_POST["jenisRole"];

	$result 	 	 = "";
	$result 		.= "INSERT INTO tb_users VALUES(";
	$result 		.= "'$val_username',";
	$result 		.= "'$val_password',";
	$result 		.= "'$val_email',";
	$result 		.= "'$val_jenis_role'";
	$result 		.= ");";

	$query 			 = mysqli_query($conn, $result);
	if ($query) {
		header("Location: ../setting_akun.php?berhasil-tambah-akun=User $val_username berhasil ditambahkan");
	}
}

// Update Role
if (isset($_POST["updateJenisRole"])) {
	$data_username 	 		= $_POST["valUsername"];
	$val_select_jenis_role  = $_POST["valSelectJenisRole"];

	$result 	 	 = "";
	$result 		.= "UPDATE tb_users SET ";
	$result 		.= "role = '$val_select_jenis_role'";
	$result 		.= "WHERE username = '$data_username';";

	$query 			 = mysqli_query($conn, $result);
	if ($query) {
		echo "Jenis role $data_username berhasil diubah, menjadi $val_select_jenis_role";
	}
}

if (isset($_POST['dataUsername'])) {
	$username 			= $_POST['dataUsername'];
	$arr_tabel_users 	= array(
		"<table  class='table shadow'>",
		"<tr class='tableFirstChild'>",
		"<th>Username</th>",
		"<th>Email</th>",
		"<th>Jenis Role</th>",
		"<th colspan='2' class='text-center'>Action</th>",
		"</tr>"
	);

	$select_jenis_role 	 = "<select id='selectJenisRole'>";
	$select_jenis_role 	.= "<option value='moderator'>Moderator</option>";
	$select_jenis_role 	.= "<option value='superuser'>Superuser</option>";
	$select_jenis_role 	.= "</select>";
	$result 			 = "SELECT * FROM tb_users WHERE username='$username';";
	$query 				 = mysqli_query($conn, $result);

	foreach ($arr_tabel_users as $key => $value) {
		echo $value;
	}

	while ($data = mysqli_fetch_assoc($query)) {
		echo "<tr>";
		echo "<td>{$data['username']}</td>";
		echo "<td>{$data['email']}</td>";
		echo "<td>$select_jenis_role</td>";
		echo "<td><button id='ubah_role' onclick='buttonUpdateJenisRole(event, this);' 
		data-username='{$data['username']}'  class='btn btn-success'>Ubah</td>";
		echo "<td><button id='hapus' onclick='buttonBatalUbahRole(event, this);' 
		class='hapusUser btn btn-danger'>Batal</td>";
		echo "</tr>";
	}
	echo "</table>";
}

// Hapus User
echo query_hapus("hapusUser", "tb_users", "username", "username");

// Ubah Password
if (isset($_POST["validasiPassword"])) {
	$val_username 						 = $_POST["valUsername"];
	$val_masukan_password_lama 	 = sha1($_POST["valMasukanPasswordLama"]);

	$result 								 = "";
	$result 								.= "SELECT * FROM tb_users WHERE username LIKE '%$val_username%'";
	$result 								.= "AND password LIKE '%$val_masukan_password_lama%';";
	$query 								 = mysqli_query($conn, $result);

	if (mysqli_affected_rows($conn) == 1) {
		echo "berhasil";
	}
	else {
		echo "<small>Password tidak sesuai</small>";
	}
}

if (isset($_POST["submitUbahPassword"])) {
	$val_password_baru 	 = sha1($_POST["passwordBaru"]);
	$val_username 			 = $_POST["username"];
	
	$result 					 = "";
	$result 					.= "UPDATE tb_users SET ";
	$result 					.= "password = '$val_password_baru'";
	$result 					.= "WHERE username = '$val_username';";
	$query 					 = mysqli_query($conn, $result);
	if ($query) {
		header("Location: ../setting_akun.php?berhasil-ubah-password=$val_username berhasil di ubah password");
	}
}

// Search username
echo searchTabel("searchUsername", "tb_users", "username", "tabel_users", "Username tidak ditemukan", null);

// Pagination username
echo pagination_links("paginationTabelUsername","tb_users");
echo page_click("pageListTabelUsers", "tb_users", "username", "tabel_users");
echo page_next("pageNext", "tb_users", "username", "tabel_users");
?>