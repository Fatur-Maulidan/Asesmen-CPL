@extends('layouts.main')

@section('breadcrumb')
    <h1 class="fw-bold mb-4">{{ $title }}</h1>
    {{ Breadcrumbs::render('admin.mahasiswa.index') }}
@endsection

@section('main')
    {{-- Buttons --}}
    <div class="row mb-5">
        <div class="col text-end">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importMahasiswaModal">
                Import Mahasiswa
            </button>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mahasiswaModal">
                Tambah Mahasiswa
            </button>
        </div>
    </div>

    {{-- Import Mahasiswa Modal --}}
    <div class="modal fade" id="importMahasiswaModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="importMahasiswaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="importMahasiswaModalLabel">Import Jurusan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.mahasiswa.import') }}" method="POST"
                          autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-5">
                            <label for="formFile" class="form-label fw-bold">Upload File Excel</label>
                            <input class="form-control" type="file" id="formFile" name="formFile" accept=".xlsx">
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.mahasiswa.downloadTemplate') }}"
                               class="btn btn-outline-success">Download
                                Template</a>
                            <button class="btn btn-success" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Mahasiswa Modal --}}
    <div class="modal fade" id="mahasiswaModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="mahasiswaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="mahasiswaModalLabel">Tambah Mahasiswa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.mahasiswa.store') }}"
                          autocomplete="off" id="mahasiswaForm">
                        @csrf

                        <div class="mb-3">
                            <label for="nim" class="form-label fw-bold">NIM</label>
                            <input type="text" class="form-control" name="nim"
                                   id="nim" placeholder="NIM mahasiswa">
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label fw-bold">Nama</label>
                            <input type="text" class="form-control" name="nama"
                                   id="nama" placeholder="Nama mahasiswa">
                        </div>

                        <div class="mb-3">
                            <div class="fw-bold mb-2">Jenis Kelamin</div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin"
                                       value="{{ \App\Enums\JenisKelamin::LakiLaki }}" id="jk_laki_laki">
                                <label class="form-check-label" for="jk_laki_laki">Laki-Laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin"
                                       value="{{ \App\Enums\JenisKelamin::Perempuan }}" id="jk_perempuan">
                                <label class="form-check-label" for="jk_perempuan">Perempuan</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control"
                                   name="email" id="email" placeholder="Email mahasiswa">
                        </div>

                        <div class="mb-3">
                            <label for="tahun_angkatan" class="fw-bold">Tahun angkatan</label>
                            <select class="form-select" name="tahun_angkatan" id="tahun_angkatan" required>
                                <option value="" selected>Pilih tahun masuk</option>
                                @for ($i = 2020; $i < date('Y'); $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="mb-3">
                            <div class="fw-bold mb-2">Kelas</div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kelas" value="A" id="kelas_A">
                                <label class="form-check-label" for="kelas_A">A</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kelas" value="B" id="kelas_B">
                                <label class="form-check-label" for="kelas_B">B</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kelas" value="C" id="kelas_B">
                                <label class="form-check-label" for="kelas_C">C</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col">
                            <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Batal</button>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-success w-100" form="mahasiswaForm">Tambah</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Data Mahasiswa --}}
    <div class="row">
        <div class="col-12">
            {{ $dataTable->table(['class' => 'table table-hover table-striped mt-3']) }}
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
    <script>
        $(document).ready(function () {
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

            $(document).on('click', '.btn-hapus', function (e) {
                e.preventDefault();

                const nim = $(this).data('nim');
                $('#hapusMahasiswaForm').attr('action', "{{ url()->current() }}/" + nim);
            });

            $(document).on('click', '.btn-ubah', function (e) {
                e.preventDefault();

                const nim = $(this).data('nim');
                const url = "{{ url()->current() }}/" + nim;

                $('#ubahMahasiswaForm').attr('action', url);
                $.ajax({
                    type: "get",
                    url: url,
                    dataType: "JSON",
                    success: function (res) {
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
                    error: function (err) {
                        console.log(err);
                    }
                });
            });

            $('#ubahMahasiswaForm').on('submit', function (e) {
                e.preventDefault();
                console.log($(this).serialize())

                $.ajax({
                    type: "post",
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: "JSON",
                    success: function (res) {
                        console.log(res)
                        ubahMahasiswaModalInstance.hide();
                        location.reload();
                    },
                    error: function (err) {
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
