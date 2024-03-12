<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\SalesOrder;
use App\DetailSalesOrder;
use App\Stock;

class SalesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function indexSO(){
    $data_draft =  DB::table('sales_order')
                                ->select('sales_order.id_so','sales_order.tgl_pemesanan','sales_order.top','sales_order.total_penjualan','sales_order.status','sales_order.pajak','sales_order.no_po_customer','customer.nama_customer')
                                ->distinct('sales_order.id_so')
		        ->where('sales_order.status','=','DRAFT')
                ->where('sales_order.id_so','LIKE', 'SO-2%')
                //->orwhere('sales_order.id_so','LIKE', 'SO-24%')
                                ->leftJoin('customer','sales_order.id_customer','=','customer.id_customer')
                                ->groupBy('sales_order.id_so')
                                ->get(); 
      
	$data_on_progress = DB::table('sales_order')
                                ->select('sales_order.id_so','sales_order.tgl_pemesanan','sales_order.top','sales_order.total_penjualan','sales_order.status','sales_order.pajak','sales_order.no_po_customer','customer.nama_customer')
                                ->distinct('sales_order.id_so')
				->where('sales_order.status','=','ON PROGRESS')
                ->where('sales_order.id_so','LIKE', 'SO-2%')
                //->orwhere('sales_order.id_so','LIKE', 'SO-24%')
                                ->leftJoin('customer','sales_order.id_customer','=','customer.id_customer')
                                ->groupBy('sales_order.id_so')
                                ->get();
	$data_waiting = DB::table('sales_order')
                                ->select('sales_order.id_so','sales_order.tgl_pemesanan','sales_order.top','sales_order.total_penjualan','sales_order.status','sales_order.pajak','sales_order.no_po_customer','customer.nama_customer')
                                ->distinct('sales_order.id_so')
				->where('sales_order.status','=','WAITING')
                ->where('sales_order.id_so','LIKE', 'SO-2%')
                //->orwhere('sales_order.id_so','LIKE', 'SO-24%')
                                ->leftJoin('customer','sales_order.id_customer','=','customer.id_customer')
                                ->groupBy('sales_order.id_so')
                                ->get();
	 
 	$data_proceeded = DB::table('sales_order')
                                ->select('sales_order.id_so','sales_order.tgl_pemesanan','sales_order.top','sales_order.total_penjualan','sales_order.status','sales_order.pajak','sales_order.no_po_customer','customer.nama_customer')
                                ->distinct('sales_order.id_so')
				->where('sales_order.status','=','PROCEEDED')
                ->where('sales_order.id_so','LIKE', 'SO-2%')
                //->orwhere('sales_order.id_so','LIKE', 'SO-24%')
                                ->leftJoin('customer','sales_order.id_customer','=','customer.id_customer')
                                ->groupBy('sales_order.id_so')
                                ->get();

	
	return view('sales.index', compact('data_draft','data_on_progress','data_waiting','data_proceeded'));
    }

    public function detailSO($id){
        $detail_so = DB::table('sales_order')
                    ->where('sales_order.id_so', '=', $id)
                    ->select('sales_order.id_so','sales_order.top','sales_order.total_penjualan','sales_order.status','sales_order.no_po_customer','customer.id_customer','customer.nama_customer','customer.alamat_customer','customer.kota','customer.no_telp','detail_sales_order.id_sales_order','detail_sales_order.kode_barang','detail_sales_order.qty','detail_sales_order.harga_satuan','barang.kode_barang','barang.nama_barang','barang.ukuran','barang.tipe_barang','barang.satuan','barang.spesifikasi_barang','sales_order.tgl_pemesanan')
                    ->leftJoin('customer','sales_order.id_customer','=','customer.id_customer')
                    ->leftJoin('detail_sales_order','sales_order.id_so','=','detail_sales_order.id_sales_order')
                    ->leftJoin('barang','detail_sales_order.kode_barang','=','barang.kode_barang')
                    ->get();
        $header_so = $detail_so->first();

        return view('sales.detail_sales_order', compact('header_so','detail_so'));        
    }

    public function create_sales_order()
    {
        //$no_urut = $this->get_auto_id_sales_order();
        $data_stock = $this->cekQtyStock();
        return view('sales.create_sales_order', compact('no_urut','$data_stock'));
    }

    public function store_sales_order(Request $request){
        $data = $request->json()->all();
       //dd($data);
       //  die();
         //$jason = json_decode($data);
	$id_so = $this->get_auto_id_sales_order();
        $data_SO = json_decode(json_encode($data),true);
		
        foreach($data_SO as $so){
            if(array_key_exists('no_po_customer',$so)) { 
		if($this->cek_po($so['no_po_customer'])){
		    return response()->json(['error'=>'NO.PO : '.$so['no_po_customer'].' Sudah di gunakan !!!']);
		}
                $sales_order = new SalesOrder; 
                $sales_order->id_so = $id_so;
                $sales_order->id_customer = $so['id_customer'];
                $sales_order->top = $so['top'];
                $sales_order->tgl_pemesanan = $so['tgl_pemesanan'];
                $sales_order->total_penjualan = $so['total_penjualan'];
                $sales_order->status = $so['status'];
                $sales_order->pajak = $so['pajak'];
                $sales_order->no_po_customer = $so['no_po_customer'];
                $sales_order->total_sales_order = $so['total_penjualan'];
                $sales_order->total_pajak = $so['tot_pajak'];
                $sales_order->save();
            }     
            
        }

        
        foreach($data_SO as $so){
            if(array_key_exists('kode_barang',$so)) {
                $detail_so = new DetailSalesOrder;
                $detail_so->id_sales_order = $id_so;
                $detail_so->kode_barang = $so['kode_barang'];
                $detail_so->harga_satuan = $so['harga_satuan'];
                $detail_so->qty = $so['qty'];
                $detail_so->save();        
            }
        }
                 
        return response()->json(['status'=>$id_so.' Berhasil di simpan !!!']);
    }
    
    public function editSO($id){
     
        $detail_so = DB::table('sales_order')
                    ->where('sales_order.id_so', '=', $id)
                    ->select('sales_order.id_so','sales_order.top','sales_order.total_penjualan','sales_order.status','sales_order.pajak','sales_order.no_po_customer','customer.id_customer','customer.nama_customer','customer.alamat_customer','customer.kota','customer.no_telp','detail_sales_order.id_sales_order','detail_sales_order.kode_barang','detail_sales_order.qty','detail_sales_order.harga_satuan','barang.kode_barang','barang.nama_barang','barang.tipe_barang','barang.satuan','barang.spesifikasi_barang','barang.ukuran','sales_order.tgl_pemesanan')
                    ->leftJoin('customer','sales_order.id_customer','=','customer.id_customer')
                    ->leftJoin('detail_sales_order','sales_order.id_so','=','detail_sales_order.id_sales_order')
                    ->leftJoin('barang','detail_sales_order.kode_barang','=','barang.kode_barang')
                    ->get();
        $header_so = $detail_so->first();
        
        return view('sales.edit_sales_order', compact('header_so','detail_so'));
    }

    public function updateSO(Request $request){
       
        
        $data = $request->json()->all();
        
        // var_dump($data);
         //$jason = json_decode($data);
         $sales_order = json_decode(json_encode($data),true);
        
        foreach($sales_order as $dt){
            if(array_key_exists('id_so',$dt)) { 
                $so = SalesOrder::find($dt['id_so']); 
                $so->id_customer = $dt['id_customer'];
                $so->top = $dt['top'];
                $so->tgl_pemesanan = $dt['tgl_pemesanan'];
                $so->total_penjualan = $dt['total_penjualan'];
                $so->status = $dt['status'];
                $so->pajak = $dt['pajak'];
                $so->no_po_customer = $dt['no_po_customer'];
                $so->save(); 
            }     
            
        }

        // foreach($sales_order as $dt){
        //     if(array_key_exists('id_sales_order',$dt)) {  
        //         $dt_so = DetailSalesOrder::where('id_sales_order',($dt['id_sales_order']));
        //         $dt_so->delete();               
        //     }
        // }



        // foreach($sales_order as $dt){
        //     if(array_key_exists('id_sales_order',$dt)) {  
        //         $dt_so = new DetailSalesOrder;
        //         $dt_so->id_sales_order = $dt['id_sales_order'];
        //         $dt_so->kode_barang = $dt['kode_barang'];
        //         $dt_so->qty = $dt['qty'];
        //         $dt_so->harga_satuan = $dt['harga_satuan'];

        //         $dt_so->save();
        //     }
        // }

           foreach($sales_order as $dt){
            if(array_key_exists('id_sales_order',$dt)) {  
                DetailSalesOrder::where('id_sales_order',$dt['id_sales_order'])
                                    ->where('kode_barang',$dt['kode_barang'])
                                    ->update(['qty' => $dt['qty'],'harga_satuan'=> $dt['harga_satuan']]);
               
            }
        }

        return response()->json($data, 200);
    }

     public function get_auto_id_sales_order(){
        $no_urut_so = "";
        $no = 1;
        $no_urut = DB::select("SELECT DATE_FORMAT(NOW(),'%y') AS curdat,LPAD((RIGHT(MAX(ID_SO),4)+1),4,'0') AS NO_URUT_SO FROM sales_order WHERE MID(id_so,4,2) = DATE_FORMAT(NOW(),'%y')");
        foreach($no_urut as $so){
            if($so->NO_URUT_SO != NULL){
                return $no_urut_so = "SO-".$so->curdat.$so->NO_URUT_SO;
            }else{
                return $no_urut_so = "SO-".date('y').sprintf("%04s", $no);
            }
        } 
     }

    public function cekQtyStock(){
        $data_stock = DB::table('stock')
                        ->select('kode_barang', DB::raw('SUM(qty) AS stock_barang'))
                        ->where('kode_barang','=','kode_barang')
                        ->groupBy('kode_barang')
                        ->get();
        
        return $data_stock;
    }
    
    public function cek_po($no_po){
        $po = DB::table('sales_order')->where('no_po_customer','=', $no_po)->count();
        if($po > 0){
            return true;
        }
        return false;        
    }
}
