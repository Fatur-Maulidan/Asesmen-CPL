<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('kurikulum.index', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('kurikulum.index'));
});

Breadcrumbs::for('kurikulum.create', function (BreadcrumbTrail $trail) {
    $trail->parent('kurikulum.index');
    $trail->push('Tambah Kurikulum Baru', route('kurikulum.create'));
});

Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail, $kurikulum) {
    $trail->parent('kurikulum.index');
    $trail->push('Kurikulum', route('dashboard', ['kurikulum' => $kurikulum]));
});

Breadcrumbs::for('cpl.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard', 2022);
    $trail->push('Capaian Pembelajaran', route('cpl.index', ['kurikulum' => 2022]));
});
