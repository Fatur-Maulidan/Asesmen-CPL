@extends('layouts.main')

@section('breadcrumb')
    <h1 class="fw-bold mb-4">{{ $title }}</h1>
    {{ Breadcrumbs::render('kaprodi.kurikulum.dashboard.cpl', $kurikulum->tahun) }}
@endsection

@section('main')
    <div class="row">
        <div class="col-8">
            <canvas id="barChartCp"></canvas>
        </div>

        <div class="col-4">
            @foreach($ketercapaian_cp as $cp)
                <div class="mb-3">
                    <div>{{ $cp->kode_cpl }}</div>
                    <div>{{ $cp->deskripsi }}</div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="row">
        <div class="col-8">
            <canvas id="barChartIk"></canvas>
        </div>

        <div class="col-4">
            @foreach($ketercapaian_ik as $ik)
                <div class="mb-3">
                    <div>{{ $ik->kode_ik }}</div>
                    <div>{{ $ik->deskripsi }}</div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="row">
        {{-- Side Option --}}
        {{--<div class="col-2">--}}
        {{--    <label for="" class="fw-bold mb-3">Pilihan dashboard</label>--}}
        {{--    <div class="form-check">--}}
        {{--        <input class="form-check-input" type="radio" name="dashboard_type" id="dashboard_cpl" checked>--}}
        {{--        <label class="form-check-label" for="dashboard_cpl">--}}
        {{--            <a href="{{ route('kaprodi.kurikulum.dashboard.cpl', ['kurikulum' => $kurikulum->tahun]) }}" class="text-decoration-none link-dark">Capaian Pembelajaran</a>--}}
        {{--        </label>--}}
        {{--    </div>--}}
        {{--    <div class="form-check">--}}
        {{--        <input class="form-check-input" type="radio" name="dashboard_type" id="dashboard_mk">--}}
        {{--        <label class="form-check-label" for="dashboard_mk">--}}
        {{--            <a href="{{ route('kaprodi.kurikulum.dashboard.mk', ['kurikulum' => $kurikulum->tahun]) }}" class="text-decoration-none link-dark">Mata Kuliah</a>--}}
        {{--        </label>--}}
        {{--    </div>--}}
        {{--</div>--}}

        {{-- Content --}}
        <div class="col-8">
            <canvas id="barChartTp"></canvas>
        </div>

        <div class="col-4">
            @foreach($ketercapaian_tp as $tp)
                <div class="mb-3">
                    <div>{{ $tp->kode_tp }}</div>
                    <div>{{ $tp->deskripsi }}</div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@push("scripts")
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('barChartTp').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($data_chart_tp['labels']),
                datasets: [{
                    label: 'Tujuan Pembelajaran',
                    data: @json($data_chart_tp['data']),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        suggestedMin: 0,
                        suggestedMax: 100,
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Ketercapaian TP Mahasiswa {{ $ketercapaian_tp[0]->nim }}  pada MK {{ $ketercapaian_tp[0]->nama_mata_kuliah }}'
                    },
                    legend: {
                        labels: {
                            // This more specific font property overrides the global property
                            font: {
                                size: 20
                            }
                        }
                    }
                }
            }
        });

        var ctx2 = document.getElementById('barChartIk').getContext('2d');
        var myChart2 = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: @json($data_chart_ik['labels']),
                datasets: [{
                    label: 'Indikator Kinerja',
                    data: @json($data_chart_ik['data']),
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        suggestedMin: 0,
                        suggestedMax: 100,
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Ketercapaian IK Mahasiswa {{ $ketercapaian_ik[0]->nim }}'
                    },
                    legend: {
                        labels: {
                            // This more specific font property overrides the global property
                            font: {
                                size: 20
                            }
                        }
                    }
                }
            }
        });

        var ctx3 = document.getElementById('barChartCp').getContext('2d');
        var myChart2 = new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: @json($data_chart_cp['labels']),
                datasets: [{
                    label: 'Capaian Pembelajaran',
                    data: @json($data_chart_cp['data']),
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        suggestedMin: 0,
                        suggestedMax: 100,
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Ketercapaian CP Mahasiswa {{ $ketercapaian_cp[0]->nim }}'
                    },
                    legend: {
                        labels: {
                            // This more specific font property overrides the global property
                            font: {
                                size: 20
                            }
                        }
                    }
                }
            }
        });
    </script>
@endpush
