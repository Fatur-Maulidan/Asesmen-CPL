<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static Dosen()
 * @method static static KoordinatorProgramStudi()
 * @method static static P2MPP()
 */
final class PeranDosen extends Enum implements LocalizedEnum
{
    const P2MPP = 0;
    const Dosen = 1;
    const KoordinatorProgramStudi = 2;
}
