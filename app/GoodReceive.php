<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoodReceive extends Model
{
    protected $fillable = [
        'id_gr', 'tgl_gr', 'penerima', 'status', 'id_pengadaan'
    ];

    protected $table = 'gr';

    protected $primaryKey = 'id_gr';

    public $timestamps = false;
    public $incrementing = false;
}
