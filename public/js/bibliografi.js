function tambahBahasa(method='post'){
    var tambahBahasa = document.getElementById("tambah-bahasa").value;
    var url = "/btnSelect/bahasa/value"
    url = url.replace('value', tambahBahasa);

    $.get(url, function(data){
        alert(data[0]);
        var option = '<option value="' + data[1] + '">' + data[2] +'</option>';
        $("#bahasa").append(option);
    });
};

function tambahKategori(method='post'){
    var tambahKategori = document.getElementById("tambah-kategori").value;
    var url = "/btnSelect/kategori/value"
    url = url.replace('value', tambahKategori);

    $.get(url, function(data){
        alert(data[0]);
        var option = '<option value="' + data[1] + '">' + data[2] +'</option>';
        $("#kategori").append(option);
    });
};

function tambahAkses(method='post'){
    var tambahAkses = document.getElementById("tambah-akses").value;
    var url = "/btnSelect/akses/value"
    url = url.replace('value', tambahAkses);

    $.get(url, function(data){
        alert(data[0]);
        var option = '<option value="' + data[1] + '">' + data[2] +'</option>';
        $("#akses").append(option);
    });
};

function tambahLokasi(method='post'){
    var tambahLokasi = document.getElementById("tambah-lokasi").value;
    var url = "/btnSelect/lokasi/value"
    url = url.replace('value', tambahLokasi);

    $.get(url, function(data){
        alert(data[0]);
        var option = '<option value="' + data[1] + '">' + data[2] +'</option>';
        $("#lokasi").append(option);
    });
};

function tambahKlasifikasiBuku(method='post'){
    var tambahKlasifikasiBuku = document.getElementById("tambah-klasifikasi_buku").value;
    var url = "/btnSelect/klasifikasi/value"
    url = url.replace('value', tambahKlasifikasiBuku);

    $.get(url, function(data){
        alert(data[0]);
        var option = '<option value="' + data[1] + '">' + data[2] +'</option>';
        $("#klasifikasi_buku").append(option);
    });
};

function tambahSubjekBuku(method='post'){
    var tambahSubjekBuku = document.getElementById("tambah-subjek_buku").value;
    var url = "/btnSelect/subjek/value"
    url = url.replace('value', tambahSubjekBuku);

    $.get(url, function(data){
        alert(data[0]);
        var option = '<option value="' + data[1] + '">' + data[2] +'</option>';
        $("#subjek_buku").append(option);
    });
};

function tambahKaryaTulis(method='post'){
    var tambahKaryaTulis = document.getElementById("tambah-karya_tulis").value;
    var url = "/btnSelect/karya-tulis/value"
    url = url.replace('value', tambahKaryaTulis);

    $.get(url, function(data){
        alert(data[0]);
        var option = '<option value="' + data[1] + '">' + data[2] +'</option>';
        $("#karya_tulis").append(option);
    });
};

function tambahJenisBuku(method='post'){
    var tambahKaryaTulis = document.getElementById("tambah-jenis_buku").value;
    var url = "/btnSelect/jenis-buku/value"
    url = url.replace('value', tambahKaryaTulis);

    $.get(url, function(data){
        alert(data[0]);
        var option = '<option value="' + data[1] + '">' + data[2] +'</option>';
        $("#jenis_buku").append(option);
    });
};

function tambahSumber(method='post'){
    var tambahSumber = document.getElementById("tambah-sumber").value;
    var url = "/btnSelect/sumber/value"
    url = url.replace('value', tambahSumber);

    $.get(url, function(data){
        alert(data[0]);
        var option = '<option value="' + data[1] + '">' + data[2] +'</option>';
        $("#jenis").append(option);
    });
};

function tambahCurrency(method='post'){
    var tambahCurrency = document.getElementById("tambah-currency").value;
    var tambahCode = document.getElementById("tambah-code").value;
    var url = "/btnSelect/currency/stats/value"
    url = url.replace('stats', tambahCode);
    url = url.replace('value', tambahCurrency);

    $.get(url, function(data){
        alert(data[0]);
        var option = '<option value="' + data[1] + '">' + data[3] + ' (' + data[2] + ')</option>';
        $("#mata_uang").append(option);
    });
};

function tambahAuthor(method='post'){
    var tambahAuthor = document.getElementById("tambah-author").value;
    var statsAuthor = document.getElementById("author-status").value;
    var url = "/btnSelect/author/stats/value"
    url = url.replace('stats', statsAuthor);
    url = url.replace('value', tambahAuthor);

    $.get(url, function(data){
        alert(data[0]);
        var option = '<option value="' + data[1] + '">' + data[3] +'</option>';
        if (data[2] == "primary") {
            $("#authorPrimary").append(option);
        } else {
            $("#authorAdditional").append(option);
        }
    });
};

// Searchable Dropdown From (Select Option)
$('#bahasa').select2({
    placeholder: "Pilih Bahasa",
    allowClear: true
});

$('#kategori').select2({
    placeholder: "Pilih Kategori",
    allowClear: true
});

$('#akses').select2({
    placeholder: "Pilih Akses",
    allowClear: true
});

$('#lokasi').select2({
    placeholder: "Pilih Lokasi",
    allowClear: true
});

$('#klasifikasi_buku').select2({
    placeholder: "Pilih Klasifikasi Buku",
    allowClear: true
});

$('#subjek_buku').select2({
    placeholder: "Pilih Subjek Buku",
    allowClear: true
});

$('#karya_tulis').select2({
    placeholder: "Pilih Bentuk Karya",
    allowClear: true
});

$('#jenis_buku').select2({
    placeholder: "Pilih Jenis Buku",
    allowClear: true
});

$('#authorPrimary').select2({
    placeholder: "Pilih Pengarang Utama",
    allowClear: true
});

$('#authorAdditional').select2({
    placeholder: "Pilih Pengarang Tambahan"
});

$('#jenis').select2({
    placeholder: "Pilih Jenis Sumber",
    allowClear: true
});

$('#mata_uang').select2({
    placeholder: "Pilih Mata Uang",
    allowClear: true
});