@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('kaprodi.mata-kuliah.show', $kurikulum->tahun, $detail_mata_kuliah->kode . ' - ' . $detail_mata_kuliah->nama, $detail_mata_kuliah->kode) }}
    <h1 class="fw-bold mb-0">{{ $detail_mata_kuliah['kode'] . ' - ' . $detail_mata_kuliah['nama'] }}</h1>
@endsection

@section('main')
    <?php $modal = ''; ?>
    <div class="row">
        {{-- Sidebar --}}
        @include('kaprodi.mk.sidebar')

        {{-- pemetaan Modal --}}
        <div class="modal modal-lg fade" id="pemetaanModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="pemetaanModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form method="POST"
                        action="{{ route('kaprodi.mata-kuliah.pemetaan', ['kurikulum' => $kurikulum->tahun, 'mata_kuliah' => $detail_mata_kuliah->id]) }}"
                        autocomplete="off">
                        @csrf
                        @method('PATCH')
                        <div class="modal-header">
                            <div>
                                <div class="text-muted fs-6">Proses 1 dari 2</div>
                                <h1 class="modal-title fs-5 fw-bold" id="pemetaanModalLabel">Pemetaan Mata Kuliah dengan
                                    Indikator
                                    Kinerja</h1>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="mb-3">
                                <div class="fw-bold mb-3">Pilih Indikator Kinerja yang revelan dengan Mata Kuliah</div>
                                <div class="accordion accordion-flush" id="ikList">

                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button fw-bold bg-light collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#ikSikap" aria-expanded="false"
                                                aria-controls="ikSikap">
                                                Sikap (SP)
                                            </button>
                                        </h2>
                                        @foreach ($indikator_kinerja as $ik)
                                            @if ($ik->capaianPembelajaranLulusan->domain == 'Sikap')
                                                <div id="ikSikap" class="accordion-collapse collapse"
                                                    data-bs-parent="#ikList">
                                                    <div class="accordion-body">
                                                        <div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="checkbox[]" value="{{ $ik->kode }}"
                                                                    id="flexCheckDefault"
                                                                    {{ in_array($ik->kode, $selected_data_ik) ? 'checked' : '' }}>
                                                                <label class="form-check-label fw-bold"
                                                                    for="flexCheckDefault">
                                                                    {{ $ik->kode }}
                                                                </label>
                                                            </div>
                                                            <p>{{ $ik->deskripsi }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button fw-bold bg-light collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#ikPengetahuan"
                                                aria-expanded="false" aria-controls="ikPengetahuan">
                                                Pengetahuan (P)
                                            </button>
                                        </h2>
                                        @foreach ($indikator_kinerja as $ik)
                                            @if ($ik->capaianPembelajaranLulusan->domain == 'Pengetahuan')
                                                <div id="ikPengetahuan" class="accordion-collapse collapse"
                                                    data-bs-parent="#ikList">
                                                    <div class="accordion-body">
                                                        <div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="checkbox[]" value="{{ $ik->kode }}"
                                                                    id="flexCheckDefault"
                                                                    {{ in_array($ik->kode, $selected_data_ik) ? 'checked' : '' }}>
                                                                <label class="form-check-label fw-bold"
                                                                    for="flexCheckDefault">
                                                                    {{ $ik->kode }}
                                                                </label>
                                                            </div>
                                                            <p>{{ $ik->deskripsi }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button fw-bold bg-light collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#ikKeterampilanUmum"
                                                aria-expanded="false" aria-controls="ikKeterampilanUmum">
                                                Keterampilan Umum (KU)
                                            </button>
                                        </h2>
                                        @foreach ($indikator_kinerja as $ik)
                                            @if ($ik->capaianPembelajaranLulusan->domain == 'Keterampilan Umum')
                                                <div id="ikKeterampilanUmum" class="accordion-collapse collapse"
                                                    data-bs-parent="#ikList">
                                                    <div class="accordion-body">
                                                        <div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="checkbox[]" value="{{ $ik->kode }}"
                                                                    id="flexCheckDefault"
                                                                    {{ in_array($ik->kode, $selected_data_ik) ? 'checked' : '' }}>
                                                                <label class="form-check-label fw-bold"
                                                                    for="flexCheckDefault">
                                                                    {{ $ik->kode }}
                                                                </label>
                                                            </div>
                                                            <p>{{ $ik->deskripsi }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button fw-bold bg-light collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#ikKeterampilanKhusus"
                                                aria-expanded="false" aria-controls="ikKeterampilanKhusus">
                                                Keterampilan Khusus (KK)
                                            </button>
                                        </h2>
                                        @foreach ($indikator_kinerja as $ik)
                                            @if ($ik->capaianPembelajaranLulusan->domain == 'Keterampilan Khusus')
                                                <div id="ikKeterampilanKhusus" class="accordion-collapse collapse"
                                                    data-bs-parent="#ikList">
                                                    <div class="accordion-body">
                                                        <div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="checkbox[]" value="{{ $ik->kode }}"
                                                                    id="flexCheckDefault"
                                                                    {{ in_array($ik->kode, $selected_data_ik) ? 'checked' : '' }}>
                                                                <label class="form-check-label fw-bold"
                                                                    for="flexCheckDefault">
                                                                    {{ $ik->kode }}
                                                                </label>
                                                            </div>
                                                            <p>{{ $ik->deskripsi }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="row w-100">
                                <div class="col">
                                    <button type="button" class="btn btn-danger w-100"
                                        data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Batal</button>
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-primary w-100">Petakan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Edit Modal --}}
        <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content">
                    <form method="POST"
                        action="{{ route('kaprodi.mata-kuliah.update', ['kurikulum' => $kurikulum->tahun, 'mata_kuliah' => $detail_mata_kuliah->id]) }}">
                        @csrf
                        @method('PATCH')
                        <div class="modal-header">
                            <h1 class="modal-title fs-5 fw-bold" id="editModalLabel">Ubah Mata Kuliah</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="mb-3">
                                <label for="kode" class="form-label fw-bold">Kode</label>
                                <input type="text" class="form-control" id="kode" name="kode"
                                    placeholder="Kode mata kuliah" value="{{ $detail_mata_kuliah->kode }}">
                                <div id="kode_feedback" class="text-danger"></div>
                            </div>

                            <div class="mb-3">
                                <label for="nama" class="form-label fw-bold">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    placeholder="Nama mata kuliah" value="{{ $detail_mata_kuliah->nama }}">
                                <div id="nama_feedback" class="text-danger"></div>
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3">{{ $detail_mata_kuliah->deskripsi }}</textarea>
                                <div id="deskripsi_feedback" class="text-danger"></div>
                            </div>

                            <div class="">
                                <label for="jumlah_sks" class="form-label fw-bold">Jumlah SKS</label>
                                <input type="number" class="form-control" id="jumlah_sks" name="jumlah_sks"
                                    placeholder="Jumlah SKS mata kuliah" value="{{ $detail_mata_kuliah->jumlah_sks }}">
                                <div id="jumlah_sks_feedback" class="text-danger"></div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <div class="row w-100">
                                <div class="col">
                                    <button type="button" class="btn btn-danger w-100"
                                        data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Batal</button>
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-success w-100 btn-ubah">Ubah</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Tahun Akademik Baru Modal 1 --}}
        <div class="modal fade" id="tahunAkademikBaruModal1" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="tahunAkademikBaruModal1Label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 fw-bold" id="tahunAkademikBaruModal1Label">Tahun Akademik Baru</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" autocomplete="off" id="tahunAkademik1Form">
                            @csrf
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="exampleFormControlInput1" class="form-label fw-bold">Tahun mulai</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Pilih tahun mulai</option>
                                        <option value="1">2024</option>
                                        <option value="2">2023</option>
                                        <option value="3">2022</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="exampleFormControlInput2" class="form-label fw-bold">Tahun selesai</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Pilih tahun selesai</option>
                                        <option value="1">2028</option>
                                        <option value="2">2027</option>
                                        <option value="3">2026</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput2" class="form-label fw-bold">Semester</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Pilih semester</option>
                                    <option value="1">2028</option>
                                    <option value="2">2027</option>
                                    <option value="3">2026</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput2" class="form-label fw-bold">Angkatan mahasiswa
                                    terdaftar</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Pilih tahun masuk mahasiswa</option>
                                    <option value="1">2028</option>
                                    <option value="2">2027</option>
                                    <option value="3">2026</option>
                                </select>
                            </div>

                            <div>
                                <label for="" class="form-label fw-bold">Dosen pengampu</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Default checkbox
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked"
                                        checked>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Checked checkbox
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked"
                                        checked>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Checked checkbox
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked"
                                        checked>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Checked checkbox
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked"
                                        checked>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Checked checkbox
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <div class="row w-100">
                            <div class="col">
                                <button type="button" class="btn btn-danger w-100" data-bs-target="#exampleModalToggle2"
                                    data-bs-toggle="modal">Batal</button>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-primary w-100"
                                    data-bs-target="#tahunAkademikBaruModal2" data-bs-toggle="modal"
                                    id="tahunAkademikBaru2">Lanjut</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tahun Akademik Baru Modal 2 --}}
        <div class="modal fade" id="tahunAkademikBaruModal2" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="tahunAkademikBaruModal2Label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 fw-bold" id="tahunAkademikBaruModal2Label">Tahun Akademik Baru</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="">
                            <div class="mb-3">
                                <p class="mb-0"><i class="bi bi-exclamation-circle me-2"></i>Pilih rentang waktu untuk
                                    masa penyusunan Tujuan Pembelajaran.</p>
                            </div>

                            <div class="mb-3">
                                <label for="dateStart" class="form-label fw-bold">Tanggal mulai</label>
                                <input type="date" class="form-control" id="dateStart">
                            </div>

                            <div>
                                <label for="dateEnd" class="form-label fw-bold">Tanggal selesai</label>
                                <input type="date" class="form-control" id="dateEnd">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <div class="row w-100">
                            <div class="col-4">
                                <button type="button" class="btn btn-danger w-100" data-bs-target="#exampleModalToggle2"
                                    data-bs-toggle="modal">Batal</button>
                            </div>
                            <div class="col-4">
                                <button type="button" class="btn btn-primary w-100">Kembali</button>
                            </div>
                            <div class="col-4">
                                <button type="button" class="btn btn-success w-100">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Confirm modal --}}
        <div class="modal fade" id="exampleModalToggle2" data-bs-backdrop="static" data-bs-keyboard="false"
            aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Konfirmasi Pembatalan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-4">
                        <div class="text-center">
                            <i class="bi bi-exclamation-triangle-fill text-warning fs-1"></i>
                            <div>Anda yakin ingin membatalkan proses ini?</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row w-100">
                            <div class="col">
                                <button type="button" class="btn btn-danger w-100" id="modalButton"
                                    data-bs-toggle="modal">Tidak</button>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-success w-100" data-bs-dismiss="modal">Ya</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Detail --}}
        <div class="col-9">
            <div class="row mb-3">
                <div class="col d-flex">
                    <div class="me-4">
                        <div class="fw-bold">Dibuat pada</div>
                        <div>{{ $detail_mata_kuliah->created_at->format('d-F-Y H:i') }}</div>
                    </div>
                    <div class="me-4">
                        <div class="fw-bold">Diperbarui pada</div>
                        {{-- <div>{{ $detail_mata_kuliah->updated_at->format('d-F-Y H:i') }}</div> --}}
                    </div>
                    {{--                    <div> --}}
                    {{--                        <div class="fw-bold">Diubah oleh</div> --}}
                    {{--                        <div>Jhon Doe</div> --}}
                    {{--                    </div> --}}
                </div>
                <div class="col-auto">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#pemetaanModal" id="pemetaan"
                        class="btn btn-outline-primary ">Pemetaan</button>
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                        data-bs-target="#tahunAkademikBaruModal1" id="tahunAkademikBaru1">Tahun Akademik
                        Baru</button>
                    {{-- Button trigger modal --}}
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal"
                        id="ubah">
                        Ubah
                    </button>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <div class="fw-bold">Deskripsi</div>
                    <p class="mb-0">{{ $detail_mata_kuliah->deskripsi }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col d-flex align-items-start ">
                    <div class="me-4">
                        <div class="fw-bold">Jumlah SKS</div>
                        <div>{{ $detail_mata_kuliah->jumlah_sks }}</div>
                    </div>
                    <span class="badge text-bg-primary me-2">Teori</span>
                    <span class="badge text-bg-primary">Praktikum</span>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="fw-bold mb-3">Dosen pengampu berdasarkan tahun akademik</div>
                    {{--                    <div class="accordion" id="accordionExample2"> --}}
                    {{--                        <div class="accordion-item"> --}}
                    {{--                            <h2 class="accordion-header"> --}}
                    {{--                                <button class="accordion-button fw-bold bg-light" type="button" --}}
                    {{--                                    data-bs-toggle="collapse" data-bs-target="#collapseOne2" aria-expanded="true" --}}
                    {{--                                    aria-controls="collapseOne2"> --}}
                    {{--                                    Tahun akademik 2021 / 2022 --}}
                    {{--                                </button> --}}
                    {{--                            </h2> --}}
                    {{--                            <div id="collapseOne2" class="accordion-collapse collapse show" --}}
                    {{--                                data-bs-parent="#accordionExample2"> --}}
                    {{--                                <div class="accordion-body"> --}}
                    {{--                                    <div> --}}
                    {{--                                        <div class="fw-bold">Dosen pengampu</div> --}}
                    {{--                                        <ul class="mb-0"> --}}
                    {{--                                            <li>KO009N - Santi Sundari</li> --}}
                    {{--                                            <li>KO052N - Yadhi Aditya P.</li> --}}
                    {{--                                            <li>KO060N - Ade Hodijah</li> --}}
                    {{--                                        </ul> --}}
                    {{--                                    </div> --}}
                    {{--                                </div> --}}
                    {{--                            </div> --}}
                    {{--                        </div> --}}
                    {{--                        <div class="accordion-item"> --}}
                    {{--                            <h2 class="accordion-header"> --}}
                    {{--                                <button class="accordion-button fw-bold bg-light collapsed" type="button" --}}
                    {{--                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo2" aria-expanded="false" --}}
                    {{--                                    aria-controls="collapseTwo2"> --}}
                    {{--                                    Tahun akademik 2022 / 2023 --}}
                    {{--                                </button> --}}
                    {{--                            </h2> --}}
                    {{--                            <div id="collapseTwo2" class="accordion-collapse collapse" --}}
                    {{--                                data-bs-parent="#accordionExample2"> --}}
                    {{--                                <div class="accordion-body"> --}}
                    {{--                                    <div> --}}
                    {{--                                        <div class="fw-bold">Dosen pengampu</div> --}}
                    {{--                                        <ul class="mb-0"> --}}
                    {{--                                            <li>KO009N - Santi Sundari</li> --}}
                    {{--                                            <li>KO052N - Yadhi Aditya P.</li> --}}
                    {{--                                            <li>KO060N - Ade Hodijah</li> --}}
                    {{--                                        </ul> --}}
                    {{--                                    </div> --}}
                    {{--                                </div> --}}
                    {{--                            </div> --}}
                    {{--                        </div> --}}
                    {{--                        <div class="accordion-item"> --}}
                    {{--                            <h2 class="accordion-header"> --}}
                    {{--                                <button class="accordion-button fw-bold bg-light collapsed" type="button" --}}
                    {{--                                    data-bs-toggle="collapse" data-bs-target="#collapseThree2" aria-expanded="false" --}}
                    {{--                                    aria-controls="collapseThree2"> --}}
                    {{--                                    Tahun akademik 2023 / 2024 --}}
                    {{--                                </button> --}}
                    {{--                            </h2> --}}
                    {{--                            <div id="collapseThree2" class="accordion-collapse collapse" --}}
                    {{--                                data-bs-parent="#accordionExample2"> --}}
                    {{--                                <div class="accordion-body"> --}}
                    {{--                                    <div> --}}
                    {{--                                        <div class="fw-bold">Dosen pengampu</div> --}}
                    {{--                                        <ul class="mb-0"> --}}
                    {{--                                            <li>KO009N - Santi Sundari</li> --}}
                    {{--                                            <li>KO052N - Yadhi Aditya P.</li> --}}
                    {{--                                            <li>KO060N - Ade Hodijah</li> --}}
                    {{--                                        </ul> --}}
                    {{--                                    </div> --}}
                    {{--                                </div> --}}
                    {{--                            </div> --}}
                    {{--                        </div> --}}
                    {{--                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        var modal = '';
        $(document).ready(function() {
            $('#editForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    type: "post",
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: "JSON",
                    success: function(res) {
                        console.log(res);
                        location.reload();
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            });
        });

        $(document).ready(function() {
            $('#pemetaan').on('click', function() {
                modal = "pemetaanModal";
                $('#modalButton').attr('data-bs-target', '#' + modal);
            });
            $('#tahunAkademikBaru1').on('click', function() {
                modal = "tahunAkademikBaruModal1";
                $('#modalButton').attr('data-bs-target', '#' + modal);
            });
            $('#tahunAkademikBaru2').on('click', function() {
                modal = "tahunAkademikBaruModal2";
                $('#modalButton').attr('data-bs-target', '#' + modal);
            });
            $('#ubah').on('click', function() {
                modal = "editModal";
                $('#modalButton').attr('data-bs-target', '#' + modal);
            });
        });
    </script>
@endpush
