<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class JurusanGolongan extends Enum
{
    const Rekayasa =   'Rekayasa';
    const NonRekayasa =   'Non Rekayasa';
}
