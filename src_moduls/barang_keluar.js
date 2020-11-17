"use strict";



// Non Load Event ====================================================================== >>
function pageLink(button) {
	let dataPage 				= $(button).data("page");
	let pageListChildrenLength 	= $("#page-list").children().length;
	$.ajax({
		url 		: "files_backend_ajax/backend_barang_keluar.php",
		type 		: "POST",
		data 		: { pageListTabelBarangKeluar : dataPage, pageListChildrenLength : pageListChildrenLength },
		success	: function(responseText) {
			$("#tabelBarangKeluar").html(responseText);
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
	
	// Muncul Tabel Saat Load Pertama Kali
	$.ajax({
		url 		:"files_backend_ajax/backend_barang_keluar.php",
		type 		: "POST",
		data 		: { tabelBarangKeluar : true },
		success		:function(responseText) {	
			$("#pesan").hide();
			$("#tabelBarangKeluar").html(responseText);
		}
	});
	
	ajaxHidePageNext("files_backend_ajax/backend_barang_keluar.php", null);

	// Jumlah Semua Barang
	$.post("files_backend_ajax/backend_barang_keluar.php",{ totalSemuaBarang : true },function(responseText) {	
		$("#totalSemuaBarang").html(responseText);
	});
	
	// Jumlah Barang Elektronik
	$.post("files_backend_ajax/backend_barang_keluar.php",{ totalBarangElektronik : true },function(responseText) {	
		$("#totalBarangElektronik").html(responseText);
	});
	
	// Jumlah Barang Alat Tulis
	$.post("files_backend_ajax/backend_barang_keluar.php",{	totalBarangAlatTulis : true },function(responseText) {	
		$("#totalBarangAlatTulis").html(responseText);
	});
	
	// Jumlah Barang Kendaraan
	$.post("files_backend_ajax/backend_barang_keluar.php",{ totalBarangKendaraan : true },function(responseText) {
		$("#totalBarangKendaraan").html(responseText);
	});
	
	// Jumlah Barang Lainnya
	$.post("files_backend_ajax/backend_barang_keluar.php",{	totalBarangLainnya 	: true },function(responseText) {
		$("#totalBarangLainnya").html(responseText);
	});

	// Filter Jenis Barang
	$("#filterJenisBarang").change(function() {
		let valFilterJenisBarang = $("#filterJenisBarang").val();
		switch(valFilterJenisBarang) {
			case "Filter Semua" : 
			$.post("files_backend_ajax/backend_barang_keluar.php",{ filterSemua : true }, function(responseText) {
				$("#tabelBarangKeluar").html(responseText);
			});
			break;
			case "Elektronik" : 
			$.post("files_backend_ajax/backend_barang_keluar.php",{ filterElektronik : true }, function(responseText) {
				$("#tabelBarangKeluar").html(responseText);
			});
			break;
			case "Alat Tulis" : 
			$.post("files_backend_ajax/backend_barang_keluar.php",{ filterAlatTulis : true }, function(responseText) {
				$("#tabelBarangKeluar").html(responseText);
			});
			break;
			case "Kendaraan" : 
			$.post("files_backend_ajax/backend_barang_keluar.php",{ filterKendaraan : true }, function(responseText) {
				$("#tabelBarangKeluar").html(responseText);
			});
			break;
			case "Lainnya" : 
			$.post("files_backend_ajax/backend_barang_keluar.php",{ filterLainnya : true }, function(responseText) {
				$("#tabelBarangKeluar").html(responseText);
			});
			break;			
		}
	});
	
	searchTabelAJAX("#searchBarang", "files_backend_ajax/backend_barang_keluar.php", "#tabelBarangKeluar", "Nama barang tidak ditemukan");
	
	// Pagination Tabel Barang
	paginationTabel("files_backend_ajax/backend_barang_keluar.php", "#tabelBarangKeluar");
}); // END EVENT loa