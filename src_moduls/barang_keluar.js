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
	
	// Search nama barang
	$("#searchBarang").keyup(function() {
		let inputVal = $("#searchBarang").val().trim()
		$.post("files_backend_ajax/backend_barang_keluar.php",{
			searchBarang 	: inputVal
		},function(responseText) {
			if (responseText === "Nama Barang Tidak Ditemukan") {
				$("#pesan").html(responseText);
				$("#pesan").show();
			}
			else {
				$("#pesan").hide();
				$("#tabelBarangKeluar").html(responseText);
			}
		});
	});
	
	// Pagination Tabel Barang
	$.ajax({
		url 	: "files_backend_ajax/backend_barang_keluar.php",
		type 	: "POST",
		data 	: { paginationTabelBarangKeluar : true },
		success : function(responseText) {
			$("#page-list").html(responseText);
		}
	});
	
	$("#page-next").click(function() {
		$.ajax({
			url 	: "files_backend_ajax/backend_barang_keluar.php",
			type 	: "POST",
			data 	: { pageNext : true },
			success : function(responseText) {
				let pageListChildrenLength 	= $("#page-list").children().length;
				let dataPage 				= $(".page-actived").data("page") + 1;
				$("#tabelBarangKeluar").html(responseText);
				for (let i = 1; i <= pageListChildrenLength; i++) {
					if (dataPage == i) {
						$(".page-circle").removeClass("page-actived");
						$(`#page-${i}.page-circle`).addClass("page-actived");
					}
				}
			}
		});
	});
}); // END EVENT LOAD