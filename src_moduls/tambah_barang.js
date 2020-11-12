
$(document).ready(function() {
	"use strict";
	$("#form").css({"height" : "970px"});

	$("#acceptTambahBarang").click(function(e) {
		let confirmTambahBarang = confirm("Apakah Anda Yakin Ingin Menambahkan Data Barang?");
		if (confirmTambahBarang) {
			let valKodeBarang 		= $("#kode_barang").val();
			let valJenisBarang 		= $("#jenis_barang").val();
			let valNamaBarang 		= $("#nama_barang").val();
			let valMerkBarang			= $("#merk_barang").val();
			let valKondisiBarang 	= $("#kondisi_barang").val();
			let valHargaSatuan 		= $("#harga_satuan").val();
			let valJumlahBarang 		= $("#jumlah_barang").val();
			let valFotoBarang 		= $("#foto_barang").val();
			let valTanggalMasuk 		= $("#tanggal_masuk").val();
			let pesanTambahBarang 	= "";

			validasiNomer(valKodeBarang, "#kode_barang", 8);
			validasiNomer(valHargaSatuan, "#harga_satuan", undefined);
			validasiNomer(valJumlahBarang, "#jumlah_barang", undefined);
			validasiKosong(valKodeBarang,"#kode_barang");
			validasiKosong(valJenisBarang, "#jenis_barang");
			validasiKosong(valNamaBarang, "#nama_barang");
			validasiKosong(valKondisiBarang, "#kondisi_barang");
			validasiKosong(valJumlahBarang, "#jumlah_barang");
			validasiKosong(valHargaSatuan, "#harga_satuan");
			validasiKosong(valFotoBarang, "#foto_barang");
			validasiKosong(valTanggalMasuk, "#tanggal_masuk");

			if ($(".pesanTambahBarang").text() == "") {
				$.ajax({
					url 	: "files_backend_ajax/backend_data_barang.php",
					type 	: "POST",
					data 	: { validasiDuplikatKey : valKodeBarang },
					success : function(responseText) {
						if (responseText == "berhasil") {
							$.post('files_backend_ajax/backend_data_barang.php',{ 
								acceptTambahBarang 		: true,
								valKodeBarang 			: valKodeBarang,
								valJenisBarang 			: valJenisBarang,
								valNamaBarang 			: valNamaBarang,
								valKondisiBarang 		: valKondisiBarang,
								valJumlahBarang 		: valJumlahBarang,
								valHargaSatuan 			: valHargaSatuan,
								valFotoBarang 			: valFotoBarang,
								valTanggalMasuk 		: valTanggalMasuk }, 
								function(responseText) {
									location.assign(`data_barang.php?berhasil_ditambah=${encodeURIComponent(responseText)}`);		
								}
								);
						}
						else {
							e.preventDefault();
							$("#kode_barang").next().html(`<small>${ responseText }</small>`).addClass('pesanValidasi');
						}
					}
				});
			}
		}
	});

	// Button Batalkan Tambah Barang
	$("#batalTambahBarang").click(function() {
		location.replace("data_barang.php");
	});
	
	// Button Batalkan Tambah Barang (Simbol Close)
	$("#closeForm").click(function() {
		$("#batalTambahBarang").click();
	});
});