@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-8 mb-5 mb-xl-0">
                <div class="card bg-gradient-default shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-light ls-1 mb-1">Overview</h6>
                                <h2 class="text-white mb-0">Penginputan Monograf Tahun {{ $year }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Chart -->
                        <div class="container">
                            <canvas id="chart-bibliografi" class="chart-canvas" style="position: relative; height:43%; width:43%;"></canvas>
                        </div>
                    </div>
                    {{-- <div class="card-body">
                        <!-- Chart -->
                        <div class="chart">
                            <!-- Chart wrapper -->
                            <canvas id="chart-bibliografi" class="chart-canvas" style="position: relative; height:50%; max-height:100%; max-width:100%"></canvas>
                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-muted ls-1 mb-1">User Aktif</h6>
                                <h2 class="mb-0">Total Pengunjung Tahun {{ $year }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="padding-bottom:80px;">
                        <!-- Chart -->
                        <div class="container">
                            <canvas id="chart-pengunjung" class="chart-canvas" style="position: relative; height:100px; width:100px; max-height:100%; max-width:100%"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-xl-8 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Monograf Buku</h3>
                            </div>
                            <div class="col text-right">
                                <a href="/bibliografi/book" class="btn btn-sm btn-primary">See all</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Judul</th>
                                    <th scope="col">ISBN</th>
                                    <th scope="col">Pengarang</th>
                                    <th scope="col">Penerbit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($bibli as $data)
                                    @if ($double !== $data->buku_id)
                                        <tr>
                                            <td>{{ $data->judul }} {{ $data->anak_judul }}</td>
                                            <td>{{ $data->isbn }}</td>
                                            <td>
                                                @foreach ($authorBook as $ab)
                                                    @if ($data->buku_id == $ab->buku_id)
                                                        @foreach ($authors as $ath)
                                                            @if ($ab->authors_id == $ath->id)
                                                                {{ $ath->name }}<br> 
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>{{ $data->penerbit }}</td>
                                        </tr>
                                        @php
                                            $double = $data->buku_id
                                        @endphp
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Monograf CD</h3>
                            </div>
                            <div class="col text-right">
                                <a href="/bibliografi/cd" class="btn btn-sm btn-primary">See all</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Judul</th>
                                    <th scope="col">ISBN</th>
                                    <th scope="col">Penerbit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($cd as $data)
                                <tr>
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#modal-notification-{{ $data->cd_id }}">
                                            {{ $data->judul }} {{ $data->anak_judul }}
                                        </a>
                                    </td>
                                    <td>{{ $data->isbn }}</td>
                                    <td>{{ $data->penerbit }}</td>
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
                                                    <img style="width:300px; height:300px;" src="{{ asset('storage') }}/covers/{{ $data->cover }}" alt="">
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
                                                    <p class="mt--3">Price: {{ number_format($data->harga ?? '-') }} {{ $data->mata_uang_id ?? '' }}</p>
                                                    
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
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>

    <script>
        var urlVisitor = "{{ url('/json/chart/visitor') }}";
        var urlInput = "{{ url('/json/chart/input') }}";
        var month = @json($month);
        
        // Chart JS for Visitors
        var chtbl = document.getElementById("chart-bibliografi");
        var chtp = document.getElementById("chart-pengunjung");

        var chartPengunjung = new Chart(chtp, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    label: 'Total Pengunjung',
                    data: [],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });

        var chartBibliografi = new Chart(chtbl, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'Total Penginputan',
                    data: [],
                    backgroundColor: [
                        'rgba(0, 0, 0, 0)',
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });

        

        $(document).ready(function(){
            // Chart.js Visitor
            $.get(urlVisitor, function(response){
                var visitor = new Array();

                $.each(response, function (i, data) {
                    visitor.push(data);
                });
                
                for (var i = 0; i < 6; i++) {
                    chartPengunjung.data.labels.push(month[0][i]);
                }
                
                chartPengunjung.data.datasets.forEach((dataset) => {
                    for (var i = 0; i < visitor.length; i++) {
                        dataset.data.push(visitor[i]);
                    }
                });
                chartPengunjung.update();
            });     

            // Chart.js Monograf Input
            $.get(urlInput, function(response){
                var input = new Array();

                $.each(response, function (i, data) {
                    input.push(data);
                });
                
                for (var i = 0; i < 6; i++) {
                    chartBibliografi.data.labels.push(month[0][i]);
                }
                chartBibliografi.data.datasets.forEach((dataset) => {
                    for (var i = 0; i < input.length; i++) {
                        dataset.data.push(input[i]);
                    }
                });
                chartBibliografi.update();
            }); 
        });
    </script>
@endpush