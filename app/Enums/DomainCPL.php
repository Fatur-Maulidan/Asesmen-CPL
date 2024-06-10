<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Sikap()
 * @method static static Pengetahuan()
 * @method static static KeterampilanUmum()
 * @method static static KeterampilanKhusus()
 */
final class DomainCPL extends Enum
{
    const Sikap =   'Sikap';
    const Pengetahuan =   'Pengetahuan';
    const KeterampilanUmum = 'Keterampilan Umum';
    const KeterampilanKhusus = 'Keterampilan Khusus';
}
