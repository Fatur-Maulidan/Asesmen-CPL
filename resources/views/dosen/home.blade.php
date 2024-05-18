@extends('layouts.main')

@section('breadcrumb')
    <nav aria-label="breadcrumb mb-4">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item active" aria-current="page">{{ Breadcrumbs::render() }}</li>
        </ol>
    </nav>
    <h1>Home</h1>
@endsection

@section('main')
    <div class="d-flex flex-row mb-4" style="width: 50%;">
        <select class="form-select" id="tahun-akademik" style="width:50%" data-placeholder="Pilih Tahun Akademik">
            <option></option>
            @for ($index = 0; $index < 5; $index++)
                <option style="color:black" value="202{{ $index }}/202{{ $index + 1 }}">
                    202{{ $index }}/202{{ $index + 1 }}
                </option>
            @endfor
        </select>

        {{-- <input type="text" class="form-control"> --}}
    </div>

    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between py-3">
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
    </div>
@endsection

@push('scripts')
    <script>
        $('#tahun-akademik').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: true
        });
    </script>
@endpush
