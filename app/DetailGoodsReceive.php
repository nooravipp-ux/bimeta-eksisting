<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailGoodsReceive extends Model
{
    protected $fillable = [
        'id_gr', 'kode_barang', 'qty', 'harga_satuan'
    ];

    protected $table = 'detail_gr';

    protected $primaryKey = 'id_detail_gr';

    public $timestamps = false;
    public $incrementing = false;
}
