@extends('layouts.app', ['title' => __('User Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Edit Book Data')])   
    <script src="{{ asset('jquery') }}/dist/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            var val = document.getElementById('input-deskripsi').value;
            var count = val.length;
            var max = 200 - count;
            var label_text = 'Tersisa: ' + max + ' karakter';
            var label = document.getElementById('max');
            label.textContent = label_text;

            $("#input-deskripsi").on("keyup", function() {
                val = $(this).val();
                count = val.length;
                max = 200 - count;
                label_text = 'Tersisa: ' + max + ' karakter';
                label = document.getElementById('max');
                label.textContent = label_text;
            });
        });
    </script>

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                
                            </div>
                            <div class="col-4 text-right">
                                <a href="/bibliografi/book" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form enctype="multipart/form-data" method="post" action="/bibliografi/book/edit/{{ $biblio->bibliografi_id }}" autocomplete="off">
                            @csrf
                            @method('put')
                            
                            <h6 class="heading-small text-muted mb-4">{{ __('Bibliografi Information') }}</h6>
                            <div class="pl-lg-4">
                                {{-- JUDUL --}}
                                <div class="form-group{{ $errors->has('judul') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-judul">{{ __('Judul') }}</label>
                                    <input type="text" name="judul" id="input-judul" class="form-control form-control-alternative{{ $errors->has('judul') ? ' is-invalid' : '' }}" placeholder="{{ __('Judul') }}" value="{{ old('judul', $biblio->judul) }}" required autofocus>

                                    @if ($errors->has('judul'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('judul') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                {{-- ANAK JUDUL --}}
                                <div class="form-group{{ $errors->has('anak_judul') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-anak_judul">{{ __('Anak Judul') }}</label>
                                    <input type="text" name="anak_judul" id="input-anak_judul" class="form-control form-control-alternative{{ $errors->has('anak_judul') ? ' is-invalid' : '' }}" placeholder="{{ __('Anak Judul') }}" value="{{ old('judul', $biblio->anak_judul) }}" required>

                                    @if ($errors->has('anak_judul'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('anak_judul') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                {{-- ISBN --}}
                                <div class="form-group{{ $errors->has('isbn') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-isbn">{{ __('ISBN') }}</label>
                                    <input type="text" name="isbn" id="input-isbn" class="form-control form-control-alternative{{ $errors->has('isbn') ? ' is-invalid' : '' }}" placeholder="{{ __('ISBN') }}" value="{{ old('isbn', $biblio->isbn) }}" required>

                                    @if ($errors->has('isbn'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('isbn') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                {{-- NO PANGGIL --}}
                                <div class="form-group{{ $errors->has('no_panggil') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-no_panggil">{{ __('No. Panggil') }}</label>
                                    <input type="text" name="no_panggil" id="input-no_panggil" class="form-control form-control-alternative{{ $errors->has('no_panggil') ? ' is-invalid' : '' }}" placeholder="{{ __('No. Panggil') }}" value="{{ old('no_panggil', $biblio->no_panggil) }}">

                                    @if ($errors->has('no_panggil'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('no_panggil') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                {{-- EDISI --}}
                                <div class="form-group{{ $errors->has('edisi') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-edisi">{{ __('Edisi') }}</label>
                                    <input type="text" name="edisi" id="input-edisi" class="form-control form-control-alternative{{ $errors->has('edisi') ? ' is-invalid' : '' }}" placeholder="{{ __('Edisi') }}" value="{{ old('edisi', $biblio->edisi) }}">

                                    @if ($errors->has('edisi'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('edisi') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                {{-- BAHASA --}}
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('Bahasa') }}</label>
                                    <div class="d-flex align-items-end flex-column pt-2">
                                        <div class="input-group pb-3">
                                            <select class="custom-select" name="bahasa" id="bahasa">
                                                <option></option>
                                                @foreach ($bahasa as $bhs)
                                                    @if (old('bahasa', $biblio->bahasa_id) == $bhs->id)
                                                        <option value="{{ $biblio->bahasa_id }}" selected>{{ $bhs->bahasa }}</option>
                                                    @else
                                                        <option value="{{ $bhs->id }}">{{ $bhs->bahasa }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>

                                        <div>
                                            <button class="btn btn-outline-primary" type="button" data-toggle="modal" data-target="#bahasa-form">Tambah</button>
                                        </div>
                                    </div>
                                </div>

                                {{-- KATEGORI --}}
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('Kategori') }}</label>
                                    <div class="d-flex align-items-end flex-column pt-2">
                                        <div class="input-group pb-3">
                                            <select class="custom-select" name="kategori" id="kategori">
                                                <option></option>
                                                @foreach ($kategori as $ktgr)
                                                    @if (old('kategori', $biblio->kategori_id) == $ktgr->id)
                                                        <option value="{{ $biblio->kategori_id }}" selected>{{ $ktgr->kategori }}</option>
                                                    @else
                                                        <option value="{{ $ktgr->id }}">{{ $ktgr->kategori }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>

                                        <div>
                                            <button class="btn btn-outline-primary" type="button" data-toggle="modal" data-target="#kategori-form">Tambah</button>
                                        </div>
                                    </div>
                                </div>

                                {{-- AKSES --}}
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('Akses') }}</label>
                                    <div class="d-flex align-items-end flex-column pt-2">
                                        <div class="input-group pb-3">
                                            <select class="custom-select" name="akses" id="akses">
                                                <option></option>
                                                @foreach ($akses as $acc)
                                                    @if (old('akses', $biblio->akses_id) == $acc->id)
                                                        <option value="{{ $biblio->akses_id }}" selected>{{ $acc->akses }}</option>
                                                    @else
                                                        <option value="{{ $acc->id }}">{{ $acc->akses }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>

                                        <div>
                                            <button class="btn btn-outline-primary" type="button" data-toggle="modal" data-target="#akses-form">Tambah</button>
                                        </div>
                                    </div>
                                </div>

                                {{-- LOKASI --}}
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('Lokasi') }}</label>
                                    <div class="d-flex align-items-end flex-column pt-2">
                                        <div class="input-group pb-3">
                                            <select class="custom-select" name="lokasi" id="lokasi">
                                                <option></option>
                                                @foreach ($lokasi as $loc)
                                                    @if (old('lokasi', $biblio->lokasi_id) == $loc->id)
                                                        <option value="{{ $biblio->lokasi_id }}" selected>{{ $loc->lokasi }}</option>
                                                    @else
                                                        <option value="{{ $loc->id }}">{{ $loc->lokasi }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>

                                        <div>
                                            <button class="btn btn-outline-primary" type="button" data-toggle="modal" data-target="#lokasi-form">Tambah</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h6 class="heading-small text-muted pt-5 mb-4">{{ __('Book Information') }}</h6>
                            <div class="pl-lg-4">
                                {{-- PENERBIT --}}
                                <div class="form-group{{ $errors->has('penerbit') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-penerbit">{{ __('Penerbit') }}</label>
                                    <input type="text" name="penerbit" id="input-penerbit" class="form-control form-control-alternative{{ $errors->has('penerbit') ? ' is-invalid' : '' }}" placeholder="{{ __('Penerbit') }}" value="{{ old('penerbit', $biblio->penerbit) }}">

                                    @if ($errors->has('penerbit'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('penerbit') }}</strong>
                                        </span>
                                    @endif
                                </div>
    
                                {{-- TEMPAT TERBIT --}}
                                <div class="form-group{{ $errors->has('tempat_terbit') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-tempat_terbit">{{ __('Tempat Terbit') }}</label>
                                    <input type="text" name="tempat_terbit" id="input-tempat_terbit" class="form-control form-control-alternative{{ $errors->has('Tempat Terbit') ? ' is-invalid' : '' }}" placeholder="{{ __('Tempat Terbit') }}" value="{{ old('tempat_terbit', $biblio->tempat_terbit) }}">

                                    @if ($errors->has('tempat_terbit'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('tempat_terbit') }}</strong>
                                        </span>
                                    @endif
                                </div>
    
                                {{-- TAHUN TERBIT--}}
                                <div class="form-group{{ $errors->has('tahun_terbit') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-tahun_terbit">{{ __('Tahun Terbit') }}</label>
                                    <input type="text" name="tahun_terbit" id="input-tahun_terbit" class="form-control form-control-alternative{{ $errors->has('tahun_terbit') ? ' is-invalid' : '' }}" placeholder="{{ __('Tahun Terbit') }}" value="{{ old('tahun_terbit', $biblio->tahun_terbit) }}">

                                    @if ($errors->has('tahun_terbit'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('tahun_terbit') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                {{-- JUMLAH HALAMAN --}}
                                <div class="form-group{{ $errors->has('jumlah_halaman') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-jumlah_halaman">{{ __('Jumlah Halaman') }}</label>
                                    <input type="text" name="jumlah_halaman" id="input-jumlah_halaman" class="form-control form-control-alternative{{ $errors->has('jumlah_halaman') ? ' is-invalid' : '' }}" placeholder="{{ __('Jumlah Halaman') }}" value="{{ old('jumlah_halaman', $biblio->jumlah_halaman) }}">

                                    @if ($errors->has('jumlah_halaman'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('jumlah_halaman') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                    
                                {{-- JUMLAH BUKU --}}
                                <div class="form-group{{ $errors->has('jumlah_buku') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-jumlah_buku">{{ __('Jumlah Buku') }}</label>
                                    <input type="text" name="jumlah_buku" id="input-jumlah_buku" class="form-control form-control-alternative{{ $errors->has('jumlah_buku') ? ' is-invalid' : '' }}" placeholder="{{ __('Jumlah Buku') }}" value="{{ old('jumlah_buku', $biblio->jumlah_buku) }}">

                                    @if ($errors->has('jumlah_buku'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('jumlah_buku') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                {{-- TINGGI BUKU --}}
                                <div class="form-group{{ $errors->has('tinggi_buku') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-tinggi_buku">{{ __('Tinggi Buku') }}</label>
                                    <input type="text" name="tinggi_buku" id="input-tinggi_buku" class="form-control form-control-alternative{{ $errors->has('tinggi_buku') ? ' is-invalid' : '' }}" placeholder="{{ __('Tinggi Buku') }}" value="{{ old('tinggi_buku', $biblio->tinggi_buku) }}">

                                    @if ($errors->has('tinggi_buku'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('tinggi_buku') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                {{-- KLASIFIKASI BUKU --}}
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('Klasifikasi Buku') }}</label>
                                    <div class="d-flex align-items-end flex-column pt-2">
                                        <div class="input-group pb-3">
                                            <select class="form-control" name="klasifikasi_buku" id="klasifikasi_buku">
                                                <option></option>
                                                @foreach ($klasifikasi_buku as $kb)
                                                    @if (old('klasifikasi_buku', $biblio->klasifikasi_buku_id) == $kb->id)
                                                        <option value="{{ $biblio->klasifikasi_buku_id }}" selected>{{ $kb->klasifikasi_buku }}</option>
                                                    @else
                                                        <option value="{{ $kb->id }}">{{ $kb->klasifikasi_buku }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>

                                        <div>
                                            <button class="btn btn-outline-primary" type="button" data-toggle="modal" data-target="#klasifikasi_buku-form">Tambah</button>
                                        </div>
                                    </div>
                                </div>

                                {{-- SUBJEK BUKU --}}
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('Subjek Buku') }}</label>
                                    <div class="d-flex align-items-end flex-column pt-2">
                                        <div class="input-group pb-3">
                                            <select class="form-control" name="subjek_buku" id="subjek_buku">
                                                <option></option>
                                                @foreach ($subjek_buku as $sb)
                                                    @if (old('subjek_buku', $biblio->subjek_id) == $sb->id)
                                                        <option value="{{ $biblio->subjek_id }}" selected>{{ $sb->subjek }}</option>
                                                    @else
                                                        <option value="{{ $sb->id }}">{{ $sb->subjek }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>

                                        <div>
                                            <button class="btn btn-outline-primary" type="button" data-toggle="modal" data-target="#subjek_buku-form">Tambah</button>
                                        </div>
                                    </div>
                                </div>

                                 {{-- BENTUK KARYA TULIS --}}
                                 <div class="form-group">
                                    <label class="form-control-label">{{ __('Bentuk Karya Tulis') }}</label>
                                    <div class="d-flex align-items-end flex-column pt-2">
                                        <div class="input-group pb-3">
                                            <select class="form-control" name="karya_tulis" id="karya_tulis">
                                                <option></option>
                                                @foreach ($karya_tulis as $kt)
                                                    @if (old('bentuk_karya_tulis', $biblio->karya_tulis_id) == $kt->id)
                                                        <option value="{{ $biblio->karya_tulis_id }}" selected>{{ $kt->bentuk_karya_tulis }}</option>
                                                    @else
                                                        <option value="{{ $kt->id }}">{{ $kt->bentuk_karya_tulis }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>

                                        <div>
                                            <button class="btn btn-outline-primary" type="button" data-toggle="modal" data-target="#karya_tulis-form">Tambah</button>
                                        </div>
                                    </div>
                                </div>

                                {{-- JENIS BUKU --}}
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('Jenis Buku') }}</label>
                                    <div class="d-flex align-items-end flex-column pt-2">
                                        <div class="input-group pb-3">
                                            <select class="form-control" name="jenis_buku" id="jenis_buku">
                                                <option></option>
                                                @foreach ($jenis_buku as $jb)
                                                    @if (old('jenis_buku', $biblio->jenis_buku_id) == $jb->id)
                                                        <option value="{{ $biblio->jenis_buku_id }}" selected>{{ $jb->jenis_buku }}</option>
                                                    @else
                                                        <option value="{{ $jb->id }}">{{ $jb->jenis_buku }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>

                                        <div>
                                            <button class="btn btn-outline-primary" type="button" data-toggle="modal" data-target="#jenis_buku-form">Tambah</button>
                                        </div>
                                    </div>
                                </div>

                                {{-- OPAC --}}
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('OPAC') }}</label>
                                    @if ($biblio->opac === 'show')
                                        <div>
                                            <div class="custom-control custom-radio mb-4">
                                                <input name="opac" class="custom-control-input" id="show" type="radio" value="show" checked>
                                                <label class="custom-control-label" for="show">Show</label>
                                            </div>
                                            <div class="custom-control custom-radio mb-3">
                                                <input name="opac" class="custom-control-input" id="hide" type="radio" value="hide">
                                                <label class="custom-control-label" for="hide">Hide</label>
                                            </div>
                                        </div>
                                    @else
                                        <div>
                                            <div class="custom-control custom-radio mb-4">
                                                <input name="opac" class="custom-control-input" id="show" type="radio" value="show">
                                                <label class="custom-control-label" for="show">Show</label>
                                            </div>
                                            <div class="custom-control custom-radio mb-3">
                                                <input name="opac" class="custom-control-input" id="hide" type="radio" value="hide" checked>
                                                <label class="custom-control-label" for="hide">Hide</label>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                {{-- COVER --}}
                                <div class="form-group{{ $errors->has('cover') ? ' has-danger' : '' }}">
                                    <label for="cover" class="form-control-label">{{ __('Book Cover') }}</label>
            
                                    <input type="file" class="form-control-file @error('cover') is-invalid @enderror" id="cover" name="cover">
                                    @error('cover')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- FILE --}}
                                <div class="form-group{{ $errors->has('file') ? ' has-danger' : '' }}">
                                    <label for="file" class="form-control-label">{{ __('Book File') }}</label>
            
                                    <input type="file" class="form-control-file @error('file') is-invalid @enderror" id="file" name="file">
                                    @error('file')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- DESKRIPSI BUKU --}}
                                <div class="form-group{{ $errors->has('deskripsi') ? ' has-danger' : '' }}">
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <label class="form-control-label pt-3" for="input-deskripsi">{{ __('Deskripsi Buku') }}</label>
                                        </div>
                                        
                                        <div class="col-12 pb-3">
                                            <textarea maxlength="200" style="height:180px" name="deskripsi" id="input-deskripsi" class="form-control form-control-alternative{{ $errors->has('deskripsi') ? ' is-invalid' : '' }}" placeholder="{{ __('Deskripsi Buku') }}">{{ old('deskripsi', $biblio->deskripsi) }}</textarea>
                                        </div>
                                        
                                        <div class="col-12 text-right">
                                            <label class="text-right" id="max" for="input-deskripsi">{{ __('Tersisa: 200 Karakter') }}</label>
                                        </div>
                                    </div>

                                    @if ($errors->has('deskripsi'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('deskripsi') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="heading-small text-muted pt-5 mb-4">{{ __('Author Information') }}</h6>
                                <button class="btn btn-sm btn-outline-primary" type="button" data-toggle="modal" data-target="#author-form">Tambah</button>
                            </div>
                            <div class="pl-lg-4">
                                {{-- PENGARANG UTAMA --}}
                                @php
                                    $selected = null
                                @endphp
                                
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('Pengarang Utama') }}</label>
                                    <div class="d-flex align-items-end flex-column pt-2">
                                        <div class="input-group pb-3">
                                            <select class="form-control" name="authorPrimary" id="authorPrimary">
                                                <option></option>
                                                @foreach ($authorPrimary as $ap)
                                                    @foreach ($authorBook as $ab)
                                                        @if (old('pengarang_utama', $ap->id) == $ab->authors_id && $ab->buku_id == $biblio->buku_id)
                                                            <option value="{{ $ap->id }}" selected>{{ $ap->name }}</option>

                                                            @php
                                                                $selected = $ap->id
                                                            @endphp
                                                        @endif
                                                    @endforeach

                                                    @if ($selected != $ap->id)
                                                        <option value="{{ $ap->id }}">{{ $ap->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                {{-- PENGARANG TAMBAHAN --}}
                                @php
                                    $selected = null
                                @endphp

                                <div class="form-group">
                                    <label class="form-control-label">{{ __('Pengarang Tambahan') }}</label>
                                    <div class="d-flex align-items-end flex-column pt-2">
                                        <div class="input-group pb-3">
                                            <select class="form-control" name="authorAdditional[]" id="authorAdditional" multiple="multiple">
                                                <option></option>
                                                @foreach ($authorAdditional as $ad)
                                                    @foreach ($authorBook as $ab)
                                                        @if (old('pengarang_tambahan', $ad->id) == $ab->authors_id && $ab->buku_id == $biblio->buku_id)
                                                            <option value="{{ $ad->id }}" selected>{{ $ad->name }}</option>

                                                            @php
                                                                $selected = $ad->id
                                                            @endphp
                                                        @endif
                                                    @endforeach

                                                    @if ($selected != $ad->id)
                                                        <option value="{{ $ad->id }}">{{ $ad->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h6 class="heading-small text-muted pt-5 mb-4">{{ __('Book Source') }}</h6>
                            <div class="pl-lg-4">
                                {{-- JENIS SUMBER --}}
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('Jenis Sumber') }}</label>
                                    <div class="d-flex align-items-end flex-column pt-2">
                                        <div class="input-group pb-3">
                                            <select class="form-control" name="jenis" id="jenis">
                                                <option></option>
                                                @foreach ($sumber as $js)
                                                    @if (old('jenis_sumber', $biblio->jenis_sumber_id) == $js->id)
                                                        <option value="{{ $biblio->jenis_sumber_id }}" selected>{{ $js->jenis_sumber }}</option>
                                                    @else
                                                        <option value="{{ $js->id }}">{{ $js->jenis_sumber }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>

                                        <div>
                                            <button class="btn btn-outline-primary" type="button" data-toggle="modal" data-target="#sumber-form">Tambah</button>
                                        </div>
                                    </div>
                                </div>

                                {{-- NAMA SUMBER --}}
                                <div class="form-group{{ $errors->has('nama_sumber') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-nama_sumber">{{ __('Nama Sumber') }}</label>
                                    <input type="text" name="nama_sumber" id="input-nama_sumber" class="form-control form-control-alternative{{ $errors->has('nama_sumber') ? ' is-invalid' : '' }}" placeholder="{{ __('Nama Sumber') }}" value="{{ old('nama_sumber', $biblio->nama_sumber) }}">

                                    @if ($errors->has('nama_sumber'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nama_sumber') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <h6 class="heading-small text-muted pt-5 mb-4">{{ __('Book Price') }}</h6>
                            <div class="pl-lg-4">
                                {{-- MATA UANG --}}
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('Mata Uang') }}</label>
                                    <div class="d-flex align-items-end flex-column pt-2">
                                        <div class="input-group pb-3">
                                            <select class="form-control" name="mata_uang" id="mata_uang">
                                                <option></option>
                                                @foreach ($currency as $mu)
                                                    @if (old('currency', $biblio->mata_uang_id) == $mu->code)
                                                        <option value="{{ $biblio->mata_uang_id }}" selected>{{ $mu->currency }}  ({{ $mu->code }})</option>
                                                    @else
                                                        <option value="{{ $mu->code }}">{{ $mu->currency }}  ({{ $mu->code }})</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>

                                        <div>
                                            <button class="btn btn-outline-primary" type="button" data-toggle="modal" data-target="#currency-form">Tambah</button>
                                        </div>
                                    </div>
                                </div>

                                {{-- HARGA --}}
                                <div class="form-group{{ $errors->has('harga') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-harga">{{ __('Harga') }}</label>
                                    <input type="text" name="harga" id="input-harga" class="form-control form-control-alternative{{ $errors->has('harga') ? ' is-invalid' : '' }}" placeholder="{{ __('Harga') }}" value="{{ old('harga', $biblio->harga) }}">

                                    @if ($errors->has('harga'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('harga') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>

    {{-- Popup for Section Form --}}
    @include('bibliografi.books.addSection')

    <script type="text/javascript" src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
    <link href="{{ asset('select2') }}/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="{{ asset('select2') }}/dist/js/select2.min.js"></script>
    <script src="{{ asset('js') }}/bibliografi.js"></script>
@endsection