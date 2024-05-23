@extends('layouts.main')

@section('breadcrumb')
    {{-- {{ Breadcrumbs::render('cpl.show') }} --}}
@endsection

@section('main')
    <div class="row">
        {{-- Sidebar --}}
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <a href="" class="btn btn-light w-100 active">IK-1</a>
                    </div>

                    <div class="mb-3">
                        <a href="" class="btn btn-light w-100">IK-2</a>
                    </div>

                    <div class="mb-3">
                        <a href="" class="btn btn-light w-100">IK-3</a>
                    </div>

                    <div class="mb-3">
                        <a href="" class="btn btn-light w-100">IK-4</a>
                    </div>

                    <div class="mb-3">
                        <a href="" class="btn btn-light w-100">IK-5</a>
                    </div>

                    <div class="mb-3">
                        <a href="" class="btn btn-light w-100">IK-6</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Detail --}}
        <div class="col-9">
            <div class="row mb-3">
                <div class="col d-flex">
                    <div class="me-4">
                        <div class="fw-bold">Diubah pada</div>
                        <div>01 Januari 2024 01:18</div>
                    </div>
                    <div class="me-4">
                        <div class="fw-bold">Diperbarui pada</div>
                        <div>01 Januari 2024 01:18</div>
                    </div>
                    <div>
                        <div class="fw-bold">Diubah oleh</div>
                        <div>Jhon Doe</div>
                    </div>
                </div>
                <div class="col-auto">
                    <a href="{{ route('ik.edit', ['kurikulum' => 2022, 'ik' => 'ik-1']) }}" class="btn btn-warning">Ubah
                        Pemetaan</a>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="fw-bold">Deskripsi</div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad officiis praesentium hic nihil vel non
                        recusandae tempora id cum repellat!</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="fw-bold mb-3">Pemetaan terhadap Capaian Pembelajaran</div>
                    <div class="mb-3">
                        <div class="fw-bold">S-1</div>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Natus eligendi, illum animi vitae
                            voluptates voluptatibus blanditiis id cupiditate deserunt quis?</p>
                    </div>
                    <div class="mb-3">
                        <div class="fw-bold">S-1</div>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Natus eligendi, illum animi vitae
                            voluptates voluptatibus blanditiis id cupiditate deserunt quis?</p>
                    </div>
                    <div class="mb-3">
                        <div class="fw-bold">S-1</div>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Natus eligendi, illum animi vitae
                            voluptates voluptatibus blanditiis id cupiditate deserunt quis?</p>
                    </div>
                    <div class="mb-3">
                        <div class="fw-bold">S-1</div>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Natus eligendi, illum animi vitae
                            voluptates voluptatibus blanditiis id cupiditate deserunt quis?</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
