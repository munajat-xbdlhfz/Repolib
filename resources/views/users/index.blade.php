@extends('layouts.app', ['title' => __('User Management')])

@section('content')
    @include('layouts.headers.cards')
    <script src="{{ asset('jquery') }}/dist/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                @if ($id === 'admin')
                                    <h3 class="mb-0">Data Admin</h3>
                                @else
                                    <h3 class="mb-0">Data User</h3>
                                @endif
                            </div>
                            <div class="col-4 text-right">
                                @if ($id === 'admin')
                                <a href="/data/{{ $id }}/create" class="btn btn-sm btn-primary">{{ __('Add Admin') }}</a>
                                @else
                                <a href="/data/{{ $id }}/create" class="btn btn-sm btn-primary">{{ __('Add User') }}</a>
                                @endif
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

                    <div class="col-lg-12">
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                            </div>
                            <input id="myInput" class="form-control form-control-alternative" placeholder="Search" type="text">
                            </div>
                            
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('No.') }}</th>
                                    <th scope="col">{{ __('No. Anggota') }}</th>
                                    <th scope="col">{{ __('Nama') }}</th>
                                    <th scope="col">{{ __('Email') }}</th>
                                    <th scope="col">{{ __('No. KTP/Pelajar/Passport') }}</th>
                                    <th scope="col">{{ __('Status') }}</th>
                                    @if (auth()->user()->level == 1)
                                        <th scope="col">{{ __('Action') }}</th>    
                                    @else
                                        <th scope="col"></th> 
                                    @endif
                                </tr>
                            </thead>
                            
                            <tbody id="myTable">
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $user->kode_anggota }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->kode }}</td>
                                        <td>{{ strtoupper($user->status) }}</td>
                                        <td class="text-right">
                                            <div class="row">
                                                <div class="">
                                                    <div class="d-flex justify-content-between align-items-baseline">
                                                        @if (auth()->user()->level == 1)
                                                            <!-- Button Deactivate User -->    
                                                            @if ($user->status == 'active')
                                                                <form action="/data/{{ $id }}/deactive/{{ $user->id }}" method="post">
                                                                    @csrf
                                                                    @method('delete')

                                                                    <button type="button" class="btn btn-sm btn-danger" onclick="confirm(`{{ __('Are you sure you want to deactivate ') .$user->name. ' account ?' }}`) ? this.parentElement.submit() : ''">
                                                                        {{ __('Deactivate User') }}
                                                                    </button>
                                                                </form>
                                                            @else
                                                                <form action="/data/{{ $id }}/active/{{ $user->id }}" method="post">
                                                                    @csrf
                                                                    @method('delete')

                                                                    <button type="button" class="btn btn-sm btn-success" onclick="confirm(`{{ __('Are you sure you want to activate ') .$user->name. ' account ?' }}`) ? this.parentElement.submit() : ''">
                                                                        {{ __('Activate User') }}
                                                                    </button>
                                                                </form>
                                                            @endif

                                                            <div class="dropdown pl-3">
                                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="fas fa-ellipsis-v"></i>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                                    @if ($user->id != auth()->id())
                                                                        <form action="/data/{{ $id }}/{{ $user->id }}" method="post">
                                                                            @csrf
                                                                            @method('delete')
                                                                            
                                                                            <a class="dropdown-item" href="{{ route('user.edit', $user) }}">{{ __('Edit') }}</a>
                                                                            <a class="dropdown-item" href="/data/user/print-id-card/{{ $user->id }}">{{ __('Print') }}</a>
                                                                            <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this user?") }}') ? this.parentElement.submit() : ''">
                                                                                {{ __('Delete') }}
                                                                            </button>
                                                                        </form>    
                                                                    @else
                                                                        <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Edit') }}</a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>      
                                                </div>
                                            </div>                                           
                                        </td>
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
            
        @include('layouts.footers.auth')
    </div>
@endsection