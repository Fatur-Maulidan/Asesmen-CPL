@extends('layouts.main')

@section('breadcrumb')
    <nav aria-label="breadcrumb mb-4">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item active" aria-current="page">{{ Breadcrumbs::render() }}</li>
        </ol>
    </nav>
    <h1>Indikator Kinerja</h1>
@endsection

@section('main')
    <div class="d-flex flex-column">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            @for ($i = 1; $i <= 4; $i++)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapse{{ $i }}" aria-expanded="false"
                            aria-controls="flush-collapse{{ $i }}">
                            {{ 'SS-1.' . $i }}
                        </button>
                    </h2>
                    <div id="flush-collapse{{ $i }}" class="accordion-collapse collapse"
                        aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <div class="d-flex flex-column mb-3">
                                <div class="fw-bold">Deskripsi</div>
                                <div class="">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Hic beatae
                                    recusandae architecto consequuntur. Tempora eos quidem hic ex itaque. Quod.</div>
                            </div>
                            <div class="">
                                <div class="fw-bold">Tujuan Pembelajaran</div>
                                <ul>
                                    @for ($j = 1; $j <= 3; $j++)
                                        <li>{{ 'TP-' . $j }}</li>
                                    @endfor
                                </ul>
                            </div>
                        </div>
                        <div class="d-flex flex-column justify-content-center px-3 rounded-sm border border-1"
                            style="height:60px">
                            <a href="{{ route('dosen.mata-kuliah.indikator-kinerja.detail-informasi') }}">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
@endsection

@push('scripts')
@endpush
