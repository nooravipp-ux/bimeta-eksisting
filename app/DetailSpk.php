<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailSpk extends Model
{
    protected $fillable = [
        'id_detail_spk', 'no_spk', 'kode_barang', 'qty','no_detail_sales_order','tipe_spk'
    ];

    protected $table = 'detail_spk';

    protected $primaryKey = 'id_detail_spk';

    public $timestamps = false;
    public $incrementing = false;
}
