// Load event
$(document).ready(function() {
	"use strict";

	$("form").css({"height" : "975px"});

	let valAwalKodeBarang 	= $("#kodeBarang").val();
	
	$("#submitEditBarang").click(function(e) {
		e.preventDefault();
		let confirmTambahBarang = confirm("Apakah anda yakin ingin mengedit data barang?");

		let valKodeBarang 		= $("#kodeBarang").val();
		let valJenisBarang 		= $("#jenisBarang").val();
		let valNamaBarang 		= $("#namaBarang").val();
		let valMerkBarang			= $("#merkBarang").val();
		let valKondisiBarang 	= $("#kondisiBarang").val();
		let valHargaSatuan 		= $("#hargaSatuan").val();
		let valJumlahBarang 		= $("#jumlahBarang").val();
		let valFotoBarang 		= $("#fotoBarang").val();
		let valTanggalMasuk 		= $("#tanggalMasuk").val();
		
		if (confirmTambahBarang) {

			let pesanValidasi 	= $(".pesanValidasi").text();

			validasiNomer(valHargaSatuan, "#hargaSatuan", undefined);
			validasiNomer(valJumlahBarang, "#jumlahBarang", undefined);

			validasiKosong(valJenisBarang, "#jenisBarang");
			validasiKosong(valNamaBarang, "#namaBarang");
			validasiKosong(valMerkBarang, "#merkBarang");
			validasiKosong(valKondisiBarang, "#kondisiBarang");
			validasiKosong(valHargaSatuan, "#hargaSatuan");
			validasiKosong(valJumlahBarang, "#jumlahBarang");
			validasiKosong(valFotoBarang, "#fotoBarang");
			validasiKosong(valTanggalMasuk, "#tanggalMasuk");

			validasiAJAXDK("edit", valKodeBarang, "#kodeBarang", "files_backend_ajax/backend_data_barang.php", valAwalKodeBarang);
		}
	});

	$("#buttonBatal").click(function(e) {
		e.preventDefault();
		location.assign("data_barang.php");
	});
});