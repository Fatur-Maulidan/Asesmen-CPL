@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('kaprodi.kurikulum.create') }}
    <h1 class="fw-bold mb-0">{{ $title }}</h1>
@endsection

@section('main')
    <form action="{{ route('kaprodi.kurikulum.store') }}" method="POST" autocomplete="off">
        @csrf
        <input type="hidden" name="program_studi_id" value="{{ $program_studi_id }}">
        {{-- Year input --}}
        <div class="row mb-4">
            <div class="col-4">
                <div>
                    <label for="tahun" class="form-label fw-bold">Tahun Kurikulum</label>
                    <input type="year" class="form-control" id="tahun" name="tahun" value="{{ date('Y') }}"
                        readonly>
                </div>
            </div>
        </div>

        {{-- Rubrik input --}}
        <div class="row mb-4">
            <div class="col-4">
                <div>
                    <label for="rubrik_maksimal" class="form-label fw-bold">Jumlah maksimal rubrik</label>
                    <select class="form-select" id="jumlah_maksimal_rubrik" name="jumlah_maksimal_rubrik">
                        <option value="" selected hidden>Pilih jumlah maksimal rubrik</option>
                        <option value="3">3</option>
                        <option value="5">5</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- Rubrik detail --}}
        <div class="row mb-2">
            <div class="col-8">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th scope="col" width="25%">Tingkat Kemampuan</th>
                            <th scope="col">Makna</th>
                            <th scope="col" width="25%">Rentang Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Warning --}}
        <div class="row mb-4">
            <div class="col-8">
                <p class="text-danger fw-bold">
                    <i class="bi bi-exclamation-circle me-3"></i>
                    Rentang yang sudah dipilih tidak akan bisa diubah kembali, pastikan rentang yang dimasukkan benar.
                </p>
            </div>
        </div>

        {{-- Buttons --}}
        <div class="row">
            <div class="col-8 text-end">
                <a href="{{ route('kaprodi.kurikulum.index') }}" class="btn btn-danger px-3 me-2">Batal</a>
                <button type="submit" class="btn btn-primary px-3" id="btn-submit" disabled>Simpan</button>
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
