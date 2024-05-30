@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('kaprodi.cpl.index', $kurikulum) }}
    <h1 class="fw-bold mb-0">{{ $title }}</h1>
@endsection

@section('main')
    {{-- Filter buttons --}}

    <div class="row mb-5">
        <div class="col-auto">
            <input type="radio" class="btn-check" name="options" id="option1" autocomplete="off" checked>
            <label class="btn btn-outline-primary rounded-pill px-3" for="option1">Semua</label>

            <input type="radio" class="btn-check" name="options" id="option2" autocomplete="off">
            <label class="btn btn-outline-primary rounded-pill px-3" for="option2">Sikap (SS)</label>

            <input type="radio" class="btn-check" name="options" id="option3" autocomplete="off">
            <label class="btn btn-outline-primary rounded-pill px-3" for="option3">Pengetahuan (P)</label>

            <input type="radio" class="btn-check" name="options" id="option4" autocomplete="off">
            <label class="btn btn-outline-primary rounded-pill px-3" for="option4">Keterampilan Umum (KU)</label>

            <input type="radio" class="btn-check" name="options" id="option5" autocomplete="off">
            <label class="btn btn-outline-primary rounded-pill px-3" for="option5">Keterampilan Khusus (KK)</label>
        </div>
        <div class="col text-end">
            {{-- Button trigger modal --}}
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Tambah Capaian Pembelajaran
            </button>
        </div>
    </div>

    {{-- Modal --}}
    <form method="POST" action="{{ route('kaprodi.cpl.store', ['kurikulum' => $kurikulum]) }}">
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
                                <button type="button" class="btn btn-danger w-100">Batal</button>
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
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            SS-1
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p class="fw-bold mb-1">Deskripsi</p>
                            <p class="mb-4">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi laboriosam
                                debitis tempore dicta, sint beatae maxime? Ut natus ullam consequuntur!</p>

                            <p class="fw-bold mb-1">Mata Kuliah</p>
                            <p class="mb-0">Belum ada pemetaan</p>
                        </div>
                        <div class="accordion-footer bg-light mb-0 p-3 border-top ">
                            <a href="{{ route('kaprodi.cpl.show', ['kurikulum' => 2022, 'cpl' => '1']) }}"
                                class="me-3">Lihat
                                detail</a>
                            <a href="">Ubah pembobotan</a>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            SS-2
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p class="fw-bold mb-1">Deskripsi</p>
                            <p class="mb-4">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi laboriosam
                                debitis tempore dicta, sint beatae maxime? Ut natus ullam consequuntur!</p>

                            <p class="fw-bold mb-1">Mata Kuliah</p>
                            <p>Belum ada pemetaan</p>
                        </div>
                        <div class="accordion-footer bg-light mb-0 p-3 border-top ">
                            <a href="" class="me-3">Lihat detail</a>
                            <a href="">Ubah pembobotan</a>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            SS-3
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p class="fw-bold mb-1">Deskripsi</p>
                            <p class="mb-4">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi laboriosam
                                debitis tempore dicta, sint beatae maxime? Ut natus ullam consequuntur!</p>

                            <p class="fw-bold mb-1">Mata Kuliah</p>
                            <p>Belum ada pemetaan</p>
                        </div>
                        <div class="accordion-footer bg-light mb-0 p-3 border-top ">
                            <a href="" class="me-3">Lihat detail</a>
                            <a href="">Ubah pembobotan</a>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            SS-4
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p class="fw-bold mb-1">Deskripsi</p>
                            <p class="mb-4">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi laboriosam
                                debitis tempore dicta, sint beatae maxime? Ut natus ullam consequuntur!</p>

                            <p class="fw-bold mb-1">Mata Kuliah</p>
                            <p>Belum ada pemetaan</p>
                        </div>
                        <div class="accordion-footer bg-light mb-0 p-3 border-top ">
                            <a href="" class="me-3">Lihat detail</a>
                            <a href="">Ubah pembobotan</a>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            SS-5
                        </button>
                    </h2>
                    <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p class="fw-bold mb-1">Deskripsi</p>
                            <p class="mb-4">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi laboriosam
                                debitis tempore dicta, sint beatae maxime? Ut natus ullam consequuntur!</p>

                            <p class="fw-bold mb-1">Mata Kuliah</p>
                            <p>Belum ada pemetaan</p>
                        </div>
                        <div class="accordion-footer bg-light mb-0 p-3 border-top ">
                            <a href="" class="me-3">Lihat detail</a>
                            <a href="">Ubah pembobotan</a>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                            SS-6
                        </button>
                    </h2>
                    <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p class="fw-bold mb-1">Deskripsi</p>
                            <p class="mb-4">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi laboriosam
                                debitis tempore dicta, sint beatae maxime? Ut natus ullam consequuntur!</p>

                            <p class="fw-bold mb-1">Mata Kuliah</p>
                            <p>Belum ada pemetaan</p>
                        </div>
                        <div class="accordion-footer bg-light mb-0 p-3 border-top ">
                            <a href="" class="me-3">Lihat detail</a>
                            <a href="">Ubah pembobotan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
