<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\MaterialRequest;
use App\DetailRequest;

class ReqController extends Controller
{
    public function index(){
        $data_req = MaterialRequest::all();
        return view('request.index',compact('data_req'));
    }

    public function create()
    {
        $no_urutreq = $this->get_auto_noreq();
        return view('request.create', compact('no_urutreq'));
    }
    public function get_auto_noreq(){
        $AWAL = 'JRD';
        // karna array dimulai dari 0 maka kita tambah di awal data kosong
        // bisa juga mulai dari "1"=>"I"
        $bulanRomawi = array("", "I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
        $noUrutAkhir = DB::table('material_request')->count();
        $no = 1;
        if($noUrutAkhir) {
            $no_urutreq = sprintf("%03s", abs($noUrutAkhir + 1)). '-REQ-' . $bulanRomawi[date('n')] .'-' . date('Y');
            return $no_urutreq;
        }
        else {
            $no_urutreq = sprintf("%03s", $no). '-REQ-' . $bulanRomawi[date('n')] .'-' . date('Y');
            return $no_urutreq;
        }
    }

    public function getKodeBarang(){

        $reqkodebarang = DB::table('barang')->select('kode_barang')->get();

        return response()->json($reqkodebarang);
    }


    public function edit($id)
    {
        $reqedit = DB::table('material_request')
                ->where('material_request.id_material_request', '=', $id)
                ->leftJoin('detail_material_request', 'material_request.id_material_request', '=', 'detail_material_request.id_material_request')
                ->leftJoin('barang', 'detail_material_request.kode_barang', '=', 'barang.kode_barang')
                ->select('material_request.*','detail_material_request.*','barang.*')
                ->get();

        $header = $reqedit->first();
        $detail = $reqedit;
        // dd($reqedit);
        return view('request.edit',compact('header','detail'));
    }

    public function update(Request $request)
    {

        $data = $request->json()->all();
        // var_dump($data);
        //$jason = json_decode($data);
        $data2 = json_decode(json_encode($data),true);
        // DetailBom::insert($data);
        foreach($data2 as $dt){
            if(array_key_exists('no_spk',$dt)) {
                $png = MaterialRequest::find($dt['id_material_request']);
                $png->id_material_request = $dt['id_material_request'];
                $png->tgl_material_request = $dt['tgl_material_request'];
                $png->peminta = $dt['peminta'];
                $png->no_spk = $dt['no_spk'];
                $png->save();
            }

        }

        foreach($data2 as $dt){
            if(array_key_exists('id_material_request',$dt)) {
                $detail = DetailRequest::where('id_material_request',($dt['id_material_request']));
                $detail->delete();
            }
        }

        foreach($data2 as $dt){
            if(array_key_exists('qty',$dt)) {
                $detail = new DetailRequest;
                $detail->id_material_request = $dt['id_material_request'];
                $detail->kode_barang = $dt['kode_barang'];
                $detail->qty = $dt['qty'];
                $detail->save();


            }
        }

        return response()->json($data, 200);

        // return redirect('/pengadaans')->with('success', 'Pengadaan Updated!');
    }

    public function delete($id){
        $reqdelete1 = MaterialRequest::find($id);
        $reqdelete2 = DetailRequest::find($id);
        $reqdelete1 -> delete($reqdelete1);
        $reqdelete2 -> delete($reqdelete2);
        return redirect('/request')->with('sukses','data berhasil di hapus');
    }
}
