@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('kaprodi.ik.detail', $kurikulum->tahun, $ik->kode) }}
    <h1 class="fw-bold mb-0">Pemetaan {{ $ik->kode }} pada Capaian Pembelajaran</h1>
@endsection

@section('main')
    <div class="row">
        {{-- Sidebar --}}
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    @foreach ($dataIk as $data)
                        @if ($data != null)
                            <div class="mb-3">
                                <a href="{{ route('kaprodi.ik.detail', ['kurikulum' => $kurikulum->tahun, 'ik' => $data->kode]) }}"
                                    class="btn btn-light w-100 text-start {{ $data->kode == $ik->kode ? 'active' : '' }}">
                                    {{ $data->kode }}
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Detail --}}
        <div class="col-9">
            <div class="row mb-3">
                <div class="col d-flex">
                    <div class="me-4">
                        <div class="fw-bold">Diubah pada</div>
                        <div>01 Januari 2024 01:18</div>
                    </div>
                    <div class="me-4">
                        <div class="fw-bold">Diperbarui pada</div>
                        <div>01 Januari 2024 01:18</div>
                    </div>
                    <div>
                        <div class="fw-bold">Diubah oleh</div>
                        <div>Jhon Doe</div>
                    </div>
                </div>
                <div class="col-auto">
                    <a href="{{ route('kaprodi.ik.edit', ['kurikulum' => $kurikulum->tahun, 'ik' => $ik->kode]) }}"
                        class="btn btn-warning">Ubah
                        Pemetaan</a>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="fw-bold">Deskripsi</div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad officiis praesentium hic nihil vel non
                        recusandae tempora id cum repellat!</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="fw-bold mb-3">Pemetaan terhadap Capaian Pembelajaran</div>
                    @foreach ($dataCpl as $cpl)
                        <div class="mb-3">
                            <div class="fw-bold">{{ $cpl->kode }}</div>
                            <p>{{ $cpl->deskripsi }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
