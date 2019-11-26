@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Hello') . ' '. auth()->user()->name,
        'description' => __('This is your profile page. You can see the progress you\'ve made with your work and manage your projects or assigned tasks'),
        'class' => 'col-lg-7'
    ])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                <div class="card card-profile shadow">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                                <a href="#">
                                    @foreach ($profile as $data)
                                        @if ($data->foto ==  null)
                                            <img src="{{ asset('argon') }}/img/theme/team-4-800x800.jpg" class="rounded-circle">
                                        @else
                                            <img src="{{ asset('storage') }}/profile/{{ $data->foto }}" class="rounded-circle">
                                        @endif
                                    @endforeach
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4"></div>

                    <div class="card-body pt-8 pt-md-4">
                        <div class="row">
                            <div class="col">
                                <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                                    
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <h3>
                                {{ ucfirst(auth()->user()->name) }}<span class="font-weight-light"></span>
                            </h3>
                            <p>Kode Anggota : {{ auth()->user()->kode_anggota }}</p>
                            <p class="mt--3">Jenis Kelamin : {{ auth()->user()->jenis_kelamin }}</p>
                            <p class="mt--3">Warga Negara : {{ auth()->user()->warga_negara }}</p>
                            <hr class="my-4"/>
                            <p>{{ ucfirst(auth()->user()->alamat) }}, {{ ucfirst(auth()->user()->provinsi) }}</p>

                            @foreach ($profile as $data)
                                @if ($data->tempat_lahir != null || $data->tangal_lahir != null)
                                    <p class="mt--3">{{ $data->tempat_lahir ?? '' }}
                                        @if ($data->tanggal_lahir != null)
                                            , {{date('d-M-Y', strtotime("$data->tanggal_lahir")) }}
                                        @endif
                                    </p>
                                @endif    

                                <p class="mt--3">Pekerjaan : {{ $data->pekerjaan ?? '-' }}</p>
                                <p class="mt--3">Pendidikan Terakhir : {{ $data->pendidikan ?? '-' }}</p>
                                <p class="mt--3">No. HP : {{ $data->no_hp ?? '-' }}</p>
                            @endforeach
                        </div>         
                    </div>
                </div>
            </div>
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('Edit Profile') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- CHANGE PROFILE DATA --}}
                        <form enctype="multipart/form-data" method="post" action="{{ route('profile.update') }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('User information') }}</h6>
                            
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            {{-- NAMA --}}
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', auth()->user()->name) }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                {{-- EMAIL --}}
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                    <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email', auth()->user()->email) }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                {{-- ALAMAT --}}
                                <div class="form-group{{ $errors->has('alamat') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-alamat">{{ __('Alamat') }}</label>
                                    <input type="text" name="alamat" id="input-alamat" class="form-control form-control-alternative{{ $errors->has('alamat') ? ' is-invalid' : '' }}" placeholder="{{ __('Alamat') }}" value="{{ old('alamat',auth()->user()->alamat) }}" required>

                                    @if ($errors->has('alamat'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('alamat') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                {{-- PROVINSI --}}
                                <div class="form-group{{ $errors->has('provinsi') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-provinsi">{{ __('Provinsi') }}</label>
                                    <input type="text" name="provinsi" id="input-provinsi" class="form-control form-control-alternative{{ $errors->has('provinsi') ? ' is-invalid' : '' }}" placeholder="{{ __('Provinsi') }}" value="{{ old('provinsi', auth()->user()->provinsi) }}" required>

                                    @if ($errors->has('provinsi'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('provinsi') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                {{-- KODE --}}
                                <div class="form-group{{ $errors->has('kode') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-kode">{{ __('No. KTP/Pelajar/Passport') }}</label>
                                    <input type="text" name="kode" id="input-kode" class="form-control form-control-alternative{{ $errors->has('kode') ? ' is-invalid' : '' }}" placeholder="{{ __('No. KTP/Pelajar/Passport') }}" value="{{ old('kode', auth()->user()->kode) }}" required>

                                    @if ($errors->has('kode'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('kode') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                {{-- KODE POS --}}
                                <div class="form-group{{ $errors->has('kode_pos') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-kode_pos">{{ __('Kode POS') }}</label>
                                    <input type="text" name="kode_pos" id="input-kode_pos" class="form-control form-control-alternative{{ $errors->has('kode_pos') ? ' is-invalid' : '' }}" placeholder="{{ __('Kode POS') }}" value="{{ old('kode_pos', auth()->user()->kode_pos) }}" required>

                                    @if ($errors->has('kode_pos'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('kode_pos') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                {{-- WARGA NEGARA --}}
                                @php
                                    $warga_negara = ['WNI', 'WNA'];
                                @endphp
                                <label class="form-control-label pt-3">{{ __('Warga Negara') }}</label>
                                <div class="form-group{{ $errors->has('warga_negara') ? ' has-danger' : '' }}">
                                    <div class="row">
                                    @foreach ($warga_negara as $wn)
                                        <div class="col-12">
                                            <div class="form-check form-check-inline">
                                                @if (auth()->user()->warga_negara == $wn)
                                                    <input class="form-check-input" type="radio" name="warga_negara" id="warga_negara" value="{{ $wn }}" required checked>
                                                    <label class="form-check-label" style="text-transform:capitalize">{{ $wn }}</label>    
                                                @else
                                                    <input class="form-check-input" type="radio" name="warga_negara" id="warga_negara" value="{{ $wn }}" required>
                                                    <label class="form-check-label" style="text-transform:capitalize">{{ $wn }}</label>
                                                @endif    
                                            </div>
                                        </div>
                                    @endforeach
                                    </div>

                                    @if ($errors->has('warga_negara'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('warga_negara') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                {{-- JENIS KELAMIN --}}
                                @php
                                    $jenis_kelamin = ['Laki-Laki', 'Perempuan', 'Lainnya'];
                                @endphp
                                <label class="form-control-label pt-3">{{ __('Jenis Kelamin') }}</label>
                                <div class="form-group{{ $errors->has('jenis_kelamin') ? ' has-danger' : '' }}">
                                    <div class="row">
                                    @foreach ($jenis_kelamin as $jk)
                                        <div class="col-12">
                                            <div class="form-check form-check-inline">
                                                @if (auth()->user()->jenis_kelamin == $jk)
                                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin" value="{{ $jk }}" required checked>
                                                    <label class="form-check-label" style="text-transform:capitalize">{{ $jk }}</label>
                                                @else
                                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin" value="{{ $jk }}" required>
                                                    <label class="form-check-label" style="text-transform:capitalize">{{ $jk }}</label>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                    </div>

                                    @if ($errors->has('jenis_kelamin'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('jenis_kelamin') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                @foreach ($profile as $data)
                                    <div class="form-group{{ $errors->has('tempat_lahir') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-tempat_lahir">{{ __('Tempat Lahir') }}</label>
                                        <input type="text" name="tempat_lahir" id="input-tempat_lahir" class="form-control form-control-alternative{{ $errors->has('tempat_lahir') ? ' is-invalid' : '' }}" placeholder="{{ __('Tempat Lahir') }}" value="{{ old('tempat_lahir', $data->tempat_lahir) }}">

                                        @if ($errors->has('tempat_lahir'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('tempat_lahir') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <div class="form-group{{ $errors->has('tanggal_lahir') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-tanggal_lahir">{{ __('Tanggal Lahir') }}</label>
                                        <input type="date" name="tanggal_lahir" id="input-tanggal_lahir" class="form-control form-control-alternative{{ $errors->has('tanggal_lahir') ? ' is-invalid' : '' }}" placeholder="{{ __('Tanggal Lahir') }}" value="{{ old('tanggal_lahir', $data->tanggal_lahir) }}">

                                        @if ($errors->has('tanggal_lahir'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('tanggal_lahir') }}</strong>
                                            </span>
                                        @endif
                                    </div> 

                                    <div class="form-group{{ $errors->has('no_hp') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-no_hp">{{ __('No. HP') }}</label>
                                        <input type="text" name="no_hp" id="input-no_hp" class="form-control form-control-alternative{{ $errors->has('no_hp') ? ' is-invalid' : '' }}" placeholder="{{ __('No. HP') }}" value="{{ old('no_hp', $data->no_hp) }}">

                                        @if ($errors->has('no_hp'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('no_hp') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('pekerjaan') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-pekerjaan">{{ __('Pekerjaan') }}</label>
                                        <input type="text" name="pekerjaan" id="input-pekerjaan" class="form-control form-control-alternative{{ $errors->has('pekerjaan') ? ' is-invalid' : '' }}" placeholder="{{ __('Pekerjaan') }}" value="{{ old('pekerjaan', $data->pekerjaan) }}">

                                        @if ($errors->has('pekerjaan'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('pekerjaan') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('pendidikan') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-pendidikan">{{ __('Pendidikan Terakhir') }}</label>
                                        <input type="text" name="pendidikan" id="input-pendidikan" class="form-control form-control-alternative{{ $errors->has('pendidikan') ? ' is-invalid' : '' }}" placeholder="{{ __('Pendidikan Terakhir') }}" value="{{ old('pendidikan', $data->pendidikan) }}">

                                        @if ($errors->has('pendidikan'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('pendidikan') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    {{-- PROFILE --}}
                                    <div class="form-group{{ $errors->has('profile') ? ' has-danger' : '' }}">
                                        <label for="profile" class="form-control-label">{{ __('Photo Profile') }}</label>
                
                                        <input type="file" class="form-control-file{{ $errors->has('profile') ? ' is-invalid' : '' }}" id="profile" name="profile">
                                        
                                        <div>
                                            @if ($errors->has('profile'))
                                                <span style="color:#f5365c">
                                                    <small>
                                                        <strong>{{ $errors->first('profile') }}</strong>
                                                    </small>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>

                        {{-- CHANGE PASSWORD --}}
                        <hr class="my-4" />
                        <form method="post" action="{{ route('profile.password') }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('Password') }}</h6>

                            @if (session('password_status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('password_status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-current-password">{{ __('Current Password') }}</label>
                                    <input type="password" name="old_password" id="input-current-password" class="form-control form-control-alternative{{ $errors->has('old_password') ? ' is-invalid' : '' }}" placeholder="{{ __('Current Password') }}" value="" required>
                                    
                                    @if ($errors->has('old_password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('old_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-password">{{ __('New Password') }}</label>
                                    <input type="password" name="password" id="input-password" class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" value="" required>
                                    
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-password-confirmation">{{ __('Confirm New Password') }}</label>
                                    <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control form-control-alternative" placeholder="{{ __('Confirm New Password') }}" value="" required>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Change password') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection