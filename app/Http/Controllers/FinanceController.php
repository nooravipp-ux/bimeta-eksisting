<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\KodePerkiraan;
use App\finance;
use App\faktur;
use App\Jurnal_pengeluaran_kas;
use App\SuratJalan;

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
	         DB::select('CALL jurnal_kredit(?,?,?,?)', [220001,$data_pengadaan->total_pajak,$request->post('tanggal_jurnal'),$request->post('deskripsi_jurnal'),'UMUM']);
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
        
        if ($request->has('q')) {
            $cari = $request->q;
            $detail_faktur = DB::select("select sales_order.pajak from sales_order
            inner join surat_jalan on surat_jalan.no_sales_order = sales_order.id_so
            inner join faktur_penjualan on surat_jalan.no_surat_jalan = faktur_penjualan.no_faktur
        WHERE faktur_penjualan.no_faktur ='". $cari ."'");
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
		//$faktur_penjualan = \App\faktur::all();
        $faktur_penjualan = \App\faktur::where('no_faktur','LIKE','B23%')->orwhere('no_faktur','LIKE','B24%')->get();
	}
	return view('finance.faktur.index',compact('faktur_penjualan'));
    }

    public function create_faktur(Request $req){
    $no_surat_jalan = $req->no_surat_jalan;

    if($this->cek_no_faktur($no_surat_jalan)){
	    return redirect('/finance/faktur')->with(['message' => 'No Faktur '.$no_surat_jalan.' sudah di buat !!!']);
	}
    
	$detail_faktur = DB::select("SELECT DISTINCT surat_jalan.no_surat_jalan
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
	//dd($req->all());
	$terbilang = $req->keterangan;
	DB::table('faktur_penjualan')->insertGetId(['no_faktur' => $req->no_faktur, 'tgl_faktur' => $req->tgl_faktur, 'keterangan' => $req->keterangan,'total_faktur' => str_replace(".","",$req->total_penjualan)]);
	
	if($req->pajak == "V0" || $req->pajak == "V1"){
	     DB::select('CALL jurnal_debit(?,?,?,?)', ['120002',$req->total_penjualan,'Piutang Usaha','UMUM']);
             DB::select('CALL jurnal_kredit(?,?,?,?)', ['410001',$req->total_penjualan,'Total Penjualan','UMUM']);
	     

	}
    $total_pajak = str_replace(".","",$req->total_pajak);
    $total_pendapatan_sebelum_pajak = intval((str_replace(".","",$req->total_penjualan)))/1.1;
	DB::select('CALL jurnal_debit(?,?,?,?)', ['120002',str_replace(".","",$req->total_penjualan),'Piutang Usaha','UMUM']);
    DB::select('CALL jurnal_kredit(?,?,?,?)', ['410001',$total_pendapatan_sebelum_pajak,'Total Penjualan','UMUM']);
	DB::select('CALL jurnal_kredit(?,?,?,?)', ['220001',$total_pajak,'Total Pajak','UMUM']);
	
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
        if ($header_faktur->pajak == 'V0'|| $header_faktur->pajak == 'V2'){
            return view('finance.faktur.print_faktur_non_ppn', compact('detail_faktur','header_faktur','tgl_faktur','terbilang'));
           } else {
            return view('finance.faktur.print_faktur', compact('detail_faktur','header_faktur','tgl_faktur','terbilang'));
           }
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

    public function print_faktur($no_faktur){
	//$tgl_faktur = $req->tgl_faktur;	

	
	$detail_faktur = DB::select("SELECT DISTINCT surat_jalan.no_surat_jalan
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
        ON detail_surat_jalan.no_sales_order = detail_sales_order.id_sales_order
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
    
        public function cek_no_faktur($no_faktur){
        $count_faktur = DB::table('faktur_penjualan')->where('no_faktur', $no_faktur)->count();
        if($count_faktur > 0){
            return true;
        }
        return false;
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
                    DB::select('CALL jurnal_kredit(?,?,?,?)', [220001, $data_pengadaan->total_pajak, $request->post('keterangan_pembayaran'), 'UMUM']);
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
    public function laporanneraca()
    {
        $LaporanNeraca = KodePerkiraan::whereIn('JENIS',['ASET','KEWAJIBAN'])->where('SALDO','!=',0)->get();
        $Jumlahjenis = KodePerkiraan::where('JENIS','ASET')->where('SALDO','!=',0)->count();
        $totalaset = KodePerkiraan::where('JENIS','ASET')->sum('SALDO');
        $totalkewajiban = KodePerkiraan::where('JENIS','KEWAJIBAN')->sum('SALDO');

//dd($LaporanNeraca);
        return view('finance.coa.laporan_neraca', ['LaporanNeraca' => $LaporanNeraca,'JumlahJenis' => $Jumlahjenis,'totalaset' => $totalaset,'totalkewajiban' => $totalkewajiban]);

    }

    public function laporan_rugi_laba() {
        $LaporanPenjualan = KodePerkiraan::where('JENIS','PENJUALAN')->where('SALDO','!=',0)->get();
        $LaporanHpp = KodePerkiraan::where('JENIS','HPP')->where('SALDO','!=',0)->get();
        $LaporanBiayaOperasional = KodePerkiraan::where('JENIS','BIAYA OPERASIONAL')->where('SALDO','!=',0)->get();
        $TotalLaporanPenjualan = KodePerkiraan::where('JENIS','PENJUALAN')->sum('SALDO');
        $TotalLaporanHpp = KodePerkiraan::where('JENIS','HPP')->sum('SALDO');
        $TotalBiayaOperasional = KodePerkiraan::where('JENIS','BIAYA OPERASIONAL')->sum('SALDO');

        return view('finance.coa.laporan_rugi_laba',
            ['LaporanPenjualan' => $LaporanPenjualan,'LaporanHpp' => $LaporanHpp,
            'LaporanBiayaOperasional' => $LaporanBiayaOperasional,'TotalLaporanPenjualan' => $TotalLaporanPenjualan,
                'TotalLaporanHpp'=> $TotalLaporanHpp,'TotalBiayaOperasional'=>$TotalBiayaOperasional]);

    }

    public function get_data_jurnal_laporan(request $request){

         $data = DB::table('jurnal_umum')
                ->leftJoin('coa','jurnal_umum.no_coa','=','coa.NO_COA')
                ->where('jurnal_umum.no_coa','LIKE','%'.$request->no_coa.'%')
                ->where('jurnal_umum.tanggal','>=',$request->dari)
                ->where('jurnal_umum.tanggal','<=',$request->sampai)
                ->orderBy('jurnal_umum.counter_jurnal','ASC')
                ->get();

         $output = '';
        $total_row = count($data);

        if ($total_row > 0) {
            foreach ($data as $row) {
                $output .= '
        <tr>
         <td>' . $row->no_coa . '</td>
         <td>' . $row->DESKRIPSI_COA . '</td> 
         <td>' . $row->tanggal . '</td>
         <td>' . number_format($row->debet) . '</td>
          <td>' . number_format($row->kredit) . '</td>
           <td>' . number_format($row->saldo_awal) . '</td>
           <td>' . number_format($row->saldo_akhir)  . '</td>
         
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

    public function posting_laporan_keuangan(){
         return view('finance.coa.posting_laporan_keuangan');



    }

    public function laporan_data_jurnal(request $request) {

        return view('finance.coa.laporan_data_jurnal');


    }

    public function posting_finance(){

        $TotalLaporanPenjualan = KodePerkiraan::where('JENIS','PENJUALAN')->sum('SALDO');
        $TotalLaporanHpp = KodePerkiraan::where('JENIS','HPP')->sum('SALDO');
        $TotalBiayaOperasional = KodePerkiraan::where('JENIS','BIAYA OPERASIONAL')->sum('SALDO');
        $PendapatanBersih = $TotalLaporanPenjualan - ($TotalLaporanHpp + $TotalBiayaOperasional);
        DB::update('update coa set saldo = saldo + ? where NO_COA= ?', array($PendapatanBersih, 330002));
        DB::update('insert into post_coa(post_coa.TYPE,post_coa.SUB,post_coa.SALDO_AWAL,post_coa.SALDO,post_coa.NO_COA,post_coa.KREDIT,
            post_coa.JENIS,post_coa.HEADER,post_coa.DESKRIPSI_COA,post_coa.DEBIT,post_coa.bulan,post_coa.tahun)
select coa.TYPE,coa.SUB,coa.SALDO_AWAL,coa.SALDO,coa.NO_COA,coa.KREDIT,coa.JENIS,coa.HEADER,coa.DESKRIPSI_COA,coa.DEBIT,MONTH(CURDATE()),YEAR(CURDATE()) from coa');
        DB::update('update coa set saldo = 0 where JENIS= ?', array('PENJUALAN'));
        DB::update('update coa set saldo = 0 where JENIS= ?', array('HPP'));
        DB::update('update coa set saldo = 0 where JENIS= ?', array('BIAYA OPERASIONAL'));
        return view('home');

    }
// modul baru faktur pilihan
public function membuat_faktur_dengan_pilihan(Request $req){

    $no_surat_jalan = $req->no_surat_jalan;
   // $no_urut_faktur = $req->no_faktur_penjualan;
    //   $no_sj = $this->sj_no($data_pajak->pajak);
    $string=$req->no_surat_jalan;
    $array=array_map('strval', explode(',', $string));
    $array = implode("','",$array);

//        var_dump($array);
//        die();

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
    WHERE surat_jalan.no_surat_jalan IN ('$array') AND detail_surat_jalan.kode_barang = detail_sales_order.kode_barang");
//        dd($detail_faktur);

    $header_faktur = array_values($detail_faktur)[0];
    $jenis_pajak = substr($header_faktur->no_surat_jalan,0,1);
     $no_urut_faktur = $this->sj_no($jenis_pajak);

    //    dd($header_faktur);
    //    die();
    return view('finance.faktur.pilihan_faktur_non_ppn', compact('detail_faktur','header_faktur','no_surat_jalan','no_urut_faktur'));
   // return view('finance.faktur.index_pilihan');


}
public function sj_no($pajak){
    $noUrutAkhir = DB::table('faktur_penjualan')->max('no_faktur');
    $no = 1;
    if($pajak == "B"){
        $no_urut = "";
        $no_urut_faktur = DB::select("SELECT 'B',DATE_FORMAT(NOW(),'%y') AS curdat,LPAD((RIGHT(MAX(NO_FAKTUR),6)+1),6,'0') AS NO_URUT_FAKTUR FROM faktur_penjualan WHERE MID(NO_FAKTUR,2,2)= DATE_FORMAT(NOW(),'%y') AND LEFT(NO_FAKTUR,1)= 'B'");
        foreach($no_urut_faktur as $sj){
            if($sj->NO_URUT_FAKTUR != NULL){
                return $no_urut = $sj->B.$sj->curdat.$sj->NO_URUT_FAKTUR;
            }else{
                return $no_urut = "B".date('y').sprintf("%06s", $no);
            }
        }
    }elseif($pajak == "K"){
        $no_urut = "";
        $no_urut = DB::select("SELECT 'K',DATE_FORMAT(NOW(),'%y') AS curdat,LPAD((RIGHT(MAX(NO_FAKTUR),4)+1),4,'0') AS NO_URUT_FAKTUR FROM faktur_penjualan WHERE MID(NO_FAKTUR,2,2)= DATE_FORMAT(NOW(),'%y') AND LEFT(NO_FAKTUR,1)= 'K'");
        foreach($no_urut as $sj){
            if($sj->NO_URUT_FAKTUR != NULL){
                return $no_urut = $sj->K.$sj->curdat.$sj->NO_URUT_FAKTUR;
            }else{
                return $no_urut = "K".date('y').sprintf("%04s", $no);
            }
        }
    }else{
        $no_urut = "";
        $no_urut = DB::select("SELECT 'S',DATE_FORMAT(NOW(),'%y') AS curdat,LPAD((RIGHT(MAX(NO_FAKTUR),6)+1),6,'0') AS NO_URUT_FAKTUR FROM FAKTUR_PENJUALAN WHERE MID(NO_FAKTUR,2,2)= DATE_FORMAT(NOW(),'%y') AND LEFT(NO_FAKTUR,1)= 'S'");
        foreach($no_urut as $sj){
            if($sj->NO_URUT_FAKTUR != NULL){
                return $no_urut = $sj->S.$sj->curdat.$sj->NO_URUT_FAKTUR;
            }else{
                return $no_urut = "S".date('y').sprintf("%06s", $no);
            }
        }
    }
}
public function index_pilihan_faktur(){
    return view('finance.faktur.index_pilihan');


}

public function store_data_faktur_pilihan(Request $req){

    // dd($req->all());
    // die();
//    var_dump(str_replace(".","",$req->total_penjualan));
//    die();
    $string=$req->no_surat_jalan;
    $array=array_map('strval', explode(',', $string));
    $array = implode("','",$array);
    $terbilang = $req->keterangan;
    DB::table('faktur_penjualan')->insertGetId(['no_faktur' => $req->no_faktur,'no_surat_jalan' => $req->no_surat_jalan, 'tgl_faktur' => $req->tgl_faktur, 'keterangan' => $req->keterangan,'total_faktur' => str_replace(".","",$req->total_penjualan)]);

    if($req->pajak == "V0" || $req->pajak == "V1"){
        DB::select('CALL jurnal_debit(?,?,?,?)', ['120002',$req->total_penjualan,'Piutang Usaha','UMUM']);
        DB::select('CALL jurnal_kredit(?,?,?,?)', ['410001',$req->total_penjualan,'Total Penjualan','UMUM']);


    }
  
    $total_pajak = str_replace(".","",$req->total_pajak);
    $total_pendapatan_sebelum_pajak = intval((str_replace(".","",$req->total_penjualan)))/1.1;
    DB::select('CALL jurnal_debit(?,?,?,?)', ['120002',str_replace(".","",$req->total_penjualan),'Piutang Usaha','UMUM']);
    DB::select('CALL jurnal_kredit(?,?,?,?)', ['410001',$total_pendapatan_sebelum_pajak,'Total Penjualan','UMUM']);
    DB::select('CALL jurnal_kredit(?,?,?,?)', ['220001',$total_pajak,'Total Pajak','UMUM']);

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
    WHERE surat_jalan.no_surat_jalan  IN ('$array')   AND detail_surat_jalan.kode_barang = detail_sales_order.kode_barang");
    $header_faktur = array_values($detail_faktur)[0];
    $jenis_pajak = substr($header_faktur->no_surat_jalan,0,1);
    $no_urut_faktur = $req->no_faktur;
    //dd($header_faktur);
    if ($header_faktur->pajak == 'V0'|| $header_faktur->pajak == 'V2'){
        return view('finance.faktur.print_faktur_pilihan_non_ppn', compact('detail_faktur','header_faktur','tgl_faktur','terbilang','no_urut_faktur','string'));
    } else {
        return view('finance.faktur.print_faktur', compact('detail_faktur','header_faktur','tgl_faktur','terbilang'));
    }
}

// modul baru faktur pilihan

}
