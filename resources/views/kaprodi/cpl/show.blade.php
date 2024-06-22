@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('kaprodi.cpl.show', $kurikulum->tahun, $cpl->kode) }}
    <h1 class="fw-bold mb-0">{{ $cpl->kode }}</h1>
@endsection

@section('main')
    <div class="row">
        {{-- Sidebar --}}
        <div class="col-3">
            {{--<button type="button" class="btn btn-success w-100 mb-4">Tambah Data CPL</button>--}}
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold bg-light" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Sikap (SP)<span class="badge text-bg-primary ms-2">{{ countCPL('SP', $data_cpl) }}</span>
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse <?php echo strpos($cpl->kode, 'SP') === 0 ? 'show' : ''; ?>"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            @foreach ($data_cpl as $data)
                                @if ($data->get('domain') == 'Sikap')
                                    <div class="mb-3">
                                        <a href="{{ route('kaprodi.cpl.show', ['kurikulum' => $kurikulum->tahun, 'cpl' => $data->get('kode')]) }}"
                                            class="btn text-start w-100 btn-tp <?php echo $data->get('kode') == $cpl->kode ? 'border border-1' : ''; ?>"
                                            data-kode="{{ $data->get('kode') }}">{{ $data->get('kode') }}</a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold bg-light collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Pengetahuan (PP)<span class="badge text-bg-primary ms-2">{{ countCPL('PP', $data_cpl) }}</span>
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse <?php echo strpos($cpl->kode, 'PP') === 0 ? 'show' : ''; ?>"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            @foreach ($data_cpl as $data)
                                @if ($data->get('domain') == 'Pengetahuan')
                                    <div class="mb-3">
                                        <a href="{{ route('kaprodi.cpl.show', ['kurikulum' => $kurikulum->tahun, 'cpl' => $data->get('kode')]) }}"
                                            class="btn text-start w-100 btn-tp <?php echo $data->get('kode') == $cpl->kode ? 'border border-1' : ''; ?>"
                                            data-kode="{{ $data->get('kode') }}">{{ $data->get('kode') }}</a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold bg-light collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            KU (Keterampilan Umum)<span
                                class="badge text-bg-primary ms-2">{{ countCPL('KU', $data_cpl) }}</span>
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse <?php echo strpos($cpl->kode, 'KU') === 0 ? 'show' : ''; ?>"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            @foreach ($data_cpl as $data)
                                @if ($data->get('domain') == 'Keterampilan Umum')
                                    <div class="mb-3">
                                        <a href="{{ route('kaprodi.cpl.show', ['kurikulum' => $kurikulum->tahun, 'cpl' => $data->get('kode')]) }}"
                                            class="btn text-start w-100 btn-tp <?php echo $data->get('kode') == $cpl->kode ? 'border border-1' : ''; ?>"
                                            data-kode="{{ $data->get('kode') }}">{{ $data->get('kode') }}</a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold bg-light collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            KK (Keterampilan Khusus)<span
                                class="badge text-bg-primary ms-2">{{ countCPL('KK', $data_cpl) }}</span>
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse <?php echo strpos($cpl->kode, 'KK') === 0 ? 'show' : ''; ?>"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            @foreach ($data_cpl as $data)
                                @if ($data->get('domain') == 'Keterampilan Khusus')
                                    <div class="mb-3">
                                        <a href="{{ route('kaprodi.cpl.show', ['kurikulum' => $kurikulum->tahun, 'cpl' => $data->get('kode')]) }}"
                                            class="btn text-start w-100 btn-tp <?php echo $data->get('kode') == $cpl->kode ? 'border border-1' : ''; ?>"
                                            data-kode="{{ $data->get('kode') }}">{{ $data->get('kode') }}</a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal --}}
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <form method="POST"
                    action="{{ route('kaprodi.cpl.update', ['kurikulum' => $kurikulum->tahun, 'cpl' => $cpl->kode]) }}">
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
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="deskripsi" rows="3">{{ $cpl->deskripsi }}</textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <div class="row w-100">
                                <div class="col">
                                    <button type="button" class="btn btn-danger w-100"
                                        data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Batal</button>
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

        {{-- Confirm modal --}}
        <div class="modal fade" id="exampleModalToggle2" data-bs-backdrop="static" data-bs-keyboard="false"
            aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Konfirmasi Pembatalan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-4">
                        <div class="text-center">
                            <i class="bi bi-exclamation-triangle-fill text-warning fs-1"></i>
                            <div>Anda yakin ingin membatalkan proses ini?</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row w-100">
                            <div class="col">
                                <button type="button" class="btn btn-danger w-100" data-bs-target="#staticBackdrop"
                                    data-bs-toggle="modal">Tidak</button>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-success w-100" data-bs-dismiss="modal">Ya</button>
                            </div>
                        </div>
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
                        <div id="tanggal-pengajuan">{{ $cpl->created_at->translatedFormat('d F Y H:i') }}</div>
                    </div>
                    <div class="me-4">
                        <div class="fw-bold">Diperbarui pada</div>
                        <div id="tanggal-pembaruan">{{ $cpl->updated_at->translatedFormat('d F Y H:i') }}</div>
                    </div>
                    <div>
                        <div class="fw-bold">Diubah oleh</div>
                        <div>{{ $nama }}</div>
                    </div>
                </div>
                <div class="col-auto">
                    {{--<a href="{{ route('kaprodi.cpl.edit', ['kurikulum' => $kurikulum->tahun, 'cpl' => $cpl->kode]) }}"--}}
                    {{--    class="btn btn-outline-primary ">Ubah Pemetaannya pada MK</a>--}}
                    {{-- Button trigger modal --}}
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">
                        Ubah
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="fw-bold">Deskripsi</div>
                    <p id="cpl-deskripsi">{{ $cpl->deskripsi }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="fw-bold mb-3">Mata Kuliah yang dibebani</div>
                    <div class="accordion" id="accordionExample2">
                        @if (empty($cpl->indikatorKinerja))
                            <div class="text-center">
                                <p class="fs-4">Belum Ada Indikator Kinerja</p>
                            </div>
                        @endif
                        @foreach ($data_mk as $index => $mk)
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button
                                        class="accordion-button fw-bold bg-light {{ $loop->index === 0 ? '' : 'collapsed' }}"
                                        type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse{{ $loop->index }}"
                                        aria-expanded="{{ $loop->index === 0 ? 'true' : 'false' }}"
                                        aria-controls="collapse{{ $loop->index }}">
                                        {{ $mk['mataKuliah']->kode }} -
                                        {{ $mk['mataKuliah']->nama }}
                                    </button>
                                </h2>
                                <div id="collapse{{ $loop->index }}"
                                    class="accordion-collapse collapse {{ $loop->index === 0 ? 'show' : '' }}"
                                    data-bs-parent="#accordionExample2">
                                    <div class="accordion-body">
                                        <?php $dataIkTp = getDataIkTp(); ?>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Indikator Kinerja</th>
                                                    <th scope="col">Tujuan Pembelajaran</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($mk['indikatorKinerja'] as $indexIk => $ik)
                                                    <tr>
                                                        @if ($indexIk === 0)
                                                            <td class="col-md-6"
                                                                rowspan={{ count($ik['tujuanPembelajaran']) + 1 }}>
                                                                <p class="fw-bold">{{ $ik['indikatorKinerja']->kode }}</p>
                                                                <p>{{ $ik['indikatorKinerja']->deskripsi }}</p>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                    @foreach ($ik['tujuanPembelajaran'] as $tp)
                                                        <tr>
                                                            <td>
                                                                <p class="fw-bold">{{ $tp['kode'] }}</p>
                                                                <p>{{ $tp['deskripsi'] }}</p>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @break
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@endpush
