<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Aktif()
 * @method static static Nonaktif()
 * @method static static Peninjauan()
 */
final class StatusKurikulum extends Enum
{
    const Aktif =   'Aktif';
    const Nonaktif =   'Nonaktif';
    const Peninjauan = 'Peninjauan';
}
