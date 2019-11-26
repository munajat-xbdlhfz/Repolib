@extends('layouts.app', ['title' => __('User Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Add CD Data')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                
                            </div>
                            <div class="col-4 text-right">
                                <a href="/bibliografi/cd" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form enctype="multipart/form-data" method="post" action="/bibliografi/cd" autocomplete="off">
                            @csrf
                            
                            <h6 class="heading-small text-muted mb-4">{{ __('Bibliografi Information') }}</h6>
                            <div class="pl-lg-4">
                                {{-- JUDUL --}}
                                <div class="form-group{{ $errors->has('judul') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-judul">{{ __('Judul') }}</label>
                                    <input type="text" name="judul" id="input-judul" class="form-control form-control-alternative{{ $errors->has('judul') ? ' is-invalid' : '' }}" placeholder="{{ __('Judul') }}" value="{{ old('judul') }}" required autofocus>

                                    @if ($errors->has('judul'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('judul') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                {{-- ANAK JUDUL --}}
                                <div class="form-group{{ $errors->has('anak_judul') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-anak_judul">{{ __('Anak Judul') }}</label>
                                    <input type="text" name="anak_judul" id="input-anak_judul" class="form-control form-control-alternative{{ $errors->has('anak_judul') ? ' is-invalid' : '' }}" placeholder="{{ __('Anak Judul') }}" value="{{ old('anak_judul') }}">

                                    @if ($errors->has('anak_judul'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('anak_judul') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                {{-- ISBN --}}
                                <div class="form-group{{ $errors->has('isbn') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-isbn">{{ __('ISBN') }}</label>
                                    <input type="text" name="isbn" id="input-isbn" class="form-control form-control-alternative{{ $errors->has('isbn') ? ' is-invalid' : '' }}" placeholder="{{ __('ISBN') }}" value="{{ old('isbn') }}">

                                    @if ($errors->has('isbn'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('isbn') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                {{-- NO PANGGIL --}}
                                <div class="form-group{{ $errors->has('no_panggil') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-no_panggil">{{ __('No. Panggil') }}</label>
                                    <input type="text" name="no_panggil" id="input-no_panggil" class="form-control form-control-alternative{{ $errors->has('no_panggil') ? ' is-invalid' : '' }}" placeholder="{{ __('No. Panggil') }}" value="{{ old('no_panggil') }}">

                                    @if ($errors->has('no_panggil'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('no_panggil') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                {{-- EDISI --}}
                                <div class="form-group{{ $errors->has('edisi') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-edisi">{{ __('Edisi') }}</label>
                                    <input type="text" name="edisi" id="input-edisi" class="form-control form-control-alternative{{ $errors->has('edisi') ? ' is-invalid' : '' }}" placeholder="{{ __('Edisi') }}" value="{{ old('edisi') }}">

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
                                                    @if (old('bahasa') == $bhs->id)
                                                        <option value="{{ $bhs->id }}" selected>{{ $bhs->bahasa }}</option>
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
                                                    @if (old('kategori') == $ktgr->id)
                                                        <option value="{{ $ktgr->id }}" selected>{{ $ktgr->kategori }}</option>
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
                                                    @if (old('akses') == $acc->id)
                                                        <option value="{{ $acc->id }}" selected>{{ $acc->akses }}</option>
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
                                                    @if (old('lokasi') == $loc->id)
                                                        <option value="{{ $loc->id }}" selected>{{ $loc->lokasi }}</option>
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

                            <h6 class="heading-small text-muted pt-5 mb-4">{{ __('CD Information') }}</h6>
                            <div class="pl-lg-4">
                                {{-- PENERBIT --}}
                                <div class="form-group{{ $errors->has('penerbit') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-penerbit">{{ __('Penerbit') }}</label>
                                    <input type="text" name="penerbit" id="input-penerbit" class="form-control form-control-alternative{{ $errors->has('penerbit') ? ' is-invalid' : '' }}" placeholder="{{ __('Penerbit') }}" value="{{ old('penerbit') }}">

                                    @if ($errors->has('penerbit'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('penerbit') }}</strong>
                                        </span>
                                    @endif
                                </div>
    
                                {{-- TEMPAT TERBIT --}}
                                <div class="form-group{{ $errors->has('tempat_terbit') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-tempat_terbit">{{ __('Tempat Terbit') }}</label>
                                    <input type="text" name="tempat_terbit" id="input-tempat_terbit" class="form-control form-control-alternative{{ $errors->has('tempat_terbit') ? ' is-invalid' : '' }}" placeholder="{{ __('Tempat Terbit') }}" value="{{ old('tempat_terbit') }}">

                                    @if ($errors->has('tempat_terbit'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('tempat_terbit') }}</strong>
                                        </span>
                                    @endif
                                </div>
    
                                {{-- TAHUN TERBIT--}}
                                <div class="form-group{{ $errors->has('tahun_terbit') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-tahun_terbit">{{ __('Tahun Terbit') }}</label>
                                    <input type="text" name="tahun_terbit" id="input-tahun_terbit" class="form-control form-control-alternative{{ $errors->has('tahun_terbit') ? ' is-invalid' : '' }}" placeholder="{{ __('Tahun Terbit') }}" value="{{ old('tahun_terbit') }}">

                                    @if ($errors->has('tahun_terbit'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('tahun_terbit') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                {{-- JUMLAH KEPING --}}
                                <div class="form-group{{ $errors->has('jumlah_keping') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-jumlah_keping">{{ __('Jumlah Keping') }}</label>
                                    <input type="text" name="jumlah_keping" id="input-jumlah_keping" class="form-control form-control-alternative{{ $errors->has('jumlah_keping') ? ' is-invalid' : '' }}" placeholder="{{ __('Jumlah Keping') }}" value="{{ old('jumlah_keping') }}">

                                    @if ($errors->has('jumlah_keping'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('jumlah_keping') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                {{-- GENRE --}}
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('Genre') }}</label>
                                    <div class="d-flex align-items-end flex-column pt-2">
                                        <div class="input-group pb-3">
                                            <select class="custom-select" name="genre" id="genre">
                                                <option></option>
                                                @foreach ($genre as $gnre)
                                                    @if (old('genre') == $gnre->id)
                                                        <option value="{{ $gnre->id }}" selected>{{ $gnre->genre }}</option>
                                                    @else
                                                        <option value="{{ $gnre->id }}">{{ $gnre->genre }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>

                                        <div>
                                            <button class="btn btn-outline-primary" type="button" data-toggle="modal" data-target="#genre-form">Tambah</button>
                                        </div>
                                    </div>
                                </div>

                                {{-- COVER --}}
                                <div class="form-group{{ $errors->has('cover') ? ' has-danger' : '' }}">
                                    <label for="cover" class="form-control-label">{{ __('CD Cover') }}</label>
            
                                    <input type="file" class="form-control-file{{ $errors->has('cover') ? ' is-invalid' : '' }}" id="cover" name="cover">
                                    
                                    <div>
                                        @if ($errors->has('cover'))
                                            <span style="color:#f5365c">
                                                <small>
                                                    <strong>{{ $errors->first('cover') }}</strong>
                                                </small>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                {{-- FILE ZIP --}}
                                <div class="form-group{{ $errors->has('file') ? ' has-danger' : '' }}">
                                    <label for="input-file" class="form-control-label">{{ __('CD File') }}</label>
                                    <input type="file" class="form-control-file{{ $errors->has('file') ? ' is-invalid' : '' }}" id="input-file" name="file">
                                </div>

                                <div>
                                    @if ($errors->has('file'))
                                        <span style="color:#f5365c">
                                            <small>
                                                <strong>{{ $errors->first('file') }}</strong>
                                            </small>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <h6 class="heading-small text-muted pt-5 mb-4">{{ __('Songwriter Information') }}</h6>
                            <div class="pl-lg-4">
                                {{-- PENCIPTA --}}
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('Pencipta') }}</label>
                                    <div class="d-flex align-items-end flex-column pt-2">
                                        <div class="input-group pb-3">
                                            <select class="custom-select" name="songwriter" id="songwriter">
                                                <option></option>
                                                @foreach ($pencipta as $cipta)
                                                    @if (old('songwriter') == $cipta->id)
                                                        <option value="{{ $cipta->id }}" selected>{{ $cipta->name }}</option>
                                                    @else
                                                        <option value="{{ $cipta->id }}">{{ $cipta->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>

                                        <div>
                                            <button class="btn btn-outline-primary" type="button" data-toggle="modal" data-target="#songwriter-form">Tambah</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h6 class="heading-small text-muted pt-5 mb-4">{{ __('CD Source') }}</h6>
                            <div class="pl-lg-4">
                                {{-- JENIS SUMBER --}}
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('Jenis Sumber') }}</label>
                                    <div class="d-flex align-items-end flex-column pt-2">
                                        <div class="input-group pb-3">
                                            <select class="form-control" name="jenis" id="jenis">
                                                <option></option>
                                                @foreach ($sumber as $js)
                                                    @if (old('jenis') == $js->id)
                                                        <option value="{{ $js->id }}" selected>{{ $js->jenis_sumber }}</option>
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
                                    <input type="text" name="nama_sumber" id="input-nama_sumber" class="form-control form-control-alternative{{ $errors->has('nama_sumber') ? ' is-invalid' : '' }}" placeholder="{{ __('Nama Sumber') }}" value="{{ old('nama_sumber') }}">

                                    @if ($errors->has('nama_sumber'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nama_sumber') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <h6 class="heading-small text-muted pt-5 mb-4">{{ __('CD Price') }}</h6>
                            <div class="pl-lg-4">
                                {{-- MATA UANG --}}
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('Mata Uang') }}</label>
                                    <div class="d-flex align-items-end flex-column pt-2">
                                        <div class="input-group pb-3">
                                            <select class="form-control" name="mata_uang" id="mata_uang">
                                                <option></option>
                                                @foreach ($currency as $mu)
                                                    @if (old('mata_uang') == $mu->code)
                                                        <option value="{{ $mu->code }}" selected>{{ $mu->currency }}  ({{ $mu->code }})</option>
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
                                    <input type="text" name="harga" id="input-harga" class="form-control form-control-alternative{{ $errors->has('harga') ? ' is-invalid' : '' }}" placeholder="{{ __('Harga') }}" value="{{ old('harga') }}">

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
         {{-- Popup for Section Form --}}
        @include('bibliografi.cds.addSection')

        <script type="text/javascript" src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
        <link href="{{ asset('select2') }}/dist/css/select2.min.css" rel="stylesheet"/>
        <script src="{{ asset('select2') }}/dist/js/select2.min.js"></script>
        <script src="{{ asset('js') }}/cd.js"></script>
    </div>
@endsection