<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Aktif()
 * @method static static Berjalan()
 * @method static static Pengelolaan()
 */
final class StatusKurikulum extends Enum
{
    const Aktif =   'Aktif';
    const Berjalan =   'Berjalan';
    const Pengelolaan = 'Pengelolaan';
}
