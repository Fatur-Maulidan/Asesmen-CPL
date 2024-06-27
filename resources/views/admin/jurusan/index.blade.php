@extends('layouts.main')

@section('breadcrumb')
    <h1 class="fw-bold mb-4">{{ $title }}</h1>
    {{ Breadcrumbs::render('admin.jurusan.index') }}
@endsection

@section('main')
    {{--  Alert message  --}}
    @if (session('message'))
        <div class="alert alert-secondary mb-5" role="alert">
            {{ session('message') }}
        </div>
    @endif

    {{-- Action buttons --}}
    <div class="row mb-4">
        <div class="col">
            <form role="search" method="GET" action="" autocomplete="off">
                <input class="form-control search" type="search" id="search" name="search" placeholder="Cari"
                    value="{{ request('search') }}">
            </form>
        </div>
        <div class="col text-end">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importProgramStudiModal">
                Import Program Studi
            </button>
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

    {{-- Import Program Studi Modal --}}
    <div class="modal fade" id="importProgramStudiModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="importProgramStudiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="importProgramStudiModalLabel">Import Program Studi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.program-studi.import') }}" method="POST" autocomplete="off"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-5">
                            <label for="formFileProgramStudi" class="form-label fw-bold">Upload File Excel</label>
                            <input class="form-control" type="file" id="formFileProgramStudi" name="formFileProgramStudi"
                                accept=".xlsx">
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.program-studi.downloadTemplate') }}"
                                class="btn btn-outline-success">Download
                                Template</a>
                            <button class="btn btn-success" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
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
                            <label for="formFileJurusan" class="form-label fw-bold">Upload File Excel</label>
                            <input class="form-control" type="file" id="formFileJurusan" name="formFileJurusan"
                                accept=".xlsx">
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.jurusan.downloadTemplate') }}"
                                class="btn btn-outline-success">Download
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
                            <label for="nomor_jurusan" class="form-label fw-bold">Nomor</label>
                            <input type="text" class="form-control" id="nomor_jurusan" name="nomor"
                                placeholder="Nomor Jurusan">
                            <div id="nomor_jurusan_feedback" class="text-danger"></div>
                        </div>

                        <div class="mb-4">
                            <label for="nama_jurusan" class="form-label fw-bold">Nama</label>
                            <input type="text" class="form-control" id="nama_jurusan" name="nama"
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
                            <button type="submit" class="btn btn-success w-100" form="#tambahJurusanForm"
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
                        <input type="hidden" name="nomor_old" id="nomor_jurusan_old">
                        <div class="mb-4">
                            <label for="nomor_jurusan_ubah" class="form-label fw-bold">Nomor</label>
                            <input type="text" class="form-control" id="nomor_jurusan_ubah" name="nomor"
                                placeholder="Nomor Jurusan">
                            <div id="nomor_jurusan_feedback_ubah" class="text-danger"></div>
                        </div>

                        <div class="mb-4">
                            <label for="nama_jurusan_ubah" class="form-label fw-bold">Nama</label>
                            <input type="text" class="form-control" id="nama_jurusan_ubah" name="nama"
                                placeholder="Nama Jurusan">
                            <div id="nama_jurusan_feedback_ubah" class="text-danger"></div>
                        </div>

                        <div class="mb-4">
                            <div class="fw-bold mb-2">Golongan</div>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="golongan" id="rekayasa_ubah"
                                        value="{{ \App\Enums\JurusanGolongan::Rekayasa }}">
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
                        <input type="hidden" name="jurusan_nomor" id="nomor_jurusan_prodi">

                        <div class="mb-4">
                            <label for="nomor_prodi" class="form-label fw-bold">Nomor</label>
                            <input type="text" class="form-control" id="nomor_prodi" name="nomor"
                                placeholder="Nomor program studi">
                            <div id="nomor_prodi_feedback" class="text-danger"></div>
                        </div>

                        <div class="mb-4">
                            <label for="nama_prodi" class="form-label fw-bold">Nama</label>
                            <input type="text" class="form-control" id="nama_prodi" name="nama"
                                placeholder="Nama program studi">
                            <div id="nama_prodi_feedback" class="text-danger"></div>
                        </div>

                        <div class="mb-4">
                            <label for="kode_prodi" class="form-label fw-bold">Kode</label>
                            <input type="text" class="form-control" id="kode_prodi" name="kode"
                                placeholder="Kode program studi">
                            <div id="kode_prodi_feedback" class="text-danger"></div>
                        </div>

                        <div class="mb-4">
                            <label for="jenjang_prodi" class="form-label fw-bold">Jenjang pendidikan</label>
                            <select class="form-select" id="jenjang_prodi" name="jenjang_pendidikan">
                                <option value="" selected>Pilih jenjang pendidikan program studi</option>
                                <option value="D3">D3</option>
                                <option value="D4">D4</option>
                            </select>
                            <div id="jenjang_prodi_feedback" class="text-danger"></div>
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

    {{-- Hapus Modal --}}
    <div class="modal fade" id="hapusModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true"
        aria-labelledby="hapusModalLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="hapusModalLabel">Konfirmasi Penghapusan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-4">
                    <div class="text-center">
                        <i class="bi bi-exclamation-triangle-fill text-warning fs-1"></i>
                        <div>Anda yakin ingin hapus data?</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col">
                            <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Tidak</button>
                        </div>
                        <div class="col">
                            <form action="" method="post" id="hapusForm">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-success w-100" data-bs-dismiss="modal">Ya</button>
                            </form>
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
                        <div class="accordion" id="daftarProdi{{ $jrsn->nomor }}">
                            @foreach ($jrsn->programStudi as $prodi)
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button bg-light fw-bold" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#prodi{{ $prodi->nomor }}"
                                            aria-expanded="true" aria-controls="prodi{{ $loop->iteration }}">
                                            {{ $prodi->jenjang_pendidikan . ' ' . $prodi->nama }}
                                        </button>
                                    </h2>
                                    <div id="prodi{{ $prodi->nomor }}" class="accordion-collapse collapse"
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
                                                <div>
                                                    {{ $prodi->kaprodi != null ? $prodi->kaprodi->nama : 'Belum ada koordinator.' }}
                                                </div>
                                            </div>

                                            <div>
                                                <div class="fw-bold">Kurikulum aktif</div>
                                                <ul class="mb-4">
                                                    @forelse($prodi->kurikulumAktif as $kurikulum)
                                                        <li>Kurikulum {{ $kurikulum->tahun }}</li>
                                                    @empty
                                                        <li>Tidak ada data.</li>
                                                    @endforelse
                                                </ul>
                                            </div>

                                            {{-- <div> --}}
                                            {{--    <a href="#" class="btn-hapus-prodi" data-bs-toggle="modal" --}}
                                            {{--       data-bs-target="#hapusModal" data-nomor="{{ $prodi->nomor }}">Hapus</a> --}}
                                            {{-- </div> --}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <div class="card-body text-body-secondary">
                        <a href="#" class="btn-edit" class="me-2" data-bs-toggle="modal"
                            data-bs-target="#ubahJurusanModal" data-nomor="{{ $jrsn->nomor }}"
                            data-nama="{{ $jrsn->nama }}" data-golongan="{{ $jrsn->golongan }}">Ubah</a>
                        <a href="#" class="btn-add-prodi" data-bs-toggle="modal"
                            data-bs-target="#tambahProgramStudiModal" data-nomor="{{ $jrsn->nomor }}">Tambah Program
                            Studi</a>
                        {{-- <a href="#" class="btn-hapus-jurusan" data-bs-toggle="modal" --}}
                        {{--   data-bs-target="#hapusModal" data-nomor="{{ $jrsn->nomor }}">Hapus</a> --}}
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
                $('#nomor_jurusan').val('');
                $('#nama_jurusan').val('');
                $('#rekayasa').prop('checked', false);
                $('#nonrekayasa').prop('checked', false);

                $('#nomor_jurusan_feedback').html('');
                $('#nama_jurusan_feedback').html('');
                $('#golongan_jurusan_feedback').html('');
            });

            ubahJurusanModal.addEventListener('hidden.bs.modal', event => {
                $('#nomor_jurusan_ubah').val('');
                $('#nama_jurusan_ubah').val('');
                $('#rekayasa_ubah').prop('checked', false);
                $('#nonrekayasa_ubah').prop('checked', false);

                $('#nomor_jurusan_feedback_ubah').html('');
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
                            $('#nomor_jurusan_feedback').html(err.responseJSON.errors
                                .nomor[0])

                            $('#nama_jurusan_feedback').html(err.responseJSON.errors
                                .nama[0])

                            $('#golongan_jurusan_feedback').html(err.responseJSON.errors
                                .golongan[0])
                        }
                    }
                });
            });

            $('.btn-edit').on('click', function(e) {
                const nomor = $(this).data('nomor');
                const nama = $(this).data('nama');
                const golongan = $(this).data('golongan');

                $('#nomor_jurusan_ubah, #nomor_jurusan_old').val(nomor);
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

                const nomor = $('#nomor_jurusan_old').val();

                $.ajax({
                    type: "put",
                    url: url + "/" + nomor,
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
                            $('#nomor_jurusan_feedback_ubah').html(err.responseJSON.errors
                                .nomor[0])

                            $('#nama_jurusan_feedback_ubah').html(err.responseJSON.errors
                                .nama[0])

                            $('#golongan_jurusan_feedback_ubah').html(err.responseJSON.errors
                                .golongan[0])
                        }
                    }
                });
            });

            $('.btn-add-prodi').on('click', function(e) {
                const nomor = $(this).data('nomor');
                $('#nomor_jurusan_prodi').val(nomor);
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
                            $('#nama_prodi_feedback').html(err.responseJSON.errors.nama[0]);

                            $('#jenjang_prodi_feedback').html(err.responseJSON.errors
                                .jenjang_pendidikan[0]);

                            $('#nomor_prodi_feedback').html(err.responseJSON.errors.nomor[0]);

                            $('#kode_prodi_feedback').html(err.responseJSON.errors.kode[0]);

                            $('#koordinator_prodi_feedback').html(err.responseJSON.errors
                                .koordinator_prodi[0]);
                        } else if (err.status == 500) {
                            console.log(err);
                        }
                    }
                });
            });

            $('.btn-hapus-jurusan, .btn-hapus-prodi').on('click', function(e) {
                e.preventDefault();

                const nomor = $(this).data('nomor');
                const route = $(this).hasClass('btn-hapus-jurusan') ?
                    url + "/" + nomor :
                    "{{ url('/') }}/admin/program-studi/" + nomor;

                $('#hapusForm').attr('action', route);
            })
        });
    </script>
@endpush
