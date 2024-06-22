@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render() }}
    <h1 class="fw-bold mb-0">{{ $title }}</h1>
@endsection

@section('main')
    <div class="d-flex flex-column">
        <div class="d-flex flex-row w-50">
            <div class="d-flex flex-column">
                <div class="fw-bold">Jurusan</div>
                <select class="form-select" required>
                    <option value="" disabled selected hidden>Pilih Jurusan</option>
                    <option value="0">Teknik Komputer dan Informatika</option>
                    <option value="1">Teknik Refrigerasi dan Tata Udara</option>
                </select>
            </div>

            <div class="d-flex flex-column ms-3">
                <div class="fw-bold">Program Studi</div>
                <select class="form-select" required>
                    <option value="" disabled selected hidden>Pilih Program Studi</option>
                    <option value="0">D3 - Teknik Informatika</option>
                    <option value="1">D4 - Teknik Informatika</option>
                </select>
            </div>

            <div class="d-flex flex-column ms-3">
                <div class="fw-bold">Kurikulum</div>
                <select class="form-select" required>
                    <option value="" disabled selected hidden>Pilih Kurikulum</option>
                    <option value="0">2021</option>
                    <option value="1">2022</option>
                </select>
            </div>
        </div>

        <div class="d-flex flex-row mt-3">
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
        </div>

        <div class="row align-items-center">
            <div class="col-md-6">
                <img class="img-fluid" src="{{ asset('images/graph.png') }}" alt="Graph">
            </div>
            <div class="col-md-6 overflow-auto" style="max-height: 400px;">
                @for ($i = 1; $i <= 10; $i++)
                    <div class="mb-3">
                        <div class="fw-bold">SS-{{ $i }}</div>
                        <div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita sed reprehenderit at quasi
                            dolorem ratione maiores unde nihil accusantium! Laborum!</div>
                    </div>
                @endfor
            </div>
        </div>

        {{-- End Graph --}}

        {{-- Rowspan and Colspan --}}
        {{-- <table class="table">

        </table> --}}

        <hr>
        </hr>
        <div class="row">
            <div class="col d-flex align-items-center">
                <div class="">Indikator Kinerja</div>
            </div>
            <div class="col">
                <div class="text-center">Rubrik</div>
                <hr>
                </hr>
                <div class="d-flex flex-row justify-content-around">
                    <div class="d-flex flex-column">
                        <div class="">Kurang Sekali</div>
                        <div class=""> {{ '(<50)' }} </div>
                    </div>
                    <div class="d-flex flex-column">
                        <div class="">Kurang</div>
                        <div class=""> {{ '(51-62)' }} </div>
                    </div>
                    <div class="d-flex flex-column">
                        <div class="">Cukup</div>
                        <div class=""> {{ '(63-75)' }} </div>
                    </div>
                    <div class="d-flex flex-column">
                        <div class="">Baik</div>
                        <div class=""> {{ '(76-84)' }} </div>
                    </div>
                    <div class="d-flex flex-column">
                        <div class="">Baik Sekali</div>
                        <div class=""> {{ '(>85)' }} </div>
                    </div>
                </div>
            </div>
            <hr>
            </hr>
        </div>
        @for ($i = 1; $i <= 10; $i++)
            <div class="row">
                <div class="col d-flex align-items-center my-2">
                    <div class="row">
                        <div class="fw-bold">IK-{{ $i }}</div>
                        <div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat perspiciatis nam illo</div>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex flex-row justify-content-around">
                        <div class="d-flex flex-column">
                            <div>12</div>
                        </div>
                        <div class="d-flex flex-column">
                            <div>23</div>
                        </div>
                        <div class="d-flex flex-column">
                            <div>50</div>
                        </div>
                        <div class="d-flex flex-column">
                            <div>20</div>
                        </div>
                        <div class="d-flex flex-column text-center">
                            <div>19</div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            </hr>
        @endfor
    </div>
@endsection
