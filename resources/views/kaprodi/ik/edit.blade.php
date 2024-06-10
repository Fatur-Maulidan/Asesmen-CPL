@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('kaprodi.ik.edit', $kurikulum->tahun, $ik->kode) }}
    <h1 class="fw-bold mb-0">Ubah Pemetaan {{ $ik['kode'] }} pada Capaian Pembelajaran</h1>
@endsection

@section('main')
    <div class="row">
        {{-- Sidebar --}}
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    @foreach ($dataIk as $data)
                        <div class="mb-3">
                            <a href="{{ route('kaprodi.ik.edit', ['kurikulum' => $kurikulum->tahun, 'ik' => $data->kode]) }}"
                                class="btn btn-light w-100 text-start {{ $data->kode == $ik->kode ? 'active' : '' }}">
                                {{ $data->kode }}
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

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
                        <form action="">
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label fw-bold">Deskripsi</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero impedit est animi consectetur ipsum itaque? Culpa quibusdam harum amet aspernatur?</textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <div class="row w-100">
                            <div class="col">
                                <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Batal</button>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-success w-100">Ubah</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Detail --}}
        <div class="col-9">
            <div class="row">
                <div class="col">
                    <div class="fw-bold">Deskripsi</div>
                    <p>{{ $ik->deskripsi }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="fw-bold mb-3">Centang butir CPL yang relevan dengan isi dari indikator kinerja</div>
                    <div class="accordion accordion-flush" id="accordionExample">
                        @foreach ($domainCpl as $indexDomain => $domain)
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button fw-bold bg-light collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse{{ $indexDomain }}"
                                        aria-expanded="false" aria-controls="collapse{{ $indexDomain }}" disabled>
                                        {{ $domain }}
                                    </button>
                                </h2>
                                @foreach ($dataCpl as $index => $cpl)
                                    @if ($cpl->domain == $domain)
                                        <div id="collapse{{ $indexDomain }}"
                                            class="accordion-collapse collapse <?php echo $ik->capaianPembelajaranLulusan[0]->domain == $domain ? 'show' : ''; ?>"
                                            data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="flexCheckDefault" <?php
                                                            foreach ($ik->capaianPembelajaranLulusan as $cplIk) {
                                                                if ($cplIk->kode == $cpl->kode) {
                                                                    echo 'checked';
                                                                }
                                                            }
                                                            ?>>
                                                        <label class="form-check-label fw-bold" for="flexCheckDefault">
                                                            {{ $cpl->kode }}
                                                        </label>
                                                    </div>
                                                    <p>
                                                        {{ $cpl->deskripsi }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
