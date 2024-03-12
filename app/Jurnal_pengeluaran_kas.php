<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurnal_pengeluaran_kas extends Model
{
    protected $fillable = [
        'no_transaksi_jurnal', 'tgl_jurnal','deskripsi', 'nominal', 'keterangan'
    ];

    protected $table = 'pengeluaran_kas';

    protected $primaryKey = 'no_transaksi_jurnal';

    public $timestamps = false;
}
