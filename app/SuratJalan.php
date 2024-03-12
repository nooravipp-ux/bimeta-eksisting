<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuratJalan extends Model
{
    protected $fillable = [
        'no_surat_jalan', 'tgl_surat_jalan', 'supir', 'plat_nomor'
    ];

    protected $table = 'surat_jalan';

    protected $primaryKey = 'no_surat_jalan';

    public $timestamps = false;
    public $incrementing = false;
}
