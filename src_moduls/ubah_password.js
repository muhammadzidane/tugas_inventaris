$(document).ready(function() {
	"use strict";
	
	$("#form").css({"height" : "600px"});
	
	$("#masukanPasswordLama").focus(function() {
		$("#masukanPasswordLama").next().html("");
	});
	
	$("#buttonUbah").click(function(e) {
		let confirmUbahPassword 	= confirm("Apakah anda yakin ingin mengubah password?");
		let valUsername 				= $("#username").val();
		let valMasukanPasswordLama = $("#masukanPasswordLama").val();
		let valPasswordBaru 			= $("#passwordBaru").val();
		let valUlangiPassword 		= $("#ulangiPassword").val();
	
		if (valMasukanPasswordLama == "") {
			$("#masukanPasswordLama").next().html("<small>Tidak boleh kosong</small>");
		}
		else {
			$.ajax({
				url 	: "files_backend_ajax/backend_setting_akun.php",
				type 	: "POST",
				data 	: { 
					validasiPassword 			: true, 
					valUsername 				: valUsername,
					valMasukanPasswordLama 	: valMasukanPasswordLama, 
				},
				success : function (responseText) {
					if (responseText == "berhasil") {
						$("#masukanPasswordLama").next().html("");
					}
					else {
						$("#masukanPasswordLama").next().html(responseText);
					}
				}
			});
		}
		
		if (valPasswordBaru != valUlangiPassword) {
			$("#ulangiPassword").next().html("<small>Password tidak sama</small>");
		}
		else {
			$("#ulangiPassword").next().html("");	
		}
		
		validasiMinimalLength(valPasswordBaru, "#passwordBaru", 6);
		validasiMinimalLength(valUlangiPassword, "#ulangiPassword", 6);
		validasiKosong(valPasswordBaru, "#passwordBaru");
		validasiKosong(valUlangiPassword, "#ulangiPassword");
		
		if ($(".pesanValidasi").text() != "") {
			e.preventDefault();
		}
		else {
			$("form").submit();
		}
	});
	
	buttonBatalHeaderLocation("#buttonBatal", "setting_akun.php");
});