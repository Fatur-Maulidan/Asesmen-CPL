@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('mk.show', $kurikulum, $mk) }}
    <h1 class="fw-bold mb-0">{{ $mk['kode'] . ' - ' . $mk['nama'] }}</h1>
@endsection

@section('main')
    <div class="row">
        {{-- Sidebar --}}
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <a href="" class="btn btn-light w-100 text-start active">21IF001 - Dasar Dasar Pemrograman</a>
                    </div>

                    <div class="mb-3">
                        <a href="" class="btn btn-light w-100 text-start">21IF002 - Pengantar Teknologi Informasi</a>
                    </div>

                    <div class="mb-3">
                        <a href="" class="btn btn-light w-100 text-start">21IF003 - Proyek 1 : Pemanfaatan Aplikasi
                            Perkantoran</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Pembobotan Modal --}}
        <div class="modal modal-lg fade" id="pembobotanModal" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="pembobotanModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <div>
                            <div class="text-muted fs-6">Proses 1 dari 2</div>
                            <h1 class="modal-title fs-5 fw-bold" id="pembobotanModalLabel">Pemetaan Mata Kuliah dengan
                                Indikator
                                Kinerja</h1>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="">
                            <div class="mb-3">
                                <div class="fw-bold mb-3">Pilih Indikator Kinerja yang revelan dengan Mata Kuliah</div>
                                <div class="accordion" id="ikList">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button fw-bold bg-light" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#ikSikap" aria-expanded="true"
                                                aria-controls="ikSikap">
                                                Sikap (S)
                                            </button>
                                        </h2>
                                        <div id="ikSikap" class="accordion-collapse collapse show"
                                            data-bs-parent="#ikList">
                                            <div class="accordion-body">
                                                <div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="flexCheckDefault">
                                                        <label class="form-check-label fw-bold" for="flexCheckDefault">
                                                            S-1
                                                        </label>
                                                    </div>
                                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui ipsum
                                                        assumenda
                                                        perferendis id! Quidem ipsa nulla esse, voluptates facilis ipsum.
                                                    </p>
                                                </div>
                                                <div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="flexCheckChecked" checked>
                                                        <label class="form-check-label fw-bold" for="flexCheckChecked">
                                                            S-2
                                                        </label>
                                                    </div>
                                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo harum
                                                        id libero rem
                                                        cumque incidunt dicta assumenda corporis praesentium quo?</p>
                                                </div>
                                                <div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="flexCheckChecked" checked>
                                                        <label class="form-check-label fw-bold" for="flexCheckChecked">
                                                            S-3
                                                        </label>
                                                    </div>
                                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo harum
                                                        id libero rem
                                                        cumque incidunt dicta assumenda corporis praesentium quo?</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button fw-bold bg-light collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#ikPengetahuan"
                                                aria-expanded="false" aria-controls="ikPengetahuan">
                                                Pengetahuan (P)
                                            </button>
                                        </h2>
                                        <div id="ikPengetahuan" class="accordion-collapse collapse"
                                            data-bs-parent="#ikList">
                                            <div class="accordion-body">
                                                <div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="flexCheckDefault">
                                                        <label class="form-check-label fw-bold" for="flexCheckDefault">
                                                            S-1
                                                        </label>
                                                    </div>
                                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui ipsum
                                                        assumenda
                                                        perferendis id! Quidem ipsa nulla esse, voluptates facilis ipsum.
                                                    </p>
                                                </div>
                                                <div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="flexCheckChecked" checked>
                                                        <label class="form-check-label fw-bold" for="flexCheckChecked">
                                                            S-2
                                                        </label>
                                                    </div>
                                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo harum
                                                        id libero rem
                                                        cumque incidunt dicta assumenda corporis praesentium quo?</p>
                                                </div>
                                                <div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="flexCheckChecked" checked>
                                                        <label class="form-check-label fw-bold" for="flexCheckChecked">
                                                            S-3
                                                        </label>
                                                    </div>
                                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo harum
                                                        id libero rem
                                                        cumque incidunt dicta assumenda corporis praesentium quo?</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button fw-bold bg-light collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#ikKeterampilanUmum"
                                                aria-expanded="false" aria-controls="ikKeterampilanUmum">
                                                Keterampilan Umum (KU)
                                            </button>
                                        </h2>
                                        <div id="ikKeterampilanUmum" class="accordion-collapse collapse"
                                            data-bs-parent="#ikList">
                                            <div class="accordion-body">
                                                <div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="flexCheckDefault">
                                                        <label class="form-check-label fw-bold" for="flexCheckDefault">
                                                            S-1
                                                        </label>
                                                    </div>
                                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui ipsum
                                                        assumenda
                                                        perferendis id! Quidem ipsa nulla esse, voluptates facilis ipsum.
                                                    </p>
                                                </div>
                                                <div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="flexCheckChecked" checked>
                                                        <label class="form-check-label fw-bold" for="flexCheckChecked">
                                                            S-2
                                                        </label>
                                                    </div>
                                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo harum
                                                        id libero rem
                                                        cumque incidunt dicta assumenda corporis praesentium quo?</p>
                                                </div>
                                                <div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="flexCheckChecked" checked>
                                                        <label class="form-check-label fw-bold" for="flexCheckChecked">
                                                            S-3
                                                        </label>
                                                    </div>
                                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo harum
                                                        id libero rem
                                                        cumque incidunt dicta assumenda corporis praesentium quo?</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button fw-bold bg-light collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#ikKeterampilanKhusus"
                                                aria-expanded="false" aria-controls="ikKeterampilanKhusus">
                                                Keterampilan Khusus (KK)
                                            </button>
                                        </h2>
                                        <div id="ikKeterampilanKhusus" class="accordion-collapse collapse"
                                            data-bs-parent="#ikList">
                                            <div class="accordion-body">
                                                <div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="flexCheckDefault">
                                                        <label class="form-check-label fw-bold" for="flexCheckDefault">
                                                            S-1
                                                        </label>
                                                    </div>
                                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui ipsum
                                                        assumenda
                                                        perferendis id! Quidem ipsa nulla esse, voluptates facilis ipsum.
                                                    </p>
                                                </div>
                                                <div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="flexCheckChecked" checked>
                                                        <label class="form-check-label fw-bold" for="flexCheckChecked">
                                                            S-2
                                                        </label>
                                                    </div>
                                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo harum
                                                        id libero rem
                                                        cumque incidunt dicta assumenda corporis praesentium quo?</p>
                                                </div>
                                                <div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="flexCheckChecked" checked>
                                                        <label class="form-check-label fw-bold" for="flexCheckChecked">
                                                            S-3
                                                        </label>
                                                    </div>
                                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo harum
                                                        id libero rem
                                                        cumque incidunt dicta assumenda corporis praesentium quo?</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                <button type="button" class="btn btn-primary w-100">Berikutnya</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Edit Modal --}}
        <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 fw-bold" id="editModalLabel">Ubah Mata Kuliah</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label fw-bold">Nama</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Nama mata kuliah">
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput2" class="form-label fw-bold">Kode</label>
                                <input type="text" class="form-control" id="exampleFormControlInput2"
                                    placeholder="Kode mata kuliah">
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label fw-bold">Deskripsi</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput3" class="form-label fw-bold">Jumlah SKS</label>
                                <input type="number" class="form-control" id="exampleFormControlInput3"
                                    placeholder="Jumlah SKS mata kuliah">
                            </div>

                            <div class="mb-3">
                                <label for="domain" class="form-label fw-bold">Sifat Pengambilan</label>
                                <select class="form-select" id="domain">
                                    <option selected>Pilih sifat pegambilan</option>
                                    <option value="1">Sikap (S)</option>
                                    <option value="2">Pengetahuan (P)</option>
                                    <option value="3">Keterampilan Umum (KU)</option>
                                    <option value="4">Keterampilan Khusus (KK)</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="domain" class="form-label fw-bold">Metode Pembelajaran</label>
                                <select class="form-select" id="domain">
                                    <option selected>Pilih sifat pegambilan</option>
                                    <option value="1">Sikap (S)</option>
                                    <option value="2">Pengetahuan (P)</option>
                                    <option value="3">Keterampilan Umum (KU)</option>
                                    <option value="4">Keterampilan Khusus (KK)</option>
                                </select>
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
                                <button type="button" class="btn btn-success w-100">Ubah</button>
                            </div>
                        </div>
                    </div>
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
                        <form action="">
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
                                    data-bs-target="#tahunAkademikBaruModal2" data-bs-toggle="modal">Lanjut</button>
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
                                <button type="button" class="btn btn-danger w-100" data-bs-target="#staticBackdrop"
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
                        <div class="fw-bold">Diubah pada</div>
                        <div>01 Januari 2024 01:18</div>
                    </div>
                    <div class="me-4">
                        <div class="fw-bold">Diperbarui pada</div>
                        <div>01 Januari 2024 01:18</div>
                    </div>
                    <div>
                        <div class="fw-bold">Diubah oleh</div>
                        <div>Jhon Doe</div>
                    </div>
                </div>
                <div class="col-auto">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#pembobotanModal"
                        class="btn btn-outline-primary ">Pembobotan</button>
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                        data-bs-target="#tahunAkademikBaruModal1">Tahun Akademik Baru</button>
                    {{-- Button trigger modal --}}
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal">
                        Ubah
                    </button>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <div class="fw-bold">Deskripsi</div>
                    <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad officiis praesentium hic
                        nihil vel non
                        recusandae tempora id cum repellat!</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col d-flex align-items-start ">
                    <div class="me-4">
                        <div class="fw-bold">Jumlah SKS</div>
                        <div>4</div>
                    </div>
                    <span class="badge text-bg-primary me-4">Teori</span>
                    <span class="badge text-bg-primary">Praktikum</span>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="fw-bold mb-3">Dosen pengampu berdasarkan tahun akademik</div>
                    <div class="accordion" id="accordionExample2">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button fw-bold bg-light" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseOne2" aria-expanded="true"
                                    aria-controls="collapseOne2">
                                    Tahun akademik 2021 / 2022
                                </button>
                            </h2>
                            <div id="collapseOne2" class="accordion-collapse collapse show"
                                data-bs-parent="#accordionExample2">
                                <div class="accordion-body">
                                    <div>
                                        <div class="fw-bold">Dosen pengampu</div>
                                        <ul class="mb-0">
                                            <li>KO009N - Santi Sundari</li>
                                            <li>KO052N - Yadhi Aditya P.</li>
                                            <li>KO060N - Ade Hodijah</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button fw-bold bg-light collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo2" aria-expanded="false"
                                    aria-controls="collapseTwo2">
                                    Tahun akademik 2022 / 2023
                                </button>
                            </h2>
                            <div id="collapseTwo2" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample2">
                                <div class="accordion-body">
                                    <div>
                                        <div class="fw-bold">Dosen pengampu</div>
                                        <ul class="mb-0">
                                            <li>KO009N - Santi Sundari</li>
                                            <li>KO052N - Yadhi Aditya P.</li>
                                            <li>KO060N - Ade Hodijah</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button fw-bold bg-light collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseThree2" aria-expanded="false"
                                    aria-controls="collapseThree2">
                                    Tahun akademik 2023 / 2024
                                </button>
                            </h2>
                            <div id="collapseThree2" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample2">
                                <div class="accordion-body">
                                    <div>
                                        <div class="fw-bold">Dosen pengampu</div>
                                        <ul class="mb-0">
                                            <li>KO009N - Santi Sundari</li>
                                            <li>KO052N - Yadhi Aditya P.</li>
                                            <li>KO060N - Ade Hodijah</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
