
$(document).ready(function() {
	"use strict";
	$("#form").css({"height" : "970px"});

	$("#acceptTambahBarang").click(function(e) {
		e.preventDefault();
		
		let confirmTambahBarang = confirm("Apakah Anda Yakin Ingin Menambahkan Data Barang?");
		if (confirmTambahBarang) {
			let valKodeBarang 		= $("#kodeBarang").val();
			let valJenisBarang 		= $("#jenisBarang").val();
			let valNamaBarang 		= $("#namaBarang").val();
			let valMerkBarang			= $("#merkBarang").val();
			let valKondisiBarang 	= $("#kondisiBarang").val();
			let valHargaSatuan 		= $("#hargaSatuan").val();
			let valJumlahBarang 		= $("#jumlahBarang").val();
			let valFotoBarang 		= $("#fotoBarang").val();
			let valTanggalMasuk 		= $("#tanggalMasuk").val();
			let pesanTambahBarang 	= "";

			validasiNomer(valKodeBarang, "#kodeBarang", 8);
			validasiNomer(valHargaSatuan, "#hargaSatuan", undefined);
			validasiNomer(valJumlahBarang, "#jumlahBarang", undefined);
			validasiKosong(valKodeBarang,"#kodeBarang");
			validasiKosong(valJenisBarang, "#jenisBarang");
			validasiKosong(valNamaBarang, "#namaBarang");
			validasiKosong(valKondisiBarang, "#kondisiBarang");
			validasiKosong(valJumlahBarang, "#jumlahBarang");
			validasiKosong(valHargaSatuan, "#hargaSatuan");
			validasiKosong(valFotoBarang, "#fotoBarang");
			validasiKosong(valTanggalMasuk, "#tanggalMasuk");

			validasiAJAXDK("tambah", valKodeBarang, "#kodeBarang", "files_backend_ajax/backend_data_barang.php", null);
		}
	});

	buttonBatalHeaderLocation("#buttonBatal", "data_barang.php");
});