@extends('layouts.main')

@section('breadcrumb')
    {{-- {{ Breadcrumbs::render('cpl.show') }} --}}
@endsection

@section('main')
    <div class="row">
        {{-- Sidebar --}}
        <div class="col-3">
            <button type="button" class="btn btn-outline-primary w-100 mb-4">Ekspor</button>
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Sikap (S)
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="mb-3">
                                <a href="" class="btn btn-light w-100 active">S-1</a>
                            </div>

                            <div class="mb-3">
                                <a href="" class="btn btn-light w-100">S-2</a>
                            </div>

                            <div class="mb-3">
                                <a href="" class="btn btn-light w-100">S-3</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Pengetahuan (P)
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="mb-3">
                                <a href="" class="btn btn-light w-100">P-1</a>
                            </div>

                            <div class="mb-3">
                                <a href="" class="btn btn-light w-100">P-2</a>
                            </div>

                            <div class="mb-3">
                                <a href="" class="btn btn-light w-100">P-3</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            KU (Keterampilan Umum)
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="mb-3">
                                <a href="" class="btn btn-light w-100">KU-1</a>
                            </div>

                            <div class="mb-3">
                                <a href="" class="btn btn-light w-100">KU-2</a>
                            </div>

                            <div class="mb-3">
                                <a href="" class="btn btn-light w-100">KU-3</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            KK (Keterampilan Khusus)
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="mb-3">
                                <a href="" class="btn btn-light w-100">KK-1</a>
                            </div>

                            <div class="mb-3">
                                <a href="" class="btn btn-light w-100">KK-2</a>
                            </div>

                            <div class="mb-3">
                                <a href="" class="btn btn-light w-100">KK-3</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal --}}
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">Ubah Capaian Pembelajaran</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="">
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label fw-bold">Deskripsi</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero impedit est animi consectetur ipsum itaque? Culpa quibusdam harum amet aspernatur?</textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <div class="row w-100">
                            <div class="col">
                                <button type="button" class="btn btn-danger w-100"
                                    data-bs-dismiss="modal">Batal</button>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-success w-100">Ubah</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Detail --}}
        <div class="col-9">
            <div class="row mb-3">
                <div class="col d-flex">
                    <div class="me-4">
                        <div class="fw-bold">Diubah pada</div>
                        <div>01 Januari 2024 01:18</div>
                    </div>
                    <div class="me-4">
                        <div class="fw-bold">Diperbarui pada</div>
                        <div>01 Januari 2024 01:18</div>
                    </div>
                    <div>
                        <div class="fw-bold">Diubah oleh</div>
                        <div>Jhon Doe</div>
                    </div>
                </div>
                <div class="col-auto">
                    <a href="{{ route('cpl.edit', ['kurikulum' => 2022, 'cpl' => 'ss-1']) }}"
                        class="btn btn-outline-primary ">Ubah Pemetaannya pada MK</a>
                    {{-- Button trigger modal --}}
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">
                        Ubah
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="fw-bold">Deskripsi</div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad officiis praesentium hic nihil vel non
                        recusandae tempora id cum repellat!</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="fw-bold mb-3">Mata Kuliah yang dibebani</div>
                    <div class="accordion" id="accordionExample2">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne2" aria-expanded="true" aria-controls="collapseOne2">
                                    21IF001 - Dasar Dasar Pemrograman
                                </button>
                            </h2>
                            <div id="collapseOne2" class="accordion-collapse collapse show"
                                data-bs-parent="#accordionExample2">
                                <div class="accordion-body">
                                    <div class="mb-4">
                                        <div class="fw-bold">Tingkat Relevansi</div>
                                        <div>1</div>
                                    </div>

                                    <div class="mb-4">
                                        <div class="fw-bold">Bobot Relevansi</div>
                                        <div>11%</div>
                                    </div>

                                    <div>
                                        <div class="fw-bold">Tujuan Pembelajaran yang digunakan</div>
                                        <ul class="mb-0">
                                            <li>TP-1</li>
                                            <li>TP-2</li>
                                            <li>TP-3</li>
                                            <li>TP-4</li>
                                            <li>TP-5</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button fw-bold collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo2" aria-expanded="false"
                                    aria-controls="collapseTwo2">
                                    21IF002 - Pengantar Teknologi Informasi dan Komputer
                                </button>
                            </h2>
                            <div id="collapseTwo2" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample2">
                                <div class="accordion-body">
                                    <div class="mb-4">
                                        <div class="fw-bold">Tingkat Relevansi</div>
                                        <div>1</div>
                                    </div>

                                    <div class="mb-4">
                                        <div class="fw-bold">Bobot Relevansi</div>
                                        <div>11%</div>
                                    </div>

                                    <div>
                                        <div class="fw-bold">Tujuan Pembelajaran yang digunakan</div>
                                        <ul class="mb-0">
                                            <li>TP-1</li>
                                            <li>TP-2</li>
                                            <li>TP-3</li>
                                            <li>TP-4</li>
                                            <li>TP-5</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button fw-bold collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseThree2" aria-expanded="false"
                                    aria-controls="collapseThree2">
                                    21IF003 - Proyek 1 : Pemanfaatan Aplikasi Perkantoran
                                </button>
                            </h2>
                            <div id="collapseThree2" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample2">
                                <div class="accordion-body">
                                    <div class="mb-4">
                                        <div class="fw-bold">Tingkat Relevansi</div>
                                        <div>1</div>
                                    </div>

                                    <div class="mb-4">
                                        <div class="fw-bold">Bobot Relevansi</div>
                                        <div>11%</div>
                                    </div>

                                    <div>
                                        <div class="fw-bold">Tujuan Pembelajaran yang digunakan</div>
                                        <ul class="mb-0">
                                            <li>TP-1</li>
                                            <li>TP-2</li>
                                            <li>TP-3</li>
                                            <li>TP-4</li>
                                            <li>TP-5</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
