@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.jurusan.index') }}
    <h1 class="fw-bold mb-0">{{ $title }}</h1>
@endsection

@section('main')
    {{-- Filter buttons --}}
    <div class="row mb-4">
        <div class="col">
            <form role="search">
                <input class="form-control search" type="search" placeholder="Cari" autocomplete="off">
            </form>
        </div>
        <div class="col text-end">
            {{-- Button trigger modal --}}
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahJurusanModal">
                Tambah Jurusan Baru
            </button>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-auto">
            <input type="radio" class="btn-check" name="options" id="option1" autocomplete="off" checked>
            <label class="btn btn-outline-primary rounded-pill px-3" for="option1">Semua</label>

            <input type="radio" class="btn-check" name="options" id="option2" autocomplete="off">
            <label class="btn btn-outline-primary rounded-pill px-3" for="option2">Rekayasa</label>

            <input type="radio" class="btn-check" name="options" id="option3" autocomplete="off">
            <label class="btn btn-outline-primary rounded-pill px-3" for="option3">Non Rekayasa</label>
        </div>
    </div>

    {{-- Tambah Jurusan Modal --}}
    <div class="modal fade" id="tambahJurusanModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="tambahJurusanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="tambahJurusanModalLabel">Tambah Jurusan Baru</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="mb-4">
                            <label for="nama" class="form-label fw-bold">Nama</label>
                            <input type="text" class="form-control" id="nama" placeholder="Nama Jurusan">
                        </div>

                        <div class="mb-4">
                            <label for="" class="fw-bold mb-2">Golongan</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                        id="inlineRadio1" value="option1">
                                    <label class="form-check-label" for="inlineRadio1">Rekayasa</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                        id="inlineRadio2" value="option2">
                                    <label class="form-check-label" for="inlineRadio2">Non Rekayasa</label>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="domain" class="form-label fw-bold">Ketua Jurusan</label>
                            <select class="form-select" id="domain">
                                <option selected>Pilih dosen</option>
                                <option value="1">Yadi Adithia</option>
                                <option value="2">Alex Yassensdra</option>
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

    {{-- Tambah Program Studi Modal --}}
    <div class="modal fade" id="tambahProgramStudiModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="tambahProgramStudiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="tambahProgramStudiModalLabel">Tambah Jurusan Baru</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="mb-4">
                            <label for="nama_prodi" class="form-label fw-bold">Nama</label>
                            <input type="text" class="form-control" id="nama_prodi" placeholder="Nama program studi">
                        </div>

                        <div class="mb-4">
                            <label for="domain" class="form-label fw-bold">Jenjang pendidikan</label>
                            <select class="form-select" id="domain">
                                <option selected>Pilih jenjang pendidikan program studi</option>
                                <option value="1">Yadi Adithia</option>
                                <option value="2">Alex Yassensdra</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="nomor_prodi" class="form-label fw-bold">Nomor</label>
                            <input type="text" class="form-control" id="nomor_prodi"
                                placeholder="Nomor program studi">
                        </div>

                        <div>
                            <label for="domain" class="form-label fw-bold">Koordinator program studi</label>
                            <select class="form-select" id="domain">
                                <option selected>Pilih dosen</option>
                                <option value="1">Yadi Adithia</option>
                                <option value="2">Alex Yassensdra</option>
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

    {{-- Data jurusan --}}
    <div class="row gy-5">
        <div class="col-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-inline">
                        <span class="fs-5 fw-bold me-2">Jurusan Teknik Komputer dan Informatika</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="fw-bold">Golongan jurusan</div>
                        <div>Rekayasa</div>
                    </div>

                    <div class="mb-3">
                        <div class="fw-bold">Ketua Jurusan</div>
                        <div>Yadi Adithia</div>
                    </div>

                    <div>
                        <div class="fw-bold">Program studi terdaftar</div>
                        <ul class="mb-0">
                            <li>D3 Teknik Informatika</li>
                            <li>D4 Teknik Informatika</li>
                        </ul>
                    </div>
                </div>
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button bg-light fw-bold" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                D3 Teknik Informatika <span class="badge text-bg-primary ms-2">Aktif</span>
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="mb-3">
                                    <div class="fw-bold">Nomor program studi</div>
                                    <div>1511</div>
                                </div>

                                <div class="mb-3">
                                    <div class="fw-bold">Kode program studi</div>
                                    <div>JTK</div>
                                </div>

                                <div class="mb-3">
                                    <div class="fw-bold">Koordinator program studi</div>
                                    <div>Lukmanul Hakim</div>
                                </div>

                                <div>
                                    <div class="fw-bold">Koordinator program studi</div>
                                    <ul class="mb-0">
                                        <li>Kurikulum 2019</li>
                                        <li>Kurikulum 2020</li>
                                        <li>Kurikulum 2021</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button bg-light collapsed fw-bold" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                aria-controls="collapseTwo">
                                D4 Teknik Informatika <span class="badge text-bg-primary ms-2">Aktif</span>
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="mb-3">
                                    <div class="fw-bold">Nomor program studi</div>
                                    <div>1511</div>
                                </div>

                                <div class="mb-3">
                                    <div class="fw-bold">Kode program studi</div>
                                    <div>JTK</div>
                                </div>

                                <div class="mb-3">
                                    <div class="fw-bold">Koordinator program studi</div>
                                    <div>Lukmanul Hakim</div>
                                </div>

                                <div>
                                    <div class="fw-bold">Koordinator program studi</div>
                                    <ul class="mb-0">
                                        <li>Kurikulum 2019</li>
                                        <li>Kurikulum 2020</li>
                                        <li>Kurikulum 2021</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body text-body-secondary">
                    <a href="" class="me-2">Ubah</a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#tambahProgramStudiModal">Tambah Program
                        Studi</a>
                </div>
            </div>
        </div>
    </div>
@endsection
