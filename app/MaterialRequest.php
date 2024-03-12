<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materialrequest extends Model
{
    protected $table='material_request';
    protected $fillable = ['id_material_request','tgl_material_request','peminta','no_spk'];
    protected $primaryKey = 'id_material_request';

    public $timestamps = false;
    public $incrementing = false;
}
