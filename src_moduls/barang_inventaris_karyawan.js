"use strict";

// Mengambil text nama dan kode karyawan 
let kodeKaryawan 	= $("#kodeKaryawan").text();
let namaKaryawan 	= $("#namaKaryawan").text();

function buttonBatalTambahDanHapusBarang() {
	$("#buttonBatal").click(function() {
		$.ajax({
			url 		: "files_backend_ajax/backend_barang_inventaris_karyawan.php",
			type 		: "POST",
			data 		: { tabelBarangInvKaryawan : kodeKaryawan },
			success		:function(responseText) {	
				$("#tabelBarangInvKaryawan").html(responseText);
				$(".buttonTambah").hide();
			}	
		});
	});
}

function pageLink(button) {
	let dataPage 					= $(button).data("page");
	let pageListChildrenLength = $("#page-list").children().length;
	$.ajax({
		url 	: "files_backend_ajax/backend_barang_inventaris_karyawan.php",
		type 	: "POST",
		data 	: { 
			pageListTabelBarang 		: dataPage,
			kodeKaryawan				: kodeKaryawan, 
			pageListChildrenLength 	: pageListChildrenLength 
		},
		success : function(responseText) {
			$("#tabelBarangInvKaryawan").html(responseText);
		}
	});

	for (let i = 1; i <= pageListChildrenLength; i++) {
		if (dataPage == i) {
			$(".page-circle").removeClass("page-actived");	
			$(button).addClass("page-actived");
		}
	}
}

// Tambah barang
function buttonTambahBarang(event, button) {
	let jumlahBarangNode 		= $(button).parent().prev().prev().prev().prev();
	let dataKodeBarang 	 		= $(button).data("kode");
	let valJumlahAwalBarang 	= $(button).parent().prev().prev().prev().prev().text();
	let removeTRNextAll   		= $(button).parent().parent().nextAll();
	let removeTRPrevUntil 		= $(button).parent().parent().prevUntil(".tableFirstChild");

	tableAppend("tb_barang_inventaris_karyawan_modul_tambah", $(button))
	eventsTableAppend(jumlahBarangNode, valJumlahAwalBarang);

	buttonBatalTambahDanHapusBarang();
	
	// Ajax tambah barang
	$("#buttonQueryTambah").click(function(e) {
		let valJumlahBarang  	= $("#jumlah").val();
		let valTanggalMasuk  	= $("#tanggal_masuk").val();

		let confirmTambah 		= confirm("Apakah anda yakin ingin menambahkan barang?");
		if (confirmTambah) {
			if (valJumlahBarang == 0 || "" || valTanggalMasuk == "") {
				e.preventDefault();	
			}
			else {
				$.ajax({
					url 		: "files_backend_ajax/backend_barang_inventaris_karyawan.php",
					type 		: "POST",
					data 		: {
						queryTambahBarang	: dataKodeBarang,
						valJumlahBarang 	: valJumlahBarang,
						valTanggalMasuk 	: valTanggalMasuk,
						jumlahAwalBarang 	: valJumlahAwalBarang,
						kodeKaryawan 		: kodeKaryawan,
						namaKaryawan 		: namaKaryawan
					},
					success 	: function(responseText) {
						let nama_karyawan = "&nama_karyawan=" + namaKaryawan;
						let kode_karyawan = "&kode_karyawan=" + kodeKaryawan
						location.assign("barang_inventaris_karyawan.php?berhasil-tambah-barang=" + encodeURIComponent(responseText) + nama_karyawan + kode_karyawan);
					}
				});
			}
		}

		buttonBatalTambahDanHapusBarang();
	});
}


// Hapus barang
function buttonHapusBarang(event, button) {
	let dataKodeBarang 	 	 = $(button).data("kode");
	let jumlahAwalBarang 	 = $(button).parent().prev().prev().prev().prev();
	let valJumlahAwalBarang  = $(button).parent().prev().prev().prev().prev().text();
	
	tableAppend("tb_barang_inventaris_karyawan_modul_hapus", $(button));
	eventsTableAppend(jumlahAwalBarang, valJumlahAwalBarang);
	
	$("#buttonQueryHapus").click(function(e) {
		let confirmHapusBarang 		= confirm("Apakah anda yakin ingin menghapus data barang?");
		let valJumlah 					= $("#jumlah").val();

		validasiKosong(valJumlah, "#jumlah");
		
		if (confirmHapusBarang) {	
			if ($(".pesanValidasi").text() == "") {
				$.ajax({
					url 		: "files_backend_ajax/backend_barang_inventaris_karyawan.php",
					type 		: "POST",
					data 		: { 
						hapusBarangInvKaryawan 	: dataKodeBarang,
						valJumlahAwalBarang 		: valJumlahAwalBarang,
						valJumlah					: valJumlah 
					},
					success	: function(responseText) {
						location.assign(
							"barang_inventaris_karyawan.php?berhasil_dihapus=" + encodeURIComponent(responseText) +
							"&kode_karyawan=" + encodeURIComponent(kodeKaryawan) + "&nama_karyawan=" + encodeURIComponent(namaKaryawan)
							);
					}
				});
			}
			else {
				e.preventDefault();
			}
		}
	});

	buttonBatalTambahDanHapusBarang();
}		


// Load Event =========================================>>
$(document).ready(function() {
	$("#pesan").hide();
	hidePesanLoad();

	// Muncul tabel saat pertama load
	$.ajax({
		url 		: "files_backend_ajax/backend_barang_inventaris_karyawan.php",
		type 		: "POST",
		data 		: { 
			tabelBarangInvKaryawan 	: kodeKaryawan 
		},
		success		:function(responseText) {	
			$("#tabelBarangInvKaryawan").html(responseText);
		}	
	});

	ajaxHidePageNext("files_backend_ajax/backend_barang_inventaris_karyawan.php", $("#kodeKaryawan").text());

	searchTabelAJAX(
		"#searchBarang", "files_backend_ajax/backend_barang_inventaris_karyawan.php", 
		"#tabelBarangInvKaryawan", "Nama barang tidak ditemukan"
	);
	
	// Pagination Tabel Barang
	paginationTabel("files_backend_ajax/backend_barang_inventaris_karyawan.php", "#tabelBarangInvKaryawan");


	// Jumlah Semua Barang
	$.post("files_backend_ajax/backend_barang_inventaris_karyawan.php",{ totalSemuaBarang : kodeKaryawan },function(responseText) {	
		$("#totalSemuaBarang").html(responseText);
	});
	
	// Jumlah Barang Elektronik
	$.post("files_backend_ajax/backend_barang_inventaris_karyawan.php",{ totalBarangElektronik : kodeKaryawan },function(responseText) {	
		$("#totalBarangElektronik").html(responseText);
	});
	
	// Jumlah Barang Alat Tulis
	$.post("files_backend_ajax/backend_barang_inventaris_karyawan.php",{	totalBarangAlatTulis : kodeKaryawan },function(responseText) {	
		$("#totalBarangAlatTulis").html(responseText);
	});
	
	// Jumlah Barang Kendaraan
	$.post("files_backend_ajax/backend_barang_inventaris_karyawan.php",{ totalBarangKendaraan : kodeKaryawan },function(responseText) {
		$("#totalBarangKendaraan").html(responseText);
	});
	
	// Jumlah Barang Lainnya
	$.post("files_backend_ajax/backend_barang_inventaris_karyawan.php",{	totalBarangLainnya 	: kodeKaryawan },function(responseText) {
		$("#totalBarangLainnya").html(responseText);
	});
	
	// Tambah barang inventaris untuk karyawan
	$("#tambahBarangInv").click(function(e) {
		$("#dataBarang").html("Data Barang").addClass("judul font-neue w-25").css("font-size", "30px");
		$("#batalTambahBarangInv").html("<button class='btn btn-warning text-white ml-1'>Batal</button>");
		$.ajax({
			url 		: "files_backend_ajax/backend_barang_inventaris_karyawan.php",
			type 		: "POST",
			data 		: { showTabelDataBarang : true },
			success		:function(responseText) {	
				$("#tabelBarangInvKaryawan").html(responseText);
				$(".buttonEdit").remove();
				$(".buttonHapus").remove();
			}
		});

		$("#searchBarang").addClass("searchDataBarang");

		$("#batalTambahBarangInv").click(function() {
			$("#searchBarang").removeClass("searchDataBarang");
			$(this).html("");
			$("#dataBarang").html("");
			$("#dataBarang").removeClass("judul");
			$.ajax({
				url 		: "files_backend_ajax/backend_barang_inventaris_karyawan.php",
				type 		: "POST",
				data 		: { tabelBarangInvKaryawan : kodeKaryawan },
				success		:function(responseText) {	
					$("#tabelBarangInvKaryawan").html(responseText);
					$(".buttonTambah").remove();
				}	
			});
		});

		$(".searchDataBarang").keyup(function() {
			let valInputNode 	= $(this).val(); 

			if ($("#dataBarang").text() != "") {
				$.ajax({
					url 		:"files_backend_ajax/backend_data_barang.php",
					type 		: "POST",
					data 		: { searchTabelDataBarang :valInputNode},
					success		:function(responseText) {	
						$("#tabelBarangInvKaryawan").html(responseText);
						$(".buttonHapus").remove();
						$(".buttonEdit").remove();
					}
				});
			}
		});


		let pageListChildrenLength 	= $("#page-list").children().length;
		for (let i = 1; i <= pageListChildrenLength; i++) {
			$("#page-" + i).removeAttr("onclick");
			$("#page-" + i).click(function() {
				let dataPage 						= $(this).data("page");
				$.ajax({
					url 		: "files_backend_ajax/backend_data_barang.php",
					type 		: "POST",
					data 		: { pageListTabelBarang : dataPage, pageListChildrenLength : pageListChildrenLength },
					success	: function(responseText) {
						$("#tabelBarangInvKaryawan").html(responseText);
						$(".buttonHapus").remove();
						$(".buttonEdit").remove();
						console.log(responseText);
					}
				});
				for (let i = 1; i <= pageListChildrenLength; i++) {
					if (dataPage == i) {
						$(".page-circle").removeClass("page-actived");	
						$(this).addClass("page-actived");
					}
				}
			});
		}
	});
});