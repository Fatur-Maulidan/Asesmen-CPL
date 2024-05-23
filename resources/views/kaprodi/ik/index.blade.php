@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('cpl.index') }}
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
                Tambah Indikator Kinerja
            </button>
        </div>
    </div>

    {{-- Modal --}}
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">Tambah Indikator Kinerja</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="mb-3">
                            <label for="domain" class="form-label fw-bold">Capaian Pembelajaran Induk</label>
                            <select class="form-select" id="domain">
                                <option selected>Pilih CP Induk</option>
                                <option value="1">S-1</option>
                                <option value="2">P-1</option>
                                <option value="3">KU-1</option>
                                <option value="4">KK-1</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label fw-bold">Deskripsi</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>

                        <div class="fw-bold mb-3">Rubrik</div>
                        <div class="mb-3">
                            <div class="row mb-2">
                                <div class="col">
                                    <div class="fw-bold">Tingkat kemampuan</div>
                                    <div>1</div>
                                </div>
                                <div class="col">
                                    <div class="fw-bold">Makna kualitatif</div>
                                    <div>Kurang sekali</div>
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
                            <textarea class="form-control" id="exampleFormControlTextarea2" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col">
                            <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Batal</button>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-success w-100">Tambah</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Data CPL --}}
    <div class="row">
        <div class="col-12">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            IK-1
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p class="fw-bold mb-1">Deskripsi</p>
                            <p class="mb-4">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi laboriosam
                                debitis tempore dicta, sint beatae maxime? Ut natus ullam consequuntur!</p>

                            <p class="fw-bold mb-1">Capaian Pembelajaran</p>
                            <p>Belum ada pemetaan</p>

                            <p class="fw-bold mb-1">Mata Kuliah</p>
                            <p class="mb-0">Belum ada pemetaan</p>
                        </div>
                        <div class="accordion-footer bg-light mb-0 p-3 border-top ">
                            <a href="{{ route('ik.show', ['kurikulum' => 2022, 'ik' => 'ik-1']) }}" class="me-3">Lihat
                                detail</a>
                            <a href="">Pemetaan terhadap Capaian Pembelajaran</a>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            IK-2
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p class="fw-bold mb-1">Deskripsi</p>
                            <p class="mb-4">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi laboriosam
                                debitis tempore dicta, sint beatae maxime? Ut natus ullam consequuntur!</p>

                            <p class="fw-bold mb-1">Capaian Pembelajaran</p>
                            <p>Belum ada pemetaan</p>

                            <p class="fw-bold mb-1">Mata Kuliah</p>
                            <p class="mb-0">Belum ada pemetaan</p>
                        </div>
                        <div class="accordion-footer bg-light mb-0 p-3 border-top ">
                            <a href="" class="me-3">Lihat detail</a>
                            <a href="">Pemetaan terhadap Capaian Pembelajaran</a>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            IK-3
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p class="fw-bold mb-1">Deskripsi</p>
                            <p class="mb-4">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi laboriosam
                                debitis tempore dicta, sint beatae maxime? Ut natus ullam consequuntur!</p>

                            <p class="fw-bold mb-1">Capaian Pembelajaran</p>
                            <p>Belum ada pemetaan</p>

                            <p class="fw-bold mb-1">Mata Kuliah</p>
                            <p class="mb-0">Belum ada pemetaan</p>
                        </div>
                        <div class="accordion-footer bg-light mb-0 p-3 border-top ">
                            <a href="" class="me-3">Lihat detail</a>
                            <a href="">Pemetaan terhadap Capaian Pembelajaran</a>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            IK-4
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p class="fw-bold mb-1">Deskripsi</p>
                            <p class="mb-4">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi laboriosam
                                debitis tempore dicta, sint beatae maxime? Ut natus ullam consequuntur!</p>

                            <p class="fw-bold mb-1">Capaian Pembelajaran</p>
                            <p>Belum ada pemetaan</p>

                            <p class="fw-bold mb-1">Mata Kuliah</p>
                            <p class="mb-0">Belum ada pemetaan</p>
                        </div>
                        <div class="accordion-footer bg-light mb-0 p-3 border-top ">
                            <a href="" class="me-3">Lihat detail</a>
                            <a href="">Pemetaan terhadap Capaian Pembelajaran</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
