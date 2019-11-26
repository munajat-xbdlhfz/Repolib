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
                                <h3 class="mb-0">Buku Tamu</h3>
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
                                                <form action="/guestbook-all-data/export/view" method="POST">
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

                                {{-- Export Per-Tahun --}}
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
                                                <form action="/guestbook-all-data/export/view" method="POST">
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
                                    <th scope="col">{{ __('Kode') }}</th>
                                    <th scope="col">{{ __('Status') }}</th>
                                    <th scope="col">{{ __('Nama') }}</th>
                                    <th scope="col">{{ __('Alamat') }}</th>
                                    <th scope="col">{{ __('Pekerjaan') }}</th>
                                    <th scope="col">{{ __('Pendidikan') }}</th>
                                    <th scope="col">{{ __('Jenis Kelamin') }}</th>
                                    <th scope="col">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            
                            <tbody id="myTable">
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($guest as $data)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $data->kode }}</td>
                                    <td>{{ ucfirst($data->status) }}</td>
                                    <td>{{ ucfirst($data->nama) }}</td>
                                    <td>{{ ucfirst($data->alamat) }}</td>
                                    <td>{{ ucfirst($data->pekerjaan ?? '-') }}</td>
                                    <td>{{ ucfirst($data->pendidikan ?? '-') }}</td>
                                    <td>{{ ucfirst($data->jenis_kelamin ?? '-') }}</td>
                                    <td>
                                        @if ($data->guest_id != null)
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-group-{{ $data->guest_id }}">Detail</button>
                                        @endif
                                    </td>
                                </tr>

                                {{-- Guestbook Group Detail --}}
                                <div class="modal fade" id="modal-group-{{ $data->guest_id }}" tabindex="-1" role="dialog" aria-labelledby="modal-group" aria-hidden="true">
                                    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                                        <div class="modal-content bg-gradient-danger">
                                            
                                            <div class="modal-header">
                                                <h6 class="modal-title" id="modal-title-group">Guestbook {{ $data->kode }} Detail</h6>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            
                                            <div class="modal-body">
                                                
                                                <div class="py-3 text-left">
                                                    <h3 class="heading mt-2">Informasi Ketua Kelompok</h3>
                                                    <p class="mt-3">Nama: {{ $data->nama }}</p>
                                                    <p class="mt--3">Pekerjaan: {{ $data->pekerjaan }}</p>
                                                    <p class="mt--3">Pendidikan Terakhir: {{ $data->pendidikan }}</p>
                                                    <p class="mt--3">Jenis Kelamin: {{ $data->jenis_kelamin }}</p>
                                                    <p class="mt--3">No. Hp: {{ $data->no_hp }}</p>

                                                    <h3 class="heading mt-5">Informasi Lembaga</h3>
                                                    <p class="mt-3">Nama Lembaga: {{ $data->nama_lembaga }}</p>
                                                    <p class="mt--3">Email Lembaga: {{ $data->email_lembaga }}</p>
                                                    <p class="mt--3">Alamat Lembaga: {{ $data->alamat_lembaga }}</p>
                                                    <p class="mt--3">No. Hp Lembaga: {{ $data->no_hp_lembaga }}</p>
                                                    <p class="mt--3">Jumlah Peserta: {{ $data->jumlah_peserta }}</p>
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
                            {{ $guest->links() }}
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