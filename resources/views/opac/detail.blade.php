@extends('layouts.app', ['title' => __('User Management')])

@section('content')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @section('css')
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

        <style>
            .container {
                background-color: white;
            }
        </style>
    @stop

    @if (Auth::check())
    <div class="header bg-gradient-primary pt-sm-0 pt-md-6 pt-lg-6">
    @else
    <div class="header bg-gradient-primary pt-6">
    @endif

        <div class="header-search pt-2">
            <div class="container py-4">
                <div class="header-body text-center">
                    <div class="row justify-content-center">
                        <div style="min-width:100%">
                            <form method="get" action="{{ route('search') }}">

                                <div class="col-lg-12">
                                    <div class="input-group justify-content-center">
                                        <input style="border-radius:50px 0px 0px 50px" type="text" name="data" id="input-data" class="form-control form-control-alternative" placeholder="{{ __('Search judul/ pengarang/ bibliografi...') }}" value="">
                                        <div class="input-group-prepend">
                                            <button style="border-radius:0px 50px 50px 0px; position:relative; z-index: 0;" type="submit" class="btn btn-secondary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> 
                </div>
            </div>
        </div>

        <div class="bookdetail" style="background-color:whitesmoke;">
            <div class="container book pt-5 pb-7" style="background-color:whitesmoke">
                @foreach ($buku as $bibli)
                    @php
                        $total = $bibli->jumlah_buku;
                    @endphp
                    @if ($double != $bibli->buku_id)
                        <div class="row">
                            <div class="col-lg-3 pb-4">
                                <img src="{{ asset('storage') }}/covers/{{ $bibli->cover ?? 'no_image.jpg' }}" alt="" width="250" height="350"> 
                                <div class="pt-2">
                                    <a href="{{ url()->previous() }}" style="font-size:13px">< Kembali ke halaman sebelumnya</a>
                                </div>
                            </div>
                            
                            <div class="col-lg-1"></div>
                            <div class="col-lg-8 ">
                                <div>
                                    <h2>{{ $bibli->judul }} {{ $bibli->anak_judul }}</h2>
                                </div>  
                                <div>
                                    <p class="font-italic" style="color:gray">{{ $bibli->deskripsi ?? 'tidak tersedia deskripsi' }}</p>
                                </div>
        
                                <div>
                                    <div class="font-weight-bold">
                                        <i class="fas fa-edit "></i>
                                        <span>Pengarang Utama</span>
                                    </div>
                                    <div class="pl-4">
                                        <span>
                                            @foreach ($buku as $author)
                                                @if ($bibli->buku_id == $author->author_book)
                                                    @foreach ($authors as $ath)
                                                        @if ($author->authors_id == $ath->id)
                                                          @if ($ath->status === 'primary')
                                                            {{ $ath->name }}
                                                          @endif
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </span>
                                    </div>
                                </div>
        
                                <div>
                                    <div class="font-weight-bold">
                                        <i class="fas fa-edit "></i>
                                        <span>Pengarang Tambahan</span>
                                    </div>
                                    <div class="pl-4">
                                        <span>
                                            @foreach ($buku as $author)
                                                @if ($bibli->buku_id == $author->author_book)
                                                    @foreach ($authors as $ath)
                                                        @if ($author->authors_id == $ath->id)
                                                            @if ($ath->status === 'additional')
                                                            {{ $ath->name }},
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </span>
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="font-weight-bold pt-3">
                                        <i class="fas fa-info-circle"></i>
                                        Informasi detail
                                    </div>
                                    <div class="container">
                                        <div class="row" style="background-color:#c2c7cf">
                                            <div class="col-sm-5">
                                                <span>No. Panggil</span>
                                            </div>
                                            <div class="col-sm-auto">
                                                <span>{{ $bibli->no_panggil }}</span>
                                            </div>
                                        </div>
        
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <span>ISBN</span>
                                            </div>
                                            <div class="col-sm-auto">
                                                <span>{{ $bibli->isbn }}</span>
                                            </div>
                                        </div>
        
                                        <div class="row" style="background-color:#c2c7cf">
                                            <div class="col-sm-5">
                                                <span>Penerbit</span>
                                            </div>
                                            <div class="col-sm-auto">
                                                <span>{{ $bibli->penerbit . ': ' . $bibli->tempat_terbit . ', ' . $bibli->tahun_terbit}}</span>
                                            </div>
                                        </div>
        
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <span>Deskripsi Fisik</span>
                                            </div>
                                            <div class="col-sm-auto">
                                                <span>{{ $bibli->tinggi_buku }}</span>
                                            </div>
                                        </div>
        
                                        <div class="row" style="background-color:#c2c7cf">
                                            <div class="col-sm-5">
                                                <span>Bahasa</span>
                                            </div>
                                            <div class="col-sm-auto">
                                                <span>{{ $bibli->bahasa }}</span>
                                            </div>
                                        </div>
        
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <span>Lokasi</span>
                                            </div>
                                            <div class="col-sm-auto">
                                                <span>{{ $bibli->lokasi }}</span>
                                            </div>
                                        </div>
        
                                        <div class="row" style="background-color:#c2c7cf">
                                            <div class="col-sm-5">
                                                <span>Jumlah Halaman</span>
                                            </div>
                                            <div class="col-sm-auto">
                                                <span>{{ $bibli->jumlah_halaman }} halaman</span>
                                            </div>
                                        </div>
        
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <span>Ketersediaan</span>
                                            </div>
                                            <div class="col-sm-auto">
                                                @foreach ($peminjaman as $check)
                                                    @if ($check->bibliografi_id == $bibli->bibliografi_id)
                                                        @php
                                                            $total -= 1;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                <span>{{ $total }} dari {{ $bibli->jumlah_buku ?? '0'}} item</span>
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="row pt-4">
                                        <div class="col-12">
                                            <div class="modal-footer">
                                                @if ($total != 0 && $bibli->akses === 'Dapat Dipinjam' )
                                                    <a class="btn btn-outline-primary" href="/peminjaman/buku/{{ $bibli->bibliografi_id }}">Pinjam</a>
                                                @endif

                                                @if ($bibli->file != null)
                                                    <a  class="btn btn-outline-primary" href="/opac/read/{{ $bibli->bibliografi_id }}/{{ str_replace(' ', '-', $bibli->judul) }}-{{ str_replace(' ', '-', $bibli->anak_judul) }}">Baca</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php
                            $double = $bibli->buku_id
                        @endphp
                    @endif                    
                @endforeach
            </div>
        </div>
    </div>
@endsection