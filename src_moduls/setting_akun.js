"use strict";

function pageLink(button) {
	let dataPage 				= $(button).data("page");
	let pageListChildrenLength 	= $("#page-list").children().length;
	$.ajax({
		url 	: "files_backend_ajax/backend_setting_akun.php",
		type 	: "POST",
		data 	: { pageListTabelUsers : dataPage, pageListChildrenLength : pageListChildrenLength },
		success : function(responseText) {
			$("#tabelUsers").html(responseText);
		}
	});
	for (let i = 1; i <= pageListChildrenLength; i++) {
		if (dataPage == i) {
			$(".page-circle").removeClass("page-actived");	
			$(button).addClass("page-actived");
		}
	}
}

function buttonUbahRole(event, button){
	let dataUsername  		= $(button).data("username");
	$.ajax({
		url 	: "files_backend_ajax/backend_setting_akun.php",
		type 	: "POST",
		data 	: { dataUsername : dataUsername },
		success : function(responseText) {
			$("#tabelUsers").html(responseText);
		}
	});
}

function buttonBatalUbahRole(event, button) {
	$.ajax({
		url 		:"files_backend_ajax/backend_setting_akun.php",
		type 		: "POST",
		data 		: { tabelUsers : true },
		success		:function(responseText) {	
			$("#pesan").hide();
			$("#tabelUsers").html(responseText);
		}	
	});
}

function buttonUpdateJenisRole(event, button) {
	let dataUsername 			= $(button).data("username");
	let confirmUpdate 		= confirm("Apakah anda yakin ingin mengubah jenis role?");
	let valSelectJenisRole 	= $("#selectJenisRole").val();
	if (confirmUpdate) {
		$.ajax({
			url 	: "files_backend_ajax/backend_setting_akun.php",
			type 	: "POST",
			data 	: { 
				updateJenisRole 		: true,
				valUsername 			: dataUsername,
				valSelectJenisRole 	: valSelectJenisRole
			},
			success : function(responseText) {
				location.assign("setting_akun.php?ubah-role=" + encodeURIComponent(responseText));
			}
		});		
	}
}

function buttonHapusUser(event, button) {
	let dataUsername  		= $(button).data("username");
	let confirmHapusUser 	= confirm("Apakah anda yakin ingin menghapus user ?");
	
	if (confirmHapusUser) {
		$.ajax({
			url 		:"files_backend_ajax/backend_setting_akun.php",
			type 		: "POST",
			data 		: { hapusUser : dataUsername },
			success		:function(responseText) {	
				location.assign(`setting_akun.php?hapus=${encodeURIComponent(responseText)}`);	
			}	
		});		
	} 
}

// Load Event =========================================>>
$(document).ready(function() {
	$("#pesan").hide();
	hidePesanLoad();

	// Muncul tabel saat pertama load
	$.ajax({
		url 		:"files_backend_ajax/backend_setting_akun.php",
		type 		: "POST",
		data 		: { tabelUsers : true },
		success		:function(responseText) {	
			$("#tabelUsers").html(responseText);
		}	
	});

	ajaxHidePageNext("files_backend_ajax/backend_setting_akun.php", null);

	$("#tambahAkun").click(function() {
		location.assign("tambah_akun.php");
	});

	$("#ubahPassword").click(function() {
		let valUsername = $("#username").text();
		location.assign("ubah_password.php?username=" + valUsername);
	});

	// Search nama barang
	searchTabelAJAX("#searchUsername", "files_backend_ajax/backend_setting_akun.php", "#tabelUsers", "Username tidak ditemukan");

	// Pagination username
	paginationTabel("files_backend_ajax/backend_setting_akun.php", "#tabelUsers");
});