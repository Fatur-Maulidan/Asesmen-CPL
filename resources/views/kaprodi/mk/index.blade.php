@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('kaprodi.mata-kuliah.index', $kurikulum->tahun) }}
    <h1 class="fw-bold mb-4">{{ $title }}</h1>
@endsection

@section('main')
    {{-- Buttons --}}
    <div class="row mb-5">
        <div class="col text-end">
            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                    data-bs-target="#importMataKuliahModal">
                Import Mata Kuliah
            </button>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#tambahMataKuliahModal">
                Tambah Mata Kuliah
            </button>
        </div>
    </div>

    {{-- Import Mata Kuliah Modal --}}
    <div class="modal fade" id="importMataKuliahModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="importMataKuliahModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="importMataKuliahModalLabel">Import Mata Kuliah</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('kaprodi.mata-kuliah.import', ['kurikulum' => $kurikulum->tahun]) }}" method="POST"
                          autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-5">
                            <label for="formFile" class="form-label fw-bold">Upload File Excel</label>
                            <input class="form-control" type="file" id="formFile" name="formFile" accept=".xlsx">
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('kaprodi.mata-kuliah.downloadTemplate', ['kurikulum' => $kurikulum]) }}"
                               class="btn btn-outline-success">Download
                                Template</a>
                            <button class="btn btn-success" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Tambah Mata Kuliah Modal --}}
    <div class="modal fade" id="tambahMataKuliahModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="tambahMataKuliahModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="tambahMataKuliahModalLabel">Tambah Mata Kuliah</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('kaprodi.mata-kuliah.store', ['kurikulum' => $kurikulum->tahun]) }}" method="post"
                          autocomplete="off" id="tambahMataKuliahForm">
                        @csrf
                        <div class="mb-3">
                            <label for="kode" class="form-label fw-bold">Kode</label>
                            <input type="text" class="form-control" id="kode" name="kode"
                                   placeholder="Kode mata kuliah">
                            <div id="kode_feedback" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label fw-bold">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                   placeholder="Nama mata kuliah">
                            <div id="nama_feedback" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="6"></textarea>
                            <div id="deskripsi_feedback" class="text-danger"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col">
                            <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Batal</button>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-success w-100"
                                    form="tambahMataKuliahForm">Tambah
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Data Mata Kuliah --}}
    <div class="row">
        <div class="col-12">
            <div class="accordion" id="daftarMataKuliah">
                @forelse($mata_kuliah as $mk)
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#accordion{{ $loop->iteration }}" aria-expanded="false"
                                    aria-controls="{{ $loop->iteration }}">
                                {{ $mk->kode . ' ' . $mk->nama }}
                            </button>
                        </h2>
                        <div id="accordion{{ $loop->iteration }}" class="accordion-collapse collapse"
                             data-bs-parent="#daftarMataKuliah">
                            <div class="accordion-body">
                                <p class="fw-bold mb-1">Deskripsi</p>
                                <p class="mb-4">{{ $mk->deskripsi }}</p>

                                <p class="fw-bold mb-1">Capaian Pembelajaran</p>
                                <p class="mb-4">Belum ada pemetaan</p>

                                <p class="fw-bold mb-1">Indikator Kinerja</p>
                                <p class="mb-0">Belum ada pemetaan</p>
                            </div>
                            <div class="accordion-footer bg-light mb-0 p-3 border-top ">
                                <a href="{{ route('kaprodi.mata-kuliah.show', ['kurikulum' => $kurikulum->tahun, 'mata_kuliah' => $mk->kode]) }}"
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

@push('scripts')
    <script>
        $(document).ready(function () {
            const tambahMataKuliahModal = document.getElementById('tambahMataKuliahModal');
            const tambahMataKuliahModalInstance = new bootstrap.Modal('#tambahMataKuliahModal');

            tambahMataKuliahModal.addEventListener('hidden.bs.modal', event => {
                $('#kode').val('');
                $('#nama').val('');
                $('#deskripsi').html('');
                $('#jumlah_sks').val('');

                $('#kode_feedback').html('');
                $('#nama_feedback').html('');
                $('#deskripsi_feedback').html('');
                $('#jumlah_sks_feedback').html('');
            });

            $('#tambahMataKuliahForm').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    type: "post",
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: "JSON",
                    success: function (res) {
                        console.log(res)
                        tambahMataKuliahModalInstance.hide();
                        location.reload();
                    },
                    error: function (err) {
                        // when status code is 422, it's a validation issue
                        if (err.status == 422) {
                            console.log(err.responseJSON);

                            if ('kode' in err.responseJSON.errors) {
                                $('#kode_feedback').html(err.responseJSON.errors
                                    .kode[0]);
                            } else {
                                $('#kode_feedback').html('');
                            }

                            if ('nama' in err.responseJSON.errors) {
                                $('#nama_feedback').html(err.responseJSON.errors
                                    .nama[0]);
                            } else {
                                $('#nama_feedback').html('');
                            }

                            if ('deskripsi' in err.responseJSON.errors) {
                                $('#deskripsi_feedback').html(err.responseJSON.errors
                                    .deskripsi[0]);
                            } else {
                                $('#deskripsi_feedback').html('');
                            }

                            if ('jumlah_sks' in err.responseJSON.errors) {
                                $('#jumlah_sks_feedback').html(err.responseJSON.errors
                                    .jumlah_sks[0]);
                            } else {
                                $('#jumlah_sks_feedback').html('');
                            }
                        } else if (err.status == 500) {
                            console.log(err);
                        }
                    }
                });
            });
        });
    </script>
@endpush
