@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('kaprodi.tp.index', $kurikulum->tahun) }}
    <h1 class="fw-bold mb-0">{{ $title }}</h1>
@endsection

@section('main')
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between">
            <form action="" method="get" class="d-flex align-items-center">
                <label for="mata_kuliah" class="fw-bold me-3">Mata Kuliah</label>
                <select class="form-select w-auto" id="mata_kuliah" name="mata_kuliah">
                    <option value="" selected>Pilih mata kuliah</option>
                    @foreach($daftar_mata_kuliah as $mk)
                        <option value="{{ $mk->id }}"
                                @if(request('mata_kuliah') == $mk->id) selected @endif>{{ $mk->kode . ' - ' . $mk->nama }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-outline-primary ms-3">Pilih</button>
            </form>
            <a href="{{ route('kaprodi.tp.validasi', ['kurikulum' => $kurikulum->tahun]) }}"
               class="btn btn-success me-2">Validasi Tujuan Pembelajaran</a>
        </div>
    </div>

    @if($tahun_akademik->isNotEmpty() && request('mata_kuliah') != '')
        <div class="row mb-5">
            <div class="col-12 d-flex justify-content-between">
                <form action="" method="get" class="d-flex align-items-center">
                    <input type="hidden" name="mata_kuliah" value="{{ request('mata_kuliah') }}">
                    <label for="tahun_akademik" class="fw-bold me-3">Tahun Akademik</label>
                    <select class="form-select w-auto" id="tahun_akademik" name="tahun_akademik">
                        <option value="" selected>Pilih tahun akademik</option>
                        @foreach($tahun_akademik as $ta)
                            <option value="{{ $ta['tahun_akademik_awal'] }}"
                                    @if(request('tahun_akademik') == $ta['tahun_akademik_awal']) selected @endif>{{ $ta['tahun_akademik_awal'] . ' / ' . $ta['tahun_akademik_akhir'] }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-outline-primary ms-3">Pilih</button>
                </form>
            </div>
        </div>
    @elseif ($tahun_akademik->isEmpty() && request('mata_kuliah') != '')
        <div class="row">
            <div class="col-auto">
                <div class="alert alert-secondary" role="alert">
                    Belum ada tahun akademik.
                </div>
            </div>
        </div>
    @endif

    @if($data_mata_kuliah != null)
        <div class="row">
            <div class="col-12">
                @foreach($data_mata_kuliah->mataKuliahRegister as $mkr)
                    <h4><span class="badge text-bg-dark rounded rounded-pill">{{ $mkr->jenis }}</span></h4>
                    <div class="accordion mb-5" id="daftarTp{{ $loop->iteration }}">
                        @forelse($mkr->tujuanPembelajaran as $tp)
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button @if( !$loop->first ) collapsed @endif" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $loop->iteration }}" aria-expanded="true" aria-controls="collapse{{ $loop->iteration }}">
                                        {{ $tp->kode . ' - ' . $tp->deskripsi }} <span class="badge @if($tp->status == 'Disetujui') text-bg-success @elseif($tp->status == 'Ditolak') text-bg-danger @else text-bg-warning @endif rounded rounded-pill ms-3">{{ $tp->status }}</span>
                                    </button>
                                </h2>
                                <div id="collapse{{ $loop->iteration }}" class="accordion-collapse collapse @if($loop->first) show @endif" data-bs-parent="#daftarTp{{ $loop->parent->iteration }}">
                                    <div class="accordion-body p-4">
                                        <div class="fw-bold mb-2">Dipetakan terhadap Indikator Kinerja</div>
                                        <ul class="mb-0">
                                            @foreach($tp->petaIkMk as $peta)
                                                <li class="mb-3">
                                                    {{ $peta->indikatorKinerja->kode }} (Bobot: {{ $peta->pivot->bobot_tp }} &mdash; {{ \App\Enums\BobotTP::getDescription($peta->pivot->bobot_tp) }})<br>
                                                    {{ $peta->indikatorKinerja->deskripsi }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-secondary" role="alert">
                                Belum ada tujuan pembelajaran.
                            </div>
                        @endforelse
                    </div>
                @endforeach
            </div>
        </div>
    @endif
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
