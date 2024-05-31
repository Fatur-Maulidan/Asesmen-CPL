@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render() }}
    <h1 class="fw-bold mb-0">{{ $title }}</h1>
@endsection

@section('main')
    <div class="d-flex flex-row">
        {{-- Pilihan Dashboard --}}
        <div class="d-flex flex-column">
            <div class="">Pilihan Dashboard</div>
            <div class="d-flex flex-row">
                <input type="radio" class="btn-check" name="options" id="option1" autocomplete="off" checked>
                <label class="btn btn-outline-primary rounded-pill px-3" for="option1">Capaian Pembelajaran</label>
            </div>
            <div class="d-flex flex-row">
                <input type="radio" class="btn-check" name="options" id="option2" autocomplete="off">
                <label class="btn btn-outline-primary rounded-pill px-3" for="option2">Mata Kuliah</label>
            </div>
        </div>
        {{-- Pilihan Dashboard --}}

        {{-- if options 1 is checked --}}
        {{-- Grafik --}}
        <div class="d-flex flex-column">
            <div class="row mb-4">
                <div class="col-auto">
                    <input type="radio" class="btn-check" name="options" id="option1" autocomplete="off" checked>
                    <label class="btn btn-outline-primary rounded-pill px-3" for="option1">Semua</label>

                    <input type="radio" class="btn-check" name="options" id="option2" autocomplete="off">
                    <label class="btn btn-outline-primary rounded-pill px-3" for="option2">Sikap (SS)</label>

                    <input type="radio" class="btn-check" name="options" id="option3" autocomplete="off">
                    <label class="btn btn-outline-primary rounded-pill px-3" for="option3">Keterampilan Umum (KU)</label>

                    <input type="radio" class="btn-check" name="options" id="option3" autocomplete="off">
                    <label class="btn btn-outline-primary rounded-pill px-3" for="option3">Keterampilan Khusus (KK)</label>

                    <input type="radio" class="btn-check" name="options" id="option3" autocomplete="off">
                    <label class="btn btn-outline-primary rounded-pill px-3" for="option3">Keterampilan Umum (KU)</label>
                </div>
            </div>
            {{-- Graph --}}
            @for ($i = 1; $i <= 3; $i++)
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <img class="img-fluid" src="{{ asset('images/graph.png') }}" alt="Graph">
                    </div>
                    <div class="col-md-6 overflow-auto" style="max-height: 400px;">
                        @for ($i = 1; $i <= 10; $i++)
                            <div class="mb-3">
                                <div class="fw-bold">SS-{{ $i }}</div>
                                <div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita sed reprehenderit at
                                    quasi
                                    dolorem ratione maiores unde nihil accusantium! Laborum!</div>
                            </div>
                        @endfor
                    </div>
                </div>
            @endfor
            {{-- End Graph --}}
        </div>

        {{-- if options 2 is checked --}}
        <div class="d-flex flex-column">
            <div class="row mb-4">
                <div class="col-auto">
                    <input type="radio" class="btn-check" name="options" id="option1" autocomplete="off" checked>
                    <label class="btn btn-outline-primary rounded-pill px-3" for="option1">Semua</label>

                    <input type="radio" class="btn-check" name="options" id="option2" autocomplete="off">
                    <label class="btn btn-outline-primary rounded-pill px-3" for="option2">Sikap (SS)</label>

                    <input type="radio" class="btn-check" name="options" id="option3" autocomplete="off">
                    <label class="btn btn-outline-primary rounded-pill px-3" for="option3">Keterampilan Umum (KU)</label>

                    <input type="radio" class="btn-check" name="options" id="option3" autocomplete="off">
                    <label class="btn btn-outline-primary rounded-pill px-3" for="option3">Keterampilan Khusus (KK)</label>

                    <input type="radio" class="btn-check" name="options" id="option3" autocomplete="off">
                    <label class="btn btn-outline-primary rounded-pill px-3" for="option3">Keterampilan Umum (KU)</label>
                </div>
            </div>
            {{-- Graph --}}
            @for ($i = 1; $i <= 3; $i++)
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <img class="img-fluid" src="{{ asset('images/graph.png') }}" alt="Graph">
                    </div>
                    <div class="col-md-6 overflow-auto" style="max-height: 400px;">
                        @for ($i = 1; $i <= 10; $i++)
                            <div class="mb-3">
                                <div class="fw-bold">SS-{{ $i }}</div>
                                <div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita sed reprehenderit at
                                    quasi
                                    dolorem ratione maiores unde nihil accusantium! Laborum!</div>
                            </div>
                        @endfor
                    </div>
                </div>
            @endfor
            {{-- End Graph --}}
        </div>
    </div>
@endsection
