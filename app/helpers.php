<?php

function isNavbarRole($role){
    $dosen = [
        [
            'title' => 'Dashboard',
        ],
        [
            'title' => 'Informasi Umum',
            'link' => 'mata-kuliah/informasi-umum'
        ],
        [
            'title' => 'Indikator Kinerja',
        ],
        [
            'title' => 'Tujuan Pembelajaran',
        ],
        [
            'title' => 'Rencana Asesmen',
        ],
        [
            'title' => 'Nilai Mahasiswa',
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