<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailSpkPemakaian extends Model
{
    protected $fillable = [
        'id_detail_pemakaian', 'no_spk','harga_satuan'
    ];

    protected $table = 'detail_spk_pemakaian';

    protected $primaryKey = 'id';

    public $timestamps = false;
    public $incrementing = false;
}
