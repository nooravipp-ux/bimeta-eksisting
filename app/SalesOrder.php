<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    protected $fillable = [
        'id_so', 'id_customer', 'tgl_pemesanan', 'top', 'total_penjualan','status','pajak'
    ];

    protected $table = 'sales_order';

    protected $primaryKey = 'id_so';

    public $timestamps = false;
    public $incrementing = false;
}
