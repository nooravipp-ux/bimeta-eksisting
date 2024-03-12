<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinishGoods extends Model
{
    protected $fillable = [
        'id_finished_goods', 'tgl_finish_good', 'no_spk'
    ];

    protected $table = 'finished_goods';

    protected $primaryKey = 'id_finished_goods';

    public $timestamps = false;
    public $incrementing = false;
}
