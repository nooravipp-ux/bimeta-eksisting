<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\PemakaianMaterial;
use App\DetailPemakaianMaterial;
use App\DetailSpkPemakaian;
use App\tbl_report_pemakaian;


class PemakaianMaterialController extends Controller
{
    public function index(){
        $data_pemakaian = DB::table('pemakaian_material')->get();
        return view('production.pemakaian_material.index', compact('data_pemakaian'));
    }

    public function create(Request $req){
        $no_pemakaian = $this->auto_no_pemakaian();
        //$ref_spk = $req->no_spk;

        return view('production.pemakaian_material.create', compact('no_pemakaian'));
    }

    public function store(Request $request){
        $data = $request->json()->all();
         //$jason = json_decode($data);
        $data2 = json_decode(json_encode($data),true);
        //dd(count($data2));   
        $data_qty = [];

        for($i = 0; $i < count($data2); $i++ ){
            $data_qty[] = DB::table('detail_spk')->select('qty')->where('no_spk','=', $data2[$i]['no_spk'])->first();
        } 
        return response()->json($data_qty);  
    }

    public function store_pemakaian(Request $request){
        $data = $request->json()->all();
	//dd($data);
         //$jason = json_decode($data);
        $data2 = json_decode(json_encode($data),true);
        $no_pemakaian = $this->auto_no_pemakaian();
        if(($this->cek_stok())){
            foreach($data2 as $dt){
                if(array_key_exists('kode_barang',$dt)) {
                    if($this->cek_barang_in_stock($dt['kode_barang'])){
                        $qty_stock = DB::table('stock')->select('kode_barang', DB::raw('SUM(qty) AS stock_barang'))->where('kode_barang','=',$dt['kode_barang'])->get();  
                        $data = json_encode($qty_stock);
                        foreach($qty_stock as $d){
                            if($d->stock_barang < $dt['qty']){
                                return response()->json(['error'=>$dt['kode_barang'].' data melebihi stock . Cek data stock untuk mengetahui max qty.']);
                            }
                        }                
                    }else{
                        return response()->json(['error'=>$dt['kode_barang'].'  tidak ada di stock !!!']);
                    }       
                }
            }
            foreach($data2 as $dt){
                if(array_key_exists('kode_barang',$dt)) { 
                    $pm = new tbl_report_pemakaian; 
                    $pm->no_mesin = $dt['no'];
                    $pm->kd_barang = $dt['kode_barang'];
                    $pm->masuk_mesin = $dt['masuk_mesin'];
                    $pm->sisa_timbangan = $dt['sisa_timbangan'];
		    $pm->terpakai = $dt['qty'];
		    $pm->id_pemakaian_material = $no_pemakaian;
                    $pm->save(); 
                   
                }     
                
            }

            $harga_global = "";
            foreach($data2 as $dt){
                if(array_key_exists('in_charge',$dt)) { 
                    $pm = new PemakaianMaterial; 
                    $pm->id_pemakaian_material = $no_pemakaian;
                    $pm->tgl_pemakaian = $dt['tgl_pemakaian'];
                    $pm->in_charge = $dt['in_charge'];
                    $pm->qty_spk = $dt['total_spk'];
                    $pm->save(); 
                   
                }     
                
            }
            foreach($data2 as $dt){
                if(array_key_exists('kode_barang',$dt)) {
                    DB::select('CALL stock_fifo_pemakaian(?,?,?)', array($dt['kode_barang'],$dt['qty'],$no_pemakaian));
                }
            }

            foreach($data2 as $dt){
                if(array_key_exists('in_charge',$dt)) { 
                    $pm = DB::table('pemakaian_material')
                    ->select('total_pemakaian_material','qty_spk')
                    ->where('id_pemakaian_material','=', $no_pemakaian)
                    ->first();

                    $harga_global = $pm->total_pemakaian_material/$pm->qty_spk;
                   
                }     
                
            }

            
            foreach($data2 as $dt){
                if(array_key_exists('no_spk',$dt)) { 
                    $pm = new DetailSpkPemakaian; 
                    $pm->id_detail_pemakaian = $no_pemakaian;
                    $pm->no_spk = $dt['no_spk'];
                    $pm->harga_satuan = $harga_global;
                    $pm->save(); 
                }     
                
            }
            
            
            return response()->json($data, 200);
        }else{
            return response()->json(['error'=>'Stock Tidak Tersedia !!!']);
        }

        
    }

    public function get_data_qty_spk(Request $request){
        dd($request->all());
    }

    public function show($id){
        $show_detail = DB::table('pemakaian_material')
                        ->where('pemakaian_material.id_pemakaian_material','=',$id)
                        ->leftJoin('detail_pemakaian_material','detail_pemakaian_material.id_pemakaian_material','=','pemakaian_material.id_pemakaian_material')
			            ->leftjoin('barang','barang.kode_barang','=','detail_pemakaian_material.kode_barang')
                        ->get();
        $spk_pemakaian = DB::table('detail_spk_pemakaian')
                        ->where('id_detail_pemakaian','=',$id)
                        ->get();
        $show_header = $show_detail->first();
        return view('production.pemakaian_material.show', compact('show_detail','show_header','spk_pemakaian'));
    }
    
    public function report_pemakaian($id){
	$show_detail = DB::table('pemakaian_material')
                        ->where('pemakaian_material.id_pemakaian_material','=',$id)
                        ->leftJoin('tbl_report_pemakaian','tbl_report_pemakaian.id_pemakaian_material','=','pemakaian_material.id_pemakaian_material')
			->leftjoin('barang','barang.kode_barang','=','tbl_report_pemakaian.kd_barang')
                        ->get();
        $show_header = $show_detail->first();
	return view('production.pemakaian_material.report-pemakaian', compact('show_detail','show_header'));
    }
    
    public function auto_no_pemakaian(){
        $no_urut_spk = "";
        $no = 1;
        $no_urut = DB::select("SELECT DATE_FORMAT(NOW(),'%y') AS curdat,LPAD((RIGHT(MAX(ID_PEMAKAIAN_MATERIAL),6)+1),6,'0') AS NO_URUT_PEMAKAIAN FROM pemakaian_material");
        foreach($no_urut as $so){
            if($so->NO_URUT_PEMAKAIAN != NULL){
                return $no_urut_pemakaian = "PM-".$so->curdat.'-'.$so->NO_URUT_PEMAKAIAN;
            }else{
                return $no_urut_pemakaian = "PM-".date('y').'-'.sprintf("%06s", $no);
            }
        } 
    }  
  
    public function get_barang_from_stock(){
        $get_data = DB::table('stock')
                    ->select('stock.kode_barang','barang.nama_barang')
                    ->leftJoin('barang','barang.kode_barang','=','stock.kode_barang')
                    ->get();
        return response()->json($get_data);
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

    public function get_no_spk(Request $request){
        if ($request->has('q')) {
            $cari = $request->q;
            $spk = DB::table('spk')->select('spk.no_spk', 'sales_order.no_po_customer')->where('no_spk', 'LIKE', '%'.$cari.'%')->orWhere('no_po_customer', 'LIKE', '%'.$cari.'%')
				   ->Join('sales_order','sales_order.id_so','=','spk.no_sales_order')	
				   ->get();

                return response()->json($spk);
        }
        $spk = DB::table('spk')->select('spk.no_spk', 'sales_order.no_po_customer')
		->Join('sales_order','sales_order.id_so','=','spk.no_sales_order')
		->get();

        return response()->json($spk);
    }

    public function get_qty_spk(Request $request){
	dd($request->all());
	$qty_spk = DB::table('spk')->select('spk.no_spk','detail_spk.qty')
		->where('spk.no_spk','=', 'SPK000022')
		->join('detail_spk', 'spk.no_spk','=','detail_spk.no_spk')
		->get();

	dd($qty_spk);
    }


}
