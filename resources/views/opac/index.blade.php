@extends('layouts.app', ['title' => __('User Management')])

@php
    function highlight($text, $words) {
        preg_match_all('~\w+~', $words, $m);
        if(!$m)
            return $text;
        $re = '~\\b(' . implode('|', $m[0]) . ')\\b~i';
        return preg_replace($re, '<b style="background-color: yellow">$0</b>', $text);
    }
@endphp

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
                                            <input style="border-radius:50px 0px 0px 50px" type="text" name="data" id="input-data" class="form-control form-control-alternative" placeholder="{{ __('Search judul/ pengarang/ bibliografi...') }}" value="{{ old('data', $data) }}" autofocus>
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

        <div class="bookdetail" style="background-color:whitesmoke">

            <div class="container book pt-5 pb-7" style="background-color:whitesmoke">
                @if ($count == 0)
                    <div>
                        <h2>Maaf, data yang Anda cari tidak ada.</h2>
                    </div>
                @endif

                @foreach ($buku as $item)
                    @php
                        $total = $item->jumlah_buku;
                    @endphp
                    <div class="row pb-5">
                        <div class="col-lg-3 pb-4">
                            @if ($item->cover != null)
                                <img src="{{ asset('storage') }}/covers/{{ $item->cover}}" alt="" width="250" height="350"> 
                            @else
                                <img src="{{ asset('argon') }}/img/no_image.jpg" alt="" width="250" height="350"> 
                            @endif
                        </div>
                        
                        <div class="col-lg-1"></div>
                        <div class="col-lg-8 ">
                            <div>
                                <h2><a href="/opac/show/{{ $item->bibliografi_id }}">
                                    @php
                                        print highlight($item->judul, $data);
                                        print " ";
                                        print highlight($item->anak_judul, $data);
                                    @endphp
                                </a></h2>
                            </div>
                            
                            <div>
                                <div class="container">
                                    <div class="row" style="background-color:#c2c7cf">
                                        <div class="col-sm-5">
                                            <span>No. Panggil</span>
                                        </div>
                                        <div class="col-sm-auto">
                                            <span>{{ $item->no_panggil }}</span>
                                        </div>
                                    </div>
        
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <span>ISBN</span>
                                        </div>
                                        <div class="col-sm-auto">
                                            <span>{{ $item->isbn }}</span>
                                        </div>
                                    </div>
        
                                    <div class="row" style="background-color:#c2c7cf">
                                        <div class="col-sm-5">
                                            <span>Penerbit</span>
                                        </div>
                                        <div class="col-sm-auto">
                                            <span>{{ $item->penerbit . ': ' . $item->tempat_terbit . ', ' . $item->tahun_terbit}}</span>
                                        </div>
                                    </div>
        
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <span>Ketersediaan</span>
                                        </div>
                                        <div class="col-sm-auto">
                                            @foreach ($peminjaman as $check)
                                                @if ($check->bibliografi_id == $item->bibliografi_id)
                                                    @php
                                                        $total -= 1;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            <span>{{ $total }} dari {{ $item->jumlah_buku ?? '0'}} item</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="card-footer py-4">
                <nav class="d-flex justify-content-end" aria-label="...">
                    {{ $buku->links() }}
                </nav>
            </div>
        </div>
    </div>
@endsection