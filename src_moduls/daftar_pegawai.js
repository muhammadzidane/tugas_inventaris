
"use strict";

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
	$("#pesan").hide();

	let valPesanLoad 	= $("#pesanLoad").text().trim();
	
	if (valPesanLoad == "") {
		$("#pesanLoad").hide();
	}
	else {
		$("#pesanLoad").show();
	}

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
	
	// Total Karyawan
	$.post("files_backend_ajax/backend_daftar_karyawan.php",{totalKaryawan : true},function(responseText) {	
		$("#totalKaryawan").html(responseText);
	});
	
	// Search Tabel
	// $("#pesan").hide(); // Hide Saat Load Pertama Kali
	$("#search").keyup(function() {
		let valSearch = $("#search").val().trim()
		$.post("files_backend_ajax/backend_daftar_karyawan.php",{
			searchKaryawan 	: valSearch
		},function(responseText) {
			if (responseText == "User Tidak Ditemukan") {
				$("#pesan").html(responseText);
				$("#pesan").show();
			}
			else {
				$("#pesan").hide();
				$("#tabelKaryawan").html(responseText);
			}
		});
	});

	// Tambah Karyawan Baru
	$("#tambahKaryawan").click(function() {
		location.assign("tambah_karyawan.php");
	});

	// Pagination Tabel Karyawan
	$.ajax({
		url 	: "files_backend_ajax/backend_daftar_karyawan.php",
		type 	: "POST",
		data 	: { paginationTabelKaryawan : true },
		success : function(responseText) {
			$("#page-list").html(responseText);
		}
	});

	// Page Next
	$("#page-next").click(function() {
		let dataPage 			= $(".page-actived").data("page") + 1;
		let pageListChildrenLength 	= $("#page-list").children().length;
		$.ajax({
			url 	: "files_backend_ajax/backend_daftar_karyawan.php",
			type 	: "POST",
			data 	: { pageNext : dataPage },
			success : function(responseText) {
				$("#tabelKaryawan").html(responseText);
				for (let i = 1; i <= pageListChildrenLength; i++) {
					if (dataPage == i) {
						$(".page-circle").removeClass("page-actived");
						$(`#page-${i}.page-circle`).addClass("page-actived");
					}
				}
			}
		});
	});

});