<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static KoorProgramStudi()
 * @method static static P2MPP()
 */
final class RoleDosen extends Enum implements LocalizedEnum
{
    const KoorProgramStudi = 'Koor. Program Studi';
    const P2MPP = 'P2MPP';
}
