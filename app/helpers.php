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
            'link' => '#',
        ],
        [
            'title' => 'Nilai Mahasiswa',
            'link' => '#',
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
