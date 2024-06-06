@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('kaprodi.mk.index', $kurikulum->tahun) }}
    <h1 class="fw-bold mb-0">{{ $title }}</h1>
@endsection

@section('main')
    <div class="row mb-5">
        <div class="col text-end">
            {{-- Button trigger modal --}}
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Tambah Mata Kuliah
            </button>
        </div>
    </div>

    {{-- Modal --}}
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">Tambah Mata Kuliah</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label fw-bold">Nama</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                placeholder="Nama mata kuliah">
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput2" class="form-label fw-bold">Kode</label>
                            <input type="text" class="form-control" id="exampleFormControlInput2"
                                placeholder="Kode mata kuliah">
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label fw-bold">Deskripsi</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput3" class="form-label fw-bold">Jumlah SKS</label>
                            <input type="number" class="form-control" id="exampleFormControlInput3"
                                placeholder="Jumlah SKS mata kuliah">
                        </div>

                        <div class="mb-3">
                            <label for="domain" class="form-label fw-bold">Sifat Pengambilan</label>
                            <select class="form-select" id="domain">
                                <option selected>Pilih sifat pegambilan</option>
                                <option value="1">Sikap (S)</option>
                                <option value="2">Pengetahuan (P)</option>
                                <option value="3">Keterampilan Umum (KU)</option>
                                <option value="4">Keterampilan Khusus (KK)</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="domain" class="form-label fw-bold">Metode Pembelajaran</label>
                            <select class="form-select" id="domain">
                                <option selected>Pilih sifat pegambilan</option>
                                <option value="1">Sikap (S)</option>
                                <option value="2">Pengetahuan (P)</option>
                                <option value="3">Keterampilan Umum (KU)</option>
                                <option value="4">Keterampilan Khusus (KK)</option>
                            </select>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col">
                            <button type="button" class="btn btn-danger w-100">Batal</button>
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
                            21IF001 - Dasar Dasar Pemrograman
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p class="fw-bold mb-1">Deskripsi</p>
                            <p class="mb-4">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi laboriosam
                                debitis tempore dicta, sint beatae maxime? Ut natus ullam consequuntur!</p>

                            <p class="fw-bold mb-1">Capaian Pembelajaran</p>
                            <p class="mb-4">Belum ada pemetaan</p>

                            <p class="fw-bold mb-1">Indikator Kinerja</p>
                            <p class="mb-0">Belum ada pemetaan</p>
                        </div>
                        <div class="accordion-footer bg-light mb-0 p-3 border-top ">
                            <a href="{{ route('kaprodi.mk.show', ['kurikulum' => $kurikulum, 'mk' => '1']) }}"
                                class="me-3">Lihat
                                detail</a>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            21IF002 - Pengantar Tenkologi Informasi dan Komputer
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p class="fw-bold mb-1">Deskripsi</p>
                            <p class="mb-4">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi laboriosam
                                debitis tempore dicta, sint beatae maxime? Ut natus ullam consequuntur!</p>

                            <p class="fw-bold mb-1">Capaian Pembelajaran</p>
                            <p class="mb-4">Belum ada pemetaan</p>

                            <p class="fw-bold mb-1">Indikator Kinerja</p>
                            <p class="mb-0">Belum ada pemetaan</p>
                        </div>
                        <div class="accordion-footer bg-light mb-0 p-3 border-top ">
                            <a href="" class="me-3">Lihat detail</a>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            21IF003 - Proyek 1 : Pemanfaatan Aplikasi Perkantoran
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p class="fw-bold mb-1">Deskripsi</p>
                            <p class="mb-4">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi laboriosam
                                debitis tempore dicta, sint beatae maxime? Ut natus ullam consequuntur!</p>

                            <p class="fw-bold mb-1">Capaian Pembelajaran</p>
                            <p class="mb-4">Belum ada pemetaan</p>

                            <p class="fw-bold mb-1">Indikator Kinerja</p>
                            <p class="mb-0">Belum ada pemetaan</p>
                        </div>
                        <div class="accordion-footer bg-light mb-0 p-3 border-top ">
                            <a href="" class="me-3">Lihat detail</a>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            21IF004 - Komputasi Kognitif
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p class="fw-bold mb-1">Deskripsi</p>
                            <p class="mb-4">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi laboriosam
                                debitis tempore dicta, sint beatae maxime? Ut natus ullam consequuntur!</p>

                            <p class="fw-bold mb-1">Capaian Pembelajaran</p>
                            <p class="mb-4">Belum ada pemetaan</p>

                            <p class="fw-bold mb-1">Indikator Kinerja</p>
                            <p class="mb-0">Belum ada pemetaan</p>
                        </div>
                        <div class="accordion-footer bg-light mb-0 p-3 border-top ">
                            <a href="" class="me-3">Lihat detail</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
