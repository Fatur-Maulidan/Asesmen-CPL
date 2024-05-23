@extends('layouts.main')

@section('breadcrumb')
    {{-- {{ Breadcrumbs::render('cpl.show') }} --}}
@endsection

@section('main')
    <div class="row">
        {{-- Sidebar --}}
        <div class="col-3">
            <button type="button" class="btn btn-outline-primary w-100 mb-4">Ekspor</button>
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Sikap (S)
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="mb-3">
                                <a href="" class="btn btn-light w-100 active">S-1</a>
                            </div>

                            <div class="mb-3">
                                <a href="" class="btn btn-light w-100">S-2</a>
                            </div>

                            <div class="mb-3">
                                <a href="" class="btn btn-light w-100">S-3</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Pengetahuan (P)
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="mb-3">
                                <a href="" class="btn btn-light w-100">P-1</a>
                            </div>

                            <div class="mb-3">
                                <a href="" class="btn btn-light w-100">P-2</a>
                            </div>

                            <div class="mb-3">
                                <a href="" class="btn btn-light w-100">P-3</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            KU (Keterampilan Umum)
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="mb-3">
                                <a href="" class="btn btn-light w-100">KU-1</a>
                            </div>

                            <div class="mb-3">
                                <a href="" class="btn btn-light w-100">KU-2</a>
                            </div>

                            <div class="mb-3">
                                <a href="" class="btn btn-light w-100">KU-3</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            KK (Keterampilan Khusus)
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="mb-3">
                                <a href="" class="btn btn-light w-100">KK-1</a>
                            </div>

                            <div class="mb-3">
                                <a href="" class="btn btn-light w-100">KK-2</a>
                            </div>

                            <div class="mb-3">
                                <a href="" class="btn btn-light w-100">KK-3</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Detail --}}
        <div class="col-9">
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
                                <td colspan="2" class="text-end fw-bold">Total</td>
                                <td class="fw-bold">100%</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col text-end">
                    <button type="button" class="btn btn-danger">Batal</button>
                    <button type="button" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection
