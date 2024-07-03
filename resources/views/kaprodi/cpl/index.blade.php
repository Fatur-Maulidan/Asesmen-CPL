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
                        <input type="hidden" name="id_cpl" value="">
                        <div class="mb-3">
                            <label for="cp_induk" class="form-label fw-bold">Capaian Pembelajaran Induk</label>
                            <input type="text" class="form-control" id="cp_induk" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi_ik" class="form-label fw-bold">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi_ik"
                                      placeholder="Deskripsi Indikator Kinerja"
                                      id="deskripsi_ik" rows="3"></textarea>
                        </div>
                        <hr class="my-4">
                        <div class="mb-3">
                            <label for="rubrik1" class="form-label fw-bold">Rubrik Sangat Kurang</label>
                            <textarea class="form-control" id="rubrik1" name="rubrik[]" placeholder="Deskripsi Rubrik Sangat Kurang"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="rubrik2" class="form-label fw-bold">Rubrik Kurang</label>
                            <textarea class="form-control" id="rubrik2" name="rubrik[]" placeholder="Deskripsi Rubrik Kurang"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="rubrik3" class="form-label fw-bold">Rubrik Cukup</label>
                            <textarea class="form-control" id="rubrik3" name="rubrik[]" placeholder="Deskripsi Rubrik Cukup"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="rubrik4" class="form-label fw-bold">Rubrik Baik</label>
                            <textarea class="form-control" id="rubrik4" name="rubrik[]" placeholder="Deskripsi Rubrik Baik"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="rubrik5" class="form-label fw-bold">Rubrik Sangat Baik</label>
                            <textarea class="form-control" id="rubrik5" name="rubrik[]" placeholder="Deskripsi Rubrik Sangat Baik"></textarea>
                        </div>
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
                            <button type="submit" class="btn btn-success w-100" form="formIk">Tambah</button>
                        </div>
                    </div>
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
                                <div class="fw-bold">Indikator Kinerja</div>
                                @forelse($cpl->indikatorKinerja as $ik)

                                @empty
                                    <div>Belum ada pemetaan.</div>
                                @endforelse
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
                                >Ubah CP
                                </button>
                                <button type="button"
                                        class="btn btn-primary btn-tambah-ik"
                                        data-bs-toggle="modal"
                                        data-bs-target="#ikModal"
                                        data-id="{{ $cpl->id }}"
                                        data-kode="{{ $cpl->kode }}"
                                >Tambah IK
                                </button>
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

            cplModal.addEventListener('hidden.bs.modal', event => {
                $('#formCpl').attr('action', '');
                $('#domain').prop('selectedIndex', 0).attr('disabled', false);
                $('#deskripsi').val('');

                $('#domain_feedback').html('');
                $('#deskripsi_feedback').html('');
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
        });
    </script>
@endpush
