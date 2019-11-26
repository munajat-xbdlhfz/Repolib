@extends('layouts.app', ['title' => __('User Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Add User')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('User Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="/data/{{ $id }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="/data/{{ $id }}" autocomplete="off">
                            @csrf
                            
                            <h6 class="heading-small text-muted mb-4">{{ __('User information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                    <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-password">{{ __('Password') }}</label>
                                    <input type="password" name="password" id="input-password" class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" value="" required>
                                    
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-password-confirmation">{{ __('Confirm Password') }}</label>
                                    <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control form-control-alternative" placeholder="{{ __('Confirm Password') }}" value="" required>
                                </div>

                                {{-- ALAMAT --}}
                                <div class="form-group{{ $errors->has('alamat') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-alamat">{{ __('Alamat') }}</label>
                                        <input type="text" name="alamat" id="input-alamat" class="form-control form-control-alternative{{ $errors->has('alamat') ? ' is-invalid' : '' }}" placeholder="{{ __('Alamat') }}" value="" required>
    
                                        @if ($errors->has('alamat'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('alamat') }}</strong>
                                            </span>
                                        @endif
                                    </div>
    
                                    {{-- PROVINSI --}}
                                    <div class="form-group{{ $errors->has('provinsi') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-provinsi">{{ __('Provinsi') }}</label>
                                        <input type="text" name="provinsi" id="input-provinsi" class="form-control form-control-alternative{{ $errors->has('provinsi') ? ' is-invalid' : '' }}" placeholder="{{ __('Provinsi') }}" value="" required>
    
                                        @if ($errors->has('provinsi'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('provinsi') }}</strong>
                                            </span>
                                        @endif
                                    </div>
    
                                    {{-- KODE--}}
                                    <div class="form-group{{ $errors->has('kode') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-kode">{{ __('No. KTP/Pelajar/Passport') }}</label>
                                        <input type="text" name="kode" id="input-kode" class="form-control form-control-alternative{{ $errors->has('kode') ? ' is-invalid' : '' }}" placeholder="{{ __('No. KTP/Pelajar/Passport') }}" value="" required>
    
                                        @if ($errors->has('kode'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('kode') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    {{-- KODE POS --}}
                                    <div class="form-group{{ $errors->has('kode_pos') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-kode_pos">{{ __('Kode POS') }}</label>
                                        <input type="text" name="kode_pos" id="input-kode_pos" class="form-control form-control-alternative{{ $errors->has('kode_pos') ? ' is-invalid' : '' }}" placeholder="{{ __('Kode POS') }}" value="" required>
    
                                        @if ($errors->has('kode_pos'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('kode_pos') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    {{-- WARGA NEGARA --}}
                                    <div class="form-group{{ $errors->has('warga_negara') ? ' has-danger' : '' }}">
                                        <span class="ml-2">Warga Negara</span>
                                        <select class="form-control" name="warga_negara" id="warga_negara">
                                            <option value="WNI">WNI</option>
                                            <option value="WNA">WNA</option>
                                        </select>
                                    </div>

                                    {{-- LEVEL --}}
                                    <div class="form-group{{ $errors->has('level') ? ' has-danger' : '' }}">
                                        <span class="ml-2">User Level</span>
                                        <select class="form-control" name="level" id="level">
                                            @if ($id === 'admin')
                                                <option value="2">Book Admin</option>
                                                <option value="3">CD Admin</option>
                                            @else
                                                <option value="4">User</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
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