@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('dosen.mata-kuliah.rencana-asesmen.index', $mata_kuliah->kode) }}
    <h1 class="fw-bold mb-4">{{ $title }}</h1>
@endsection

@section('main')
    <div class="row">
        <div class="col-12">

        </div>
    </div>
@endsection
