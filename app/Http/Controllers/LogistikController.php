<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\GoodReceive;
use App\Pengadaan;
use App\DetailGoodsReceive;
use App\Stock;

class LogistikController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function getAllDataGR(){
        $data_gr = DB::table('gr')
                    ->select('id_gr','tgl_gr','id_pengadaan','status')
                    ->get();
        
        return view('logistik.gr.index', compact('data_gr'));
    }

    public function createGR(Request $req){
        $get_kd_gr = $this->get_auto_no_gr();
        $detail_gr = DB::table('detail_pengadaan')
                    ->where('detail_pengadaan.kode_pembelian','=',$req->id_pengadaan)
                    ->select('detail_pengadaan.kode_detail_pembelian','detail_pengadaan.kode_pembelian','detail_pengadaan.kode_barang','detail_pengadaan.harga_satuan','barang.nama_barang','barang.ukuran',DB::raw('detail_pengadaan.qty - COALESCE(SUM(detail_gr.qty),0) AS sisa'))
                    ->leftJoin('barang','detail_pengadaan.kode_barang','=','barang.kode_barang')
                    ->leftJoin('detail_gr','detail_pengadaan.kode_detail_pembelian','=','detail_gr.id_detail_pembelian')
                    ->groupBy('detail_pengadaan.kode_detail_pembelian')
                    ->get();
        $header_gr = $detail_gr->first();
        return view('logistik.gr.create_gr', compact('get_kd_gr','header_gr','detail_gr'));
    }

    public function detail_gr($id){
        $data_gr = DB::table('gr')
                    ->select('gr.id_gr','gr.tgl_gr','gr.penerima','gr.status','gr.id_pengadaan','detail_gr.kode_barang','detail_gr.qty','detail_gr.harga_satuan')
                    ->where('gr.id_gr','=',$id)
                    ->leftJoin('detail_gr','detail_gr.id_gr','=','gr.id_gr')
                    ->get();
        //dd($data_gr);
        return view('logistik.gr.detail_gr','data_gr');
    }

    public function store_detail_gr(Request $request){
        
        $data= $request->json()->all();
       
        $data_gr = json_decode(json_encode($data),true);
      
        $penerimaan_barang = "";
        $tgl_masuk = "";
        foreach($data_gr as $dt){
            if(array_key_exists('id_pengadaan',$dt)) { 
                $gr = new GoodReceive; 
                $gr->id_gr = $dt['id_gr'];
                $gr->penerima = $dt['penerima'];
                $gr->tgl_gr = $dt['tgl_gr'];
                $gr->status = $dt['status'];
                $gr->id_pengadaan = $dt['id_pengadaan'];
                $gr->save(); 
                $tgl_masuk = $dt['tgl_gr'];
                $penerimaan_barang = $dt['id_gr'];
            }     
            
        }
        foreach($data_gr as $dt){
            if(array_key_exists('kode_pembelian',$dt)) {
                $detail = new DetailGoodsReceive;
                $detail->id_gr = $dt['kode_gr'];
                $detail->kode_barang = $dt['kode_barang'];
                $detail->qty = $dt['qty'];
                $detail->harga_satuan = $dt['harga_satuan'];
                $detail->id_detail_pembelian = $dt['id_detail_pembelian'];
                $detail->save();

                $stok = new Stock;
                $stok->kode_barang = $dt['kode_barang'];
                $stok->qty = $dt['qtykg'];
                $stok->harga_satuan = $dt['harga_satuan'];
                $stok->tgl_masuk = $tgl_masuk;
                $stok->references = $penerimaan_barang;

                $stok->save();

		DB::select('CALL jurnal_debit(?,?,?,?)', ['130002',$dt['qty'] * $dt['harga_satuan'],'pembelian bahan baku','UMUM']);
        	DB::select('CALL jurnal_kredit(?,?,?,?)', ['210001',$dt['qty'] * $dt['harga_satuan'],'pembelian bahan baku','UMUM']);
        

            }
        }

        return response()->json($data, 200);
    }

    public function stok(){
        $data_stock_FG = DB::table('stock')
                    ->where('tipe_barang','=', 'FG')
                    ->select('stock.kode_barang','stock.qty','stock.harga_satuan','stock.tgl_masuk','stock.references','barang.nama_barang','barang.ukuran','barang.nama_barang', 'barang.spesifikasi_barang' )
                    ->join('barang','stock.kode_barang','=','barang.kode_barang')
                    ->get(); 
        $data_stock_RW = DB::table('stock')
                    ->where('tipe_barang','=', 'RW')
                    ->select('stock.kode_barang','stock.qty','stock.harga_satuan','stock.tgl_masuk','stock.references','barang.nama_barang','barang.ukuran','barang.nama_barang', 'barang.spesifikasi_barang' )
                    ->join('barang','stock.kode_barang','=','barang.kode_barang')
                    ->get(); 
        $data_stock_IG = DB::table('stock')
                    ->where('tipe_barang','=', 'IG')
                    ->select('stock.kode_barang','stock.qty','stock.harga_satuan','stock.tgl_masuk','stock.references','barang.nama_barang','barang.ukuran','barang.nama_barang', 'barang.spesifikasi_barang' )
                    ->join('barang','stock.kode_barang','=','barang.kode_barang')
                    ->get(); 
        return view('logistik.stock.index', compact('data_stock_FG','data_stock_RW','data_stock_IG'));       
    }
	
    public function adjustment_stock_lebih()
    {
        return view('logistik.stock.adjustmentlbh');
       
    }

    public function store_adjusment(Request $request)
    {

        $stok = new Stock;
                $stok->kode_barang = $request->post('nama_barang');
                $stok->qty = $request->post('jumlah_stock');
                $stok->harga_satuan = 0;
                $stok->tgl_masuk =  date('Y-m-d');
                $stok->references = 'hasil stock opname';
       
                $stok->save();
                
        return redirect('/logistik/stok')->with('success', 'customer saved!');
    }



    public function storeData_Jurnal(Request $request)
    {
    
        DB::select('CALL jurnal_debit(?,?,?,?)', [$request->post('akun_debit'),$request->post('nominal_jurnal'),$request->post('deskripsi_jurnal'),'UMUM']);
        DB::select('CALL jurnal_kredit(?,?,?,?)', [$request->post('akun_kredit'),$request->post('nominal_jurnal'),$request->post('deskripsi_jurnal'),'UMUM']);
        return redirect('finance')->with('success', 'customer saved!');
    }

    public function get_auto_no_gr(){
        $no_urut_gr = "";
        $no = 1;
	$bulanRomawi = array("", "I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
        $no_urut = DB::select("SELECT DATE_FORMAT(NOW(),'%y') AS curdat,LPAD((LEFT(MAX(ID_GR),6)+1),6,'0') AS NO_URUT_GR FROM gr");
        foreach($no_urut as $so){
            if($so->NO_URUT_GR != NULL){
                return $no_urut_gr = $so->NO_URUT_GR.'-GR-BK-'. $bulanRomawi[date('n')] .'-'.date('Y');
            }else{
                return $no_urut_gr = sprintf("%06s", $no). '-GR-BK-' . $bulanRomawi[date('n')] .'-' . date('Y');            }
        } 
    }

    public function get_id_pengadaan(){
        $get_id = DB::table('pengadaan')->select('id_pengadaan')->get();
        return response()->json($get_id);
    }

}
