<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailSuratJalan extends Model
{
    protected $fillable = [
        'no_surat_jalan', 'kode_barang', 'qty', 'no_sales_order', 'status'
    ];

    protected $table = 'detail_surat_jalan';

    protected $primaryKey = 'no_detail_surat_jalan';

    public $timestamps = false;
    public $incrementing = false;
}
