@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('kaprodi.tp.validasi', $kurikulum->tahun) }}
    <h1 class="fw-bold mb-0">{{ $title }}</h1>
@endsection

@section('main')
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between">
            <form action="" method="get" class="d-flex align-items-center">
                <label for="mata_kuliah" class="fw-bold me-3">Mata Kuliah</label>
                <select class="form-select w-auto" id="mata_kuliah" name="mata_kuliah">
                    <option value="" selected>Pilih mata kuliah</option>
                    @foreach($daftar_mata_kuliah as $mk)
                        <option value="{{ $mk->id }}"
                                @if(request('mata_kuliah') == $mk->id) selected @endif>{{ $mk->kode . ' - ' . $mk->nama }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-outline-primary ms-3">Pilih</button>
            </form>
            <a href="{{ route('kaprodi.tp.index', ['kurikulum' => $kurikulum->tahun]) }}"
               class="btn btn-secondary me-2">Kembali</a>
        </div>
    </div>

    @if($tahun_akademik->isNotEmpty() && request('mata_kuliah') != '')
        <div class="row mb-5">
            <div class="col-12 d-flex justify-content-between">
                <form action="" method="get" class="d-flex align-items-center">
                    <input type="hidden" name="mata_kuliah" value="{{ request('mata_kuliah') }}">
                    <label for="tahun_akademik" class="fw-bold me-3">Tahun Akademik</label>
                    <select class="form-select w-auto" id="tahun_akademik" name="tahun_akademik">
                        <option value="" selected>Pilih tahun akademik</option>
                        @foreach($tahun_akademik as $ta)
                            <option value="{{ $ta['tahun_akademik_awal'] }}"
                                    @if(request('tahun_akademik') == $ta['tahun_akademik_awal']) selected @endif>{{ $ta['tahun_akademik_awal'] . ' / ' . $ta['tahun_akademik_akhir'] }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-outline-primary ms-3">Pilih</button>
                </form>
            </div>
        </div>
    @elseif ($tahun_akademik->isEmpty() && request('mata_kuliah') != '')
        <div class="row">
            <div class="col-auto">
                <div class="alert alert-secondary" role="alert">
                    Belum ada tahun akademik.
                </div>
            </div>
        </div>
    @endif

    @if($data_mata_kuliah != null)
        <div class="row mb-4">
            <div class="col-12">
                <table class="table table-responsive table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Kode TP</th>
                            <th scope="col" style="width: 45%">Deskripsi TP</th>
                            <th scope="col">Tindakan</th>
                            <th scope="col">Alasan Penolakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $index = 0; @endphp
                        <form action="{{ route('kaprodi.tp.update', ['kurikulum', $kurikulum->tahun]) }}" method="post" autocomplete="off" id="validasiTp">
                            @csrf
                            @method('patch')

                            @foreach($data_mata_kuliah->mataKuliahRegister as $mkr)
                                <tr>
                                    <td colspan="4" class="text-center bg-body-secondary">{{ $mkr->jenis }}</td>
                                </tr>
                                @forelse($mkr->tujuanPembelajaran->where('status', \App\Enums\StatusValidasiTP::Proses) as $tp)
                                    <tr>
                                        <input type="hidden" name="tp[{{ $index }}][id]" value="{{ $tp->id }}">
                                        <td class="align-middle">{{ $tp->kode }}</td>
                                        <td class="align-middle">{{ $tp->deskripsi }}</td>
                                        <td class="align-middle">
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check me-3">
                                                    <input class="form-check-input" type="radio" name="tp[{{ $index }}][status]" id="tolak{{ $loop->parent->iteration . '-' . $loop->iteration }}" value="{{ \App\Enums\StatusValidasiTP::Ditolak }}">
                                                    <label class="form-check-label" for="tolak{{ $loop->parent->iteration . '-' . $loop->iteration }}">
                                                        Tolak
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="tp[{{ $index }}][status]" id="setujui{{ $loop->parent->iteration . '-' . $loop->iteration }}" value="{{ \App\Enums\StatusValidasiTP::Disetujui }}">
                                                    <label class="form-check-label" for="setujui{{ $loop->parent->iteration . '-' . $loop->iteration }}">
                                                        Setujui
                                                    </label>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="">
                                            <textarea class="form-control" id="alasan_penolakan" name="tp[{{ $index }}][alasan_penolakan]" placeholder="Masukkan alasan penolakan" disabled></textarea>
                                        </td>
                                    </tr>
                                    @php $index++; @endphp
                                @empty
                                    <tr>
                                        <td colspan="4" class="align-middle text-center">Tidak ada tujuan pembelajaran yang perlu divalidasi.</td>
                                    </tr>
                                @endforelse
                            @endforeach
                        </form>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-12 text-end">
                <button type="button" class="btn btn-outline-danger" id="atur_ulang">Atur Ulang</button>
                <button type="button" class="btn btn-outline-danger" id="tolak_semua">Tolak Semua</button>
                <button type="button" class="btn btn-outline-success" id="setujui_semua">Setujui Semua</button>
                <button type="submit" class="btn btn-primary" form="validasiTp">Submit</button>
            </div>
        </div>
    @endif
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('input[type="radio"][value="Ditolak"]').change(function() {
                $(this).closest('tr').find('textarea').attr('disabled', false);
            });

            $('input[type="radio"][value="Disetujui"]').change(function() {
                $(this).closest('tr').find('textarea').attr('disabled', true).val('');
            });

            $('#atur_ulang').click(function() {
                $('input[type="radio"]').prop('checked', false).each(function() {
                    $(this).closest('tr').find('textarea').attr('disabled', true).val('');
                });
            });

            $('#tolak_semua').on('click', function (e) {
                $('input[type="radio"][value="Ditolak"]').prop('checked', true).each(function() {
                    $(this).closest('tr').find('textarea').attr('disabled', false);
                });
            });

            $('#setujui_semua').on('click', function (e) {
                $('input[type="radio"][value="Disetujui"]').prop('checked', true).each(function() {
                    $(this).closest('tr').find('textarea').attr('disabled', true).val('');
                });
            });

            $('#mata_kuliah').select2({
                theme: "bootstrap-5",
                closeOnSelect: false,
                allowClear: true
            });
        });
    </script>
@endpush
