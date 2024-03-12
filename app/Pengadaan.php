<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengadaan extends Model
{
    protected $fillable = [
        'id_pengadaan', 'kode_supplier', 'tgl_pembelian', 'status'
    ];

    protected $table = 'pengadaan';

    protected $primaryKey = 'id_pengadaan';

    public $timestamps = false;
    public $incrementing = false;
}
