@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
    @if (Auth::check())
    <div class="header bg-gradient-primary pt-sm-0 pt-md-6 pt-lg-6">
    @else
    <div class="header bg-gradient-primary pt-0 pt-lg-0">
    @endif
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
            </ol>
            <div class="carousel-inner">
                {{-- FIRST CAROUSEL --}}
                <div class="carousel-item active">
                    @php
                        $carouselFirst = App\Carousel::where('id', 1)->value('cover');
                    @endphp

                    @if ($carouselFirst != null)
                        <img class="d-block w-100" src="{{ asset('storage') }}/carousel/{{ $carouselFirst }}" alt="">
                    @else
                        <img class="d-block w-100" src="{{ asset('argon') }}/img/carousel/default1.jpg" alt="">
                    @endif
                </div>

                {{-- SECOND CAROUSEL --}}
                <div class="carousel-item">
                    @php
                        $carouselSecond = App\Carousel::where('id', 2)->value('cover');
                    @endphp

                    @if ($carouselSecond != null)
                        <img class="d-block w-100" src="{{ asset('storage') }}/carousel/{{ $carouselSecond }}" alt="">
                    @else
                        <img class="d-block w-100" src="{{ asset('argon') }}/img/carousel/default2.jpg" alt="">
                    @endif
                </div>
                
                {{-- THIRD CAROUSEL --}}
                <div class="carousel-item">
                    @php
                        $carouselThird = App\Carousel::where('id', 3)->value('cover');
                    @endphp

                    @if ($carouselThird != null)
                        <img class="d-block w-100" src="{{ asset('storage') }}/carousel/{{ $carouselThird }}" alt="">
                    @else
                        <img class="d-block w-100" src="{{ asset('argon') }}/img/carousel/default3.jpg" alt="">
                    @endif
                </div>

                {{-- FOURTH CAROUSEL --}}
                <div class="carousel-item">
                    @php
                        $carouselFourth = App\Carousel::where('id', 4)->value('cover');
                    @endphp

                    @if ($carouselFourth != null)
                        <img class="d-block w-100" src="{{ asset('storage') }}/carousel/{{ $carouselFourth }}" alt="">
                    @else
                        <img class="d-block w-100" src="{{ asset('argon') }}/img/carousel/default4.jpg" alt="">
                    @endif
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

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
        {{-- <div class="separator separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div> --}}
    </div>

    <div class="footer" style="background-color:#fcf6f9;">
        <div class="container">
            <div class="row">
                @php
                    $time = date('Y-m-d', strtotime("now"));

                    $totalBuku = App\Book::count();
                    $totalUser = App\User::count();
                    $totalVisit = App\Visit::where('login_date', $time)->count();
                @endphp
                <div class="col-lg-4 col-md-6 pb-5">
                    <h3>STATISTIK WEBSITE</h3>
                    <div class="d-flex justify-content-between align-items-baseline">
                        <div>Total Buku</div>
                        <div>{{ $totalBuku }}</div>
                    </div>
                    <div class="my-2" style="border-bottom:1px solid #000; width:100%;"></div>
                    
                    <div class="d-flex justify-content-between align-items-baseline">
                        <div>Total Users</div>
                        <div>{{ $totalUser }}</div>
                    </div>
                    <div class="my-2" style="border-bottom:1px solid #000; width:100%;"></div>

                    <div class="d-flex justify-content-between align-items-baseline">
                        <div>Total Pengunjung Hari Ini</div>
                        <div>{{ $totalVisit }}</div>
                    </div>
                </div>

                <div class="col-lg-8 col-md-6 pb-5" align="justify">
                    <h3>TENTANG REPOLIB</h3>
                    <div>Repolib adalah sebuah Portal Perpustakaan berbasis website. Melalui Repolib, kami
                        merevolusi layanan perpustakaan di Indonesia dengan berbagai unggulan antara lain:<br>
                        <ul class="ml--4">
                            <li>Koleksi yang sepenuhnya terdigitalisasi, mencakup buku-buku, naskah, lagu, dll.</li>
                            <li>Pelayanan modern dan terotomatisasi, memberikan kemudahan bagi pengunjung Repolib
                                dalam mengeksplor koleksi hingga peminjaman koleksi.</li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-12 py-3">
                    <h3>OUR LOCATION</h3>
                    <div>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.4922451312336!2d106.84995121472714!3d-6.1986015624505075!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f468898997d9%3A0xf0516385960472d4!2sPerpustakaan%20Nasional%20Salemba%20Raya!5e0!3m2!1sen!2sid!4v1568102643389!5m2!1sen!2sid" width="100%" height="50%" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
