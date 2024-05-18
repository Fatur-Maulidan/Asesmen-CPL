<?php

function isNavbarRole($role){
    $dosen = array(
        'Dashboard',
        'Informasi Umum',
        'Indikator Kinerja',
        'Tujuan Pembelajaran',
        'Rencana Asesmen',
        'Nilai Mahasiswa'
    );

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