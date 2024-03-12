<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Exports\ProgresProduksiExport;
use App\Exports\ProgresCorExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\ProgresIndividu;
use App\ProgresProduksi;

class ProgresProduksiController extends Controller
{
    public function index(){
		$datapro = DB::table('progres_produksi')
				->select('progres_produksi.tgl_prod','sales_order.no_po_customer','spk.no_spk','spk.tipe_spk','customer.nama_customer','customer.pic','progres_produksi.lebar','progres_produksi.panjang','progres_produksi.kwalitas','progres_produksi.jumlah_sheet','progres_produksi.jumlah_box','progres_produksi.cor','progres_produksi.slitter','progres_produksi.pon','progres_produksi.coak','progres_produksi.print','progres_produksi.slotter','progres_produksi.lem','progres_produksi.kancing','progres_produksi.tgl_pengiriman','progres_produksi.coak','progres_produksi.no_inv','jml_kirim','progres_produksi.persentase','progres_produksi.laminasi','progres_produksi.kupas','progres_produksi.triple')
				->where('progres_produksi.tgl_prod','LIKE', '%2022%')
				->join('spk','progres_produksi.no_spk','spk.no_spk')
				->join('sales_order','spk.no_sales_order','sales_order.id_so')
				->join('customer','sales_order.id_customer','customer.id_customer')
				->get();
		
		$dataproali = DB::table('progres_produksi')
				->select('progres_produksi.tgl_prod','sales_order.no_po_customer','spk.no_spk','customer.nama_customer','customer.pic','progres_produksi.lebar','progres_produksi.panjang','progres_produksi.kwalitas','progres_produksi.jumlah_sheet','progres_produksi.jumlah_box','progres_produksi.cor','progres_produksi.slitter','progres_produksi.pon','progres_produksi.coak','progres_produksi.print','progres_produksi.slotter','progres_produksi.lem','progres_produksi.kancing','progres_produksi.tgl_pengiriman','progres_produksi.coak','progres_produksi.no_inv','jml_kirim','progres_produksi.persentase','progres_produksi.laminasi','progres_produksi.kupas','progres_produksi.triple')
				->where('progres_produksi.tgl_prod','LIKE', '%2023%')
				->where('customer.pic','=', "ALI")
				->join('spk','progres_produksi.no_spk','spk.no_spk')
				->join('sales_order','spk.no_sales_order','sales_order.id_so')
				->join('customer','sales_order.id_customer','customer.id_customer')
				->get();
		$dataprogopar = DB::table('progres_produksi')
				->select('progres_produksi.tgl_prod','sales_order.no_po_customer','spk.no_spk','customer.nama_customer','customer.pic','progres_produksi.lebar','progres_produksi.panjang','progres_produksi.kwalitas','progres_produksi.jumlah_sheet','progres_produksi.jumlah_box','progres_produksi.cor','progres_produksi.slitter','progres_produksi.pon','progres_produksi.coak','progres_produksi.print','progres_produksi.slotter','progres_produksi.lem','progres_produksi.kancing','progres_produksi.tgl_pengiriman','progres_produksi.coak','progres_produksi.no_inv','jml_kirim','progres_produksi.persentase','progres_produksi.laminasi','progres_produksi.kupas','progres_produksi.triple')
				->where('progres_produksi.tgl_prod','LIKE', '%2023%')
				->where('customer.pic','=', "GOPAR")
				->join('spk','progres_produksi.no_spk','spk.no_spk')
				->join('sales_order','spk.no_sales_order','sales_order.id_so')
				->join('customer','sales_order.id_customer','customer.id_customer')
				->get();
		$dataproahmad = DB::table('progres_produksi')
				->select('progres_produksi.tgl_prod','sales_order.no_po_customer','spk.no_spk','customer.nama_customer','customer.pic','progres_produksi.lebar','progres_produksi.panjang','progres_produksi.kwalitas','progres_produksi.jumlah_sheet','progres_produksi.jumlah_box','progres_produksi.cor','progres_produksi.slitter','progres_produksi.pon','progres_produksi.coak','progres_produksi.print','progres_produksi.slotter','progres_produksi.lem','progres_produksi.kancing','progres_produksi.tgl_pengiriman','progres_produksi.coak','progres_produksi.no_inv','jml_kirim','progres_produksi.persentase','progres_produksi.laminasi','progres_produksi.kupas','progres_produksi.triple')
				->where('progres_produksi.tgl_prod','LIKE', '%2023%')
				->where('customer.pic','=', "AHMAD")
				->join('spk','progres_produksi.no_spk','spk.no_spk')
				->join('sales_order','spk.no_sales_order','sales_order.id_so')
				->join('customer','sales_order.id_customer','customer.id_customer')
				->get();
		$dataprodavid = DB::table('progres_produksi')
				->select('progres_produksi.tgl_prod','sales_order.no_po_customer','spk.no_spk','customer.nama_customer','customer.pic','progres_produksi.lebar','progres_produksi.panjang','progres_produksi.kwalitas','progres_produksi.jumlah_sheet','progres_produksi.jumlah_box','progres_produksi.cor','progres_produksi.slitter','progres_produksi.pon','progres_produksi.coak','progres_produksi.print','progres_produksi.slotter','progres_produksi.lem','progres_produksi.kancing','progres_produksi.tgl_pengiriman','progres_produksi.coak','progres_produksi.no_inv','jml_kirim','progres_produksi.persentase','progres_produksi.laminasi','progres_produksi.kupas','progres_produksi.triple')
				->where('progres_produksi.tgl_prod','LIKE', '%2023%')
				->where('customer.pic','=', "DAVID")
				->join('spk','progres_produksi.no_spk','spk.no_spk')
				->join('sales_order','spk.no_sales_order','sales_order.id_so')
				->join('customer','sales_order.id_customer','customer.id_customer')
				->get();
		$dataprodeden = DB::table('progres_produksi')
				->select('progres_produksi.tgl_prod','sales_order.no_po_customer','spk.no_spk','customer.nama_customer','customer.pic','progres_produksi.lebar','progres_produksi.panjang','progres_produksi.kwalitas','progres_produksi.jumlah_sheet','progres_produksi.jumlah_box','progres_produksi.cor','progres_produksi.slitter','progres_produksi.pon','progres_produksi.coak','progres_produksi.print','progres_produksi.slotter','progres_produksi.lem','progres_produksi.kancing','progres_produksi.tgl_pengiriman','progres_produksi.coak','progres_produksi.no_inv','jml_kirim','progres_produksi.persentase','progres_produksi.laminasi','progres_produksi.kupas','progres_produksi.triple')
				->where('progres_produksi.tgl_prod','LIKE', '%2023%')
				->where('customer.pic','=', "DEDEN")
				->join('spk','progres_produksi.no_spk','spk.no_spk')
				->join('sales_order','spk.no_sales_order','sales_order.id_so')
				->join('customer','sales_order.id_customer','customer.id_customer')
				->get();
	 
		//dd($datapro);
		return view('production.progres_produksi.index', compact('datapro','dataproali','dataprogopar','dataproahmad','dataprodavid','dataprodeden'));
	}
	
    public function produksi_harian(){
		//$produksi_harian = ProgresIndividu::all();//->where('progres_individu_produksi.tgl_period','LIKE', '%2022%');
		$produksi_harian = DB::table('progres_individu_produksi')
		->where('progres_individu_produksi.tgl_period','LIKE', '%2022%')
		->get();
		//dd($produksi_harian);
		return view('production.produksi_harian.produksi_harian', compact('produksi_harian'));
	}
		
	public function create_progres_harian(){
		return view('production.progres_produksi.create_progress_harian');
	}

	public function create(){		
		return view('production.progres_produksi.create');
	}

	public function edit($id){
		$dataed = DB::table('progres_produksi')->where('no_spk',$id)->first();
		//dd($dataed);
		return view ('production.progres_produksi.edit',compact('dataed'));
    }

    public function store_progres_harian(Request $req){
		$data = $req->json()->all();	
		
		foreach($data as $dt){
		
			$lap_progres = new ProgresIndividu;
			$lap_progres->no_spk = $dt['no_spk'];
			$lap_progres->tgl_period = $dt['tgl_period'];
			$lap_progres->nama_operator = $dt['nama_operator'];
			$lap_progres->status_progres = $dt['status_progres'];
			$lap_progres->hasil = $dt['hasil'];
			$lap_progres->keterangan = $dt['keterangan'];
			$lap_progres->save();
			
			$daprod = DB::table('progres_produksi')
						->where('no_spk','=',$dt['no_spk'])
						->first();

			if($dt['status_progres'] == "cor"){
				
				if($daprod->cor == NULL){
					ProgresProduksi::where('no_spk', $dt['no_spk'])->update(['cor' => $dt['hasil']]);
				}else{
					ProgresProduksi::where('no_spk', $dt['no_spk'])->increment('cor', $dt['hasil']);
				}

				$daprod1 = DB::table('progres_produksi')
						->select('jumlah_sheet','cor')
						->where('no_spk','=',$dt['no_spk'])
						->first();
				ProgresProduksi::where('no_spk', $dt['no_spk'])->update(['persentase' => $daprod1->cor / $daprod1->jumlah_sheet * 100]);			
			}elseif ($dt['status_progres'] == "slitter") {
				if($daprod->slitter == NULL){
					ProgresProduksi::where('no_spk', $dt['no_spk'])->update(['slitter' => $dt['hasil']]);
				}else{
					ProgresProduksi::where('no_spk', $dt['no_spk'])->increment('slitter', $dt['hasil']);
				}
			}elseif ($dt['status_progres'] == "pon") {
				if($daprod->pon == NULL){
					ProgresProduksi::where('no_spk', $dt['no_spk'])->update(['pon' => $dt['hasil']]);
				}else{
					ProgresProduksi::where('no_spk', $dt['no_spk'])->increment('pon', $dt['hasil']);
				}
			}elseif ($dt['status_progres'] == "coak") {
				if($daprod->coak == NULL){
					ProgresProduksi::where('no_spk', $dt['no_spk'])->update(['coak' => $dt['hasil']]);
				}else{
					ProgresProduksi::where('no_spk', $dt['no_spk'])->increment('coak', $dt['hasil']);
				}
			}elseif ($dt['status_progres'] == "print") {
				if($daprod->print == NULL){
					ProgresProduksi::where('no_spk', $dt['no_spk'])->update(['print' => $dt['hasil']]);
				}else{
					ProgresProduksi::where('no_spk', $dt['no_spk'])->increment('print', $dt['hasil']);
				}
			}elseif ($dt['status_progres'] == "slotter") {
				if($daprod->slotter == NULL){
					ProgresProduksi::where('no_spk', $dt['no_spk'])->update(['slotter' => $dt['hasil']]);
				}else{
					ProgresProduksi::where('no_spk', $dt['no_spk'])->increment('slotter', $dt['hasil']);
				}
			}elseif ($dt['status_progres'] == "lem") {
				if($daprod->lem == NULL){
					ProgresProduksi::where('no_spk', $dt['no_spk'])->update(['lem' => $dt['hasil']]);
				}else{
					ProgresProduksi::where('no_spk', $dt['no_spk'])->increment('lem', $dt['hasil']);
				}
			}elseif ($dt['status_progres'] == "kancing") {
				if($daprod->kancing == NULL){
					ProgresProduksi::where('no_spk', $dt['no_spk'])->update(['kancing' => $dt['hasil']]);
				}else{
					ProgresProduksi::where('no_spk', $dt['no_spk'])->increment('kancing', $dt['hasil']);
				}
			}elseif ($dt['status_progres'] == "laminasi") {
				if($daprod->laminasi == NULL){
					ProgresProduksi::where('no_spk', $dt['no_spk'])->update(['laminasi' => $dt['hasil']]);
				}else{
					ProgresProduksi::where('no_spk', $dt['no_spk'])->increment('laminasi', $dt['hasil']);
				}
			}elseif ($dt['status_progres'] == "kupas") {
				if($daprod->kupas == NULL){
					ProgresProduksi::where('no_spk', $dt['no_spk'])->update(['kupas' => $dt['hasil']]);
				}else{
					ProgresProduksi::where('no_spk', $dt['no_spk'])->increment('kupas', $dt['hasil']);
				}
			}elseif ($dt['status_progres'] == "triple") {
				if($daprod->triple == NULL){
					ProgresProduksi::where('no_spk', $dt['no_spk'])->update(['triple' => $dt['hasil']]);
				}else{
					ProgresProduksi::where('no_spk', $dt['no_spk'])->increment('triple', $dt['hasil']);
				}
			}
			else{
				return response()->json(['status'=>' Tidak ada data progress yang di update !!!']);
			}
	
		}  
		
		return response()->json(['status'=>' Berhasil di simpan !!!']);     
	
    }

	
    public function store(Request $req){
		$data = $req->json()->all();	
		foreach($data as $dt){
		
			$progres = new ProgresProduksi;
			$progres->no_spk = $dt['no_spk'];
			$progres->tgl_prod = $dt['tgl_prod'];
			$progres->lebar = $dt['lebar'];
			$progres->panjang = $dt['panjang'];
			$progres->kwalitas = $dt['kualitas'];
			$progres->jumlah_sheet = $dt['jumlah_sheet'];
			$progres->jumlah_box = $dt['jumlah_box'];
			$progres->no_inv = $dt['no_inv'];
			$progres->tgl_pengiriman = $dt['tgl_pengiriman'];
			$progres->save();
			
		}  
		
		return response()->json(['status'=>' Berhasil di simpan !!!']);     
	
    }

    public function update(Request $req){
		DB::table('progres_produksi')->where('no_spk',$req->no_spk)->update([
			'tgl_prod' => $req->tgl_prod,
			'lebar' => $req->lebar,
			'panjang' => $req->panjang,
			'kwalitas' => $req->kwalitas,
			'jumlah_sheet' => $req->jumlah_sheet,
			'jumlah_box' => $req->jumlah_box,
			'cor' =>  $req->cor,
			'slitter' =>  $req->slitter,
			'pon' =>  $req->pon,
			'coak' =>  $req->coak,
			'print' =>  $req->print,
			'slotter' =>  $req->slotter,
			'lem' =>  $req->lem,
			'kancing' =>  $req->kancing,
			'laminasi' =>  $req->laminasi,
			'kupas' =>  $req->kupas,
			'triple' =>  $req->triple,
			'jml_kirim' => $req->jml_kirim,
			'no_inv' => $req->no_inv,
			'tgl_pengiriman' => $req->tgl_pengiriman,
		]);   
		return redirect ('/production/progres-produksi');
		
	}

	public function delete_progres($no_spk){
		DB::table('progres_produksi')->where('no_spk','=', $no_spk)->delete();
		return redirect('/production/progres-produksi');	
   	}

    public function get_no_spk(Request $request){
	
 	if ($request->has('q')) {
 	   $cari = $request->q;
	   $no_spk = DB::table('progres_produksi')->select('no_spk')->where('no_spk', 'LIKE', '%'.$cari.'%')->get();

           return response()->json($no_spk);
        }
        $no_spk = DB::table('progres_produksi')->select('no_spk')->get();

        return response()->json($no_spk);

    }
    public function edit_progres_harian($id){
	$data_progres_harian = DB::table('progres_individu_produksi')->where('id_lap_produksi', $id)->first();
	//dd($data_progres_harian);
	return  view('production.produksi_harian.produksi_harian_edit', compact('data_progres_harian'));
	}
	
	public function update_progres_harian(Request $req){
		$data_progres_harian = DB::table('progres_individu_produksi')->where('id_lap_produksi', $req->id_lap_produksi)->first();
		$new_hasil_produksi = $req->hasil;
		$old_hasil_produksi = $data_progres_harian->hasil;

		ProgresIndividu::where('id_lap_produksi', $req->id_lap_produksi)->update(['hasil' => $new_hasil_produksi]);
		if($new_hasil_produksi > $old_hasil_produksi){
			ProgresProduksi::where('no_spk', $req->no_spk)->increment($req->status_progres, $new_hasil_produksi - $old_hasil_produksi);
		}elseif($new_hasil_produksi < $old_hasil_produksi){
			ProgresProduksi::where('no_spk', $req->no_spk)->decrement($req->status_progres, $old_hasil_produksi - $new_hasil_produksi);
		}else{
			return redirect('/production/progres-produksi-harian');
		}
		return redirect('/production/progres-produksi-harian');
	}

    public function print_laporan_produksi(Request $req){
		$print_laporan = DB::table('progres_produksi')->whereBetween('tgl_prod', [$req->date_form, $req->date_to])->get();
		return view('production.progres_produksi.print_laporan', compact('print_laporan'));
    }

    public function export_excel(Request $request){
        return Excel::download(new ProgresProduksiExport($request->pic,$request->date_form, $request->date_to), 'Laporan Produksi '.$request->pic.' '.$request->date_form.'.xlsx');
    }
	
    public function export_COR(Request $request){
		return Excel::download(new ProgresCorExport($request->date_form, $request->date_to), 'ProgresCorProduksi.xlsx');
    }	

   
}
