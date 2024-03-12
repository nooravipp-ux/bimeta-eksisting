<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_report_pemakaian extends Model
{
    protected $fillable = [
        'id', 'no_mesin', 'kd_barang','masuk_mesin', 'sisa_timbangan', 'terpakai', 'id_pemakaian_material'
    ];

    protected $table = 'tbl_report_pemakaian';

    protected $primaryKey = 'id';

    public $timestamps = false;
    public $incrementing = false;

}
