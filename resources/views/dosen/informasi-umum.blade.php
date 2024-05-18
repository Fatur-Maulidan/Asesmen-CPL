@extends('layouts.main')

@section('breadcrumb')
    <nav aria-label="breadcrumb mb-4">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item active" aria-current="page">{{ Breadcrumbs::render() }}</li>
        </ol>
    </nav>
    <h1>Informasi Umum Mata Kuliah</h1>
@endsection

@section('main')
    <div class="d-flex flex-column">
        <div class="d-flex flex-row">
            <h3 class="fw-bold me-2">21IF1001</h3>
            <h3 class="">/</h3>
            <h3 class="ms-2">Dasar - Dasar Pemgrograman</h3>
        </div>

        <hr class="hr" />

        <div class="d-flex flex-row mb-4">
            <div class="d-flex flex-column">
                <div class="fw-bold">Diubah pada</div>
                <div class="">01 / Januari / 2024 01:18</div>
            </div>
            <div class="d-flex flex-column ms-4">
                <div class="fw-bold">Diperbarui Pada</div>
                <div class="">01 / Januari / 2024 01:18</div>
            </div>
            <div class="d-flex flex-column ms-4">
                <div class="fw-bold">Diubah Oleh</div>
                <div class="">{{ $nama }}</div>
            </div>
        </div>

        <div class="d-flex flex-column mb-4">
            <div class="fw-bold">Deskripsi</div>
            <div class="">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Accusantium voluptate magnam
                dolorem libero repellat quo cupiditate assumenda, recusandae maxime sequi!</div>
        </div>

        <div class="d-flex flex-row mb-4">
            <div class="d-flex flex-column">
                <div class="fw-bold">Program Studi</div>
                <div class="">D3 Teknik Informatika</div>
            </div>
            <div class="d-flex flex-column ms-4">
                <div class="fw-bold">Kurikulum</div>
                <div class="">2021</div>
            </div>
        </div>

        <div class="d-flex flex-row mb-4">
            <div class="d-flex flex-column">
                <div class="fw-bold">Sifat Pengambilan</div>
                <div class="">Wajib</div>
            </div>
            <div class="d-flex flex-column ms-4">
                <div class="fw-bold">Bentuk Pembelajaran</div>
                <li>Ceramah</li>
                <li>Diskusi</li>
            </div>
            <div class="d-flex flex-column ms-4">
                <div class="fw-bold">Metode Pembelajaran</div>
                <div class="">Problem Based Learning (PBL)</div>
            </div>
            <div class="d-flex flex-column ms-4">
                <div class="fw-bold">Kelompok Mata Kuliah</div>
                <div class="">MKK</div>
            </div>
        </div>

        <div class="d-flex flex-row mb-4">
            <div class="d-flex flex-column">
                <div class="fw-bold">Tahun Akademik</div>
                <div class="">2021/2022</div>
            </div>
            <div class="d-flex flex-column ms-4">
                <div class="fw-bold">Semester</div>
                <div class="">1/Ganjil</div>
            </div>
            <div class="d-flex flex-column ms-4">
                <div class="fw-bold">Jumlah SKS</div>
                <div class="">4</div>
            </div>
        </div>

        <div class="mb-4">
            <div class="fw-bold">Daftar Referensi Utama</div>
            <ul>
                <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptates suscipit repellendus</li>
                <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptates suscipit repellendus</li>
                <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptates suscipit repellendus</li>
                <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptates suscipit repellendus</li>
                <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptates suscipit repellendus</li>
                <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptates suscipit repellendus</li>
                <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptates suscipit repellendus</li>
            </ul>
        </div>

        <div class="d-flex flex-column">
            <div class="fw-bold mb-3">
                Capaian Pembelajaran, Indikator Kinerja, dan Tujuan Pembelajaran yang dipetakan pada
                mata kuliah ini
            </div>
            <div class="accordion accordion-flush border border-2" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Capaian Pembelajaran
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate
                            the <code>.accordion-flush</code> class. This is the first item's accordion body.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            Indikator Kinerja
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate
                            the <code>.accordion-flush</code> class. This is the second item's accordion body. Let's imagine
                            this being filled with some actual content.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                            Tujuan Pembelajaran
                        </button>
                    </h2>
                    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to
                            demonstrate
                            the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more
                            exciting happening here in terms of content, but just filling up the space to make it look, at
                            least at first glance, a bit more representative of how this would look in a real-world
                            application.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
