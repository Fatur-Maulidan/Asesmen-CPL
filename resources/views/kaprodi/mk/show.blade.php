@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('kaprodi.mata-kuliah.show', $kurikulum->tahun, $mata_kuliah->nama, $mata_kuliah->kode) }}
    <h1 class="fw-bold mb-4">{{ $mata_kuliah->nama }}</h1>
@endsection

@section('main')
    {{-- Mata Kuliah Modal --}}
    <div class="modal fade" id="mataKuliahModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="mataKuliahModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="mataKuliahModalLabel">Ubah Mata Kuliah</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('kaprodi.mata-kuliah.update', ['kurikulum' => $kurikulum->tahun, 'mata_kuliah' => $mata_kuliah->id]) }}" method="post" autocomplete="off" id="mataKuliahForm">
                        @csrf
                        @method('patch')

                        <div class="mb-3">
                            <label for="kode" class="form-label fw-bold">Kode</label>
                            <input type="text" class="form-control" id="kode" name="kode"
                                   placeholder="Kode mata kuliah" value="{{ $mata_kuliah->kode }}">
                            <div id="kode_feedback" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label fw-bold">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                   placeholder="Nama mata kuliah" value="{{ $mata_kuliah->nama }}">
                            <div id="nama_feedback" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="6">{{ $mata_kuliah->deskripsi }}</textarea>
                            <div id="deskripsi_feedback" class="text-danger"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col">
                            <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Batal</button>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-warning w-100" id="btn-submit"
                                    form="mataKuliahForm">Ubah</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tahun Akademik Modal --}}
    <div class="modal fade" id="tahunAkademikModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="tahunAkademikModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="tahunAkademikModalLabel">Tambah Tahun Akademik</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('kaprodi.kurikulum.mata-kuliah-register.store', ['kurikulum' => $kurikulum->tahun]) }}" method="post" autocomplete="off" id="tahunAkademikForm">
                        @csrf
                        <input type="hidden" name="id_mata_kuliah" value="{{ $mata_kuliah->id }}">

                        <div class="step step-1">
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-4">
                                        <label for="tahun_mulai" class="form-label fw-bold">Tahun Mulai</label>
                                        <input type="text" class="form-control" id="tahun_mulai" name="tahun_mulai" value="{{ date('Y') }}">
                                        <div id="tahun_mulai_feedback" class="text-danger"></div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-4">
                                        <label for="tahun_selesai" class="form-label fw-bold">Tahun Selesai</label>
                                        <input type="text" class="form-control" id="tahun_selesai" name="tahun_selesai" value="{{ date('Y') + 1 }}">
                                        <div id="tahun_selesai_feedback" class="text-danger"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-4">
                                        <label for="semester" class="form-label fw-bold">Semester</label>
                                        <select class="form-select" id="semester" name="semester">
                                            <option value="" selected>Pilih semester</option>
                                            @for($i = 1; $i <= 8; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                        <div id="semester_feedback" class="text-danger"></div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-4">
                                        <label for="jenis" class="form-label fw-bold">Jenis Mata Kuliah</label>
                                        <select class="form-select" id="jenis" name="jenis">
                                            <option value="" selected>Pilih jenis</option>
                                            <option value="{{ \App\Enums\JenisPerkuliahan::Teori }}">Teori</option>
                                            <option value="{{ \App\Enums\JenisPerkuliahan::Praktikum }}">Praktikum</option>
                                        </select>
                                        <div id="jenis_feedback" class="text-danger"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label for="dosen_pengampu" class="form-label fw-bold">Dosen Pengampu</label>
                                        <select class="form-select" id="dosen_pengampu" name="dosen_pengampu[]" multiple>
                                            <option value="">Pilih dosen</option>
                                            @foreach($dosen as $dsn)
                                                <option value="{{ $dsn->id }}">{{ $dsn->kode . ' - ' . $dsn->nama }}</option>
                                            @endforeach
                                        </select>
                                        <div id="dosen_pengampu_feedback" class="text-danger"></div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-secondary next-step w-100 mt-5">Selanjutnya</button>
                        </div>

                        <div class="step step-2">
                            <div class="fw-bold">Pilih Indikator Kinerja yang relevan dengan Mata Kuliah</div>

                            <div class="accordion my-4" id="daftarIk">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed bg-body-tertiary" type="button" data-bs-toggle="collapse" data-bs-target="#sikap" aria-expanded="true" aria-controls="sikap">
                                            Sikap
                                        </button>
                                    </h2>
                                    <div id="sikap" class="accordion-collapse collapse" data-bs-parent="#daftarIk">
                                        <div class="accordion-body">
                                            @forelse($cpl->where('domain', \App\Enums\DomainCPL::Sikap) as $sikap)
                                                @foreach($sikap->indikatorKinerja as $ik)
                                                    <div class="form-check mb-4">
                                                        <input class="form-check-input" type="checkbox" value="{{ $ik->id }}" id="{{ $ik->kode }}" name="indikator_kinerja[]">
                                                        <label class="form-check-label fw-bold" for="{{ $ik->kode }}">
                                                            {{ $ik->kode }}
                                                        </label>
                                                        <div>{{ $ik->deskripsi }}</div>
                                                    </div>
                                                @endforeach
                                            @empty
                                                <div>Tidak ada indikator kinerja.</div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed bg-body-tertiary" type="button" data-bs-toggle="collapse" data-bs-target="#pengetahuan" aria-expanded="false" aria-controls="pengetahuan">
                                            Pengetahuan
                                        </button>
                                    </h2>
                                    <div id="pengetahuan" class="accordion-collapse collapse" data-bs-parent="#daftarIk">
                                        <div class="accordion-body">
                                            @forelse($cpl->where('domain', \App\Enums\DomainCPL::Pengetahuan) as $pengetahuan)
                                                @foreach($pengetahuan->indikatorKinerja as $ik)
                                                    <div class="form-check mb-4">
                                                        <input class="form-check-input" type="checkbox" value="{{ $ik->id }}" id="{{ $ik->kode }}" name="indikator_kinerja[]">
                                                        <label class="form-check-label fw-bold" for="{{ $ik->kode }}">
                                                            {{ $ik->kode }}
                                                        </label>
                                                        <div>{{ $ik->deskripsi }}</div>
                                                    </div>
                                                @endforeach
                                            @empty
                                                <div>Tidak ada indikator kinerja.</div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed bg-body-tertiary" type="button" data-bs-toggle="collapse" data-bs-target="#keterampilanUmum" aria-expanded="false" aria-controls="keterampilanUmum">
                                            Keterampilan Umum
                                        </button>
                                    </h2>
                                    <div id="keterampilanUmum" class="accordion-collapse collapse" data-bs-parent="#daftarIk">
                                        <div class="accordion-body">
                                            @forelse($cpl->where('domain', \App\Enums\DomainCPL::KeterampilanUmum) as $ku)
                                                @foreach($ku->indikatorKinerja as $ik)
                                                    <div class="form-check mb-4">
                                                        <input class="form-check-input" type="checkbox" value="{{ $ik->id }}" id="{{ $ik->kode }}" name="indikator_kinerja[]">
                                                        <label class="form-check-label fw-bold" for="{{ $ik->kode }}">
                                                            {{ $ik->kode }}
                                                        </label>
                                                        <div>{{ $ik->deskripsi }}</div>
                                                    </div>
                                                @endforeach
                                            @empty
                                                <div>Tidak ada indikator kinerja.</div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed bg-body-tertiary" type="button" data-bs-toggle="collapse" data-bs-target="#keterampilanKhusus" aria-expanded="false" aria-controls="keterampilanKhusus">
                                            Keterampilan Khusus
                                        </button>
                                    </h2>
                                    <div id="keterampilanKhusus" class="accordion-collapse collapse" data-bs-parent="#daftarIk">
                                        <div class="accordion-body">
                                            @forelse($cpl->where('domain', \App\Enums\DomainCPL::KeterampilanKhusus) as $kk)
                                                @foreach($kk->indikatorKinerja as $ik)
                                                    <div class="form-check mb-4">
                                                        <input class="form-check-input" type="checkbox" value="{{ $ik->id }}" id="{{ $ik->kode }}" name="indikator_kinerja[]">
                                                        <label class="form-check-label fw-bold" for="{{ $ik->kode }}">
                                                            {{ $ik->kode }}
                                                        </label>
                                                        <div>{{ $ik->deskripsi }}</div>
                                                    </div>
                                                @endforeach
                                            @empty
                                                <div>Tidak ada indikator kinerja.</div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="indikator_kinerja_feedback" class="text-danger"></div>

                            <div class="row justify-content-center mt-5">
                                <div class="col">
                                    <button type="button" class="btn btn-secondary prev-step w-100">Sebelumnya</button>
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-success w-100" form="tahunAkademikForm">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Detail --}}
    <div class="row">
        <div class="col-12">
            <div class="row align-items-center mb-5">
                <div class="col-2">
                    <div class="fw-bold">Dibuat pada</div>
                    <div>{{ $mata_kuliah->created_at->translatedFormat('d F Y H:i') }}</div>
                </div>
                <div class="col-2">
                    <div class="fw-bold">Diperbarui pada</div>
                    <div>{{ $mata_kuliah->updated_at->translatedFormat('d F Y H:i') }}</div>
                </div>
                <div class="col-8 text-end">
                    <a href="{{ route('kaprodi.mata-kuliah.index', ['kurikulum' => $kurikulum->tahun]) }}" class="btn btn-secondary ms-auto me-2">Kembali</a>
                    <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#tahunAkademikModal">Tambah Data Tahun Akademik</button>
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#mataKuliahModal">Ubah Data Mata Kuliah</button>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col">
                    <div class="fw-bold">Deskripsi</div>
                    <p class="mb-0">{{ $mata_kuliah->deskripsi }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="fw-bold mb-3">Dosen pengampu berdasarkan tahun akademik</div>
                    @if($mata_kuliah->mataKuliahRegister->isNotEmpty())
                        <div class="accordion" id="daftarTahunAkademik">
                            @foreach($mata_kuliah->mataKuliahRegister as $mkr)
                                <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed bg-body-tertiary fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $loop->iteration }}" aria-expanded="true" aria-controls="{{ $loop->iteration }}">
                                                Tahun Akademik {{ $mkr->tahun_akademik_awal . ' / ' . $mkr->tahun_akademik_akhir }} <span class="badge text-bg-info rounded rounded-pill fs-6 ms-2">{{ $mkr->jenis }}</span>
                                            </button>
                                        </h2>
                                        <div id="{{ $loop->iteration }}" class="accordion-collapse collapse" data-bs-parent="#daftarTahunAkademik">
                                            <div class="accordion-body py-4">
                                                <div class="fw-bold">Dosen Pengampu</div>
                                                <ul class="mb-0">
                                                    @foreach($mkr->dosen as $pengampu)
                                                        <li>{{ $pengampu->kode . ' - ' . $pengampu->nama }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-secondary" role="alert">
                            Belum ada mata kuliah register.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            const mataKuliahModal = document.getElementById('mataKuliahModal');
            const tahunAkademikModal = document.getElementById('tahunAkademikModal');
            const mataKuliahModalInstance = new bootstrap.Modal('#mataKuliahModal');
            const tahunAkademikModalInstance = new bootstrap.Modal('#tahunAkademikModal');

            mataKuliahModal.addEventListener('hidden.bs.modal', event => {
                $('#kode_feedback').html('');
                $('#nama_feedback').html('');
                $('#deskripsi_feedback').html('');
            });

            tahunAkademikModal.addEventListener('hidden.bs.modal', event => {
                $('#tahun_mulai').val('{{ date('Y') }}');
                $('#tahun_selesai').val('{{ date('Y') + 1 }}');
                $('#semester').prop('selectedIndex', 0);
                $('#jenis').prop('selectedIndex', 0);
                $('#dosen_pengampu').prop('selectedIndex', 0);
                $('input[name="indikator_kinerja[]"]').prop('checked', false);

                $('#tahun_mulai_feedback').html('');
                $('#tahun_selesai_feedback').html('');
                $('#semester_feedback').html('');
                $('#jenis_feedback').html('');
                $('#dosen_pengampu_feedback').html('');
                $('#indikator_kinerja_feedback').html('');
            });

            $('#mataKuliahForm').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    type: "post",
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: "JSON",
                    success: function (res) {
                        console.log(res)
                        tahunModalInstance.hide();
                        location.reload();
                    },
                    error: function (err) {
                        // when status code is 422, it's a validation issue
                        if (err.status == 422) {
                            console.log(err.responseJSON);

                            if ('kode' in err.responseJSON.errors) {
                                $('#kode_feedback').html(
                                    err.responseJSON.errors.kode[0]
                                );
                            } else {
                                $('#kode_feedback').html('');
                            }

                            if ('nama' in err.responseJSON.errors) {
                                $('#nama_feedback').html(
                                    err.responseJSON.errors.nama[0]
                                );
                            } else {
                                $('#nama_feedback').html('');
                            }

                            if ('deskripsi' in err.responseJSON.errors) {
                                $('#deskripsi_feedback').html(
                                    err.responseJSON.errors.deskripsi[0]
                                );
                            } else {
                                $('#deskripsi_feedback').html('');
                            }
                        } else if (err.status == 500) {
                            console.log(err);
                        }
                    }
                });
            });

            $('#dosen_pengampu').select2({
                theme: "bootstrap-5",
                closeOnSelect: false,
                dropdownParent: $('#tahunAkademikModal')
            });

            let currentStep = 1;

            function showStep(step) {
                $('.step').addClass('d-none');
                $(`.step-${step}`).removeClass('d-none');
            }

            $('.next-step').click(function () {
                currentStep++;
                showStep(currentStep);
            });

            $('.prev-step').click(function () {
                currentStep--;
                showStep(currentStep);
            });

            showStep(currentStep);

            $('#tahunAkademikForm').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    type: "post",
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: "JSON",
                    success: function (res) {
                        console.log(res)
                        tahunAkademikModalInstance.hide();
                        location.reload();
                    },
                    error: function (err) {
                        // when status code is 422, it's a validation issue
                        if (err.status == 422) {
                            console.log(err.responseJSON);

                            if ('tahun_mulai' in err.responseJSON.errors) {
                                $('#tahun_mulai_feedback').html(
                                    err.responseJSON.errors.tahun_mulai[0]
                                );
                            } else {
                                $('#tahun_mulai_feedback').html('');
                            }

                            if ('tahun_selesai' in err.responseJSON.errors) {
                                $('#tahun_selesai_feedback').html(
                                    err.responseJSON.errors.tahun_selesai[0]
                                );
                            } else {
                                $('#tahun_selesai_feedback').html('');
                            }

                            if ('semester' in err.responseJSON.errors) {
                                $('#semester_feedback').html(
                                    err.responseJSON.errors.semester[0]
                                );
                            } else {
                                $('#semester_feedback').html('');
                            }

                            if ('jenis' in err.responseJSON.errors) {
                                $('#jenis_feedback').html(
                                    err.responseJSON.errors.jenis[0]
                                );
                            } else {
                                $('#jenis_feedback').html('');
                            }

                            if ('dosen_pengampu' in err.responseJSON.errors) {
                                $('#dosen_pengampu_feedback').html(
                                    err.responseJSON.errors.dosen_pengampu[0]
                                );
                            } else {
                                $('#dosen_pengampu_feedback').html('');
                            }

                            if ('indikator_kinerja' in err.responseJSON.errors) {
                                $('#indikator_kinerja_feedback').html(
                                    err.responseJSON.errors.indikator_kinerja[0]
                                );
                            } else {
                                $('#indikator_kinerja_feedback').html('');
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
