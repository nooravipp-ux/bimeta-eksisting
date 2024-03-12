<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPemakaianMaterial extends Model
{
    protected $fillable = [
        'kode_barang', 'qty', 'harga_satuan','id_pemakaian_material'
    ];

    protected $table = 'detail_pemakaian_material';

    protected $primaryKey = 'id_detail_pemakaian';

    public $timestamps = false;
    public $incrementing = false;
}
