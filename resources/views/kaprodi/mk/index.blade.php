@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('kaprodi.mata-kuliah.index', $kurikulum) }}
    <h1 class="fw-bold mb-0">{{ $title }}</h1>
@endsection

@section('main')
    <div class="row mb-5">
        <div class="col text-end">
            {{-- Buttons --}}
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importMataKuliahModal">
                Import Mata Kuliah
            </button>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Tambah Mata Kuliah
            </button>
        </div>
    </div>

    {{-- Import Program Studi Modal --}}
    <div class="modal fade" id="importMataKuliahModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="importMataKuliahModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="importMataKuliahModalLabel">Import Mata Kuliah</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('kaprodi.mata-kuliah.import', ['kurikulum' => $kurikulum]) }}" method="POST" autocomplete="off"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="mb-5">
                            <label for="formFile" class="form-label fw-bold">Upload File Excel</label>
                            <input class="form-control" type="file" id="formFile" name="formFile" accept=".xlsx">
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('kaprodi.mata-kuliah.downloadTemplate', ['kurikulum' => $kurikulum]) }}" class="btn btn-outline-success">Download
                                Template</a>
                            <button class="btn btn-success" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">Tambah Mata Kuliah</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label fw-bold">Nama</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                placeholder="Nama mata kuliah">
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput2" class="form-label fw-bold">Kode</label>
                            <input type="text" class="form-control" id="exampleFormControlInput2"
                                placeholder="Kode mata kuliah">
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label fw-bold">Deskripsi</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput3" class="form-label fw-bold">Jumlah SKS</label>
                            <input type="number" class="form-control" id="exampleFormControlInput3"
                                placeholder="Jumlah SKS mata kuliah">
                        </div>

                        <div class="mb-3">
                            <label for="domain" class="form-label fw-bold">Sifat Pengambilan</label>
                            <select class="form-select" id="domain">
                                <option selected>Pilih sifat pegambilan</option>
                                <option value="1">Sikap (S)</option>
                                <option value="2">Pengetahuan (P)</option>
                                <option value="3">Keterampilan Umum (KU)</option>
                                <option value="4">Keterampilan Khusus (KK)</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="domain" class="form-label fw-bold">Metode Pembelajaran</label>
                            <select class="form-select" id="domain">
                                <option selected>Pilih sifat pegambilan</option>
                                <option value="1">Sikap (S)</option>
                                <option value="2">Pengetahuan (P)</option>
                                <option value="3">Keterampilan Umum (KU)</option>
                                <option value="4">Keterampilan Khusus (KK)</option>
                            </select>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col">
                            <button type="button" class="btn btn-danger w-100">Batal</button>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-success w-100">Tambah</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Data CPL --}}
    <div class="row">
        <div class="col-12">
            <div class="accordion" id="daftarMataKuliah">
                @forelse($mata_kuliah as $mk)
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#accordion{{ $loop->iteration }}" aria-expanded="true" aria-controls="{{ $loop->iteration }}">
                                {{ $mk->kode . ' ' . $mk->nama }}
                            </button>
                        </h2>
                        <div id="accordion{{ $loop->iteration }}" class="accordion-collapse collapse" data-bs-parent="#daftarMataKuliah">
                            <div class="accordion-body">
                                <p class="fw-bold mb-1">Deskripsi</p>
                                <p class="mb-4">{{ $mk->deskripsi }}</p>

                                <p class="fw-bold mb-1">Capaian Pembelajaran</p>
                                <p class="mb-4">Belum ada pemetaan</p>

                                <p class="fw-bold mb-1">Indikator Kinerja</p>
                                <p class="mb-0">Belum ada pemetaan</p>
                            </div>
                            <div class="accordion-footer bg-light mb-0 p-3 border-top ">
                                <a href="{{ route('kaprodi.mata-kuliah.show', ['kurikulum' => $kurikulum, 'mata_kuliah' => '1']) }}"
                                   class="me-3">Lihat detail</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-secondary" role="alert">
                        Tidak ada data.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
