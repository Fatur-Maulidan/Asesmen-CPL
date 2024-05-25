@extends('layouts.main')

@section('breadcrumb')
    <nav aria-label="breadcrumb mb-4">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item active" aria-current="page">{{ Breadcrumbs::render() }}</li>
        </ol>
    </nav>
    <h1>Home</h1>
@endsection

@section('main')
    <div class="d-flex flex-row mb-4 me-4" style="width: 50%;">
        <select class="form-select" id="tahun-akademik" style="width:50%;padding-left:-200px"
            data-placeholder="Pilih Tahun Akademik">
            <option></option>
            @for ($index = 0; $index < 5; $index++)
                <option style="color:black" value="202{{ $index }}/202{{ $index + 1 }}">
                    202{{ $index }}/202{{ $index + 1 }}
                </option>
            @endfor
        </select>

        <div class="ms-4 position-relative" style="width:50%;">
            <input type="text" class="form-control" placeholder="Cari" style="padding-left:35px">
            <i class="bi bi-search position-absolute" style="left:5%;top:18%"></i>
        </div>
    </div>

    <div class="row overflow-auto ">
        @for ($index = 1; $index <= 3; $index++)
            <div class="col-4">
                <div class="card">
                    <div class="card-header d-flex flex-column">
                        <div class=" d-flex flex-row justify-content-between align-items-center py-3">
                            <div class="d-flex flex-column">
                                <div class="d-flex flex-row align-items-center">
                                    <?php $kodeMataKuliah = '21IF100' . $index; ?>
                                    <div class="fs-5 fw-bold me-2">{{ $kodeMataKuliah }}</div>
                                    <div class="badge text-bg-success">Berjalan</div>
                                </div>
                                <div class="">Dasar Dasar Pemrograman</div>
                            </div>
                            <a href="" class="link-dark">
                                <i class="bi bi-arrow-right-circle"></i>
                            </a>
                        </div>
                        <div class="">D3 Teknik Informatika</div>
                    </div>
                    <div class="card-body d-flex flex-column justify-content-center">
                        <div class="d-flex flex-column mb-3">
                            <div class="fw-bold">Tahun Akademik</div>
                            <div class="">20XX/20XX</div>
                        </div>
                        <div class="d-flex flex-column mb-3">
                            <div class="fw-bold">Semester</div>
                            <div class="">1/Ganjil</div>
                        </div>
                        <div class="d-flex flex-column mb-3">
                            <div class="fw-bold">Kelas Terdaftar</div>
                            <div class="">
                                <ul>
                                    <li>3A</li>
                                    <li>3B</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-body-secondary py-3">
                        <a href="{{ route('dosen.mata-kuliah.informasi-umum', ['kodeMataKuliah' => $kodeMataKuliah]) }}"
                            class="d-block">Lihat
                            Detailnya</a>
                        <a href="{{ route('dosen.mata-kuliah.tujuan-pembelajaran', ['kodeMataKuliah' => $kodeMataKuliah]) }}"
                            class="d-block">Lihat Tujuan
                            Pembelajaran</a>
                        <a href="" class="d-block">Lihat Asesmen Pembelajaran</a>
                    </div>
                </div>
            </div>
        @endfor
    </div>
@endsection

@push('scripts')
    <script>
        $('#tahun-akademik').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: true
        });
    </script>
@endpush
