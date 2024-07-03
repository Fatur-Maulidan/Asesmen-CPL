@extends('layouts.main')

@section('breadcrumb')
    <h1 class="fw-bold mb-4">{{ $title }}</h1>
    {{ Breadcrumbs::render('kaprodi.kurikulum.create') }}
@endsection

@section('main')
    <form action="{{ route('kaprodi.kurikulum.store') }}" method="POST" autocomplete="off">
        @csrf
        <input type="hidden" name="program_studi_id" value="{{ $program_studi_id }}">
        {{-- Year input --}}
        <div class="row mb-4">
            <div class="col-5">
                <div>
                    <label for="tahun" class="form-label fw-bold">Tahun Kurikulum</label>
                    <input type="text" class="form-control @error('tahun') is-invalid @enderror" id="tahun" name="tahun" value="{{ date('Y') }}">
                    @error('tahun')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Tenggat waktu tp input --}}
        <div class="row mb-4">
            <div class="col-5">
                <div>
                    <label for="tahun" class="form-label fw-bold">Tanggal Batas Pengisian Tujuan Pembelajaran oleh Dosen</label>
                    <input type="date" class="form-control @error('tenggat_tp') is-invalid @enderror" id="tenggat_tp" name="tenggat_tp" value="{{ old('tenggat_tp') }}">
                    @error('tenggat_tp')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Threshold input --}}
        <div class="row mb-4">
            <div class="col-5">
                <div>
                    <label for="tahun" class="form-label fw-bold">Batas Minimum CP</label>
                    <input type="number" class="form-control @error('threshold') is-invalid @enderror" id="threshold" name="threshold" value="{{ old('threshold') }}" min="1" max="100">
                    @error('threshold')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Buttons --}}
        <div class="row">
            <div class="col-8 text-end">
                <a href="{{ route('kaprodi.kurikulum.index') }}" class="btn btn-danger px-3 me-2">Batal</a>
                <button type="submit" class="btn btn-primary px-3" id="btn-submit">Simpan</button>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        let row = ``;

        $('#jumlah_maksimal_rubrik').on('change', function(e) {
            if (this.value != '') {
                let i = 2;
                row = `<tr>
                        <td class="py-3">1</td>
                        <td class="py-3">
                            <textarea class="form-control" name="makna_tingkat_kemampuan[0]" rows="2" placeholder="Makna tingkat kemampuan"></textarea>
                        </td>
                        <td class="py-3">
                            <div class="d-flex">
                                <div class="me-3">&lt;</div>
                                <input type="hidden" name="nilai[0][a]" value="0">
                                <input type="number" class="form-control" name="nilai[0][b]" placeholder="Nilai" min="0" max="100">
                            </div>
                        </td>
                    </tr>`;
                for (i; i < this.value; i++) {
                    row += `<tr>
                                <td class="py-3">${i}</td>
                                <td class="py-3">
                                    <textarea class="form-control" name="makna_tingkat_kemampuan[${i - 1}]" rows="2" placeholder="Makna tingkat kemampuan"></textarea>
                                </td>
                                <td class="py-3">
                                    <div class="d-flex">
                                        <input type="number" class="form-control" name="nilai[${i - 1}][a]" placeholder="Nilai" min="0" max="100">
                                        <span class="mx-2">-</span>
                                        <input type="number" class="form-control" name="nilai[${i - 1}][b]" placeholder="Nilai" min="0" max="100">
                                    </div>
                                </td>
                            </tr>`;
                }
                row += `<tr>
                            <td class="py-3">${i}</td>
                            <td class="py-3">
                                <textarea class="form-control" name="makna_tingkat_kemampuan[${i - 1}]" rows="2" placeholder="Makna tingkat kemampuan"></textarea>
                            </td>
                            <td class="py-3">
                                <div class="d-flex">
                                    <div class="me-3">&gt;</div>
                                    <input type="number" class="form-control" name="nilai[${i - 1}][a]" placeholder="Nilai" min="0" max="100">
                                    <input type="hidden" name="nilai[${i - 1}][b]" value="100">
                                </div>
                            </td>
                        </tr>`;
                $('tbody').html(row);
                $('#btn-submit').attr('disabled', false);
            } else {
                $('tbody').html('');
                $('#btn-submit').attr('disabled', true);
            }
        });
    </script>
@endpush
