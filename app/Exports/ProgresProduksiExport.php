<?php

namespace App\Exports;
use Illuminate\Support\Facades\DB;
use App\ProgresProduksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProgresProduksiExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $pic;

    function __construct($pic,$date_form, $date_to) {
        $this->pic = $pic;
	    $this->date_form = $date_form;
    	$this->date_to = $date_to;

    }

    public function collection()
    {
	//dd($this->date_form, $this->date_to );
	$lap_produksi = DB::table('progres_produksi')
			->select('progres_produksi.tgl_prod','sales_order.no_po_customer','spk.no_spk','customer.nama_customer','progres_produksi.lebar','progres_produksi.panjang','progres_produksi.kwalitas','progres_produksi.jumlah_sheet','progres_produksi.jumlah_box','progres_produksi.cor','progres_produksi.slitter','progres_produksi.pon','progres_produksi.coak','progres_produksi.print','progres_produksi.slotter','progres_produksi.lem','progres_produksi.kancing','progres_produksi.tgl_pengiriman','progres_produksi.coak','progres_produksi.no_inv')
			->where('customer.pic','=',$this->pic)
			->whereBetween('progres_produksi.tgl_prod', [$this->date_form, $this->date_to])
			->join('spk','progres_produksi.no_spk','spk.no_spk')
			->join('sales_order','spk.no_sales_order','sales_order.id_so')
			->join('customer','sales_order.id_customer','customer.id_customer')
			->get();
	//dd($lap_produksi);
        return $lap_produksi;
    }
	
    public function headings(): array
    {
        return [
            'TGL PROD',
            'NO PO',
            'NO SPK',
            'CUSTOMER',
	    'LEBAR',
            'PANJANG',
            'KUALITAS',
            'JMLH SHEET',
            'JMLH BOX',
	    'COR',
            'SLITTER',
            'PON',
            'COAK',
            'PRINT',
	    'SLOTTER',
            'LEM',
            'KANCING',
            'TGL',
	    'NO INV',
	    'JMLH'
        ];
    }
}
