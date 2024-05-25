@extends('layouts.main')

@section('breadcrumb')
    {{-- {{ Breadcrumbs::render('cpl.show') }} --}}
@endsection

@section('main')
    <div class="row">
        {{-- Sidebar --}}
        <div class="col-4">
            <button type="button" class="btn btn-outline-primary w-100 mb-4">Ekspor</button>
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold bg-light" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Sikap (S)<span class="badge text-bg-primary ms-2">8</span>
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="mb-3">
                                <a href="" class="btn btn-light w-100 text-start active">S-1</a>
                            </div>

                            <div class="mb-3">
                                <a href="" class="btn btn-light text-start w-100">S-2</a>
                            </div>

                            <div class="mb-3">
                                <a href="" class="btn btn-light text-start w-100">S-3</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold bg-light collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Pengetahuan (P)<span class="badge text-bg-primary ms-2">12</span>
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="mb-3">
                                <a href="" class="btn btn-light text-start w-100">P-1</a>
                            </div>

                            <div class="mb-3">
                                <a href="" class="btn btn-light text-start w-100">P-2</a>
                            </div>

                            <div class="mb-3">
                                <a href="" class="btn btn-light text-start w-100">P-3</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold bg-light collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            KU (Keterampilan Umum)<span class="badge text-bg-primary ms-2">10</span>
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="mb-3">
                                <a href="" class="btn btn-light text-start w-100">KU-1</a>
                            </div>

                            <div class="mb-3">
                                <a href="" class="btn btn-light text-start w-100">KU-2</a>
                            </div>

                            <div class="mb-3">
                                <a href="" class="btn btn-light text-start w-100">KU-3</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold bg-light collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            KK (Keterampilan Khusus)<span class="badge text-bg-primary ms-2">15</span>
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="mb-3">
                                <a href="" class="btn btn-light text-start w-100">KK-1</a>
                            </div>

                            <div class="mb-3">
                                <a href="" class="btn btn-light text-start w-100">KK-2</a>
                            </div>

                            <div class="mb-3">
                                <a href="" class="btn btn-light text-start w-100">KK-3</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Detail --}}
        <div class="col-8">
            <div class="row mb-3">
                <div class="col">
                    <div class="fw-bold">Pilih mata kuliah beserta tingkat relevansinya pada CP untuk melakukan pemetaan
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <div>1: sedikit relevan; 2: relevan; 3: sangat relevan</div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th scope="col" width="65%">Mata Kuliah</th>
                                <th scope="col">Tingkat Relevansi</th>
                                <th scope="col" width="15%">Bobot</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-3">
                                    <select class="form-select">
                                        <option value="1" selected>21IF001 - Dasar Dasar Pemrograman</option>
                                        <option value="2">21IF002 - Pengantar Teknologi Informasi dan Komputer
                                        </option>
                                        <option value="3">21IF003 - Proyek 1 : Pemanfaatan Aplikasi Perkantoran
                                        </option>
                                    </select>
                                </td>
                                <td class="py-3">
                                    <select class="form-select">
                                        <option value="1" selected>1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </td>
                                <td class="py-3">11%</td>
                            </tr>
                            <tr>
                                <td class="py-3">
                                    <select class="form-select">
                                        <option value="1">21IF001 - Dasar Dasar Pemrograman</option>
                                        <option value="2" selected>21IF002 - Pengantar Teknologi Informasi dan
                                            Komputer</option>
                                        <option value="3">21IF003 - Proyek 1 : Pemanfaatan Aplikasi Perkantoran
                                        </option>
                                    </select>
                                </td>
                                <td class="py-3">
                                    <select class="form-select">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3" selected>3</option>
                                    </select>
                                </td>
                                <td class="py-3">44,5%</td>
                            </tr>
                            <tr>
                                <td class="py-3">
                                    <select class="form-select">
                                        <option value="1">21IF001 - Dasar Dasar Pemrograman</option>
                                        <option value="2">21IF002 - Pengantar Teknologi Informasi dan Komputer
                                        </option>
                                        <option value="3" selected>21IF003 - Proyek 1 : Pemanfaatan Aplikasi
                                            Perkantoran</option>
                                    </select>
                                </td>
                                <td class="py-3">
                                    <select class="form-select">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3" selected>3</option>
                                    </select>
                                </td>
                                <td class="py-3">44,5%</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" class="text-end fw-bold">Total Bobot</td>
                                <td class="fw-bold">100%</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col text-end">
                    <button type="button" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal"
                        class="btn btn-danger">Batal</button>
                    <button type="button" class="btn btn-primary">Simpan</button>
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
                            <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Tidak</button>
                        </div>
                        <div class="col">
                            <button type="button" id="route" class="btn btn-success w-100">Ya</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#route').on('click', function() {
                const modal = bootstrap.Modal.getInstance($('#exampleModalToggle2'));
                const modalEl = document.getElementById('exampleModalToggle2');

                modal.hide();
                modalEl.addEventListener('hidden.bs.modal', event => {
                    window.location.href =
                        "{{ route('cpl.show', ['kurikulum' => $kurikulum, 'cpl' => '1']) }}";
                });
            });
        });
    </script>
@endpush
