<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class JenisPerkuliahan extends Enum
{
    const Teori =   'Teori';
    const Praktik =   'Praktik';
}
