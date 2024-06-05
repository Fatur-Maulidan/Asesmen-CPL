@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('kaprodi.mahasiswa.index', $kurikulum) }}
    <h1 class="fw-bold mb-0">{{ $title }}</h1>
@endsection

@section('main')
    {{-- Filter buttons --}}
    <div class="row mb-5">
        <div class="col text-end">
            {{-- Button trigger modal --}}
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importMahasiswaModal">
                Import Mahasiswa
            </button>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahMahasiswaModal">
                Tambah Mahasiswa
            </button>
        </div>
    </div>

    {{-- Import Jurusan Modal --}}
    <div class="modal fade" id="importMahasiswaModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="importMahasiswaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="importMahasiswaModalLabel">Import Jurusan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('kaprodi.mahasiswa.import', ['kurikulum' => $kurikulum]) }}" method="POST"
                        autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-5">
                            <label for="formFile" class="form-label fw-bold">Upload File Excel</label>
                            <input class="form-control" type="file" id="formFile" name="formFile" accept=".xlsx">
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('kaprodi.mahasiswa.downloadTemplate', ['kurikulum' => $kurikulum]) }}"
                                class="btn btn-outline-success">Download
                                Template</a>
                            <button class="btn btn-success" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Tambah Mahasiswa Modal --}}
    <div class="modal fade" id="tambahMahasiswaModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="tambahMahasiswaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="tambahMahasiswaModalLabel">Tambah Mahasiswa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('kaprodi.mahasiswa.store', ['kurikulum' => $kurikulum]) }}"
                        autocomplete="off">
                        @csrf

                        <div class="mb-3">
                            <label for="nim" class="form-label fw-bold">NIM</label>
                            <input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim"
                                id="nim" placeholder="NIM mahasiswa" value="{{ old('nim') }}">
                            @error('nim')
                                <div class="invalid-feedback">
                                    <ul>
                                        @foreach ($errors->get('nim') as $error)
                                            <li> {{ $error }} </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label fw-bold">Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                                id="nama" placeholder="Nama mahasiswa" value="{{ old('nama') }}">
                            @error('nama')
                                <div class="invalid-feedback">
                                    <ul>
                                        @foreach ($errors->get('nama') as $error)
                                            <li> {{ $error }} </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="fw-bold mb-2">Jenis Kelamin</div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin"
                                    value="{{ \App\Enums\JenisKelamin::LakiLaki }}" id="jk_laki_tambah"
                                    @if (old('jenis_kelamin') == \App\Enums\JenisKelamin::LakiLaki) {{ 'checked' }} @endif>
                                <label class="form-check-label" for="jk_laki_tambah">
                                    Laki-Laki
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin"
                                    value="{{ \App\Enums\JenisKelamin::Perempuan }}" id="jk_perempuan_tambah"
                                    @if (old('jenis_kelamin') == \App\Enums\JenisKelamin::Perempuan) {{ 'checked' }} @endif>
                                <label class="form-check-label" for="jk_perempuan_tambah">
                                    Perempuan
                                </label>
                            </div>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">
                                    <ul>
                                        @foreach ($errors->get('jenis_kelamin') as $error)
                                            <li> {{ $error }} </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" id="email" placeholder="Email mahasiswa"
                                value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    <ul>
                                        @foreach ($errors->get('email') as $error)
                                            <li> {{ $error }} </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="fw-bold">Tahun masuk</label>
                            <select class="form-select @error('tahun_angkatan') is-invalid @enderror"
                                name="tahun_angkatan" aria-label="Default select example" required>
                                <option selected>Pilih tahun masuk</option>
                                @for ($i = 2020; $i < date('Y'); $i++)
                                    <option value="{{ $i }}" @if (old('tahun_angkatan') == $i) {{ 'selected' }} @endif>{{ $i }}</option>
                                @endfor
                            </select>
                            @error('tahun_angkatan')
                                <div class="invalid-feedback">
                                    <ul>
                                        @foreach ($errors->get('tahun_angkatan') as $error)
                                            <li> {{ $error }} </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @enderror
                        </div>

                        <div>
                            <label for="" class="fw-bold">Kelas</label>
                            <select class="form-select @error('kelas') is-invalid @enderror" name="kelas"
                                aria-label="Default select example" required>
                                <option selected>Pilih kelas</option>
                                <option value="A" @if (old('kelas') == 'A') {{ 'selected' }} @endif>A
                                </option>
                                <option value="B" @if (old('kelas') == 'B') {{ 'selected' }} @endif>B
                                </option>
                            </select>
                            @error('kelas')
                                <div class="invalid-feedback">
                                    <ul>
                                        @foreach ($errors->get('kelas') as $error)
                                            <li> {{ $error }} </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @enderror
                        </div>
                </div>
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col">
                            <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Batal</button>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-success w-100">Tambah</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Ubah Mahasiswa Modal --}}
    <div class="modal fade" id="ubahMahasiswaModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="ubahMahasiswaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="ubahMahasiswaModalLabel">Ubah Mahasiswa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" autocomplete="off" id="ubahMahasiswaForm">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="nim_ubah" class="form-label fw-bold">NIM</label>
                            <input type="text" class="form-control" id="nim_ubah" name="nim"
                                placeholder="NIM mahasiswa" value="">
                            <div id="nim_ubah_feedback" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label for="nama_ubah" class="form-label fw-bold">Nama</label>
                            <input type="text" class="form-control" id="nama_ubah" name="nama"
                                placeholder="Nama mahasiswa" value="">
                            <div id="nama_ubah_feedback" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <div class="fw-bold mb-2">Jenis Kelamin</div>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin"
                                        value="{{ \App\Enums\JenisKelamin::LakiLaki }}" id="jk_laki_ubah">
                                    <label class="form-check-label" for="jk_laki_ubah">Laki-Laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin"
                                        value="{{ \App\Enums\JenisKelamin::Perempuan }}" id="jk_perempuan_ubah">
                                    <label class="form-check-label" for="jk_perempuan_ubah">Perempuan</label>
                                </div>
                            </div>
                            <div id="jenis_kelamin_ubah_feedback" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label for="email_ubah" class="form-label fw-bold">Email</label>
                            <input type="email_ubah" class="form-control" id="email_ubah" name="email"
                                placeholder="Email mahasiswa" value="">
                            <div id="email_ubah_feedback" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label for="tahun_angkatan_ubah" class="fw-bold mb-2">Tahun Angkatan</label>
                            <select class="form-select" id="tahun_angkatan_ubah" name="tahun_angkatan">
                                <option>Pilih tahun masuk</option>
                                @for ($i = 2020; $i < date('Y'); $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            <div id="tahun_angkatan_ubah_feedback" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <div class="fw-bold mb-2">Kelas</div>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="kelas" value="A"
                                        id="kelas_A">
                                    <label class="form-check-label" for="kelas_A">A</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="kelas" value="B"
                                        id="kelas_B">
                                    <label class="form-check-label" for="kelas_B">B</label>
                                </div>
                            </div>
                            <div id="kelas_ubah_feedback" class="text-danger"></div>
                        </div>

                        <div>
                            <div class="fw-bold mb-2">Status</div>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status"
                                        value="{{ \App\Enums\StatusKeaktifan::Aktif }}" id="aktif">
                                    <label class="form-check-label" for="aktif">Aktif</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status"
                                        value="{{ \App\Enums\StatusKeaktifan::Nonaktif }}" id="nonaktif">
                                    <label class="form-check-label" for="nonaktif">Nonaktif</label>
                                </div>
                            </div>
                            <div id="status_ubah_feedback" class="text-danger"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col">
                            <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Batal</button>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-success w-100" form="ubahMahasiswaForm">Ubah</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Hapus Modal --}}
    <div class="modal fade" id="hapusMahasiswaModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true"
        aria-labelledby="hapusMahasiswaModalLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="hapusMahasiswaModalLabel">Konfirmasi Penghapusan</h1>
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
                            <form action="" method="post" id="hapusMahasiswaForm">
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

    {{-- Data Mahasiswa --}}
    <div class="row">
        <div class="col-12">
            {{-- <table class="table table-striped table-hover table-responsive">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">NIM</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email Polban</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Tahun Masuk</th>
                        <th scope="col">Dosen wali</th>
                        <th scope="col">Status kemahasiswaan</th>
                        <th scope="col">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mahasiswa as $mhs)
                        <tr>
                            <th scope="row" class="align-middle">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="">
                                </div>
                            </th>
                            <td class="align-middle">{{ $mhs['nim'] }}</td>
                            <td class="align-middle">{{ Str::title($mhs['nama']) }}</td>
                            <td class="align-middle">test.email@polban.ac.id</td>
                            <td class="align-middle">3A</td>
                            <td class="align-middle">2021</td>
                            <td class="align-middle">Eddy B. Soewono</td>
                            <td class="text-center align-middle"><button type="button"
                                    class="btn btn-danger">Nonaktifkan</button></td>
                            <td class="align-middle">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#ubahMahasiswaModal">Ubah</a>
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
            const ubahMahasiswaModal = document.getElementById('ubahMahasiswaModal');
            const ubahMahasiswaModalInstance = new bootstrap.Modal('#ubahMahasiswaModal');

            ubahMahasiswaModal.addEventListener('hidden.bs.modal', event => {
                $('#ubahMahasiswaForm').attr('action', '');
                $('#nim_ubah').val('');
                $('#nama_ubah').val('');
                $('#jk_laki_ubah').prop('checked', false);
                $('#jk_perempuan_ubah').prop('checked', false);
                $('#email_ubah').val('');
                $('#tahun_angkatan_ubah').prop('selectedIndex', 0);
                $('#kelas_A').prop('checked', false);
                $('#kelas_B').prop('checked', false);
                $('#aktif').prop('checked', false);
                $('#nonaktif').prop('checked', false);

                $('#nim_ubah_feedback').html('');
                $('#nama_ubah_feedback').html('');
                $('#jenis_kelamin_ubah_feedback').html('');
                $('#email_ubah_feedback').html('');
                $('#tahun_angkatan_ubah_feedback').html('');
                $('#kelas_ubah_feedback').html('');
                $('#status_ubah_feedback').html('');
            });

            $(document).on('click', '.btn-hapus', function(e) {
                e.preventDefault();

                const nim = $(this).data('nim');
                $('#hapusMahasiswaForm').attr('action', "{{ url()->current() }}/" + nim);
            });

            $(document).on('click', '.btn-ubah', function(e) {
                e.preventDefault();

                const nim = $(this).data('nim');
                const url = "{{ url()->current() }}/" + nim;

                $('#ubahMahasiswaForm').attr('action', url);
                $.ajax({
                    type: "get",
                    url: url,
                    dataType: "JSON",
                    success: function(res) {
                        console.log(res);

                        $('#nim_ubah').val(res.mahasiswa.nim);
                        $('#nama_ubah').val(res.mahasiswa.nama);
                        if (res.mahasiswa.jenis_kelamin == 'L') {
                            $('#jk_laki_ubah').prop('checked', true);
                        } else {
                            $('#jk_perempuan_ubah').prop('checked', true);
                        }
                        $('#email_ubah').val(res.mahasiswa.email);
                        $('#tahun_angkatan_ubah').val(res.mahasiswa.tahun_angkatan).change();
                        if ((res.mahasiswa.kelas).slice(1, 2) == 'A') {
                            $('#kelas_A').prop('checked', true);
                        } else {
                            $('#kelas_B').prop('checked', true);
                        }
                        if (res.mahasiswa.status == 'Aktif') {
                            $('#aktif').prop('checked', true);
                        } else {
                            $('#nonaktif').prop('checked', true);
                        }
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            });

            $('#ubahMahasiswaForm').on('submit', function(e) {
                e.preventDefault();
                console.log($(this).serialize())

                $.ajax({
                    type: "post",
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: "JSON",
                    success: function(res) {
                        console.log(res)
                        ubahMahasiswaModalInstance.hide();
                        location.reload();
                    },
                    error: function(err) {
                        // when status code is 422, it's a validation issue
                        if (err.status == 422) {
                            console.log(err.responseJSON);

                            if ('nim' in err.responseJSON.errors) {
                                $('#nim_ubah_feedback').html(err.responseJSON.errors
                                    .nim[0]);
                            } else {
                                $('#nim_ubah_feedback').html('');
                            }

                            if ('nama' in err.responseJSON.errors) {
                                $('#nama_ubah_feedback').html(err.responseJSON.errors
                                    .nama[0]);
                            } else {
                                $('#nama_ubah_feedback').html('');
                            }

                            if ('jenis_kelamin' in err.responseJSON.errors) {
                                $('#jenis_kelamin_ubah_feedback').html(err.responseJSON.errors
                                    .jenis_kelamin[0]);
                            } else {
                                $('#jenis_kelamin_ubah_feedback').html('');
                            }

                            if ('email' in err.responseJSON.errors) {
                                $('#email_ubah_feedback').html(err.responseJSON.errors
                                    .email[0]);
                            } else {
                                $('#email_ubah_feedback').html('');
                            }

                            if ('tahun_angkatan' in err.responseJSON.errors) {
                                $('#tahun_angkatan_ubah_feedback').html(err.responseJSON.errors
                                    .tahun_angkatan[0]);
                            } else {
                                $('#tahun_angkatan_ubah_feedback').html('');
                            }

                            if ('status' in err.responseJSON.errors) {
                                $('#status_ubah_feedback').html(err.responseJSON.errors
                                    .status[0]);
                            } else {
                                $('#status_ubah_feedback').html('');
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
