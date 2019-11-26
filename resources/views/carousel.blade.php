@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Carousel Event</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="card-body">
                        <div class="row">
                            {{-- FIRST CAROUSEL --}}
                            <div class="col-lg-6">
                                <hr class="my-4"/>
                                <h6 class="heading-small text-muted mt-4">{{ __('First Carousel') }}</h6>
                                
                                @if ($carouselFirst != null) 
                                    <img style="max-width:100%; max-height:100%" src="{{ asset('storage') }}/carousel/{{ $carouselFirst }}" alt="">
                                @else
                                    <img style="max-width:100%; max-height:100%" src="{{ asset('argon') }}/img/carousel/default1.jpg" alt="">
                                @endif

                                <form enctype="multipart/form-data" action="/carousel-event/1" method="post">
                                    @csrf
                                    @method('put')
    
                                    {{-- COVER --}}
                                    <div class="form-group{{ $errors->has('cover') ? ' has-danger' : '' }} mt-3">
                                        <label for="cover" class="form-control-label">{{ __('Change First Carousel') }}</label>
                
                                        <input type="file" class="form-control-file{{ $errors->has('cover') ? ' is-invalid' : '' }}" id="cover" name="cover" required>
                                        
                                        <div>
                                            @if ($errors->has('cover'))
                                                <span style="color:#f5365c">
                                                    <small>
                                                        <strong>{{ $errors->first('cover') }}</strong>
                                                    </small>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-success mt-4">{{ __('Change') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            
                            {{-- SECOND CAROUSEL --}}
                            <div class="col-lg-6">
                                <hr class="my-4"/>
                                <h6 class="heading-small text-muted mt-4">{{ __('Second Carousel') }}</h6>
                                
                                @if ($carouselSecond != null) 
                                    <img style="max-width:100%; max-height:100%" src="{{ asset('storage') }}/carousel/{{ $carouselSecond }}" alt="">
                                @else
                                    <img style="max-width:100%; max-height:100%" src="{{ asset('argon') }}/img/carousel/default2.jpg" alt="">
                                @endif

                                <form enctype="multipart/form-data" action="/carousel-event/2" method="post">
                                    @csrf
                                    @method('put')
    
                                    {{-- COVER --}}
                                    <div class="form-group{{ $errors->has('cover') ? ' has-danger' : '' }} mt-3">
                                        <label for="cover" class="form-control-label">{{ __('Change Second Carousel') }}</label>
                
                                        <input type="file" class="form-control-file{{ $errors->has('cover') ? ' is-invalid' : '' }}" id="cover" name="cover" required>
                                        
                                        <div>
                                            @if ($errors->has('cover'))
                                                <span style="color:#f5365c">
                                                    <small>
                                                        <strong>{{ $errors->first('cover') }}</strong>
                                                    </small>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-success mt-4">{{ __('Change') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            {{-- THIRD CAROUSEL --}}
                            <div class="col-lg-6">
                                <hr class="my-4"/>
                                <h6 class="heading-small text-muted mt-4">{{ __('Third Carousel') }}</h6>
                                
                                @if ($carouselThird != null) 
                                    <img style="max-width:100%; max-height:100%" src="{{ asset('storage') }}/carousel/{{ $carouselThird }}" alt="">
                                @else
                                    <img style="max-width:100%; max-height:100%" src="{{ asset('argon') }}/img/carousel/default3.jpg" alt="">
                                @endif

                                <form enctype="multipart/form-data" action="/carousel-event/3" method="post">
                                    @csrf
                                    @method('put')
    
                                    {{-- COVER --}}
                                    <div class="form-group{{ $errors->has('cover') ? ' has-danger' : '' }} mt-3">
                                        <label for="cover" class="form-control-label">{{ __('Change Third Carousel') }}</label>
                
                                        <input type="file" class="form-control-file{{ $errors->has('cover') ? ' is-invalid' : '' }}" id="cover" name="cover" required>
                                        
                                        <div>
                                            @if ($errors->has('cover'))
                                                <span style="color:#f5365c">
                                                    <small>
                                                        <strong>{{ $errors->first('cover') }}</strong>
                                                    </small>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-success mt-4">{{ __('Change') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            {{-- FORTH CAROUSEL --}}
                            <div class="col-lg-6">
                                <hr class="my-4"/>
                                <h6 class="heading-small text-muted mt-4">{{ __('Fourth Carousel') }}</h6>
                                
                                @if ($carouselFourth != null) 
                                    <img style="max-width:100%; max-height:100%" src="{{ asset('storage') }}/carousel/{{ $carouselFourth }}" alt="">
                                @else
                                    <img style="max-width:100%; max-height:100%" src="{{ asset('argon') }}/img/carousel/default4.jpg" alt="">
                                @endif
                            
                                <form enctype="multipart/form-data" action="/carousel-event/4" method="post">
                                    @csrf
                                    @method('put')
    
                                    {{-- COVER --}}
                                    <div class="form-group{{ $errors->has('cover') ? ' has-danger' : '' }} mt-3">
                                        <label for="cover" class="form-control-label">{{ __('Change Fourth Carousel') }}</label>
                
                                        <input type="file" class="form-control-file{{ $errors->has('cover') ? ' is-invalid' : '' }}" id="cover" name="cover" required>
                                        
                                        <div>
                                            @if ($errors->has('cover'))
                                                <span style="color:#f5365c">
                                                    <small>
                                                        <strong>{{ $errors->first('cover') }}</strong>
                                                    </small>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-success mt-4">{{ __('Change') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection