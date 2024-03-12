<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bom extends Model
{
    protected $table = "bom";
    protected $fillable = ['id_bom','kode_barang','deskripsi_material'];
    protected $primaryKey = 'id_bom';

    public $timestamps = false;
    public $incrementing = false;
}
