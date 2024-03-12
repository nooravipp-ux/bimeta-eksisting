<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class faktur extends Model
{
    protected $table = 'faktur_penjualan';

	protected $fillable = ['no_faktur','tgl_faktur','keterangan'];
}
