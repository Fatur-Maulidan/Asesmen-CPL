@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('kaprodi.dosen.index', $kurikulum->tahun) }}
    <h1 class="fw-bold mb-0">{{ $title }}</h1>
@endsection

@section('main')
    {{-- Ubah Dosen Modal --}}
    <div class="modal fade" id="tambahDosenModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="tambahDosenModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="tambahDosenModalLabel">Ubah Dosen</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" autocomplete="off" id="tambahDosenForm">
                        @csrf
                        @method('PATCH')

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
                            <label for="kode" class="form-label fw-bold">Kode dosen</label>
                            <input type="text" class="form-control" id="kode" name="kode"
                                placeholder="Kode dosen">
                            <div id="kode_feedback" class="text-danger"></div>
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
                            <div id="status_feedback" class="text-danger"></div>
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
                                id="btn-submit">Ubah</button>
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
            {{-- <table class="table table-striped table-hover table-responsive">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">NIP</th>
                        <th scope="col">Kode Dosen</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email Polban</th>
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
                            <td class="align-middle">{{ $dsn['nip'] }}</td>
                            <td class="align-middle">{{ $dsn['kode'] }}</td>
                            <td class="align-middle">{{ Str::title($dsn['nama']) }}</td>
                            <td class="align-middle">{{ $dsn['email'] }}</td>
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
            $(document).on('click', '.btn-hapus', function(e) {
                e.preventDefault();

                const id = $(this).data('id');
                $('#hapusDosenForm').attr('action', "{{ url()->current() }}/" + id);
            });

            const tambahDosennModal = document.getElementById('tambahDosennModal');
            const tambahDosenModalInstance = new bootstrap.Modal('#tambahDosenModal');

            tambahDosenModal.addEventListener('hidden.bs.modal', event => {
                $('#nama').val('');
                $('#nip').val('');
                $('#kode').val('');
                $('#jk_laki').prop('checked', false);
                $('#jk_perempuan').prop('checked', false);
                $('#email').val('');

                $('#nama_feedback').html('');
                $('#nip_feedback').html('');
                $('#kode_feedback').html('');
                $('#jenis_kelamin_feedback').html('');
                $('#email_feedback').html('');
            });

            $(document).on('click', '.btn-ubah', function(e) {
                e.preventDefault();

                const id = $(this).data('id');
                const url = "{{ url()->current() }}/" + id;

                $.ajax({
                    type: "get",
                    url: url,
                    dataType: "JSON",
                    success: function(res) {
                        console.log(res);

                        $('#nip').val(res.dosen.nip);
                        $('#nama').val(res.dosen.nama);
                        $('#kode').val(res.dosen.kode);
                        (res.dosen.jenis_kelamin ==
                            '{{ \App\Enums\JenisKelamin::LakiLaki }}') ?
                        $('#jk_laki').prop('checked', true): $('#jk_perempuan').prop('checked',
                            true);
                        $('#email').val(res.dosen.email);
                        if (res.dosen.status == 'Aktif') {
                            $('#aktif').prop('checked', true);
                        } else {
                            $('#nonaktif').prop('checked', true);
                        }
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });

                $('#tambahDosenForm').attr('action', "{{ url()->current() }}/" + id);
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

                            if ('nip' in err.responseJSON.errors) {
                                $('#nip_feedback').html(err.responseJSON.errors
                                    .nip[0]);
                            } else {
                                $('#nip_feedback').html('');
                            }

                            if ('nama' in err.responseJSON.errors) {
                                $('#nama_feedback').html(err.responseJSON.errors
                                    .nama[0]);
                            } else {
                                $('#nama_feedback').html('');
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

                            if ('status' in err.responseJSON.errors) {
                                $('#status_feedback').html(err.responseJSON.errors
                                    .status[0]);
                            } else {
                                $('#status_feedback').html('');
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
