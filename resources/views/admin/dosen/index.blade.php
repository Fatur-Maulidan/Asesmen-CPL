@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.dosen.index') }}
    <h1 class="fw-bold mb-0">{{ $title }}</h1>
@endsection

@section('main')
    {{-- Search --}}
    <div class="row align-items-end mb-4">
        <div class="col-auto">
            <form action="" method="GET">
                <div class="row align-items-end">
                    {{--<div class="col-auto">--}}
                    {{--    <div>--}}
                    {{--        <label for="filter_role" class="form-label fw-bold">Filter berdasarkan role</label>--}}
                    {{--        <select class="form-select" id="filter_role" name="role">--}}
                    {{--            <option value="">Pilih role</option>--}}
                    {{--            <option value="{{ \App\Enums\RoleDosen::Dosen }}"--}}
                    {{--                @if (request('role') == \App\Enums\RoleDosen::Dosen) selected @endif>Dosen</option>--}}
                    {{--            <option value="{{ \App\Enums\RoleDosen::P2MPP }}"--}}
                    {{--                @if (request('role') == \App\Enums\RoleDosen::P2MPP) selected @endif>P2MPP</option>--}}
                    {{--            <option value="{{ \App\Enums\RoleDosen::KoorProgramStudi }}"--}}
                    {{--                @if (request('role') == \App\Enums\RoleDosen::KoorProgramStudi) selected @endif>Koordinator Program Studi--}}
                    {{--            </option>--}}
                    {{--        </select>--}}
                    {{--    </div>--}}
                    {{--</div>--}}
                    <div class="col-auto">
                        <div>
                            <label for="filter_jurusan" class="form-label fw-bold">Filter berdasarkan jurusan</label>
                            <select class="form-select" id="filter_jurusan" name="jurusan">
                                <option value="">Pilih jurusan</option>
                                @foreach ($jurusan as $jrsn)
                                    <option value="{{ $jrsn->nomor }}" @if (request('jurusan') == $jrsn->nomor) selected @endif>{{ $jrsn->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{--<div class="col-auto">--}}
                    {{--    <div>--}}
                    {{--        <label for="filter_status" class="form-label fw-bold">Filter berdasarkan status</label>--}}
                    {{--        <select class="form-select" id="filter_status" name="status">--}}
                    {{--            <option value="">Pilih status</option>--}}
                    {{--            <option value="{{ \App\Enums\StatusKeaktifan::Aktif }}"--}}
                    {{--                @if (request('status') == \App\Enums\StatusKeaktifan::Aktif) selected @endif>Aktif</option>--}}
                    {{--            <option value="{{ \App\Enums\StatusKeaktifan::Nonaktif }}"--}}
                    {{--                @if (request('status') == \App\Enums\StatusKeaktifan::Nonaktif) selected @endif>Nonaktif</option>--}}
                    {{--        </select>--}}
                    {{--    </div>--}}
                    {{--</div>--}}
                    <div class="col-auto">
                        <button type="submit" class="btn btn-outline-primary">Filter</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col text-end">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importDosenModal">
                Import Dosen
            </button>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahDosenModal"
                id="btn-tambah">Tambah
                Dosen</button>
        </div>
    </div>

    {{-- Import Dosen Modal --}}
    <div class="modal fade" id="importDosenModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="importDosenModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="importDosenModalLabel">Import Dosen</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.dosen.import') }}" method="POST" autocomplete="off"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-5">
                            <label for="formFile" class="form-label fw-bold">Upload File Excel</label>
                            <input class="form-control" type="file" id="formFile" name="formFile" accept=".xlsx">
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.dosen.downloadTemplate') }}" class="btn btn-outline-success">Download
                                Template</a>
                            <button class="btn btn-success" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Tambah Dosen Modal --}}
    <div class="modal fade" id="tambahDosenModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="tambahDosenModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="tambahDosenModalLabel">Tambah Dosen</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" autocomplete="off" id="tambahDosenForm">
                        @csrf
                        <div id="method_spoofing"></div>

                        <div class="mb-3">
                            <label for="kode" class="form-label fw-bold">Kode dosen</label>
                            <input type="text" class="form-control" id="kode" name="kode"
                                   placeholder="Kode dosen">
                            <div id="kode_feedback" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label for="nip" class="form-label fw-bold">NIP</label>
                            <input type="text" class="form-control" id="nip" name="nip"
                                   placeholder="Nomor Induk Pegawai">
                            <div id="nip_feedback" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label fw-bold">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                placeholder="Nama Dosen">
                            <div id="nama_feedback" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <div class="fw-bold mb-2">Jenis Kelamin</div>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin"
                                        value="{{ \App\Enums\JenisKelamin::LakiLaki }}" id="jk_laki">
                                    <label class="form-check-label" for="jk_laki">Laki-Laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin"
                                        value="{{ \App\Enums\JenisKelamin::Perempuan }}" id="jk_perempuan">
                                    <label class="form-check-label" for="jk_perempuan">Perempuan</label>
                                </div>
                            </div>
                            <div id="jenis_kelamin_feedback" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email dosen</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Email dosen">
                            <div id="email_feedback" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label for="jurusan" class="form-label fw-bold">Jurusan</label>
                            <select class="form-select" id="jurusan" name="jurusan">
                                <option value="" selected>Pilih jurusan</option>
                                @foreach ($jurusan as $jrsn)
                                    <option value="{{ $jrsn->nomor }}">{{ $jrsn->nama }}</option>
                                @endforeach
                            </select>
                            <div id="jurusan_feedback" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label for="program_studi" class="form-label fw-bold">Program studi</label>
                            <select class="form-select" id="program_studi" name="program_studi[]" multiple>
                                <option value="">Pilih program studi</option>
                                @foreach ($prodi as $p)
                                    <option value="{{ $p->nomor }}">{{ $p->jenjang_pendidikan . ' ' .$p->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col">
                            <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Batal</button>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-success w-100" form="tambahDosenForm"
                                id="btn-submit">Tambah</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Hapus Modal --}}
    <div class="modal fade" id="hapusDosenModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true"
        aria-labelledby="hapusDosenModalLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="hapusDosenModalLabel">Konfirmasi Penghapusan</h1>
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
                            <form action="" method="post" id="hapusDosenForm">
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

    {{-- Data Dosen --}}
    <div class="row">
        <div class="col-12">
            {{-- <table class="table table-striped table-hover table-responsive table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ID</th>
                        <th scope="col">NIP</th>
                        <th scope="col">Kode Dosen</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email Polban</th>
                        <th scope="col">Role</th>
                        <th scope="col">Status</th>
                        <th scope="col">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dosen as $dsn)
                        <tr>
                            <th scope="row" class="align-middle">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="">
                                </div>
                            </th>
                            <td class="align-middle">{{ $dsn->id }}</td>
                            <td class="align-middle">{{ $dsn->nip }}</td>
                            <td class="align-middle">{{ $dsn->kode }}</td>
                            <td class="align-middle">{{ $dsn->nama }}</td>
                            <td class="align-middle">{{ $dsn->email }}</td>
                            <td class="align-middle">{{ \App\Enums\RoleDosen::getDescription($dsn->role) }}</td>
                            <td class="align-middle">
                                @if ($dsn->status->is(\App\Enums\StatusKeaktifan::Aktif))
                                    <button type="button" class="btn btn-danger">Nonaktifkan</button>
                                @else
                                    <button type="button" class="btn btn-success">Aktifkan</button>
                                @endif
                            </td>
                            <td class="align-middle">
                                <a href="#">Ubah</a>
                                <a href="#">Hapus</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table> --}}
            {{ $dataTable->table(['class' => 'table table-hover table-striped mt-3']) }}
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
    <script>
        $(document).ready(function() {
            const tambahDosenModal = document.getElementById('tambahDosenModal');
            const tambahDosenModalInstance = new bootstrap.Modal('#tambahDosenModal');

            tambahDosenModal.addEventListener('hidden.bs.modal', event => {
                $('#kode').val('');
                $('#nip').val('');
                $('#nama').val('');
                $('#jk_laki').prop('checked', false);
                $('#jk_perempuan').prop('checked', false);
                $('#email').val('');
                $('#jurusan').prop('selectedIndex', 0);

                $('#nama_feedback').html('');
                $('#nip_feedback').html('');
                $('#kode_feedback').html('');
                $('#jenis_kelamin_feedback').html('');
                $('#email_feedback').html('');
                $('#jurusan_feedback').html('');
            });

            $('#btn-tambah').on('click', function() {
                const url = "{{ url()->current() }}";
                $('#tambahDosenForm').attr('action', url);
                $('#tambahDosenModalLabel').html('Tambah Dosen');
                $('#btn-submit').html('Tambah');
            });

            $('#tambahDosenForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    type: "post",
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: "JSON",
                    success: function(res) {
                        console.log(res)
                        tambahDosenModalInstance.hide();
                        location.reload();
                    },
                    error: function(err) {
                        // when status code is 422, it's a validation issue
                        if (err.status == 422) {
                            console.log(err.responseJSON);

                            if ('nama' in err.responseJSON.errors) {
                                $('#nama_feedback').html(err.responseJSON.errors
                                    .nama[0]);
                            } else {
                                $('#nama_feedback').html('');
                            }

                            if ('nip' in err.responseJSON.errors) {
                                $('#nip_feedback').html(err.responseJSON.errors
                                    .nip[0]);
                            } else {
                                $('#nip_feedback').html('');
                            }

                            if ('kode' in err.responseJSON.errors) {
                                $('#kode_feedback').html(err.responseJSON.errors
                                    .kode[0]);
                            } else {
                                $('#kode_feedback').html('');
                            }

                            if ('jenis_kelamin' in err.responseJSON.errors) {
                                $('#jenis_kelamin_feedback').html(err.responseJSON.errors
                                    .jenis_kelamin[0]);
                            } else {
                                $('#jenis_kelamin_feedback').html('');
                            }

                            if ('email' in err.responseJSON.errors) {
                                $('#email_feedback').html(err.responseJSON.errors
                                    .email[0]);
                            } else {
                                $('#email_feedback').html('');
                            }

                            if ('jurusan' in err.responseJSON.errors) {
                                $('#jurusan_feedback').html(err.responseJSON.errors
                                    .jurusan[0]);
                            } else {
                                $('#jurusan_feedback').html('');
                            }
                        } else if (err.status == 500) {
                            console.log(err);
                        }
                    }
                });
            });

            $(document).on('click', '.btn-hapus', function(e) {
                e.preventDefault();

                const kode = $(this).data('kode');
                $('#hapusDosenForm').attr('action', "{{ url()->current() }}/" + kode);
            });

            $(document).on('click', '.btn-ubah', function(e) {
                e.preventDefault();

                const kode = $(this).data('kode');
                const url = "{{ url()->current() }}/" + kode;

                $.ajax({
                    type: "get",
                    url: url,
                    dataType: "JSON",
                    success: function(res) {
                        console.log(res);

                        $('#kode').val(res.dosen.kode);
                        $('#nip').val(res.dosen.nip);
                        $('#nama').val(res.dosen.nama);
                        (res.dosen.jenis_kelamin == '{{ \App\Enums\JenisKelamin::LakiLaki }}')
                            ? $('#jk_laki').prop('checked', true)
                            : $('#jk_perempuan').prop('checked', true);
                        $('#email').val(res.dosen.email);
                        $('#jurusan').val(res.dosen['01_MASTER_jurusan_nomor']).change();
                        let prodi = [];
                        if (res.dosen.program_studi) {
                            res.dosen.program_studi.forEach(function (element, index) {
                                prodi.push(element.nomor);
                            });
                        }
                        $('#program_studi').val(prodi).change();
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });

                $('#tambahDosenModalLabel').html('Ubah Dosen');
                $('#tambahDosenForm').attr('action', "{{ url()->current() }}/" + kode);
                $('#method_spoofing').html('{{ method_field('patch') }}');
                $('#btn-submit').html('Ubah');
            });

            $('#program_studi').select2({
                theme: "bootstrap-5",
                closeOnSelect: false,
                dropdownParent: $('#tambahDosenModal')
            });
        });
    </script>
@endpush
