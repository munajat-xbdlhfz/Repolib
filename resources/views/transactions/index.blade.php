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
                                <h3 class="mb-0">Peminjaman</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="/peminjaman/buku" class="btn btn-sm btn-primary">
                                    <span>{{ __('Pinjam Buku') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                            </div>
                            <input id="myInput" class="form-control form-control-alternative" placeholder="Search" type="text">
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
                                    <th scope="col">{{ __('Kode Peminjaman') }}</th>
                                    <th scope="col">{{ __('Judul Buku') }}</th>
                                    @if (auth()->user()->level != 4)
                                        <th scope="col">{{ __('Kode Anggota') }}</th>
                                    @endif
                                    <th scope="col">{{ __('Tanggal Pinjam') }}</th>
                                    <th scope="col">{{ __('Batas Peminjaman') }}</th>
                                    <th scope="col">{{ __('Tanggal Kembali') }}</th>
                                    <th scope="col">{{ __('Status Buku') }}</th>
                                    <th scope="col">{{ __('Total Denda') }}</th>
                                    <th scope="col">{{ __('Status Denda') }}</th>
                                    <th scope="col">{{ __('Action') }}</th>    
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                @php
                                    $i = 1;
                                @endphp
                               @foreach ($peminjaman as $data)
                               @if (auth()->user()->kode_anggota == $data->kode_anggota)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td class="kode">{{ $data->kode_peminjaman }}</td>
                                    <td>{{ $data->judul }} {{ $data->anak_judul }}</td>
                                    <td>{{ $data->tanggal_pinjam }}</td>
                                    <td>{{ $data->tanggal_batas_pinjam }}</td>
                                    <td>{{ $data->tanggal_kembali }}</td>
                                    <td>{{ $data->status }}</td>
                                    <td>{{ $data->denda }}</td>
                                    <td>{{ $data->status_denda }}</td>
                                    <td>
                                        @if ($data->status === 'Pending')
                                            <a href="/peminjaman/cancel/{{ $data->kode_peminjaman }}">
                                                <button  type="button" class="btn btn-sm btn-danger">Cancel</button>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                               @elseif (auth()->user()->level != 4)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $data->kode_peminjaman }}</td>
                                    <td>{{ $data->judul }} {{ $data->anak_judul }}</td>
                                    <td>{{ $data->kode_anggota }}</td>
                                    <td>{{ $data->tanggal_pinjam }}</td>
                                    <td>{{ $data->tanggal_batas_pinjam }}</td>
                                    <td>{{ $data->tanggal_kembali ?? '-'}}</td>
                                    <td>{{ $data->status }}</td>
                                    <td>
                                        @if ($data->denda != null)
                                            {{ $data->mata_uang_id }}  {{ number_format($data->denda,2) }}
                                        @else
                                            {{ '-' }}
                                        @endif
                                    </td>
                                    <td>{{ $data->status_denda ?? '-' }}</td>

                                    <td class="text-right">
                                        <div class="row">
                                            <div class="">
                                                <div class="d-flex justify-content-between align-items-baseline">
                                                    @if (auth()->user()->level != 3)
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="d-flex align-items-center">
                                                                    @if ($data->id == 1)
                                                                        <a href="/peminjaman/{{ $data->kode_peminjaman }}/pinjam" class="btn btn-sm btn-success mr-3">{{ __('Approve') }}</a>
                                                                        <a href="/peminjaman/{{ $data->kode_peminjaman }}/ditolak" class="btn btn-sm btn-danger mr-3">{{ __('Reject') }}</a>
                                                                    @elseif ($data->id == 2)
                                                                        <form action="/peminjaman/delete/{{ $data->kode_peminjaman }}" method="post">
                                                                            @csrf
                                                                            @method('delete')
                                                                            
                                                                            <button type="button" class="btn btn-sm btn-danger mr-3" onclick="confirm('{{ __("Are you sure you want to delete this transaction?") }}') ? this.parentElement.submit() : '' ">
                                                                                {{ __('Delete') }}
                                                                            </button>
                                                                        </form>
                                                                    @elseif ($data->id < 4)
                                                                        <a href="/peminjaman/{{ $data->kode_peminjaman }}/kembali" class="btn btn-sm btn-primary mr-3">{{ __('Buku Kembali') }}</a>
                                                                        <a href="/peminjaman/{{ $data->kode_peminjaman }}/hilang" class="btn btn-sm btn-primary">{{ __('Buku Hilang') }}</a>
                                                                    @elseif (($data->id > 4 && $data->status_denda != 'lunas') && $data->id != 7)
                                                                        <form action="/peminjaman/pembayaran/{{ $data->peminjaman_id }}" method="post">
                                                                            @csrf
                                                                            @method('put')
                                                                            
                                                                            <button class="btn btn-sm btn-primary mr-3" type="button" class="dropdown-item" onclick="confirm('Apakah Anda yakin peminjaman ini sudah lunas?') ? this.parentElement.submit() : '' ">
                                                                                {{ __('Pembayaran') }}
                                                                            </button>
                                                                        </form>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>      
                                            </div>
                                        </div>                                           
                                    </td>
                                </tr>
                               @endif
                           @endforeach
                              
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $peminjaman->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
            
        @include('layouts.footers.auth')
    </div>
@endsection