<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PengarangReferensi extends Pivot
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '23_MASTER_pengarang_referensi';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['11_MASTER_referensi_id', '23_MASTER_pengarang_id'];
}
