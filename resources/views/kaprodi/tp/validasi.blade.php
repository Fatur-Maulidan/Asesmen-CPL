@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('kaprodi.tp.validasi', $kurikulum->tahun) }}
    <h1 class="fw-bold mb-0">{{ $title }}</h1>
@endsection
<style>
    .select2-container--bootstrap-5 .select2-selection--single .select2-selection__clear {
        display: none;
    }
</style>
@section('main')
    <div class="row mb-4">
        <div class="col-12">
            <form action="" class="d-flex flex-row">
                <div class="row">
                    <div class="col-auto">
                        <select class="form-select me-3" name="filter" id="mata-kuliah" style="width:100%;">
                            @foreach ($data_mata_kuliah as $mata_kuliah)
                                <option value="{{ $mata_kuliah->nama }}"
                                    {{ $selected_mata_kuliah->nama == $mata_kuliah->nama ? 'selected' : '' }}>
                                    {{ $mata_kuliah->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <select class="form-select" id="indikator-kinerja">
                            @foreach ($ik_mata_kuliah as $ik)
                                <option value="{{ $ik['kode'] }}"
                                    {{ $selected_indikator_kinerja->kode == $ik['kode'] ? 'selected' : '' }}>
                                    {{ $ik['kode'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="fw-bold">{{ $selected_mata_kuliah->kode }} - {{ $selected_mata_kuliah->nama }}</div>
            <p>{{ $selected_mata_kuliah->deskripsi }}</p>
            @if ($selected_indikator_kinerja === null)
                <div class="fw-bold">IK</div>
                <p>Belum terdapat IK</p>
            @else
                <div class="fw-bold">{{ $selected_indikator_kinerja->kode }}</div>
                <ul>
                    <li>{{ $selected_indikator_kinerja->deskripsi }}</li>
                </ul>
            @endif
        </div>
    </div>
    <form method="POST" action="{{ route('kaprodi.tp.update', ['kurikulum' => $kurikulum]) }}">
        @csrf
        @method('PATCH')
        <div class="row mb-4">
            <div class="col-12">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th scope="col">Kode TP</th>
                            <th scope="col" width="45%">Deskripsi TP</th>
                            <th scope="col">Tindakan</th>
                            <th scope="col">Alasan Penolakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="">
                            @if ($ik_mata_kuliah->isEmpty() || $ik_mata_kuliah->where('id', $selected_indikator_kinerja->id)->first()['tp'] == null)
                                <tr>
                                    <td colspan="4" class="text-center">Belum terdapat TP</td>
                                </tr>
                            @else
                                @foreach ($ik_mata_kuliah->where('id', $selected_indikator_kinerja->id)->first()['tp'] as $tp)
                                    <tr>
                                        {{-- <input type="hidden" name="tp-ids" value="{{ $tp['id'] }}"> --}}
                                        <td class="py-3 align-content-center">
                                            {{ $tp['kode'] }}</td>
                                        <td class="py-3">
                                            <p class="mb-0">{{ $tp['deskripsi'] }}</p>
                                        </td>
                                        <td class="py-3 align-content-center ">
                                            <div class="d-flex">
                                                <div class="form-check me-3">
                                                    <input class="form-check-input" type="radio"
                                                        name="status-{{ $loop->index }}" id="tolak"
                                                        id="flexRadioDefault1">
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        Tolak
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        name="status-{{ $loop->index }}" id="setujui"
                                                        id="flexRadioDefault2">
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                        Setujui
                                                    </label>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-content-center">
                                            <textarea class="form-control" id="exampleFormControlTextarea2" name="alasan_penolakan"
                                                placeholder="Masukkan alasan penolakan" disabled></textarea>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </form>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-end">
                <button class="btn btn-outline-danger" id="resetCheckbox">Reset ulang</button>
                <button type="submit" class="btn btn-outline-danger" name="btn" value="tolak_semua">Tolak
                    semua</button>
                <button type="submit" class="btn btn-outline-primary" name="btn" value="setujui_semua">Setujui
                    semua</button>
                <button type="submit" class="btn btn-primary" name="btn" value="simpan">Simpan</button>
                <button type="submit" class="btn btn-success" name="btn" value="finalisasi"
                    disabled>Finalisasi</button>
            </div>
        </div>
    </form>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('input[type=radio]').change(function() {
                if ($(this).attr('id') == 'tolak') {
                    $(this).closest('tr').find('textarea').removeAttr('disabled');
                } else {
                    $(this).closest('tr').find('textarea').attr('disabled', 'disabled');
                    $(this).closest('tr').find('textarea').val('');
                }
            });
        });

        $(document).ready(function() {
            $('#resetCheckbox').click(function() {
                $('input[type="radio"]').prop('checked', false).each(function() {
                    $(this).closest('tr').find('textarea').attr('disabled', 'disabled');
                    $(this).closest('tr').find('textarea').val('');
                });
            });
        });

        $('#mata-kuliah').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: true
        });

        const url = "{{ url()->current() }}";

        $(document).ready(function() {
            function updatePage() {
                var selectedMataKuliah = $('#mata-kuliah').val();
                var selectedIndikatorKinerja = $('#indikator-kinerja').val();

                var params = {};
                if (selectedMataKuliah) {
                    params.mata_kuliah = selectedMataKuliah;
                }
                if (selectedIndikatorKinerja) {
                    params.indikator_kinerja = selectedIndikatorKinerja;
                }

                var queryString = $.param(params);
                location.href = url + '?' + queryString;
            }

            $('#mata-kuliah').change(function() {
                $('#indikator-kinerja').val(null);
                updatePage();
            });

            $('#indikator-kinerja').change(function() {
                updatePage();
            });
        });
    </script>
@endpush
