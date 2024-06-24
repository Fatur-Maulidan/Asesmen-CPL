@extends('layouts.main')

@section('breadcrumb')
    <h1 class="fw-bold mb-4">{{ $title }}</h1>
    {{ Breadcrumbs::render('kaprodi.kurikulum.dashboard.cpl', $kurikulum->tahun) }}
@endsection

@section('main')
    <div class="row">
        {{-- Side Option --}}
        <div class="col-2">
            <label for="" class="fw-bold mb-3">Pilihan dashboard</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="dashboard_type" id="dashboard_cpl" checked>
                <label class="form-check-label" for="dashboard_cpl">
                    <a href="{{ route('kaprodi.kurikulum.dashboard.cpl', ['kurikulum' => $kurikulum->tahun]) }}" class="text-decoration-none link-dark">Capaian Pembelajaran</a>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="dashboard_type" id="dashboard_mk">
                <label class="form-check-label" for="dashboard_mk">
                    <a href="{{ route('kaprodi.kurikulum.dashboard.mk', ['kurikulum' => $kurikulum->tahun]) }}" class="text-decoration-none link-dark">Mata Kuliah</a>
                </label>
            </div>
        </div>

        {{-- Content --}}
        <div class="col-10">
            {{-- Ketercapaian CP per Domain >>> --}}
            <div class="mb-4">
                <div class="row mb-5">
                    <div class="col-12">
                        <input type="radio" class="btn-check" name="domain" id="semua" autocomplete="off">
                        <label class="btn btn-outline-primary rounded-pill px-3" for="semua">Semua</label>

                        <input type="radio" class="btn-check" name="domain" id="ss" autocomplete="off">
                        <label class="btn btn-outline-primary rounded-pill px-3" for="ss">Sikap (SS)</label>

                        <input type="radio" class="btn-check" name="domain" id="pp" autocomplete="off">
                        <label class="btn btn-outline-primary rounded-pill px-3" for="pp">Pengetahuan (PP)</label>

                        <input type="radio" class="btn-check" name="domain" id="ku" autocomplete="off" checked>
                        <label class="btn btn-outline-primary rounded-pill px-3" for="ku">Keterampilan Umum (KU)</label>

                        <input type="radio" class="btn-check" name="domain" id="kk" autocomplete="off">
                        <label class="btn btn-outline-primary rounded-pill px-3" for="kk">Keterampilan Khusus (KK)</label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-8">
                        <img src="{{ asset('images/kaprodi-dashboard-cpl.png') }}" class="w-100">
                    </div>
                    <div class="col-4 overflow-y-auto" style="max-height: 380px">
                        <div class="mb-3">
                            <div class="fw-bold">KK-1</div>
                            <div class="">Mampu menerapkan pengetahuan matematika, sains dan teknologi informasi untuk memperoleh pemahaman yang komprehensif tentang prinsip prinsip rekayasa.</div>
                        </div>

                        <div class="mb-3">
                            <div class="fw-bold">KK-2</div>
                            <div class="">Mampu menerapkan pengetahuan matematika, sains dan teknologi informasi untuk memperoleh pemahaman yang komprehensif tentang prinsip prinsip rekayasa.</div>
                        </div>

                        <div class="mb-3">
                            <div class="fw-bold">KK-3</div>
                            <div class="">Mampu menerapkan pengetahuan matematika, sains dan teknologi informasi untuk memperoleh pemahaman yang komprehensif tentang prinsip prinsip rekayasa.</div>
                        </div>

                        <div class="mb-3">
                            <div class="fw-bold">KK-4</div>
                            <div class="">Mampu menerapkan pengetahuan matematika, sains dan teknologi informasi untuk memperoleh pemahaman yang komprehensif tentang prinsip prinsip rekayasa.</div>
                        </div>

                        <div class="mb-3">
                            <div class="fw-bold">KK-5</div>
                            <div class="">Mampu menerapkan pengetahuan matematika, sains dan teknologi informasi untuk memperoleh pemahaman yang komprehensif tentang prinsip prinsip rekayasa.</div>
                        </div>

                        <div class="mb-3">
                            <div class="fw-bold">KK-6</div>
                            <div class="">Mampu menerapkan pengetahuan matematika, sains dan teknologi informasi untuk memperoleh pemahaman yang komprehensif tentang prinsip prinsip rekayasa.</div>
                        </div>

                        <div class="mb-3">
                            <div class="fw-bold">KK-7</div>
                            <div class="">Mampu menerapkan pengetahuan matematika, sains dan teknologi informasi untuk memperoleh pemahaman yang komprehensif tentang prinsip prinsip rekayasa.</div>
                        </div>

                        <div class="mb-3">
                            <div class="fw-bold">KK-8</div>
                            <div class="">Mampu menerapkan pengetahuan matematika, sains dan teknologi informasi untuk memperoleh pemahaman yang komprehensif tentang prinsip prinsip rekayasa.</div>
                        </div>
                    </div>
                </div>
            </div>
            {{--  <<< end  --}}

            {{-- CPL per angkatan >>> --}}
            <div class="mb-4">
                <div class="row mb-4">
                    <div class="col-auto">
                        <label for="cpl" class="fw-bold mb-2">Capaian pembelajaran</label>
                        <select class="form-select me-3" name="cpl" id="cpl">
                            <option>KK-1</option>
                            <option>KK-2</option>
                            <option>KK-3</option>
                            <option>KK-4</option>
                            <option>KK-5</option>
                            <option>KK-6</option>
                            <option>KK-7</option>
                            <option>KK-8</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <label for="tahun" class="fw-bold mb-2">Angkatan mahasiswa</label>
                        <select class="form-select me-3" name="tahun" id="tahun">
                            <option>2021</option>
                            <option>2022</option>
                            <option>2023</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-8">
                        <img src="{{ asset('images/kaprodi-dashboard-ik-angkatan.png') }}" class="w-100">
                    </div>
                    <div class="col-4 overflow-y-auto" style="max-height: 340px">
                        <div class="mb-3">
                            <div class="fw-bold">KK-1</div>
                            <div class="">Mampu menerapkan pengetahuan matematika, sains dan teknologi informasi untuk memperoleh pemahaman yang komprehensif tentang prinsip prinsip rekayasa.</div>
                        </div>

                        <div class="mb-3">
                            <div class="fw-bold">KK-2</div>
                            <div class="">Mampu menerapkan pengetahuan matematika, sains dan teknologi informasi untuk memperoleh pemahaman yang komprehensif tentang prinsip prinsip rekayasa.</div>
                        </div>

                        <div class="mb-3">
                            <div class="fw-bold">KK-3</div>
                            <div class="">Mampu menerapkan pengetahuan matematika, sains dan teknologi informasi untuk memperoleh pemahaman yang komprehensif tentang prinsip prinsip rekayasa.</div>
                        </div>

                        <div class="mb-3">
                            <div class="fw-bold">KK-4</div>
                            <div class="">Mampu menerapkan pengetahuan matematika, sains dan teknologi informasi untuk memperoleh pemahaman yang komprehensif tentang prinsip prinsip rekayasa.</div>
                        </div>

                        <div class="mb-3">
                            <div class="fw-bold">KK-5</div>
                            <div class="">Mampu menerapkan pengetahuan matematika, sains dan teknologi informasi untuk memperoleh pemahaman yang komprehensif tentang prinsip prinsip rekayasa.</div>
                        </div>

                        <div class="mb-3">
                            <div class="fw-bold">KK-6</div>
                            <div class="">Mampu menerapkan pengetahuan matematika, sains dan teknologi informasi untuk memperoleh pemahaman yang komprehensif tentang prinsip prinsip rekayasa.</div>
                        </div>

                        <div class="mb-3">
                            <div class="fw-bold">KK-7</div>
                            <div class="">Mampu menerapkan pengetahuan matematika, sains dan teknologi informasi untuk memperoleh pemahaman yang komprehensif tentang prinsip prinsip rekayasa.</div>
                        </div>

                        <div class="mb-3">
                            <div class="fw-bold">KK-8</div>
                            <div class="">Mampu menerapkan pengetahuan matematika, sains dan teknologi informasi untuk memperoleh pemahaman yang komprehensif tentang prinsip prinsip rekayasa.</div>
                        </div>
                    </div>
                </div>
            </div>
            {{--  <<< end  --}}

            {{-- CP pada MK >>> --}}
            <div class="mb-4">
                <div class="row mb-4">
                    <div class="fw-bold mb-2">Capaian Pembelajaran pada Mata Kuliah</div>
                    <div class="col-auto">
                        <label for="cpl" class="fw-bold mb-2">Mata kuliah</label>
                        <select class="form-select me-3" name="cpl" id="cpl">
                            <option>21IF001 - Dasar Dasar Pemrograman</option>
                            <option>21IF002 - Pengantar Teknologi Informasi</option>
                            <option>21IF003 - Komunikasi Data Jaringan</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <label for="tahun" class="fw-bold mb-2">Angkatan mahasiswa</label>
                        <select class="form-select me-3" name="tahun" id="tahun">
                            <option>2021</option>
                            <option>2022</option>
                            <option>2023</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-8">
                        <img src="{{ asset('images/kaprodi-dashboard-cpl-mk.png') }}" class="w-100">
                    </div>
                    <div class="col-4 overflow-y-auto" style="max-height: 340px">
                        <div class="mb-3">
                            <div class="fw-bold">KK-1</div>
                            <div class="">Mampu menerapkan pengetahuan matematika, sains dan teknologi informasi untuk memperoleh pemahaman yang komprehensif tentang prinsip prinsip rekayasa.</div>
                        </div>

                        <div class="mb-3">
                            <div class="fw-bold">KK-2</div>
                            <div class="">Mampu menerapkan pengetahuan matematika, sains dan teknologi informasi untuk memperoleh pemahaman yang komprehensif tentang prinsip prinsip rekayasa.</div>
                        </div>

                        <div class="mb-3">
                            <div class="fw-bold">KK-3</div>
                            <div class="">Mampu menerapkan pengetahuan matematika, sains dan teknologi informasi untuk memperoleh pemahaman yang komprehensif tentang prinsip prinsip rekayasa.</div>
                        </div>

                        <div class="mb-3">
                            <div class="fw-bold">KK-4</div>
                            <div class="">Mampu menerapkan pengetahuan matematika, sains dan teknologi informasi untuk memperoleh pemahaman yang komprehensif tentang prinsip prinsip rekayasa.</div>
                        </div>

                        <div class="mb-3">
                            <div class="fw-bold">KK-5</div>
                            <div class="">Mampu menerapkan pengetahuan matematika, sains dan teknologi informasi untuk memperoleh pemahaman yang komprehensif tentang prinsip prinsip rekayasa.</div>
                        </div>

                        <div class="mb-3">
                            <div class="fw-bold">KK-6</div>
                            <div class="">Mampu menerapkan pengetahuan matematika, sains dan teknologi informasi untuk memperoleh pemahaman yang komprehensif tentang prinsip prinsip rekayasa.</div>
                        </div>

                        <div class="mb-3">
                            <div class="fw-bold">KK-7</div>
                            <div class="">Mampu menerapkan pengetahuan matematika, sains dan teknologi informasi untuk memperoleh pemahaman yang komprehensif tentang prinsip prinsip rekayasa.</div>
                        </div>

                        <div class="mb-3">
                            <div class="fw-bold">KK-8</div>
                            <div class="">Mampu menerapkan pengetahuan matematika, sains dan teknologi informasi untuk memperoleh pemahaman yang komprehensif tentang prinsip prinsip rekayasa.</div>
                        </div>
                    </div>
                </div>
            </div>
            {{--  <<< end  --}}

            {{-- TP pada MK >>> --}}
            <div class="mb-4">
                <div class="fw-bold mb-2">Tujuan Pembelajaran pada Mata Kuliah</div>
                <div class="row">
                    <div class="col-8">
                        <img src="{{ asset('images/kaprodi-dashboard-tp-mk.png') }}" class="w-100">
                    </div>
                    <div class="col-4 overflow-y-auto" style="max-height: 340px">
                        <div class="mb-3">
                            <div class="fw-bold">TP-1</div>
                            <div class="">Mampu menerapkan pengetahuan matematika, sains dan teknologi informasi untuk memperoleh pemahaman yang komprehensif tentang prinsip prinsip rekayasa.</div>
                        </div>

                        <div class="mb-3">
                            <div class="fw-bold">TP-2</div>
                            <div class="">Mampu menerapkan pengetahuan matematika, sains dan teknologi informasi untuk memperoleh pemahaman yang komprehensif tentang prinsip prinsip rekayasa.</div>
                        </div>

                        <div class="mb-3">
                            <div class="fw-bold">TP-3</div>
                            <div class="">Mampu menerapkan pengetahuan matematika, sains dan teknologi informasi untuk memperoleh pemahaman yang komprehensif tentang prinsip prinsip rekayasa.</div>
                        </div>

                        <div class="mb-3">
                            <div class="fw-bold">TP-4</div>
                            <div class="">Mampu menerapkan pengetahuan matematika, sains dan teknologi informasi untuk memperoleh pemahaman yang komprehensif tentang prinsip prinsip rekayasa.</div>
                        </div>

                        <div class="mb-3">
                            <div class="fw-bold">TP-5</div>
                            <div class="">Mampu menerapkan pengetahuan matematika, sains dan teknologi informasi untuk memperoleh pemahaman yang komprehensif tentang prinsip prinsip rekayasa.</div>
                        </div>

                        <div class="mb-3">
                            <div class="fw-bold">TP-6</div>
                            <div class="">Mampu menerapkan pengetahuan matematika, sains dan teknologi informasi untuk memperoleh pemahaman yang komprehensif tentang prinsip prinsip rekayasa.</div>
                        </div>

                        <div class="mb-3">
                            <div class="fw-bold">TP-7</div>
                            <div class="">Mampu menerapkan pengetahuan matematika, sains dan teknologi informasi untuk memperoleh pemahaman yang komprehensif tentang prinsip prinsip rekayasa.</div>
                        </div>

                        <div class="mb-3">
                            <div class="fw-bold">TP-8</div>
                            <div class="">Mampu menerapkan pengetahuan matematika, sains dan teknologi informasi untuk memperoleh pemahaman yang komprehensif tentang prinsip prinsip rekayasa.</div>
                        </div>
                    </div>
                </div>
            </div>
            {{--  <<< end  --}}

            {{-- IK pada MK >>> --}}
            <div class="mb-4">
                <div class="fw-bold mb-2">Indikator Kinerja pada Mata Kuliah</div>
                <div class="row">
                    <div class="col-8">
                        <img src="{{ asset('images/kaprodi-dashboard-ik-mk.png') }}" class="w-100">
                    </div>
                    <div class="col-4 overflow-y-auto" style="max-height: 340px">
                        <div class="mb-3">
                            <div class="fw-bold">KK-1</div>
                            <div class="">Mampu menerapkan pengetahuan matematika, sains dan teknologi informasi untuk memperoleh pemahaman yang komprehensif tentang prinsip prinsip rekayasa.</div>
                        </div>

                        <div class="mb-3">
                            <div class="fw-bold">KK-2</div>
                            <div class="">Mampu menerapkan pengetahuan matematika, sains dan teknologi informasi untuk memperoleh pemahaman yang komprehensif tentang prinsip prinsip rekayasa.</div>
                        </div>

                        <div class="mb-3">
                            <div class="fw-bold">KK-3</div>
                            <div class="">Mampu menerapkan pengetahuan matematika, sains dan teknologi informasi untuk memperoleh pemahaman yang komprehensif tentang prinsip prinsip rekayasa.</div>
                        </div>

                        <div class="mb-3">
                            <div class="fw-bold">KK-4</div>
                            <div class="">Mampu menerapkan pengetahuan matematika, sains dan teknologi informasi untuk memperoleh pemahaman yang komprehensif tentang prinsip prinsip rekayasa.</div>
                        </div>

                        <div class="mb-3">
                            <div class="fw-bold">KK-5</div>
                            <div class="">Mampu menerapkan pengetahuan matematika, sains dan teknologi informasi untuk memperoleh pemahaman yang komprehensif tentang prinsip prinsip rekayasa.</div>
                        </div>

                        <div class="mb-3">
                            <div class="fw-bold">KK-6</div>
                            <div class="">Mampu menerapkan pengetahuan matematika, sains dan teknologi informasi untuk memperoleh pemahaman yang komprehensif tentang prinsip prinsip rekayasa.</div>
                        </div>

                        <div class="mb-3">
                            <div class="fw-bold">KK-7</div>
                            <div class="">Mampu menerapkan pengetahuan matematika, sains dan teknologi informasi untuk memperoleh pemahaman yang komprehensif tentang prinsip prinsip rekayasa.</div>
                        </div>

                        <div class="mb-3">
                            <div class="fw-bold">KK-8</div>
                            <div class="">Mampu menerapkan pengetahuan matematika, sains dan teknologi informasi untuk memperoleh pemahaman yang komprehensif tentang prinsip prinsip rekayasa.</div>
                        </div>
                    </div>
                </div>
            </div>
            {{--  <<< end  --}}
        </div>
    </div>

@endsection
