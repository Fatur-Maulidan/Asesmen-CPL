@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.jurusan.index') }}
    <h1 class="fw-bold mb-0">{{ $title }}</h1>
@endsection

@section('main')
    {{-- Action buttons --}}
    <div class="row mb-4">
        <div class="col">
            <form role="search" method="GET" action="">
                <input class="form-control search" type="search" id="search" name="search" placeholder="Cari"
                    autocomplete="off" value="{{ request('search') }}">
            </form>
        </div>
        <div class="col text-end">
            {{-- Button trigger modal --}}
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importJurusanModal">
                Import Jurusan
            </button>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahJurusanModal">
                Tambah Jurusan Baru
            </button>
        </div>
    </div>

    {{-- Filter buttons --}}
    <div class="row mb-4">
        <div class="col-auto">
            <input type="radio" class="btn-check" name="golongan" id="filter_semua" value="semua"
                @if (!request('filter')) checked @endif>
            <label class="btn btn-outline-primary rounded-pill px-3" for="filter_semua">Semua</label>

            <input type="radio" class="btn-check" name="golongan" id="filter_rekayasa"
                value="{{ \App\Enums\JurusanGolongan::Rekayasa }}" @if (request('filter') == 'rekayasa') checked @endif>
            <label class="btn btn-outline-primary rounded-pill px-3" for="filter_rekayasa">Rekayasa</label>

            <input type="radio" class="btn-check" name="golongan" id="filter_nonrekayasa"
                value="{{ \App\Enums\JurusanGolongan::Nonrekayasa }}" @if (request('filter') == 'non-rekayasa') checked @endif>
            <label class="btn btn-outline-primary rounded-pill px-3" for="filter_nonrekayasa">Nonrekayasa</label>
        </div>
    </div>

    {{-- Import Jurusan Modal --}}
    <div class="modal fade" id="importJurusanModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="importJurusanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="importJurusanModalLabel">Import Jurusan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.jurusan.import') }}" method="POST" autocomplete="off"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-5">
                            <label for="formFile" class="form-label fw-bold">Upload File Excel</label>
                            <input class="form-control" type="file" id="formFile" name="formFile" accept=".xlsx">
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.jurusan.downloadTemplate') }}" class="btn btn-outline-success">Download
                                Template</a>
                            <button class="btn btn-success" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Tambah Jurusan Modal --}}
    <div class="modal fade" id="tambahJurusanModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="tambahJurusanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="tambahJurusanModalLabel">Tambah Jurusan Baru</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.jurusan.store') }}" method="POST" autocomplete="off"
                        id="tambahJurusanForm">
                        @csrf
                        <div class="mb-4">
                            <label for="nama_jurusan" class="form-label fw-bold">Nama</label>
                            <input type="text" class="form-control" id="nama_jurusan" name="nama_jurusan"
                                placeholder="Nama Jurusan">
                            <div id="nama_jurusan_feedback" class="text-danger"></div>
                        </div>

                        <div class="mb-4">
                            <div class="fw-bold mb-2">Golongan</div>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="golongan_jurusan"
                                        id="rekayasa" value="{{ \App\Enums\JurusanGolongan::Rekayasa }}">
                                    <label class="form-check-label" for="rekayasa">Rekayasa</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="golongan_jurusan"
                                        id="nonrekayasa" value="{{ \App\Enums\JurusanGolongan::Nonrekayasa }}">
                                    <label class="form-check-label" for="nonrekayasa">Non Rekayasa</label>
                                </div>
                            </div>
                            <div id="golongan_jurusan_feedback" class="text-danger"></div>
                        </div>

                        {{-- <div>
                            <label for="domain" class="form-label fw-bold">Ketua Jurusan</label>
                            <select class="form-select" id="domain">
                                <option selected>Pilih dosen</option>
                                <option value="1">Yadi Adithia</option>
                                <option value="2">Alex Yassensdra</option>
                            </select>
                        </div> --}}
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col">
                            <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Batal</button>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-success w-100" form="tambahJurusanForm"
                                id="btn-add">Tambah</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Ubah Jurusan Modal --}}
    <div class="modal fade" id="ubahJurusanModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="ubahJurusanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="ubahJurusanModalLabel">Ubah Jurusan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" autocomplete="off" id="ubahJurusanForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="id_jurusan">
                        <div class="mb-4">
                            <label for="nama_jurusan_ubah" class="form-label fw-bold">Nama</label>
                            <input type="text" class="form-control" id="nama_jurusan_ubah" name="nama_jurusan"
                                placeholder="Nama Jurusan">
                            <div id="nama_jurusan_feedback_ubah" class="text-danger"></div>
                        </div>

                        <div class="mb-4">
                            <div class="fw-bold mb-2">Golongan</div>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="golongan_jurusan"
                                        id="rekayasa_ubah" value="{{ \App\Enums\JurusanGolongan::Rekayasa }}">
                                    <label class="form-check-label" for="rekayasa_ubah">Rekayasa</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="golongan_jurusan"
                                        id="nonrekayasa_ubah" value="{{ \App\Enums\JurusanGolongan::Nonrekayasa }}">
                                    <label class="form-check-label" for="nonrekayasa_ubah">Non Rekayasa</label>
                                </div>
                            </div>
                            <div id="golongan_jurusan_feedback_ubah" class="text-danger"></div>
                        </div>

                        {{-- <div>
                            <label for="domain" class="form-label fw-bold">Ketua Jurusan</label>
                            <select class="form-select" id="domain">
                                <option selected>Pilih dosen</option>
                                <option value="1">Yadi Adithia</option>
                                <option value="2">Alex Yassensdra</option>
                            </select>
                        </div> --}}
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col">
                            <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Batal</button>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-success w-100" form="ubahJurusanForm"
                                id="submit-edit">Ubah</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tambah Program Studi Modal --}}
    <div class="modal fade" id="tambahProgramStudiModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="tambahProgramStudiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="tambahProgramStudiModalLabel">Tambah Program Studi Baru</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.program-studi.store') }}" method="POST" autocomplete="off"
                        id="tambahProgramStudiForm">
                        @csrf
                        <input type="hidden" name="jurusan_id" id="id_jurusan_prodi">
                        <div class="mb-4">
                            <label for="nama_prodi" class="form-label fw-bold">Nama</label>
                            <input type="text" class="form-control" id="nama_prodi" name="nama_prodi"
                                placeholder="Nama program studi">
                            <div id="nama_prodi_feedback" class="text-danger"></div>
                        </div>

                        <div class="mb-4">
                            <label for="jenjang_prodi" class="form-label fw-bold">Jenjang pendidikan</label>
                            <select class="form-select" id="jenjang_prodi" name="jenjang_prodi">
                                <option value="" selected>Pilih jenjang pendidikan program studi</option>
                                <option value="D3">D3</option>
                                <option value="D4">D4</option>
                                <option value="S2">S2</option>
                            </select>
                            <div id="jenjang_prodi_feedback" class="text-danger"></div>
                        </div>

                        <div class="mb-4">
                            <label for="nomor_prodi" class="form-label fw-bold">Nomor</label>
                            <input type="text" class="form-control" id="nomor_prodi" name="nomor_prodi"
                                placeholder="Nomor program studi">
                            <div id="nomor_prodi_feedback" class="text-danger"></div>
                        </div>

                        <div class="mb-4">
                            <label for="kode_prodi" class="form-label fw-bold">Kode</label>
                            <input type="text" class="form-control" id="kode_prodi" name="kode_prodi"
                                placeholder="Kode program studi">
                            <div id="kode_prodi_feedback" class="text-danger"></div>
                        </div>

                        <div>
                            <label for="koordinator_prodi" class="form-label fw-bold">Koordinator program studi</label>
                            <select class="form-select" id="koordinator_prodi" name="koordinator_prodi">
                                <option value="" selected>Pilih dosen</option>
                                @foreach ($dosen as $dsn)
                                    <option value="{{ $dsn->nip }}">{{ $dsn->kode . ' - ' . $dsn->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <div id="koordinator_prodi_feedback" class="text-danger"></div>
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
                                form="tambahProgramStudiForm">Tambah</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Data jurusan --}}
    <div class="row gy-5">
        @forelse ($jurusan as $jrsn)
            <div class="col-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="d-inline">
                            <span class="fs-5 fw-bold me-2">{{ $jrsn->nama }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="fw-bold">Golongan jurusan</div>
                            <div>{{ $jrsn->golongan }}</div>
                        </div>

                        {{-- <div class="mb-3">
                            <div class="fw-bold">Ketua Jurusan</div>
                            <div>Yadi Adithia</div>
                        </div> --}}

                        <div>
                            <div class="fw-bold">Program studi terdaftar</div>
                            <ul class="mb-0">
                                @forelse ($jrsn->programStudi as $prodi)
                                    <li>{{ $prodi->jenjang_pendidikan . ' ' . $prodi->nama }}</li>
                                @empty
                                    <li>Tidak ada data.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                    {{-- Program studi --}}
                    @if ($jrsn->programStudi->isEmpty())
                        <div class="alert alert-light mb-0 rounded-0" role="alert">
                            Tidak ada program studi.
                        </div>
                    @else
                        <div class="accordion" id="daftarProdi">
                            @foreach ($jrsn->programStudi as $prodi)
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button bg-light fw-bold" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#prodi{{ $loop->iteration }}"
                                            aria-expanded="true" aria-controls="prodi{{ $loop->iteration }}">
                                            {{ $prodi->jenjang_pendidikan . ' ' . $prodi->nama }}
                                        </button>
                                    </h2>
                                    <div id="prodi{{ $loop->iteration }}" class="accordion-collapse collapse"
                                        data-bs-parent="#daftarProdi">
                                        <div class="accordion-body">
                                            <div class="mb-3">
                                                <div class="fw-bold">Nomor program studi</div>
                                                <div>{{ $prodi->nomor }}</div>
                                            </div>

                                            <div class="mb-3">
                                                <div class="fw-bold">Kode program studi</div>
                                                <div>{{ $prodi->kode }}</div>
                                            </div>

                                            <div class="mb-3">
                                                <div class="fw-bold">Koordinator program studi</div>
                                                <div>{{ $prodi->dosen->nama }}</div>
                                            </div>

                                            {{-- <div>
                                                <div class="fw-bold">Koordinator program studi</div>
                                                <ul class="mb-0">
                                                    <li>Kurikulum 2019</li>
                                                    <li>Kurikulum 2020</li>
                                                    <li>Kurikulum 2021</li>
                                                </ul>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <div class="card-body text-body-secondary">
                        <a href="#" class="btn-edit" class="me-2" data-bs-toggle="modal"
                            data-bs-target="#ubahJurusanModal" data-id="{{ $jrsn->id }}"
                            data-nama="{{ $jrsn->nama }}" data-golongan="{{ $jrsn->golongan }}">Ubah</a>
                        <a href="#" class="btn-add-prodi" data-bs-toggle="modal"
                            data-bs-target="#tambahProgramStudiModal" data-id="{{ $jrsn->id }}">Tambah Program
                            Studi</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-secondary" role="alert">
                    Tidak ada data.
                </div>
            </div>
        @endforelse
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            const url = "{{ url()->current() }}";
            const tambahJurusanModal = document.getElementById('tambahJurusanModal');
            const ubahJurusanModal = document.getElementById('ubahJurusanModal');
            const tambahProgramStudiModal = document.getElementById('tambahProgramStudiModal');

            const tambahJurusanModalInstance = new bootstrap.Modal('#tambahJurusanModal');
            const ubahJurusanModalInstance = new bootstrap.Modal('#ubahJurusanModal');
            const tambahProgramStudiModalInstance = new bootstrap.Modal('#tambahProgramStudiModal');
            const buttonLoading = `
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>`;

            $('input[type=radio][name=golongan]').on('click', function() {
                switch ($(this).val()) {
                    case 'semua':
                        location.href = url;
                        break;
                    case 'Rekayasa':
                        location.href = url + '?filter=rekayasa'
                        break;
                    case 'Nonrekayasa':
                        location.href = url + '?filter=non-rekayasa'
                        break;
                }
            });

            tambahJurusanModal.addEventListener('hidden.bs.modal', event => {
                $('#nama_jurusan').val('');
                $('#rekayasa').prop('checked', false);
                $('#nonrekayasa').prop('checked', false);

                $('#nama_jurusan_feedback').html('');
                $('#golongan_jurusan_feedback').html('');
            });

            ubahJurusanModal.addEventListener('hidden.bs.modal', event => {
                $('#nama_jurusan_ubah').val('');
                $('#rekayasa_ubah').prop('checked', false);
                $('#nonrekayasa_ubah').prop('checked', false);

                $('#nama_jurusan_feedback_ubah').html('');
                $('#golongan_jurusan_feedback_ubah').html('');
            });

            tambahProgramStudiModal.addEventListener('hidden.bs.modal', event => {
                $('#nama_prodi').val('');
                $('#jenjang_prodi').prop('selectedIndex', 0);
                $('#nomor_prodi').val('');
                $('#kode_prodi').val('');
                $('#koordinator_prodi').prop('selectedIndex', 0);

                $('#nama_prodi_feedback').html('');
                $('#jenjang_prodi_feedback').html('');
                $('#nomor_prodi_feedback').html('');
                $('#kode_prodi_feedback').html('');
                $('#koordinator_prodi_feedback').html('');
            });

            $('#tambahJurusanForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: "post",
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: "JSON",
                    success: function(res) {
                        console.log(res)
                        tambahJurusanModalInstance.hide();
                        location.reload();
                    },
                    error: function(err) {
                        // when status code is 422, it's a validation issue
                        if (err.status == 422) {
                            console.log(err.responseJSON);
                            $('#nama_jurusan_feedback').html(err.responseJSON.errors
                                .nama_jurusan[0])

                            $('#golongan_jurusan_feedback').html(err.responseJSON.errors
                                .golongan_jurusan[0])
                        }
                    }
                });
            });

            $('.btn-edit').on('click', function(e) {
                const id = $(this).data('id');
                const nama = $(this).data('nama');
                const golongan = $(this).data('golongan');

                $('#id_jurusan').val(id);
                $('#nama_jurusan_ubah').val(nama);
                if (golongan == 'Rekayasa') {
                    $('#rekayasa_ubah').prop('checked', true);
                } else {
                    $('#nonrekayasa_ubah').prop('checked', true);
                }
            });

            $('#ubahJurusanForm').on('submit', function(e) {
                e.preventDefault();
                $('#submit-edit').html(buttonLoading);

                const id = $('#id_jurusan').val();

                $.ajax({
                    type: "put",
                    url: url + "/" + id,
                    data: $(this).serialize(),
                    dataType: "JSON",
                    success: function(res) {
                        console.log(res);
                        $('#submit-edit').html('Ubah');
                        ubahJurusanModalInstance.hide();
                        location.reload();
                    },
                    error: function(err) {
                        $('#submit-edit').html('Ubah');
                        // when status code is 422, it's a validation issue
                        if (err.status == 422) {
                            console.log(err.responseJSON);
                            $('#nama_jurusan_feedback_ubah').html(err.responseJSON.errors
                                .nama_jurusan[0])

                            $('#golongan_jurusan_feedback_ubah').html(err.responseJSON.errors
                                .golongan_jurusan[0])
                        }
                    }
                });
            });

            $('.btn-add-prodi').on('click', function(e) {
                const id = $(this).data('id');
                $('#id_jurusan_prodi').val(id);
            });

            $('#tambahProgramStudiForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: "post",
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: "JSON",
                    success: function(res) {
                        console.log(res);
                        tambahProgramStudiModalInstance.hide();
                        location.reload();
                    },
                    error: function(err) {
                        // when status code is 422, it's a validation issue
                        if (err.status == 422) {
                            console.log(err.responseJSON);
                            $('#nama_prodi_feedback').html(err.responseJSON.errors.nama_prodi[
                                0]);

                            $('#jenjang_prodi_feedback').html(err.responseJSON.errors
                                .jenjang_prodi[0]);

                            $('#nomor_prodi_feedback').html(err.responseJSON.errors.nomor_prodi[
                                0]);

                            $('#kode_prodi_feedback').html(err.responseJSON.errors.kode_prodi[
                                0]);

                            $('#koordinator_prodi_feedback').html(err.responseJSON.errors
                                .koordinator_prodi[0]);
                        } else if (err.status == 500) {
                            console.log(err);
                        }
                    }
                });
            });
        });
    </script>
@endpush
