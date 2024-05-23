<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// --- Kaprodi
// Kurikulum
Breadcrumbs::for('kurikulum.index', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('kurikulum.index'));
});

Breadcrumbs::for('kurikulum.create', function (BreadcrumbTrail $trail) {
    $trail->parent('kurikulum.index');
    $trail->push('Tambah Kurikulum Baru', route('kurikulum.create'));
});

Breadcrumbs::for('kurikulum.dashboard', function (BreadcrumbTrail $trail, $kurikulum) {
    $trail->parent('kurikulum.index');
    $trail->push('Kurikulum ' . $kurikulum, route('kurikulum.dashboard', ['kurikulum' => $kurikulum]));
});

// CPL
Breadcrumbs::for('cpl.index', function (BreadcrumbTrail $trail, $kurikulum) {
    $trail->parent('kurikulum.dashboard', $kurikulum);
    $trail->push('Capaian Pembelajaran', route('cpl.index', ['kurikulum' => $kurikulum]));
});

Breadcrumbs::for('cpl.show', function (BreadcrumbTrail $trail, $kurikulum, $kode_cpl) {
    $trail->parent('cpl.index', $kurikulum);
    $trail->push($kode_cpl, route('cpl.show', ['kurikulum' => $kurikulum, 'cpl' => $kode_cpl]));
});

// IK
Breadcrumbs::for('ik.index', function (BreadcrumbTrail $trail, $kurikulum) {
    $trail->parent('kurikulum.dashboard', $kurikulum);
    $trail->push('Indikator Kinerja', route('ik.index', ['kurikulum' => $kurikulum]));
});

Breadcrumbs::for('ik.show', function (BreadcrumbTrail $trail, $kurikulum, $kode_ik) {
    $trail->parent('ik.index', $kurikulum);
    $trail->push($kode_ik, route('ik.show', ['kurikulum' => $kurikulum, 'ik' => $kode_ik]));
});

Breadcrumbs::for('ik.detail', function (BreadcrumbTrail $trail, $kurikulum, $kode_ik) {
    $trail->parent('ik.show', $kurikulum, $kode_ik);
    $trail->push('Pemetaan pada Capaian Pembelajaran', route('ik.detail', ['kurikulum' => $kurikulum, 'ik' => $kode_ik]));
});

Breadcrumbs::for('ik.edit', function (BreadcrumbTrail $trail, $kurikulum, $kode_ik) {
    $trail->parent('ik.show', $kurikulum, $kode_ik);
    $trail->push('Ubah Pemetaan pada Capaian Pembelajaran', route('ik.edit', ['kurikulum' => $kurikulum, 'ik' => $kode_ik]));
});

// TP
Breadcrumbs::for('tp.index', function (BreadcrumbTrail $trail, $kurikulum) {
    $trail->parent('kurikulum.dashboard', $kurikulum);
    $trail->push('Tujuan Pembelajaran', route('tp.index', ['kurikulum' => $kurikulum]));
});

// --- end of Kaprodi

// Breadcrumb For Dosen-Mata Kuliah
Breadcrumbs::for('mata-kuliah', function (BreadcrumbTrail $trail): void {
    $trail->push('Home', route('mata-kuliah'));
});

Breadcrumbs::for('mata-kuliah.informasi-umum', function (BreadcrumbTrail $trail): void {
    $trail->parent('mata-kuliah');
    $trail->push('Informasi Umum Mata Kuliah', route('mata-kuliah.informasi-umum'));
});

Breadcrumbs::for('mata-kuliah.indikator-kinerja', function (BreadcrumbTrail $trail): void {
    $trail->parent('mata-kuliah');
    $trail->push('Indikator Kinerja Mata Kuliah', route('mata-kuliah.indikator-kinerja'));
});

Breadcrumbs::for('mata-kuliah.indikator-kinerja.detail-informasi', function (BreadcrumbTrail $trail): void {
    $trail->parent('mata-kuliah.indikator-kinerja');
    $trail->push('Detail Informasi Indikator Kinerja', route('mata-kuliah.indikator-kinerja.detail-informasi'));
});

Breadcrumbs::for('mata-kuliah.tujuan-pembelajaran', function (BreadcrumbTrail $trail): void {
    $trail->parent('mata-kuliah');
    $trail->push('Tujuan Pembelajaran', route('mata-kuliah.tujuan-pembelajaran'));
});

Breadcrumbs::for('mata-kuliah.tujuan-pembelajaran.detail-informasi', function (BreadcrumbTrail $trail): void {
    $trail->parent('mata-kuliah.tujuan-pembelajaran');
    $trail->push('Detail Informasi Tujuan Pembelajaran', route('mata-kuliah.tujuan-pembelajaran.detail-informasi'));
});
