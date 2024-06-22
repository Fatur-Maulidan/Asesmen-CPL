@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('dosen.mata-kuliah.indikator-kinerja', $kodeMataKuliah) }}
    <h1 class="fw-bold mb-0">
        {{ $title }}</h1>
@endsection

@section('main')
    <div class="d-flex flex-column">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            @foreach ($data_ik as $index => $ik)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapse{{ $index }}" aria-expanded="false"
                            aria-controls="flush-collapse{{ $index }}">
                            {{ $ik['kode'] }} - {{ $ik['deskripsi'] }}
                        </button>
                    </h2>
                    <div id="flush-collapse{{ $index }}" class="accordion-collapse collapse"
                        aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <div class="">
                                <div class="fw-bold">Tujuan Pembelajaran</div>
                                <ul>
                                    @if ($ik['tujuanPembelajaran']->isEmpty())
                                        <li>Tidak ada tujuan pembelajaran</li>
                                    @else
                                        @foreach ($ik['tujuanPembelajaran'] as $tp)
                                            <li>{{ $tp->kode }}</li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="d-flex flex-column justify-content-center px-3 rounded-sm border border-1"
                            style="height:60px">
                            <a
                                href="{{ route('dosen.mata-kuliah.indikator-kinerja.detail-informasi', ['kodeMataKuliah' => $kodeMataKuliah]) }}">Lihat
                                Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@push('scripts')
@endpush
