"use strict";

		// Button Hapus Karyawan
		function ambilKodeKaryawan(button){
			let kodeKaryawan = $(button).data("prim");
			$.post("ajax.php",{ hapusKaryawan : kodeKaryawan }, function(responseText) {
				$("#pesan").show();
				$("#pesan").html(responseText);
			});

			$.post("ajax.php",{ tampilkanKaryawan : true }, function(responseText) {
				$("#tabelKaryawan").html(responseText);
			})
		}

		// Load Event 
		$(document).ready(function() {
			// Muncul Tabel Saat Load Pertama Kali
			$.post("ajax.php",{
				role 			: true,
				tabelKaryawan 	: true
			},function(responseText) {	
				$("#tabelKaryawan").html(responseText);
			});

			// Total Karyawan
			$.post("ajax.php",{totalKaryawan : true},function(responseText) {	
				$("#totalKaryawan").html(responseText);
			});

			// Search Tabel
			$("#pesan").hide(); // Hide Saat Load Pertama Kali
			$("#search").keyup(function() {
				let inputVal = $("#search").val().trim()
				$.post("ajax.php",{
					searchTabelKaryawan	: true,
					searchValKaryawan 	: inputVal
				},function(responseText) {
					if (responseText === "User Tidak Ditemukan") {
						$("#pesan").html(responseText);
						$("#pesan").show();
					}
					else {
						$("#pesan").hide();
						$("#tabelKaryawan").html(responseText);
					}
					console.log(responseText)
				});
			});

			console.log(document.getElementsByClassName('hapusKaryawan'));
			// Logout
			$("#logout").click(function() {
				location.replace("index.php");
			});
		});