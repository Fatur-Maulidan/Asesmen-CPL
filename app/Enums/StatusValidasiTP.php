<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Disetujui()
 * @method static static Ditolak()
 * @method static static Proses()
 */
final class StatusValidasiTP extends Enum
{
    const Disetujui =   'Disetujui';
    const Ditolak =   'Ditolak';
    const Proses = 'Sedang dalam proses validasi';
}
