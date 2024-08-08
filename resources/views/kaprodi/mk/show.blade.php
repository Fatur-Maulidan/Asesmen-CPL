@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('kaprodi.mata-kuliah.show', $kurikulum->tahun, $mata_kuliah->nama, $mata_kuliah->kode) }}
    <h1 class="fw-bold mb-4">{{ $mata_kuliah->nama }}</h1>
@endsection

@section('main')
    {{-- Tahun Akademik Modal --}}
    <div class="modal fade" id="tahunAkademikModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="tahunAkademikModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="tahunAkademikModalLabel">Tambah Data Tahun Akademik</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('kaprodi.kurikulum.mata-kuliah-register.store', ['kurikulum' => $kurikulum->tahun]) }}" method="post" autocomplete="off" id="tahunAkademikForm">
                        @csrf
                        <input type="hidden" name="id_mata_kuliah" value="{{ $mata_kuliah->id }}">
                        <div id="method"></div>

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
                                                        <input class="form-check-input" type="checkbox" value="{{ $ik->id }}" id="ik{{ $ik->id }}" name="indikator_kinerja[]">
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
                                                        <input class="form-check-input" type="checkbox" value="{{ $ik->id }}" id="ik{{ $ik->id }}" name="indikator_kinerja[]">
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
                                                        <input class="form-check-input" type="checkbox" value="{{ $ik->id }}" id="ik{{ $ik->id }}" name="indikator_kinerja[]">
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
                                                        <input class="form-check-input" type="checkbox" value="{{ $ik->id }}" id="ik{{ $ik->id }}" name="indikator_kinerja[]">
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

                            <div id="alert-message" class="my-4"></div>

                            <div class="row justify-content-center mt-5">
                                <div class="col">
                                    <button type="button" class="btn btn-secondary prev-step w-100">Sebelumnya</button>
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-success w-100" form="tahunAkademikForm" id="btn-submit">Submit</button>
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
                    @if($kurikulum->status->is(\App\Enums\StatusKurikulum::Pengelolaan))
                        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#tahunAkademikModal">Tambah Data Tahun Akademik</button>
                    @endif
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
                    <div class="fw-bold mb-3">Data Tahun Akademik Mata Kuliah</div>
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
                                                <div class="mb-3">
                                                    <div class="fw-bold">Semester</div>
                                                    <div class="">{{ $mkr->semester }}</div>
                                                </div>

                                                <div class="mb-3">
                                                    <div class="fw-bold">Dosen Pengampu</div>
                                                    <ul class="mb-0">
                                                        @forelse($mkr->dosen as $pengampu)
                                                            <li>{{ $pengampu->kode . ' - ' . $pengampu->nama }}</li>
                                                        @empty
                                                            <li>Belum ada dosen pengampu.</li>
                                                        @endforelse
                                                    </ul>
                                                </div>

                                                <div>
                                                    <div class="fw-bold">Indikator Kinerja</div>
                                                    <table class="table table-bordered table-hover border">
                                                        <tbody>
                                                        @foreach($mkr->indikatorKinerja as $ik)
                                                            <tr>
                                                                <td class="fw-bold text-nowrap align-middle">{{ $ik->kode }}</td>
                                                                <td class="align-middle">{{ $ik->deskripsi }}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>

                                                @if($kurikulum->status->is(\App\Enums\StatusKurikulum::Pengelolaan))
                                                    <div>
                                                        <button class="btn btn-warning btn-edit" data-url="{{ route('kaprodi.kurikulum.mata-kuliah-register.show', ['kurikulum' => $kurikulum->tahun, 'mata_kuliah_register' => $mkr->id]) }}" data-bs-toggle="modal" data-bs-target="#tahunAkademikModal">Ubah Data</button>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-secondary" role="alert">
                            Belum ada mata tahun akademik.
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
            const tahunAkademikModal = document.getElementById('tahunAkademikModal');
            const tahunAkademikModalInstance = new bootstrap.Modal('#tahunAkademikModal');
            let currentStep = 1;

            tahunAkademikModal.addEventListener('hidden.bs.modal', event => {
                $('#tahunAkademikModalLabel').html('Tambah Data Tahun Akademik');
                $('#btn-submit').html('Submit').addClass('btn-success').removeClass('btn-warning');
                $('#method').html('');
                $('#tahunAkademikForm').attr('action', "{{ route('kaprodi.kurikulum.mata-kuliah-register.store', ['kurikulum' => $kurikulum->tahun]) }}");

                $('#tahun_mulai').val('{{ date('Y') }}');
                $('#tahun_selesai').val('{{ date('Y') + 1 }}');
                $('#semester').prop('selectedIndex', 0);
                $('#jenis').prop('selectedIndex', 0);
                $('#dosen_pengampu').val('').trigger('change');
                $('input[name="indikator_kinerja[]"]').prop('checked', false);

                $('#tahun_mulai_feedback').html('');
                $('#tahun_selesai_feedback').html('');
                $('#semester_feedback').html('');
                $('#jenis_feedback').html('');
                $('#dosen_pengampu_feedback').html('');
                $('#indikator_kinerja_feedback').html('');
                $('#alert-message').html('');
                currentStep = 1;
                showStep(currentStep);
            });

            $('#dosen_pengampu').select2({
                theme: "bootstrap-5",
                closeOnSelect: false,
                dropdownParent: $('#tahunAkademikModal')
            });

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

                        } else if (err.status == 409) {
                            console.log(err)
                            $('#alert-message').html(`
                                <div class="alert alert-danger" role="alert">${err.responseJSON.message}</div>
                            `);
                        } else if (err.status == 500) {
                            console.log(err);
                        }
                    }
                });
            });

            $('.btn-edit').on('click', function (e) {
                const url = $(this).data('url');

                $('#tahunAkademikModalLabel').html('Ubah Data Tahun Akademik');
                $('#btn-submit').html('Ubah').addClass('btn-warning').removeClass('btn-success');
                $('#method').html('@method('patch')');
                $('#tahunAkademikForm').attr('action', url);

                $.ajax({
                    type: "get",
                    url: url,
                    dataType: "JSON",
                    success: function(res) {
                        console.log(res);

                        $('#tahun_mulai').val(res.mkr.tahun_akademik_awal);
                        $('#tahun_selesai').val(res.mkr.tahun_akademik_akhir);
                        $('#semester').val(res.mkr.semester);
                        $('#jenis').val(res.mkr.jenis);
                        $('#dosen_pengampu').val(res.dosen).trigger('change');
                        res.indikator_kinerja.forEach((element) => {
                            $('#ik' + element).prop('checked', true);
                        });
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            });
        });
    </script>
@endpush
