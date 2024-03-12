<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailSalesOrder extends Model
{
    protected $fillable = [
        'id_sales_order', 'kode_barang', 'qty', 'harga_satuan','status'
    ];

    protected $table = 'detail_sales_order';

    protected $primaryKey = 'id_sales_order';

    public $timestamps = false;
    public $incrementing = false;
}
