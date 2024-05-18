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


// Breadcrumb For Dosen-Mata Kuliah
Breadcrumbs::for('mata-kuliah', function (BreadcrumbTrail $trail): void {
    $trail->push('Home', route('mata-kuliah'));
});

?>