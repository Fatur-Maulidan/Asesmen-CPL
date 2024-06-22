<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// --- Admin
Breadcrumbs::for('admin.dashboard.index', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('admin.dashboard.index'));
});

Breadcrumbs::for('admin.jurusan.index', function (BreadcrumbTrail $trail) {
    $trail->push('Jurusan', route('admin.jurusan.index'));
});

Breadcrumbs::for('admin.dosen.index', function (BreadcrumbTrail $trail) {
    $trail->push('Dosen', route('admin.dosen.index'));
});

Breadcrumbs::for('admin.mahasiswa.index', function (BreadcrumbTrail $trail) {
    $trail->push('Mahasiswa', route('admin.mahasiswa.index'));
});
// --- end of Admin

// --- Kaprodi
Breadcrumbs::for('kaprodi.dashboard.index', function (BreadcrumbTrail $trail, $kurikulum) {
    $trail->push('Home', route('kaprodi.dashboard.index'));
});

// Kurikulum
Breadcrumbs::for('kaprodi.kurikulum.index', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('kaprodi.kurikulum.index'));
});

Breadcrumbs::for('kaprodi.kurikulum.dashboard.cpl', function (BreadcrumbTrail $trail, $kurikulum) {
    $trail->parent('kaprodi.kurikulum.index');
    $trail->push('Kurikulum ' . $kurikulum, route('kaprodi.kurikulum.dashboard.cpl', ['kurikulum' => $kurikulum]));
});

Breadcrumbs::for('kaprodi.kurikulum.dashboard.mk', function (BreadcrumbTrail $trail, $kurikulum) {
    $trail->parent('kaprodi.kurikulum.index');
    $trail->push('Kurikulum ' . $kurikulum, route('kaprodi.kurikulum.dashboard.mk', ['kurikulum' => $kurikulum]));
});

Breadcrumbs::for('kaprodi.kurikulum.create', function (BreadcrumbTrail $trail) {
    $trail->parent('kaprodi.kurikulum.index');
    $trail->push('Tambah Kurikulum Baru', route('kaprodi.kurikulum.create'));
});

// CPL
Breadcrumbs::for('kaprodi.cpl.index', function (BreadcrumbTrail $trail, $kurikulum) {
    $trail->parent('kaprodi.kurikulum.dashboard.cpl', $kurikulum);
    $trail->push('Capaian Pembelajaran', route('kaprodi.cpl.index', ['kurikulum' => $kurikulum]));
});

Breadcrumbs::for('kaprodi.cpl.show', function (BreadcrumbTrail $trail, $kurikulum, $kode_cpl) {
    $trail->parent('kaprodi.cpl.index', $kurikulum);
    $trail->push($kode_cpl, route('kaprodi.cpl.show', ['kurikulum' => $kurikulum, 'cpl' => $kode_cpl]));
});

Breadcrumbs::for('kaprodi.cpl.edit', function (BreadcrumbTrail $trail, $kurikulum, $kode_cpl) {
    $trail->parent('kaprodi.cpl.index', $kurikulum);
    $trail->push($kode_cpl, route('kaprodi.cpl.edit', ['kurikulum' => $kurikulum, 'cpl' => $kode_cpl]));
});

// IK
Breadcrumbs::for('kaprodi.ik.index', function (BreadcrumbTrail $trail, $kurikulum) {
    $trail->parent('kaprodi.kurikulum.dashboard.cpl', $kurikulum);
    $trail->push('Indikator Kinerja', route('kaprodi.ik.index', ['kurikulum' => $kurikulum]));
});

Breadcrumbs::for('kaprodi.ik.show', function (BreadcrumbTrail $trail, $kurikulum, $ik) {
    $trail->parent('kaprodi.ik.index', $kurikulum);
    $trail->push($ik, route('kaprodi.ik.show', ['kurikulum' => $kurikulum, 'ik' => $ik]));
});

Breadcrumbs::for('kaprodi.ik.detail', function (BreadcrumbTrail $trail, $kurikulum, $kode_ik) {
    $trail->parent('kaprodi.ik.show', $kurikulum, $kode_ik);
    $trail->push('Pemetaan pada Capaian Pembelajaran', route('kaprodi.ik.detail', ['kurikulum' => $kurikulum, 'ik' => $kode_ik]));
});

Breadcrumbs::for('kaprodi.ik.edit', function (BreadcrumbTrail $trail, $kurikulum, $kode_ik) {
    $trail->parent('kaprodi.ik.show', $kurikulum, $kode_ik);
    $trail->push('Ubah Pemetaan pada Capaian Pembelajaran', route('kaprodi.ik.edit', ['kurikulum' => $kurikulum, 'ik' => $kode_ik]));
});

// TP
Breadcrumbs::for('kaprodi.tp.index', function (BreadcrumbTrail $trail, $kurikulum) {
    $trail->parent('kaprodi.kurikulum.dashboard.cpl', $kurikulum);
    $trail->push('Tujuan Pembelajaran', route('kaprodi.tp.index', ['kurikulum' => $kurikulum]));
});

Breadcrumbs::for('kaprodi.tp.validasi', function (BreadcrumbTrail $trail, $kurikulum) {
    $trail->parent('kaprodi.tp.index', $kurikulum);
    $trail->push('Validasi Tujuan Pembelajaran', route('kaprodi.tp.validasi', ['kurikulum' => $kurikulum]));
});

// Mata Kuliah
Breadcrumbs::for('kaprodi.mata-kuliah.index', function (BreadcrumbTrail $trail, $kurikulum) {
    $trail->parent('kaprodi.kurikulum.dashboard.cpl', $kurikulum);
    $trail->push('Mata Kuliah', route('kaprodi.mata-kuliah.index', ['kurikulum' => $kurikulum]));
});

Breadcrumbs::for('kaprodi.mata-kuliah.show', function (BreadcrumbTrail $trail, $kurikulum, $nama_mata_kuliah, $kode_mata_kuliah) {
    $trail->parent('kaprodi.mata-kuliah.index', $kurikulum);
    $trail->push($nama_mata_kuliah, route('kaprodi.mata-kuliah.show', ['kurikulum' => $kurikulum, 'mata_kuliah' => $kode_mata_kuliah]));
});

Breadcrumbs::for('kaprodi.mk.show', function (BreadcrumbTrail $trail, $kurikulum, $mk) {
    $trail->parent('kaprodi.mk.index', $kurikulum);
    $trail->push($mk['kode'] . ' - ' . $mk['nama'], route('kaprodi.mk.show', ['kurikulum' => $kurikulum, 'mk' => '1']));
});

// Mahasiswa
Breadcrumbs::for('kaprodi.mahasiswa.index', function (BreadcrumbTrail $trail, $kurikulum) {
    $trail->parent('kaprodi.kurikulum.dashboard.cpl', $kurikulum);
    $trail->push('Mahasiswa', route('kaprodi.mahasiswa.index', ['kurikulum' => $kurikulum]));
});

// Dosen
Breadcrumbs::for('kaprodi.dosen.index', function (BreadcrumbTrail $trail, $kurikulum) {
    $trail->parent('kaprodi.kurikulum.dashboard.cpl', $kurikulum);
    $trail->push('Dosen', route('kaprodi.dosen.index', ['kurikulum' => $kurikulum]));
});

// --- end of Kaprodi

// Breadcrumb Dosen/Mata Kuliah
Breadcrumbs::for('dosen.mata-kuliah', function (BreadcrumbTrail $trail): void {
    $trail->push('Home', route('dosen.mata-kuliah'));
});

// Breadcrumb Dosen Dashboard
Breadcrumbs::for('dosen.mata-kuliah.dashboard', function (BreadcrumbTrail $trail, $kodeMataKuliah): void {
    $trail->parent('dosen.mata-kuliah');
    $trail->push('Dashboard', route('dosen.mata-kuliah.dashboard', ['kodeMataKuliah' =>  $kodeMataKuliah]));
});

// Breadcrumb Dosen/Mata Kuliah/Informasi Umum
Breadcrumbs::for('dosen.mata-kuliah.informasi-umum', function (BreadcrumbTrail $trail, $kodeMataKuliah): void {
    $trail->parent('dosen.mata-kuliah');
    $trail->push($kodeMataKuliah, route('dosen.mata-kuliah'));
    $trail->push('Informasi Umum mata Kuliah', route('dosen.mata-kuliah.informasi-umum', ['kodeMataKuliah' => $kodeMataKuliah]));
});

// Breadcrumb Dosen/mata Kuliah/Indikator Kinerja
Breadcrumbs::for('dosen.mata-kuliah.indikator-kinerja', function (BreadcrumbTrail $trail, $kodeMataKuliah): void {
    $trail->parent('dosen.mata-kuliah');
    $trail->push($kodeMataKuliah, route('dosen.mata-kuliah'));
    $trail->push('Indikator Kinerja mata Kuliah', route('dosen.mata-kuliah.indikator-kinerja', ['kodeMataKuliah' => $kodeMataKuliah]));
});

// Breadcrumb Dosen/mata Kuliah/Indikator Kinerja/Detail Informasi
Breadcrumbs::for('dosen.mata-kuliah.indikator-kinerja.detail-informasi', function (BreadcrumbTrail $trail, $kodeMataKuliah): void {
    $trail->parent('dosen.mata-kuliah.indikator-kinerja', $kodeMataKuliah);
    $trail->push('Detail Informasi Indikator Kinerja', route('dosen.mata-kuliah.indikator-kinerja.detail-informasi', ['kodeMataKuliah' => $kodeMataKuliah]));
});

// Breadcrumb Dosen/mata Kuliah/Tujuan Pembelajaran
Breadcrumbs::for('dosen.mata-kuliah.tujuan-pembelajaran', function (BreadcrumbTrail $trail, $kodeMataKuliah): void {
    $trail->parent('dosen.mata-kuliah');
    $trail->push($kodeMataKuliah, route('dosen.mata-kuliah'));
    $trail->push('Tujuan Pembelajaran', route('dosen.mata-kuliah.tujuan-pembelajaran', ['kodeMataKuliah' => $kodeMataKuliah]));
});

// Breadcrumb Dosen/mata Kuliah/Tujuan Pembelajaran/Detail Informasi
Breadcrumbs::for('dosen.mata-kuliah.tujuan-pembelajaran.detail-informasi', function (BreadcrumbTrail $trail, $kodeMataKuliah, $id): void {
    $trail->parent('dosen.mata-kuliah.tujuan-pembelajaran', $kodeMataKuliah);
    $trail->push('Detail Informasi Tujuan Pembelajaran', route('dosen.mata-kuliah.tujuan-pembelajaran.detail-informasi', ['kodeMataKuliah' => $kodeMataKuliah, 'id' => $id]));
});

// Breadcrumb Dosen/mata Kuliah/Rencana Asesmen
Breadcrumbs::for('dosen.mata-kuliah.rencana-asesmen', function (BreadcrumbTrail $trail, $kodeMataKuliah): void {
    $trail->parent('dosen.mata-kuliah');
    $trail->push($kodeMataKuliah, route('dosen.mata-kuliah'));
    $trail->push('Rencana Asesmen', route('dosen.mata-kuliah.rencana-asesmen', ['kodeMataKuliah' => $kodeMataKuliah]));
});

// Breadcrumb Dosen/mata Kuliah/Rencana Asesmen/Detail Informasi
Breadcrumbs::for('dosen.mata-kuliah.rencana-asesmen.detail-informasi', function (BreadcrumbTrail $trail, $kodeMataKuliah): void {
    $trail->parent('dosen.mata-kuliah.rencana-asesmen', $kodeMataKuliah);
    $trail->push('Asesmen Pembelajaran', route('dosen.mata-kuliah.rencana-asesmen.detail-informasi', ['kodeMataKuliah' => $kodeMataKuliah]));
});

// Breadcrumb Dosen/mata Kuliah/Rencana Asesmen/Detail Informasi/Ubah
Breadcrumbs::for('dosen.mata-kuliah.rencana-asesmen.detail-informasi.ubah', function (BreadcrumbTrail $trail, $kodeMataKuliah): void {
    $trail->parent('dosen.mata-kuliah.rencana-asesmen.detail-informasi', $kodeMataKuliah);
    $trail->push('Ubah Detail Informasi Rencana Asesmen', route('dosen.mata-kuliah.rencana-asesmen.detail-informasi.ubah', ['kodeMataKuliah' => $kodeMataKuliah]));
});

// Breadcrumb Dosen/mata Kuliah/Nilai Mahasiswa
Breadcrumbs::for('dosen.mata-kuliah.nilai-mahasiswa', function (BreadcrumbTrail $trail, $kodeMataKuliah): void {
    $trail->parent('dosen.mata-kuliah');
    $trail->push($kodeMataKuliah, route('dosen.mata-kuliah'));
    $trail->push('Nilai Mahasiswa', route('dosen.mata-kuliah.nilai-mahasiswa', ['kodeMataKuliah' => $kodeMataKuliah]));
});
