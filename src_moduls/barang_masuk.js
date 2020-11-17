"use strict";
// Non Load Event ====================================================================== >>
function pageLink(button) {
	let dataPage 				= $(button).data("page");
	let pageListChildrenLength 	= $("#page-list").children().length;
	$.ajax({
		url 		: "files_backend_ajax/backend_barang_masuk.php",
		type 		: "POST",
		data 		: { pageListTabelBarangMasuk : dataPage, pageListChildrenLength : pageListChildrenLength },
		success	: function(responseText) {
			$("#tabelBarangMasuk").html(responseText);
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
		url 		:"files_backend_ajax/backend_barang_masuk.php",
		type 		: "POST",
		data 		: { tabelBarangMasuk : true },
		success		:function(responseText) {	
			$("#pesan").hide();
			$("#tabelBarangMasuk").html(responseText);
		}
	});

	// Filter Jenis Barang
	$("#filterJenisBarang").change(function() {
		let valFilterJenisBarang = $("#filterJenisBarang").val();
		switch(valFilterJenisBarang) {
			case "Filter Semua" : 
			$.post("files_backend_ajax/backend_barang_masuk.php",{ filterSemua : true }, function(responseText) {
				$("#tabelBarangMasuk").html(responseText);
			});
			break;
			case "Elektronik" : 
			$.post("files_backend_ajax/backend_barang_masuk.php",{ filterElektronik : true }, function(responseText) {
				$("#tabelBarangMasuk").html(responseText);
			});
			break;
			case "Alat Tulis" : 
			$.post("files_backend_ajax/backend_barang_masuk.php",{ filterAlatTulis : true }, function(responseText) {
				$("#tabelBarangMasuk").html(responseText);
			});
			break;
			case "Kendaraan" : 
			$.post("files_backend_ajax/backend_barang_masuk.php",{ filterKendaraan : true }, function(responseText) {
				$("#tabelBarangMasuk").html(responseText);
			});
			break;
			case "Lainnya" : 
			$.post("files_backend_ajax/backend_barang_masuk.php",{ filterLainnya : true }, function(responseText) {
				$("#tabelBarangMasuk").html(responseText);
			});
			break;			
		}
	});

	// Search nama barang
	searchTabelAJAX("#searchBarang", "files_backend_ajax/backend_barang_masuk.php", "#tabelBarangMasuk", "Nama barang tidak ditemukan");

	// Pagination Tabel Barang
	$.ajax({
		url 	: "files_backend_ajax/backend_barang_masuk.php",
		type 	: "POST",
		data 	: { paginationTabelBarangMasuk : true },
		success : function(responseText) {
			$("#page-list").html(responseText);
		}
	});

	$("#page-next").click(function() {
		let dataPage 						= $(".page-actived").data("page") + 1;
		let pageListChildrenLength 	= $("#page-list").children().length;
		$.ajax({
			url 	: "files_backend_ajax/backend_barang_masuk.php",
			type 	: "POST",
			data 	: { pageNext : dataPage },
			success : function(responseText) {
				$("#tabelBarangMasuk").html(responseText);
				for (let i = 1; i <= pageListChildrenLength; i++) {
					if (dataPage == i) {
						$(".page-circle").removeClass("page-actived");
						$(`#page-${i}.page-circle`).addClass("page-actived");
					}
				}
			}
		});
	});

	// Logout
	$("#logout").click(function() {
		location.replace("index.php");
	});
});// END LOAD EVENT