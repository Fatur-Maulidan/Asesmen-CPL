<?php

use App\Enums\JurusanGolongan;
use App\Enums\PeranDosen;
use App\Enums\StatusKeaktifan;

return [
    PeranDosen::class => [
        PeranDosen::P2MPP => 'P2MPP',
        PeranDosen::Dosen => 'Dosen',
        PeranDosen::KoordinatorProgramStudi => 'Koordinator Program Studi',
    ],

    StatusKeaktifan::class => [
        StatusKeaktifan::TidakAktif => 'Tidak Aktif',
        StatusKeaktifan::Aktif => 'Aktif'
    ],

    JurusanGolongan::class => [
        JurusanGolongan::Rekayasa => 'Rekayasa',
        JurusanGolongan::NonRekayasa => 'Non Rekayasa'
    ]
];
