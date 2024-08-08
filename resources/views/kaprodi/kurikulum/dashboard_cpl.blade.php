@extends('layouts.main')

@section('breadcrumb')
    <h1 class="fw-bold mb-4">{{ $title }}</h1>
    {{ Breadcrumbs::render('kaprodi.kurikulum.dashboard.cpl', $kurikulum->tahun) }}
@endsection

@section('main')
    @if($kurikulum->status->is(\App\Enums\StatusKurikulum::Pengelolaan))
        <div class="row col-12">
            <div class="alert alert-secondary">
                Kurikulum belum dimulai.
            </div>
        </div>
    @else
        <div class="row mb-5">
            <div class="col-auto">
                <input type="radio" class="btn-check" name="options" id="option1" autocomplete="off" @if(request('domain') == 'sikap') checked @endif>
                <label class="btn btn-outline-primary rounded-pill px-3" data-filter="SP" for="option1" >Sikap
                    (SP)</label>

                <input type="radio" class="btn-check" name="options" id="option2" autocomplete="off" @if(request('domain') == 'pengetahuan') checked @endif>
                <label class="btn btn-outline-primary rounded-pill px-3" data-filter="PP" for="option2">Pengetahuan
                    (PP)</label>

                <input type="radio" class="btn-check" name="options" id="option3" autocomplete="off" @if(request('domain') == 'keterampilan-umum') checked @endif>
                <label class="btn btn-outline-primary rounded-pill px-3" data-filter="KU" for="option3">Keterampilan Umum
                    (KU)</label>

                <input type="radio" class="btn-check" name="options" id="option4" autocomplete="off" @if(request('domain') == 'keterampilan-khusus') checked @endif>
                <label class="btn btn-outline-primary rounded-pill px-3" data-filter="KK" for="option4">Keterampilan Khusus
                    (KK)</label>
            </div>
        </div>

        <div class="row">
            <div class="col-8">
                <canvas id="barChartCp"></canvas>
            </div>

            <div class="col-4 overflow-y-scroll" style="max-height: 400px;">
                @foreach($ketercapaian_cp as $cp)
                    <div class="mb-3">
                        <div class="fw-bold">{{ $cp->kode }}</div>
                        <div>{{ $cp->deskripsi }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endsection

@push("scripts")
    @if(!$kurikulum->status->is(\App\Enums\StatusKurikulum::Pengelolaan))
        <script>
            const url = "{{ url()->current() }}";

            $('input[type=radio][name=options]').on('click', function () {
                switch ($(this).attr('id')) {
                    case 'option1':
                        location.href = url + '?domain=sikap'
                        break;
                    case 'option2':
                        location.href = url + '?domain=pengetahuan'
                        break;
                    case 'option3':
                        location.href = url + '?domain=keterampilan-umum'
                        break;
                    case 'option4':
                        location.href = url + '?domain=keterampilan-khusus'
                        break;
                }
            });

            var cplContext = document.getElementById('barChartCp').getContext('2d');
            var cplChart = new Chart(cplContext, {
                type: 'bar',
                data: {
                    labels: @json($labels),
                    datasets: [{
                        label: 'Ketercapaian (dalam %)',
                        data: @json($data),
                        backgroundColor: 'rgba(54, 162, 235)',
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
                        legend: {
                            labels: {
                                font: {
                                    size: 16
                                }
                            },
                        },
                        title: {
                            display: true,
                            text: 'Ketercapaian CP Program Studi Domain KU',
                            font: {
                                size: 18
                            }
                        },
                        annotation: {
                            annotations: {
                                line1: {
                                    type: 'line',
                                    yMin: {{ $kurikulum->threshold }},
                                    yMax: {{ $kurikulum->threshold }},
                                    borderColor: 'rgb(0, 0, 0)',
                                    borderWidth: 3,
                                    label: {
                                        display: false,
                                        content: 'Batas Minimum Ketercapaian'
                                    }
                                }
                            }
                        }
                    }
                }
            });
        </script>
    @endif
@endpush
