<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Pengelolaan()
 * @method static static Aktif()
 * @method static static Arsip()
 */
final class StatusKurikulum extends Enum
{
    const Pengelolaan = 'Pengelolaan';
    const Aktif =   'Aktif';
    const Arsip =   'Arsip';
}
