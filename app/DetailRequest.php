<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailRequest extends Model
{
    protected $table='detail_material_request';
    protected $fillable = ['id_material_request','kode_barang','qty'];
    protected $primaryKey = 'id_material_request';

    public $timestamps = false;
    public $incrementing = false;
}
