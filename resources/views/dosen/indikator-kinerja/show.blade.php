@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('dosen.mata-kuliah.indikator-kinerja.show', $mata_kuliah->kode, $ik->kode) }}
    <h1 class="fw-bold mb-4">{{ $title . ' ' .$ik->kode }}</h1>
@endsection

@section('main')
    <div class="d-flex flex-row justify-content-center">
        {{-- List IK --}}
        {{--<div class="d-flex flex-column pt-3 px-4 border border-1 rounded" style="width: 25%; height:100vh;">--}}
        {{--    @foreach ($link_ik as $link)--}}
        {{--        <a class="py-2 ps-3 rounded border border-1" href="{{ route('dosen.mata-kuliah.indikator-kinerja.show', ['kodeMataKuliah' => $mata_kuliah->kode, 'kodeIk' => $link->kode]) }}">{{ $link->kode }}</a>--}}
        {{--    @endforeach--}}
        {{--</div>--}}

        {{--Detail IK--}}
        <div class="row">
            <div class="col-12">
                <div class="d-flex flex-column">
                    <div class="d-flex flex-row mb-4">
                        <div class="d-flex flex-column">
                            <div class="fw-bold">Diubah pada</div>
                            <div class="">{{ $ik->created_at->translatedFormat('d F Y H:i') }}</div>
                        </div>
                        <div class="d-flex flex-column ms-4">
                            <div class="fw-bold">Diperbarui pada</div>
                            <div class="">{{ $ik->updated_at->translatedFormat('d F Y H:i') }}</div>
                        </div>
                        <a class="btn btn-secondary align-self-center ms-auto" href="{{ url()->previous() }}">Kembali</a>
                        {{--<div class="d-flex flex-column ms-4">--}}
                        {{--    <div class="fw-bold">Diubah oleh</div>--}}
                        {{--    <div class="">asasd</div>--}}
                        {{--</div>--}}
                    </div>

                    <div class="d-flex flex-column mb-4">
                        <div class="fw-bold">Deskripsi</div>
                        <div class="">{{ $ik->deskripsi }}</div>
                    </div>

                    <div class="d-flex flex-column">
                        <div class="fw-bold mb-2">Pemetaan pada Tujuan Pembelajaran</div>
                        <table class="table table-bordered table-hover">
                            <tbody>
                            @foreach ($ik->mataKuliahRegister as $mkr)
                                @foreach($mkr->pivot->tujuanPembelajaran as $tp)
                                    <tr>
                                        <td class="fw-bold text-nowrap">{{ $tp->kode }}</td>
                                        <td>{{ $ik->deskripsi }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
