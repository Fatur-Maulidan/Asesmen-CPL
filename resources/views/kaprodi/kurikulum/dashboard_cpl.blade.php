@extends('layouts.main')

@section('breadcrumb')
    <h1 class="fw-bold mb-4">{{ $title }}</h1>
    {{ Breadcrumbs::render('kaprodi.kurikulum.dashboard.cpl', $kurikulum->tahun) }}
@endsection

@section('main')
    <div class="row mb-5">
        <div class="col-auto">
            <input type="radio" class="btn-check" name="options" id="option2" autocomplete="off">
            <label class="btn btn-outline-primary rounded-pill px-3" data-filter="SP" for="option2">Sikap
                (SP)</label>

            <input type="radio" class="btn-check" name="options" id="option3" autocomplete="off">
            <label class="btn btn-outline-primary rounded-pill px-3" data-filter="PP" for="option3">Pengetahuan
                (PP)</label>

            <input type="radio" class="btn-check" name="options" id="option4" autocomplete="off" checked>
            <label class="btn btn-outline-primary rounded-pill px-3" data-filter="KU" for="option4">Keterampilan Umum
                (KU)</label>

            <input type="radio" class="btn-check" name="options" id="option5" autocomplete="off">
            <label class="btn btn-outline-primary rounded-pill px-3" data-filter="KK" for="option5">Keterampilan Khusus
                (KK)</label>
        </div>
    </div>

    <div class="row">
        <div class="col-8">
            <canvas id="barChartCp"></canvas>
        </div>

        <div class="col-4 overflow-y-scroll" style="max-height: 400px;">
            <div class="mb-3">
                <div class="fw-bold">KU-1</div>
                <div>Mampu menyelesaikan pekerjaan berlingkup luas melalui pengembangan perangkat lunak aplikasi dengan menerapkan beragam metode yang sesuai, baik yang belum maupun yang sudah baku;</div>
            </div>

            <div class="mb-3">
                <div class="fw-bold">KU-2</div>
                <div>Mampu menunjukkan kinerja bermutu dan terukur;</div>
            </div>

            <div class="mb-3">
                <div class="fw-bold">KU-3</div>
                <div>Mampu melakukan transformasi model penyelesaian masalah menjadi algoritma didasarkan pada pemikiran logis, inovatif, dan bertanggung jawab atas hasilnya secara mandiri;</div>
            </div>

            <div class="mb-3">
                <div class="fw-bold">KU-4</div>
                <div>Mampu melakukan transformasi algoritma menjadi source program dengan bahasa pemrograman tertentu</div>
            </div>

            <div class="mb-3">
                <div class="fw-bold">KU-5</div>
                <div>Mampu mendokumentasikan perangkat lunak aplikasi secara akurat dan sahih serta mengomunikasikannya secara efektif kepada pihak lain yang membutuhkan;</div>
            </div>

            <div class="mb-3">
                <div class="fw-bold">KU-6</div>
                <div>Mampu bekerja sama, berkomunikasi, dan berinovatif dalam pekerjaannya;</div>
            </div>

            <div class="mb-3">
                <div class="fw-bold">KU-7</div>
                <div>Mampu bertanggungjawab atas pencapaian hasil kerja kelompok dan melakukan supervisi dan evaluasi terhadap penyelesaian pekerjaan yang ditugaskan kepada pekerja yang berada di bawah tanggungjawabnya;</div>
            </div>

            <div class="mb-3">
                <div class="fw-bold">KU-8</div>
                <div>Mampu melakukan proses evaluasi diri terhadap kelompok kerja yang berada dibawah tanggung jawabnya, dan mengelola pengembangan kompetensi kerja secara mandiri;</div>
            </div>

            <div class="mb-3">
                <div class="fw-bold">KU-9</div>
                <div>Mampu mendokumentasikan, menyimpan, mengamankan, dan menemukan kembali data untukmenjamin kesahihan dan mencegah plagiasi.</div>
            </div>

            <div class="mb-3">
                <div class="fw-bold">KU-10</div>
                <div>Mampu mengenali kebutuhan, melakukan adaptasi dan mendemonstrasikan kemampuan dalam melanjutkan pengembangan diri (belajar sepanjang hayat).</div>
            </div>

            <div class="mb-3">
                <div class="fw-bold">KU-11</div>
                <div>Mampu berkomunikasi dengan menggunakan bahasa internasional secara lisan dan tulisan untuk kebutuhan pengembangan perangkat lunak aplikasi.</div>
            </div>
        </div>
    </div>
@endsection

@push("scripts")
    <script>
        var ctx3 = document.getElementById('barChartCp').getContext('2d');
        var myChart3 = new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: ['KU-1', 'KU-2', 'KU-3', 'KU-4', 'KU-5', 'KU-6', 'KU-7', 'KU-8', 'KU-9', 'KU-10', 'KU-11'],
                datasets: [{
                    label: 'Ketercapaian (dalam %)',
                    data: [92, 76, 83, 88, 77, 90, 70, 89, 82, 69, 74],
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
                                yMin: 75,
                                yMax: 75,
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
@endpush
