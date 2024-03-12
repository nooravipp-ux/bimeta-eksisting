<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgresProduksi extends Model
{
    protected $fillable = [
        'no_spk', 'tgl_prod', 'lebar', 'panjang','kwalitas','jumlah_sheet','jumlah_box', 'cor', 'slitter', 'pon','coak','print','slotter','lem','kancing','tgl_selesai','persentase','no_inv','jml_kirim'
    ];

    protected $table = 'progres_produksi';

    protected $primaryKey = 'id_prod';

    public $timestamps = false;
    public $incrementing = false;
}
