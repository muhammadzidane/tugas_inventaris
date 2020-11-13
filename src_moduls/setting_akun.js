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
				updateJenisRole 	: true,
				valUsername 		: dataUsername,
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

	$("#tambahAkun").click(function() {
		location.assign("tambah_akun.php");
	});

	$("#ubahPassword").click(function() {
		let valUsername = $("#username").text();
		location.assign("ubah_password.php?username=" + valUsername);
	});

	// Search nama barang
	$("#searchUsername").keyup(function() {
		let inputVal = $("#searchUsername").val().trim()
		$.post("files_backend_ajax/backend_setting_akun.php",{
			searchUsername 	: inputVal
		},function(responseText) {
			if (responseText == "Username tidak ditemukan") {
				$("#pesan").html(responseText);
				$("#pesan").show();
			}
			else {
				$("#pesan").hide();
				$("#tabelUsers").html(responseText);
			}
			console.log(responseText);
		});
	});

	// Pagination username
	$.ajax({
		url 	: "files_backend_ajax/backend_setting_akun.php",
		type 	: "POST",
		data 	: { paginationTabelUsername : true },
		success : function(responseText) {
			$("#page-list").html(responseText);
		}
	});

	// Page Next
	$("#page-next").click(function() {
		let dataPage 						= $(".page-actived").data("page") + 1;
		let pageListChildrenLength 	= $("#page-list").children().length;
		$.ajax({
			url 	: "files_backend_ajax/backend_setting_akun.php",
			type 	: "POST",
			data 	: { pageNext : dataPage },
			success : function(responseText) {
				$("#tabelUsers").html(responseText);
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