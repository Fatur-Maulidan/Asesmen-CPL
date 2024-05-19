@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('kurikulum.create') }}
@endsection

@section('main')
    {{-- Year input --}}
    <div class="row mb-4">
        <div class="col-4">
            <div>
                <label for="tahun_kurikulum" class="form-label fw-bold">Tahun Kurikulum</label>
                <input type="year" class="form-control" id="tahun_kurikulum" value="{{ date('Y') }}" readonly>
            </div>
        </div>
    </div>

    {{-- Rubrik input --}}
    <div class="row mb-4">
        <div class="col-4">
            <div>
                <label for="rubrik_maksimal" class="form-label fw-bold">Jumlah rubrik maksimal</label>
                <select class="form-select">
                    <option value="3" selected>3</option>
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
                    <tr>
                        <td class="py-3">1</td>
                        <td class="py-3">
                            <input type="text" class="form-control" placeholder="Makna tingkat kemampuan">
                        </td>
                        <td class="row py-3">
                            <div class="col-auto">
                                <div>&lt;</div>
                            </div>
                            <div class="col">
                                <input type="number" class="form-control" placeholder="Nilai">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-3">2</td>
                        <td class="py-3">
                            <input type="text" class="form-control" placeholder="Makna tingkat kemampuan">
                        </td>
                        <td class="row py-3">
                            <div class="col">
                                <input type="number" class="form-control" placeholder="Nilai">
                            </div>
                            <div class="col-auto px-0">
                                -
                            </div>
                            <div class="col">
                                <input type="number" class="form-control" placeholder="Nilai">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-3">3</td>
                        <td class="py-3">
                            <input type="text" class="form-control" placeholder="Makna tingkat kemampuan">
                        </td>
                        <td class="row py-3">
                            <div class="col-auto">
                                <div>&gt;</div>
                            </div>
                            <div class="col">
                                <input type="number" class="form-control" placeholder="Nilai">
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Warning --}}
    <div class="row mb-4">
        <div class="col-8">
            <p class="text-danger fw-bold"><i class="bi bi-exclamation-circle me-3"></i>Rentang yang sudah dipilih tidak
                akan bisa
                diubah kembali,
                pastikan
                rentang yang dimasukkan benar.</p>
        </div>
    </div>

    {{-- Buttons --}}
    <div class="row">
        <div class="col-8 text-end">
            <button type="button" class="btn btn-danger px-3 me-2">Batal</button>
            <button type="button" class="btn btn-primary px-3">Simpan</button>
        </div>
    </div>
@endsection
