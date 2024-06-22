@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('dosen.mata-kuliah.indikator-kinerja.index', $mata_kuliah->kode) }}
    <h1 class="fw-bold mb-4">{{ $title }}</h1>
@endsection

@section('main')
    <div class="row">
        <div class="col-12">
            <div class="accordion accordion-flush border border-2" id="daftarIK">
                @foreach ($ik_mata_kuliah as $ik)
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{ $loop->iteration }}" aria-expanded="false"
                                    aria-controls="collapse{{ $loop->iteration }}">
                                {{ $ik['kode'] }}
                            </button>
                        </h2>
                        <div id="collapse{{ $loop->iteration }}" class="accordion-collapse collapse" data-bs-parent="#daftarIK">
                            <div class="accordion-body">
                                <div class="d-flex flex-column mb-3">
                                    <div class="fw-bold">Deskripsi</div>
                                    <div class="">{{ $ik['deskripsi'] }}</div>
                                </div>
                                <div class="">
                                    <div class="fw-bold">Tujuan Pembelajaran</div>
                                    <ul class="mb-0">
{{--                                        @php print_r($ik); @endphp--}}
                                        @foreach ($ik['tp'] as $tp)
                                            <li>{{ $tp['kode'] }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="accordion-footer bg-light mb-0 p-3 border-top">
                                <a href="{{ route('dosen.mata-kuliah.indikator-kinerja.show', ['kodeMataKuliah' => $mata_kuliah->kode]) }}">Lihat
                                    Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
