@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.dosen.index') }}
    <h1 class="fw-bold mb-0">{{ $title }}</h1>
@endsection

@section('main')
    {{-- Search --}}
    <div class="row mb-4">
        <div class="col-auto">
            <form role="search">
                <input class="form-control search" type="search" placeholder="Cari" autocomplete="off">
            </form>
        </div>
        <div class="col text-end ">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahDosenModal">Tambah
                Dosen</button>
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
                    <form action="" method="POST" autocomplete="off">
                        @csrf
                        <div class="mb-4">
                            <label for="nama_dosen" class="form-label fw-bold">Nama</label>
                            <input type="text" class="form-control" id="nama_dosen" name="nama_dosen"
                                placeholder="Nama Dosen">
                        </div>

                        <div class="mb-4">
                            <label for="nip_dosen" class="form-label fw-bold">NIP</label>
                            <input type="text" class="form-control" id="nip_dosen" name="nip_dosen"
                                placeholder="Nomor Induk Pegawai">
                        </div>

                        <div class="mb-4">
                            <label for="kode_dosen" class="form-label fw-bold">Kode dosen</label>
                            <input type="text" class="form-control" id="kode_dosen" name="kode_dosen"
                                placeholder="Kode dosen">
                        </div>

                        <div class="mb-4">
                            <label for="email_dosen" class="form-label fw-bold">Email dosen</label>
                            <input type="email" class="form-control" id="email_dosen" name="email_dosen"
                                placeholder="Email dosen">
                        </div>

                        <div>
                            <label for="domain" class="form-label fw-bold">Jurusan</label>
                            <select class="form-select" id="domain">
                                <option selected>Pilih jurusan</option>
                                <option value="1">JTK</option>
                                <option value="2">Akuntansi</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="" class="fw-bold mb-2">Role</label>
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Dosen
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked"
                                        checked>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Koordinator Program Studi
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked"
                                        checked>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        P2MPP
                                    </label>
                                </div>
                            </div>
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

    {{-- Data Dosen --}}
    <div class="row">
        <div class="col-12">
            <table class="table table-striped table-hover table-responsive table-sm">
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
                            <td class="align-middle">{{ \App\Enums\PeranDosen::getDescription($dsn->peran) }}</td>
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
            </table>
        </div>
    </div>
@endsection
