<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Selesai()
 * @method static static Berjalan()
 */
final class StatusMataKuliah extends Enum
{
    const Selesai =   'Selesai';
    const Berjalan =   'Berjalan';
}
