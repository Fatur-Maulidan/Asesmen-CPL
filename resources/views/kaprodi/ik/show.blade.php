@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('kaprodi.ik.show', $kurikulum->tahun, $ik->kode) }}
    <h1 class="fw-bold mb-0">{{ $ik->kode }}</h1>
@endsection

@section('main')
    <div class="row">
        {{-- Sidebar --}}
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    @foreach ($dataIk as $data)
                        @if ($data != null)
                            <div class="mb-3">
                                <a href="{{ route('kaprodi.ik.show', ['kurikulum' => $kurikulum->tahun, 'ik' => $ik->kode]) }}"
                                    class="btn btn-light w-100 text-start {{ $data->kode == $ik->kode ? 'active' : '' }}">
                                    {{ $data->kode }}
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Modal --}}
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <form method="POST"
                    action="{{ route('kaprodi.ik.update', ['kurikulum' => $kurikulum->tahun, 'ik' => $ik->kode]) }}">
                    @csrf
                    @method('PATCH')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">Ubah Capaian Pembelajaran</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="">
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label fw-bold">Deskripsi</label>
                                    <textarea class="form-control" name="deskripsi" id="exampleFormControlTextarea1" rows="3">{{ $ik->deskripsi }}</textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <div class="row w-100">
                                <div class="col">
                                    <button type="button" class="btn btn-danger w-100"
                                        data-bs-dismiss="modal">Batal</button>
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-success w-100">Ubah</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Detail --}}
        <div class="col-9">
            <div class="row mb-3">
                <div class="col d-flex">
                    <div class="me-4">
                        <div class="fw-bold">Diubah pada</div>
                        <div>{{ $ik->created_at }}</div>
                    </div>
                    <div class="me-4">
                        <div class="fw-bold">Diperbarui pada</div>
                        <div>{{ $ik->updated_at }}</div>
                    </div>
                    <div>
                        <div class="fw-bold">Diubah oleh</div>
                        <div>Jhon Doe</div>
                    </div>
                </div>
                <div class="col-auto">
                    <a href="{{ route('kaprodi.ik.detail', ['kurikulum' => $kurikulum->tahun, 'ik' => $ik->kode]) }}"
                        class="btn btn-outline-primary ">Pemetaannya pada CPL</a>
                    <button class="btn btn-danger">Hapus</button>
                    {{-- Button trigger modal --}}
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Ubah
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="fw-bold">Deskripsi</div>
                    <p>{{ $ik->deskripsi }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="fw-bold mb-3">Rubrik</div>
                    <div class="accordion" id="accordionExample2">
                        @if ($ik->rubrik->isEmpty())
                            <div class="text-center">Belum ada rubrik</div>
                        @else
                            @foreach ($ik->rubrik as $index => $rubrik)
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button bg-light" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne2" aria-expanded="true"
                                            aria-controls="collapseOne2">Rubrik
                                            {{ $index + 1 }} ( < 50 )</button>
                                    </h2>
                                    <div id="collapseOne2" class="accordion-collapse collapse show"
                                        data-bs-parent="#accordionExample2">
                                        <div class="accordion-body">
                                            <div>
                                                <div class="fw-bold">Deskripsi</div>
                                                <p>{{ $rubrik->deskripsi }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        Swal.fire({
            title: 'Error!',
            text: 'Do you want to continue',
            icon: 'error',
            confirmButtonText: 'Cool'
        })
    </script>
