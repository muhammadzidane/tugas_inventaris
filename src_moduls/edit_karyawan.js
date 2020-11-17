$(document).ready(function() {
	"use strict";

	let valAwalKodeKaryawan = $("#kodeKaryawan").val();

	$("#buttonEdit").click(function(e) {
		e.preventDefault();

		let confirmEdit = confirm("Apakah Anda Yakin Ingin Menambahkan Data Barang?");
		if (confirmEdit) {
			let valKodeKaryawan 			= $("#kodeKaryawan").val();
			let valNamaKaryawan 			= $("#namaKaryawan").val();
			let valPosisiJabatan 		= $("#posisiJabatan").val();
			let valEmail 					= $("#email").val();
			let valPendidikanTerakhir	= $("#pendidikanTerakhir").val();
			let valAlamat 					= $("#alamat").val();
			let valFoto 					= $("#foto").val();
			
			validasiKosong(valNamaKaryawan, "#nama_karyawan");
			validasiKosong(valEmail, "#email");

			validasiEmailEventClick(valEmail, "#email");
			
			validasiKosong(valPendidikanTerakhir, "#pendidikan_terakhir");
			validasiKosong(valAlamat, "#alamat");
			validasiKosong(valFoto, "#foto");
			
			validasiAJAXDK("edit", valKodeKaryawan, "#kodeKaryawan", "files_backend_ajax/backend_daftar_karyawan.php", valAwalKodeKaryawan);	
		};
	});
});