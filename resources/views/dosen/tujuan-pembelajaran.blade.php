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
    <div class="d-flex justify-content-end mb-4">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah-tujuan-pembelajaran">
            Tambah Tujuan Pembelajaran
        </button>
    </div>
    <div class="modal fade" id="tambah-tujuan-pembelajaran" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Buat Tujuan Pembelajaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="width: 100%">
                    <div class="d-flex flex-row">
                        <div class="d-flex flex-column">
                            <div class="d-flex flex-column mb-2">
                                <label for="exampleFormControlInput1" class="form-label fw-bold">Deskripsi</label>
                                <textarea class="form-control" id="exampleFormControlInput1" rows="3"></textarea>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <div class="fw-bold">Rentang bobot berdasarkan IK induk</div>
                                <div class="">Pilih terlebih Indikator Kinerja induk terlebih dahulu</div>
                            </div>
                            <div class="d-flex flex-column ">
                                <div class="fw-bold">Bobot</div>
                                <select class="form-select">
                                    <option value="" disabled selected>Pilih Bobot</option>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="d-flex flex-column ms-4" style="width: 50%">
                            <div class="card">
                                <h5 class="card-header">Sudah ada pemetaan dengan TP</h5>
                                <div class="card-body py-4 px-4 overflow-auto" style="height: 350px">
                                    @for ($i = 1; $i <= 3; $i++)
                                        <div class="d-flex flex-column mb-4">
                                            <div class="d-flex flex-column">
                                                <div class="d-flex flex-row">
                                                    <input type="checkbox">
                                                    <div class="fw-bold" style="margin-left: 10px">SS-{{ $i }}
                                                    </div>
                                                </div>
                                                <div class="ms-4">
                                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi sunt
                                                    repellat culpa sit saepe a rerum quibusdam nobis, in velit.
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success">Tambah</button>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            @for ($i = 1; $i <= 4; $i++)
                <div class="accordion-item">
                    <h2 class="accordion-header d-flex flex-row" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapse{{ $i }}" aria-expanded="false"
                            aria-controls="flush-collapse{{ $i }}">
                            {{ 'TP-' . $i }}
                            @if ($i == 1 || $i == 2)
                                <div class="badge text-bg-success ms-3">Disetujui</div>
                            @elseif($i == 3)
                                <div class="badge text-bg-warning ms-3">Menunggu Validasi</div>
                            @else
                                <div class="badge text-bg-danger ms-3">Ditolak</div>
                            @endif
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
                                <div class="fw-bold">Indikator Kinerja</div>
                                <ul>
                                    @for ($j = 1; $j <= 3; $j++)
                                        <li>{{ 'SS-1.' . $j }}</li>
                                    @endfor
                                </ul>
                            </div>
                        </div>
                        <div class="d-flex flex-column justify-content-center px-3 rounded-sm border border-1"
                            style="height:60px">
                            <a href="{{ route('mata-kuliah.tujuan-pembelajaran.detail-informasi') }}">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
@endsection

@push('scripts')
@endpush
