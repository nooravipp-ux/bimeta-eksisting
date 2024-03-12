<?php

namespace App\Exports;

use App\ProgresProduksi;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProgresCorExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $date_form, $date_to;

    function __construct($date_form, $date_to) {
	$this->date_form = $date_form;
	$this->date_to = $date_to;

    }

    public function collection()
    {
	$progres_cor = DB::table('progres_produksi')->select('progres_produksi.tgl_prod','sales_order.no_po_customer','spk.no_spk','customer.nama_customer','progres_produksi.lebar','progres_produksi.panjang','progres_produksi.kwalitas','progres_produksi.jumlah_sheet')
			->whereBetween('progres_produksi.tgl_prod', [$this->date_form, $this->date_to])
			->join('spk','progres_produksi.no_spk','spk.no_spk')
			->join('sales_order','spk.no_sales_order','sales_order.id_so')
			->join('customer','sales_order.id_customer','customer.id_customer')
			->orderBy('progres_produksi.tgl_prod')
			->get();
	//dd($progres_cor);
        return $progres_cor;
    }
	
    public function headings(): array
    {
        return [
            'TGL_PROD',
            'NO PO',
            'NO.SPK',
            'KONSUMEN',
            'LEBAR',
	    'PANJANG',
            'KUALITAS',
            'QTY',
	    'HASIL'
        ];
    }

}
