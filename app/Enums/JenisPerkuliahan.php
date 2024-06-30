<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Teori()
 * @method static static Praktikum()
 */
final class JenisPerkuliahan extends Enum
{
    const Teori =   'Teori';
    const Praktik =   'Praktikum';
}
