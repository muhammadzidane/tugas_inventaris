$(document).ready(function() {
	"use strict";	

	$("#form").css({"height" : "700px"});

	// Validasi username
	$("#username").keyup(function() {
		let valUsername 	= $(this).val();
		if (valUsername.length <= 3 || valUsername.length > 12 ) {
			$(this).next().html("minimal 4 karakter, dan maksimal 12");
			$("#checkAndTimesUsername").html("<i class='far fa-times-circle text-danger'></i>");
		}
		else if (valUsername.length > 3) {
			$("#checkAndTimesUsername").html("<i class='far fa-check-circle text-success'></i>");
			$(this).next().html("");
			$.ajax({
				url 		: "files_backend_ajax/backend_setting_akun.php",
				type 		: "POST",
				data 		: { validasiUsername : valUsername },
				success 	: function(responseText) {
					if (responseText != "berhasil") {
						$("#checkAndTimesUsername").html("<i class='far fa-times-circle text-danger'></i>");
						$("#username").next().html(responseText);
					}
					else {	
						$("#checkAndTimesUsername").html("<i class='far fa-check-circle text-success'></i>");	
					}
				}
			});
		}
		
		hapusPesanDanCheckAndTimes("#username");
	});
	// });

	// Validasi email
	$("#email").keyup(function() {
		let valEmail 	= $(this).val();
		let polaEmail 	= /.+@{1}gmail|yahoo\..+/;
		if (polaEmail.test(valEmail)) {
			$(this).next().html("");
			$("#checkAndTimesEmail").html("<i class='far fa-check-circle text-success'></i>");	
		} 
		else {
			$(this).next().html("Harap masukan Email dengan benar");
			$("#checkAndTimesEmail").html("<i class='far fa-times-circle text-danger'></i>");
		}

		hapusPesanDanCheckAndTimes("#email");
	});

	// Validasi password
	$("#password").keyup(function() {
		let valPassword = $(this).val();
		if (valPassword.length <= 5) {
			$(this).next().html("Minimal 6 karakter");
			$("#checkAndTimesPassword").html("<i class='far fa-times-circle text-danger'></i>");
		}
		else {
			$(this).next().html("");
			$("#checkAndTimesPassword").html("<i class='far fa-check-circle text-success'></i>");	
		}

		hapusPesanDanCheckAndTimes("#password");
	});

	// Validasi ulangi password
	$("#ulangiPassword").keyup(function() {
		let valUlangiPassword 	= $(this).val();
		let valPassword 		= $("#password").val(); 
		if (valUlangiPassword != valPassword) {
			$(this).next().html("Password tidak sama");
			$("#checkAndTimesUlangiPassword").html("<i class='far fa-times-circle text-danger'></i>");
		}
		else {
			$(this).next().html("");
			$("#checkAndTimesUlangiPassword").html("<i class='far fa-check-circle text-success'></i>");
		}
		hapusPesanDanCheckAndTimes("#ulangiPassword");
	});

	// Button tambah akun
	$("#buttonTambahAkun").click(function(e) {
		let confirmTambahAkun 	= confirm("Apakah anda yakin ingin menambah akun?");

		if (confirmTambahAkun) {
			let valUsername 			= $("#username").val();
			let valEmail 				= $("#email").val();
			let valPassword 			= $("#password").val();
			let valUlangiPassword 	= $("#ulangiPassword").val();
			let valJenisRole 			= $("#jenisRole").val();


			validasiKosong(valUsername,"#username");
			validasiKosong(valEmail,"#email");
			validasiKosong(valPassword, "#password");
			validasiKosong(valUlangiPassword,"#ulangiPassword");

			if ($(".pesanValidasi").text() == "") {
				$(form).submit();
			}
			else {
				e.preventDefault();
			}
		}
	});

	// Button Batalkan Tambah Barang
	$("#buttonBatal").click(function(e) {
		e.preventDefault();
		location.assign("setting_akun.php");
	});

	// Button Batalkan Tambah Barang (Simbol Close)
	$("#closeForm").click(function(e) {
		e.preventDefault();
		location.replace("setting_akun.php");
	});
});