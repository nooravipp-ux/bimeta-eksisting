<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'kode_supplier', 'nama_supplier', 'pic_supplier', 'alamat_supplier', 'telp_supplier', 'top', 'kota', 'provinsi'
    ];

    protected $table = 'supplier';

    protected $primaryKey = 'kode_supplier';

    public $timestamps = false;
    public $incrementing = false;
}
