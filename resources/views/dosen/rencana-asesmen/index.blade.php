@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('dosen.mata-kuliah.rencana-asesmen.index', $mata_kuliah->kode) }}
    <h1 class="fw-bold mb-4">{{ $title }}</h1>
@endsection

@section('main')
    {{-- Action Button --}}
    <div class="row mb-4">
        <div class="col-12">
            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                    data-bs-target="#tambahRencanaAsesmenModal">Tambah Rencana Asesmen
            </button>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="tambahRencanaAsesmenModal" data-bs-backdrop="static" data-bs-keyboard="false"
         tabindex="-1" aria-labelledby="tambahRencanaAsesmenModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tambahRencanaAsesmenModalLabel">Tambah Rencana Asesmen</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form
                        action="{{ route('dosen.mata-kuliah.rencana-asesmen.store', ['kodeMataKuliah' => $mata_kuliah->kode]) }}"
                        method="post" autocomplete="off" id="formTambahRencanaAsesmen">
                        @csrf
                        <div class="mb-3">
                            <label for="urutan" class="form-label fw-bold">Urutan Asesmen</label>
                            <input type="number" class="form-control" id="urutan" name="urutan" min="1" max="20"
                                   placeholder="Contoh: 1">
                        </div>
                        <div class="mb-3">
                            <label for="kategori" class="form-label fw-bold">Kategori</label>
                            <select class="form-select" id="kategori" name="kategori">
                                <option value="" selected>Pilih kategori asesmen</option>
                                <option value="Tugas">Tugas</option>
                                <option value="Kuis">Kuis</option>
                                <option value="ETS">ETS</option>
                                <option value="EAS">EAS</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="minggu" class="form-label fw-bold">Minggu ke Berapa Asesmen Diujikan</label>
                            <input type="number" class="form-control" id="minggu" name="minggu" min="1" max="16"
                                   placeholder="Contoh: 1">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label fw-bold d-block">Jenis Mata Kuliah</label>
                            @foreach($mata_kuliah->mataKuliahRegister as $mkr)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="mata_kuliah"
                                           id="{{ $mkr->jenis }}"
                                           value="{{ $mkr->id }}">
                                    <label class="form-check-label" for="{{ $mkr->jenis }}">{{ $mkr->jenis }}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <label for="tp" class="form-label fw-bold">TP yang Diujikan</label>
                            <select class="form-select" id="tp" name="tp[]" multiple>
                                @foreach($mata_kuliah->mataKuliahRegister as $mkr)
                                    <optgroup label="{{ $mkr->jenis }}">
                                        @foreach($mkr->tujuanPembelajaran as $tp)
                                            <option value="{{ $tp->id }}"><span>{{ $tp->kode }}</span>
                                                - {{ $tp->deskripsi }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success" form="formTambahRencanaAsesmen">Tambah</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Data Rencana Asesmen --}}
    <div class="row">
        <div class="col-12">
            @foreach($mata_kuliah->mataKuliahRegister as $mkr)
                <h2>{{ $mkr->jenis }}</h2>
                <div class="accordion accordion-flush border border-2 mb-4"
                     id="daftarRencanaAsesmen{{ $loop->iteration }}">
                    @forelse($mkr->rencanaAsesmen as $ra)
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button
                                    class="accordion-button fw-bold bg-body-tertiary @if(!$loop->first) collapsed @endif"
                                    type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{ $loop->parent->iteration . '-' . $loop->iteration }}"
                                    aria-expanded="true"
                                    aria-controls="collapse{{ $loop->parent->iteration . '-' . $loop->iteration }}">
                                    {{ $ra->kode }}
                                </button>
                            </h2>
                            <div id="collapse{{ $loop->parent->iteration . '-' . $loop->iteration }}"
                                 class="accordion-collapse collapse @if($loop->first) show @endif"
                                 data-bs-parent="#daftarRencanaAsesmen{{ $loop->parent->iteration }}">
                                <div class="accordion-body">
                                    <table class="table table-hover table-bordered my-2">
                                        <tbody>
                                        <tr>
                                            <td class="fw-bold">Kategori</td>
                                            <td class="fw-bold text-nowrap">Minggu ke-</td>
                                            <td class="fw-bold">TP yang diujikan</td>
                                        </tr>
                                        <tr>
                                            <td>{{ $ra->kategori }}</td>
                                            <td>{{ $ra->minggu }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <ul class="mb-0">
                                                        @foreach($ra->tujuanPembelajaran as $tp)
                                                            {{--<span class="badge rounded-pill text-bg-primary me-2 fs-6">{{ $tp->kode }}</span>--}}
                                                            <li>{{ $tp->kode }} - {{ $tp->deskripsi }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <button type="button" class="btn btn-danger btn-hapus mt-2" data-bs-toggle="modal"
                                            data-bs-target="#confirmModal" data-id="{{ $ra->id }}">Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-secondary" role="alert">
                            Belum ada rencana asesmen untuk mata kuliah {{ $mkr->jenis }}.
                        </div>
                    @endforelse
                </div>
            @endforeach
        </div>
    </div>

    {{-- Confirm modal --}}
    <div class="modal fade" id="confirmModal" data-bs-backdrop="static" data-bs-keyboard="false"
         aria-hidden="true" aria-labelledby="confirmModalLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="confirmModalLabel">Konfirmasi Hapus Rencana Asesmen</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-4">
                    <div class="text-center">
                        <i class="bi bi-exclamation-triangle-fill text-warning fs-1"></i>
                        <div>Anda yakin ingin hapus?</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col">
                            <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Tidak
                            </button>
                        </div>
                        <div class="col">
                            <form action="" method="post" id="formHapus">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-success mb-0 w-100">Ya</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            let url = "{{ url()->current() }}";
            // $('input[type=radio]').on('change', function (e) {
            //    $('#tp').attr('disabled', false);
            // });

            $('#tp').select2({
                theme: "bootstrap-5",
                closeOnSelect: false,
                dropdownParent: $('#tambahRencanaAsesmenModal'),
                placeholder: "Pilih Tujuan Pembelajaran",
                allowClear: true
            });

            $('.btn-hapus').on('click', function () {
                const id = $(this).data('id');
                const route = url + `/${id}`;

                $('#formHapus').attr('action', route);
            });
        });
    </script>
@endpush
