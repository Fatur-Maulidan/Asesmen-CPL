@extends('layouts.main')

@section('breadcrumb')
    <h1 class="fw-bold mb-4">{{ $title }}</h1>
    {{ Breadcrumbs::render('kaprodi.kurikulum.edit', $kurikulum->id) }}
@endsection

@section('main')
    <form action="{{ route('kaprodi.kurikulum.update', ['kurikulum' => $kurikulum->id]) }}" method="POST" autocomplete="off">
        @csrf
        @method('patch')
        <input type="hidden" name="program_studi_id" value="{{ $program_studi_id }}">
        {{-- Year input --}}
        <div class="row justify-content-center mb-4">
            <div class="col-6">
                <div>
                    <label for="tahun" class="form-label fw-bold">Tahun Kurikulum</label>
                    <input type="text" class="form-control @error('tahun') is-invalid @enderror" id="tahun" name="tahun" value="{{ $kurikulum->tahun }}" readonly>
                    @error('tahun')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Tenggat waktu tp input --}}
        <div class="row justify-content-center mb-4">
            <div class="col-6">
                <div>
                    <label for="tahun" class="form-label fw-bold">Tanggal Batas Pengisian Tujuan Pembelajaran oleh Dosen</label>
                    <input type="date" class="form-control @error('tenggat_tp') is-invalid @enderror" id="tenggat_tp" name="tenggat_tp" value="{{ date('Y-m-d', strtotime($kurikulum->konf_tenggat_waktu_tp)) }}">
                    @error('tenggat_tp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Threshold input --}}
        <div class="row justify-content-center mb-4">
            <div class="col-6">
                <div>
                    <label for="tahun" class="form-label fw-bold">Batas Minimum CP</label>
                    <input type="number" class="form-control @error('threshold') is-invalid @enderror" id="threshold" name="threshold" value="{{ $kurikulum->threshold }}" min="1" max="100">
                    @error('threshold')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Nilai rubrik input --}}
        <div class="row justify-content-center mb-4">
            <div class="col-6">
                <div class="text-center fw-bold mb-4">
                    Nilai Rubrik Indikator Kinerja
                </div>

                <div class="mb-3">
                    <div class="fw-bold mb-2">Rentang Nilai Rubrik Sangat Kurang</div>
                    <div class="row align-items-center">
                        <div class="col">
                            <input type="number" class="form-control" id="rubrik1_min" name="nilai[min][]" value="{{ $kurikulum->nilai_rubrik['min'][0] }}" min="0" max="100">
                        </div>
                        <div class="col-auto">&mdash;</div>
                        <div class="col">
                            <input type="number" class="form-control" id="rubrik1_max" name="nilai[max][]" value="{{ $kurikulum->nilai_rubrik['max'][0] }}" min="0" max="100">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="fw-bold mb-2">Rentang Nilai Rubrik Kurang</div>
                    <div class="row align-items-center">
                        <div class="col">
                            <input type="number" class="form-control" id="rubrik2_min" name="nilai[min][]" value="{{ $kurikulum->nilai_rubrik['min'][1] }}" min="0" max="100">
                        </div>
                        <div class="col-auto">&mdash;</div>
                        <div class="col">
                            <input type="number" class="form-control" id="rubrik2_max" name="nilai[max][]" value="{{ $kurikulum->nilai_rubrik['max'][1] }}" min="0" max="100">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="fw-bold mb-2">Rentang Nilai Rubrik Cukup</div>
                    <div class="row align-items-center">
                        <div class="col">
                            <input type="number" class="form-control" id="rubrik3_min" name="nilai[min][]" value="{{ $kurikulum->nilai_rubrik['min'][2] }}" min="0" max="100">
                        </div>
                        <div class="col-auto">&mdash;</div>
                        <div class="col">
                            <input type="number" class="form-control" id="rubrik3_max" name="nilai[max][]" value="{{ $kurikulum->nilai_rubrik['max'][2] }}" min="0" max="100">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="fw-bold mb-2">Rentang Nilai Baik</div>
                    <div class="row align-items-center">
                        <div class="col">
                            <input type="number" class="form-control" id="rubrik4_min" name="nilai[min][]" value="{{ $kurikulum->nilai_rubrik['min'][3] }}" min="0" max="100">
                        </div>
                        <div class="col-auto">&mdash;</div>
                        <div class="col">
                            <input type="number" class="form-control" id="rubrik4_max" name="nilai[max][]" value="{{ $kurikulum->nilai_rubrik['max'][3] }}" min="0" max="100">
                        </div>
                    </div>
                </div>

                <div>
                    <div class="fw-bold mb-2">Rentang Nilai Sangat Baik</div>
                    <div class="row align-items-center">
                        <div class="col">
                            <input type="number" class="form-control" id="rubrik5_min" name="nilai[min][]" value="{{ $kurikulum->nilai_rubrik['min'][4] }}" min="0" max="100">
                        </div>
                        <div class="col-auto">&mdash;</div>
                        <div class="col">
                            <input type="number" class="form-control" id="rubrik5_max" name="nilai[max][]" min="0" max="100" value="{{ $kurikulum->nilai_rubrik['max'][4] }}">
                        </div>
                    </div>
                </div>

                @error('nilai')
                    <div class="text-danger mt-3">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Buttons --}}
        <div class="row justify-content-center">
            <div class="col-8 text-end">
                <a href="{{ route('kaprodi.kurikulum.index') }}" class="btn btn-danger px-3 me-2">Batal</a>
                <button type="submit" class="btn btn-warning px-3" id="btn-submit">Ubah</button>
            </div>
        </div>
    </form>
@endsection
