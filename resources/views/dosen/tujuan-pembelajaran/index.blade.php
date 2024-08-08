@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('dosen.mata-kuliah.tujuan-pembelajaran', $mata_kuliah->kode, $mata_kuliah->mataKuliahRegister[0]->jenis) }}
    <h1 class="fw-bold mb-4">{{ $title }}</h1>
@endsection

@section('main')
    @if($kurikulum->status->is(\App\Enums\StatusKurikulum::Pengelolaan))
        <div class="d-flex justify-content-end mb-4">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tpModal">
                Tambah Tujuan Pembelajaran
            </button>
        </div>
    @endif

    <div class="modal fade" id="tpModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Tujuan Pembelajaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('dosen.mata-kuliah.tujuan-pembelajaran.store', ['kodeMataKuliah' => $mata_kuliah->kode, 'jenis' => $mata_kuliah->mataKuliahRegister[0]->jenis]) }}" id="formTp">
                        @csrf
                        <div id="method"></div>
                        <div class="row">
                            <div class="col-6">
                                <div class="card">
                                    <h5 class="card-header">Pilih Indikator Kinerja</h5>
                                    <div class="card-body py-4 px-4 overflow-auto" style="height: 350px">
                                        @foreach ($mata_kuliah->mataKuliahRegister[0]->IndikatorKinerja as $ik)
                                            <div class="d-flex flex-column mb-4">
                                                <div class="d-flex flex-column">
                                                    <div class="d-flex flex-row">
                                                        <input type="checkbox" name="checkbox[{{ $ik->id }}]" value="{{ $ik->pivot->id }}" id="ik{{ $ik->id }}">
                                                        <div class="fw-bold" style="margin-left: 10px">
                                                            {{ $ik->kode }}
                                                        </div>
                                                    </div>
                                                    <div class="ms-4">
                                                        {{ $ik->deskripsi }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="d-flex flex-column mb-4">
                                    <label for="exampleFormControlInput1" class="form-label fw-bold">Deskripsi</label>
                                    <textarea class="form-control" id="exampleFormControlInput1" rows="3" name="deskripsi"></textarea>
                                </div>

                                <div class="d-flex flex-column ">
                                    <div class="fw-bold mb-2">Bobot TP terhadap IK</div>
                                    <select class="form-select" name="bobot" id="bobot">
                                        <option value="" selected>Pilih Bobot</option>
                                        <option value="1">1 &mdash; Sedikit Relevan</option>
                                        <option value="2">2 &mdash; Relevan</option>
                                        <option value="3">3 &mdash; Sangat Relevan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="btn-submit" form="formTp">Tambah</button>
                </div>
            </div>
        </div>
    </div>

    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <!-- Alasan Modal -->
    <div class="modal fade" id="alasanModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="alasanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="alasanModalLabel">Alasan Penolakan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="alasanModalBody">

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            @if ($data_tp->isEmpty())
                <div class="alert alert-secondary" role="alert">
                    Belum ada tujuan pembelajaran.
                </div>
            @else
                <div class="accordion accordion-flush border border-1" id="accordionFlushExample">
                    @foreach ($data_tp as $index => $tp)
                        <div class="accordion-item">
                            <h2 class="accordion-header d-flex flex-row" id="flush-headingOne">
                                <button class="accordion-button collapsed bg-body-tertiary" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapse{{ $index }}" aria-expanded="false"
                                        aria-controls="flush-collapse{{ $index }}">
                                    {{ $tp->kode }}
                                    <div class="{{ checkStatusTP($tp->tanggal_divalidasi, $tp->alasan_penolakan)['class'] }}">
                                        {{ checkStatusTP($tp->tanggal_divalidasi, $tp->alasan_penolakan)['text'] }}</div>
                                </button>
                            </h2>
                            <div id="flush-collapse{{ $index }}" class="accordion-collapse collapse"
                                 aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <div class="d-flex flex-column mb-3">
                                        <div class="fw-bold">Deskripsi</div>
                                        <div class="">{{ $tp->deskripsi }}</div>
                                    </div>
                                    <div>
                                        <div class="fw-bold">Indikator Kinerja</div>
                                        <ul class="mb-0">
                                            @foreach ($tp->petaIkMk as $petaIkMk)
                                                <li>
                                                    {{ $petaIkMk->indikatorKinerja->kode . ' (Bobot: ' . $petaIkMk->pivot->bobot_tp . ')' }}<br>
                                                    {{ $petaIkMk->indikatorKinerja->deskripsi }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @if (!$tp->status->is(\App\Enums\StatusValidasiTP::Disetujui))
                                        <div class="mt-4">
                                            @if($kurikulum->status->is(\App\Enums\StatusKurikulum::Pengelolaan))
                                                <button type="button" class="btn btn-warning btn-edit" data-bs-toggle="modal" data-bs-target="#tpModal" data-url="{{ route('dosen.mata-kuliah.tujuan-pembelajaran.show', ['kodeMataKuliah' => $mata_kuliah->kode, 'jenis' => $mata_kuliah->mataKuliahRegister[0]->jenis, 'id' => $tp->id]) }}">Ubah</button>
                                            @endif

                                            @if ($tp->status->is(\App\Enums\StatusValidasiTP::Ditolak) && $kurikulum->status->is(\App\Enums\StatusKurikulum::Pengelolaan))
                                                <button type="button" class="btn btn-secondary btn-alasan" data-bs-toggle="modal" data-bs-target="#alasanModal" data-alasan="{{ $tp->alasan_penolakan }}">Lihat Alasan Penolakan</button>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            let formEdit = false;
            const tpModal = document.getElementById('tpModal');
            const tpModalInstance = new bootstrap.Modal('#tpModal');

            tpModal.addEventListener('hidden.bs.modal', event => {
                $('#exampleModalLabel').html('Tambah Tujuan Pembelajaran');
                $('#btn-submit').html('Tambah').addClass('btn-success').removeClass('btn-warning');
                $('#exampleFormControlInput1').val('');
                $('#bobot').prop('selectedIndex', 0);
                $('input[type="checkbox"]').prop('checked', false);
                $('#method').html('');
                $('#formTp').attr('action', '{{ route('dosen.mata-kuliah.tujuan-pembelajaran.store', ['kodeMataKuliah' => $mata_kuliah->kode, 'jenis' => $mata_kuliah->mataKuliahRegister[0]->jenis]) }}');
                formEdit = false;
            });

            $('.btn-edit').on('click', function () {
                const url = $(this).data('url');

                $('#exampleModalLabel').html('Ubah Tujuan Pembelajaran');
                $('#btn-submit').html('Ubah').addClass('btn-warning').removeClass('btn-success');
                $('#method').html('{{ method_field('patch') }}');
                $('#formTp').attr('action', url);
                formEdit = true;

                $.ajax({
                    type: "get",
                    url: url,
                    dataType: "JSON",
                    success: function(res) {
                        console.log(res);

                        $('#exampleFormControlInput1').val(res.data.deskripsi);
                        $('#bobot').val(res.data.bobot);
                        res.data.indikator_kinerja.forEach((element) => {
                            $('#ik' + element).prop('checked', true);
                        });
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            });

            $('#btn-submit').on('click', function (e) {
                e.preventDefault();

                if (formEdit === true) {
                    $.ajax({
                        type: "post",
                        url: $('#formTp').attr('action'),
                        data: $('#formTp').serialize(),
                        dataType: "JSON",
                        success: function (res) {
                            console.log(res)
                            tpModalInstance.hide();
                            location.reload();
                        },
                        error: function (err) {
                            // when status code is 422, it's a validation issue
                            if (err.status == 422) {
                                console.log(err.responseJSON);
                            } else if (err.status == 500) {
                                console.log(err);
                            }
                        }
                    });
                } else {
                    $('#formTp').submit();
                }
            });

            $('.btn-alasan').on('click', function () {
               const alasan = $(this).data('alasan');

               $('#alasanModalBody').html(alasan);
            });
        });
    </script>
@endpush
