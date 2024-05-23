<?php

use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;


// Breadcrumb For Kaprodi-Kurikulum
Breadcrumbs::for('kurikulum.index', function (BreadcrumbTrail $trail): void {
    $trail->push('Home', route('kurikulum.index'));
});


Breadcrumbs::for('kurikulum.create', function (BreadcrumbTrail $trail): void {
    $trail->parent('kurikulum.index');
    $trail->push('Tambah Kurikulum Baru', route('kurikulum.create'));
});


// Breadcrumb Dosen/Mata Kuliah
Breadcrumbs::for('mata-kuliah', function (BreadcrumbTrail $trail): void {
    $trail->push('Home', route('mata-kuliah'));
});

// Breadcrumb Dosen/Mata Kuliah/Informasi Umum 
Breadcrumbs::for('mata-kuliah.informasi-umum', function (BreadcrumbTrail $trail): void {
    $trail->parent('mata-kuliah');
    $trail->push('Informasi Umum Mata Kuliah', route('mata-kuliah.informasi-umum'));
});

// Breadcrumb Dosen/Mata Kuliah/Indikator Kinerja
Breadcrumbs::for('mata-kuliah.indikator-kinerja', function (BreadcrumbTrail $trail): void {
    $trail->parent('mata-kuliah');
    $trail->push('Indikator Kinerja Mata Kuliah', route('mata-kuliah.indikator-kinerja'));
});

// Breadcrumb Dosen/Mata Kuliah/Indikator Kinerja/Detail Informasi
Breadcrumbs::for('mata-kuliah.indikator-kinerja.detail-informasi', function (BreadcrumbTrail $trail): void {
    $trail->parent('mata-kuliah.indikator-kinerja');
    $trail->push('Detail Informasi Indikator Kinerja', route('mata-kuliah.indikator-kinerja.detail-informasi'));
});

// Breadcrumb Dosen/Mata Kuliah/Tujuan Pembelajaran
Breadcrumbs::for('mata-kuliah.tujuan-pembelajaran', function (BreadcrumbTrail $trail): void {
    $trail->parent('mata-kuliah');
    $trail->push('Tujuan Pembelajaran', route('mata-kuliah.tujuan-pembelajaran'));
});

// Breadcrumb Dosen/Mata Kuliah/Tujuan Pembelajaran/Detail Informasi
Breadcrumbs::for('mata-kuliah.tujuan-pembelajaran.detail-informasi', function (BreadcrumbTrail $trail): void {
    $trail->parent('mata-kuliah.tujuan-pembelajaran');
    $trail->push('Detail Informasi Tujuan Pembelajaran', route('mata-kuliah.tujuan-pembelajaran.detail-informasi'));
});

// Breadcrumb Dosen/Mata Kuliah/Rencana Asesmen
Breadcrumbs::for('mata-kuliah.rencana-asesmen', function (BreadcrumbTrail $trail): void {
    $trail->parent('mata-kuliah');
    $trail->push('Rencana Asesmen', route('mata-kuliah.rencana-asesmen'));
});

// Breadcrumb Dosen/Mata Kuliah/Rencana Asesmen/Detail Informasi
Breadcrumbs::for('mata-kuliah.rencana-asesmen.detail-informasi', function (BreadcrumbTrail $trail): void {
    $trail->parent('mata-kuliah.rencana-asesmen');
    $trail->push('Asesmen Pembelajaran', route('mata-kuliah.rencana-asesmen.detail-informasi'));
});

// Breadcrumb Dosen/Mata Kuliah/Rencana Asesmen/Detail Informasi/Ubah
Breadcrumbs::for('mata-kuliah.rencana-asesmen.detail-informasi.ubah', function (BreadcrumbTrail $trail): void {
    $trail->parent('mata-kuliah.rencana-asesmen.detail-informasi');
    $trail->push('Ubah Detail Informasi Rencana Asesmen', route('mata-kuliah.rencana-asesmen.detail-informasi.ubah'));
});

// Breadcrumb Dosen/Mata Kuliah/Nilai Mahasiswa
Breadcrumbs::for('mata-kuliah.nilai-mahasiswa', function (BreadcrumbTrail $trail): void {
    $trail->parent('mata-kuliah');
    $trail->push('Nilai Mahasiswa', route('mata-kuliah.nilai-mahasiswa'));
});
?>
