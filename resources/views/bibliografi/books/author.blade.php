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
                                <h3 class="mb-0">Data Pengarang</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#add-author">{{ __('Add Pengarang') }}</a>
                            </div>
                        </div>
                    </div>

                    {{-- Tambah Pengarang --}}
                    <div class="modal fade" id="add-author" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Pengarang</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div>
                                    <form action="/bibliografi/book/author" method="POST">
                                        @csrf

                                        <div class="modal-body table-responsive">
                                            <div class="form-group{{ $errors->has('author') ? ' has-danger' : '' }}">
                                                <label class="form-control-label" for="input-author">{{ __('Nama Pengarang') }}</label>
                                                <input type="text" name="tambah-author" id="tambah-author" class="form-control form-control-alternative{{ $errors->has('author') ? ' is-invalid' : '' }}" placeholder="{{ __('Masukkan Nama Pengarang Baru') }}" value="" required>
                            
                                                @if ($errors->has('author'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('author') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label">{{ __('Status Pengarang') }}</label>
                                                <div class="d-flex pt-2">
                                                    <select class="form-control" name="author-status" id="author-status">
                                                        <option value="primary">Primary</option>
                                                        <option value="additional">Additional</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Tambah</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-header border-0">
                        <div class="row align-items-center">
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

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('No.') }}</th>
                                    <th scope="col">{{ __('Nama') }}</th>
                                    <th scope="col">{{ __('Status') }}</th>

                                    @if (auth()->user()->level != 3)
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
                            @foreach ($author as $data)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ ucfirst($data->name) }}</td>
                                    <td>{{ ucfirst($data->status) }}</td>
    
                                    <td class="text-right">
                                        <div class="row">
                                            <div class="">
                                                <div class="d-flex justify-content-between align-items-baseline">
                                                    @if (auth()->user()->level != 3)
    
                                                        <div class="dropdown">
                                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fas fa-ellipsis-v"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                                    <form action="/bibliografi/book/author/{{ $data->id }}" method="post">
                                                                        @csrf
                                                                        @method('delete')
                                                                        
                                                                        <a class="dropdown-item" href="" data-toggle="modal" data-target="#edit-author-{{ $data->id }}">{{ __('Edit') }}</a>
                                                                        
                                                                        @php
                                                                            $checkAuthorBook = App\AuthorBook::where('authors_id', $data->id)->value('id');
                                                                        @endphp
                                                                        @if ($checkAuthorBook == null)
                                                                            <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this author data?") }}') ? this.parentElement.submit() : '' ">
                                                                                {{ __('Delete') }}
                                                                            </button>
                                                                        @endif
                                                                    </form>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>      
                                            </div>
                                        </div>                                           
                                    </td>
                                </tr>

                                {{-- Edit Pengarang --}}
                                <div class="modal fade" id="edit-author-{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Pengarang</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div>
                                                    <form action="/bibliografi/book/author/{{ $data->id }}" method="POST">
                                                        @csrf
                                                        @method('put')

                                                        <div class="modal-body table-responsive">
                                                            <div class="form-group{{ $errors->has('author') ? ' has-danger' : '' }}">
                                                                <label class="form-control-label" for="input-author">{{ __('Nama Pengarang') }}</label>
                                                                <input type="text" name="author-name" id="author-name" class="form-control form-control-alternative{{ $errors->has('author') ? ' is-invalid' : '' }}" placeholder="{{ __('Masukkan Nama Pengarang Baru') }}" value="{{ $data->name }}" required>
                                            
                                                                @if ($errors->has('author'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('author') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-control-label">{{ __('Status Pengarang') }}</label>
                                                                <div class="d-flex pt-2">
                                                                    <select class="form-control" name="author-status" id="author-status">
                                                                        @if ($data->status == 'primary')
                                                                            <option value="primary" selected>Primary</option>
                                                                            <option value="additional">Additional</option>
                                                                        @else
                                                                            <option value="primary">Primary</option>
                                                                            <option value="additional" selected>Additional</option>
                                                                        @endif
                                                                        
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            @endforeach
                              
                            </tbody>
                        </table>                            
                    </div>

                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $author->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
            
        @include('layouts.footers.auth')
    </div>

    <script>
        
    </script>
@endsection