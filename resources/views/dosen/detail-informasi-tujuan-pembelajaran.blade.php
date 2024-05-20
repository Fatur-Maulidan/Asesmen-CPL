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
    <div class="modal fade" id="ubah-tujuan-pembelajaran" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Buat Tujuan Pembelajaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="width: 100%">
                    <div class="d-flex flex-column">
                        <div class="d-flex flex-column mb-4">
                            <div class="fw-bold mb-2">Deskripsi</div>
                            <textarea class="form-control" rows="3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt quasi autem unde cum impedit quas ab aspernatur ea illo eum!</textarea>
                        </div>
                        <div class="d-flex flex-column mb-4">
                            <div class="fw-bold mb-2">Indikator Kinerja Induk</div>
                            <select class="form-select">
                                @for ($i = 1; $i <= 5; $i++)
                                    <option>SS-1.{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="d-flex flex-column mb-4">
                            <div class="fw-bold mb-2">Rentang bobot berdasarkan IK induk</div>
                            <div class="">1 Sampai 3</div>
                        </div>
                        <div class="d-flex flex-column">
                            <div class="fw-bold mb-2">Bobot</div>
                            <select class="form-select">
                                @for ($i = 1; $i <= 5; $i++)
                                    <option>{{ $i }}</option>
                                @endfor
                            </select>
                            <div class="">Pilih bobot berdasarkan rentang bobot yang tersedia pada IK induk</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="d-flex flex-row" style="width: 100%">
                        <button type="button" class="btn btn-danger me-2" style="width: 50%"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-success" style="width: 50%">Ajukan Persetujuan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-row justify-content-center">
        <div class="d-flex flex-column pt-3 px-4 border border-1 rounded" style="width: 30%; height:100vh;">
            @for ($i = 1; $i <= 4; $i++)
                @if ($i == 1)
                    <div class="d-flex flex-row py-2 px-3 rounded border border-1 justify-content-between mb-2 btn-tp">
                        <div class="">TP-{{ $i }}</div>
                        <div class="badge text-bg-success">Disetujui</div>
                    </div>
                @else
                    <div class="d-flex flex-row py-2 px-3 rounded justify-content-between mb-2 btn-tp">
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
                <div class="d-flex flex-row mb-4 justify-content-between">
                    <div class="d-flex flex-row">
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
                    <div class="d-flex flex-row">
                        <button class="btn btn-danger me-2 px-4">Hapus</button>
                        <button class="btn btn-warning px-4" data-bs-toggle="modal"
                            data-bs-target="#ubah-tujuan-pembelajaran">Ubah</button>
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
        <script>
            ($document).ready(function() {

            });
        </script>
    @endpush
