<style>
    @media screen and (min-width: 768px) {
        #navbar-main-user {
            background-color: white;
        }
    }
</style>


<!-- Top navbar -->
@if (auth()->user()->level == 4)
<nav class="navbar navbar-default navbar-top navbar-expand-md navbar-dark" id="navbar-main-user">
@else
<nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
@endif
    <div class="container-fluid">
        <!-- Brand -->
        @if (auth()->user()->level != 4)
            <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('home') }}">{{ __('Dashboard') }}</a>
        @endif
        <!-- Form -->
        <form class="form-inline mr-4 d-none d-md-flex ml-lg-auto">
           
        </form>
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
            <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                        </span>
                        <div class="media-body ml-2 d-none d-lg-block">
                            @if (auth()->user()->level == 4)
                            <span class="mb-0 text-sm  font-weight-bold" style="color:blue">{{ auth()->user()->name }}</span>
                            @else
                            <span class="mb-0 text-sm  font-weight-bold">{{ auth()->user()->name }}</span>    
                            @endif
                        </div>
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
    </div>
</nav>