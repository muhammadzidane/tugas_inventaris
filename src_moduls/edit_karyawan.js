$(document).ready(function() {
	"use strict";

	$("#posisi_jabatan").val("<?= $posisi_jabatan; ?>"); // Nilai pertama posisi jabatan saat load event berjalan 
	$("#acceptEdit").click(function(e) {
		let confirmEdit = confirm("Apakah Anda Yakin Ingin Menambahkan Data Barang?");
		if (confirmEdit) {
			let valKodeKaryawan 			= $("#kode_karyawan").val();
			let valNamaKaryawan 			= $("#nama_karyawan").val();
			let valPosisiJabatan 		= $("#posisi_jabatan").val();
			let valEmail 					= $("#email").val();
			let valPendidikanTerakhir	= $("#pendidikan_terakhir").val();
			let valAlamat 					= $("#alamat").val();
			let valFoto 					= $("#foto").val();
			
			validasiKosong(valKodeKaryawan,"#kode_karyawan");
			validasiNomer(valKodeKaryawan, "#kode_karyawan", 8)
			validasiKosong(valNamaKaryawan, "#nama_karyawan");
			validasiKosong(valEmail, "#email");
			validasiEmailEventClick(valEmail, "#email");
			validasiKosong(valPendidikanTerakhir, "#pendidikan_terakhir");
			validasiKosong(valAlamat, "#alamat");
			validasiKosong(valFoto, "#foto");
			
			if ($(".pesanValidasi").text() == "") {
				$.ajax({
					url 	: "files_backend_ajax/backend_daftar_karyawan.php",
					type 	: "POST",
					data 	: { validasiDuplikatKey : valKodeKaryawan },
					success : function(responseText, success) {
						if (responseText == "berhasil") {
							$.post('files_backend_ajax/backend_daftar_karyawan.php',{
								acceptEdit 				: true, 
								urlKodeKaryawan 		: "<?php echo $kode_karyawan; ?>",
								urlNamaKaryawan 		: "<?php echo $nama_karyawan; ?>",
								valKodeKaryawan 		: valKodeKaryawan,
								valNamaKaryawan 		: valNamaKaryawan,
								valPosisiJabatan 		: valPosisiJabatan,
								valEmail 				: valEmail,
								valPendidikanTerakhir: valPendidikanTerakhir,
								valAlamat 				: valAlamat,
								valFoto 					: valFoto }, 
								function(responseText) {
									location.assign(`daftar_pegawai.php?berhasil_edit=${ responseText }`);
								}
								);
						}
						else {
							$("#kode_karyawan").next().html(`<small>${ responseText }</small>`).addClass('pesanValidasi');
							e.preventDefault();
						}
					}					
				});
			}
		}
	});
});