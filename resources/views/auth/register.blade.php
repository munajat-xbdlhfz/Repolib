@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
    @include('layouts.headers.guest')

    <div class="container mt--8 pb-5">
        <!-- Table -->
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-5">
                            <h2>REGISTER NEW ACCOUNT</h2>
                        </div>
                        <form role="form" method="POST" action="{{ route('register') }}">
                            @csrf
                            {{-- NAMA --}}
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                    </div>
                                    <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="@lang('form.name')" type="text" name="name" value="{{ old('name') }}" required autofocus>
                                </div>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            {{-- EMAIL --}}
                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="@lang('form.email')" type="email" name="email" value="{{ old('email') }}" required>
                                </div>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            {{-- PASSWORD --}}
                            <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="@lang('form.password')" type="password" name="password" required>
                                </div>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            {{-- CONFIRM PASSWORD --}}
                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="@lang('form.confirm_password')" type="password" name="password_confirmation" required>
                                </div>
                            </div>

                            {{-- KODE PELAJAR/KTP/PASSPOR --}}
                            <div class="form-group{{ $errors->has('kode') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                    </div>
                                    <input class="form-control{{ $errors->has('kode') ? ' is-invalid' : '' }}" placeholder="@lang('form.user_id')" type="text" name="kode" value="{{ old('kode') }}" required autofocus>
                                </div>
                                @if ($errors->has('kode'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('kode') }}</strong>
                                    </span>
                                @endif
                            </div>

                            {{-- ALAMAT --}}
                            <div class="form-group{{ $errors->has('alamat') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-square-pin"></i></span>
                                    </div>
                                    <input class="form-control{{ $errors->has('alamat') ? ' is-invalid' : '' }}" placeholder="@lang('form.address')" type="text" name="alamat" value="{{ old('alamat') }}" required autofocus>
                                </div>
                                @if ($errors->has('alamat'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('alamat') }}</strong>
                                    </span>
                                @endif
                            </div>

                            {{-- PROVINSI --}}
                            <div class="form-group{{ $errors->has('provinsi') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-city"></i></span>
                                    </div>
                                    <input class="form-control{{ $errors->has('provinsi') ? ' is-invalid' : '' }}" placeholder="@lang('form.province')" type="text" name="provinsi" value="{{ old('provinsi') }}" required autofocus>
                                </div>
                                @if ($errors->has('provinsi'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('provinsi') }}</strong>
                                    </span>
                                @endif
                            </div>

                            {{-- KODE POS --}}
                            <div class="form-group{{ $errors->has('kode_pos') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-map-pin"></i></span>
                                    </div>
                                    <input class="form-control{{ $errors->has('kode_pos') ? ' is-invalid' : '' }}" placeholder="@lang('form.postal_code')" type="text" name="kode_pos" value="{{ old('kode_pos') }}" required autofocus>
                                </div>
                                @if ($errors->has('kode_pos'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ 'Postal code must be a number' }}</strong>
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
                                        <input class="form-check-input" type="radio" name="warga_negara" id="warga_negara" value="{{ $wn }}" required>
                                        <label class="form-check-label" style="text-transform:capitalize">{{ $wn }}</label>
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
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin" value="{{ $jk }}" required>
                                        <label class="form-check-label" style="text-transform:capitalize">{{ $jk }}</label>
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

                            {{-- POLICY --}}
                            <div class="row my-4">
                                    <div class="col-12">
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            <input class="custom-control-input" id="customCheckRegister" type="checkbox">
                                            <label class="custom-control-label" for="customCheckRegister">
                                                <span class="text-muted">{{ __('I agree with the') }} <a href="#!">{{ __('Privacy Policy') }}</a></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary mt-4">{{ __('Create account') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
    <link href="{{ asset('select2') }}/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="{{ asset('select2') }}/dist/js/select2.min.js"></script>
    <script>
        $('#warga_negara').select2({
                placeholder: "Warga Negara",
                allowClear: true
            });
    </script>
@endsection
