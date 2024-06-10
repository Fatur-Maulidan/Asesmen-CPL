@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('dosen.mata-kuliah.indikator-kinerja.detail-informasi', $kodeMataKuliah) }}
    <h1 class="fw-bold mb-0">
        {{ $title }}</h1>
@endsection

@section('main')
    <div class="d-flex flex-row justify-content-center">
        <div class="d-flex flex-column pt-3 px-4 border border-1 rounded" style="width: 25%; height:100vh;">
            @for ($i = 1; $i <= 10; $i++)
                @if ($i == 1)
                    <div class="py-2 ps-3 rounded border border-1">SS-1.{{ $i }}</div>
                @else
                    <div class="py-2 ps-3 rounded">SS-1.{{ $i }}</div>
                @endif
            @endfor
        </div>
        <div class="ms-4" style="width: 75%">
            <div class="d-flex flex-column">
                <div class="d-flex flex-row mb-4">
                    <div class="d-flex flex-column">
                        <div class="fw-bold">Diubah Pada</div>
                        <div class="">01 / Januari / 2024 01:18</div>
                    </div>
                    <div class="d-flex flex-column ms-4">
                        <div class="fw-bold">Diperbarui Pada</div>
                        <div class="">01 / Januari / 2024 01:18</div>
                    </div>
                    <div class="d-flex flex-column ms-4">
                        <div class="fw-bold">Diubah Oleh</div>
                        <div class="">{{ $nama }}</div>
                    </div>
                </div>

                <div class="d-flex flex-column mb-4">
                    <div class="fw-bold">Deskripsi</div>
                    <div class="">Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt quasi autem unde
                        cum impedit quas ab aspernatur ea illo eum!/div>
                    </div>
                </div>

                <div class="d-flex flex-column">
                    <div class="fw-bold mb-2">Pemetaan pada Tujuan Pembelajaran</div>
                    @for ($i = 1; $i <= 3; $i++)
                        <div class="d-flex flex-column mb-4">
                            <div class="fw-bold">TP-{{ $i }}</div>
                            <div class="">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab quo libero esse
                                debitis deleniti eum? Repellendus suscipit itaque laboriosam impedit?</div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    @endsection

    @push('scripts')
    @endpush
