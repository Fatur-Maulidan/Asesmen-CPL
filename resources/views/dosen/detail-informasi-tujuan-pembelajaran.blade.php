@extends('layouts.main')

@section('breadcrumb')
    <nav aria-label="breadcrumb mb-4">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item active" aria-current="page">{{ Breadcrumbs::render() }}</li>
        </ol>
    </nav>
    <h1>{{ $title }}</h1>
@endsection

@section('main')
    <div class="d-flex flex-row justify-content-center">
        <div class="d-flex flex-column pt-3 px-4 border border-1 rounded" style="width: 30%; height:100vh;">
            @for ($i = 1; $i <= 4; $i++)
                @if ($i == 1)
                    <div class="d-flex flex-row py-2 px-3 rounded border border-1 justify-content-between mb-2">
                        <div class="">TP-{{ $i }}</div>
                        <div class="badge text-bg-success">Disetujui</div>
                    </div>
                @else
                    <div class="d-flex flex-row py-2 px-3 rounded justify-content-between mb-2">
                        <div class="">TP-{{ $i }}</div>
                        @if ($i == 1 || $i == 2)
                            <div class="badge text-bg-success ms-3">Disetujui</div>
                        @elseif($i == 3)
                            <div class="badge text-bg-warning ms-3">Menunggu Validasi</div>
                        @else
                            <div class="badge text-bg-danger ms-3">Ditolak</div>
                        @endif
                    </div>
                @endif
            @endfor
        </div>
        <div class="ms-4" style="width: 70%">
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
                <div class="d-flex flex-column mb-4">
                    <div class="fw-bold">Indikator Kinerja Induk</div>
                    <div class="d-flex flex-column">
                        <div class="">SS-1.{{ $i }}</div>
                    </div>
                </div>
                <div class="d-flex flex-column">
                    <div class="fw-bold">Bobot berdasarkan Indikator Kinerja</div>
                    <div class="">1</div>
                </div>
            </div>
        </div>
    @endsection

    @push('scripts')
    @endpush
