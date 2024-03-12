<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spk extends Model
{
    protected $fillable = [
        'no_spk', 'tgl_spk', 'no_sales_order', 'durasi'
    ];

    protected $table = 'spk';

    protected $primaryKey = 'no_spk';

    public $timestamps = false;
    public $incrementing = false;
}
