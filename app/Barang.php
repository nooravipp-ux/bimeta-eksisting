<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = [
        'kode_barang', 'nama_barang', 'tipe_barang','ukuran', 'satuan', 'harga', 'spesifikasi_barang'
    ];

    protected $table = 'barang';

    protected $primaryKey = 'kode_barang';

    public $timestamps = false;
    public $incrementing = false;

}
