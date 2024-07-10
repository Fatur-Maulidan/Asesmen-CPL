@extends('layouts.main')

@section('breadcrumb')
    <h1 class="fw-bold mb-4">{{ $title }}</h1>
    {{ Breadcrumbs::render('kaprodi.kurikulum.dashboard.cpl', $kurikulum->tahun) }}
@endsection

@section('main')
    @if( $kurikulum->capaianPembelajaranLulusan->isEmpty() )
        <div class="row">
            <div class="col-12">
                <div class="alert alert-secondary" role="alert">
                    Belum ada data.
                </div>
            </div>
        </div>
    @else
        <div class="row">
            @if($ketercapaian_cp->isEmpty())
                <div class="col-12">
                    <div class="alert alert-secondary" role="alert">
                        Belum ada data.
                    </div>
                </div>
            @else
                <div class="col-8">
                    <canvas id="barChartCp"></canvas>
                </div>

                <div class="col-4">
                    @forelse($ketercapaian_cp as $cp)
                        <div class="mb-3">
                            <div>{{ $cp->kode_cpl }}</div>
                            <div>{{ $cp->deskripsi }}</div>
                        </div>
                    @empty
                        <div class="alert alert-secondary" role="alert">
                            Belum ada data.
                        </div>
                    @endforelse
                </div>
            @endif
        </div>
    @endif
@endsection

@push("scripts")
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @if( ! $kurikulum->capaianPembelajaranLulusan->isEmpty() )
        <script>
            @if ( isset($data_chart_tp) && !$ketercapaian_tp->isEmpty() )
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
            @endif

            @if( isset($data_chart_ik) && !$ketercapaian_ik->isEmpty() )
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
            @endif

            @if ( isset($data_chart_cp) && !$ketercapaian_cp->isEmpty() )
                var ctx3 = document.getElementById('barChartCp').getContext('2d');
                var myChart3 = new Chart(ctx3, {
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
            @endif
        </script>
    @endif
@endpush
