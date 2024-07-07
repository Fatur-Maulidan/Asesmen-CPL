@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('kaprodi.mahasiswa.index', $kurikulum->tahun) }}
    <h1 class="fw-bold mb-4">{{ $title }}</h1>
@endsection

@section('main')
    {{-- Filter buttons --}}
    <div class="row mb-5">
        <div class="col text-end">
            {{-- Button trigger modal --}}
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importMahasiswaModal">
                Import Mahasiswa
            </button>
            <button type="button" class="btn btn-primary" id="btn-tambah" data-bs-toggle="modal" data-bs-target="#mahasiswaModal">
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
                    <h1 class="modal-title fs-5 fw-bold" id="importMahasiswaModalLabel">Import Mahasiswa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('kaprodi.mahasiswa.import', ['kurikulum' => $kurikulum->tahun]) }}" method="POST"
                        autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-5">
                            <label for="formFile" class="form-label fw-bold">Upload File Excel</label>
                            <input class="form-control" type="file" id="formFile" name="formFile" accept=".xlsx">
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('kaprodi.mahasiswa.downloadTemplate', ['kurikulum' => $kurikulum->tahun]) }}"
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
                    <form method="POST" action="" autocomplete="off" id="mahasiswaForm">
                        @csrf
                        <div id="method_spoofing"></div>

                        <div class="mb-3">
                            <label for="nim" class="form-label fw-bold">NIM</label>
                            <input type="text" class="form-control" name="nim" id="nim" placeholder="NIM mahasiswa">
                            <div id="nim_feedback" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label fw-bold">Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama mahasiswa">
                            <div id="nama_feedback" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <div class="fw-bold mb-2">Jenis Kelamin</div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin"
                                    value="{{ \App\Enums\JenisKelamin::LakiLaki }}" id="jk_laki_laki">
                                <label class="form-check-label" for="jk_laki_laki">
                                    Laki-Laki
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin"
                                    value="{{ \App\Enums\JenisKelamin::Perempuan }}" id="jk_perempuan">
                                <label class="form-check-label" for="jk_perempuan">
                                    Perempuan
                                </label>
                            </div>
                            <div id="jenis_kelamin_feedback" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email mahasiswa">
                            <div id="email_feedback" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label for="" class="fw-bold">Tahun masuk</label>
                            <select class="form-select" name="tahun_angkatan" id="tahun_angkatan">
                                <option value="" selected>Pilih tahun masuk</option>
                                @for($year = 2020; $year < date('Y') + 5; $year++)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                            <div id="tahun_angkatan_feedback" class="text-danger"></div>
                        </div>

                        <div>
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
                                <input class="form-check-input" type="radio" name="kelas" value="C" id="kelas_C">
                                <label class="form-check-label" for="kelas_C">C</label>
                            </div>
                            <div id="kelas_feedback" class="text-danger"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col">
                            <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Batal</button>
                        </div>
                        <div class="col">
                            <button type="submit" id="btn-submit" class="btn btn-success w-100" form="mahasiswaForm">Tambah</button>
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
        $(document).ready(function() {
            const mahasiswaModal = document.getElementById('mahasiswaModal');
            const mahasiswaModalInstance = new bootstrap.Modal('#mahasiswaModal');

            mahasiswaModal.addEventListener('hidden.bs.modal', event => {
                $('#method_spoofing').html('');
                $('#nim').val('').attr('readonly', false);
                $('#nama').val('');
                $('#jk_laki_laki').prop('checked', false);
                $('#jk_perempuan').prop('checked', false);
                $('#email').val('');
                $('#tahun_angkatan').prop('selectedIndex', 0);
                $('#kelas_A').prop('checked', false);
                $('#kelas_B').prop('checked', false);
                $('#kelas_C').prop('checked', false);

                $('#nim_feedback').html('');
                $('#nama_feedback').html('');
                $('#jenis_kelamin_feedback').html('');
                $('#email_feedback').html('');
                $('#tahun_angkatan_feedback').html('');
                $('#kelas_feedback').html('');
            });

            $('#btn-tambah').on('click', function (e) {
                $('#mahasiswaModalLabel').html('Tambah Mahasiswa');
                $('#mahasiswaForm').attr('action', "{{ route('kaprodi.mahasiswa.store', ['kurikulum' => $kurikulum->tahun]) }}");
                $('#btn-submit').html('Tambah').addClass('btn-success').removeClass('btn-warning');
            });

            $(document).on('click', '.btn-ubah', function(e) {
                e.preventDefault();

                const nim = $(this).data('nim');
                const route = '{{ url()->current() }}' + '/' + nim;

                $('#mahasiswaModalLabel').html('Ubah Mahasiswa');
                $('#mahasiswaForm').attr('action', route);
                $('#method_spoofing').html('{{ method_field('patch') }}');
                $('#nim').attr('readonly', true);
                $('#btn-submit').html('Ubah').addClass('btn-warning').removeClass('btn-success');

                $.ajax({
                    type: "get",
                    url: route,
                    dataType: "JSON",
                    success: function(res) {
                        console.log(res);

                        $('#nim').val(res.mahasiswa.nim);
                        $('#nama').val(res.mahasiswa.nama);

                        if (res.mahasiswa.jenis_kelamin == 'L') {
                            $('#jk_laki_laki').prop('checked', true);
                        } else {
                            $('#jk_perempuan').prop('checked', true);
                        }

                        $('#email').val(res.mahasiswa.email);
                        $('#tahun_angkatan').val(res.mahasiswa.tahun_angkatan).change();

                        if ((res.mahasiswa.kelas).slice(1, 2) == 'A') {
                            $('#kelas_A').prop('checked', true);
                        } else if ((res.mahasiswa.kelas).slice(1, 2) == 'B') {
                            $('#kelas_B').prop('checked', true);
                        } else {
                            $('#kelas_C').prop('checked', true);
                        }
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            });

            $('#mahasiswaForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    type: "post",
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: "JSON",
                    success: function(res) {
                        console.log(res)
                        mahasiswaModalInstance.hide();
                        location.reload();
                    },
                    error: function(err) {
                        console.log(err);
                        // when status code is 422, it's a validation issue
                        if (err.status == 422) {
                            if ('nim' in err.responseJSON.errors) {
                                $('#nim_feedback').html(
                                    err.responseJSON.errors.nim[0]
                                );
                            } else {
                                $('#nim_feedback').html('');
                            }

                            if ('nama' in err.responseJSON.errors) {
                                $('#nama_feedback').html(
                                    err.responseJSON.errors.nama[0]
                                );
                            } else {
                                $('#nama_feedback').html('');
                            }

                            if ('jenis_kelamin' in err.responseJSON.errors) {
                                $('#jenis_kelamin_feedback').html(
                                    err.responseJSON.errors.jenis_kelamin[0]
                                );
                            } else {
                                $('#jenis_kelamin_feedback').html('');
                            }

                            if ('email' in err.responseJSON.errors) {
                                $('#email_feedback').html(
                                    err.responseJSON.errors.email[0]
                                );
                            } else {
                                $('#email_feedback').html('');
                            }

                            if ('tahun_angkatan' in err.responseJSON.errors) {
                                $('#tahun_angkatan_feedback').html(
                                    err.responseJSON.errors.tahun_angkatan[0]
                                );
                            } else {
                                $('#tahun_angkatan_feedback').html('');
                            }

                            if ('kelas' in err.responseJSON.errors) {
                                $('#kelas_feedback').html(
                                    err.responseJSON.errors.kelas[0]
                                );
                            } else {
                                $('#kelas_feedback').html('');
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
