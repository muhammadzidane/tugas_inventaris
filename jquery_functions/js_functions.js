
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

// Menampilkan pesan load
function tampilkanPesanLoad(substrGetUrl,substrGetValUrl , getUrl) {
	let varGetUrl 		= location.search.substr(1, substrGetUrl);
	let valGetUrl 	= decodeURIComponent(location.search.substr(substrGetValUrl));

	if (varGetUrl == getUrl) {
		$("#pesanLoad").show();
		$("#pesanLoad").html(valGetUrl);
	}
}