@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('kaprodi.cpl.index', $kurikulum->tahun) }}
    <h1 class="fw-bold mb-0">{{ $title }}</h1>
@endsection

@section('main')
    {{-- Filter buttons --}}

    <div class="row mb-5">
        <div class="col-auto">
            <input type="radio" class="btn-check" name="options" id="option1" autocomplete="off" checked>
            <label class="btn btn-outline-primary rounded-pill px-3" data-filter="Semua" for="option1">Semua</label>

            <input type="radio" class="btn-check" name="options" id="option2" autocomplete="off">
            <label class="btn btn-outline-primary rounded-pill px-3" data-filter="SP" for="option2">Sikap
                (SP)</label>

            <input type="radio" class="btn-check" name="options" id="option3" autocomplete="off">
            <label class="btn btn-outline-primary rounded-pill px-3" data-filter="PP" for="option3">Pengetahuan
                (PP)</label>

            <input type="radio" class="btn-check" name="options" id="option4" autocomplete="off">
            <label class="btn btn-outline-primary rounded-pill px-3" data-filter="KU" for="option4">Keterampilan Umum
                (KU)</label>

            <input type="radio" class="btn-check" name="options" id="option5" autocomplete="off">
            <label class="btn btn-outline-primary rounded-pill px-3" data-filter="KK" for="option5">Keterampilan Khusus
                (KK)</label>
        </div>
        <div class="col text-end">
            {{-- Button trigger modal --}}
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Tambah Capaian Pembelajaran
            </button>
        </div>
    </div>

    {{-- Modal --}}
    <form method="POST" action="{{ route('kaprodi.cpl.store', ['kurikulum' => $kurikulum->tahun]) }}">
        @csrf
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">Tambah Capaian Pembelajaran</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="">
                            <div class="mb-3">
                                <label for="domain" class="form-label fw-bold">Domain</label>
                                <select class="form-select" id="domain" name="domain">
                                    <option selected hidden>Pilih domain</option>
                                    <option value="Sikap">Sikap (S)</option>
                                    <option value="Pengetahuan">Pengetahuan (P)</option>
                                    <option value="Keterampilan Umum">Keterampilan Umum (KU)</option>
                                    <option value="Keterampilan Khusus">Keterampilan Khusus (KK)</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label fw-bold">Deskripsi</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="deskripsi" rows="3"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <div class="row w-100">
                            <div class="col">
                                <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal"
                                    aria-label="Close">Batal</button>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-success w-100">Tambah</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    {{-- Data CPL --}}
    <div class="row">
        <div class="col-12">
            <div class="accordion" id="accordionExample">
                @if ($data_cpl->isEmpty())
                    <div class="text-center">
                        <p class="fs-4">Belum Ada Data Capaian Pembelajaran</p>
                    </div>
                @else
                    @foreach ($data_cpl as $index => $cpl)
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button {{ $loop->index === 0 ? '' : 'collapsed' }}"
                                    type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{ $index }}"
                                    aria-expanded="{{ $loop->index === 0 ? 'true' : 'false' }}"
                                    aria-controls="collapse{{ $index }}">
                                    {{ $cpl['kode'] }} - {{ $cpl['deskripsi'] }}
                                </button>
                            </h2>
                            <div id="collapse{{ $index }}"
                                class="accordion-collapse collapse {{ $loop->index === 0 ? 'show' : '' }}"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p class="mb-0 fw-bold">Indikator Kinerja</p>
                                    @php
                                        $mataKuliahDitampilkan = false;
                                    @endphp
                                    @if ($cpl['indikatorKinerjaBelumDipetakan']->isEmpty())
                                        <p class="mb-0">Belum ada pemetaan Indikator Kinerja</p>
                                    @else
                                        @foreach ($cpl['mataKuliahRegister'] as $mkRegister)
                                            @if ($mataKuliahDitampilkan === false)
                                                Nama Mata Kuliah: {{ $mkRegister['mataKuliah']->nama }}<br>
                                                @php
                                                    $mataKuliahDitampilkan = true;
                                                @endphp
                                            @endif
                                            @foreach ($mkRegister['indikatorKinerja'] as $ik)
                                                <ul>
                                                    <li>
                                                        {{ $ik->kode }}
                                                    </li>
                                                </ul>
                                            @endforeach
                                            @php
                                                $mataKuliahDitampilkan = false;
                                            @endphp
                                        @endforeach
                                    @endif
                                    @if ($cpl['indikatorKinerjaBelumDipetakan']->isNotEmpty())
                                        <br>
                                        <p class="fw-bold">Indikator Kinerja yang belum dipetakan</p>
                                        @foreach ($cpl['indikatorKinerjaBelumDipetakan'] as $ik)
                                            <ul>
                                                <li>
                                                    {{ $ik->kode }}
                                                </li>
                                            </ul>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="accordion-footer bg-light mb-0 p-3 border-top ">
                                    <a href="{{ route('kaprodi.cpl.show', ['kurikulum' => $kurikulum->tahun, 'cpl' => $cpl['kode']]) }}"
                                        class="me-3">Lihat
                                        detail</a>
                                    {{-- <a href="">Ubah pembobotan</a> --}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('input[name="options"]').change(function() {
                let filterValue = $('label[for="' + $(this).attr('id') + '"]').data('filter');
                if (filterValue === 'Semua') {
                    $('.accordion-item').show();
                } else {
                    $('.accordion-item').hide();
                    $('.accordion-item').each(function() {
                        if ($(this).find('button').text().includes(filterValue)) {
                            $(this).show();
                        }
                    });
                }
            });
        });
    </script>
@endpush
