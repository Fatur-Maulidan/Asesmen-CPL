<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class DomainCPL extends Enum
{
    const Sikap =   'Sikap';
    const Pengetahuan =   'Pengetahuan';
    const KeterampilanUmum = 'Keterampilan Umum';
    const KeterampilanKhusus = 'Keterampilan Khusus';
}
