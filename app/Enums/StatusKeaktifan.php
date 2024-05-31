<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static Aktif()
 * @method static static TidakAktif()
 */
final class StatusKeaktifan extends Enum implements LocalizedEnum
{
    const Nonaktif = 'Nonaktif';
    const Aktif = 'Aktif';
}
