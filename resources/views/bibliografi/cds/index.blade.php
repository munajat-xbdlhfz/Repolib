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
                                <h3 class="mb-0">Monograf CD/DVD</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="/bibliografi/cd/create" class="btn btn-sm btn-primary">{{ __('Koleksi CD/DVD') }}</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-lg-12 mb-4">
                                {{--  Button Export Excel  --}}
                                <li class="nav-item dropdown py-1 px-2" style="list-style-position:inside; border: 1px solid #5e72e4; border-radius: 5px; font-size:13px;">
                                    <a href="#insurance-head-section" class="nav-link dropdown-toggle" data-toggle="dropdown" style="color:#5e72e4"><i class="fas fa-file-export pr-2"></i>EXPORT</a>
                                    <div class="dropdown-menu">
                                        <a href="" class="dropdown-item" data-toggle="modal" data-target="#export-bulan">Export Per-Bulan</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="" class="dropdown-item" data-toggle="modal" data-target="#export-tahun">Export Per-Tahun</a>
                                    </div>
                                    </li>
                                </ul>
                                        
                                        
                                {{-- Export Per-Bulan --}}
                                <div class="modal fade" id="export-bulan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Export Excel Per-Bulan</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div>
                                                <form action="/bibliografi/cd/export/view" method="POST">
                                                    @csrf

                                                    <div class="modal-body">
                                                        {{-- BULAN --}}
                                                        @php
                                                            $i = 1;
                                                        @endphp
                                                        <div class="pb-4">
                                                            <label class="form-control-label" for="input-harga">{{ __('Bulan') }}</label>
                                                            <select class="form-control" name="bulan" id="bulan">
                                                                @foreach ($month as $mnth)
                                                                    <option value="{{ $i++ }}">{{ $mnth }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        {{-- TAHUN --}}
                                                        <div>
                                                            <label class="form-control-label" for="input-harga">{{ __('Tahun') }}</label>
                                                            <select class="form-control" name="tahun" id="tahun">
                                                                @for ($year = 1900; $year <= 2019; $year++)
                                                                    @if ($year === 2019)
                                                                        <option value="{{ $year }}" selected>{{ $year }}</option>  
                                                                    @else
                                                                        <option value="{{ $year }}">{{ $year }}</option>  
                                                                    @endif
                                                                @endfor
                                                            </select>
                                                        </div>

                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">View Export</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                {{-- Export Per-Bulan --}}
                                <div class="modal fade" id="export-tahun" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Export Excel Per-Tahun</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div>
                                                <form action="/bibliografi/cd/export/view" method="POST">
                                                    @csrf

                                                    <div class="modal-body">
                                                        {{-- TAHUN --}}
                                                        <div>
                                                            <label class="form-control-label" for="input-harga">{{ __('Tahun') }}</label>
                                                            <select class="form-control" name="tahun" id="tahun">
                                                                @for ($year = 1900; $year <= 2019; $year++)
                                                                    @if ($year === 2019)
                                                                        <option value="{{ $year }}" selected>{{ $year }}</option>  
                                                                    @else
                                                                        <option value="{{ $year }}">{{ $year }}</option>  
                                                                    @endif
                                                                @endfor
                                                            </select>
                                                        </div>

                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">View Export</button>
                                                    </div>
                                                </form>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                {{--  Button Import Excel  --}}
                                <button class="btn btn-sm btn-outline-primary py-2 px-3 ml-3" type="button" data-toggle="modal" data-target="#importExcel"><i class="fas fa-file-import pr-2"></i>IMPORT</button>
                                
                                
                                

                                {{--  Popup Import Excel  --}}
                                <div class="modal fade importExcel" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="importExcel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <form method="post" action="/bibliografi/cd/import/excel" enctype="multipart/form-data">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                                                </div>
                                                <div class="modal-body">
                                                    @csrf
                        
                                                    <label>Pilih file excel</label>
                                                    <div class="form-group">
                                                        <input type="file" name="file" required="required">
                                                    </div>

                                                    <label class="mr-3 pt-3">atau download contoh file import</label>
                                                    <a href="/bibliografi/cd/download/example-excel">
                                                        <i class="fas fa-download mr-1"></i>
                                                        Download
                                                    </a>
                        
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Import</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
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
                                    <th scope="col">{{ __('Judul') }}</th>
                                    <th scope="col">{{ __('ISBN') }}</th>
                                    <th scope="col">{{ __('Pencipta') }}</th>
                                    <th scope="col">{{ __('Penerbit') }}</th>
                                    <th scope="col">{{ __('Tahun Terbit') }}</th>
                                    <th scope="col">{{ __('Jumlah Keping') }}</th>
                                    <th scope="col">{{ __('Lokasi') }}</th>
                                    <th scope="col">{{ __('Data File') }}</th>
                                    <th scope="col">{{ __('Publisher') }}</th>

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
                                @foreach ($bibli as $data)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#modal-notification-{{ $data->cd_id }}">
                                            {{ $data->judul }} {{ $data->anak_judul }}
                                        </a>
                                    </td>
                                    <td>{{ $data->isbn }}</td>
                                    <td>{{ $data->pencipta }}</td>
                                    <td>{{ $data->penerbit }}</td>
                                    <td>{{ $data->tahun_terbit }}</td>
                                    <td>{{ $data->jumlah_keping }}</td>
                                    <td>{{ $data->lokasi }}</td>
                                    @if ($data->file == null)
                                        <td>{{ 0 }}</td>
                                    @else
                                        <td>
                                            <a href="/bibliografi/cd/{{ $data->cd_id }}/download">
                                                <i class="fas fa-download mr-1"></i>
                                                Download
                                            </a>
                                        </td>
                                    @endif
                                    <td>{{ $data->publisher }}</td>

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
                                                                <form action="/bibliografi/cd/{{ $data->bibliografi_id }}" method="post">
                                                                    @csrf
                                                                    @method('delete')
                                                                    
                                                                    <a class="dropdown-item" href="/bibliografi/cd/edit/{{ $data->bibliografi_id }}">{{ __('Edit') }}</a>
                                                                    <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this cd data?") }}') ? this.parentElement.submit() : '' ">
                                                                        {{ __('Delete') }}
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>      
                                            </div>
                                        </div>                                           
                                    </td>
                                </tr>

                                {{-- CD Information --}}
                                <div class="modal fade" id="modal-notification-{{ $data->cd_id }}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
                                    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                                        <div class="modal-content bg-gradient-danger">
                                            
                                            <div class="modal-header">
                                                <h6 class="modal-title" id="modal-title-notification">CD Information</h6>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            
                                            <div class="modal-body">
                                                
                                                <div class="py-3 text-center">
                                                    @if ($data->cover ==  null)
                                                        <img style="width:300px; height:300px;" src="{{ asset('argon') }}/img/no_album.jpg">
                                                    @else
                                                        <img style="width:300px; height:300px;" src="{{ asset('storage') }}/covers/{{ $data->cover }}" alt="">
                                                    @endif

                                                    <h3 class="heading mt-4">{{ $data->judul }} {{ $data->anak_judul }}</h3>
                                                    <p class="mt--2">{{ $data->edisi ?? '-' }}</p>
                                                    <p class="mt--3">by {{ $data->penerbit ?? '-' }}</p>

                                                    <h3 class="heading mt-4">About CD Album</h3>
                                                    @foreach ($pencipta as $item)
                                                        @if ($item->id == $data->pencipta_id)
                                                            <p>Album Artist Name: {{ $item->name ?? '-' }}</p>
                                                        @endif
                                                    @endforeach
                                                    @foreach ($genre as $item)
                                                        @if ($item->id == $data->genre_id)
                                                            <p class="mt--3">Genre: {{ ucfirst($item->genre) }}</p>
                                                        @endif
                                                    @endforeach
                                                    <p class="mt--3">Place of Publication: {{ ucfirst($data->tempat_terbit) ?? '-' }}</p>
                                                    <p class="mt--3">Publication Year: {{ $data->tahun_terbit ?? '-' }}</p>
                                                    <p class="mt--3">Price: {{ number_format($data->harga, 2, '.', ',' ?? '-') }} {{ $data->mata_uang_id ?? '' }}</p>
                                                    
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Close</button> 
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
                            {{ $bibli->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
            
        @include('layouts.footers.auth')
    </div>
@endsection