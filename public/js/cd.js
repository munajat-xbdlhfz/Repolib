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

function tambahGenre(method='post'){
    var tambahGenre = document.getElementById("tambah-genre").value;
    var url = "/btnSelect/genre/value"
    url = url.replace('value', tambahGenre);

    $.get(url, function(data){
        alert(data[0]);
        var option = '<option value="' + data[1] + '">' + data[2] +'</option>';
        $("#genre").append(option);
    });
};

function tambahSongwriter(method='post'){
    var tambahSongwriter = document.getElementById("tambah-songwriter").value;
    var url = "/btnSelect/songwriter/value"
    url = url.replace('value', tambahSongwriter);

    $.get(url, function(data){
        alert(data[0]);
        var option = '<option value="' + data[1] + '">' + data[2] +'</option>';
        $("#songwriter").append(option);
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

$('#genre').select2({
    placeholder: "Pilih Genre Lagu",
    allowClear: true
});

$('#songwriter').select2({
    placeholder: "Pilih Pencipta Lagu",
    allowClear: true
});

$('#jenis').select2({
    placeholder: "Pilih Jenis Sumber",
    allowClear: true
});

$('#mata_uang').select2({
    placeholder: "Pilih Mata Uang",
    allowClear: true
});