@extends('layouts.main')

@section('breadcrumb')
    <nav aria-label="breadcrumb mb-4">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item active" aria-current="page">{{ Breadcrumbs::render() }}</li>
        </ol>
    </nav>
    <h1>{{ $title }}</h1>
@endsection

@section('main')
    {{-- Modal 1 --}}
    <div class="modal fade" id="ubah-tujuan-pembelajaran" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Buat Tujuan Pembelajaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST"
                    action="{{ route('dosen.mata-kuliah.tujuan-pembelajaran.update', ['kodeMataKuliah' => $kodeMataKuliah, 'id' => $tp->id]) }}">
                    @csrf
                    <div class="modal-body" style="width: 100%">
                        <div class="d-flex flex-column">
                            <div class="d-flex flex-column mb-4">
                                <div class="fw-bold mb-2">Deskripsi</div>
                                <textarea class="form-control" name="deskripsi" rows="3">{{ $tp->deskripsi }}</textarea>
                            </div>
                            <div class="d-flex flex-column mb-4">
                                <div class="fw-bold mb-2">Indikator Kinerja Induk</div>
                                <select class="form-select">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <option>SS-1.{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="d-flex flex-column mb-4">
                                <div class="fw-bold mb-2">Rentang bobot berdasarkan IK induk</div>
                                <div class="">1 Sampai 3</div>
                            </div>
                            <div class="d-flex flex-column">
                                <div class="fw-bold mb-2">Bobot</div>
                                <select class="form-select">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <option <?php if ($tp->bobot == $i) {
                                            echo 'selected';
                                        } ?>>{{ $i }}</option>
                                    @endfor
                                </select>
                                <div class="">Pilih bobot berdasarkan rentang bobot yang tersedia pada IK induk</div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="d-flex flex-row" style="width: 100%">
                            <button type="button" class="btn btn-danger me-2" style="width: 50%"
                                data-bs-target="#batal-ubah-tujuan-pembelajaran" data-bs-dismiss="modal"
                                data-bs-toggle="modal">Batal</button>
                            <button type="submit" class="btn btn-success" style="width: 50%">Ajukan Persetujuan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Modal 2 --}}
    <div class="modal fade" id="batal-ubah-tujuan-pembelajaran" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Pembatalan</h5>
                </div>
                <div class="modal-body" style="width: 100%">
                    <div class="d-flex flex-column justify-content-center align-items-center" style="height: 200px">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor"
                            style="color:#F39035;" class="bi bi-exclamation-triangle-fill mb-2" viewBox="0 0 16 16">
                            <path
                                d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                        </svg>
                        <div class="">Anda yakin ingin membatalkan proses ini?</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="d-flex flex-row" style="width: 100%">
                        <button type="button" class="btn btn-danger me-2" style="width: 50%"
                            data-bs-target="#ubah-tujuan-pembelajaran" data-bs-dismiss="modal"
                            data-bs-toggle="modal">Tidak</button>
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal" aria-label="Close"
                            style="width: 50%">Ya</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex flex-row justify-content-center">
        <div class="d-flex flex-column pt-3 px-4 border border-1 rounded" style="width: 30%; height:100vh;">
            @foreach ($dataTP as $index => $data)
                <div id="{{ $tp['kode'] }}"
                    class="d-flex flex-row py-2 px-3 rounded justify-content-between mb-2 btn-tp {{ $data['kode'] == $tp['kode'] ? 'border border-1' : '' }}">
                    <div class="">{{ $data['kode'] }}</div>
                    <div class="{{ checkStatusTP($data['status_validasi']) }}">{{ $data['status_validasi'] }}</div>
                </div>
            @endforeach
        </div>
        <div id="spreadsheet"></div>
        <div class="ms-4" style="width: 70%">
            <div class="d-flex flex-column">
                <div class="d-flex flex-row mb-4 justify-content-between">
                    <div class="d-flex flex-row">
                        <div class="d-flex flex-column">
                            <div class="fw-bold">Diubah Pada</div>
                            <div class="">{{ $tp->created_at }}</div>
                        </div>
                        <div class="d-flex flex-column ms-4">
                            <div class="fw-bold">Diperbarui Pada</div>
                            <div class="">{{ $tp->updated_at }}</div>
                        </div>
                        <div class="d-flex flex-column ms-4">
                            <div class="fw-bold">Diubah Oleh</div>
                            <div class="">{{ $nama }}</div>
                        </div>
                    </div>
                    <div class="d-flex flex-row" style="height: 40px">
                        <form
                            action="{{ route('dosen.mata-kuliah.tujuan-pembelajaran.destroy', ['kodeMataKuliah' => $kodeMataKuliah, 'id' => $tp->id]) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger me-2 px-4">Hapus</button>
                        </form>
                        <button class="btn btn-warning px-4" data-bs-toggle="modal"
                            data-bs-target="#ubah-tujuan-pembelajaran">Ubah</button>
                    </div>
                </div>
                <div class="d-flex flex-column mb-4">
                    <div class="fw-bold">Deskripsi</div>
                    <div class="">{{ $tp->deskripsi }}
                    </div>
                </div>
                <div class="d-flex flex-column mb-4">
                    <div class="fw-bold">Indikator Kinerja Induk</div>
                    <div class="d-flex flex-column">
                        <div class="">SS-1.{{ $i }}</div>
                    </div>
                </div>
                <div class="d-flex flex-column">
                    <div class="fw-bold">Bobot berdasarkan Indikator Kinerja</div>
                    <div class="">1</div>
                </div>
            </div>
        </div>
    @endsection

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('.btn-tp').click(function() {
                    $('.btn-tp').removeClass('border border-1');
                    $(this).addClass('border border-1');
                });
            });
        </script>
    @endpush
