<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
Use Exception;
use App\FinishGoods;
use App\DetailFg;
use App\Stock;
use App\PemakaianMaterial;

class FinishGoodsController extends Controller
{
    public function index(){
        $data_fg = DB::table('finished_goods')
        ->where('finished_goods.id_finished_good','LIKE', '%FG-23%')
        ->get();
        return view('production.finish_goods.index', compact('data_fg'));
    }
    public function create(Request $req){
        $no_fg = $this->auto_no_fg();
        $no_spk = $req->no_spk;

	if($this->cek_spk_on_stock($no_spk)){
	    return redirect('/production/finish-goods')->with(['message' => 'No SPK '.$no_spk.' sudah di input ke stock !!!']);
	}
        $data_spk = DB::table('spk')
                        ->where('spk.no_spk','=', $no_spk)
                        ->select('detail_spk.kode_barang','barang.nama_barang','barang.ukuran','detail_spk.qty','detail_spk_pemakaian.harga_satuan')
                        ->join('detail_spk','detail_spk.no_spk','=','spk.no_spk')
                        ->join('barang','detail_spk.kode_barang','=','barang.kode_barang')
                        ->join('detail_spk_pemakaian','detail_spk_pemakaian.no_spk','=','detail_spk.no_spk')
                        ->groupBy('detail_spk.kode_barang')
                        ->get();
        return view('production.finish_goods.create', compact('no_fg','no_spk','data_spk'));
    }

    public function store(Request $request){
        $data = $request->json()->all();
         //$jason = json_decode($data);
         $data2 = json_decode(json_encode($data),true);  
	    $no_spk = "";      
        foreach($data2 as $dt){
            if(array_key_exists('no_spk',$dt)){ 
                $fg = new FinishGoods; 
                $fg->id_finished_good = $dt['id_finished_good'];
                $fg->no_spk = $dt['no_spk'];
                $fg->tgl_finish_good = $dt['tgl_finish_good'];
                $fg->save(); 
		$tgl_masuk = $dt['tgl_finish_good'];
                $no_spk = $dt['no_spk'];

            $so = $this->get_id_sales_order($no_spk);
            DB::table('sales_order')->where('id_so', $so)->update(['status' => 'PROCEEDED']);
            }     
            
        }

        foreach($data2 as $dt){
            if(array_key_exists('kode_barang',$dt)) {  
                $dfg = new DetailFg;
                $dfg->kode_barang = $dt['kode_barang'];
                $dfg->qty = $dt['qty'];
                $dfg->harga_satuan = $dt['harga_satuan'];	
                $dfg->id_fg = $dt['id_fg'];
                $dfg->save();
		
		        $stok = new Stock;
                $stok->kode_barang = $dt['kode_barang'];
                $stok->qty = $dt['qty'];
                $stok->harga_satuan = $dt['harga_satuan'];
                $stok->tgl_masuk = $tgl_masuk;
                $stok->references = $no_spk;

                $stok->save();
             
                DB::select('CALL jurnal_debit(?,?,?,?)', ['130001',$dt['harga_satuan'] * $dt['qty'],'masuk barang jadi','UMUM']);
                DB::select('CALL jurnal_kredit(?,?,?,?)', ['130002',$dt['harga_satuan'] * $dt['qty'],'masuk barang jadi','UMUM']);
		
            }
        }

        return response()->json($data, 200);
    }

    public function show($id){
        $show_detail = DB::table('finished_goods')
                        ->where('finished_goods.id_finished_good','=',$id)
                        ->join('detail_fg','detail_fg.id_fg','=','finished_goods.id_finished_good')
			->join('barang','barang.kode_barang','=','detail_fg.kode_barang')
                        ->get();
        $show_header = $show_detail->first();
        return view('production.finish_goods.show', compact('show_detail','show_header'));
    }

    public function get_id_so(){
        $data_so = DB::table('sales_order')->select('id_so')->get();
        return response()->json($data_so);   
    }
	
    public function auto_no_fg(){
        $no_urut_fg = "";
        $no = 1;
        $no_urut = DB::select("SELECT DATE_FORMAT(NOW(),'%y') AS curdat,LPAD((RIGHT(MAX(ID_FINISHED_GOOD),6)+1),6,'0') AS NO_URUT_FG FROM finished_goods");
        foreach($no_urut as $so){
            if($so->NO_URUT_FG != NULL){
                return $no_urut_fg = "FG-".$so->curdat.'-'.$so->NO_URUT_FG;
            }else{
                return $no_urut_fg = "FG-".date('y').'-'.sprintf("%06s", $no);
            }
        } 
    }

    public function get_id_sales_order($no_spk){
        $no_sales_order = DB::table('spk')
                ->select('spk.no_sales_order')
                ->where('spk.no_spk','=',$no_spk)
                ->Join('finished_goods','finished_goods.no_spk','=','spk.no_spk')
                ->get();
        $no_so = "";

        foreach($no_sales_order as $data){
        $no_so = $data->no_sales_order;
        }
        return $no_so;
    }

    public function get_no_spk_pemakaian(Request $request){
        if ($request->has('q')) {
            $cari = $request->q;
            $no_spk = DB::table('detail_spk_pemakaian')->select('no_spk')->where('no_spk', 'LIKE', '%'.$cari.'%')->get();

                return response()->json($no_spk);
        }
        $no_spk = DB::table('detail_spk_pemakaian')->select('no_spk')->get();

        return response()->json($no_spk);
    }

    public function cek_spk_on_stock($spk){
        $count_spk = DB::table('stock')->where('references', $spk)->count();
        if($count_spk > 0){
            return true;
        }
        return false;
    }
}
