<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\SuratJalan;
use App\DetailSuratJalan;
use App\Spk;
use App\DetailSpk;
use App\ProgresProduksi;

class SuratJalanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function indexSJ(){
        $dt_sj_besar = DB::table('surat_jalan')
	    ->where('surat_jalan.no_surat_jalan','LIKE', 'B23%')
        ->orwhere('surat_jalan.no_surat_jalan','LIKE', 'B24%')
    	//->where('sales_order.pajak','=','V0')
        //->orWhere('sales_order.pajak', '=', 'V1')
                ->select('surat_jalan.no_surat_jalan','surat_jalan.tgl_surat_jalan','surat_jalan.supir','surat_jalan.plat_nomor','sales_order.id_so','sales_order.no_po_customer')
                ->join('sales_order','surat_jalan.no_sales_order','=','sales_order.id_so')
                ->orderBy('surat_jalan.no_surat_jalan')
                ->get();

	    $dt_sj_kecil = DB::table('surat_jalan')
        ->where('surat_jalan.no_surat_jalan','LIKE', 'K23%')
        ->orwhere('surat_jalan.no_surat_jalan','LIKE', 'K24%')
		->where('sales_order.pajak','=','V2')
                ->select('surat_jalan.no_surat_jalan','surat_jalan.tgl_surat_jalan','surat_jalan.supir','surat_jalan.plat_nomor','sales_order.id_so','sales_order.no_po_customer','sales_order.pajak')
                ->join('sales_order','surat_jalan.no_sales_order','=','sales_order.id_so')
                ->orderBy('surat_jalan.no_surat_jalan')
                ->get();

	    $dt_sj_sample = DB::table('surat_jalan')
        ->where('surat_jalan.no_surat_jalan','LIKE', 'S23%')
        ->orwhere('surat_jalan.no_surat_jalan','LIKE', 'S24%')
		->where('sales_order.pajak','=','sample')
                ->select('surat_jalan.no_surat_jalan','surat_jalan.tgl_surat_jalan','surat_jalan.supir','surat_jalan.plat_nomor','sales_order.id_so','sales_order.no_po_customer','sales_order.pajak')
                ->join('sales_order','surat_jalan.no_sales_order','=','sales_order.id_so')
                ->orderBy('surat_jalan.no_surat_jalan')
                ->get();
// dd($dt_sj_kecil);
// die();

        return view('sales.surat_jalan.index', compact('dt_sj_besar','dt_sj_kecil', 'dt_sj_sample'));
    }

    public function createSJ($id){
        $get_v_so = DB::table('sales_order')->select('pajak')->where('id_so','=', $id)->get();
        $data_pajak = $get_v_so->first();
        $no_sj = $this->sj_no($data_pajak->pajak);
        
        $detail_so = DB::table('detail_sales_order')
                    ->where('detail_sales_order.id_sales_order', '=', $id)
                    ->select('detail_sales_order.counter_detail_sales_order','detail_sales_order.id_sales_order','detail_sales_order.kode_barang','barang.nama_barang','barang.ukuran',DB::raw('detail_sales_order.qty -  COALESCE(SUM(detail_surat_jalan.qty),0) AS sisa'))
                    ->join('barang','barang.kode_barang','=','detail_sales_order.kode_barang')
                    ->leftJoin('detail_surat_jalan','detail_sales_order.counter_detail_sales_order','=','detail_surat_jalan.no_detail_sales_order')
                    ->groupBy('detail_sales_order.counter_detail_sales_order')
                    ->get();
        // dd($detail_so);
        // die();
        $header_so = $detail_so->first();
        return view('sales.surat_jalan.create', compact('no_sj','detail_so','header_so'));
    }

    public function printSJ($id){
	
        $email = "K20000003";
        $detail_sj = DB::select("SELECT DISTINCT surat_jalan.no_surat_jalan
        , surat_jalan.tgl_surat_jalan
        , surat_jalan.no_surat_jalan
        , surat_jalan.plat_nomor
        , detail_surat_jalan.kode_barang
        , barang.nama_barang
        , barang.ukuran
            , detail_surat_jalan.qty
        , detail_surat_jalan.keterangan
        , detail_sales_order.harga_satuan
        , barang.spesifikasi_barang
        , sales_order.no_po_customer
        , sales_order.pajak
        , customer.nama_customer
        , customer.alamat_customer
        , customer.kota
        FROM
            surat_jalan
        INNER JOIN detail_surat_jalan
        ON surat_jalan.no_surat_jalan = detail_surat_jalan.no_surat_jalan
        INNER JOIN barang
        ON barang.kode_barang = detail_surat_jalan.kode_barang
        INNER JOIN sales_order 
        ON sales_order.id_so = detail_surat_jalan.no_sales_order
        INNER JOIN detail_sales_order
        ON detail_surat_jalan.no_sales_order = detail_sales_order.id_sales_order
        INNER JOIN customer
        ON customer.id_customer = sales_order.id_customer
        WHERE surat_jalan.no_surat_jalan = '$id' AND detail_surat_jalan.kode_barang = detail_sales_order.kode_barang");
	//dd($detail_sj);
        $header_sj = array_values($detail_sj)[0];
        return view('sales.surat_jalan.print_surat_jalan', compact('detail_sj','header_sj'));
    }
	
    public function printSJ_besar_v0($id){
        $email = "K20000003";
        $detail_sj = DB::select("SELECT surat_jalan.no_surat_jalan
        , surat_jalan.tgl_surat_jalan
        , surat_jalan.no_surat_jalan
        , surat_jalan.plat_nomor
        , detail_surat_jalan.kode_barang
	, barang.nama_barang
	, barang.ukuran
        , detail_surat_jalan.qty
        , detail_surat_jalan.keterangan
        , detail_sales_order.harga_satuan
        , barang.spesifikasi_barang
        , sales_order.no_po_customer
        , sales_order.pajak
        , customer.nama_customer
        , customer.alamat_customer
        , customer.kota
        FROM
            surat_jalan
        INNER JOIN detail_surat_jalan
        ON surat_jalan.no_surat_jalan = detail_surat_jalan.no_surat_jalan
        INNER JOIN barang
        ON barang.kode_barang = detail_surat_jalan.kode_barang
        INNER JOIN sales_order 
        ON sales_order.id_so = detail_surat_jalan.no_sales_order
        INNER JOIN detail_sales_order
        ON detail_surat_jalan.no_detail_sales_order = detail_sales_order.counter_detail_sales_order
        INNER JOIN customer
        ON customer.id_customer = sales_order.id_customer
        WHERE surat_jalan.no_surat_jalan = '$id' AND detail_surat_jalan.kode_barang = detail_sales_order.kode_barang");
        $header_sj = array_values($detail_sj)[0];
        return view('sales.surat_jalan.print_surat_jalan_besar_v0', compact('detail_sj','header_sj'));
    }

	
    public function printSJ_invoice($id){
        $detail_sj = DB::select("SELECT surat_jalan.no_surat_jalan
        , surat_jalan.tgl_surat_jalan
        , surat_jalan.no_surat_jalan
        , surat_jalan.plat_nomor
        , detail_surat_jalan.kode_barang
        , detail_surat_jalan.qty
        , detail_sales_order.harga_satuan
        , barang.spesifikasi_barang
	, barang.nama_barang
	, barang.ukuran
        , sales_order.no_po_customer
        , sales_order.pajak
        , customer.nama_customer
        , customer.alamat_customer
        , customer.kota
        FROM
            surat_jalan
        INNER JOIN detail_surat_jalan
        ON surat_jalan.no_surat_jalan = detail_surat_jalan.no_surat_jalan
        INNER JOIN barang
        ON barang.kode_barang = detail_surat_jalan.kode_barang
        INNER JOIN sales_order 
        ON sales_order.id_so = detail_surat_jalan.no_sales_order
        INNER JOIN detail_sales_order
        ON detail_surat_jalan.no_sales_order = detail_sales_order.id_sales_order
        INNER JOIN customer
        ON customer.id_customer = sales_order.id_customer
        WHERE surat_jalan.no_surat_jalan = '$id' AND detail_surat_jalan.kode_barang = detail_sales_order.kode_barang");
        $header_sj = array_values($detail_sj)[0];
        return view('sales.surat_jalan.print_surat_jalan2', compact('detail_sj','header_sj'));
    }
    
    public function printSJ_invoice_sj_kecil($id){
        $detail_sj = DB::select("SELECT surat_jalan.no_surat_jalan
        , surat_jalan.tgl_surat_jalan
        , surat_jalan.no_surat_jalan
        , surat_jalan.plat_nomor
        , detail_surat_jalan.kode_barang
        , detail_surat_jalan.qty
        , detail_sales_order.harga_satuan
        , barang.spesifikasi_barang
	, barang.nama_barang
	, barang.ukuran
        , sales_order.no_po_customer
        , sales_order.pajak
        , customer.nama_customer
        , customer.alamat_customer
        , customer.kota
        FROM
            surat_jalan
        INNER JOIN detail_surat_jalan
        ON surat_jalan.no_surat_jalan = detail_surat_jalan.no_surat_jalan
        INNER JOIN barang
        ON barang.kode_barang = detail_surat_jalan.kode_barang
        INNER JOIN sales_order 
        ON sales_order.id_so = detail_surat_jalan.no_sales_order
        INNER JOIN detail_sales_order
        ON detail_surat_jalan.no_sales_order = detail_sales_order.id_sales_order
        INNER JOIN customer
        ON customer.id_customer = sales_order.id_customer
        WHERE surat_jalan.no_surat_jalan = '$id' AND detail_surat_jalan.kode_barang = detail_sales_order.kode_barang");
        $header_sj = array_values($detail_sj)[0];
        return view('sales.surat_jalan.print_surat_jalan_invoice_kecil', compact('detail_sj','header_sj'));
    }



    public function printSJ_v0($id){
        
        $detail_sj = DB::table('surat_jalan')
                    ->where('surat_jalan.no_surat_jalan','=', $id)
                    ->select('barang.nama_barang','barang.ukuran','barang.satuan','barang.harga','barang.spesifikasi_barang','barang.tipe_barang','detail_surat_jalan.no_surat_jalan','detail_surat_jalan.no_sales_order','detail_surat_jalan.qty','detail_surat_jalan.keterangan','detail_surat_jalan.kode_barang','surat_jalan.no_surat_jalan','surat_jalan.tgl_surat_jalan','surat_jalan.supir','surat_jalan.plat_nomor','sales_order.no_po_customer','sales_order.pajak','customer.nama_customer','customer.alamat_customer','customer.kota','customer.no_telp')
                    ->join('detail_surat_jalan','surat_jalan.no_surat_jalan','=','detail_surat_jalan.no_surat_jalan')
                    ->join('barang','barang.kode_barang','=','detail_surat_jalan.kode_barang')
                    ->join('sales_order','sales_order.id_so','=','detail_surat_jalan.no_sales_order')
                    ->join('customer','sales_order.id_customer','=','customer.id_customer')
                    ->get();
        $header_sj = $detail_sj->first();
        return view('sales.surat_jalan.print_sj_v0', compact('detail_sj','header_sj'));
    }
    public function printSJ_sample($id){
        
        $detail_sj = DB::table('surat_jalan')
                    ->where('surat_jalan.no_surat_jalan','=', $id)
                    ->select('barang.nama_barang','barang.ukuran','barang.satuan','barang.harga','barang.spesifikasi_barang','barang.tipe_barang','detail_surat_jalan.no_surat_jalan','detail_surat_jalan.no_sales_order','detail_surat_jalan.qty','detail_surat_jalan.keterangan','detail_surat_jalan.kode_barang','surat_jalan.no_surat_jalan','surat_jalan.tgl_surat_jalan','surat_jalan.supir','surat_jalan.plat_nomor','sales_order.no_po_customer','sales_order.pajak','customer.nama_customer','customer.alamat_customer','customer.kota','customer.no_telp')
                    ->join('detail_surat_jalan','surat_jalan.no_surat_jalan','=','detail_surat_jalan.no_surat_jalan')
                    ->join('barang','barang.kode_barang','=','detail_surat_jalan.kode_barang')
                    ->join('sales_order','sales_order.id_so','=','detail_surat_jalan.no_sales_order')
                    ->join('customer','sales_order.id_customer','=','customer.id_customer')
                    ->get();
        $header_sj = $detail_sj->first();
        return view('sales.surat_jalan.print_surat_jalan_sample', compact('detail_sj','header_sj'));
    }

    public function storeSuratJalan(Request $request){
        $data = $request->json()->all();
        $data2 = json_decode(json_encode($data),true);

        if($this->cek_stok()){

            foreach($data2 as $dt){
                if(array_key_exists('qty',$dt)) {
                    if($this->cek_barang_in_stock($dt['kode_barang'])){
                        $qty_stock = DB::table('stock')->select('kode_barang', DB::raw('SUM(qty) AS stock_barang'))->where('kode_barang','=',$dt['kode_barang'])->get();  
                        $data = json_encode($qty_stock);
                        foreach($qty_stock as $d){
                            if($d->stock_barang < $dt['qty']){
                                return response()->json(['error'=>$dt['kode_barang'].' data melebihi stock']);
                            }
                        }                
                    }else{
                        return response()->json(['error'=>$dt['kode_barang'].'  tidak ada di stock !!!']);
                    }       
                }
            }

            foreach($data2 as $dt){
                if(array_key_exists('supir',$dt)) {
                    $png = new SuratJalan;
                    $png->no_surat_jalan = $dt['no_surat_jalan'];
                    $png->tgl_surat_jalan = $dt['tgl_surat_jalan'];
                    $png->supir = $dt['supir'];
                    $png->plat_nomor = $dt['plat_nomor'];
                    $png->no_sales_order = $dt['no_sales_order'];
                    $png->save();
                }
    
            }
    
            foreach($data2 as $dt){
                if(array_key_exists('qty',$dt)) {
                    $detail = new DetailSuratJalan;
                    $detail->no_surat_jalan = $dt['no_surat_jalan'];
                    $detail->kode_barang = $dt['kode_barang'];
                    $detail->qty = $dt['qty'];
                    $detail->no_sales_order = $dt['no_sales_order'];
                    $detail->keterangan = $dt['keterangan'];
                    $detail->no_detail_sales_order = $dt['no_detail_sales_order'];
                    $detail->save();
                    DB::select('CALL stock_fifo(?,?)', array($dt['kode_barang'],$dt['qty']));
                }
            }

            return response()->json($data, 200);
        }else{
            return response()->json(['error'=>'Stock Tidak Tersedia !!!']);
        }
    }

    public function getNoSO(){
        $getNoSO = DB::table('detail_sales_order')->select('id_sales_order')->distinct()->get();

        return response()->json($getNoSO);
    }

    public function get_auto_no_sj($pajak){
        $noUrutAkhir = DB::table('surat_jalan')->count();
        $no = 1;
        if($pajak == "V1"){
            if($noUrutAkhir) {
                $no_urut = "B".date('y').sprintf("%06s", abs($noUrutAkhir + 1));
                return $no_urut;
            }
            else{
                $no_urut = "B".date('y').sprintf("%06s", $no);
                return $no_urut;
            }
        }else{
            if($noUrutAkhir) {
                $no_urut = "K".date('y').sprintf("%06s", abs($noUrutAkhir + 1));
                return $no_urut;
            }
            else{
                $no_urut = "K".date('y').sprintf("%06s", $no);
                return $no_urut;
            }
        }
    }

    public function sj_no($pajak){
        $noUrutAkhir = DB::table('surat_jalan')->max('no_surat_jalan');
        $no = 1;
        if($pajak == "V0" || $pajak == "V1"){
            $no_urut = "";
            $no_urut_sj = DB::select("SELECT 'B',DATE_FORMAT(NOW(),'%y') AS curdat,LPAD((RIGHT(MAX(NO_SURAT_JALAN),4)+1),4,'0') AS NO_URUT_SPJ FROM surat_jalan WHERE MID(NO_SURAT_JALAN,2,2)= DATE_FORMAT(NOW(),'%y') AND LEFT(NO_SURAT_JALAN,1)= 'B'");
            foreach($no_urut_sj as $sj){
                if($sj->NO_URUT_SPJ != NULL){
                    return $no_urut = $sj->B.$sj->curdat.$sj->NO_URUT_SPJ;
                }else{
                    return $no_urut = "B".date('y').sprintf("%04s", $no);
                }
            }
        }elseif($pajak == "V2"){
            $no_urut = "";
            $no_urut = DB::select("SELECT 'K',DATE_FORMAT(NOW(),'%y') AS curdat,LPAD((RIGHT(MAX(NO_SURAT_JALAN),4)+1),4,'0') AS NO_URUT_SPJ FROM surat_jalan WHERE MID(NO_SURAT_JALAN,2,2)= DATE_FORMAT(NOW(),'%y') AND LEFT(NO_SURAT_JALAN,1)= 'K'");
            foreach($no_urut as $sj){
                if($sj->NO_URUT_SPJ != NULL){
                    return $no_urut = $sj->K.$sj->curdat.$sj->NO_URUT_SPJ;
                }else{
                    return $no_urut = "K".date('y').sprintf("%04s", $no);
                }
            } 
        }else{
	    $no_urut = "";
            $no_urut = DB::select("SELECT 'S',DATE_FORMAT(NOW(),'%y') AS curdat,LPAD((RIGHT(MAX(NO_SURAT_JALAN),4)+1),4,'0') AS NO_URUT_SPJ FROM surat_jalan WHERE MID(NO_SURAT_JALAN,2,2)= DATE_FORMAT(NOW(),'%y') AND LEFT(NO_SURAT_JALAN,1)= 'S'");
            foreach($no_urut as $sj){
                if($sj->NO_URUT_SPJ != NULL){
                    return $no_urut = $sj->S.$sj->curdat.$sj->NO_URUT_SPJ;
                }else{
                    return $no_urut = "S".date('y').sprintf("%04s", $no);
                }
            } 
	}
    }
    public function cek_stok(){
        $data_stock = DB::table('stock')->count();

        if($data_stock > 0){
            return true;
        }
        return false;
    }

    public function cek_barang_in_stock($kd_barang){
        $cek_stok_barang = DB::table('stock')->where('kode_barang','=',$kd_barang)->count();
        if($cek_stok_barang > 0){
            return true;
        }
        return false;
    }
    
    public function get_no_sj(Request $request){
        if ($request->has('q')) {
            $cari = $request->q;
            $no_sj = DB::table('surat_jalan')->select('no_surat_jalan')->where('no_surat_jalan', 'LIKE', '%'.$cari.'%')->get();

                return response()->json($no_sj);
        }
        $no_sj = DB::table('surat_jalan')->select('no_surat_jalan')->get();

        return response()->json($no_sj);
    }

    public function report_sj(){
	$data_report = DB::select("SELECT surat_jalan.tgl_surat_jalan
    , surat_jalan.no_surat_jalan
    , customer.nama_customer
    , sales_order.no_po_customer
    , detail_surat_jalan.kode_barang
    , barang.nama_barang
    , barang.spesifikasi_barang
    , barang.ukuran
    , detail_surat_jalan.qty
    , detail_sales_order.harga_satuan
    , sales_order.id_so
    , detail_spk.no_spk
    , detail_spk.id_detail_spk
    , detail_spk.no_detail_sales_order
    , detail_sales_order.counter_detail_sales_order
    , detail_surat_jalan.no_detail_sales_order
FROM
 customer
INNER JOIN sales_order
ON customer.id_customer = sales_order.id_customer
INNER JOIN detail_sales_order
ON sales_order.id_so = detail_sales_order.id_sales_order
INNER JOIN detail_surat_jalan
ON detail_sales_order.counter_detail_sales_order = detail_surat_jalan.no_detail_sales_order
INNER JOIN barang
ON barang.kode_barang = detail_surat_jalan.kode_barang
INNER JOIN surat_jalan
ON detail_surat_jalan.no_surat_jalan = surat_jalan.no_surat_jalan
LEFT JOIN detail_spk
ON detail_spk.no_detail_sales_order = detail_surat_jalan.no_detail_sales_order
WHERE
 sales_order.pajak = 'V2'

ORDER BY
  surat_jalan.no_surat_jalan DESC
LIMIT
 1000000");
               
    $data_report2 = DB::select("SELECT surat_jalan.tgl_surat_jalan
    , surat_jalan.no_surat_jalan
    , customer.nama_customer
    , sales_order.no_po_customer
    , detail_surat_jalan.kode_barang
    , barang.nama_barang
    , barang.spesifikasi_barang
    , barang.ukuran
    , detail_surat_jalan.qty
    , detail_sales_order.harga_satuan
    , sales_order.id_so
    , detail_spk.no_spk
    , detail_spk.id_detail_spk
    , detail_spk.no_detail_sales_order
    , detail_sales_order.counter_detail_sales_order
    , detail_surat_jalan.no_detail_sales_order
FROM
 customer
INNER JOIN sales_order
ON customer.id_customer = sales_order.id_customer
INNER JOIN detail_sales_order
ON sales_order.id_so = detail_sales_order.id_sales_order
INNER JOIN detail_surat_jalan
ON detail_sales_order.counter_detail_sales_order = detail_surat_jalan.no_detail_sales_order
INNER JOIN barang
ON barang.kode_barang = detail_surat_jalan.kode_barang
INNER JOIN surat_jalan
ON detail_surat_jalan.no_surat_jalan = surat_jalan.no_surat_jalan
LEFT JOIN detail_spk
ON detail_spk.no_detail_sales_order = detail_surat_jalan.no_detail_sales_order
WHERE
 sales_order.pajak = 'V1' or sales_order.pajak = 'V0'

ORDER BY
  surat_jalan.no_surat_jalan DESC
LIMIT
 100000 ");



	//dd($data_report);
	return view('sales.surat_jalan.report_sj', compact(['data_report','data_report2']));
    }


    public function printSJb($id){
	
    $email = "K20000003";
    $detail_sj = DB::select("SELECT DISTINCT surat_jalan.no_surat_jalan
    , surat_jalan.tgl_surat_jalan
    , surat_jalan.no_surat_jalan
    , surat_jalan.plat_nomor
    , detail_surat_jalan.kode_barang
    , barang.nama_barang
    , barang.ukuran
        , detail_surat_jalan.qty
    , detail_surat_jalan.keterangan
    , detail_sales_order.harga_satuan
    , barang.spesifikasi_barang
    , sales_order.no_po_customer
    , sales_order.pajak
    , customer.nama_customer
    , customer.alamat_customer
    , customer.kota
    FROM
        surat_jalan
    INNER JOIN detail_surat_jalan
    ON surat_jalan.no_surat_jalan = detail_surat_jalan.no_surat_jalan
    INNER JOIN barang
    ON barang.kode_barang = detail_surat_jalan.kode_barang
    INNER JOIN sales_order 
    ON sales_order.id_so = detail_surat_jalan.no_sales_order
    INNER JOIN detail_sales_order
    ON detail_surat_jalan.no_sales_order = detail_sales_order.id_sales_order
    INNER JOIN customer
    ON customer.id_customer = sales_order.id_customer
    WHERE surat_jalan.no_surat_jalan = '$id' AND detail_surat_jalan.kode_barang = detail_sales_order.kode_barang");
//dd($detail_sj);
    $header_sj = array_values($detail_sj)[0];
    return view('sales.surat_jalan.print_surat_jalan_b_fix', compact('detail_sj','header_sj'));
}
}