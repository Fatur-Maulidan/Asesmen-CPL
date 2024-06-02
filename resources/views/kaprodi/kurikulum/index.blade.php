@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('kaprodi.kurikulum.index') }}
    <h1 class="fw-bold mb-0">{{ $title }}</h1>
@endsection

@section('main')
    {{-- Search and add button --}}
    <div class="row justify-content-between mb-4">
        <div class="col-auto">
            <form role="search">
                <input class="form-control search" type="search" placeholder="Cari" autocomplete="off">
            </form>
        </div>
        <div class="col text-end">
            <a href="{{ route('kaprodi.kurikulum.create') }}" class="btn btn-primary">Tambah Kurikulum Baru</a>
        </div>
    </div>

    {{-- Filter buttons --}}
    <div class="row mb-4">
        <div class="col-12">
            <input type="radio" class="btn-check" name="options" id="option1" autocomplete="off" checked>
            <label class="btn btn-outline-primary rounded-pill px-3" for="option1">Semua</label>

            <input type="radio" class="btn-check" name="options" id="option2" autocomplete="off">
            <label class="btn btn-outline-primary rounded-pill px-3" for="option2">Berjalan</label>

            <input type="radio" class="btn-check" name="options" id="option3" autocomplete="off">
            <label class="btn btn-outline-primary rounded-pill px-3" for="option3">Peninjauan</label>

            <input type="radio" class="btn-check" name="options" id="option4" autocomplete="off">
            <label class="btn btn-outline-primary rounded-pill px-3" for="option4">Arsip</label>
        </div>
    </div>

    {{-- Data kurikulum --}}
    <div class="row gy-5">
        @forelse ($dataKurikulum as $kurikulum)
            <div class="col-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center py-3">
                        <div class="d-inline">
                            <span class="fs-5 fw-bold me-2">Kurikulum {{ $kurikulum->tahun }}</span>
                            <span
                                class="badge {{ $kurikulum->status->key == 'Aktif' ? 'text-bg-success' : 'text-bg-danger' }}">{{ $kurikulum->status->key == 'Aktif' ? 'Berjalan' : 'Berhenti' }}</span>
                        </div>
                        <a href="{{ route('kaprodi.kurikulum.dashboard', ['kurikulum' => $kurikulum->tahun]) }}"
                            class="link-secondary">
                            <i class="bi bi-arrow-right-circle" style="font-size: 1.5rem;"></i>
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
        @empty
            <div class="col-12">
                <div class="alert alert-secondary" role="alert">
                    Tidak ada data.
                </div>
            </div>
        @endforelse
    </div>
@endsection
