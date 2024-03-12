<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\KodePerkiraan;
use App\finance;
use App\faktur;
use App\Jurnal_pengeluaran_kas;

//class lama
// class FinanceController extends Controller
// {
   
//      public function index()
//     {
//         $KodePerkiraan = KodePerkiraan::all();

//         return view('finance.coa.index', ['KodePerkiraan' => $KodePerkiraan]);

//     }

//     public function create()
//     {
//         return view('finance.coa.create');
//     }

//     public function input_jurnal_harian()
//     {
//        // return view('finance.jurnal.create');
//        return view('finance.jurnal.create');
       
//     }

//     public function input_pelunasan_piutang_supplier()
//     {
//         return view('finance.pelunasanpiutang.create');
//     }

//     public function store(Request $request)
//     {
       
//          $kodeperkiraan = new KodePerkiraan([
//              'NO_COA' => $request->post('no_header_coa') . $request->post('no_coa'),
//              'DESKRIPSI_COA' => $request->post('deskripsi_coa'),
//              'HEADER' => $request->post('header'),
//              'SUB' => $request->post('sub'),
//              'JENIS' => $request->post('jenis')
//          ]);
     
//          $kodeperkiraan->save();
//         return redirect('finance')->with('success', 'customer saved!');
//     }

//     public function storefinance(Request $request){
// 		$request->validate([
// 			'id_pengadaan'=>'required',
// 			'tgl_pelunasan'=>'required',
// 			'deskripsi'=>'required',
// 			'nominal'=>'reqiured',

// 	]);
// 		DB::table('pelunasan_hutang_supplier')->insert([
// 			'id_pengadaan' => $request->akun_kredit,
// 			'tgl_pelunasan' => $request->taggal_jurnal,
// 			'deskripsi' => $request->deskripsi_jurnal,
// 			'nominal' => $request->nominal_jurnal
// 	]);
// 		return redirect('home')->with('success', 'customer saved!');

// 	}	


//     public function storeData_Jurnal(Request $request)
//     {
		
// 	$data_pengadaan = DB::table('pengadaan')->select('total_pembelian','pajak','total_pajak')->where('id_pengadaan','=',$request->akun_kredit)->first();
// 	//dd($data_pengadaan->total_pembelian-10000);
// 	//dd($data_pengadaan->pajak);
	
// 	DB::table('pelunasan_hutang_supplier')->insert([
// 		'id_pengadaan' => $request->akun_kredit,
// 		'tgl_pelunasan' => $request->tanggal_jurnal,
// 		'deskripsi' => $request->deskripsi_jurnal,
// 		'nominal' => $request->nominal_jurnal
// 	]);

//         if($data_pengadaan->pajak=='V1'){
// 	   DB::select('CALL jurnal_debit(?,?,?,?)', [$request->post('akun_debit'),$request->post('nominal_jurnal'),$request->post('tanggal_jurnal'),$request->post('deskripsi_jurnal'),'UMUM']);
//            DB::select('CALL jurnal_kredit(?,?,?,?)', [130002,$request->post('nominal_jurnal'),$request->post('tanggal_jurnal'),$request->post('deskripsi_jurnal'),'UMUM']);
// 	   DB::select('CALL jurnal_kredit(?,?,?,?)', [220001,$data_pengadaan->total_pajak,$request->post('tanggal_jurnal'),$request->post('deskripsi_jurnal'),'UMUM']);
// 	}
// 	else{
// 	    DB::select('CALL jurnal_debit(?,?,?,?)', [$request->post('akun_debit'),$request->post('nominal_jurnal'),$request->post('tanggal_jurnal'),$request->post('deskripsi_jurnal'),'UMUM']);
//             DB::select('CALL jurnal_kredit(?,?,?,?)', [130002,$request->post('nominal_jurnal'),$request->post('tanggal_jurnal'),$request->post('deskripsi_jurnal'),'UMUM']);
// 	}   
// 	DB::table('pengadaan')->where('id_pengadaan',$request->akun_kredit)->update(['total_pelunasan_piutang'=>$data_pengadaan->total_pembelian - $request->nominal_jurnal]);  
// 	return redirect('home')->with('success', 'customer saved!');
//     }

//     public function storeData_jurnalpiutang(Request $request)
//     {
// 	$data_pelunasan = DB::table('sales_order')->select('total_penjualan','pajak','total_pajak')->where('id_so','=',$request->akun_kredit)->first();
// 	DB::table('pelunasan_piutang')->insert([
// 		'id_sales_order' => $request->akun_kredit,
// 		'tgl_pelunasan' => $request->tanggal_jurnal,
// 		'nominal' => $request->nominal_jurnal
// 	]);
	
// 	if($data_pelunasan->pajak=='V1'){
// 	   DB::select('CALL jurnal_debit(?,?,?,?)', [$request->post('akun_debit'),$request->post('nominal_jurnal'),$request->post('tanggal_jurnal'),'UMUM']);
//            DB::select('CALL jurnal_kredit(?,?,?,?)', [130002,$request->post('nominal_jurnal'),$request->post('tanggal_jurnal'),'UMUM']);
// 	   DB::select('CALL jurnal_kredit(?,?,?,?)', [410001,$data_pelunasan->total_pajak,$request->post('tanggal_jurnal'),'UMUM']);
// 	}
// 	else{
// 	   DB::select('CALL jurnal_debit(?,?,?,?)', [$request->post('akun_debit'),$request->post('nominal_jurnal'),$request->post('tanggal_jurnal') ,'UMUM']);
//            DB::select('CALL jurnal_kredit(?,?,?,?)', [410001,$request->post('nominal_jurnal'),$request->post('tanggal_jurnal'),'UMUM']);
// 	}
	
// 	DB::table('sales_order')->where('id_so',$request->akun_kredit)->update(['total_pelunasan'=>$data_pelunasan->total_penjualan - $request->nominal_jurnal]);
//        	return redirect('home')->with('success', 'customer saved!');
//     }



//     public function edit($id)
//     {
//         $customer = Customer::find($id);
//         return view('customer.edit', compact('customer'));
//     }

//     public function update(Request $request, $id)
//     {
//         $request->validate([
//             'id_customer'=>'required',
//             'nama_customer'=>'required',
//             'alamat_customer'=>'required',
//             'kota'=>'required',
//             'provinsi'=>'required',
//             'no_telp'=>'required',
//             'pic'=>'required',
//             'tipe_customer' => 'required'
//         ]);

//         $customer = Customer::find($id);
//         $customer->id_customer = $request->get('id_customer');
//         $customer->nama_customer = $request->get('nama_customer');
//         $customer->alamat_customer = $request->get('alamat_customer');
//         $customer->kota = $request->get('kota');
//         $customer->provinsi = $request->get('provinsi');
//         $customer->no_telp = $request->get('no_telp');
//         $customer->pic = $request->get('pic');
//         $customer->tipe_customer = $request->get('tipe_customer');
        
//         $customer->save();

//         return redirect('/customer')->with('success', 'customer Updated!');
//     }

//     public function load_data_coa(Request $request)
//     {
//         if ($request->has('q')) {
//             $cari = $request->q;
//             $data = DB::table('coa')->select('NO_COA', 'DESKRIPSI_COA')->where('DESKRIPSI_COA', 'LIKE', '%$cari%')->get();
//             return response()->json($data);
//         }
//     }

//     //public function getCoanumber(Request $request){     
    
//       //      $cari = $request->post('searchTerm');
                      
//         //    $data = DB::table('coa')->select('NO_COA', 'DESKRIPSI_COA')->where('DESKRIPSI_COA', 'LIKE', '%'.$cari.'%')->get();
           
//           //  return response()->json($data);
        
//        // }

// 	public function getCoanumber(){     
    
                      
//             $data = DB::table('coa')->select('NO_COA', 'DESKRIPSI_COA')->get();
           
//             return response()->json($data);
        
//         }




//     public function destroy($id)
//     {
//         $customer = Customer::find($id);
//         $customer->delete();

//         return redirect('/customer')->with('success', 'customer deleted!');
//     }

//     public function getIdCustomer(){
//         $customer = DB::table('customer')->select('id_customer', 'nama_customer')->get();

//         return response()->json($customer);
//     }

//     public function faktur(Request $req){
// 	if($req->has('cari')){
// 		$faktur_penjualan = \App\faktur::where('no_faktur','LIKE','%'.$req->cari.'%')->paginate(10);
//         }
// 	else{
// 		$faktur_penjualan = \App\faktur::all();
// 	}
// 	return view('finance.faktur.index',compact('faktur_penjualan'));
//     }

//     public function create_faktur(Request $req){
//     $no_surat_jalan = $req->no_surat_jalan;

//     if($this->cek_no_faktur($no_surat_jalan)){
// 	    return redirect('/finance/faktur')->with(['message' => 'No Faktur '.$no_surat_jalan.' sudah di buat !!!']);
// 	}
    
// 	$detail_faktur = DB::select("SELECT DISTINCT surat_jalan.no_surat_jalan
//         , surat_jalan.tgl_surat_jalan
//         , surat_jalan.no_surat_jalan
//         , surat_jalan.plat_nomor
//         , detail_surat_jalan.kode_barang
//         , barang.nama_barang
//         , barang.ukuran
//         , detail_surat_jalan.qty
//         , detail_sales_order.harga_satuan
//         , barang.spesifikasi_barang
//         , sales_order.no_po_customer
//         , sales_order.pajak
//         , customer.nama_customer
//         , customer.alamat_customer
//         , customer.kota
//         FROM
//             surat_jalan
//         INNER JOIN detail_surat_jalan
//         ON surat_jalan.no_surat_jalan = detail_surat_jalan.no_surat_jalan
//         INNER JOIN barang
//         ON barang.kode_barang = detail_surat_jalan.kode_barang
//         INNER JOIN sales_order 
//         ON sales_order.id_so = detail_surat_jalan.no_sales_order
//         INNER JOIN detail_sales_order
//         ON detail_surat_jalan.no_sales_order = detail_sales_order.id_sales_order
//         INNER JOIN customer
//         ON customer.id_customer = sales_order.id_customer
//         WHERE surat_jalan.no_surat_jalan = '$req->no_surat_jalan' AND detail_surat_jalan.kode_barang = detail_sales_order.kode_barang");
//         $header_faktur = array_values($detail_faktur)[0];
// 	return view('finance.faktur.create', compact('detail_faktur','header_faktur','no_surat_jalan'));
//     }

//     public function store_data_faktur(Request $req){
// 	//dd($req->all());
// 	$terbilang = $req->keterangan;
// 	DB::table('faktur_penjualan')->insertGetId(['no_faktur' => $req->no_faktur, 'tgl_faktur' => $req->tgl_faktur, 'keterangan' => $req->keterangan]);
	
// 	if($req->pajak == "V0" || $req->pajak == "V1"){
// 	     DB::select('CALL jurnal_debit(?,?,?,?)', ['120002',$req->total_penjualan,'Piutang Usaha','UMUM']);
//              DB::select('CALL jurnal_kredit(?,?,?,?)', ['410001',$req->total_penjualan,'Total Penjualan','UMUM']);
	     

// 	}
// 	DB::select('CALL jurnal_debit(?,?,?,?)', ['120002',$req->total_penjualan,'Piutang Usaha','UMUM']);
//         DB::select('CALL jurnal_kredit(?,?,?,?)', ['410001',$req->total_penjualan,'Total Penjualan','UMUM']);
// 	DB::select('CALL jurnal_kredit(?,?,?,?)', ['220001',$req->total_pajak,'Total Pajak','UMUM']);
	
// 	$tgl_faktur = $req->tgl_faktur;
// 	$detail_faktur = DB::select("SELECT surat_jalan.no_surat_jalan
//         , surat_jalan.tgl_surat_jalan
//         , surat_jalan.no_surat_jalan
//         , surat_jalan.plat_nomor
//         , detail_surat_jalan.kode_barang
// 	, barang.nama_barang
// 	, barang.ukuran
//         , detail_surat_jalan.qty
//         , detail_sales_order.harga_satuan
//         , barang.spesifikasi_barang
//         , sales_order.no_po_customer
//         , sales_order.pajak
//         , customer.nama_customer
//         , customer.alamat_customer
//         , customer.kota
//         FROM
//             surat_jalan
//         INNER JOIN detail_surat_jalan
//         ON surat_jalan.no_surat_jalan = detail_surat_jalan.no_surat_jalan
//         INNER JOIN barang
//         ON barang.kode_barang = detail_surat_jalan.kode_barang
//         INNER JOIN sales_order 
//         ON sales_order.id_so = detail_surat_jalan.no_sales_order
//         INNER JOIN detail_sales_order
//         ON detail_surat_jalan.no_sales_order = detail_sales_order.id_sales_order
//         INNER JOIN customer
//         ON customer.id_customer = sales_order.id_customer
//         WHERE surat_jalan.no_surat_jalan = '$req->no_faktur' AND detail_surat_jalan.kode_barang = detail_sales_order.kode_barang");
//         $header_faktur = array_values($detail_faktur)[0];

//         return view('finance.faktur.print_faktur', compact('detail_faktur','header_faktur','tgl_faktur','terbilang'));
	
//     }

//     public function get_no_sj(Request $request){
//         if ($request->has('q')) {
//             $cari = $request->q;
//             $no_sj = DB::table('surat_jalan')->select('no_surat_jalan')->where('no_surat_jalan', 'LIKE', '%'.$cari.'%')->get();

//                 return response()->json($no_sj);
//         }
//         $no_sj = DB::table('surat_jalan')->select('no_surat_jalan')->get();

//         return response()->json($no_sj);
//     }

//     public function print_faktur($no_faktur){
// 	//$tgl_faktur = $req->tgl_faktur;	

	
// 	$detail_faktur = DB::select("SELECT DISTINCT surat_jalan.no_surat_jalan
//         , surat_jalan.tgl_surat_jalan
//         , surat_jalan.no_surat_jalan
//         , surat_jalan.plat_nomor
//         , detail_surat_jalan.kode_barang
//         , barang.nama_barang
//         , barang.ukuran
//         , detail_surat_jalan.qty
//         , detail_sales_order.harga_satuan
//         , barang.spesifikasi_barang
//         , sales_order.no_po_customer
//         , sales_order.pajak
//         , customer.nama_customer
//         , customer.alamat_customer
//         , customer.kota
//         , faktur_penjualan.tgl_faktur
//         , faktur_penjualan.keterangan
//         FROM
//             surat_jalan
//         INNER JOIN detail_surat_jalan
//         ON surat_jalan.no_surat_jalan = detail_surat_jalan.no_surat_jalan
//         INNER JOIN faktur_penjualan
//         ON faktur_penjualan.no_faktur = detail_surat_jalan.no_surat_jalan
//         INNER JOIN barang
//         ON barang.kode_barang = detail_surat_jalan.kode_barang
//         INNER JOIN sales_order 
//         ON sales_order.id_so = detail_surat_jalan.no_sales_order
//         INNER JOIN detail_sales_order
//         ON detail_surat_jalan.no_sales_order = detail_sales_order.id_sales_order
//         INNER JOIN customer
//         ON customer.id_customer = sales_order.id_customer
//         WHERE surat_jalan.no_surat_jalan = '$no_faktur' AND detail_surat_jalan.kode_barang = detail_sales_order.kode_barang");
//         $header_faktur = array_values($detail_faktur)[0];
// 	$tgl_faktur = $header_faktur->tgl_faktur;
// 	$terbilang = $header_faktur->keterangan;
//         return view('finance.faktur.print_faktur', compact('detail_faktur','header_faktur','tgl_faktur','terbilang'));
//     }

//     public function Terbilang($nilai) {
//         $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
//         if($nilai==0){
//             return "Kosong";
//         }elseif ($nilai < 12&$nilai!=0) {
//             return "" . $huruf[$nilai];
//         } elseif ($nilai < 20) {
//             return $this->Terbilang($nilai - 10) . " Belas ";
//         } elseif ($nilai < 100) {
//             return $this->Terbilang($nilai / 10) . " Puluh " . $this->Terbilang($nilai % 10);
//         } elseif ($nilai < 200) {
//             return " Seratus " . $this->Terbilang($nilai - 100);
//         } elseif ($nilai < 1000) {
//             return $this->Terbilang($nilai / 100) . " Ratus " . $this->Terbilang($nilai % 100);
//         } elseif ($nilai < 2000) {
//             return " Seribu " . Terbilang($nilai - 1000);
//         } elseif ($nilai < 1000000) {
//             return $this->Terbilang($nilai / 1000) . " Ribu " . $this->Terbilang($nilai % 1000);
//         } elseif ($nilai < 1000000000) {
//             return $this->Terbilang($nilai / 1000000) . " Juta " . $this->Terbilang($nilai % 1000000);
//         }elseif ($nilai < 1000000000000) {
//             return $this->Terbilang($nilai / 1000000000) . " Milyar " . $this->Terbilang($nilai % 1000000000);
//         }elseif ($nilai < 100000000000000) {
//             return $this->Terbilang($nilai / 1000000000000) . " Trilyun " . $this->Terbilang($nilai % 1000000000000);
//         }elseif ($nilai <= 100000000000000) {
//             return "Maaf Tidak Dapat di Prose Karena Jumlah nilai Terlalu Besar ";
//         }
//     }
	
//     public function getpo(){

//         $getnopo = DB::table('pengadaan')->select('id_pengadaan')->get();

//         return response()->json($getnopo);
//     }

//     public function getso(){

//         $getnoso = DB::table('sales_order')->select('id_so')->get();

//         return response()->json($getnoso);
//     }


//     public function pelunasan_piutang(){
// 	    return view ('finance.pelunasan_piutang');
//     }

//     public function cek_no_faktur($no_faktur){
//         $count_faktur = DB::table('faktur_penjualan')->where('no_faktur', $no_faktur)->count();
//         if($count_faktur > 0){
//             return true;
//         }
//         return false;
//     }

//class baru

class FinanceController extends Controller
{
   
     public function index()
    {
        $KodePerkiraan = KodePerkiraan::all();

        return view('finance.coa.index', ['KodePerkiraan' => $KodePerkiraan]);

    }

    public function create()
    {
        return view('finance.coa.create');
    }

    public function input_jurnal_harian()
    {
       // return view('finance.jurnal.create');
       return view('finance.jurnal.create');
       
    }

    public function input_pelunasan_piutang_supplier()
    {
        return view('finance.pelunasanpiutang.create');
    }

    public function store(Request $request)
    {
        try {

         $kodeperkiraan = new KodePerkiraan([
             'NO_COA' => $request->post('no_header_coa') . $request->post('no_coa'),
             'DESKRIPSI_COA' => $request->post('deskripsi_coa'),
             'HEADER' => $request->post('header'),
             'SUB' => $request->post('sub'),
             'JENIS' => $request->post('jenis')
         ]);
     
         $kodeperkiraan->save();
        return redirect('finance.index')->with('success', 'customer saved!');}
        catch (Throwable $e) {
            report($e);
            return false;
        }
    }



    public function storefinance(Request $request){
		$request->validate([
			'id_pengadaan'=>'required',
			'tgl_pelunasan'=>'required',
			'deskripsi'=>'required',
			'nominal'=>'reqiured',

	]);
		DB::table('pelunasan_hutang_supplier')->insert([
			'id_pengadaan' => $request->akun_kredit,
			'tgl_pelunasan' => $request->taggal_jurnal,
			'deskripsi' => $request->deskripsi_jurnal,
			'nominal' => $request->nominal_jurnal
	]);
		return redirect('home')->with('success', 'customer saved!');

	}	


    public function storeData_Jurnal(Request $request)
    {
//        dd($request);
//        die();
	    $data_pengadaan = DB::table('pengadaan')->select('total_pembelian','pajak','total_pajak')->where('id_pengadaan','=',$request->no_po)->first();
	    //dd($data_pengadaan->total_pembelian-10000);
	    //dd($data_pengadaan->pajak);
	
        DB::table('pelunasan_hutang_supplier')->insert([
		'id_pengadaan' => $request->akun_kredit,
		'tgl_pelunasan' => $request->tanggal_jurnal,
		'deskripsi' => $request->deskripsi_jurnal,
		'nominal' => $request->nominal_jurnal
	    ]);

        if($data_pengadaan->pajak=='V1'){
	         DB::select('CALL jurnal_debit(?,?,?,?)', [$request->post('akun_debit'),$request->post('nominal_jurnal'),$request->post('tanggal_jurnal'),$request->post('deskripsi_jurnal'),'UMUM']);
            DB::select('CALL jurnal_kredit(?,?,?,?)', [130002,$request->post('nominal_jurnal'),$request->post('tanggal_jurnal'),$request->post('deskripsi_jurnal'),'UMUM']);
	        // DB::select('CALL jurnal_kredit(?,?,?,?)', [220001,$data_pengadaan->total_pajak,$request->post('tanggal_jurnal'),$request->post('deskripsi_jurnal'),'UMUM']);
	}
	else{
	    DB::select('CALL jurnal_debit(?,?,?,?)', [$request->post('akun_debit'),$request->post('nominal_jurnal'),$request->post('tanggal_jurnal'),$request->post('deskripsi_jurnal'),'UMUM']);
            DB::select('CALL jurnal_kredit(?,?,?,?)', [130002,$request->post('nominal_jurnal'),$request->post('tanggal_jurnal'),$request->post('deskripsi_jurnal'),'UMUM']);
	}   
	DB::table('pengadaan')->where('id_pengadaan',$request->akun_kredit)->update(['total_pelunasan_piutang'=>$data_pengadaan->total_pembelian - $request->nominal_jurnal]);  
	return redirect('home')->with('success', 'customer saved!');
    }






    public function storeData_jurnalpiutang(Request $request)
    {
	$data_pelunasan = DB::table('sales_order')->select('total_penjualan','pajak','total_pajak')->where('id_so','=',$request->akun_kredit)->first();
	DB::table('pelunasan_piutang')->insert([
		'id_sales_order' => $request->akun_kredit,
		'tgl_pelunasan' => $request->tanggal_jurnal,
		'nominal' => $request->nominal_jurnal
	]);
	
	if($data_pelunasan->pajak=='V1'){
	   DB::select('CALL jurnal_debit(?,?,?,?)', [$request->post('akun_debit'),$request->post('nominal_jurnal'),$request->post('tanggal_jurnal'),'UMUM']);
           DB::select('CALL jurnal_kredit(?,?,?,?)', [130002,$request->post('nominal_jurnal'),$request->post('tanggal_jurnal'),'UMUM']);
	   DB::select('CALL jurnal_kredit(?,?,?,?)', [410001,$data_pelunasan->total_pajak,$request->post('tanggal_jurnal'),'UMUM']);
	}
	else{
	   DB::select('CALL jurnal_debit(?,?,?,?)', [$request->post('akun_debit'),$request->post('nominal_jurnal'),$request->post('tanggal_jurnal') ,'UMUM']);
           DB::select('CALL jurnal_kredit(?,?,?,?)', [410001,$request->post('nominal_jurnal'),$request->post('tanggal_jurnal'),'UMUM']);
	}
	
	DB::table('sales_order')->where('id_so',$request->akun_kredit)->update(['total_pelunasan'=>$data_pelunasan->total_penjualan - $request->nominal_jurnal]);
       	return redirect('home')->with('success', 'customer saved!');
    }





    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('customer.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_customer'=>'required',
            'nama_customer'=>'required',
            'alamat_customer'=>'required',
            'kota'=>'required',
            'provinsi'=>'required',
            'no_telp'=>'required',
            'pic'=>'required',
            'tipe_customer' => 'required'
        ]);

        $customer = Customer::find($id);
        $customer->id_customer = $request->get('id_customer');
        $customer->nama_customer = $request->get('nama_customer');
        $customer->alamat_customer = $request->get('alamat_customer');
        $customer->kota = $request->get('kota');
        $customer->provinsi = $request->get('provinsi');
        $customer->no_telp = $request->get('no_telp');
        $customer->pic = $request->get('pic');
        $customer->tipe_customer = $request->get('tipe_customer');
        
        $customer->save();

        return redirect('/customer')->with('success', 'customer Updated!');
    }

    public function load_data_coa(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $data = DB::table('coa')->select('NO_COA', 'DESKRIPSI_COA')->where('DESKRIPSI_COA', 'LIKE', '%$cari%')->get();
            return response()->json($data);
        }
    }

    //untuk bayar su

    public function load_data_sisa_hutang_supplier(Request $request) {

    if ($request->has('q')) {
            $cari = $request->q;
//            var_dump($cari);
//            die();
           // $data = DB::table('pengadaan')->select('(total_pembelian+total_pajak)', '(total_pembelian + total_pajak) - total_pelunasan')->where('id_pengadaan', '=', '$cari')->get();
            $data = DB::table('pengadaan')->select(DB::raw('(total_pembelian + total_pajak) as total_hutang, (total_pembelian + total_pajak) - total_pelunasan_piutang as sisa_hutang'))
            ->where('id_pengadaan', '=', $cari)
                ->get();

            return response()->json($data);
        }

}

    public function load_data_sisa_piutang_customer(Request $request) {

//         if ($request->has('q')) {
//             $cari = $request->q;
// //            var_dump($cari);
// //            die();
//             // $data = DB::table('pengadaan')->select('(total_pembelian+total_pajak)', '(total_pembelian + total_pajak) - total_pelunasan')->where('id_pengadaan', '=', '$cari')->get();
//             $data = DB::table('sales_order')->select(DB::raw('(total_sales_order + total_pajak) as total_piutang, (total_sales_order + total_pajak) - total_pelunasan as sisa_piutang'))
//                 ->where('id_so', '=', $cari)
//                 ->get();

//             return response()->json($data);
//         }
if ($request->has('q')) {
    $cari = $request->q;
//            var_dump($cari);
//            die();
    // $data = DB::table('pengadaan')->select('(total_pembelian+total_pajak)', '(total_pembelian + total_pajak) - total_pelunasan')->where('id_pengadaan', '=', '$cari')->get();
    $data = DB::table('faktur_penjualan')->select(DB::raw('(total_faktur) as total_piutang, (total_faktur) - coalesce(pembayaran,0) as sisa_piutang'))
        ->where('no_faktur', '=', $cari)
        ->get();

    return response()->json($data);
}

    }



    public function getCoanumber(Request $request){

            $cari = $request->post('searchTerm');

            $data = DB::table('coa')->select('NO_COA', 'DESKRIPSI_COA')->where('DESKRIPSI_COA', 'LIKE', '%'.$cari.'%')->get();

            return response()->json($data);

        }

//	public function getCoanumber(){
//
//
//            $data = DB::table('coa')->select('NO_COA', 'DESKRIPSI_COA')->get();
//
//            return response()->json($data);
//
//        }




    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();

        return redirect('/customer')->with('success', 'customer deleted!');
    }

    public function getIdCustomer(){
        $customer = DB::table('customer')->select('id_customer', 'nama_customer')->get();

        return response()->json($customer);
    }

    public function faktur(Request $req){
	if($req->has('cari')){
		$faktur_penjualan = \App\faktur::where('no_faktur','LIKE','%'.$req->cari.'%')->paginate(10);
        }
	else{
		$faktur_penjualan = \App\faktur::paginate(10);
	}
	return view('finance.faktur.index',compact('faktur_penjualan'));
    }

    public function create_faktur(Request $req){
	$no_surat_jalan = $req->no_surat_jalan;

	$detail_faktur = DB::select("SELECT surat_jalan.no_surat_jalan
        , surat_jalan.tgl_surat_jalan
        , surat_jalan.no_surat_jalan
        , surat_jalan.plat_nomor
        , detail_surat_jalan.kode_barang
	, barang.nama_barang
	, barang.ukuran
        , detail_surat_jalan.qty
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
        WHERE surat_jalan.no_surat_jalan = '$req->no_surat_jalan' AND detail_surat_jalan.kode_barang = detail_sales_order.kode_barang");
        $header_faktur = array_values($detail_faktur)[0];
	return view('finance.faktur.create', compact('detail_faktur','header_faktur','no_surat_jalan'));
    }

    public function store_data_faktur(Request $req){
//	dd($req->all());
//	die();
//    var_dump(str_replace(".","",$req->total_penjualan));
//    die();
	$terbilang = $req->keterangan;
	DB::table('faktur_penjualan')->insertGetId(['no_faktur' => $req->no_faktur, 'tgl_faktur' => $req->tgl_faktur, 'keterangan' => $req->keterangan]);
	
	if($req->pajak == "V0" || $req->pajak == "V1"){
	     DB::select('CALL jurnal_debit(?,?,?,?)', ['120002',$req->total_penjualan,'Piutang Usaha','UMUM']);
             DB::select('CALL jurnal_kredit(?,?,?,?)', ['410001',$req->total_penjualan,'Total Penjualan','UMUM']);
	     

	}
	DB::select('CALL jurnal_debit(?,?,?,?)', ['120002',str_replace(".","",$req->total_penjualan),'Piutang Usaha','UMUM']);
        DB::select('CALL jurnal_kredit(?,?,?,?)', ['410001',str_replace(".","",$req->total_penjualan),'Total Penjualan','UMUM']);
	//DB::select('CALL jurnal_kredit(?,?,?,?)', ['220001',$req->total_pajak,'Total Pajak','UMUM']);
	
	$tgl_faktur = $req->tgl_faktur;
	$detail_faktur = DB::select("SELECT surat_jalan.no_surat_jalan
        , surat_jalan.tgl_surat_jalan
        , surat_jalan.no_surat_jalan
        , surat_jalan.plat_nomor
        , detail_surat_jalan.kode_barang
	, barang.nama_barang
	, barang.ukuran
        , detail_surat_jalan.qty
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
        WHERE surat_jalan.no_surat_jalan = '$req->no_faktur' AND detail_surat_jalan.kode_barang = detail_sales_order.kode_barang");
        $header_faktur = array_values($detail_faktur)[0];

        return view('finance.faktur.print_faktur', compact('detail_faktur','header_faktur','tgl_faktur','terbilang'));
	
    }

    public function get_no_sj(Request $request){
        if ($request->has('q')) {
            $cari = $request->q;
            $no_sj = DB::table('surat_jalan')->select('no_surat_jalan')
                ->where('no_surat_jalan', 'LIKE', '%'.$cari.'%')
                ->get();

                return response()->json($no_sj);
        }
        $no_sj = DB::table('surat_jalan')->select('no_surat_jalan')->get();

        return response()->json($no_sj);
    }

    public function print_faktur($no_faktur){
	//$tgl_faktur = $req->tgl_faktur;	

	
	$detail_faktur = DB::select("SELECT surat_jalan.no_surat_jalan
        , surat_jalan.tgl_surat_jalan
        , surat_jalan.no_surat_jalan
        , surat_jalan.plat_nomor
        , detail_surat_jalan.kode_barang
	, barang.nama_barang
	, barang.ukuran
        , detail_surat_jalan.qty
        , detail_sales_order.harga_satuan
        , barang.spesifikasi_barang
        , sales_order.no_po_customer
        , sales_order.pajak
        , customer.nama_customer
        , customer.alamat_customer
        , customer.kota
	, faktur_penjualan.tgl_faktur
	, faktur_penjualan.keterangan
        FROM
            surat_jalan
        INNER JOIN detail_surat_jalan
        ON surat_jalan.no_surat_jalan = detail_surat_jalan.no_surat_jalan
	INNER JOIN faktur_penjualan
	ON faktur_penjualan.no_faktur = detail_surat_jalan.no_surat_jalan
        INNER JOIN barang
        ON barang.kode_barang = detail_surat_jalan.kode_barang
        INNER JOIN sales_order 
        ON sales_order.id_so = detail_surat_jalan.no_sales_order
        INNER JOIN detail_sales_order
        ON detail_surat_jalan.no_detail_sales_order = detail_sales_order.counter_detail_sales_order
        INNER JOIN customer
        ON customer.id_customer = sales_order.id_customer
        WHERE surat_jalan.no_surat_jalan = '$no_faktur' AND detail_surat_jalan.kode_barang = detail_sales_order.kode_barang");
        $header_faktur = array_values($detail_faktur)[0];
	$tgl_faktur = $header_faktur->tgl_faktur;
	$terbilang = $header_faktur->keterangan;
        return view('finance.faktur.print_faktur', compact('detail_faktur','header_faktur','tgl_faktur','terbilang'));
    }

    public function Terbilang($nilai) {
        $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
        if($nilai==0){
            return "Kosong";
        }elseif ($nilai < 12&$nilai!=0) {
            return "" . $huruf[$nilai];
        } elseif ($nilai < 20) {
            return $this->Terbilang($nilai - 10) . " Belas ";
        } elseif ($nilai < 100) {
            return $this->Terbilang($nilai / 10) . " Puluh " . $this->Terbilang($nilai % 10);
        } elseif ($nilai < 200) {
            return " Seratus " . $this->Terbilang($nilai - 100);
        } elseif ($nilai < 1000) {
            return $this->Terbilang($nilai / 100) . " Ratus " . $this->Terbilang($nilai % 100);
        } elseif ($nilai < 2000) {
            return " Seribu " . Terbilang($nilai - 1000);
        } elseif ($nilai < 1000000) {
            return $this->Terbilang($nilai / 1000) . " Ribu " . $this->Terbilang($nilai % 1000);
        } elseif ($nilai < 1000000000) {
            return $this->Terbilang($nilai / 1000000) . " Juta " . $this->Terbilang($nilai % 1000000);
        }elseif ($nilai < 1000000000000) {
            return $this->Terbilang($nilai / 1000000000) . " Milyar " . $this->Terbilang($nilai % 1000000000);
        }elseif ($nilai < 100000000000000) {
            return $this->Terbilang($nilai / 1000000000000) . " Trilyun " . $this->Terbilang($nilai % 1000000000000);
        }elseif ($nilai <= 100000000000000) {
            return "Maaf Tidak Dapat di Prose Karena Jumlah nilai Terlalu Besar ";
        }
    }
	
    public function getpo(){

        $getnopo = DB::table('pengadaan')->select('id_pengadaan')->get();

        return response()->json($getnopo);
    }

    public function getso(){

        $getnoso = DB::table('sales_order')->select('id_so')->get();

        return response()->json($getnoso);
    }


    public function pelunasan_piutang(){
	return view ('finance.pelunasan_piutang_customer.create');
    }


    //modul pengadaan

    public function pelunasan_hutang_supplier(Request $request) {
//
//        dd($request);
//        die();
//        DB::beginTransaction();
//        try {

            $no_pengadaan = $request->no_po;
            $data_pengadaan = DB::table('pengadaan')->select('total_pembelian', 'pajak', 'total_pajak','total_pelunasan_piutang')->where('id_pengadaan', '=', $request->no_po)->first();
            $result_pengadaan = DB::select(DB::raw("select nominal from pelunasan_hutang_supplier  where id_pengadaan ='$no_pengadaan'"));
            if ($result_pengadaan == null) {

                if ($data_pengadaan->pajak == 'V1') {
                    var_dump('agung');
                    die();
                    DB::select('CALL jurnal_debit(?,?,?,?)', [$request->post('akun_debit'), $request->post('nominal_pembayaran'),  $request->post('keterangan_pembayaran'), 'UMUM']);
                    DB::select('CALL jurnal_kredit(?,?,?,?)', [130002, $request->post('nominal_pembayaran'),  $request->post('keterangan_pembayaran'), 'UMUM']);
                 //   DB::select('CALL jurnal_kredit(?,?,?,?)', [220001, $data_pengadaan->total_pajak, $request->post('keterangan_pembayaran'), 'UMUM']);
                }
            }
            DB::select('CALL jurnal_debit(?,?,?,?)', [$request->post('akun_debit'), $request->post('nominal_pembayaran'),  $request->post('keterangan_pembayaran'), 'UMUM']);
            DB::select('CALL jurnal_kredit(?,?,?,?)', [130002, $request->post('nominal_pembayaran'),  $request->post('keterangan_pembayaran'), 'UMUM']);
//        dd($result_pengadaan);
//        die();

            //dd($data_pengadaan->total_pembelian-10000);
            //dd($data_pengadaan->pajak);

            DB::table('pelunasan_hutang_supplier')->insert([
                'id_pengadaan' => $request->no_po,
                'tgl_pelunasan' => $request->tanggal_pembayaran,
                'deskripsi' => $request->keterangan_pembayaran,
                'nominal' => $request->nominal_pembayaran,
                'akun_debit' => $request->akun_debit
            ]);


            DB::table('pengadaan')->where('id_pengadaan', $request->no_po)->update(['total_pelunasan_piutang' => $data_pengadaan->total_pelunasan_piutang + $request->nominal_pembayaran]);
            return redirect('/finance/input_pelunasan_supplier')->with('success', 'customer saved!');

//            DB::commit();
//        }
//            catch(\Exception $e) {
//            DB::rollBack();
//            }

    }




    public function daftar_hutang_supplier ()
    {
        return view('finance.daftar_hutang');
    }
    public function detail_pembayaran_supplier (request $request) {

            $no_surat_jalan = $req->no_surat_jalan;

            $detail_faktur = DB::select("SELECT surat_jalan.no_surat_jalan
        , surat_jalan.tgl_surat_jalan
        , surat_jalan.no_surat_jalan
        , surat_jalan.plat_nomor
        , detail_surat_jalan.kode_barang
	, barang.nama_barang
	, barang.ukuran
        , detail_surat_jalan.qty
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
        WHERE surat_jalan.no_surat_jalan = '$req->no_surat_jalan' AND detail_surat_jalan.kode_barang = detail_sales_order.kode_barang");
            $header_faktur = array_values($detail_faktur)[0];
            return view('finance.faktur.create', compact('detail_faktur','header_faktur','no_surat_jalan'));
    }




    function daftar_hutang_pembayaran_supplier(request $request)
    {
//        var_dump($request->ajax());
//        die();
        if ($request->ajax()) {

            $output = '';
            $query = $request->get('query');
            if ($query != '') {
                var_dump('agung');
                die();
                $data = DB::select("SELECT pengadaan.id_pengadaan
     , supplier.nama_supplier
     , pengadaan.tgl_pembelian
     , pengadaan.status
     , pengadaan.pajak
     , pengadaan.total_pembelian
     , pengadaan.total_pajak
     , pengadaan.total_pelunasan_piutang
FROM
  supplier
INNER JOIN pengadaan
ON supplier.kode_supplier = pengadaan.kode_supplier");
                //  WHERE surat_jalan.no_surat_jalan = '$req->no_faktur' AND detail_surat_jalan.kode_barang = detail_sales_order.kode_barang");


            } else {
                $data = DB::select("SELECT pengadaan.id_pengadaan
     , supplier.nama_supplier
     , pengadaan.tgl_pembelian
     , pengadaan.status
     , pengadaan.pajak
     , pengadaan.total_pembelian
     , pengadaan.total_pajak
     , pengadaan.total_pelunasan_piutang
FROM
  supplier
INNER JOIN pengadaan
ON supplier.kode_supplier = pengadaan.kode_supplier");

            }
//                var_dump(count($data));
//                die();
            $total_row = count($data);
            if ($total_row > 0) {
                foreach ($data as $row) {
                    $output .= '
        <tr>
         <td>' . $row->id_pengadaan . '</td>
         <td>' . $row->nama_supplier . '</td> 
         <td>' . $row->tgl_pembelian . '</td>
         <td>' . $row->status . '</td>
         <td>' . $row->pajak . '</td>
         <td>' . number_format($row->total_pembelian) . '</td>
          <td>' . number_format($row->total_pajak) . '</td>
           <td>' . number_format($row->total_pelunasan_piutang) . '</td>
           <td>' . number_format(intval(($row->total_pembelian + $row->total_pajak) - $row->total_pelunasan_piutang)) . '</td>
           <td>'   .' </td>
        </tr>
        ';
                }
            } else {
                $output = '
       <tr>
        <td align="center" colspan="5">No Data Found</td>
       </tr>
       ';
            }
            $data = array(
                'table_data' => $output,
                'total_data' => $total_row
            );

            echo json_encode($data);
        }




    }

    public function simpan_pengeluaran_kas (request $request) {
        try {

            $jurnal_pengeluaran_kas = new Jurnal_pengeluaran_kas([
                'tgl_jurnal' => $request->post('tanggal'),
                'deskripsi' => $request->post('deskripsi_jurnal'),
                'nominal' => $request->post('nominal_jurnal'),

            ]);

            // var_dump($request->post('tanggal'));
            // var_dump($request->post('deskripsi_jurnal'));
            // var_dump($request->post('nominal_jurnal'));
            // die();

            $jurnal_pengeluaran_kas->save();
            DB::select('CALL jurnal_debit(?,?,?,?)', [$request->post('akun_debit'),$request->post('nominal_jurnal'),$request->post('deskripsi_jurnal'),'UMUM']);
            DB::select('CALL jurnal_kredit(?,?,?,?)', [$request->post('akun_kredit'),$request->post('nominal_jurnal'),$request->post('deskripsi_jurnal'),'UMUM']);

            return redirect('/finance/input_jurnal_harian')->with('success', 'customer saved!');}
        catch (Throwable $e) {
            report($e);
            return false;
        }


    }


}
