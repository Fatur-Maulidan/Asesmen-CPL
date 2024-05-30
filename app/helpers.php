<?php

function isNavbarRole($role)
{
    $admin = [
        [
            'title' => 'Dashboard',
            'link' => '#'
        ],
        [
            'title' => 'Jurusan',
            'link' => 'admin.jurusan',
        ],
        [
            'title' => 'Dosen',
            'link' => '#'
        ],
    ];

    $dosen = [
        [
            'title' => 'Dashboard',
            'link' => 'admin.dashboard.index',
        ],
        [
            'title' => 'Informasi Umum',
            'link' => 'dosen.mata-kuliah.informasi-umum',
        ],
        [
            'title' => 'Indikator Kinerja',
            'link' => 'dosen.mata-kuliah.indikator-kinerja',
            'child_links' => [
                [
                    'title' => 'Detail Informasi Indikator Kinerja',
                    'link' => 'dosen.mata-kuliah.indikator-kinerja.detail-informasi',
                ]
            ]
        ],
        [
            'title' => 'Tujuan Pembelajaran',
            'link' => 'dosen.mata-kuliah.tujuan-pembelajaran',
            'child_links' => [
                [
                    'title' => 'Detail Informasi Tujuan Pembelajaran',
                    'link' => 'dosen.mata-kuliah.tujuan-pembelajaran.detail-informasi',
                    'parameters' => ""
                ]
            ]
        ],
        [
            'title' => 'Rencana Asesmen',
            'link' => 'dosen.mata-kuliah.rencana-asesmen',
            'child_links' => [
                [
                    'title' => 'Detail Informasi Rencana Asesmen',
                    'link' => 'dosen.mata-kuliah.rencana-asesmen.detail-informasi',
                    'parameters' => ""
                ],
                [
                    'title' => 'Ubah Detail Informasi Rencana Asesmen',
                    'link' => 'dosen.mata-kuliah.rencana-asesmen.detail-informasi.ubah',
                    'parameters' => ""
                ],
            ]
        ],
        [
            'title' => 'Nilai Mahasiswa',
            'link' => 'dosen.mata-kuliah.nilai-mahasiswa',
        ]
    ];

    $kaprodi = [
        [
            'title' => 'Home',
            'link' => route('kaprodi.kurikulum.index'),
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

    switch ($role) {
        case 'Admin':
            return $admin;
            break;
        case 'Dosen':
            return $dosen;
            break;
        default:
            return $kaprodi;
            break;
    };
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

function getDosen()
{
    return [
        [
            'nip' => rand(100000000000000000, 999999999999999999),
            'kode' => 'K' . rand(100, 999) . 'N',
            'nama' => 'Siti Dwi Setiarini',
            'email' => 'dummy.dosen.jtk@polban.ac.id',
            'jurusan' => 'Teknik Komputer dan Informatika',
            'id_pengguna' => '12lknx-023',
            'role' => 'Dosen',
            'status' => 'Aktif'
        ],
        [
            'nip' => rand(100000000000000000, 999999999999999999),
            'kode' => 'K' . rand(100, 999) . 'N',
            'nama' => 'Aprianti Nanda S.',
            'email' => 'dummy.dosen.jtk@polban.ac.id',
            'jurusan' => 'Teknik Komputer dan Informatika',
            'id_pengguna' => '12lknx-023',
            'role' => 'Dosen',
            'status' => 'Aktif'
        ],
        [
            'nip' => rand(100000000000000000, 999999999999999999),
            'kode' => 'K' . rand(100, 999) . 'N',
            'nama' => 'Trisna Gelar A.',
            'email' => 'dummy.dosen.jtk@polban.ac.id',
            'jurusan' => 'Teknik Komputer dan Informatika',
            'id_pengguna' => '12lknx-023',
            'role' => 'Dosen',
            'status' => 'Aktif'
        ],
        [
            'nip' => rand(100000000000000000, 999999999999999999),
            'kode' => 'K' . rand(100, 999) . 'N',
            'nama' => 'Santi Sundari',
            'email' => 'dummy.dosen.jtk@polban.ac.id',
            'jurusan' => 'Teknik Komputer dan Informatika',
            'id_pengguna' => '12lknx-023',
            'role' => 'Dosen',
            'status' => 'Aktif'
        ],
        [
            'nip' => rand(100000000000000000, 999999999999999999),
            'kode' => 'K' . rand(100, 999) . 'N',
            'nama' => 'Ferry Ferizal',
            'email' => 'dummy.dosen.jtk@polban.ac.id',
            'jurusan' => 'Teknik Komputer dan Informatika',
            'id_pengguna' => '12lknx-023',
            'role' => 'Dosen',
            'status' => 'Aktif'
        ],
        [
            'nip' => rand(100000000000000000, 999999999999999999),
            'kode' => 'K' . rand(100, 999) . 'N',
            'nama' => 'Didik Suwito',
            'email' => 'dummy.dosen.jtk@polban.ac.id',
            'jurusan' => 'Teknik Komputer dan Informatika',
            'id_pengguna' => '12lknx-023',
            'role' => 'Dosen',
            'status' => 'Aktif'
        ],
        [
            'nip' => rand(100000000000000000, 999999999999999999),
            'kode' => 'K' . rand(100, 999) . 'N',
            'nama' => 'Hasri Hayati',
            'email' => 'dummy.dosen.jtk@polban.ac.id',
            'jurusan' => 'Teknik Komputer dan Informatika',
            'id_pengguna' => '12lknx-023',
            'role' => 'Dosen',
            'status' => 'Aktif'
        ],
        [
            'nip' => rand(100000000000000000, 999999999999999999),
            'kode' => 'K' . rand(100, 999) . 'N',
            'nama' => 'Sri Ratna W.',
            'email' => 'dummy.dosen.jtk@polban.ac.id',
            'jurusan' => 'Teknik Komputer dan Informatika',
            'id_pengguna' => '12lknx-023',
            'role' => 'Dosen',
            'status' => 'Aktif'
        ],
        [
            'nip' => rand(100000000000000000, 999999999999999999),
            'kode' => 'K' . rand(100, 999) . 'N',
            'nama' => 'N. S. Junaedi',
            'email' => 'dummy.dosen.jtk@polban.ac.id',
            'jurusan' => 'Teknik Komputer dan Informatika',
            'id_pengguna' => '12lknx-023',
            'role' => 'Dosen',
            'status' => 'Aktif'
        ],
        [
            'nip' => rand(100000000000000000, 999999999999999999),
            'kode' => 'K' . rand(100, 999) . 'N',
            'nama' => 'Waway Qodratullah S.',
            'email' => 'dummy.dosen.jtk@polban.ac.id',
            'jurusan' => 'Teknik Komputer dan Informatika',
            'id_pengguna' => '12lknx-023',
            'role' => 'Dosen',
            'status' => 'Aktif'
        ],
    ];
}

function checkStatusTP($status)
{
    if ($status == 'Disetujui') {
        return 'badge text-bg-success ms-3';
    } elseif ($status == 'Menunggu Validasi') {
        return 'badge text-bg-warning ms-3';
    } elseif ($status == 'Ditolak') {
        return 'badge text-bg-danger ms-3';
    }
}

function countCPL($prefix, $dataCPL){
    $count = 0;
    foreach($dataCPL as $cpl){
        if(strpos($cpl->kode, $prefix) === 0) $count++;
    }
    return $count;
}
