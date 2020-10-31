"use strict";

		// Load Event TIDAK DI GUNAKAN !
		// Button Edit Karyawan
		function editKaryawan(button) {
			let kodeKaryawan  	 = $(button).data('edit');
			$.post('ajax.php',{ editKaryawan : kodeKaryawan },function(responseText, success) {
				$("#tabelKaryawan").html(responseText);
				if (success) {
					$.post('ajax.php',{ formEdit : true },function(responseText) {
						$("#tabelKaryawan").children().append(responseText);

						// Button ubah karyawan  
						$("#acceptUbah").click(function(e) {
							let confirmUbahKaryawan 	= confirm("Apakah Anda Yakin Ingin Mengubah Data Karyawan?");
							
							if (confirmUbahKaryawan) {
								// Ambil value dari input form baru
								let valKodeKaryawan 		= $("#kode_karyawan").val();
								let valNamaKaryawan 		= $("#nama_karyawan").val();
								let valPosisiJabatan 		= $("#posisi_jabatan").val();
								let valPendidikanTerakhir 	= $("#pendidikan_terakhir").val();
								let valEmail 				= $("#email").val();
								let valNomerHandphone 		= $("#nomer_handphone").val();
								let valAlamatLengkap 		= $("#alamat_lengkap").val();	
								let pesanEdit 				= "";

								function pesanEditKaryawan(variabel, value){
									if (variabel === "") {
										e.preventDefault();
										$(value).next().html("<small>Tidak boleh kosong</small>").css({
											"font-size" : "13px",
											"color" 	: "tomato"
										});
										$(value).focus(function() {
											$(value).next().html("");
										});
										pesanEdit += "ada";
									}
								}
								pesanEditKaryawan(valKodeKaryawan,"#kode_karyawan");
								pesanEditKaryawan(valNamaKaryawan,"#nama_karyawan");
								pesanEditKaryawan(valPosisiJabatan,"#posisi_jabatan");
								pesanEditKaryawan(valPendidikanTerakhir,"#pendidikan_terakhir");
								pesanEditKaryawan(valEmail,"#email");
								pesanEditKaryawan(valNomerHandphone,"#nomer_handphone");
								pesanEditKaryawan(valAlamatLengkap,"#alamat_lengkap");

								if (!pesanEdit) {
									$.post('ajax.php',{ 
										primKeyKodeKaryawan 	: kodeKaryawan,
										valKodeKaryawan 		: valKodeKaryawan,
										valNamaKaryawan 		: valNamaKaryawan,
										valPosisiJabatan 		: valPosisiJabatan,
										valPendidikanTerakhir 	: valPendidikanTerakhir,
										valEmail 				: valEmail,
										valNomerHandphone 		: valNomerHandphone,
										valAlamatLengkap 		: valAlamatLengkap
									}, function(responseText) {
										$("#pesan").show();
										$("#pesan").html(responseText);
									});	
								}
							// Tampilkan tabel saat berhasil meng-edit karyawan
							$.post('ajax.php',{ tabelKaryawan : true },function(responseText){
								$("#tabelKaryawan").html(responseText);
							});

						}
					});

						// Button batal ubah karyawan
						$("#batalEdit").click(function() {
							// Tampilkan tabel saat berhasil meng-edit karyawan
							$.post('ajax.php',{ tabelKaryawan : true },function(responseText){
								$("#tabelKaryawan").html(responseText);
							});
						});
					});
				}
			});
			console.log(kodeKaryawan);
		}


		// Button Hapus Karyawan
		function ambilKodeKaryawan(button){
			let confirmHapusKaryawan 	= confirm("Apakah Anda Yakin Ingin Menghapus Karyawan?");
			let kodeKaryawan 			= $(button).data("prim");
			if (confirmHapusKaryawan) {
				$.post("ajax.php",{ hapusKaryawan : kodeKaryawan }, function(responseText, success) {
					$("#pesan").show();
					$("#pesan").html(responseText);

					$.post("ajax.php",{ tampilkanKaryawan : true }, function(responseText) {
						$("#tabelKaryawan").html(responseText);
					});

					// Total karyawan berubah saat di hapus
					$.post("ajax.php",{totalKaryawan : true},function(responseText) {	
						$("#totalKaryawan").html(responseText);
					});
				});
			}
		}

		// Load Event ========================================= >>
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
				});
			});

			// Tambahkan Karyawan Baru
			$("#formTambahKaryawan").hide();
			$("#tambahKaryawan").click(function() {
				$.post('ajax.php',{ formTambahKaryawan : true },function(responseText) {
					$("#formTambahKaryawan").html(responseText);
					// Button Tambah
					$("#acceptTambahKaryawan").click(function(e) {
						e.preventDefault();
						let valKodeKaryawan 		= $("#kode_karyawan").val();
						let valNamaKaryawan 		= $("#nama_karyawan").val();
						let valPosisiJabatan 		= $("#posisi_jabatan").val();
						let valPendidikanTerakhir 	= $("#pendidikan_terakhir").val();
						let valEmail 				= $("#email").val();
						let valNomerHandphone 		= $("#nomer_handphone").val();
						let valAlamatLengkap 		= $("#alamat_lengkap").val();

						$.post('ajax.php',{
							acceptTambahKaryawan 	: true,
							valKodeKaryawan 		: valKodeKaryawan,
							valNamaKaryawan 		: valNamaKaryawan,
							valPosisiJabatan 		: valPosisiJabatan,
							valPendidikanTerakhir 	: valPendidikanTerakhir,
							valEmail 				: valEmail,
							valNomerHandphone 		: valNomerHandphone,
							valAlamatLengkap 		: valAlamatLengkap
						},function(responseText, success, xhr) {
							$("#pesan").html(responseText);
						});
					});
					// Button Batal
					$("#batalTambahKaryawan").click(function() {
						$("#formTambahKaryawan").slideUp(500);
					});
					
					$("#formTambahKaryawan").slideToggle(500);
				});
			});

			// Logout
			$("#logout").click(function() {
				location.replace("index.php");
			});
		});