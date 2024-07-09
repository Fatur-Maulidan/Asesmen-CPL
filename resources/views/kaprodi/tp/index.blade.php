@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('kaprodi.tp.index', $kurikulum->tahun) }}
    <h1 class="fw-bold mb-0">{{ $title }}</h1>
@endsection

@section('main')
    <div class="row mb-4">
        <div class="col-12 text-end">
            <a href="{{ route('kaprodi.tp.validasi', ['kurikulum' => $kurikulum->tahun]) }}" class="btn btn-success me-2">Validasi Tujuan Pembelajaran</a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <form action="" class="d-flex align-items-center">
                <label for="mata_kuliah" class="fw-bold me-3">Mata Kuliah</label>
                <select class="form-select w-auto" id="mata_kuliah" name="mata_kuliah">
                    <option value="" selected>Pilih mata kuliah</option>
                    @foreach($mata_kuliah as $mk)
                        <option value="{{ $mk->id }}">{{ $mk->kode . ' - ' . $mk->nama }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-outline-primary ms-3">Pilih</button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#mata_kuliah').select2({
                theme: "bootstrap-5",
                closeOnSelect: false,
            });
        });
    </script>
@endpush
