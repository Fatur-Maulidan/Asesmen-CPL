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
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahCplModal">
                Tambah CP
            </button>
        </div>
    </div>

    {{-- Tambah CPL Modal --}}
    <div class="modal fade" id="tambahCplModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="tambahCplModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="tambahCplModalLabel">Tambah Capaian Pembelajaran</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('kaprodi.cpl.store', ['kurikulum' => $kurikulum->tahun]) }}" method="post" autocomplete="off" id="formTambahCpl">
                        @csrf
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
                                aria-label="Close">Batal</button>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-success w-100" form="formTambahCpl">Tambah</button>
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
                    <form action="{{ route('kaprodi.kurikulum.cpl.import', ['kurikulum' => $kurikulum->tahun]) }}" method="POST" autocomplete="off"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="mb-5">
                            <label for="formFileJurusan" class="form-label fw-bold">Upload File Excel</label>
                            <input class="form-control" type="file" id="formFileCpl" name="formFileCpl" accept=".xlsx">
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('kaprodi.kurikulum.cpl.downloadTemplate', ['kurikulum' => $kurikulum->tahun]) }}" class="btn btn-outline-success">Download Template</a>
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
                            <div class="accordion-body">
                                <div class="fw-bold">Indikator Kinerja</div>
                                @forelse($cpl->indikatorKinerja as $ik)

                                @empty
                                    <div>Belum ada pemetaan.</div>
                                @endforelse
                            </div>
                            <div class="accordion-footer bg-light mb-0 p-3 border-top ">
                                <a href="{{ route('kaprodi.cpl.show', ['kurikulum' => $kurikulum->tahun, 'cpl' => $cpl['kode']]) }}"
                                   class="me-3">Lihat
                                    detail</a>
                                {{-- <a href="">Ubah pembobotan</a> --}}
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
        $(document).ready(function() {
            const tambahCplModal = document.getElementById('tambahCplModal');
            const tambahCplModalInstance = new bootstrap.Modal('#tambahCplModal');

            tambahCplModal.addEventListener('hidden.bs.modal', event => {
                $('#domain').prop('selectedIndex', 0);
                $('#deskripsi').val('');

                $('#domain_feedback').html('');
                $('#deskripsi_feedback').html('');
            });

            $('input[name="options"]').change(function() {
                let filterValue = $('label[for="' + $(this).attr('id') + '"]').data('filter');
                if (filterValue === 'Semua') {
                    $('.accordion-item').show();
                } else {
                    $('.accordion-item').hide();
                    $('.accordion-item').each(function() {
                        if ($(this).find('button').text().includes(filterValue)) {
                            $(this).show();
                        }
                    });
                }
            });

            $('#formTambahCpl').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    type: "post",
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: "JSON",
                    success: function (res) {
                        console.log(res)
                        tambahCplModalInstance.hide();
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
