@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('kaprodi.cpl.show', $kurikulum->tahun, $cpl->kode) }}
    <h1 class="fw-bold mb-4">{{ $cpl->kode }}</h1>
@endsection

@section('main')
    {{-- Rubrik Modal --}}
    <div class="modal fade" id="rubrikModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="rubrikModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="rubrikModalLabel">Rubrik Indikator Kinerja</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-4">
                        <div class="fw-bold" id="kode_ik_rubrik"></div>
                        <div id="deskripsi_ik_rubrik"></div>
                    </div>
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th scope="col" style="width: 20%" class="text-center bg-body-tertiary">Sangat Kurang</th>
                            <th scope="col" style="width: 20%" class="text-center bg-body-tertiary">Kurang</th>
                            <th scope="col" style="width: 20%" class="text-center bg-body-tertiary">Cukup</th>
                            <th scope="col" style="width: 20%" class="text-center bg-body-tertiary">Baik</th>
                            <th scope="col" style="width: 20%" class="text-center bg-body-tertiary">Sangat Baik</th>
                        </tr>
                        <tr>
                            <td class="fw-bold text-center bg-body-tertiary">
                                {{ $kurikulum->nilai_rubrik['min'][0] }} &mdash; {{ $kurikulum->nilai_rubrik['max'][0] }}
                            </td>
                            <td class="fw-bold text-center bg-body-tertiary">
                                {{ $kurikulum->nilai_rubrik['min'][1] }} &mdash; {{ $kurikulum->nilai_rubrik['max'][1] }}
                            </td>
                            <td class="fw-bold text-center bg-body-tertiary">
                                {{ $kurikulum->nilai_rubrik['min'][2] }} &mdash; {{ $kurikulum->nilai_rubrik['max'][2] }}
                            </td>
                            <td class="fw-bold text-center bg-body-tertiary">
                                {{ $kurikulum->nilai_rubrik['min'][3] }} &mdash; {{ $kurikulum->nilai_rubrik['max'][3] }}
                            </td>
                            <td class="fw-bold text-center bg-body-tertiary">
                                {{ $kurikulum->nilai_rubrik['min'][4] }} &mdash; {{ $kurikulum->nilai_rubrik['max'][4] }}
                            </td>
                        </tr>
                        <tr>
                            <td id="td_rubrik1" class="align-text-top"></td>
                            <td id="td_rubrik2" class="align-text-top"></td>
                            <td id="td_rubrik3" class="align-text-top"></td>
                            <td id="td_rubrik4" class="align-text-top"></td>
                            <td id="td_rubrik5" class="align-text-top"></td>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Detail --}}
    <div class="row">
        <div class="col-12">
            <div class="row mb-4">
                <div class="col-12 d-flex align-items-center">
                    <div class="me-4">
                        <div class="fw-bold">Ditambahkan pada</div>
                        <div id="created_at">{{ $cpl->created_at->translatedFormat('d F Y H:i') }}</div>
                    </div>
                    <div class="me-4">
                        <div class="fw-bold">Diperbarui pada</div>
                        <div id="updated_at">{{ $cpl->updated_at->translatedFormat('d F Y H:i') }}</div>
                    </div>
                    <div class="ms-auto">
                        <a href="{{ route('kaprodi.cpl.index', ['kurikulum' => $kurikulum->tahun]) }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-1">
                    <div class="fw-bold">Kode CP</div>
                    <div id="kode">{{ $cpl->kode }}</div>
                </div>
                <div class="col-11">
                    <div class="fw-bold">Deskripsi CP</div>
                    <p id="deskripsi">{{ $cpl->deskripsi }}</p>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-12">
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="fw-bold mb-3 d-inline me-2">Indikator Kinerja</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            @if( $cpl->indikatorKinerja->isNotEmpty() )
                                <table class="table table-bordered table-hover">
                                    <tbody>
                                    @foreach($cpl->indikatorKinerja as $ik)
                                        <tr>
                                            <td class="fw-bold text-nowrap align-middle">{{ $ik->kode }}</td>
                                            <td class="align-middle">{{ $ik->deskripsi }}</td>
                                            <td scope="col" class="align-middle text-center" style="width: 10%">
                                                <div>
                                                    <button type="button"
                                                            class="btn btn-info btn-sm btn-show-rubrik"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#rubrikModal"
                                                            data-kode="{{ $ik->kode }}"
                                                            data-deskripsi="{{ $ik->deskripsi }}"
                                                            data-rubrik1="{{ $ik->rubrik->where('urutan', 1)->pluck('deskripsi')->first() }}"
                                                            data-rubrik2="{{ $ik->rubrik->where('urutan', 2)->pluck('deskripsi')->first() }}"
                                                            data-rubrik3="{{ $ik->rubrik->where('urutan', 3)->pluck('deskripsi')->first() }}"
                                                            data-rubrik4="{{ $ik->rubrik->where('urutan', 4)->pluck('deskripsi')->first() }}"
                                                            data-rubrik5="{{ $ik->rubrik->where('urutan', 5)->pluck('deskripsi')->first() }}">Lihat Rubrik</button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div>Belum ada indikator kinerja.</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-5">

            <div class="row mb-4">
                <div class="col-12">
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="fw-bold mb-3 d-inline me-2">Mata Kuliah yang dibebankan</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            @if( $pemetaan_mk->isNotEmpty() )
                                <table class="table table-bordered table-hover">
                                    <tbody>
                                    @foreach($pemetaan_mk as $kode_mk => $pmk)
                                        <tr>
                                            <td rowspan="3" class="fw-bold align-middle text-center" style="width: 10%">{{ $kode_mk }}</td>
                                            <td class="align-middle fw-bold">{{ $pmk['nama'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">
                                                <div class="m-2">
                                                    <div class="fw-bold mb-2">Indikator Kinerja</div>
                                                    <ul class="mb-0">
                                                        @foreach($pmk['indikator_kinerja'] as $kode_ik => $ik)
                                                            <li>{{ $kode_ik . ' - ' . $ik['deskripsi'] }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">
                                                <div class="m-2">
                                                    <div class="fw-bold mb-2">Tujuan Pembelajaran</div>
                                                    @if ($pmk['tujuan_pembelajaran']->isNotEmpty())
                                                        <ul class="mb-0">
                                                            @foreach($pmk['tujuan_pembelajaran'] as $kode_tp => $tp)
                                                                <li>{{ $kode_tp . ' - ' . $tp['deskripsi'] }}</li>
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        <div>Belum ada tujuan pembelajaran.</div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div>Belum ada pemetaan.</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('.btn-show-rubrik').on('click', function (e) {
                const kode = $(this).data('kode');
                const deskripsi = $(this).data('deskripsi');
                const rubrik1 = $(this).data('rubrik1');
                const rubrik2 = $(this).data('rubrik2');
                const rubrik3 = $(this).data('rubrik3');
                const rubrik4 = $(this).data('rubrik4');
                const rubrik5 = $(this).data('rubrik5');

                $('#kode_ik_rubrik').html(kode);
                $('#deskripsi_ik_rubrik').html(deskripsi);
                $('#td_rubrik1').html(rubrik1);
                $('#td_rubrik2').html(rubrik2);
                $('#td_rubrik3').html(rubrik3);
                $('#td_rubrik4').html(rubrik4);
                $('#td_rubrik5').html(rubrik5);
            });
        });
    </script>
@endpush
