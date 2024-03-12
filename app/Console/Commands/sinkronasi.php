<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\ProgresProduksi;
use App\DetailSuratJalan;
use App\DetailSpk;
use App\SuratJalan;
use App\Spk;

class sinkronasi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sinkron:produksi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $detail_spj = DB::select ("select * from detail_surat_jalan inner join surat_jalan on detail_surat_jalan.no_surat_jalan = surat_jalan.no_surat_jalan where month(date(surat_jalan.tgl_surat_jalan)) = month(date(now())) and year(date(surat_jalan.tgl_surat_jalan)) = year(date(now()))");
        $temp = json_encode($detail_spj);
        $temp2 = json_decode($temp,1);
        //  $result = json_decode($detail_spj, true);
        foreach ($temp2 as $dt) {
           // var_dump($dt['no_surat_jalan']);
            $nomor_spk_progress_produksi = Spk::where('no_sales_order', $dt['no_sales_order'])->get();
            $dataspk = $nomor_spk_progress_produksi->toArray();

            foreach ($dataspk as $spk_jalan) {
             //   var_dump($spk_jalan['no_spk']);
                $nomor_surat_pp = DetailSpk::where('no_spk', $spk_jalan['no_spk'])->where('kode_barang', $dt['kode_barang'])->first();
                if ($nomor_surat_pp['no_spk'] <> null) {
                    var_dump($nomor_surat_pp['no_spk']);
                    var_dump($dt['no_surat_jalan']);
                    var_dump($dt['qty']);

                    $tgl_surat_jalan = SuratJalan::where('no_surat_jalan', $dt['no_surat_jalan'])->first();
                    var_dump($tgl_surat_jalan['tgl_surat_jalan']);
                    $updated = ProgresProduksi::where('no_spk', $nomor_surat_pp['no_spk'])
                        ->where('no_inv','not LIKE', '%'.$dt['no_surat_jalan'].'%')
                        ->update(['no_inv' => DB::raw('CONCAT(no_inv,"' . 'SJ:' . $dt['no_surat_jalan'] . ' QTY:' . $dt['qty'] . ' TGL:' . $tgl_surat_jalan['tgl_surat_jalan'] . ';")')]);

                    if ($updated) {
                        var_dump('success');
                    }
                }
//                else {
//                    var_dump('failed');
//                }
            }

        }
    }
}
