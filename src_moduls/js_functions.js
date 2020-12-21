// Validasi input kosong
function validasiKosong(variabel, selector) {
	if (variabel == "") {
		$(selector).next().html("<small>Tidak boleh kosong</small>").addClass('pesanValidasi');
		$(selector).focus(function() {
			$(selector).next().html("");
		});
	}
}

// Validasi nomer
function validasiNomer(variabel, selector, jumlah) {
	let pola = /\D/;
	if (pola.test(variabel)) {
		$(selector).next().html("<small>Harus menggunakan angka</small>").addClass('pesanValidasi');
	}
	else if (variabel.length < jumlah || variabel.length > jumlah ) {
		$(selector).next().html(`<small>Harus memiliki ${jumlah} angka</small>`).addClass('pesanValidasi');
	}
	$(selector).focus(function() {
		$(selector).next().html("");
	});
}

// Validasi minimal length
function validasiMinimalLength(variabel, selector, jumlah) {
	if (variabel.length < jumlah) {
		$(selector).next().html(`<small>Harus memiliki minimal ${jumlah} karakter</small>`).addClass('pesanValidasi');
	}
	$(selector).focus(function() {
		$(selector).next().html("");
	});
}

// Validasi email
function validasiEmailEventClick(variabel, selector) {
	let polaEmail 	= /.+@{1}gmail|yahoo\..+/;
	if (polaEmail.test(variabel) == false) {
		$(selector).next().html("<small>Harap Masukan Email Dengan Benar</small>").addClass('pesanValidasi');
	}
	$(selector).focus(function() {
		$(selector).next().html("");
	});
}

function tableAppend(nama_tb_database, refThis) {
	let button 		 			 = refThis;
	let removeTRNextAll   	 = $(button).parent().parent().nextAll();
	let removeTRPrevUntil 	 = $(button).parent().parent().prevUntil(".tableFirstChild");

	let tableAppend 		 	 = "";

	tableAppend 				+= "<tr>";
	tableAppend					+= "<td></td>";
	tableAppend					+= "<td></td>";
	tableAppend					+=	"<td></td>";
	tableAppend					+=	"<td></td>";

	if (nama_tb_database == "tb_barang_inventaris_karyawan_modul_tambah") {		
		tableAppend				+=	"<td>";
		tableAppend				+=	"<input id='jumlah' placeholder='Jumlah'";
		tableAppend				+=	"class='form-control form-control-sm' type='number' min='0'>";
		tableAppend				+=	"</td>";
		tableAppend				+=	"<td><input id='tanggal_masuk' class='form-control form-control-sm' type='date'></td>";
		tableAppend				+=	"<td></td>";
		tableAppend				+=	"<td><button id='buttonQueryTambah'";
		tableAppend				+=	`class='btn btn-primary'>Tambah</button></td>`;
		tableAppend				+=	"<td><button id='buttonBatal' class='btn btn-warning text-white'>Batal</button></td>";
		tableAppend 			+= "</tr>";
	}

	if (nama_tb_database == "tb_barang_inventaris_karyawan_modul_hapus") {
		tableAppend				+=	"<td>";
		tableAppend				+=	"<input id='jumlah' placeholder='Jumlah'";
		tableAppend				+=	"class='form-control form-control-sm' type='number' min='0'>";
		tableAppend				+=	"<div class='pesanValidasi'></div>";
		tableAppend				+=	"</td>";
		tableAppend				+=	"<td colspan='2'><input id='checkedSemua' class='mr-2' type='checkbox'>";
		tableAppend				+= "<label for='checkedSemua'>Semua</label></td>";
		tableAppend				+=	"<td><button id='buttonQueryHapus'";
		tableAppend				+=	`class='btn btn-danger'>Hapus</button></td>`;
		tableAppend				+=	"<td><button id='buttonBatal' class='btn btn-warning text-white'>Batal</button></td>";
	}

	if (nama_tb_database == "tb_barang_modul_tambah") {
		tableAppend				+= 	"<td colspan='2'>";
		tableAppend				+=	"<input  id='jumlah' placeholder='Jumlah'";
		tableAppend				+=	"class='form-control form-control-sm' type='number' min='0'><div class='pesanValidasi'></div>";
		tableAppend				+=	"</td>";
		tableAppend				+=	"<td colspan='2'><input id='tanggalMasuk' class='form-control form-control-sm' type='date'><div class='pesanValidasi'></div></td>";
		tableAppend				+=	"<td></td>";
		tableAppend				+=	"<td><button id='buttonQueryTambah' class='btn btn-success'";
		tableAppend				+= `>Tambah</button></td>`;
		tableAppend				+=	"<td><button id='buttonBatal' class='btn btn-warning text-white'>Batal</button></td>";
	}

	if (nama_tb_database == "tb_barang_modul_hapus") {
		tableAppend				+=	"<td colspan='2'>";
		tableAppend				+=	"<input  id='jumlah' placeholder='Jumlah'";
		tableAppend				+=	"class='form-control form-control-sm' type='number' min='0'><div class='pesanValidasi'></div>";
		tableAppend				+=	"</td>";
		tableAppend				+=	"<td colspan='2'><input id='checkSemua' type='checkbox' class='mr-2'>";
		tableAppend				+= "<label for='checkSemua'>Semua</label></td>";
		tableAppend				+=	"<td></td>";
		tableAppend				+=	"<td><button id='buttonQueryHapus' class='btn btn-danger'";
		tableAppend				+= `>Hapus</button></td>`;
		tableAppend				+=	"<td><button id='buttonBatal' class='btn btn-warning text-white'>Batal</button></td>";
	}

	tableAppend 			+= "</tr>";
	removeTRNextAll.remove();
	removeTRPrevUntil.remove();

	$("table").append(tableAppend);
}

function eventsTableAppend(jumlahAwalNode, jumlahAwal) {
	let valJumlahAwalBarang = jumlahAwal;
	let jumlahAwalBarang 	= jumlahAwalNode;

	// Keyup tag input 
	$("#jumlah").keyup(function() { // Nama id wajib = "jumlah"
		let valKUjumlah = $(this).val();
		for (let i = 1; i <= valJumlahAwalBarang; i++) {
			if (valKUjumlah == i) {
				jumlahAwalBarang.html(valJumlahAwalBarang - i);
			}
		}

		if (valKUjumlah == 0) {
			jumlahAwalBarang.html(valJumlahAwalBarang);
		}
		$(this).attr("max", valJumlahAwalBarang);
	});

	$("#jumlah").click(function() {
		$(this).keyup();
		$(".pesanValidasi").html("");
	});

	// Checkbox ambil semua nilai
	$("#checkedSemua").click(function() {
		if ($(this).is(":checked")) {
			$("#jumlah").val(valJumlahAwalBarang);
			jumlahAwalBarang.html(0);
		}
		else {
			$("#jumlah").val(null)
			jumlahAwalBarang.html(valJumlahAwalBarang);	
		}
	});
}

// Hide pesan load
function hidePesanLoad() {
	let valPesanLoad 	= $("#pesanLoad").text().trim();

	if (valPesanLoad == "") {
		$("#pesanLoad").hide();
	}
	else {
		$("#pesanLoad").show();
	}
}

function hapusPesanDanCheckAndTimes(namaID) {
	if( $(namaID).val() == "") {
		$(namaID).next().html("");
		$(namaID).next().next().html("");
	}
}

function validasiAJAXDK(modul, valKode, namaIdKode, urlAJAX, valAwalKode) {
	if (modul == "tambah") {
		if (valKode == "") {
			$(namaIdKode).next().html("<small>Tidak boleh kosong</small>");
		}
		else {
			$.ajax({
				url 	: urlAJAX,
				type 	: "POST",
				data 	: { validasiDuplikatKey : valKode },
				success : function(responseText) {
					if (responseText != "berhasil") {
						$(namaIdKode).next().html("<small>" + responseText + "</small>");
					}
					else {
						$(namaIdKode).next().html("");	
					}
					validasiNomer(valKode, namaIdKode, 8);

					if ($(".pesanValidasi").text() == "") {
						$("form").submit();
					}
				}
			});
		}
	}
	else if (modul == "edit") {
		if (valKode == "") {
			$(namaIdKode).next().html("<small>Tidak boleh kosong</small>");
		}
		else {
			$.ajax({
				url 	: urlAJAX,
				type 	: "POST",
				data 	: { validasiDuplikatKeyEdit : valKode, valAwalKode : valAwalKode },
				success : function(responseText) {
					if (responseText != "berhasil") {
						$(namaIdKode).next().html("<small>" + responseText + "</small>");
					}
					else {
						$(namaIdKode).next().html("");	
					}
					validasiNomer(valKode, namaIdKode, 8);

					if ($(".pesanValidasi").text() == "") {
						$("form").submit();
					}
				}
			});
		}
	}
}

// Button untuk header location  
function buttonBatalHeaderLocation(buttonBatalNode, locationAssign) {
	$(buttonBatalNode).click(function(e) {
		e.preventDefault()
		location.assign(locationAssign);
	});
}

function searchTabelAJAX(inputNode, fileBackend, tabelNode, pesan) {
	$(inputNode).keyup(function() {
		let valSearch = $(inputNode).val().trim();

		$.post(fileBackend,{
			searchTabelKaryawan 				: valSearch,
			searchTabelDataBarang 			: valSearch,
			searchTabelBarangMasuk 			: valSearch,
			searchTabelBarangKeluar 		: valSearch,
			searchTabelSettingAkun 			: valSearch,
			searchTabelBarangInvKaryawan 	: valSearch
		},function(responseText) {
			if (responseText == pesan) {
				$("#pesan").show();
				$("#pesan").html(responseText);  // Nama ID untuk AJAX wajib "pesan" 
			}
			else {
				$("#pesan").hide();
				$(tabelNode).html(responseText);
			}
		});
	});
}

function paginationTabel(backendFile, tabelNode) {
	// Saat load, muncul tombol pagination di web browsernya
	let kodeKaryawan = $("#kodeKaryawan").text();

	$.ajax({
		url 	: backendFile,
		type 	: "POST",
		data 	: { 
			paginationTabelKaryawan 			: true,
			paginationTabelBarang 				: true,
			paginationTabelBarangMasuk 		: true,
			paginationTabelBarangKeluar 		: true,
			paginationTabelUsername 			: true,
			paginationTabelBarangInvKaryawan : kodeKaryawan 
		},
		success : function(responseText) {
			$("#page-list").html(responseText);
		}
	});

	// Event click, untuk next tabel
	$("#page-next").click(function() {
		let dataPage 						= $(".page-actived").data("page") + 1;
		let pageListChildrenLength 	= $("#page-list").children().length;
		$.ajax({
			url 	: backendFile,
			type 	: "POST",
			data 	: { pageNext : dataPage },
			success : function(responseText) {
				$(tabelNode).html(responseText);
				console.log(dataPage);
				for (let i = 1; i <= pageListChildrenLength; i++) {
					if (dataPage == i) {
						$(".page-circle").removeClass("page-actived");
						$(`#page-${i}.page-circle`).addClass("page-actived");
					}
				}
			}
		});
	});
}

function ajaxHidePageNext(backendFile, valKondisiQueryNode) {
	let kodeKondisi 	= valKondisiQueryNode;

	$.ajax({
		url 					: backendFile,
		type 					: "POST",
		data 					: { 
			hidePageNext	: kodeKondisi 
		},
		success				: function(responseText) {	
			if (responseText == "<= 10") {
				$("#page-next").hide();
			}
			else {
				$("#page-next").show();	
			}
		}	
	});
}
