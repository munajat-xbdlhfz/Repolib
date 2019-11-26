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
                <div><span style="font-size:40px">LAPORAN DATA BUKU TAMU</span></div>
                @if ($bulan != null)
                    <div><span style="font-size:30px; text-transform: uppercase;">BULAN {{ $month[$bulan-1] }} {{ $tahun }}</span></div>
                @else
                    <div><span style="font-size:30px">TAHUN {{ $tahun }}</span></div>
                @endif
        </center>

        <div>
            @if ($bulan != null)
            <a href="/guestbook-all-data/export/excel/{{ $bulan }}-{{ $tahun }}">
            @else
            <a href="/guestbook-all-data/export/excel/all-{{ $tahun }}">
            @endif
                <button class="btn btn-icon btn-3 btn-primary" type="button">
                    <span class="btn-inner--icon"><i class="fas fa-file-export"></i></span>
                    
                    <span class="btn-inner--text">EXPORT</span>
                    
                </button>
            </a>

            <a href="/guestbook-all-data" style="margin-left:2%">
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
                        <th scope="col">KODE</th>
                        <th scope="col">STATUS</th>
                        <th scope="col">NAMA</th>
                        <th scope="col">PEKERJAAN</th>
                        <th scope="col">PENDIDIKAN</th>
                        <th scope="col">JENIS KELAMIN</th>
                        <th scope="col">ALAMAT</th>
                        <th scope="col">NO. HP</th>
                        <th scope="col">NAMA LEMBAGA</th>
                        <th scope="col">NO. HP LEMBAGA</th>
                        <th scope="col">EMAIL LEMBAGA</th>
                        <th scope="col">ALAMAT LEMBAGA</th>
                        <th scope="col">JUMLAH PESERTA</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    @foreach ($data as $guest)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $guest->kode }}</td>
                            <td>{{ $guest->status }}</td>
                            <td>{{ $guest->nama }}</td>
                            <td>{{ $guest->pekerjaan }}</td>
                            <td>{{ $guest->pendidikan }}</td>
                            <td>{{ $guest->jenis_kelamin }}</td>
                            <td>{{ $guest->alamat }}</td>
                            <td>{{ $guest->no_hp }}</td>
                            <td>{{ $guest->nama_lembaga }}</td>
                            <td>{{ $guest->no_hp_lembaga }}</td>
                            <td>{{ $guest->email_lembaga }}</td>
                            <td>{{ $guest->alamat_lembaga }}</td>
                            <td>{{ $guest->jumlah_peserta }}</td>
                            
                        </tr>
                    @endforeach    
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>