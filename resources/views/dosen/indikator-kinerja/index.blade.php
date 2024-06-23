@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('dosen.mata-kuliah.indikator-kinerja.index', $mata_kuliah->kode) }}
    <h1 class="fw-bold mb-4">{{ $title }}</h1>
@endsection

@section('main')
    <div class="row">
        <div class="col-12">
            <div class="accordion accordion-flush border border-2" id="daftarIK">
                @foreach ($ik_mata_kuliah as $index => $ik)
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
                                        @forelse ($ik['tp'] as $tp)
                                            <li>{{ $tp['kode'] }}</li>
                                        @empty
                                            <li>Belum ada pemetaan.</li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                            <div class="d-flex flex-column justify-content-center px-3 rounded-sm border border-1"
                                style="height:60px">
                                <a
                                    href="{{ route('dosen.mata-kuliah.indikator-kinerja.show', ['kodeMataKuliah' => $mata_kuliah->kode, 'kodeIk' => $ik['kode']]) }}">Lihat
                                    Detail</a>
                            </div>
                        </div>
                @endforeach
            </div>
        </div>
    @endsection
