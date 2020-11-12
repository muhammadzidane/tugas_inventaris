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

// Hide pesan load
function hidePesanLoad(valPola) {
	let polaRegex = valPola;
	if (location.search == polaRegex.test()) {
		$("#pesanLoad").hide();
	}
}

function tableAppend(nama_tb_database, refThis) {
	let button 		 		 = refThis;
	let removeTRNextAll   	 = $(button).parent().parent().nextAll();
	let removeTRPrevUntil 	 = $(button).parent().parent().prevUntil(".tableFirstChild");

	let tableAppend 		 = "";

	tableAppend 			+= "<tr>";
	tableAppend				+= "<td></td>";
	tableAppend				+= "<td></td>";
	tableAppend				+=	"<td></td>";
	tableAppend				+=	"<td></td>";

	if (nama_tb_database == "tb_barang_inventaris_karyawan") {
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
	$("#jumlah").keyup(function() {
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
	$("#checkSemua").click(function() {
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