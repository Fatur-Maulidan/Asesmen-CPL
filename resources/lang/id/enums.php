<?php

use App\Enums\BobotTP;
use App\Enums\DomainCPL;
use App\Enums\JenisKelamin;
use App\Enums\JenisPerkuliahan;
use App\Enums\JenjangPendidikan;
use App\Enums\KategoriJurusan;
use App\Enums\RoleDosen;
use App\Enums\StatusKeaktifan;
use App\Enums\StatusKurikulum;
use App\Enums\StatusMataKuliah;

return [
    BobotTP::class => [
        BobotTP::KurangRelevan => 'Kurang Relevan',
        BobotTP::Relevan => 'Relevan',
        BobotTP::SangatRelevan => 'Sangat Relevan',
    ],

    DomainCPL::class => [
        DomainCPL::Sikap => 'Sikap',
        DomainCPL::Pengetahuan => 'Pengetahuan',
        DomainCPL::KeterampilanUmum => 'Keterampilan Umum',
        DomainCPL::KeterampilanKhusus => 'Keterampilan Khusus'
    ],

    JenisKelamin::class => [
        JenisKelamin::LakiLaki => 'Laki-Laki',
        JenisKelamin::Perempuan => 'Perempuan'
    ],

    JenisPerkuliahan::class => [
        JenisPerkuliahan::Teori => 'Teori',
        JenisPerkuliahan::Praktikum => 'Praktikum'
    ],

    JenjangPendidikan::class => [
        JenjangPendidikan::D3 => 'D3',
        JenjangPendidikan::D4 => 'D4'
    ],

    KategoriJurusan::class => [
        KategoriJurusan::Rekayasa => 'Rekayasa',
        KategoriJurusan::Nonrekayasa => 'Nonrekayasa'
    ],

    RoleDosen::class => [
        RoleDosen::KoorProgramStudi => 'Koor. Program Studi',
        RoleDosen::P2MPP => 'P2MPP',
    ],

    StatusKeaktifan::class => [
        StatusKeaktifan::Nonaktif => 'Nonaktif',
        StatusKeaktifan::Aktif => 'Aktif'
    ],

    StatusKurikulum::class => [
        StatusKurikulum::Aktif => 'Aktif',
        StatusKurikulum::Arsip => 'Arsip',
        StatusKurikulum::Pengelolaan => 'Pengelolaan',
    ],

    StatusMataKuliah::class => [
        StatusMataKuliah::Berjalan => 'Berjalan',
        StatusMataKuliah::Selesai => 'Selesai'
    ]
];
