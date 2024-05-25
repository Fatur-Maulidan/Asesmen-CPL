@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('ik.show', $kurikulum, $ik['kode']) }}
    <h1 class="fw-bold mb-0">{{ $ik['kode'] }}</h1>
@endsection

@section('main')
    <div class="row">
        {{-- Sidebar --}}
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <a href="" class="btn btn-light w-100 text-start active">IK-1</a>
                    </div>

                    <div class="mb-3">
                        <a href="" class="btn btn-light w-100 text-start">IK-2</a>
                    </div>

                    <div class="mb-3">
                        <a href="" class="btn btn-light w-100 text-start">IK-3</a>
                    </div>

                    <div class="mb-3">
                        <a href="" class="btn btn-light w-100 text-start">IK-4</a>
                    </div>

                    <div class="mb-3">
                        <a href="" class="btn btn-light w-100 text-start">IK-5</a>
                    </div>

                    <div class="mb-3">
                        <a href="" class="btn btn-light w-100 text-start">IK-6</a>
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
                    <a href="{{ route('ik.detail', ['kurikulum' => $kurikulum, 'ik' => 'ss-1.1']) }}"
                        class="btn btn-outline-primary ">Pemetaannya pada CPL</a>
                    <button class="btn btn-danger">Hapus</button>
                    {{-- Button trigger modal --}}
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
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
                    <div class="fw-bold mb-3">Rubrik</div>
                    <div class="accordion" id="accordionExample2">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button bg-light" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne2" aria-expanded="true" aria-controls="collapseOne2">Rubrik
                                    1 ( < 50 )</button>
                            </h2>
                            <div id="collapseOne2" class="accordion-collapse collapse show"
                                data-bs-parent="#accordionExample2">
                                <div class="accordion-body">
                                    <div>
                                        <div class="fw-bold">Deskripsi</div>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Non, quam est. Corrupti
                                            cupiditate, deserunt tempora suscipit illum ut mollitia perspiciatis.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button bg-light collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo2" aria-expanded="false"
                                    aria-controls="collapseTwo2">Rubrik
                                    2 ( 50 - 60 )</button>
                            </h2>
                            <div id="collapseTwo2" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample2">
                                <div class="accordion-body">
                                    <div>
                                        <div class="fw-bold">Deskripsi</div>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Non, quam est. Corrupti
                                            cupiditate, deserunt tempora suscipit illum ut mollitia perspiciatis.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button bg-light collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseThree2" aria-expanded="false"
                                    aria-controls="collapseThree2">Rubrik 3 ( 61 - 71 )</button>
                            </h2>
                            <div id="collapseThree2" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample2">
                                <div class="accordion-body">
                                    <div>
                                        <div class="fw-bold">Deskripsi</div>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Non, quam est. Corrupti
                                            cupiditate, deserunt tempora suscipit illum ut mollitia perspiciatis.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button bg-light collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseFour2" aria-expanded="false"
                                    aria-controls="collapseFour2">Rubrik 4 ( 72 - 80 )</button>
                            </h2>
                            <div id="collapseFour2" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample2">
                                <div class="accordion-body">
                                    <div>
                                        <div class="fw-bold">Deskripsi</div>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Non, quam est. Corrupti
                                            cupiditate, deserunt tempora suscipit illum ut mollitia perspiciatis.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button bg-light collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseFive2" aria-expanded="false"
                                    aria-controls="collapseFive2">Rubrik 5 ( > 80 )</button>
                            </h2>
                            <div id="collapseFive2" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample2">
                                <div class="accordion-body">
                                    <div>
                                        <div class="fw-bold">Deskripsi</div>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Non, quam est. Corrupti
                                            cupiditate, deserunt tempora suscipit illum ut mollitia perspiciatis.</p>
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
