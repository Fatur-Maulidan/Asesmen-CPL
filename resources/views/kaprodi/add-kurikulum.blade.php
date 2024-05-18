@extends('layouts.main')

@section('breadcrumb')
    <nav aria-label="breadcrumb mb-4">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item" aria-current="page">{{ Breadcrumbs::render() }}</li>
        </ol>
    </nav>
    <h1>Tambah Kurikulum Baru</h1>
@endsection

@section('main')
    <div class="row">
        <div class="col-6">
            <form>
                <div class="mb-3">
                    <label for="tahun_kurikulum" class="form-label fw-bold">Tahun Kurikulum</label>
                    <input type="year" class="form-control" id="tahun_kurikulum" value="{{ date('Y') }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="rubrik_maksimal" class="form-label fw-bold">Jumlah Rubrik Maksimal</label>
                    <select class="form-select">
                        <option value="3" selected>3</option>
                        <option value="5">5</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
