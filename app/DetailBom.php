<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailBom extends Model
{
    protected $table = "detail_bom";
    protected $fillable = ['id_bom','kode_barang','qty'];
    protected $primaryKey = 'id_bom';

    public $timestamps = false;
    public $incrementing = false;
}
