@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
    <style>
    html {
        background: url(https://maritim.go.id/konten/unggahan/2016/01/tongging-ok.jpg) no-repeat center center fixed; 
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }

    .search {
        position: absolute;
        text-align: center;
        min-width: 100%;
        padding-left: 5%;
        padding-right: 5%;
        top: 100px;
        min-height: 100%;
    }

    .footer {
        position: absolute;
        text-align: center;
        min-width: 100%;
        min-height: 100%;
    }
    </style>

    @if (Auth::check())
    <div class="header bg-gradient-primary pt-sm-0 pt-md-6 pt-lg-6">
    @else
    <div class="header bg-gradient-primary pt-0 pt-lg-0">
    @endif
        <div class="search">
            <div class="header-body text-center">
                <h1>SEARCH</h1>
                <h3>masukkan satu atau lebih kata kunci dari judul, pengarang, atau subyek </h3>

                <div class="row">
                    <div style="min-width:100%">
                        <form method="get" action="{{ route('search') }}">

                            <div class="col-lg-12 py-4">
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

                <div style="padding-top: 400px;"></div>
            </div>
        </div>

        <div class="footer" style="margin-top: 600px;">
                <div class="footer align-items-center pt-3 pb-3">
                    <div class="">
                        <div class="">
                            &copy; {{ now()->year }} <a href="https://www.perpusnas.go.id/" class="font-weight-bold ml-1" target="_blank">Perpustakaan Nasional</a>
                        </div>
                    </div>
                    <div style="font-size:15px;">
                        <ul class="nav nav-footer justify-content-center justify-content-nd">
                            <li class="nav-item">
                                <a href="#" class="nav-link" target="_blank">About Us</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
    </div>
@endsection
