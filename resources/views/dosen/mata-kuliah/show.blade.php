@extends('layouts.main')

@section('breadcrumb')
    {{ Breadcrumbs::render('dosen.mata-kuliah.show', $mata_kuliah->kode) }}
    <h1 class="fw-bold mb-4">{{ $title }}</h1>
@endsection

@section('main')
    <div class="d-flex flex-column">
        <div class="d-flex flex-row">
            <h3 class="fw-bold me-2">{{ $mata_kuliah->kode }}</h3>
            <h3 class="">/</h3>
            <h3 class="ms-2">{{ $mata_kuliah->nama }}</h3>
        </div>

        <hr class="hr" />

        <div class="d-flex flex-row mb-4">
            <div class="d-flex flex-column">
                <div class="fw-bold">Ditambahkan pada</div>
                <div class="">{{ $mata_kuliah->created_at->translatedFormat('d F Y H:i') }}</div>
            </div>
            <div class="d-flex flex-column ms-4">
                <div class="fw-bold">Diperbarui Pada</div>
                <div class="">{{ $mata_kuliah->updated_at->translatedFormat('d F Y H:i') }}</div>
            </div>
            {{--<div class="d-flex flex-column ms-4">--}}
            {{--    <div class="fw-bold">Diubah Oleh</div>--}}
            {{--    <div class="">{{ $nama }}</div>--}}
            {{--</div>--}}
        </div>

        <div class="d-flex flex-column mb-4">
            <div class="fw-bold">Deskripsi</div>
            <div class="">{{ $mata_kuliah->deskripsi }}</div>
        </div>

        <div class="d-flex flex-row mb-4">
            <div class="d-flex flex-column">
                <div class="fw-bold">Program Studi</div>
                <div class="">{{ $mata_kuliah->kurikulum->programStudi->jenjang_pendidikan }} - {{ $mata_kuliah->kurikulum->programStudi->nama }}</div>
            </div>
            <div class="d-flex flex-column ms-4">
                <div class="fw-bold">Kurikulum</div>
                <div class="">{{ $mata_kuliah->kurikulum->tahun }}</div>
            </div>
        </div>

        {{--<div class="d-flex flex-row mb-4">--}}
        {{--    <div class="d-flex flex-column">--}}
        {{--        <div class="fw-bold">Sifat Pengambilan</div>--}}
        {{--        <div class="">Wajib</div>--}}
        {{--    </div>--}}
        {{--    <div class="d-flex flex-column ms-4">--}}
        {{--        <div class="fw-bold">Bentuk Pembelajaran</div>--}}
        {{--        <li>Ceramah</li>--}}
        {{--        <li>Diskusi</li>--}}
        {{--    </div>--}}
        {{--    <div class="d-flex flex-column ms-4">--}}
        {{--        <div class="fw-bold">Metode Pembelajaran</div>--}}
        {{--        <div class="">Problem Based Learning (PBL)</div>--}}
        {{--    </div>--}}
        {{--    <div class="d-flex flex-column ms-4">--}}
        {{--        <div class="fw-bold">Kelompok Mata Kuliah</div>--}}
        {{--        <div class="">MKK</div>--}}
        {{--    </div>--}}
        {{--</div>--}}

        <div class="d-flex flex-row mb-4">
            <div class="d-flex flex-column">
                <div class="fw-bold">Tahun Akademik</div>
                <div class="">{{ $mata_kuliah->mataKuliahRegister[0]->tahun_akademik }}</div>
            </div>
            <div class="d-flex flex-column ms-4">
                <div class="fw-bold">Semester</div>
                <div class="">
                    {{ $mata_kuliah->mataKuliahRegister[0]->semester }} / {{ $mata_kuliah->mataKuliahRegister[0]->semester % 2 == 0 ? 'Genap' : 'Ganjil' }}
                </div>
            </div>
            {{--<div class="d-flex flex-column ms-4">--}}
            {{--    <div class="fw-bold">Jumlah SKS</div>--}}
            {{--    <div class="">{{ $mata_kuliah->jumlah_sks }}</div>--}}
            {{--</div>--}}
            <div class="d-flex flex-column ms-4">
                <div class="fw-bold">Jenis</div>
                <div>
                    @foreach($mata_kuliah->mataKuliahRegister as $mkr)
                        <span class="badge text-bg-primary fs-6">{{ $mkr->jenis }}</span>
                    @endforeach
                </div>
            </div>
        </div>

        {{--<div class="mb-4">--}}
        {{--    <div class="fw-bold">Daftar Referensi Utama</div>--}}
        {{--    <ul>--}}
        {{--        <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptates suscipit repellendus</li>--}}
        {{--        <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptates suscipit repellendus</li>--}}
        {{--        <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptates suscipit repellendus</li>--}}
        {{--        <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptates suscipit repellendus</li>--}}
        {{--        <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptates suscipit repellendus</li>--}}
        {{--        <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptates suscipit repellendus</li>--}}
        {{--        <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptates suscipit repellendus</li>--}}
        {{--    </ul>--}}
        {{--</div>--}}

        <div class="mb-3">
            <div class="fw-bold mb-3">Capaian Pembelajaran</div>
            <table class="table table-bordered table-hover">
                <tbody>
                @foreach($cpl_mata_kuliah as $cpl)
                    <tr>
                        <td class="fw-bold text-nowrap">{{ $cpl['kode'] }}</td>
                        <td>{{ $cpl['deskripsi'] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mb-3">
            <div class="fw-bold mb-3">Indikator Kinerja</div>
            <table class="table table-bordered table-hover">
                <tbody>
                @foreach($ik_mata_kuliah as $ik)
                    <tr>
                        <td class="fw-bold text-nowrap">{{ $ik['kode'] }}</td>
                        <td>{{ $ik['deskripsi'] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mb-0">
            <div class="fw-bold mb-3">Tujuan Pembelajaran</div>
            <table class="table table-bordered table-hover">
                <tbody>
                @foreach($tp_mata_kuliah as $tp)
                    <tr>
                        <td class="fw-bold text-nowrap">{{ $tp['kode'] }}</td>
                        <td>{{ $tp['deskripsi'] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
