<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Aktif()
 * @method static static Arsip()
 * @method static static Pengelolaan()
 */
final class StatusKurikulum extends Enum
{
    const Aktif =   'Aktif';
    const Arsip =   'Arsip';
    const Pengelolaan = 'Pengelolaan';
}
