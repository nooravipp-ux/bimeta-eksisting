<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'id_customer', 'nama_customer','alamat_customer', 'kota', 'provinsi', 'no_telp', 'pic', 'tipe_customer','tipe_pajak'
    ];

    protected $table = 'customer';

    protected $primaryKey = 'id_customer';

    public $timestamps = false;
    public $incrementing = false;
}
