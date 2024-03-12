<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Pengadaan;
use App\Barang;
use App\DetailPengadaan;

class PengadaanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengadaan = DB::table('supplier')
                    ->select('pengadaan.id_pengadaan','pengadaan.kode_supplier','supplier.nama_supplier','pengadaan.tgl_pembelian','pengadaan.status','pengadaan.pajak')
                    ->join('pengadaan','supplier.kode_supplier','=','pengadaan.kode_supplier')
                    ->get();
            // dd($pengadaan);
        return view('pengadaans.index', compact('pengadaan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $no_urut = $this->get_auto_no();
        return view('pengadaans.create', compact('no_urut'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_pengadaan'=>'required',
            'kode_supplier'=>'required',
            'tgl_pembelian'=>'required',
            'status'=>'required'
        ]);

        $pengadaan = new Pengadaan([
            'id_pengadaan' => $request->get('id_pengadaan'),
            'kode_supplier' => $request->get('kode_supplier'),
            'tgl_pembelian' => $request->get('tgl_pembelian'),
            'status' => $request->get('status')
        ]);
        $pengadaan->save();
        return redirect('/pengadaans')->with('success', 'Pengadaan saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pengadaan = DB::table('pengadaan')
                ->where('pengadaan.id_pengadaan', '=', $id)
                ->leftJoin('detail_pengadaan', 'pengadaan.id_pengadaan', '=', 'detail_pengadaan.kode_pembelian')
                ->leftJoin('barang', 'barang.kode_barang', '=', 'detail_pengadaan.kode_barang')
                ->leftJoin('supplier', 'supplier.kode_supplier', '=', 'pengadaan.kode_supplier')
                ->select('pengadaan.id_pengadaan','pengadaan.kode_supplier','pengadaan.pajak','pengadaan.tgl_pembelian','pengadaan.status','detail_pengadaan.kode_barang','barang.nama_barang','barang.ukuran','barang.spesifikasi_barang','detail_pengadaan.qty','detail_pengadaan.harga_satuan','supplier.nama_supplier','supplier.pic_supplier')
                ->get();

        $header = $pengadaan->first();
        $detail = $pengadaan;
        return view('pengadaans.show_detail', compact('header', 'detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pengadaan = DB::table('pengadaan')
                ->where('pengadaan.id_pengadaan', '=', $id)
                ->leftJoin('detail_pengadaan', 'pengadaan.id_pengadaan', '=', 'detail_pengadaan.kode_pembelian')
                ->leftJoin('barang', 'barang.kode_barang', '=', 'detail_pengadaan.kode_barang')
                ->leftJoin('supplier', 'supplier.kode_supplier', '=', 'pengadaan.kode_supplier')
                ->select('pengadaan.id_pengadaan','pengadaan.kode_supplier','supplier.nama_supplier','pengadaan.pajak','pengadaan.tgl_pembelian','pengadaan.status','detail_pengadaan.kode_barang','barang.nama_barang','barang.ukuran','detail_pengadaan.qty','detail_pengadaan.harga_satuan')
                ->get();

        $header = $pengadaan->first();
        $detail = $pengadaan;
        return view('pengadaans.edit', compact('header', 'detail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $data = $request->json()->all();
        // var_dump($data);
         //$jason = json_decode($data);
         $data2 = json_decode(json_encode($data),true);
         foreach($data2 as $dt){
            if(array_key_exists('id_pengadaan',$dt)) {
                $detail = Pengadaan::where('id_pengadaan',($dt['id_pengadaan']));
                $detail->delete();
            }

        }
        // DetailPengadaan::insert($data);
        foreach($data2 as $dt){
            if(array_key_exists('id_pengadaan',$dt)) {
                $png = new Pengadaan; 
                $png->id_pengadaan = $dt['id_pengadaan'];
                $png->kode_supplier = $dt['kode_supplier'];
                $png->tgl_pembelian = $dt['tgl_pembelian'];
                $png->status = $dt['status'];
                $png->pajak = $dt['pajak'];
                $png->total_pajak = $dt['tax_total'];
                $png->total_pembelian = $dt['sub_total'];
                $png->save();
            }

        }

        foreach($data2 as $dt){
            if(array_key_exists('kode_pembelian',$dt)) {
                $detail = DetailPengadaan::where('kode_pembelian',($dt['kode_pembelian']));
                $detail->delete();
            }
        }

        foreach($data2 as $dt){
            if(array_key_exists('kode_pembelian',$dt)) {
                $detail = new DetailPengadaan;
                $detail->kode_pembelian = $dt['kode_pembelian'];
                $detail->kode_barang = $dt['kode_barang'];
                $detail->qty = $dt['qty'];
                $detail->harga_satuan = $dt['harga_satuan'];

                $detail->save();


            }
        }

        return response()->json($data, 200);

        // return redirect('/pengadaans')->with('success', 'Pengadaan Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengadaan = Pengadaan::find($id);
        $pengadaan->delete();

        return redirect('/pengadaans')->with('success', 'Pengadaan deleted!');
    }

    public function get_auto_no(){
        $no_urut_pengadaan = "";
        $no = 1;
	$bulanRomawi = array("", "I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
        $no_urut = DB::select("SELECT DATE_FORMAT(NOW(),'%y') AS curdat,LPAD((LEFT(MAX(ID_PENGADAAN),6)+1),6,'0') AS NO_URUT_PENGADAAN FROM pengadaan");
        foreach($no_urut as $so){
            if($so->NO_URUT_PENGADAAN != NULL){
                return $no_urut_pengadaan = $so->NO_URUT_PENGADAAN.'-PO-BK-'. $bulanRomawi[date('n')] .'-'.date('Y');
            }else{
                return $no_urut_pengadaan = sprintf("%06s", $no). '-PO-BK-' . $bulanRomawi[date('n')] .'-' . date('Y');            }
        } 
    }

    
}
