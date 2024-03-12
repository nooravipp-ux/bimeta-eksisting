<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPengadaan extends Model
{
    protected $fillable = [
        'kode_pembelian', 'kode_barang', 'qty', 'harga_satuan'
    ];

    protected $table = 'detail_pengadaan';

    protected $primaryKey = 'kode_detail_pembelian';

    public $timestamps = false;
    public $incrementing = false;
}
