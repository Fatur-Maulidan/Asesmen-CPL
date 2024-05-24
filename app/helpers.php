<?php

function isNavbarRole($role)
{
    $dosen = [
        [
            'title' => 'Dashboard',
            'link' => '#',
        ],
        [
            'title' => 'Informasi Umum',
            'link' => 'mata-kuliah.informasi-umum'
        ],
        [
            'title' => 'Indikator Kinerja',
            'link' => 'mata-kuliah.indikator-kinerja',
            'child_links' => [
                [
                    'title' => 'Detail Informasi Indikator Kinerja',
                    'link' => 'mata-kuliah.indikator-kinerja.detail-informasi'
                ]
            ]
        ],
        [
            'title' => 'Tujuan Pembelajaran',
            'link' => 'mata-kuliah.tujuan-pembelajaran',
            'child_links' => [
                [
                    'title' => 'Detail Informasi Tujuan Pembelajaran',
                    'link' => 'mata-kuliah.tujuan-pembelajaran.detail-informasi'
                ]
            ]
        ],
        [
            'title' => 'Rencana Asesmen',
            'link' => 'mata-kuliah.rencana-asesmen',
            'child_links' => [
                [
                    'title' => 'Detail Informasi Rencana Asesmen',
                    'link' => 'mata-kuliah.rencana-asesmen.detail-informasi'
                ],
                [
                    'title' => 'Ubah Detail Informasi Rencana Asesmen',
                    'link' => 'mata-kuliah.rencana-asesmen.detail-informasi.ubah'
                ]
            ]
        ],
        [
            'title' => 'Nilai Mahasiswa',
            'link' => 'mata-kuliah.nilai-mahasiswa',
        ]
    ];

    $kaprodi = [
        [
            'title' => 'Home',
            'link' => route('kurikulum.index'),
            'page_name' => 'Kurikulum'
        ],
        [
            'title' => 'Dashboard',
            'link' => '#',
        ],
        [
            'title' => 'Capaian Pembelajaran',
            'link' => '#',
        ],
        [
            'title' => 'Indikator Kinerja',
            'link' => '#',
        ],
        [
            'title' => 'Tujuan Pembelajaran',
            'link' => '#',
        ],
        [
            'title' => 'Mata Kuliah',
            'link' => '#',
        ],
        [
            'title' => 'Mahasiswa',
            'link' => '#',
        ],
        [
            'title' => 'Dosen',
            'link' => '#',
        ],
    ];

    return $role == 'Dosen' ? $dosen : $kaprodi;
}

function mahasiswa()
{
    $mahasiswa = [
        ["nim" => "211511001", "nama" => "ACHMADYA RIDWAN ILYAWAN"],
        ["nim" => "211511002", "nama" => "ADILLA RACHMAWATI PRADANA"],
        ["nim" => "211511003", "nama" => "ALDRIN RAYHAN PUTRA"],
        ["nim" => "211511004", "nama" => "ANANTA DESTAWARDHANA"],
        ["nim" => "211511005", "nama" => "ANDRE LUTFIANSYAH"],
        ["nim" => "211511006", "nama" => "APRILLIA RAHMAWATI"],
        ["nim" => "211511007", "nama" => "ARI MAULANA HARDAN"],
        ["nim" => "211511008", "nama" => "ARIANA RAHMAWATI"],
        ["nim" => "211511009", "nama" => "ARIEF RAHMAN AHMADHUSEIN"],
        ["nim" => "211511010", "nama" => "AURELL DHIENDRA NIECEL PUTRI"],
        ["nim" => "211511011", "nama" => "DEVINA LUSIANA"],
        ["nim" => "211511012", "nama" => "EVIC NUR AVIVAH"],
        ["nim" => "211511013", "nama" => "FAHMI AHMAD FADILAH"],
        ["nim" => "211511014", "nama" => "FATHAN FALATANSYA FIRDAUS"],
        ["nim" => "211511015", "nama" => "HILMAN PERMANA"],
        ["nim" => "211511016", "nama" => "IBRAHIM KEVIN ARRASYID"],
        ["nim" => "211511017", "nama" => "IRFAN KHOERUL MUPID SETIADI"],
        ["nim" => "211511018", "nama" => "LOLLA MARIAH"],
        ["nim" => "211511019", "nama" => "LUTHFIE YANNUARDY"],
        ["nim" => "211511020", "nama" => "M. FATUR MAULIDAN AZZAHRA"],
        ["nim" => "211511021", "nama" => "MEISYA PUTERI GHEFIRA"],
        ["nim" => "211511022", "nama" => "MUHAMAD ARDI NUR INSAN"],
        ["nim" => "211511023", "nama" => "MUHAMMAD ANDHIKA PRASETYA"],
        ["nim" => "211511024", "nama" => "MUHAMMAD FADHIL MAULANA"],
        ["nim" => "211511025", "nama" => "MUHAMMAD WAFDA RIZKIANSYAH"],
        ["nim" => "211511026", "nama" => "MUHAMMAD ZIDAN HIDAYAT"],
        ["nim" => "211511027", "nama" => "NADYA FRISCA REGINA FASYA"],
        ["nim" => "211511028", "nama" => "NAUFAL SALMAN MULYADI"],
        ["nim" => "211511029", "nama" => "ROFI FAUZAN AL HABIEB"],
        ["nim" => "211511030", "nama" => "SALMA AUSHAF HAFIANNE"],
        ["nim" => "211511031", "nama" => "SHOFIYAH"],
        ["nim" => "211511032", "nama" => "WILDAN SETYA NUGRAHA"],
    ];

    return $mahasiswa;
}

function countMahasiswa($mahasiswa)
{
    return count($mahasiswa);
}
