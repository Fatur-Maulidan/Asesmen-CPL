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
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahMahasiswaModal">
                Tambah Mahasiswa
            </button>
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
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

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
                    <form method="POST" action="{{ route('kaprodi.mahasiswa.store', ['kurikulum' => $kurikulum]) }}">
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label fw-bold">Nama</label>
                            <input type="text" class="form-control" id="nama" placeholder="Nama mahasiswa">
                        </div>

                        <div class="mb-3">
                            <label for="nim" class="form-label fw-bold">NIM</label>
                            <input type="text" class="form-control" id="nim" placeholder="NIM mahasiswa">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Email mahasiswa">
                        </div>

                        <div class="mb-3">
                            <label for="" class="fw-bold">Tahun masuk</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Pilih tahun masuk</option>
                                <option value="1">2024</option>
                                <option value="2">2023</option>
                                <option value="3">2022</option>
                            </select>
                        </div>

                        <div>
                            <label for="" class="fw-bold">Kelas</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Pilih kelas</option>
                                <option value="1">A</option>
                                <option value="2">B</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row w-100">
                            <div class="col">
                                <button type="button" class="btn btn-danger w-100">Batal</button>
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
                    <h1 class="modal-title fs-5 fw-bold" id="ubahMahasiswaModalLabel">Tambah Mahasiswa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="mb-3">
                            <label for="nama" class="form-label fw-bold">Nama</label>
                            <input type="text" class="form-control" id="nama" placeholder="Nama mahasiswa"
                                value="{{ $mahasiswa[0]['nama'] }}">
                        </div>

                        <div class="mb-3">
                            <label for="nim" class="form-label fw-bold">NIM</label>
                            <input type="text" class="form-control" id="nim" placeholder="NIM mahasiswa"
                                value="{{ $mahasiswa[0]['nim'] }}">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Email mahasiswa"
                                value="test.email@polban.ac.id">
                        </div>

                        <div class="mb-3">
                            <label for="" class="fw-bold">Tahun masuk</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Pilih tahun masuk</option>
                                <option value="1">2024</option>
                                <option value="2">2023</option>
                                <option value="3" selected>2022</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="" class="fw-bold">Kelas</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Pilih kelas</option>
                                <option value="1" selected>A</option>
                                <option value="2">B</option>
                            </select>
                        </div>

                        <div>
                            <label for="" class="fw-bold d-block">Status kemahasiswaan</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                    id="inlineRadio1" value="option1" checked>
                                <label class="form-check-label" for="inlineRadio1">Aktif</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                    id="inlineRadio2" value="option2">
                                <label class="form-check-label" for="inlineRadio2">Nonaktif</label>
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

    {{-- Data Mahasiswa --}}
    <div class="row">
        <div class="col-12">
            <table class="table table-striped table-hover table-responsive">
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
            </table>
        </div>
    </div>
@endsection
