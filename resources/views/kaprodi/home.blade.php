@extends('layouts.main')

@section('breadcrumb')
    <nav aria-label="breadcrumb mb-4">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item active" aria-current="page">{{ Breadcrumbs::render('kurikulum.index') }}</li>
        </ol>
    </nav>
    <h1>Home</h1>
@endsection

@section('main')
    <div class="row justify-content-between mb-4">
        <div class="col-auto">
            <form role="search">
                <input class="form-control me-2" type="search" placeholder="Cari">
            </form>
        </div>
        <div class="col text-end">
            <a href="{{ route('kurikulum.create') }}" class="btn btn-primary">Tambah Kurikulum Baru</a>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col">
            <input type="radio" class="btn-check" name="options" id="option1" autocomplete="off" checked>
            <label class="btn btn-primary" for="option1">Checked</label>

            <input type="radio" class="btn-check" name="options" id="option2" autocomplete="off">
            <label class="btn btn-light" for="option2">Radio</label>

            <input type="radio" class="btn-check" name="options" id="option4" autocomplete="off">
            <label class="btn btn-light" for="option4">Radio</label>
        </div>
    </div>

    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between  py-3">
                    <div class="d-inline">
                        <span class="fs-5 fw-bold me-2">Kurikulum 20XX</span>
                        <span class="badge text-bg-success">Berjalan</span>
                    </div>
                    <a href="" class="link-dark">
                        <i class="bi bi-arrow-right-circle"></i>
                    </a>
                </div>
                <div class="card-body">
                    <h6 class="card-title fw-bold ">Mahasiswa Aktif</h6>
                    <ul class="mb-0">
                        <li>Mahasiswa tahun masuk 20XX</li>
                        <li>Mahasiswa tahun masuk 20XX</li>
                    </ul>
                </div>
                <div class="card-footer text-body-secondary py-3">
                    <a href="" class="d-block">Lihat hasil Asesmen CPL</a>
                    <a href="" class="d-block">Lihat Capaian Pembelajaran</a>
                    <a href="" class="d-block">Lihat Indikator Kinerja</a>
                    <a href="" class="d-block">Lihat Tujuan Pembelajaran</a>
                    <a href="" class="d-block">Lihat Mata Kuliah</a>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between  py-3">
                    <div class="d-inline">
                        <span class="fs-5 fw-bold me-2">Kurikulum</span>
                        <span class="badge text-bg-success">Berjalan</span>
                    </div>
                    <a href="" class="link-dark">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z" />
                        </svg>
                    </a>
                </div>
                <div class="card-body">
                    <h6 class="card-title fw-bold ">Mahasiswa Aktif</h6>
                    <ul class="mb-0">
                        <li>Mahasiswa tahun masuk 20XX</li>
                        <li>Mahasiswa tahun masuk 20XX</li>
                        <li>Mahasiswa tahun masuk 20XX</li>
                        <li>Mahasiswa tahun masuk 20XX</li>
                    </ul>
                </div>
                <div class="card-footer text-body-secondary py-3">
                    <a href="" class="d-block">Lihat hasil Asesmen CPL</a>
                    <a href="" class="d-block">Lihat Capaian Pembelajaran</a>
                    <a href="" class="d-block">Lihat Indikator Kinerja</a>
                    <a href="" class="d-block">Lihat Tujuan Pembelajaran</a>
                    <a href="" class="d-block">Lihat Mata Kuliah</a>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between  py-3">
                    <div class="d-inline">
                        <span class="fs-5 fw-bold me-2">Kurikulum</span>
                        <span class="badge text-bg-warning">Peninjauan</span>
                    </div>
                    <a href="" class="link-dark">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z" />
                        </svg>
                    </a>
                </div>
                <div class="card-body">
                    <h6 class="card-title fw-bold ">Mahasiswa Aktif</h6>
                    -
                </div>
                <div class="card-footer text-body-secondary py-3">
                    <a href="" class="d-block">Lihat hasil Asesmen CPL</a>
                    <a href="" class="d-block">Lihat Capaian Pembelajaran</a>
                    <a href="" class="d-block">Lihat Indikator Kinerja</a>
                    <a href="" class="d-block">Lihat Tujuan Pembelajaran</a>
                    <a href="" class="d-block">Lihat Mata Kuliah</a>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between  py-3">
                    <div class="d-inline">
                        <span class="fs-5 fw-bold me-2">Kurikulum</span>
                        <span class="badge text-bg-secondary">Arsip</span>
                    </div>
                    <a href="" class="link-dark">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z" />
                        </svg>
                    </a>
                </div>
                <div class="card-body">
                    <h6 class="card-title fw-bold ">Mahasiswa Aktif</h6>
                    -
                </div>
                <div class="card-footer text-body-secondary py-3">
                    <a href="" class="d-block">Lihat hasil Asesmen CPL</a>
                    <a href="" class="d-block">Lihat Capaian Pembelajaran</a>
                    <a href="" class="d-block">Lihat Indikator Kinerja</a>
                    <a href="" class="d-block">Lihat Tujuan Pembelajaran</a>
                    <a href="" class="d-block">Lihat Mata Kuliah</a>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between  py-3">
                    <div class="d-inline">
                        <span class="fs-5 fw-bold me-2">Kurikulum</span>
                        <span class="badge text-bg-success">Berjalan</span>
                    </div>
                    <a href="" class="link-dark">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z" />
                        </svg>
                    </a>
                </div>
                <div class="card-body">
                    <h6 class="card-title fw-bold ">Mahasiswa Aktif</h6>
                    <ul class="mb-0">
                        <li>Mahasiswa tahun masuk 20XX</li>
                        <li>Mahasiswa tahun masuk 20XX</li>
                        <li>Mahasiswa tahun masuk 20XX</li>
                        <li>Mahasiswa tahun masuk 20XX</li>
                    </ul>
                </div>
                <div class="card-footer text-body-secondary py-3">
                    <a href="" class="d-block">Lihat hasil Asesmen CPL</a>
                    <a href="" class="d-block">Lihat Capaian Pembelajaran</a>
                    <a href="" class="d-block">Lihat Indikator Kinerja</a>
                    <a href="" class="d-block">Lihat Tujuan Pembelajaran</a>
                    <a href="" class="d-block">Lihat Mata Kuliah</a>
                </div>
            </div>
        </div>
    </div>
@endsection
