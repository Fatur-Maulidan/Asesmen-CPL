@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('dosen.index', $kurikulum) }}
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
    </div>

    {{-- Data Dosen --}}
    <div class="row">
        <div class="col-12">
            <table class="table table-striped table-hover table-responsive">
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
            </table>
        </div>
    </div>
@endsection
