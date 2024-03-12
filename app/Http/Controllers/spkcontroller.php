<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Spk;
use App\Spkdetail;

class spkcontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
	$spk = DB::table('spk')
		->select('spk.no_spk','spk.tgl_spk','spk.no_sales_order','sales_order.no_po_customer','spk.durasi','detail_spk.tipe_spk')
		->leftJoin('detail_spk','detail_spk.no_spk','=','spk.no_spk')
		->leftJoin('sales_order','spk.no_sales_order','=','sales_order.id_so')
        ->where('spk.no_spk', 'LIKE' , 'SPK23%')
        ->orwhere('spk.no_spk', 'LIKE' , 'SPK24%')
		->get();

        return view('production.spk.index',compact('spk'));
    }

    public function show($id){
        $show_detail = DB::table('spk')
                        ->where('spk.no_spk','=',$id)
                        ->leftJoin('detail_spk','detail_spk.no_spk','=','spk.no_spk')
                        ->leftJoin('barang','detail_spk.kode_barang','=','barang.kode_barang')
                        ->get();
	
        $show_header = $show_detail->first();
        return view('production.spk.show', compact('show_detail','show_header'));
    }
    public function create(Request $req){
        $id_so = $req->kd_so;
        $detail_spk = DB::table('detail_sales_order')
                    ->where('detail_sales_order.id_sales_order', '=', $id_so)
                    ->select('detail_sales_order.counter_detail_sales_order','detail_sales_order.id_sales_order','detail_sales_order.kode_barang','barang.nama_barang','barang.ukuran','barang.spesifikasi_barang',DB::raw('detail_sales_order.qty -  COALESCE(SUM(detail_spk.qty),0) AS sisa'))
                    ->join('barang','barang.kode_barang','=','detail_sales_order.kode_barang')
                    ->leftJoin('detail_spk','detail_sales_order.counter_detail_sales_order','=','detail_spk.no_detail_sales_order')
                    ->groupBy('detail_sales_order.counter_detail_sales_order')
                    ->get();
		
        $header_spk = $detail_spk->first();
        return view('production.spk.create',compact('header_spk','detail_spk','id_so'));
    }

    public function auto_no_spk(){
       $no_urut_spk = "";
        $no = 1;
        $no_urut = DB::select("SELECT DATE_FORMAT(NOW(),'%y') AS curdat,LPAD((RIGHT(MAX(NO_SPK),4)+1),4,'0') AS NO_URUT_SPK FROM spk WHERE MID(no_spk,4,2) = DATE_FORMAT(NOW(),'%y')");
        foreach($no_urut as $so){
            if($so->NO_URUT_SPK != NULL){
                return $no_urut_spk = "SPK".$so->curdat.$so->NO_URUT_SPK;
            }else{
                return $no_urut_spk = "SPK".date('y').sprintf("%04s", $no);
            }
        } 
    }

    public function store_detail_spk(Request $request){
        $data = $request->json()->all();
         //$jason = json_decode($data);
        $no_spk = $this->auto_no_spk();
         $data2 = json_decode(json_encode($data),true);
        foreach($data2 as $dt){
            if(array_key_exists('durasi',$dt)) {
                $spk = new Spk;
                $spk->no_spk = $no_spk;
                $spk->tgl_spk = $dt['tgl_spk'];
                $spk->no_sales_order = $dt['no_sales_order'];
                $spk->durasi = $dt['durasi'];
		DB::table('sales_order')->where('id_so', $dt['no_sales_order'])->update(['status' => 'ON PROGRESS']);
                $spk->save();
            }

        }

        foreach($data2 as $dt){
            if(array_key_exists('qty',$dt)) {
                $detail = new Spkdetail;
                $detail->no_spk = $no_spk;
                $detail->kode_barang = $dt['kode_barang'];
                $detail->qty = $dt['qty'];
		        $detail->tipe_spk = $dt['tipe_spk'];
                $detail->no_detail_sales_order = $dt['no_detail_sales_order'];
                $detail->save();
            }
        }
	
        return response()->json($data, 200);


    }
    
    public function simpan_spk_masal(Request $request){
	
        $data = $request->json()->all();
        $data2 = json_decode(json_encode($data),true);
        $data_first = array_values($data)[0];
        //dd($data2);
        $detail_so = DB::table('detail_sales_order')->where('id_sales_order','=', $data_first['no_sales_order'])->get();

        foreach($data2 as $dt){
	    if(array_key_exists('kode_barang',$dt)) {

            $no_spk = $this->auto_no_spk();
	        
            $spk = new Spk;
            $spk->no_spk = $no_spk;
            $spk->tgl_spk = $data_first['tgl_spk'];
            $spk->no_sales_order = $data_first['no_sales_order'];
            $spk->durasi = $data_first['durasi'];
            DB::table('sales_order')->where('id_so',$data_first['no_sales_order'])->update(['status' => 'ON PROGRESS']);
            $spk->save();
            
            $detail = new Spkdetail;
            $detail->no_spk = $no_spk;
            $detail->kode_barang = $dt['kode_barang'];
            $detail->qty = $dt['qty'];
	        $detail->tipe_spk = $dt['tipe_spk'];
            $detail->no_detail_sales_order = $dt['no_detail_sales_order'];
            $detail->save();
	}
        }
        return response()->json(['status'=>'Data Berhasil di simpan !!!']);    
     }
	
    public function update_spk(Request $request){
	$data = $request->json()->all();
         //$jason = json_decode($data);
         $data2 = json_decode(json_encode($data),true);
	
        foreach($data2 as $dt){
            if(array_key_exists('durasi',$dt)) {
                $spk = Spk::find($dt['no_spk']);
                $spk->no_spk = $dt['no_spk'];
                $spk->tgl_spk = $dt['tgl_spk'];
                $spk->no_sales_order = $dt['no_sales_order'];
                $spk->durasi = $dt['durasi'];
		$spk->save();
            }

        }
	
	foreach($data2 as $dt){
            if(array_key_exists('qty',$dt)) {  
                $dt = Spkdetail::where('no_spk',($dt['no_spk']));
                $dt->delete();               
            }
        }
	

        foreach($data2 as $dt){
            if(array_key_exists('qty',$dt)) {
                $detail = new Spkdetail;
                $detail->no_spk = $dt['no_spk'];
                $detail->kode_barang = $dt['kode_barang'];
                $detail->qty = $dt['qty'];
		        $detail->tipe_spk = $dt['tipe_spk'];
                $detail->no_detail_sales_order = $dt['no_detail_sales_order'];
                $detail->save();
            }
        }
	
        return response()->json($data, 200);

    }

    public function detail_print($id){
	$detail_print = DB::table('spk')
                        ->where('spk.no_spk','=',$id)
                        ->leftJoin('detail_spk','detail_spk.no_spk','=','spk.no_spk')
			->leftJoin('sales_order','spk.no_sales_order','=','sales_order.id_so')
			->leftJoin('customer','customer.id_customer','=','sales_order.id_customer')
                        ->leftJoin('barang','detail_spk.kode_barang','=','barang.kode_barang')
                        ->get();
        $show_header = $detail_print->first();
        return view('production.spk.detail_print', compact('detail_print','show_header'));

    }

    public function double_detail_print($id){
	$detail_print = DB::table('spk')
                        ->where('spk.no_spk','=',$id)
                        ->leftJoin('detail_spk','detail_spk.no_spk','=','spk.no_spk')
			->leftJoin('sales_order','spk.no_sales_order','=','sales_order.id_so')
			->leftJoin('customer','customer.id_customer','=','sales_order.id_customer')
                        ->leftJoin('barang','detail_spk.kode_barang','=','barang.kode_barang')
                        ->get();
        $show_header = $detail_print->first();
        return view('production.spk.double_detail_print', compact('detail_print','show_header'));

    }


    public function get_id_so(Request $request){
        if ($request->has('q')) {
            $cari = $request->q;
            $sales_order = DB::table('sales_order')->select('id_so', 'no_po_customer')->where('id_so', 'LIKE', '%'.$cari.'%')->orWhere('no_po_customer', 'LIKE', '%'.$cari.'%')->get();

                return response()->json($sales_order);
        }
        $sales_order = DB::table('sales_order')->select('id_so','no_po_customer')->get();

        return response()->json($sales_order);
    }

    public function delete($id){
        $headspk = \App\Spk::find($id);
        $detspk =  Spkdetail::where('no_spk', $id);
        $headspk->delete();
        $detspk->delete();
        return redirect('/spk');
    }

    public function spk_batal(Request $req){
        $no_spk = $req->no_spk;
        $data_spk = Spk::where('no_spk', $no_spk)->first();
        $data_detail_spk = Spkdetail::where('no_spk', $no_spk)->first();
        // dd($data_detail_spk);
        Spk::where('no_spk', $no_spk)->update(['no_spk' => $data_spk->no_spk.'BTL','no_sales_order' => $data_spk->no_sales_order.'BTL']);
        Spkdetail::where('no_spk', $no_spk)->update(['no_spk' => $data_detail_spk->no_spk.'BTL','no_detail_sales_order' => '']);

        return redirect('/spk');
    }
    
    public function convert($id){
        $show_detail = DB::table('spk')
                        ->where('spk.no_spk','=',$id)
                        ->leftJoin('detail_spk','detail_spk.no_spk','=','spk.no_spk')
                        ->leftJoin('barang','detail_spk.kode_barang','=','barang.kode_barang')
                        ->get();
	
        $show_header = $show_detail->first();
        return view('production.spk.show', compact('show_detail','show_header'));
    }
}