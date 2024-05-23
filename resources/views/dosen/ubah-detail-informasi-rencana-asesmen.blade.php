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
        <div class="d-flex flex-column pt-3 px-4 border border-1 rounded overflow-auto " style="width: 30%; height:100vh;">
            <button class="btn btn-primary">Buat Asesmen Baru</button>
            <hr class="mb-3">
            </hr>
            @for ($i = 1; $i <= 8; $i++)
                @if ($i == 1)
                    <div class="d-flex flex-row py-2 px-3 rounded border border-1 justify-content-between mb-2 btn-tp">
                        <div class="">Tugas#{{ $i }}</div>
                    </div>
                @else
                    <div class="d-flex flex-row py-2 px-3 rounded justify-content-between mb-2 btn-tp">
                        <div class="">Tugas#{{ $i }}</div>
                    </div>
                @endif
            @endfor
            <div class="d-flex flex-row py-2 px-3 rounded justify-content-between mb-2 btn-tp">
                <div class="">Kuis#1</div>
            </div>
            <div class="d-flex flex-row py-2 px-3 rounded justify-content-between mb-2 btn-tp">
                <div class="">Kuis#2</div>
            </div>
            <div class="d-flex flex-row py-2 px-3 rounded justify-content-between mb-2 btn-tp">
                <div class="">Tugas Besar</div>
            </div>
            <div class="d-flex flex-row py-2 px-3 rounded justify-content-between mb-2 btn-tp">
                <div class="">UTS</div>
            </div>
            <div class="d-flex flex-row py-2 px-3 rounded justify-content-between mb-2 btn-tp">
                <div class="">UAS</div>
            </div>
        </div>
        <div id="spreadsheet"></div>
        <div class="ms-4 overflow-auto" style="width: 70%;height: 100vh;">
            <div class="d-flex flex-column">
                <div class="d-flex flex-column mb-4">
                    <div class="fw-bold mb-2">Centang tujuan pembelajaran yang relevan dengan rencana asesmen ini</div>
                    @for ($i = 1; $i <= 10; $i++)
                        <div class="d-flex flex-row mb-4 align-items-start">
                            <input type="checkbox" style="margin-top: 6px">
                            <div class="d-flex flex-column ms-2">
                                <div class="fw-bold">TP-{{ $i }}</div>
                                <div class="">Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt quasi
                                    autem
                                    unde
                                    cum impedit quas ab aspernatur ea illo eum!</div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    @endsection

    @push('scripts')
    @endpush
