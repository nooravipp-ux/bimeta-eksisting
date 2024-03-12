<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailFg extends Model
{
    protected $fillable = [
        'kode_barang', 'qty','harga_satuan'
    ];

    protected $table = 'detail_fg';

    protected $primaryKey = 'no_detail_fg';

    public $timestamps = false;
    public $incrementing = false;
}
