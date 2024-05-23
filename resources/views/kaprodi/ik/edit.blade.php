@extends('layouts.main')

@section('breadcrumb')
    {{-- {{ Breadcrumbs::render('cpl.show') }} --}}
@endsection

@section('main')
    <div class="row">
        {{-- Sidebar --}}
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <a href="" class="btn btn-light w-100 active">IK-1</a>
                    </div>

                    <div class="mb-3">
                        <a href="" class="btn btn-light w-100">IK-2</a>
                    </div>

                    <div class="mb-3">
                        <a href="" class="btn btn-light w-100">IK-3</a>
                    </div>

                    <div class="mb-3">
                        <a href="" class="btn btn-light w-100">IK-4</a>
                    </div>

                    <div class="mb-3">
                        <a href="" class="btn btn-light w-100">IK-5</a>
                    </div>

                    <div class="mb-3">
                        <a href="" class="btn btn-light w-100">IK-6</a>
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
                                <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Batal</button>
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
            <div class="row">
                <div class="col">
                    <div class="fw-bold">Deskripsi</div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad officiis praesentium hic nihil vel non
                        recusandae tempora id cum repellat!</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="fw-bold mb-3">Centang butir CPL yang relevan dengan isi dari indikator kinerja</div>
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Sikap (S)
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckDefault">
                                            <label class="form-check-label fw-bold" for="flexCheckDefault">
                                                S-1
                                            </label>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui ipsum assumenda
                                            perferendis id! Quidem ipsa nulla esse, voluptates facilis ipsum.</p>
                                    </div>
                                    <div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckChecked" checked>
                                            <label class="form-check-label fw-bold" for="flexCheckChecked">
                                                S-2
                                            </label>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo harum id libero rem
                                            cumque incidunt dicta assumenda corporis praesentium quo?</p>
                                    </div>
                                    <div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckChecked" checked>
                                            <label class="form-check-label fw-bold" for="flexCheckChecked">
                                                S-3
                                            </label>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo harum id libero rem
                                            cumque incidunt dicta assumenda corporis praesentium quo?</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button fw-bold collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                    aria-controls="collapseTwo">
                                    Pengetahuan (P)
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckDefault">
                                            <label class="form-check-label fw-bold" for="flexCheckDefault">
                                                P-1
                                            </label>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui ipsum assumenda
                                            perferendis id! Quidem ipsa nulla esse, voluptates facilis ipsum.</p>
                                    </div>
                                    <div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckChecked" checked>
                                            <label class="form-check-label fw-bold" for="flexCheckChecked">
                                                P-2
                                            </label>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo harum id libero rem
                                            cumque incidunt dicta assumenda corporis praesentium quo?</p>
                                    </div>
                                    <div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckChecked" checked>
                                            <label class="form-check-label fw-bold" for="flexCheckChecked">
                                                P-3
                                            </label>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo harum id libero rem
                                            cumque incidunt dicta assumenda corporis praesentium quo?</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button fw-bold collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false"
                                    aria-controls="collapseThree">
                                    KU (Keterampilan Umum)
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckDefault">
                                            <label class="form-check-label fw-bold" for="flexCheckDefault">
                                                KU-1
                                            </label>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui ipsum assumenda
                                            perferendis id! Quidem ipsa nulla esse, voluptates facilis ipsum.</p>
                                    </div>
                                    <div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckChecked" checked>
                                            <label class="form-check-label fw-bold" for="flexCheckChecked">
                                                KU-2
                                            </label>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo harum id libero rem
                                            cumque incidunt dicta assumenda corporis praesentium quo?</p>
                                    </div>
                                    <div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckChecked" checked>
                                            <label class="form-check-label fw-bold" for="flexCheckChecked">
                                                KU-3
                                            </label>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo harum id libero rem
                                            cumque incidunt dicta assumenda corporis praesentium quo?</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button fw-bold collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false"
                                    aria-controls="collapseFour">
                                    KK (Keterampilan Khusus)
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckDefault">
                                            <label class="form-check-label fw-bold" for="flexCheckDefault">
                                                KK-1
                                            </label>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui ipsum assumenda
                                            perferendis id! Quidem ipsa nulla esse, voluptates facilis ipsum.</p>
                                    </div>
                                    <div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckChecked" checked>
                                            <label class="form-check-label fw-bold" for="flexCheckChecked">
                                                KK-2
                                            </label>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo harum id libero rem
                                            cumque incidunt dicta assumenda corporis praesentium quo?</p>
                                    </div>
                                    <div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckChecked" checked>
                                            <label class="form-check-label fw-bold" for="flexCheckChecked">
                                                KK-3
                                            </label>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo harum id libero rem
                                            cumque incidunt dicta assumenda corporis praesentium quo?</p>
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
