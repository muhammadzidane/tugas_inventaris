"use strict";

// Non Load Event ====================================================================== >>
// Tambah barang
function buttonTambahBarang(event, button) {
	let dataKodeBarang 	 = $(button).data("kode");

	tableAppend("tb_barang_modul_tambah", $(button));

	$("#buttonQueryTambah").click(function(e) {
		let valJumlah 					= $("#jumlah").val();
		let valTanggalMasuk 			= $("#tanggalMasuk").val();
		let confirmTambahBarang 	= confirm("Apakah anda yakin ingin menambahkan barang ?");
		
		if (confirmTambahBarang) {
			validasiKosong(valJumlah, "#jumlah");
			validasiKosong(valTanggalMasuk, "#tanggalMasuk");
			
			if ($(".pesanValidasi").text() == "") {
				$.ajax({
					url 		: "files_backend_ajax/backend_data_barang.php",
					type 		: "POST",
					data 		: { 
						tambahBarangYangSama 	: dataKodeBarang,
						valJumlah 					: valJumlah,
						valTanggalMasuk 			: valTanggalMasuk
					},
					success 	: function(responseText) {
						location.assign("data_barang.php?berhasil_ditambah=" + encodeURIComponent(responseText));
					}
				});		
			}
			else {
				e.preventDefault();
			}
		}
	});

	$("#buttonBatal").click(function() {
		$.ajax({
			url 		:"files_backend_ajax/backend_data_barang.php",
			type 		: "POST",
			data 		: { tabelBarang : true },
			success		:function(responseText) {	
				$("#tabelBarang").html(responseText);
			}
		});
	});
}

// Edit Barang
function buttonEditBarang(event, button) {
	let dataKodeBarang  	= $(button).data('kode');
	let dataNamaBarang 	= $(button).data('nama');
	location.assign(`edit_barang.php?kode-barang=${dataKodeBarang}&nama-barang=${dataNamaBarang}`);
}

// Hapus barang
function buttonHapusBarang(event, button) {
	let dataKodeBarang 		  	= $(button).data("kode");
	let jumlahAwalBarang   		= $(button).parent().prev().prev().prev().prev().prev().prev();
	let valJumlahAwalBarang   	= $(button).parent().prev().prev().prev().prev().prev().prev().text();

	tableAppend("tb_barang_modul_hapus", $(button));
	
	eventsTableAppend(jumlahAwalBarang, valJumlahAwalBarang);
	
	// Batal 
	$("#buttonBatal").click(function() {
		$.ajax({
			url 			:"files_backend_ajax/backend_data_barang.php",
			type 			: "POST",
			data 			: { tabelBarang : true },
			success		:function(responseText) {	
				$("#tabelBarang").html(responseText); 
			}
		});
	});
	
	$("#buttonQueryHapus").click(function() {
		let dataKodeBarang 	 		= $(button).data("kode");
		let valJumlah 					= $("#jumlah").val();
		let confirmHapusBarang 		= confirm("Apakah anda yakin ingin menghapus barang tersebut?");
		
		if (confirmHapusBarang) {
			if ($("#checkSemua").is(":checked") || valJumlah != 0) {
				$.ajax({
					url 		: "files_backend_ajax/backend_data_barang.php",
					type 		: "POST",
					data 		: { 
						hapusBarang 				: dataKodeBarang, 
						valJumlah 					: valJumlah,
						valJumlahAwalBarang 		: valJumlahAwalBarang
					},
					success	: function(responseText) {
						location.assign("data_barang.php?berhasil_dihapus=" + encodeURIComponent(responseText));
					}
				});
			}
			else {
				event.preventDefault();
				$(".pesanValidasi").html("<small>Tidak boleh kosong</small>");
			}
		}
	});
}

// Pagination links
function pageLink(button) {
	let dataPage 						= $(button).data("page");
	let pageListChildrenLength 	= $("#page-list").children().length;
	$.ajax({
		url 		: "files_backend_ajax/backend_data_barang.php",
		type 		: "POST",
		data 		: { pageListTabelBarang : dataPage, pageListChildrenLength : pageListChildrenLength },
		success	: function(responseText) {
			$("#tabelBarang").html(responseText);
		}
	});
	for (let i = 1; i <= pageListChildrenLength; i++) {
		if (dataPage == i) {
			$(".page-circle").removeClass("page-actived");	
			$(button).addClass("page-actived");
		}
	}
}

// Load event ========================================================================== >>
$(document).ready(function() {
	$("#pesan").hide();
	hidePesanLoad();
	
	// Muncul Tabel Saat Load Pertama Kali
	$.ajax({
		url 		:"files_backend_ajax/backend_data_barang.php",
		type 		: "POST",
		data 		: { tabelBarang : true },
		success		:function(responseText) {	
			$("#tabelBarang").html(responseText);
		}
	});

	ajaxHidePageNext("files_backend_ajax/backend_data_barang.php", null);

	// Jumlah Semua Barang
	$.post("files_backend_ajax/backend_data_barang.php",{ totalSemuaBarang : true },function(responseText) {	
		$("#totalSemuaBarang").html(responseText);
	});
	
	// Jumlah Barang Elektronik
	$.post("files_backend_ajax/backend_data_barang.php",{ totalBarangElektronik : true },function(responseText) {	
		$("#totalBarangElektronik").html(responseText);
	});
	
	// Jumlah Barang Alat Tulis
	$.post("files_backend_ajax/backend_data_barang.php",{	totalBarangAlatTulis : true },function(responseText) {	
		$("#totalBarangAlatTulis").html(responseText);
	});
	
	// Jumlah Barang Kendaraan
	$.post("files_backend_ajax/backend_data_barang.php",{ totalBarangKendaraan : true },function(responseText) {
		$("#totalBarangKendaraan").html(responseText);
	});
	
	// Jumlah Barang Lainnya
	$.post("files_backend_ajax/backend_data_barang.php",{	totalBarangLainnya 	: true },function(responseText) {
		$("#totalBarangLainnya").html(responseText);
	});
	// Total pengeluaran
	$.post("files_backend_ajax/backend_data_barang.php",{	totalPengeluaran : true },function(responseText) {
		$("#totalPengeluaran").html(responseText);
	});

	// Filter Jenis Barang
	$("#filterJenisBarang").change(function() {
		let valFilterJenisBarang = $("#filterJenisBarang").val();
		switch(valFilterJenisBarang) {
			case "Filter Semua" : 
			$.post("files_backend_ajax/backend_data_barang.php",{ filterSemua : true }, function(responseText) {
				$("#tabelBarang").html(responseText);
			});
			break;
			case "Elektronik" : 
			$.post("files_backend_ajax/backend_data_barang.php",{ filterElektronik : true }, function(responseText) {
				$("#tabelBarang").html(responseText);
			});
			break;
			case "Alat Tulis" : 
			$.post("files_backend_ajax/backend_data_barang.php",{ filterAlatTulis : true }, function(responseText) {
				$("#tabelBarang").html(responseText);
			});
			break;
			case "Kendaraan" : 
			$.post("files_backend_ajax/backend_data_barang.php",{ filterKendaraan : true }, function(responseText) {
				$("#tabelBarang").html(responseText);
			});
			break;
			case "Lainnya" : 
			$.post("files_backend_ajax/backend_data_barang.php",{ filterLainnya : true }, function(responseText) {
				$("#tabelBarang").html(responseText);
			});
			break;			
		}
	});

	searchTabelAJAX("#searchBarang", "files_backend_ajax/backend_data_barang.php", "#tabelBarang", "Nama barang tidak ditemukan");

	// Pagination Tabel Barang
	paginationTabel("files_backend_ajax/backend_data_barang.php", "#tabelBarang");
}); // END EVENT LOAD