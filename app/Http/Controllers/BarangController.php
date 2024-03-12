<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Barang;

class BarangController extends Controller
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
	$barang_fg = Barang::all()->where('tipe_barang','=','FG');
        $barang_rw = Barang::all()->where('tipe_barang','=','RW');
        $barang_ig = Barang::all()->where('tipe_barang','=','IG');
        return view('barang.index', compact('barang_ig', 'barang_rw', 'barang_fg'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('barang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	
	$messages = [
	    'unique'    => 'Gagal Menyimpan Data, :attribute '.$request->kode_barang.' sudah digunakan !!!',
            'regex' => 'Kode barang hanya boleh menggunakan huruf, angka, spasi, -, atau _ ',
	];
	$this->validate($request,[
    		'kode_barang' => 'required|unique:barang,kode_barang|regex:/^[0-9A-Za-z.\-_ ]+$/',
    		'nama_barang' => 'required',
		    'ukuran' => 'required',
       		'spesifikasi_barang' => 'required'
	],$messages);

	   Barang::create([
    	    'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'ukuran' => $request->ukuran,
            'tipe_barang' => $request->tipe_barang,
            'satuan' => $request->satuan,
            'harga' => $request->harga,
            'spesifikasi_barang' => $request->spesifikasi_barang,
            
    	    ]);
	   
	   return redirect('/barang');
    	
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barang = Barang::find($id);

        return view('barang.edit', ['barang' => $barang]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
    		'kode_barang' => 'required',
            'nama_barang' => 'required',
	        'ukuran' => 'required',
            'tipe_barang' => 'required',
    		'satuan' => 'required',
            'harga' => 'required',
            'spesifikasi_barang' => 'required'
        ]);

        $barang = Barang::find($id);
        $barang->kode_barang = $request->kode_barang;
        $barang->nama_barang = $request->nama_barang;
	    $barang->ukuran = $request->ukuran;
        $barang->tipe_barang = $request->tipe_barang;
        $barang->satuan = $request->satuan;
        $barang->harga = $request->harga;
        $barang->spesifikasi_barang = $request->spesifikasi_barang;

        $barang->save();

        return redirect('/barang');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Barang::find($id);
        $barang->delete();

        return redirect('/barang');
    }

    public function getKodeBarang(Request $request){
	
 	if ($request->has('q')) {
 	   $cari = $request->q;
	   $kodeBarang = DB::table('barang')->select('kode_barang', 'nama_barang','ukuran', 'spesifikasi_barang')->where('nama_barang', 'LIKE', '%'.$cari.'%')->orWhere('ukuran', 'LIKE', '%'.$cari.'%')->get();

           return response()->json($kodeBarang);
        }
        $barang = DB::table('barang')->select('kode_barang', 'nama_barang','ukuran','spesifikasi_barang')->get();

        return response()->json($barang);

    }

    public function getKodeBarangRW(Request $request){
	
        if ($request->has('q')) {
            $cari = $request->q;
           $kodeBarang = DB::table('barang')->select('kode_barang', 'nama_barang','ukuran')->where('tipe_barang','=', 'RW')->where('nama_barang', 'LIKE', '%'.$cari.'%')->orWhere('ukuran', 'LIKE', '%'.$cari.'%')->get();
    
               return response()->json($kodeBarang);
            }
            $barang = DB::table('barang')->where('tipe_barang','=','RW')->select('kode_barang', 'nama_barang','ukuran','spesifikasi_barang')->get();
    
            return response()->json($barang);
   
    }

    public function getKodeBarangIG(Request $request){
	
        if ($request->has('q')) {
            $cari = $request->q;
           $kodeBarang = DB::table('barang')->select('kode_barang', 'nama_barang','ukuran')->where('tipe_barang','=', 'IG')->where('nama_barang', 'LIKE', '%'.$cari.'%')->orWhere('ukuran', 'LIKE', '%'.$cari.'%')->get();
    
               return response()->json($kodeBarang);
            }
            $barang = DB::table('barang')->where('tipe_barang','=','IG')->select('kode_barang', 'nama_barang','ukuran')->get();
    
            return response()->json($barang);
   
    }
    
}
