// Button Edit Karyawan
function buttonEditKaryawan(event, button) {
	event.stopPropagation();
	let dataKodeKaryawan  	= $(button).data('kode');
	let dataNamaKaryawan  	= $(button).data('nama');
	let getUrlValue 			= `?kode_karyawan=${dataKodeKaryawan}&nama_karyawan=${dataNamaKaryawan}`;			
	location.assign("edit_karyawan.php" + getUrlValue);
}

// Button Hapus Karyawan
function buttonHapusKaryawan(event, button) {
	event.stopPropagation();
	let confirmHapusKaryawan 	= confirm("Apakah Anda Yakin Ingin Menghapus Karyawan?");
	let kodeKaryawan 				= $(button).data("kode");
	if (confirmHapusKaryawan) {
		// Query hapus karyawan
		$.post("files_backend_ajax/backend_daftar_karyawan.php",{ hapusKaryawan : kodeKaryawan }, function(responseText, success) {
			location.assign("daftar_pegawai.php?berhasil_dihapus=" + encodeURIComponent(responseText));
		});
	}
}

function pageLink(button) {
	let dataPage 						= $(button).data("page");
	let pageListChildrenLength 	= $("#page-list").children().length;
	$.ajax({
		url 	: "files_backend_ajax/backend_daftar_karyawan.php",
		type 	: "POST",
		data 	: { pageListTabelKaryawan : dataPage, pageListChildrenLength : pageListChildrenLength },
		success : function(responseText) {
			$("#tabelKaryawan").html(responseText);
		}
	});
	for (let i = 1; i <= pageListChildrenLength; i++) {
		if (dataPage == i) {
			$(".page-circle").removeClass("page-actived");	
			$(button).addClass("page-actived");
		}
	}
}

// Load Event =========================================>>
$(document).ready(function() {
	"use strict";

	$("#pesan").hide();
	hidePesanLoad();

	let valPesanLoad 	= $("#pesanLoad").text().trim();
	

	// Muncul Tabel Saat Load Pertama Kali
	$.post("files_backend_ajax/backend_daftar_karyawan.php",{
		tabelKaryawan 	: true
	},function(responseText) {
		$("#tabelKaryawan").html(responseText);
		
		$(".TRKaryawan").click(function() {
			let dataKodeKaryawan = $(this).data("kode");
			let dataNamaKaryawan = $(this).data("nama")
			location.assign(
				"barang_inventaris_karyawan.php?kode_karyawan=" + encodeURIComponent(dataKodeKaryawan) + 
				"&nama_karyawan=" + encodeURIComponent(dataNamaKaryawan)
			);
		})
	});

	ajaxHidePageNext("files_backend_ajax/backend_daftar_karyawan.php", null);
	
	// Total Karyawan
	$.post("files_backend_ajax/backend_daftar_karyawan.php",{totalKaryawan : true},function(responseText) {	
		$("#totalKaryawan").html(responseText);
	});
	
	// Search Tabel
	// $("#pesan").hide(); // Hide Saat Load Pertama Kali
	searchTabelAJAX("#search", "files_backend_ajax/backend_daftar_karyawan.php", "#tabelKaryawan", "Nama karyawan tidak ditemukan");

	// Pagination Tabel Karyawan
	paginationTabel("files_backend_ajax/backend_daftar_karyawan.php", "#tabelKaryawan");

});