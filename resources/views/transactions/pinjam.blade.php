@extends('layouts.app', ['title' => __('User Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Peminjaman Buku')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                
                            </div>
                            <div class="col-4 text-right">
                                <a href="/peminjaman" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="/peminjaman" autocomplete="off">
                            @csrf
                            
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="heading-small text-muted mb-4">{{ __('Book Information') }}</h6>
                                @if ($null)
                                    <button type="button" class="btn btn-sm btn-outline-info" data-toggle="modal" data-target="#book-table"><b>Cari Buku</b> <span class="fa fa-search"></span></button>
                                @endif
                            </div>
                            <div class="pl-lg-4">
                                {{-- JUDUL --}}
                                <div class="form-group{{ $errors->has('judul') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-judul">{{ __('Judul') }}</label>
                                    <input type="text" name="judul" id="input-judul" class="form-control form-control-alternative{{ $errors->has('judul') ? ' is-invalid' : '' }}" placeholder="{{ __('Judul') }}" value="{{ $data->judul ?? '' }}" required autofocus>

                                    @if ($errors->has('judul'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('judul') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                {{-- ANAK JUDUL --}}
                                <div class="form-group{{ $errors->has('anak_judul') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-anak_judul">{{ __('Anak Judul') }}</label>
                                    <input type="text" name="anak_judul" id="input-anak_judul" class="form-control form-control-alternative{{ $errors->has('anak_judul') ? ' is-invalid' : '' }}" placeholder="{{ __('Anak Judul') }}" value="{{ $data->anak_judul ?? '' }}" required>

                                    @if ($errors->has('anak_judul'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('anak_judul') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                {{-- ISBN --}}
                                <div class="form-group{{ $errors->has('isbn') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-isbn">{{ __('ISBN') }}</label>
                                    <input type="text" name="isbn" id="input-isbn" class="form-control form-control-alternative{{ $errors->has('isbn') ? ' is-invalid' : '' }}" placeholder="{{ __('ISBN') }}" value="{{ $data->isbn ?? '' }}" required>

                                    @if ($errors->has('isbn'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('isbn') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                {{-- EDISI --}}
                                <div class="form-group{{ $errors->has('edisi') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-edisi">{{ __('Edisi') }}</label>
                                    <input type="text" name="edisi" id="input-edisi" class="form-control form-control-alternative{{ $errors->has('edisi') ? ' is-invalid' : '' }}" placeholder="{{ __('Edisi') }}" value="{{ $data->edisi ?? '' }}">

                                    @if ($errors->has('edisi'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('edisi') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                {{-- PENERBIT --}}
                                <div class="form-group{{ $errors->has('penerbit') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-penerbit">{{ __('Penerbit') }}</label>
                                    <input type="text" name="penerbit" id="input-penerbit" class="form-control form-control-alternative{{ $errors->has('penerbit') ? ' is-invalid' : '' }}" placeholder="{{ __('Penerbit') }}" value="{{ $data->penerbit ?? '' }}">

                                    @if ($errors->has('penerbit'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('penerbit') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                {{-- PENGARANG --}}
                                <div class="form-group{{ $errors->has('pengarang') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-pengarang">{{ __('Pengarang Utama') }}</label>
                                    <input type="text" name="pengarang" id="input-pengarang" class="form-control form-control-alternative{{ $errors->has('pengarang') ? ' is-invalid' : '' }}" placeholder="{{ __('Nama Pengarang Utama') }}" value="{{ $dataAuthor->name ?? '' }}">

                                    @if ($errors->has('pengarang'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('pengarang') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                <label class="form-control-label">{{ __('Batas Peminjaman') }}</label>
                                <div class="input-daterange datepicker row align-items-center">
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                                </div>
                                                <input class="form-control" placeholder="Start date" name="pinjam" type="date" value="{{ $now }}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                                </div>
                                                <input class="form-control" placeholder="End date" name="batas" type="date" value="" min="{{ $min_date }}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            @if (auth()->user()->level != 4)
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="heading-small text-muted pt-5 mb-4">{{ __('User Information') }}</h6>
                                <button type="button" class="btn btn-sm btn-outline-info" data-toggle="modal" data-target="#user-table"><b>Cari User</b> <span class="fa fa-search"></span></button>
                            </div>
                            <div class="pl-lg-4">
                                {{-- KODE ANGGOTA --}}
                                <div class="form-group{{ $errors->has('kode_anggota') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-kode_anggota">{{ __('Kode Anggota') }}</label>
                                    <input type="text" name="kode_anggota" id="input-kode_anggota" class="form-control form-control-alternative{{ $errors->has('kode_anggota') ? ' is-invalid' : '' }}" placeholder="{{ __('Kode Anggota Peminjam') }}" value="">

                                    @if ($errors->has('kode_anggota'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('kode_anggota') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            @endif

                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-4">{{ __('Pinjam') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>

    {{-- Popup Book Table Data --}}
    <div class="modal fade bd-example-modal-lg" id="book-table" tabindex="-1" role="dialog" aria-labelledby="mylargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="background:#fff">
                <div class="modal-header">
                    <h5>Cari Buku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body table-responsive">
                    <div class="form-group">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                            </div>
                            <input id="myInput" class="form-control form-control-alternative" placeholder="Judul/ Anak Judul/ ISBN Buku" type="text">
                        </div>
                    </div>

                    <table id="lookup" class="table align-items-center table-flush">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Anak Judul</th>
                                <th>Edisi</th>
                                <th>ISBN</th>
                                <th>Penerbit</th>
                                <th>Pengarang Utama</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody id="tableBiblio">
                            @foreach ($bibli as $data)
                                <tr class="pilihBook" data-buku-judul="{{ $data->judul }}" data-buku-anak_judul="{{ $data->anak_judul }}" data-buku-isbn="{{ $data->isbn }}">
                                    <td id="data-buku-judul{{ $data->bibliografi_id }}">{{ $data->judul }}</td>
                                    <td id="data-buku-anak_judul{{ $data->bibliografi_id }}">{{ $data->anak_judul }}</td>
                                    <td id="data-buku-edisi{{ $data->bibliografi_id }}">{{ $data->edisi }}</td>
                                    <td id="data-buku-isbn{{ $data->bibliografi_id }}">{{ $data->isbn }}</td>
                                    <td id="data-buku-penerbit{{ $data->bibliografi_id }}">{{ $data->penerbit }}</td>
                                    <td>
                                        @foreach ($authorBook as $ab)
                                            @if ($data->buku_id == $ab->buku_id)
                                                @foreach ($author as $ath)
                                                    @if ($ab->authors_id == $ath->id)
                                                        @if ($ath->status === 'primary')
                                                            <span id="data-buku-pengarang{{ $data->bibliografi_id }}">{{ $ath->name }}</span>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </td>
                                    <td><button type="button" class="pilihBook btn btn-primary" onclick="pilihBook({{ $data->bibliografi_id }})" id="pilih{{ $data->bibliografi_id }}" data-dismiss="modal">Pilih</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">
                        {{ $bibli->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>

    {{-- Popup User Table Data --}}
    <div class="modal fade bd-example-modal-lg" id="user-table" tabindex="-1" role="dialog" aria-labelledby="mylargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="background:#fff">
                <div class="modal-header">
                    <h5>Cari Buku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body table-responsive">
                    <div class="form-group">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                </div>
                                <input id="searchUser" class="form-control form-control-alternative" placeholder="Email/ Nama/ Kode Anggota" type="text">
                            </div>
                        </div>

                    <table id="lookup" class="table align-items-center table-flush">
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Name</th>
                                <th>Kode Anggota</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody id="tableUser">
                            @foreach ($users as $user)
                                <tr class="pilihUser">
                                    <td id="user-email{{ $user->id }}">{{ $user->email }}</td>
                                    <td id="user-name{{ $user->id }}">{{ $user->name }}</td>
                                    <td id="user-kode{{ $user->id }}">{{ $user->kode_anggota }}</td>
                                    <td><button type="button" class="pilihUser btn btn-primary" onclick="pilihUser({{ $user->id }})" id="pilih{{ $user->id }}" data-dismiss="modal">Pilih</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">
                        {{ $users->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script>
        function pilihBook(id) {
            var judul = document.querySelector("#data-buku-judul"+id).textContent;
            var anak_judul = document.querySelector("#data-buku-anak_judul"+id).textContent;
            var isbn = document.querySelector("#data-buku-isbn"+id).textContent;
            var edisi = document.querySelector("#data-buku-edisi"+id).textContent;
            var penerbit = document.querySelector("#data-buku-penerbit"+id).textContent;
            var pengarang = document.querySelector("#data-buku-pengarang"+id).textContent;

            document.getElementById("input-judul").value = judul;
            document.getElementById("input-anak_judul").value = anak_judul;
            document.getElementById("input-isbn").value = isbn;
            document.getElementById("input-edisi").value = edisi;
            document.getElementById("input-penerbit").value = penerbit;
            document.getElementById("input-pengarang").value = pengarang;
        }

        function pilihUser(id) {
            var kode = document.querySelector("#user-kode"+id).textContent;

            document.getElementById("input-kode_anggota").value = kode;
        }

        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#tableBiblio tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        $("#searchUser").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#tableUser tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    </script>
    
@endsection