<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

        @php
            $i = 1;
        @endphp
</head>
<body>
    <div class="container">
        <center style="margin-bottom:8%; margin-top:2%">
                <div><span style="font-size:40px">LAPORAN DATA CD</span></div>
                @if ($bulan != null)
                    <div><span style="font-size:30px; text-transform: uppercase;">BULAN {{ $month[$bulan-1] }} {{ $tahun }}</span></div>
                @else
                    <div><span style="font-size:30px">TAHUN {{ $tahun }}</span></div>
                @endif
        </center>

        <div>
            @if ($bulan != null)
            <a href="/bibliografi/cd/export/excel/{{ $bulan }}-{{ $tahun }}">
            @else
            <a href="/bibliografi/cd/export/excel/all-{{ $tahun }}">
            @endif
                <button class="btn btn-icon btn-3 btn-primary" type="button">
                    <span class="btn-inner--icon"><i class="fas fa-file-export"></i></span>
                    
                    <span class="btn-inner--text">EXPORT</span>
                    
                </button>
            </a>

            <a href="/bibliografi/cd" style="margin-left:2%">
                <button class="btn btn-icon btn-3 btn-danger" type="button">
                    <span class="btn-inner--text">CANCEL</span>
                    
                </button>
            </a>
        </div>
        
        <div class="table-responsive" style="margin-top:2%">
            <table class="table table-bordered table-striped">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ISBN</th>
                        <th scope="col">NO PANGGIL</th>
                        <th scope="col">JUDUL</th>
                        <th scope="col">ANAK JUDUL</th>
                        <th scope="col">EDISI</th>
                        <th scope="col">PENERBIT</th>
                        <th scope="col">TEMPAT TERBIT</th>
                        <th scope="col">TAHUN TERBIT</th>
                        <th scope="col">JUMLAH KEPING</th>
                        <th scope="col">PENCIPTA</th>
                        <th scope="col">GENRE</th>
                        <th scope="col">LOKASI</th>
                        <th scope="col">BAHASA</th>
                        <th scope="col">KATEGORI</th>
                        <th scope="col">HARGA</th>
                        <th scope="col">JENIS SUMBER</th>
                        <th scope="col">NAMA SUMBER</th>
                        <th scope="col">TANGGAL PENGADAAN</th>
                        <th scope="col">PUBLISHER</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                @foreach ($data as $bibli)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $bibli->isbn }}</td>
                        <td>{{ $bibli->no_panggil }}</td>
                        <td>{{ $bibli->judul }}</td>
                        <td>{{ $bibli->anak_judul }}</td>
                        <td>{{ $bibli->edisi }}</td>
                        <td>{{ $bibli->penerbit }}</td>
                        <td>{{ $bibli->tempat_terbit }}</td>
                        <td>{{ $bibli->tahun_terbit }}</td>
                        <td>{{ $bibli->jumlah_keping }}</td>
                        <td>{{ $bibli->pencipta }}</td>
                        <td>{{ $bibli->genre }}</td>
                        <td>{{ $bibli->lokasi }}</td>
                        <td>{{ $bibli->bahasa }}</td>
                        <td>{{ $bibli->kategori }}</td>
                        <td>{{ $bibli->mata_uang_id }} {{ number_format($bibli->harga,2) }}</td>
                        <td>{{ $bibli->jenis_sumber }}</td>
                        <td>{{ $bibli->nama_sumber }}</td>
                        <td>{{ $bibli->tanggal_pengadaan }}</td>
                        <td>{{ $bibli->name }}</td>
                    </tr>
                @endforeach     
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>