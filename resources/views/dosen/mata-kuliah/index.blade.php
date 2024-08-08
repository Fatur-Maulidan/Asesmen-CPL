@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('dosen.mata-kuliah.index') }}
    <h1 class="fw-bold mb-4">{{ $title }}</h1>
@endsection

@section('main')
    <div class="row">
        @foreach ($mata_kuliah as $index => $mk_register)
            <div class="col-4">
                <div class="card mb-3">
                    <div class="card-header d-flex flex-column">
                        <div class=" d-flex flex-row justify-content-between align-items-center mb-3">
                            <div class="d-flex flex-column">
                                <div class="d-flex flex-row align-items-center">
                                    <div class="fs-5 fw-bold me-2">{{ $mk_register->mataKuliah->kode }}</div>
                                </div>
                                <div>{{ $mk_register->mataKuliah->nama }} <span class="badge text-bg-info">{{ $mk_register->jenis }}</span></div>
                            </div>
                        </div>
                        <div>{{ $mk_register->mataKuliah->kurikulum->programStudi->jenjang_pendidikan . ' ' . $mk_register->mataKuliah->kurikulum->programStudi->nama }}</div>
                    </div>
                    <div class="card-body d-flex flex-column justify-content-center">
                        <div class="d-flex flex-column mb-3">
                            <div class="fw-bold">Tahun Akademik</div>
                            <ul class="mb-0">
                                @foreach ($mk_register->mataKuliah->mataKuliahRegister->unique('tahun_akademik_awal') as $tahun_akademik)
                                    <li>{{ $tahun_akademik->tahun_akademik_awal . ' / ' . $tahun_akademik->tahun_akademik_akhir }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="d-flex flex-column">
                            <div class="fw-bold">Semester</div>
                            <ul class="mb-0">
                                @foreach ($mk_register->mataKuliah->mataKuliahRegister->unique('semester') as $mk_register->mataKuliahr)
                                    <li>{{ $mk_register->mataKuliahr->semester }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="card-footer text-body-secondary py-3">
                        <a href="{{ route('dosen.mata-kuliah.show', ['kodeMataKuliah' => $mk_register->mataKuliah->kode, 'jenis' => $mk_register->jenis]) }}" class="btn btn-secondary">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
