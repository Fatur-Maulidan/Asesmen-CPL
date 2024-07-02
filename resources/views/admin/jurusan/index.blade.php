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
            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                    data-bs-target="#importProgramStudiModal" @if($jurusan->isEmpty()) disabled @endif>
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
                   value="{{ \App\Enums\KategoriJurusan::Rekayasa }}"
                   @if (request('filter') == 'rekayasa') checked @endif>
            <label class="btn btn-outline-primary rounded-pill px-3" for="filter_rekayasa">Rekayasa</label>

            <input type="radio" class="btn-check" name="golongan" id="filter_nonrekayasa"
                   value="{{ \App\Enums\KategoriJurusan::Nonrekayasa }}"
                   @if (request('filter') == 'non-rekayasa') checked @endif>
            <label class="btn btn-outline-primary rounded-pill px-3" for="filter_nonrekayasa">Nonrekayasa</label>
        </div>
    </div>

    {{-- Import Program Studi Modal --}}
    <div class="modal fade" id="importProgramStudiModal" data-bs-backdrop="static" data-bs-keyboard="false"
         tabindex="-1"
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
                            <input class="form-control" type="file" id="formFileProgramStudi"
                                   name="formFileProgramStudi"
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
                            <label for="nama_jurusan" class="form-label fw-bold">Nama</label>
                            <input type="text" class="form-control" id="nama_jurusan" name="nama"
                                   placeholder="Nama Jurusan">
                            <div id="nama_jurusan_feedback" class="text-danger"></div>
                        </div>

                        <div class="mb-4">
                            <div class="fw-bold mb-2">Kategori</div>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="kategori"
                                           id="rekayasa" value="{{ \App\Enums\KategoriJurusan::Rekayasa }}">
                                    <label class="form-check-label" for="rekayasa">Rekayasa</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="kategori"
                                           id="nonrekayasa" value="{{ \App\Enums\KategoriJurusan::Nonrekayasa }}">
                                    <label class="form-check-label" for="nonrekayasa">Non Rekayasa</label>
                                </div>
                            </div>
                            <div id="kategori_jurusan_feedback" class="text-danger"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col">
                            <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Batal</button>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-success w-100" form="tambahJurusanForm">Tambah</button>
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
                        <input type="hidden" name="id_jurusan" id="id_jurusan">

                        <div class="mb-4">
                            <label for="nama_jurusan_ubah" class="form-label fw-bold">Nama</label>
                            <input type="text" class="form-control" id="nama_jurusan_ubah" name="nama"
                                   placeholder="Nama Jurusan">
                            <div id="nama_jurusan_feedback_ubah" class="text-danger"></div>
                        </div>

                        <div class="mb-4">
                            <div class="fw-bold mb-2">Kategori</div>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="kategori" id="rekayasa_ubah"
                                           value="{{ \App\Enums\KategoriJurusan::Rekayasa }}">
                                    <label class="form-check-label" for="rekayasa_ubah">Rekayasa</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="kategori"
                                           id="nonrekayasa_ubah" value="{{ \App\Enums\KategoriJurusan::Nonrekayasa }}">
                                    <label class="form-check-label" for="nonrekayasa_ubah">Non Rekayasa</label>
                                </div>
                            </div>
                            <div id="kategori_jurusan_feedback_ubah" class="text-danger"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col">
                            <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Batal</button>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-success w-100" form="ubahJurusanForm"
                                    id="submit-edit">Ubah
                            </button>
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
                    <h1 class="modal-title fs-5 fw-bold" id="tambahProgramStudiModalLabel">Tambah Program Studi
                        Baru</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="alert_tambah"></div>
                    <form action="{{ route('admin.program-studi.store') }}" method="POST" autocomplete="off"
                          id="tambahProgramStudiForm">
                        @csrf
                        <input type="hidden" name="id_jurusan" id="id_jurusan_prodi">

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
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenjang_pendidikan"
                                           id="D3" value="D3">
                                    <label class="form-check-label" for="D3">D3</label>
                                </div><div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenjang_pendidikan"
                                           id="D4" value="D4">
                                    <label class="form-check-label" for="D4">D4</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenjang_pendidikan"
                                           id="S2" value="S2">
                                    <label class="form-check-label" for="S2">S2</label>
                                </div>
                            </div>
                            <div id="jenjang_prodi_feedback" class="text-danger"></div>
                        </div>

                        <div>
                            <label for="koordinator_prodi" class="form-label fw-bold mb-0">Koordinator program studi</label>
                            <div id="koordinator_help" class="form-text mb-2">* Dapat dikosongkan dahulu.</div>
                            <select class="form-select" id="koordinator_prodi" name="id_dosen">
                                <option value="" selected>Pilih dosen</option>
                                @foreach ($dosen as $dsn)
                                    <option value="{{ $dsn->id }}">{{ $dsn->kode . ' - ' . $dsn->nama }}</option>
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
                                    form="tambahProgramStudiForm">Tambah
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Ubah Program Studi Modal --}}
    <div class="modal fade" id="ubahProgramStudiModal" data-bs-backdrop="static" data-bs-keyboard="false"
         tabindex="-1" aria-labelledby="ubahProgramStudiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="ubahProgramStudiModalLabel">Ubah Program Studi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="alert_ubah"></div>
                    <form action="" method="POST" autocomplete="off" id="ubahProgramStudiForm">
                        @csrf
                        @method('put')
                        <input type="hidden" name="id_program_studi" id="id_program_studi">

                        <div class="mb-4">
                            <label for="nama_prodi_ubah" class="form-label fw-bold">Nama</label>
                            <input type="text" class="form-control" id="nama_prodi_ubah" name="nama"
                                   placeholder="Nama program studi">
                            <div id="nama_prodi_ubah_feedback" class="text-danger"></div>
                        </div>

                        <div class="mb-4">
                            <label for="kode_prodi_ubah" class="form-label fw-bold">Kode</label>
                            <input type="text" class="form-control" id="kode_prodi_ubah" name="kode"
                                   placeholder="Kode program studi">
                            <div id="kode_prodi_ubah_feedback" class="text-danger"></div>
                        </div>

                        <div class="mb-4">
                            <label for="jenjang_prodi_ubah" class="form-label fw-bold">Jenjang pendidikan</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenjang_pendidikan"
                                           id="D3_ubah" value="D3">
                                    <label class="form-check-label" for="D3_ubah">D3</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenjang_pendidikan"
                                           id="D4_ubah" value="D4">
                                    <label class="form-check-label" for="D4_ubah">D4</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenjang_pendidikan"
                                           id="S2_ubah" value="S2">
                                    <label class="form-check-label" for="S2_ubah">S2</label>
                                </div>
                            </div>
                            <div id="jenjang_prodi_ubah_feedback" class="text-danger"></div>
                        </div>

                        <div>
                            <label for="koordinator_prodi_ubah" class="form-label fw-bold mb-0">Koordinator program studi</label>
                            <div id="koordinator_ubah_help" class="form-text mb-2">* Dapat dikosongkan.</div>
                            <select class="form-select" id="koordinator_prodi_ubah" name="id_dosen">
                                <option value="" selected>Pilih dosen</option>
                                @foreach ($dosen as $dsn)
                                    <option value="{{ $dsn->id }}">{{ $dsn->kode . ' - ' . $dsn->nama }}</option>
                                @endforeach
                            </select>
                            <div id="koordinator_prodi_ubah_feedback" class="text-danger"></div>
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
                                    form="ubahProgramStudiForm" id="submit-edit-prodi">Ubah
                            </button>
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
                            <div class="fw-bold">Kategori jurusan</div>
                            <div>{{ $jrsn->kategori }}</div>
                        </div>

                        <div>
                            <div class="fw-bold">Program studi terdaftar</div>
                            <ul class="mb-0">
                                @forelse ($jrsn->programStudi as $prodi)
                                    <li>{{ $prodi->jenjang_pendidikan . ' ' . $prodi->nama }}</li>
                                @empty
                                    <li>Belum ada program studi terdaftar.</li>
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
                        <div class="accordion" id="daftarProdi{{ $loop->iteration }}">
                            @foreach ($jrsn->programStudi as $prodi)
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button bg-light fw-bold" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#prodi{{ $loop->parent->iteration . $loop->iteration }}"
                                                aria-expanded="true" aria-controls="prodi{{ $loop->iteration }}">
                                            {{ $prodi->jenjang_pendidikan . ' ' . $prodi->nama }}
                                        </button>
                                    </h2>
                                    <div id="prodi{{ $loop->parent->iteration . $loop->iteration }}" class="accordion-collapse collapse"
                                         data-bs-parent="#daftarProdi{{ $loop->parent->iteration }}">
                                        <div class="accordion-body">
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
                                                        <li>Belum ada data.</li>
                                                    @endforelse
                                                </ul>
                                            </div>

                                            <button type="button" class="btn btn-warning btn-sm btn-edit-prodi" data-bs-toggle="modal"
                                                    data-bs-target="#ubahProgramStudiModal"
                                                    data-id="{{ $prodi->id }}"
                                                    data-nama="{{ $prodi->nama }}"
                                                    data-kode="{{ $prodi->kode }}"
                                                    data-jenjang="{{ $prodi->jenjang_pendidikan }}"
                                                    data-koordinator="{{ $prodi->kaprodi->id ?? '' }}">Ubah Data
                                                Program Studi
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <div class="card-body text-body-secondary">
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-warning btn-sm btn-edit" data-bs-toggle="modal"
                                    data-bs-target="#ubahJurusanModal"
                                    data-id="{{ $jrsn->id }}"
                                    data-nama="{{ $jrsn->nama }}"
                                    data-kategori="{{ $jrsn->kategori }}">Ubah Data
                                Jurusan
                            </button>
                            <button type="button" class="btn btn-primary btn-sm btn-add-prodi" data-bs-toggle="modal"
                                    data-bs-target="#tambahProgramStudiModal" data-id="{{ $jrsn->id }}">Tambah
                                Program Studi
                            </button>
                        </div>
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
        $(document).ready(function () {
            const url = "{{ url()->current() }}";
            const tambahJurusanModal = document.getElementById('tambahJurusanModal');
            const ubahJurusanModal = document.getElementById('ubahJurusanModal');
            const tambahProgramStudiModal = document.getElementById('tambahProgramStudiModal');
            const ubahProgramStudiModal = document.getElementById('ubahProgramStudiModal');

            const tambahJurusanModalInstance = new bootstrap.Modal('#tambahJurusanModal');
            const ubahJurusanModalInstance = new bootstrap.Modal('#ubahJurusanModal');
            const tambahProgramStudiModalInstance = new bootstrap.Modal('#tambahProgramStudiModal');
            const ubahProgramStudiModalInstance = new bootstrap.Modal('#ubahProgramStudiModal');
            const buttonLoading = `
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>`;

            $('#koordinator_prodi').select2({
                theme: "bootstrap-5",
                closeOnSelect: false,
                dropdownParent: $('#tambahProgramStudiModal')
            });

            $('#koordinator_prodi_ubah').select2({
                theme: "bootstrap-5",
                closeOnSelect: false,
                dropdownParent: $('#ubahProgramStudiModal'),
            });

            $('input[type=radio][name=golongan]').on('click', function () {
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
                $('#kategori_jurusan_feedback').html('');
            });

            ubahJurusanModal.addEventListener('hidden.bs.modal', event => {
                $('#nama_jurusan_ubah').val('');
                $('#rekayasa_ubah').prop('checked', false);
                $('#nonrekayasa_ubah').prop('checked', false);

                $('#nama_jurusan_feedback_ubah').html('');
                $('#kategori_jurusan_feedback_ubah').html('');
            });

            tambahProgramStudiModal.addEventListener('hidden.bs.modal', event => {
                $('#nama_prodi').val('');
                $('#kode_prodi').val('');
                $('input[name="jenjang_pendidikan"]').attr('checked', false);
                $('#koordinator_prodi').val(null).trigger('change');

                $('#nama_prodi_feedback').html('');
                $('#kode_prodi_feedback').html('');
                $('#jenjang_prodi_feedback').html('');
                $('#koordinator_prodi_feedback').html('');
            });

            ubahProgramStudiModal.addEventListener('hidden.bs.modal', event => {
                $('#nama_prodi_ubah').val('');
                $('#kode_prodi_ubah').val('');
                $('input[name="jenjang_pendidikan"]').attr('checked', false);
                $('#koordinator_prodi_ubah').val(null).trigger('change');

                $('#nama_prodi_ubah_feedback').html('');
                $('#kode_prodi_ubah_feedback').html('');
                $('#jenjang_prodi_ubah_feedback').html('');
                $('#koordinator_prodi_ubah_feedback').html('');
            });

            $('#tambahJurusanForm').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    type: "post",
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: "JSON",
                    success: function (res) {
                        console.log(res)
                        tambahJurusanModalInstance.hide();
                        location.reload();
                    },
                    error: function (err) {
                        // when status code is 422, it's a validation issue
                        if (err.status == 422) {
                            console.log(err.responseJSON);
                            if (err.responseJSON.errors.nama) {
                                $('#nama_jurusan_feedback').html(err.responseJSON.errors.nama[0]);
                            } else {
                                $('#nama_jurusan_feedback').html('');
                            }

                            if (err.responseJSON.errors.kategori) {
                                $('#kategori_jurusan_feedback').html(err.responseJSON.errors.kategori[0]);
                            } else {
                                $('#kategori_jurusan_feedback').html('');
                            }
                        }
                    }
                });
            });

            $('.btn-edit').on('click', function (e) {
                const id = $(this).data('id');
                const nama = $(this).data('nama');
                const kategori = $(this).data('kategori');

                $('#id_jurusan').val(id);
                $('#nama_jurusan_ubah').val(nama);
                if (kategori == 'Rekayasa') {
                    $('#rekayasa_ubah').prop('checked', true);
                } else {
                    $('#nonrekayasa_ubah').prop('checked', true);
                }
            });

            $('#ubahJurusanForm').on('submit', function (e) {
                e.preventDefault();
                $('#submit-edit').html(buttonLoading);

                const id = $('#id_jurusan').val();

                $.ajax({
                    type: "put",
                    url: url + "/" + id,
                    data: $(this).serialize(),
                    dataType: "JSON",
                    success: function (res) {
                        console.log(res);
                        $('#submit-edit').html('Ubah');
                        ubahJurusanModalInstance.hide();
                        location.reload();
                    },
                    error: function (err) {
                        $('#submit-edit').html('Ubah');
                        // when status code is 422, it's a validation issue
                        if (err.status == 422) {
                            console.log(err.responseJSON);
                            if (err.responseJSON.errors.nama) {
                                $('#nama_jurusan_feedback').html(err.responseJSON.errors.nama[0]);
                            } else {
                                $('#nama_jurusan_feedback').html('');
                            }

                            if (err.responseJSON.errors.kategori) {
                                $('#kategori_jurusan_feedback').html(err.responseJSON.errors.kategori[0]);
                            } else {
                                $('#kategori_jurusan_feedback').html('');
                            }
                        }
                    }
                });
            });

            $('.btn-add-prodi').on('click', function (e) {
                const id = $(this).data('id');
                $('#id_jurusan_prodi').val(id);
            });

            $('#tambahProgramStudiForm').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    type: "post",
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: "JSON",
                    success: function (res) {
                        console.log(res);
                        tambahProgramStudiModalInstance.hide();
                        location.reload();
                    },
                    error: function (err) {
                        // when status code is 422, it's a validation issue
                        if (err.status == 422) {
                            console.log(err.responseJSON);
                            if (err.responseJSON.errors.nama) {
                                $('#nama_prodi_feedback').html(
                                    err.responseJSON.errors.nama[0]
                                );
                            } else {
                                $('#nama_prodi_feedback').html('');
                            }

                            if (err.responseJSON.errors.kode) {
                                $('#kode_prodi_feedback').html(
                                    err.responseJSON.errors.kode[0]
                                );
                            } else {
                                $('#kode_prodi_feedback').html('');
                            }

                            if (err.responseJSON.errors.jenjang_pendidikan) {
                                $('#jenjang_prodi_feedback').html(
                                    err.responseJSON.errors.jenjang_pendidikan[0]
                                );
                            } else {
                                $('#jenjang_prodi_feedback').html('');
                            }

                            if (err.responseJSON.errors.koordinator_prodi) {
                                $('#koordinator_prodi_feedback').html(
                                    err.responseJSON.errors.koordinator_prodi[0]
                                );
                            } else {
                                $('#koordinator_prodi_feedback').html('');
                            }
                        } else if (err.status == 409) {
                            $('#alert_tambah').html(`
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                  ${err.responseJSON.message}
                                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            `);
                        } else if (err.status == 500) {
                            console.log(err);
                        }
                    }
                });
            });

            $('.btn-edit-prodi').on('click', function (e) {
                const id = $(this).data('id');
                const nama = $(this).data('nama');
                const kode = $(this).data('kode');
                const jenjang = $(this).data('jenjang');
                const koordinator = $(this).data('koordinator');

                $('#id_program_studi').val(id);
                $('#nama_prodi_ubah').val(nama);
                $('#kode_prodi_ubah').val(kode);
                if (jenjang == 'D3') {
                    $('#D3_ubah').prop('checked', true);
                } else if (jenjang == 'D4') {
                    $('#D4_ubah').prop('checked', true);
                } else {
                    $('#S2_ubah').prop('checked', true);
                }
                if (koordinator !== '') {
                    $('#koordinator_prodi_ubah').val(koordinator).trigger('change');
                }
            });

            $('#ubahProgramStudiForm').on('submit', function (e) {
                e.preventDefault();
                $('#submit-edit-prodi').html(buttonLoading);

                const id = $('#id_program_studi').val();
                let link = url + "/" + id;
                let route = link.replace('jurusan', 'program-studi');

                $.ajax({
                    type: "put",
                    url: route,
                    data: $(this).serialize(),
                    dataType: "JSON",
                    success: function (res) {
                        console.log(res);
                        $('#submit-edit-prodi').html('Ubah');
                        ubahProgramStudiModalInstance.hide();
                        location.reload();
                    },
                    error: function (err) {
                        $('#submit-edit-prodi').html('Ubah');
                        // when status code is 422, it's a validation issue
                        if (err.status == 422) {
                            console.log(err.responseJSON);
                            if (err.responseJSON.errors.nama) {
                                $('#nama_prodi_ubah_feedback').html(
                                    err.responseJSON.errors.nama[0]
                                );
                            } else {
                                $('#nama_prodi_ubah_feedback').html('');
                            }

                            if (err.responseJSON.errors.kode) {
                                $('#kode_prodi_ubah_feedback').html(
                                    err.responseJSON.errors.kode[0]
                                );
                            } else {
                                $('#kode_prodi_ubah_feedback').html('');
                            }

                            if (err.responseJSON.errors.jenjang_pendidikan) {
                                $('#jenjang_prodi_ubah_feedback').html(
                                    err.responseJSON.errors.jenjang_pendidikan[0]
                                );
                            } else {
                                $('#jenjang_prodi_ubah_feedback').html('');
                            }

                            if (err.responseJSON.errors.koordinator_prodi) {
                                $('#koordinator_prodi_ubah_feedback').html(
                                    err.responseJSON.errors.koordinator_prodi[0]
                                );
                            } else {
                                $('#koordinator_prodi_ubah_feedback').html('');
                            }
                        } else if (err.status == 409) {
                            console.log(err);
                            $('#alert_ubah').html(`
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                  ${err.responseJSON.message}
                                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            `);
                        } else if (err.status == 500) {
                            console.log(err);
                        }
                    }
                });
            });
        });
    </script>
@endpush
