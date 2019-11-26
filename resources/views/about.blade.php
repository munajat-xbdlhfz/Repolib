@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
    @include('layouts.headers.guest')

    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="modal-content bg-gradient-danger card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent">
                        <div class="text-muted text-center mt-2"><h2>ABOUT US</h2></div>
                    </div>
                    <div class="card-body px-lg-5 py-lg-2">
                        <div class="py-3 text-left">
                            <p style="color:white">Repolib adalah sebuah Portal Perpustakaan berbasis website. Melalui Repolib, kami
                                merevolusi layanan perpustakaan di Indonesia dengan berbagai unggulan antara lain:
                            </p>
                            <ul class="ml--4" style="color:white">
                                <li>Koleksi yang sepenuhnya terdigitalisasi, mencakup buku-buku, naskah, lagu, dll.</li>
                                <li>Pelayanan modern dan terotomatisasi, memberikan kemudahan bagi pengunjung Repolib
                                    dalam mengeksplor koleksi hingga peminjaman koleksi.</li>
                            </ul>
                            <p style="color:white">Repolib merupakan open source, Anda dapat mendownload source code website ini di github:
                                <a href="https://github.com/munajat-xbdlhfz/repolib">https://github.com/munajat-xbdlhfz/repolib</a>
                            </p>
                            <br>
                            <p style="color:white">Contact:<br>
                                Email : munajatabdulhafiz18@gmail.com<br>
                                No. HP : 082260755373    
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
