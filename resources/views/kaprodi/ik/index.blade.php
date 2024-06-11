@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('kaprodi.ik.index', $kurikulum->tahun) }}
    <h1 class="fw-bold mb-0">
        {{ $title }}</h1>
@endsection

@section('main')
    {{-- Filter buttons --}}
    <div class="row mb-5">
        <div class="col-auto">
            <input type="radio" class="btn-check" name="options" id="option1" autocomplete="off" checked>
            <label class="btn btn-outline-primary rounded-pill px-3" data-filter="Semua" for="option1">Semua</label>

            <input type="radio" class="btn-check" name="options" id="option2" autocomplete="off">
            <label class="btn btn-outline-primary rounded-pill px-3" data-filter="SP" for="option2">Sikap (SS)</label>

            <input type="radio" class="btn-check" name="options" id="option3" autocomplete="off">
            <label class="btn btn-outline-primary rounded-pill px-3" data-filter="PP" for="option3">Pengetahuan (P)</label>

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
                Tambah Indikator Kinerja
            </button>
        </div>
    </div>

    {{-- Modal --}}
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form method="POST" action="{{ route('kaprodi.ik.store', ['kurikulum' => $kurikulum->tahun]) }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">Tambah Indikator Kinerja</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="domain" class="form-label fw-bold">Capaian Pembelajaran Induk</label>
                            <select class="form-select" id="domain" name="cpInduk">
                                <option selected hidden>Pilih CP Induk</option>
                                @foreach ($kurikulum->capaianPembelajaranLulusan as $cp)
                                    <option value="{{ $cp->kode }}">{{ $cp->kode }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label fw-bold">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>

                        <div class="fw-bold mb-3">Rubrik</div>

                        <?php $dataRubrik = rubrik(); ?>
                        @for ($i = 0; $i < 5; $i++)
                            <div class="mb-3">
                                <div class="row mb-4">
                                    <div class="col">
                                        <div class="fw-bold">Tingkat kemampuan</div>
                                        <div>{{ $i + 1 }}</div>
                                    </div>
                                    <div class="col">
                                        <div class="fw-bold">Makna kualitatif</div>
                                        <div>{{ $dataRubrik[$i] }}</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="fw-bold">Makna tingkat kemampuan</div>
                                        <div>Pernah mempalajari atau secara tidak langsung dikenalkan</div>
                                    </div>
                                </div>

                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlTextarea2" class="form-label fw-bold">Deskripsi</label>
                                <textarea name="rubrik-{{ $i }}" class="form-control" id="exampleFormControlTextarea2" rows="3"></textarea>
                            </div>
                        @endfor

                    </div>
                    <div class="modal-footer">
                        <div class="row w-100">
                            <div class="col">
                                <button type="button" class="btn btn-danger w-100"
                                    data-bs-dismiss="modal">Batal</button>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-success w-100">Tambah</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Data CPL --}}
    <div class="row">
        <div class="col-12">
            <div class="accordion accordion-flush" id="accordionExample">
                @if (empty($data_ik))
                    <div class="text-center">
                        <p class="fs-4">Belum Ada Indikator Kinerja</p>
                    </div>
                @else
                    @foreach ($data_ik as $index => $ik)
                        @if ($ik != null)
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed fw-bold" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}"
                                        aria-expanded="false" aria-controls="collapse{{ $index }}">
                                        {{ $ik->kode }}
                                    </button>
                                </h2>
                                <div id="collapse{{ $index }}" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p class="fw-bold mb-1">Deskripsi</p>
                                        <p class="mb-4">{{ $ik->deskripsi }}</p>

                                        <p class="fw-bold mb-1">Capaian Pembelajaran</p>
                                        <p>
                                            <li>
                                                {{ $ik->capaianPembelajaranLulusan->kode }}
                                            </li>
                                        </p>

                                        <p class="fw-bold mb-1">Mata Kuliah</p>
                                        <p class="mb-0">
                                            Belum ada Pemetaan
                                        </p>
                                    </div>
                                    <div class="accordion-footer bg-light mb-0 p-3 border-top ">
                                        <a href="{{ route('kaprodi.ik.show', ['kurikulum' => $kurikulum->tahun, 'ik' => $ik->kode]) }}"
                                            class="me-3">Lihat
                                            detail</a>
                                        <a href="">Pemetaan terhadap Capaian Pembelajaran</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
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
