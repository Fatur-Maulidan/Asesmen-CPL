@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('kaprodi.cpl.show', $kurikulum->tahun, $cpl->kode) }}
    <h1 class="fw-bold mb-4">{{ $cpl->kode }}</h1>
@endsection

@section('main')
    {{-- Modal --}}
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">Ubah Capaian Pembelajaran</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form
                        id="ubahCplForm"
                        action="{{ route('kaprodi.cpl.update', ['kurikulum' => $kurikulum->tahun, 'cpl' => $cpl->kode]) }}">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label fw-bold">Deskripsi</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" name="deskripsi"
                                      rows="6">{{ $cpl->deskripsi }}</textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col">
                            <button type="button" class="btn btn-danger w-100"
                                    data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Batal
                            </button>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-success w-100" form="ubahCplForm">Ubah</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Detail --}}
    <div class="row">
        <div class="col-12">
            <div class="row mb-4">
                <div class="col-12 d-flex">
                    <div class="me-4">
                        <div class="fw-bold">Ditambahkan pada</div>
                        <div id="created_at">{{ $cpl->created_at->translatedFormat('d F Y H:i') }}</div>
                    </div>
                    <div class="me-4">
                        <div class="fw-bold">Diperbarui pada</div>
                        <div id="updated_at">{{ $cpl->updated_at->translatedFormat('d F Y H:i') }}</div>
                    </div>
                    <a href="{{ route('kaprodi.cpl.index', ['kurikulum' => $kurikulum->tahun]) }}" class="btn btn-secondary ms-auto">Kembali</a>
                    <button type="button" class="btn btn-warning ms-2" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">Ubah CP</button>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-1">
                    <div class="fw-bold">Kode CP</div>
                    <div id="kode">{{ $cpl->kode }}</div>
                </div>
                <div class="col-11">
                    <div class="fw-bold">Deskripsi CP</div>
                    <p id="deskripsi">{{ $cpl->deskripsi }}</p>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-12">
                    <div class="fw-bold mb-3">Indikator Kinerja</div>
                    @if( $cpl->indikatorKinerja->isNotEmpty() )
                        <table class="table table-bordered table-hover">
                            <tbody>
                            @foreach($cpl->indikatorKinerja as $ik)
                                <tr>
                                    <td class="fw-bold text-nowrap align-middle">{{ $ik->kode }}</td>
                                    <td class="align-middle">{{ $ik->deskripsi }}</td>
                                    <td scope="col" class="align-middle" style="width: 10%">
                                        <div>
                                            <button type="button"
                                                    class="btn btn-warning btn-sm btn-ubah-ik text-nowrap mb-2"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#ikModal"
                                                    data-cpl="{{ $ik->capaianPembelajaranLulusan->kode }}"
                                                    data-id="{{ $ik->id }}"
                                                    data-kode="{{ $ik->kode }}"
                                                    data-deskripsi="{{ $ik->deskripsi }}"
                                                    data-rubrik1="{{ $ik->rubrik->where('urutan', 1)->pluck('deskripsi')->first() }}"
                                                    data-rubrik2="{{ $ik->rubrik->where('urutan', 2)->pluck('deskripsi')->first() }}"
                                                    data-rubrik3="{{ $ik->rubrik->where('urutan', 3)->pluck('deskripsi')->first() }}"
                                                    data-rubrik4="{{ $ik->rubrik->where('urutan', 4)->pluck('deskripsi')->first() }}"
                                                    data-rubrik5="{{ $ik->rubrik->where('urutan', 5)->pluck('deskripsi')->first() }}"
                                            >Ubah IK</button>
                                            <button type="button"
                                                    class="btn btn-info btn-sm btn-show-rubrik"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#rubrikModal"
                                                    data-kode="{{ $ik->kode }}"
                                                    data-deskripsi="{{ $ik->deskripsi }}"
                                                    data-rubrik1="{{ $ik->rubrik->where('urutan', 1)->pluck('deskripsi')->first() }}"
                                                    data-rubrik2="{{ $ik->rubrik->where('urutan', 2)->pluck('deskripsi')->first() }}"
                                                    data-rubrik3="{{ $ik->rubrik->where('urutan', 3)->pluck('deskripsi')->first() }}"
                                                    data-rubrik4="{{ $ik->rubrik->where('urutan', 4)->pluck('deskripsi')->first() }}"
                                                    data-rubrik5="{{ $ik->rubrik->where('urutan', 5)->pluck('deskripsi')->first() }}">Lihat Rubrik</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div>Belum ada indikator kinerja.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
