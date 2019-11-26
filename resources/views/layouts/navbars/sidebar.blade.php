<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <img src="{{ asset('argon') }}/img/brand/blue.png" class="navbar-brand-img" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                        @php
                            $profile = App\Profile::where('user_id', auth()->user()->id)->get();
                        @endphp
                        @foreach ($profile as $data)
                            @if ($data->foto ==  null)
                                <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-4-800x800.jpg">
                            @else
                                <img alt="Image placeholder" src="{{ asset('storage') }}/profile/{{ $data->foto }}">
                            @endif
                        @endforeach
                        {{--  <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-3-800x800.jpg">  --}}
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My Profile') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        @if (auth()->user()->level != 4)
                            <i class="ni ni-tv-2" style="color: #00f;"></i>
                            <span class="nav-link-text" style="color: #00f;">{{ __('Dashboard') }}</span>
                        @else
                            <i class="ni ni-tv-2" style="color: #00f;"></i>
                            <span class="nav-link-text" style="color: #00f;">{{ __('Home') }}</span>
                        @endif
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/peminjaman">
                        <i class="ni ni-books" style="color: #00f;"></i>
                        <span class="nav-link-text" style="color: #00f;">{{ __('Peminjaman') }}</span>
                    </a>
                </li>

                @if (auth()->user()->level != 4)
                    <li class="nav-item">
                        <a class="nav-link" href="/opac">
                            <i class="ni ni-world" style="color: #00f;"></i>
                            <span class="nav-link-text" style="color: #00f;">{{ __('OPAC') }}</span>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->level != 4)
                    <li class="nav-item">
                        <a class="nav-link active" href="#navbar-master" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-master">
                            <i class="ni ni-single-02" style="color: #00f;"></i>
                            <span class="nav-link-text" style="color: #00f;">{{ __('Master Data') }}</span>
                        </a>
    
                        <div class="collapse hide" id="navbar-master">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('profile.edit') }}">
                                        {{ __('User profile') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                        <a class="nav-link" href="/data/user">
                                            {{ __('Data User') }}
                                        </a>
                                    </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/data/admin">
                                        {{ __('Data Anggota') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile.edit') }}">
                            <i class="ni ni-single-02" style="color: #00f;"></i>
                            <span class="nav-link-text" style="color: #00f;">{{ __('User Profile') }}</span>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->level !== 4)
                    <li class="nav-item">
                        <a class="nav-link active" href="#navbar-bibliografi" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-bibliografi">
                            <i class="fas fa-bookmark" style="color: #00f;"></i>
                            <span class="nav-link-text" style="color: #00f;">{{ __('Monograf') }}</span>
                        </a>
    
                        <div class="collapse hide" id="navbar-bibliografi">
                            <ul class="nav nav-sm flex-column">
                                @if (auth()->user()->level !== 3)
                                <li class="nav-item">
                                        <a class="nav-link" href="/bibliografi/book">
                                            {{ __('Daftar Bibliografi') }}
                                        </a>
                                    </li>
    
                                    <li class="nav-item">
                                        <a class="nav-link" href="/bibliografi/book/author">
                                            {{ __('Daftar Pengarang') }}
                                        </a>
                                    </li>
                                @endif
                                
                                @if (auth()->user()->level !== 2)
                                <li class="nav-item">
                                        <a class="nav-link" href="/bibliografi/cd">
                                            {{ __('Daftar CD/DVD') }}
                                        </a>
                                    </li>
    
                                    <li class="nav-item">
                                        <a class="nav-link" href="/bibliografi/cd/songwriter">
                                            {{ __('Daftar Pencipta Lagu') }}
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/guestbook-all-data">
                            <i class="fas fa-address-book" style="color: #00f;"></i>
                            <span class="nav-link-text" style="color: #00f;">{{ __('Buku Tamu') }}</span>
                        </a>
                    </li>

                    <li class="nav-item">
                            <a class="nav-link" href="/carousel-event">
                                <i class="fas fa-images" style="color: #00f;"></i>
                                <span class="nav-link-text" style="color: #00f;">{{ __('Event') }}</span>
                            </a>
                        </li>
                @endif
            </ul>

            {{-- <!-- Divider -->
            <hr class="my-3">
            <!-- Heading -->
            <h6 class="navbar-heading text-muted">Documentation</h6>
            <!-- Navigation -->
            <ul class="navbar-nav mb-md-3">
                <li class="nav-item">
                    <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/getting-started/overview.html">
                        <i class="ni ni-spaceship"></i> Getting started
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/foundation/colors.html">
                        <i class="ni ni-palette"></i> Foundation
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/components/alerts.html">
                        <i class="ni ni-ui-04"></i> Components
                    </a>
                </li>
            </ul> --}}
        </div>
    </div>
</nav>