<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KodePerkiraan extends Model
{
    protected $fillable = [
        'NO_COA','DESKRIPSI_COA','HEADER','SUB','JENIS','SALDO'
    ];

    protected $table = 'coa';

    protected $primaryKey = 'NO_COA';

    public $timestamps = false;
    public $incrementing = false;
}
