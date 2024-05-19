<?php

function isNavbarRole($role){
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
            'link' => '#',
        ],
        [
            'title' => 'Tujuan Pembelajaran',
            'link' => '#',
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

    $kaprodi = array(
        'Dashboard',
        'Capaian Pembelajaran',
        'Indikator Kinerja',
        'Tujuan Pembelajaran',
        'Mata Kuliah',
        'Mahasiswa',
        'Dosen'
    );

    return $role == 'Dosen' ? $dosen : $kaprodi;
} 

?>