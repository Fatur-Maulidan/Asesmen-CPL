@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('kaprodi.kurikulum.index', $kurikulum->tahun) }}
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

            <input type="radio" class="btn-check" name="status" id="nonaktif" autocomplete="off" value="nonaktif"
                @if (request('filter') == 'nonaktif') checked @endif>
            <label class="btn btn-outline-primary rounded-pill px-3" for="nonaktif">Nonaktif</label>

            <input type="radio" class="btn-check" name="status" id="peninjauan" autocomplete="off" value="peninjauan"
                @if (request('filter') == 'peninjauan') checked @endif>
            <label class="btn btn-outline-primary rounded-pill px-3" for="peninjauan">Peninjauan</label>
        </div>
    </div>

    {{-- Data kurikulum --}}
    <div class="row gy-5">
        @forelse ($data_kurikulum as $kurikulum)
            <div class="col-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center py-3">
                        <div class="d-inline">
                            <span class="fs-5 fw-bold me-2">Kurikulum {{ $kurikulum->tahun }}</span>
                            <span
                                class="badge @if ($kurikulum->status->is(\App\Enums\StatusKurikulum::Aktif)) text-bg-success @elseif ($kurikulum->status->is(\App\Enums\StatusKurikulum::Nonaktif)) text-bg-danger @else text-bg-warning @endif">{{ $kurikulum->status->key }}</span>
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
                    case 'nonaktif':
                        location.href = url + '?filter=nonaktif'
                        break;
                    case 'peninjauan':
                        location.href = url + '?filter=peninjauan'
                        break;
                }
            });
        });
    </script>
@endpush
