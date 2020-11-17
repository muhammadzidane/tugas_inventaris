$(document).ready(function() {
	"use strict";
	
	$("#acceptTambah").click(function(e) {
		e.preventDefault();

		let confirmEdit = confirm("Apakah Anda Yakin Ingin Menambahkan Karyawan Baru?");
		if (confirmEdit) {
			let valKodeKaryawan 			= $("#kodeKaryawan").val();
			let valNamaKaryawan 			= $("#namaKaryawan").val();
			let valPosisiJabatan 		= $("#posisijabatan").val();
			let valEmail 					= $("#email").val();
			let valPendidikanTerakhir	= $("#pendidikanTerakhir").val();
			let valAlamat 					= $("#alamat").val();
			let valFoto 					= $("#foto").val();
			
			validasiNomer(valKodeKaryawan, "#kodeKaryawan", 8)
			
			validasiEmailEventClick(valEmail, "#email");

			validasiKosong(valKodeKaryawan,"#kodeKaryawan");
			validasiKosong(valNamaKaryawan, "#namaKaryawan");
			validasiKosong(valEmail, "#email");
			validasiKosong(valPendidikanTerakhir, "#pendidikanTerakhir");
			validasiKosong(valAlamat, "#alamat");
			validasiKosong(valFoto, "#foto");
			
			validasiAJAXDK("tambah", valKodeKaryawan, "#kodeKaryawan", "files_backend_ajax/backend_daftar_karyawan.php", null);
		}
	});

	buttonBatalHeaderLocation("#buttonBatal", "daftar_pegawai.php");
});