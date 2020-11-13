$(document).ready(function() {
	"use strict";
	
	$("#acceptTambah").click(function(e) {
		let confirmEdit = confirm("Apakah Anda Yakin Ingin Menambahkan Karyawan Baru?");
		if (confirmEdit) {
			let valKodeKaryawan 			= $("#kode_karyawan").val();
			let valNamaKaryawan 			= $("#nama_karyawan").val();
			let valPosisiJabatan 		= $("#posisi_jabatan").val();
			let valEmail 					= $("#email").val();
			let valPendidikanTerakhir	= $("#pendidikan_terakhir").val();
			let valAlamat 					= $("#alamat").val();
			let valFoto 					= $("#foto").val();
			
			validasiNomer(valKodeKaryawan, "#kode_karyawan", 8)
			validasiEmailEventClick(valEmail, "#email");
			validasiKosong(valKodeKaryawan,"#kode_karyawan");
			validasiKosong(valNamaKaryawan, "#nama_karyawan");
			validasiKosong(valEmail, "#email");
			validasiKosong(valPendidikanTerakhir, "#pendidikan_terakhir");
			validasiKosong(valAlamat, "#alamat");
			validasiKosong(valFoto, "#foto");

			if ($(".pesanValidasi").text() == "") {
				$.ajax({
					url 	: "files_backend_ajax/backend_daftar_karyawan.php",
					type 	: "POST",
					data 	: { validasiDuplikatKeyTambahKaryawan : valKodeKaryawan },
					success : function(responseText) {
						if (responseText == "berhasil") {
							$("form").submit();
						}
						else {
							e.preventDefault();
							$("#kode_karyawan").next().html(`<small>${ responseText }</small>`).addClass('pesanValidasi');
						}
					}					
				});
			}
			else {
				e.preventDefault();
			}
		}
	});
	// Button Batalkan Tambah Barang
	$("#buttonBatalEdit").click(function() {
		location.replace("daftar_pegawai.php");
	});
	// Button Batalkan Tambah Barang (Simbol Close)
	$("#closeForm").click(function() {
		$("#buttonBatalEdit").click();
	});
});