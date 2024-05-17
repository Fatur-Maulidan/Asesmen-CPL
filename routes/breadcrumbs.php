<?php

use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('kurikulum.index', function (BreadcrumbTrail $trail): void {
    $trail->push('Home', route('kurikulum.index'));
});

?>