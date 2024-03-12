<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgresIndividu extends Model
{
    protected $fillable = [
        'no_spk', 'status_progres', 'nama_operator', 'hasil','keterangan','tgl_period'
    ];

    protected $table = 'progres_individu_produksi';

    protected $primaryKey = 'id_lap_produksi';

    public $timestamps = false;
    public $incrementing = false;
}
