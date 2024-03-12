<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PemakaianMaterial extends Model
{
    protected $fillable = [
        'id_pemakaian_material', 'id_spk', 'tgl_pemakaian', 'in_charge','total_pemakaian_material'
    ];

    protected $table = 'pemakaian_material';

    protected $primaryKey = 'id_pemakaian_material';

    public $timestamps = false;
    public $incrementing = false;
}
