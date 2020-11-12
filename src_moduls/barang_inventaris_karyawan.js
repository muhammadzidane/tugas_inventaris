"use strict";

// Mengambil text nama dan kode karyawan 
let kodeKaryawan 	= $("#kodeKaryawan").text();
let namaKaryawan 	= $("#namaKaryawan").text();

function pageLink(button) {
	let dataPage 					= $(button).data("page");
	let pageListChildrenLength = $("#page-list").children().length;
	$.ajax({
		url 	: "files_backend_ajax/backend_barang_inventaris_karyawan.php",
		type 	: "POST",
		data 	: { 
			pageListTabelBarang 		: dataPage,
			kodeKaryawan				: "<?= $url_kode_karyawan ?>", 
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
	let jumlahBarang 		 = $(button).parent().prev().prev().prev().prev();
	let dataKodeBarang 	 = $(button).data("kode");
	let valJumlahBarang 	 = $(button).parent().prev().prev().prev().prev().text();
	let removeTRNextAll   = $(button).parent().parent().nextAll();
	let removeTRPrevUntil = $(button).parent().parent().prevUntil(".tableFirstChild");
	let tableAppend 		 = "";
	tableAppend 			+= "<tr>";
	tableAppend				+= "<td></td>";
	tableAppend				+= "<td></td>";
	tableAppend				+=	"<td></td>";
	tableAppend				+=	"<td></td>";
	tableAppend				+=	"<td>";
	tableAppend				+=	"<input id='jumlahTambahBarang' placeholder='Jumlah'";
	tableAppend				+=	"class='form-control form-control-sm' type='number' min='0'>";
	tableAppend				+=	"</td>";
	tableAppend				+=	"<td><input id='tanggal_masuk' class='form-control form-control-sm' type='date'></td>";
	tableAppend				+=	"<td></td>";
	tableAppend				+=	"<td><button onclick='buttonQueryTambah(event, this);'";
	tableAppend				+=	`class='btn btn-primary' data-kode='${dataKodeBarang}' data-jumlah-awal='${valJumlahBarang}'>Tambah</button></td>`;
	tableAppend				+=	"<td><button onclick='buttonBatal(event, this);' class='btn btn-warning text-white'>Batal</button></td>";
	tableAppend 			+= "</tr>";
	removeTRNextAll.remove();
	removeTRPrevUntil.remove();
	$("table").append(tableAppend);
	$("#jumlahTambahBarang").keyup(function() {
		let valKUJumlahTambahBarang = $(this).val();
		for (let i = 1; i <= valJumlahBarang; i++) {
			if (valKUJumlahTambahBarang == i) {
				jumlahBarang.html(valJumlahBarang - i);
			}
		}
		for (let i = valJumlahBarang; i <= 0; i--) {	
			if (valKUJumlahTambahBarang == i) {
				jumlahBarang.html(valJumlahBarang + i);
			}
		}
		
		if (valKUJumlahTambahBarang == 0) {
			jumlahBarang.html(valJumlahBarang);
		}
		$(this).attr("max", valJumlahBarang);
	});
	$("#jumlahTambahBarang").click(function() {
		$(this).keyup();
	});
}

// Ajax tambah barang
function buttonQueryTambah(event, button) {
	let jumlahAwalBarang 	= $(button).data("jumlah-awal");
	let valJumlahBarang  	= $("#jumlahTambahBarang").val();
	let valTanggalMasuk  	= $("#tanggal_masuk").val();
	let dataKodeBarang 		= $(button).data("kode");
	let confirmTambah 		= confirm("Apakah anda yakin ingin menambahkan barang?");
	if (confirmTambah) {
		if (valJumlahBarang == 0 || "" || valTanggalMasuk == "") {
			event.preventDefault();	
		}
		else {
			$.ajax({
				url 		: "files_backend_ajax/backend_barang_inventaris_karyawan.php",
				type 		: "POST",
				data 		: {
					queryTambahBarang	: dataKodeBarang,
					valJumlahBarang 	: valJumlahBarang,
					valTanggalMasuk 	: valTanggalMasuk,
					jumlahAwalBarang 	: jumlahAwalBarang,
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
}

// Hapus barang
function buttonHapusBarang(event, button) {
	let dataKodeBarang 	 	 = $(button).data("kode");
	let jumlahAwalBarang 	 = $(button).parent().prev().prev().prev().prev().prev();
	let valJumlahAwalBarang  = $(button).parent().prev().prev().prev().prev().prev().text();
	
	tableAppend("tb_barang_inventaris_karyawan", $(button));
	eventsTableAppend(jumlahAwalBarang, valJumlahAwalBarang);
	
	
	$("#buttonQueryHapus").click(function(e) {
		let confirmHapusBarang 		= confirm("Apakah anda yakin ingin menghapus data barang?");
		let valJumlah 					= $("#jumlah").val();
	
		validasiKosong(valJumlah, "#jumlah");
		validasiKosong(valTanggalMasuk, "#tanggalMasuk");
		
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

// Load Event =========================================>>
$(document).ready(function() {
	$("#pesan").hide();
	hidePesanLoad();

	// Muncul tabel saat pertama load
	$.ajax({
		url 		: "files_backend_ajax/backend_barang_inventaris_karyawan.php",
		type 		: "POST",
		data 		: { tabelBarangInvKaryawan : kodeKaryawan },
		success		:function(responseText) {	
			$("#tabelBarangInvKaryawan").html(responseText);
			$(".buttonTambah").hide();
		}	
	});

	// Search nama barang
	$("#searchBarang").keyup(function() {
		let inputVal = $("#searchBarang").val().trim()
		$.post("files_backend_ajax/backend_barang_inventaris_karyawan.php",{
			searchBarang 	: inputVal, kodeKaryawan : kodeKaryawan
		},function(responseText) {
			if (responseText == "Barang Tidak Ditemukan") {
				$("#pesan").html(responseText);
				$("#pesan").show();
			}
			else {
				$("#pesan").hide();
				$("#tabelBarangInvKaryawan").html(responseText);
				$(".buttonTambah").hide();
			}
		});
	});
	
	// Pagination Tabel Barang
	$.ajax({
		url 	: "files_backend_ajax/backend_barang_inventaris_karyawan.php",
		type 	: "POST",
		data 	: { paginationTabelBarang : kodeKaryawan },
		success : function(responseText) {
			$("#page-list").html(responseText);
		}
	});
	
	// Page Next
	$("#page-next").click(function() {
		let dataPage 						= $(".page-actived").data("page") + 1;
		let pageListChildrenLength 	= $("#page-list").children().length;
		$.ajax({
			url 	: "files_backend_ajax/backend_barang_inventaris_karyawan.php",
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
	$.post("files_backend_ajax/backend_daftar_karyawan.php",{	totalBarangLainnya 	: kodeKaryawan },function(responseText) {
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
	});
	$("#batalTambahBarangInv").click(function() {
		$(this).html("");
		$("#dataBarang").html("");
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
});