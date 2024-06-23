@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('kaprodi.kurikulum.index') }}
    <h1 class="fw-bold mb-0">{{ $title }}</h1>
@endsection

@section('main')
    {{-- Search and add button --}}
    <div class="row justify-content-between mb-4">
        <div class="col-auto">
            <form role="search" method="GET" action="" autocomplete="off">
                <input class="form-control search" type="search" id="search" name="search" placeholder="Cari"
                    value="{{ request('search') }}">
            </form>
        </div>
        <div class="col text-end">
            <a href="{{ route('kaprodi.kurikulum.create') }}" class="btn btn-primary">Tambah Kurikulum Baru</a>
        </div>
    </div>

    {{-- Filter buttons --}}
    <div class="row mb-4">
        <div class="col-12">
            <input type="radio" class="btn-check" name="status" id="semua" autocomplete="off" value="semua"
                @if (!request('filter')) checked @endif>
            <label class="btn btn-outline-primary rounded-pill px-3" for="semua">Semua</label>

            <input type="radio" class="btn-check" name="status" id="aktif" autocomplete="off" value="aktif"
                @if (request('filter') == 'aktif') checked @endif>
            <label class="btn btn-outline-primary rounded-pill px-3" for="aktif">Aktif</label>

            <input type="radio" class="btn-check" name="status" id="berjalan" autocomplete="off" value="berjalan"
                @if (request('filter') == 'berjalan') checked @endif>
            <label class="btn btn-outline-primary rounded-pill px-3" for="berjalan">Berjalan</label>

            <input type="radio" class="btn-check" name="status" id="pengelolaan" autocomplete="off" value="pengelolaan"
                @if (request('filter') == 'pengelolaan') checked @endif>
            <label class="btn btn-outline-primary rounded-pill px-3" for="pengelolaan">Pengelolaan</label>
        </div>
    </div>

    {{-- Data kurikulum --}}
    <div class="row gy-5">
        @forelse ($kurikulum as $kurikulum)
            <div class="col-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center py-3">
                        <div class="d-inline">
                            <span class="fs-5 fw-bold me-2">Kurikulum {{ $kurikulum->tahun }}</span>
                            <span
                                class="badge @if ($kurikulum->status->is(\App\Enums\StatusKurikulum::Aktif)) text-bg-success @elseif ($kurikulum->status->is(\App\Enums\StatusKurikulum::Berjalan)) text-bg-danger @else text-bg-warning @endif">{{ $kurikulum->status->key }}
                            </span>
                        </div>
                        <a href="{{ route('kaprodi.kurikulum.dashboard.cpl', ['kurikulum' => $kurikulum->tahun]) }}"
                            class="link-secondary">
                            <i class="bi bi-arrow-right-circle" style="font-size: 1.5rem;"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title fw-bold ">Mahasiswa Aktif</h6>
                        <ul class="mb-0">
                            @forelse($kurikulum->angkatan_mahasiswa_terdaftar as $angkatan)
                                <li>Mahasiswa angkatan {{ $angkatan }}</li>
                            @empty
                                <li>Belum ada mahasiswa terdaftar.</li>
                            @endforelse
                        </ul>
                    </div>
                    <div class="card-footer text-body-secondary py-3">
                        <a href="{{ route('kaprodi.kurikulum.dashboard.cpl', ['kurikulum' => $kurikulum->tahun]) }}" class="d-block">Lihat hasil Asesmen CPL</a>
                        <a href="{{ route('kaprodi.cpl.index', ['kurikulum' => $kurikulum->tahun]) }}" class="d-block">Lihat Capaian Pembelajaran</a>
                        <a href="{{ route('kaprodi.ik.index', ['kurikulum' => $kurikulum->tahun]) }}" class="d-block">Lihat Indikator Kinerja</a>
                        <a href="{{ route('kaprodi.tp.index', ['kurikulum' => $kurikulum->tahun]) }}" class="d-block">Lihat Tujuan Pembelajaran</a>
                        <a href="{{ route('kaprodi.mata-kuliah.index', ['kurikulum' => $kurikulum->tahun]) }}" class="d-block">Lihat Mata Kuliah</a>
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

@push('scripts')
    <script>
        const url = "{{ url()->current() }}";

        $(document).ready(function() {
            $('input[type=radio][name=status]').on('click', function() {
                switch ($(this).val()) {
                    case 'semua':
                        location.href = url;
                        break;
                    case 'aktif':
                        location.href = url + '?filter=aktif'
                        break;
                    case 'berjalan':
                        location.href = url + '?filter=berjalan'
                        break;
                    case 'pengelolaan':
                        location.href = url + '?filter=pengelolaan'
                        break;
                }
            });
        });
    </script>
@endpush
