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
                                    <img src="{{ asset('argon') }}/img/theme/team-4-800x800.jpg" class="rounded-circle">
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
                                {{ auth()->user()->name }}<span class="font-weight-light"></span>
                            </h3>
                            @if (auth()->user()->level == 4)
                                @foreach ($profile as $data)
                                    <div class="h5 font-weight-300">
                                        <i class="ni location_pin mr-2"></i>{{ $data->tempat_lahir ?? '' }}
                                    </div>
                                    <div class="h5 font-weight-300">
                                            <i class="ni location_pin mr-2"></i>{{ date('m-d-Y', strtotime("$data->tanggal_lahir")) ?? '' }}
                                        </div>
                                    <hr class="my-4" />
                                    <div class="h5 mt-4">
                                        <i class="ni business_briefcase-24 mr-2"></i>{{ $data->alamat ?? '' }}
                                    </div>
                                    <div>
                                        <i class="ni education_hat mr-2"></i>No. HP: {{ $data->no_hp ?? '-' }}
                                    </div>
                                @endforeach
                            @endif
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
                        <form method="post" action="{{ route('profile.update') }}" autocomplete="off">
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

                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                    <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email', auth()->user()->email) }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                @if (auth()->user()->level == 4)
                                    @foreach ($profile as $data)
                                        <div class="form-group{{ $errors->has('tempat_lahir') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-tempat_lahir">{{ __('Tempat Lahir') }}</label>
                                            <input type="text" name="tempat_lahir" id="input-tempat_lahir" class="form-control form-control-alternative{{ $errors->has('tempat_lahir') ? ' is-invalid' : '' }}" placeholder="{{ __('Tempat Lahir') }}" value="{{ old('tempat_lahir', $data->tempat_lahir) }}" required>

                                            @if ($errors->has('tempat_lahir'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('tempat_lahir') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        
                                        <div class="form-group{{ $errors->has('tanggal_lahir') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-tanggal_lahir">{{ __('Tanggal Lahir') }}</label>
                                            <input type="date" name="tanggal_lahir" id="input-tanggal_lahir" class="form-control form-control-alternative{{ $errors->has('tanggal_lahir') ? ' is-invalid' : '' }}" placeholder="{{ __('Tanggal Lahir') }}" value="{{ old('tanggal_lahir', $data->tanggal_lahir) }}" required>

                                            @if ($errors->has('tanggal_lahir'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('tanggal_lahir') }}</strong>
                                                </span>
                                            @endif
                                        </div> 

                                        <div class="form-group{{ $errors->has('alamat') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-alamat">{{ __('Alamat') }}</label>
                                            <input type="text" name="alamat" id="input-alamat" class="form-control form-control-alternative{{ $errors->has('alamat') ? ' is-invalid' : '' }}" placeholder="{{ __('Alamat') }}" value="{{ old('alamat', $data->alamat) }}" required>

                                            @if ($errors->has('alamat'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('alamat') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group{{ $errors->has('no_hp') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-no_hp">{{ __('No. HP') }}</label>
                                            <input type="text" name="no_hp" id="input-no_hp" class="form-control form-control-alternative{{ $errors->has('no_hp') ? ' is-invalid' : '' }}" placeholder="{{ __('No. HP') }}" value="{{ old('no_hp', $data->no_hp) }}" required>

                                            @if ($errors->has('no_hp'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('no_hp') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    @endforeach
                                @endif

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