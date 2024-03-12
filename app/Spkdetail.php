<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spkdetail extends Model
{
    protected $fillable = [
        'no_detail_spk', 'no_spk', 'kode_barang', 'qty'
    ];

    protected $table = 'detail_spk';

    protected $primaryKey = 'no_detail_spk';

    public $timestamps = false;
    public $incrementing = false;
}
