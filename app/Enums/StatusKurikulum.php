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
    const Aktif =   '1';
    const Nonaktif =   '2';
    const Peninjauan = '3';
}
