<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'kode_barang','qty','harga_satuan','tgl_masuk','references'
    ];

    protected $table = 'stock';

    protected $primaryKey = 'id_stock';

    public $timestamps = false;
    public $incrementing = false;
}
