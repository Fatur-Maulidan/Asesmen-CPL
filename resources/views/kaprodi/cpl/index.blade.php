@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('kaprodi.cpl.index', $kurikulum->tahun) }}
    <h1 class="fw-bold mb-0">{{ $title }}</h1>
@endsection

@section('main')
    {{-- Filter buttons --}}
    <div class="row mb-5">
        <div class="col-auto">
            <input type="radio" class="btn-check" name="options" id="option1" autocomplete="off" checked>
            <label class="btn btn-outline-primary rounded-pill px-3" data-filter="Semua" for="option1">Semua</label>

            <input type="radio" class="btn-check" name="options" id="option2" autocomplete="off">
            <label class="btn btn-outline-primary rounded-pill px-3" data-filter="SP" for="option2">Sikap
                (SP)</label>

            <input type="radio" class="btn-check" name="options" id="option3" autocomplete="off">
            <label class="btn btn-outline-primary rounded-pill px-3" data-filter="PP" for="option3">Pengetahuan
                (PP)</label>

            <input type="radio" class="btn-check" name="options" id="option4" autocomplete="off">
            <label class="btn btn-outline-primary rounded-pill px-3" data-filter="KU" for="option4">Keterampilan Umum
                (KU)</label>

            <input type="radio" class="btn-check" name="options" id="option5" autocomplete="off">
            <label class="btn btn-outline-primary rounded-pill px-3" data-filter="KK" for="option5">Keterampilan Khusus
                (KK)</label>
        </div>
        <div class="col text-end">
            {{-- Button trigger modal --}}
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importIkModal" @if($data_cpl->isEmpty()) disabled @endif>
                Import IK
            </button>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importCplModal">
                Import CP
            </button>
            <button type="button" class="btn btn-primary" id="btn-tambah-cpl" data-bs-toggle="modal"
                    data-bs-target="#cplModal">
                Tambah CP
            </button>
        </div>
    </div>

    {{-- CPL Modal --}}
    <div class="modal fade" id="cplModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="cplModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="cplModalLabel">Tambah Capaian Pembelajaran</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" autocomplete="off" id="formCpl">
                        <input type="hidden" name="id_cpl" id="id_cpl" value="">
                        <div id="method_spoofing_cpl"></div>
                        @csrf

                        <div id="kode"></div>

                        <div class="mb-3">
                            <label for="domain" class="form-label fw-bold">Domain</label>
                            <select class="form-select" id="domain" name="domain">
                                <option value="" selected>Pilih domain</option>
                                <option value="Sikap">Sikap (SP)</option>
                                <option value="Pengetahuan">Pengetahuan (PP)</option>
                                <option value="Keterampilan Umum">Keterampilan Umum (KU)</option>
                                <option value="Keterampilan Khusus">Keterampilan Khusus (KK)</option>
                            </select>
                            <div id="domain_feedback" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" placeholder="Deskrispi Capaian Pembelajaran"
                                      name="deskripsi" rows="5"></textarea>
                            <div id="deskripsi_feedback" class="text-danger"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col">
                            <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal"
                                    aria-label="Close">Batal
                            </button>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-success w-100" id="btn-submit-cpl" form="formCpl">
                                Tambah
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- IK Modal --}}
    <div class="modal fade" id="ikModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="ikModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="ikModalLabel">Tambah Indikator Kinerja</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="" autocomplete="off" id="formIk">
                        @csrf
                        <div id="method_spoofing_ik"></div>
                        <div id="id_cpl_ik"></div>
                        <div id="id_ik"></div>

                        <div class="mb-3">
                            <label for="cp_induk" class="form-label fw-bold">Capaian Pembelajaran Induk</label>
                            <input type="text" class="form-control" id="cp_induk" name="cp_induk" readonly>
                            <div id="cp_induk_feedback" class="text-danger"></div>
                        </div>

                        <div id="field_kode_ik"></div>

                        <div class="mb-3">
                            <label for="deskripsi_ik" class="form-label fw-bold">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi_ik"
                                      placeholder="Deskripsi Indikator Kinerja"
                                      id="deskripsi_ik" rows="3"></textarea>
                            <div id="deskripsi_ik_feedback" class="text-danger"></div>
                        </div>

                        <hr class="my-4">

                        <div class="mb-3">
                            <label for="rubrik1" class="form-label fw-bold">Rubrik Sangat Kurang ({{ $kurikulum->nilai_rubrik['min'][0] }} &mdash; {{ $kurikulum->nilai_rubrik['max'][0] }})</label>
                            <textarea class="form-control" id="rubrik1" name="rubrik[]" placeholder="Deskripsi Rubrik Sangat Kurang"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="rubrik2" class="form-label fw-bold">Rubrik Kurang ({{ $kurikulum->nilai_rubrik['min'][1] }} &mdash; {{ $kurikulum->nilai_rubrik['max'][1] }})</label>
                            <textarea class="form-control" id="rubrik2" name="rubrik[]" placeholder="Deskripsi Rubrik Kurang"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="rubrik3" class="form-label fw-bold">Rubrik Cukup ({{ $kurikulum->nilai_rubrik['min'][2] }} &mdash; {{ $kurikulum->nilai_rubrik['max'][2] }})</label>
                            <textarea class="form-control" id="rubrik3" name="rubrik[]" placeholder="Deskripsi Rubrik Cukup"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="rubrik4" class="form-label fw-bold">Rubrik Baik ({{ $kurikulum->nilai_rubrik['min'][3] }} &mdash; {{ $kurikulum->nilai_rubrik['max'][3] }})</label>
                            <textarea class="form-control" id="rubrik4" name="rubrik[]" placeholder="Deskripsi Rubrik Baik"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="rubrik5" class="form-label fw-bold">Rubrik Sangat Baik ({{ $kurikulum->nilai_rubrik['min'][4] }} &mdash; {{ $kurikulum->nilai_rubrik['max'][4] }})</label>
                            <textarea class="form-control" id="rubrik5" name="rubrik[]" placeholder="Deskripsi Rubrik Sangat Baik"></textarea>
                        </div>
                        <div id="rubrik_ik_feedback" class="text-danger"></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col">
                            <button type="button" class="btn btn-danger w-100"
                                    data-bs-dismiss="modal">Batal
                            </button>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-success w-100" id="btn-submit-ik" form="formIk">Tambah</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Rubrik Modal --}}
    <div class="modal fade" id="rubrikModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="rubrikModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="rubrikModalLabel">Rubrik Indikator Kinerja</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-4">
                        <div class="fw-bold" id="kode_ik_rubrik"></div>
                        <div id="deskripsi_ik_rubrik"></div>
                    </div>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 20%" class="text-center bg-body-tertiary">Sangat Kurang</th>
                                <th scope="col" style="width: 20%" class="text-center bg-body-tertiary">Kurang</th>
                                <th scope="col" style="width: 20%" class="text-center bg-body-tertiary">Cukup</th>
                                <th scope="col" style="width: 20%" class="text-center bg-body-tertiary">Baik</th>
                                <th scope="col" style="width: 20%" class="text-center bg-body-tertiary">Sangat Baik</th>
                            </tr>
                            <tr>
                                <td class="fw-bold text-center bg-body-tertiary">
                                    {{ $kurikulum->nilai_rubrik['min'][0] }} &mdash; {{ $kurikulum->nilai_rubrik['max'][0] }}
                                </td>
                                <td class="fw-bold text-center bg-body-tertiary">
                                    {{ $kurikulum->nilai_rubrik['min'][1] }} &mdash; {{ $kurikulum->nilai_rubrik['max'][1] }}
                                </td>
                                <td class="fw-bold text-center bg-body-tertiary">
                                    {{ $kurikulum->nilai_rubrik['min'][2] }} &mdash; {{ $kurikulum->nilai_rubrik['max'][2] }}
                                </td>
                                <td class="fw-bold text-center bg-body-tertiary">
                                    {{ $kurikulum->nilai_rubrik['min'][3] }} &mdash; {{ $kurikulum->nilai_rubrik['max'][3] }}
                                </td>
                                <td class="fw-bold text-center bg-body-tertiary">
                                    {{ $kurikulum->nilai_rubrik['min'][4] }} &mdash; {{ $kurikulum->nilai_rubrik['max'][4] }}
                                </td>
                            </tr>
                            <tr>
                                <td id="td_rubrik1" class="align-text-top"></td>
                                <td id="td_rubrik2" class="align-text-top"></td>
                                <td id="td_rubrik3" class="align-text-top"></td>
                                <td id="td_rubrik4" class="align-text-top"></td>
                                <td id="td_rubrik5" class="align-text-top"></td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Import CPL Modal --}}
    <div class="modal fade" id="importCplModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="importCplModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="importCplModalLabel">Import Capaian Pembelajaran</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('kaprodi.kurikulum.cpl.import', ['kurikulum' => $kurikulum->tahun]) }}"
                          method="POST" autocomplete="off"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="mb-5">
                            <label for="formFileJurusan" class="form-label fw-bold">Upload File Excel</label>
                            <input class="form-control" type="file" id="formFileCpl" name="formFileCpl" accept=".xlsx">
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('kaprodi.kurikulum.cpl.downloadTemplate', ['kurikulum' => $kurikulum->tahun]) }}"
                               class="btn btn-outline-success">Download Template</a>
                            <button class="btn btn-success" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Import IK Modal --}}
    <div class="modal fade" id="importIkModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="importIkModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="importIkModalLabel">Import Indikator Kinerja</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('kaprodi.kurikulum.ik.import', ['kurikulum' => $kurikulum->tahun]) }}"
                          method="POST" autocomplete="off"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="mb-5">
                            <label for="formFileIk" class="form-label fw-bold">Upload File Excel</label>
                            <input class="form-control" type="file" id="formFileIk" name="formFileIk" accept=".xlsx">
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('kaprodi.kurikulum.ik.downloadTemplate', ['kurikulum' => $kurikulum->tahun]) }}"
                               class="btn btn-outline-success">Download Template</a>
                            <button class="btn btn-success" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Data CPL --}}
    <div class="row">
        <div class="col-12">
            <div class="accordion" id="accordionExample">
                @forelse ($data_cpl as $index => $cpl)
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button {{ $loop->index === 0 ? '' : 'collapsed' }}"
                                    type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{ $index }}"
                                    aria-expanded="{{ $loop->index === 0 ? 'true' : 'false' }}"
                                    aria-controls="collapse{{ $index }}">
                                {{ $cpl['kode'] }} - {{ $cpl['deskripsi'] }}
                            </button>
                        </h2>
                        <div id="collapse{{ $index }}"
                             class="accordion-collapse collapse {{ $loop->index === 0 ? 'show' : '' }}"
                             data-bs-parent="#accordionExample">
                            <div class="accordion-body py-4">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="fw-bold">Indikator Kinerja</div>
                                    <button type="button"
                                            class="btn btn-primary btn-tambah-ik btn-sm ms-3"
                                            data-bs-toggle="modal"
                                            data-bs-target="#ikModal"
                                            data-id="{{ $cpl->id }}"
                                            data-kode="{{ $cpl->kode }}"
                                    >Tambah IK</button>
                                </div>
                                @if( $cpl->indikatorKinerja->isNotEmpty() )
                                    <table class="table table-bordered table-hover">
                                        <tbody>
                                        @foreach($cpl->indikatorKinerja as $ik)
                                            <tr>
                                                <td class="fw-bold text-nowrap align-middle">{{ $ik->kode }}</td>
                                                <td class="align-middle">{{ $ik->deskripsi }}</td>
                                                <td scope="col" class="align-middle" style="width: 10%">
                                                    <div>
                                                        <button type="button"
                                                                class="btn btn-warning btn-sm btn-ubah-ik text-nowrap mb-2"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#ikModal"
                                                                data-cpl="{{ $ik->capaianPembelajaranLulusan->kode }}"
                                                                data-id="{{ $ik->id }}"
                                                                data-kode="{{ $ik->kode }}"
                                                                data-deskripsi="{{ $ik->deskripsi }}"
                                                                data-rubrik1="{{ $ik->rubrik->where('urutan', 1)->pluck('deskripsi')->first() }}"
                                                                data-rubrik2="{{ $ik->rubrik->where('urutan', 2)->pluck('deskripsi')->first() }}"
                                                                data-rubrik3="{{ $ik->rubrik->where('urutan', 3)->pluck('deskripsi')->first() }}"
                                                                data-rubrik4="{{ $ik->rubrik->where('urutan', 4)->pluck('deskripsi')->first() }}"
                                                                data-rubrik5="{{ $ik->rubrik->where('urutan', 5)->pluck('deskripsi')->first() }}"
                                                        >Ubah IK</button>
                                                        <button type="button"
                                                                class="btn btn-info btn-sm btn-show-rubrik"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#rubrikModal"
                                                                data-kode="{{ $ik->kode }}"
                                                                data-deskripsi="{{ $ik->deskripsi }}"
                                                                data-rubrik1="{{ $ik->rubrik->where('urutan', 1)->pluck('deskripsi')->first() }}"
                                                                data-rubrik2="{{ $ik->rubrik->where('urutan', 2)->pluck('deskripsi')->first() }}"
                                                                data-rubrik3="{{ $ik->rubrik->where('urutan', 3)->pluck('deskripsi')->first() }}"
                                                                data-rubrik4="{{ $ik->rubrik->where('urutan', 4)->pluck('deskripsi')->first() }}"
                                                                data-rubrik5="{{ $ik->rubrik->where('urutan', 5)->pluck('deskripsi')->first() }}">Lihat Rubrik</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div>Belum ada pemetaan.</div>
                                @endif
                            </div>
                            <div class="accordion-footer bg-light mb-0 p-3 border-top ">
                                <button type="button"
                                        class="btn btn-warning btn-ubah-cpl"
                                        data-bs-toggle="modal"
                                        data-bs-target="#cplModal"
                                        data-id="{{ $cpl->id }}"
                                        data-kode="{{ $cpl->kode }}"
                                        data-domain="{{ $cpl->domain }}"
                                        data-deskripsi="{{ $cpl->deskripsi }}"
                                >Ubah CP</button>
                                <a href="{{ route('kaprodi.cpl.show', ['kurikulum' => $kurikulum->tahun, 'cpl' => $cpl->id]) }}" class="btn btn-info">Detail CP</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-secondary" role="alert">
                        Belum ada data Capaian Pembelajaran.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            const cplModal = document.getElementById('cplModal');
            const cplModalInstance = new bootstrap.Modal('#cplModal');
            const ikModal = document.getElementById('ikModal');
            const ikModalInstance = new bootstrap.Modal('#ikModal');

            cplModal.addEventListener('hidden.bs.modal', event => {
                $('#formCpl').attr('action', '');
                $('#domain').prop('selectedIndex', 0).attr('disabled', false);
                $('#deskripsi').val('');

                $('#domain_feedback').html('');
                $('#deskripsi_feedback').html('');
            });

            ikModal.addEventListener('hidden.bs.modal', event => {
                $('#formIk').attr('action', '');
                $('#method_spoofing_ik').html('');
                $('#id_cpl_ik').html('');
                $('#id_ik').html('');
                $('#cp_induk').val('');
                $('#field_kode_ik').html('');
                $('#deskripsi_ik').val('');
                $('#rubrik1').val('');
                $('#rubrik2').val('');
                $('#rubrik3').val('');
                $('#rubrik4').val('');
                $('#rubrik5').val('');

                $('#cp_induk_feedback').html('');
                $('#deskripsi_ik_feedback').html('');
                $('#rubrik_ik_feedback').html('');
            });

            $('input[name="options"]').change(function () {
                let filterValue = $('label[for="' + $(this).attr('id') + '"]').data('filter');
                if (filterValue === 'Semua') {
                    $('.accordion-item').show();
                } else {
                    $('.accordion-item').hide();
                    $('.accordion-item').each(function () {
                        if ($(this).find('button').text().includes(filterValue)) {
                            $(this).show();
                        }
                    });
                }
            });

            $('#btn-tambah-cpl').on('click', function (e) {
                $('#formCpl').attr('action', "{{ route('kaprodi.cpl.store', ['kurikulum' => $kurikulum->tahun]) }}");
                $('#id_cpl').val('');
                $('#method_spoofing_cpl').html('');
                $('#kode').html('');
                $('#btn-submit-cpl').html('Tambah').removeClass('btn-warning').addClass('btn-success');
                $('#cplModalLabel').html('Tambah Capaian Pembelajaran');
            });

            $('.btn-ubah-cpl').on('click', function (e) {
                const id = $(this).data('id');
                const kode = $(this).data('kode');
                const domain = $(this).data('domain');
                const deskripsi = $(this).data('deskripsi');

                $('#formCpl').attr('action', '{{ url()->current() }}' + '/' + id);
                $('#id_cpl').val(id);
                $('#method_spoofing_cpl').html('{{ method_field('put') }}');
                $('#kode').html(`
                    <div class="mb-3">
                            <label for="kode" class="form-label fw-bold">Kode CP</label>
                            <input type="text" class="form-control" value="${kode}" disabled>
                        </div>
               `);
                $('#domain').val(domain).attr('disabled', true);
                $('#deskripsi').val(deskripsi);
                $('#btn-submit-cpl').html('Ubah').removeClass('btn-success').addClass('btn-warning');
                $('#cplModalLabel').html('Ubah Capaian Pembelajaran');
            });

            $('#formCpl').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    type: "post",
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: "JSON",
                    success: function (res) {
                        console.log(res)
                        cplModalInstance.hide();
                        location.reload();
                    },
                    error: function (err) {
                        // when status code is 422, it's a validation issue
                        if (err.status == 422) {
                            console.log(err.responseJSON);
                            if (err.responseJSON.errors.domain) {
                                $('#domain_feedback').html(err.responseJSON.errors.domain[0]);
                            } else {
                                $('#domain_feedback').html('');
                            }

                            if (err.responseJSON.errors.deskripsi) {
                                $('#deskripsi_feedback').html(err.responseJSON.errors.deskripsi[0]);
                            } else {
                                $('#deskripsi_feedback').html('');
                            }
                        }
                    }
                });
            });

            $('.btn-tambah-ik').on('click', function (e) {
               const id = $(this).data('id');
               const kode = $(this).data('kode');
               const route = '{{ route('kaprodi.ik.store', ['kurikulum' => $kurikulum->tahun]) }}';

               $('#ikModalLabel').html('Tambah Indikator Kinerja');

               $('#formIk').attr('action', route);
               $('#id_cpl_ik').html(`<input type="hidden" name="id_cpl" value="${id}">`);
               $('#cp_induk').val(kode);

               $('#btn-submit-ik').html('Tambah').addClass('btn-success').removeClass('btn-warning');
            });

            $('.btn-ubah-ik').on('click', function (e) {
                const cpl = $(this).data('cpl');
                const id = $(this).data('id');
                const kode = $(this).data('kode');
                const deskripsi = $(this).data('deskripsi');
                const rubrik1 = $(this).data('rubrik1');
                const rubrik2 = $(this).data('rubrik2');
                const rubrik3 = $(this).data('rubrik3');
                const rubrik4 = $(this).data('rubrik4');
                const rubrik5 = $(this).data('rubrik5');
                const route = `{{ route('kaprodi.ik.store', ['kurikulum' => $kurikulum->tahun]) }}` + `/${id}`;

                $('#ikModalLabel').html('Ubah Indikator Kinerja');

                $('#formIk').attr('action', route);
                $('#method_spoofing_ik').html('{{ method_field('patch') }}');
                $('#id_ik').html(`<input type="hidden" name="id_ik" value="${id}">`);
                $('#cp_induk').val(cpl);
                $('#field_kode_ik').html(`
                    <div class="mb-3">
                        <label for="kode_ik" class="form-label fw-bold">Kode Indikator Kinerja</label>
                        <input type="text" class="form-control" id="kode_ik" readonly value="${kode}">
                        <div id="kode_ik_feedback" class="text-danger"></div>
                    </div>
                `);
                $('#deskripsi_ik').val(deskripsi);
                $('#rubrik1').val(rubrik1);
                $('#rubrik2').val(rubrik2);
                $('#rubrik3').val(rubrik3);
                $('#rubrik4').val(rubrik4);
                $('#rubrik5').val(rubrik5);

                $('#btn-submit-ik').html('Ubah').addClass('btn-warning').removeClass('btn-success');
            });

            $('#formIk').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    type: "post",
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: "JSON",
                    success: function (res) {
                        console.log(res);
                        ikModalInstance.hide();
                        location.reload();
                    },
                    error: function (err) {
                        console.log(err);
                        // when status code is 422, it's a validation issue
                        if (err.status == 422) {
                            if (err.responseJSON.errors.cp_induk) {
                                $('#cp_induk_feedback').html(err.responseJSON.errors.cp_induk[0]);
                            } else {
                                $('#cp_induk_feedback').html('');
                            }

                            if (err.responseJSON.errors.deskripsi_ik) {
                                $('#deskripsi_ik_feedback').html(err.responseJSON.errors.deskripsi_ik[0]);
                            } else {
                                $('#deskripsi_ik_feedback').html('');
                            }

                            if (err.responseJSON.errors.rubrik) {
                                $('#rubrik_ik_feedback').html(err.responseJSON.errors.rubrik[0]);
                            } else {
                                $('#rubrik_ik_feedback').html('');
                            }
                        }
                    }
                });
            });

            $('.btn-show-rubrik').on('click', function (e) {
                const kode = $(this).data('kode');
                const deskripsi = $(this).data('deskripsi');
                const rubrik1 = $(this).data('rubrik1');
                const rubrik2 = $(this).data('rubrik2');
                const rubrik3 = $(this).data('rubrik3');
                const rubrik4 = $(this).data('rubrik4');
                const rubrik5 = $(this).data('rubrik5');

                $('#kode_ik_rubrik').html(kode);
                $('#deskripsi_ik_rubrik').html(deskripsi);
                $('#td_rubrik1').html(rubrik1);
                $('#td_rubrik2').html(rubrik2);
                $('#td_rubrik3').html(rubrik3);
                $('#td_rubrik4').html(rubrik4);
                $('#td_rubrik5').html(rubrik5);
            });
        });
    </script>
@endpush
