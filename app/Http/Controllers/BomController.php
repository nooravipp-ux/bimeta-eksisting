<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Bom;
use App\DetailBom;
use App\barang;

class BomController extends Controller
{
    public function index(){
        $bom=Bom::all();
        // $bom = DB::table('bom')
        //         ->select('bom.id_bom','bom.deskripsi_material','barang.kode_barang')
        //         ->join('detail_bom','bom.id_bom','=','detail_bom.id_bom')
        //         ->join('barang','bom.kode_barang','=','barang.kode_barang')
        //         ->get();
                // dd($bom);
        return view('bom.index',compact('bom'));

    }

    public function create(){
        $no_urutbom = $this->get_auto_no();
        return view('bom.create',compact('no_urutbom'));
    }

    public function edit($id)
    {
        $bomedit = DB::table('bom')
                ->where('bom.id_bom', '=', $id)
                ->leftJoin('detail_bom', 'bom.id_bom', '=', 'detail_bom.id_bom')
                ->leftJoin('barang', 'barang.kode_barang', '=', 'detail_bom.kode_barang')
                ->select('bom.id_bom','bom.kode_barang','bom.deskripsi_material','detail_bom.id_bom','detail_bom.kode_barang','detail_bom.qty','barang.kode_barang','barang.tipe_barang','barang.nama_barang')
                ->get();

        $header = $bomedit->first();
        $detail = $bomedit;
        // dd($header);
        return view('bom.edit',compact('header','detail'));
    }


    public function update(Request $request)
    {

        $data = $request->json()->all();
        // var_dump($data);
        //$jason = json_decode($data);
        $data2 = json_decode(json_encode($data),true);
        // DetailBom::insert($data);
        foreach($data2 as $dt){
            if(array_key_exists('deskripsi_material',$dt)) {
                $png = Bom::find($dt['id_bom']);
                $png->id_bom = $dt['id_bom'];
                $png->kode_barang = $dt['kode_barang'];
                $png->deskripsi_material = $dt['deskripsi_material'];
                $png->save();
            }

        }

        foreach($data2 as $dt){
            if(array_key_exists('id_bom',$dt)) {
                $detail = DetailBom::where('id_bom',($dt['id_bom']));
                $detail->delete();
            }
        }

        foreach($data2 as $dt){
            if(array_key_exists('qty',$dt)) {
                $detail = new DetailBom;
                $detail->id_bom = $dt['id_bom'];
                $detail->kode_barang = $dt['kode_barang'];
                $detail->qty = $dt['qty'];
                $detail->save();


            }
        }

        return response()->json($data, 200);

        // return redirect('/pengadaans')->with('success', 'Pengadaan Updated!');
    }

    public function delete($id){
        $bomdelete1 = Bom::find($id);
        $bomdelete2 = DetailBom::find($id);
        $bomdelete1 -> delete($bomdelete1);
        $bomdelete2 -> delete($bomdelete2);
        return redirect('/bom')->with('sukses','data berhasil di hapus');
    }

    public function get_auto_no(){
        $AWAL = 'JRD';
        // karna array dimulai dari 0 maka kita tambah di awal data kosong
        // bisa juga mulai dari "1"=>"I"
        $bulanRomawi = array("", "I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
        $noUrutAkhir = DB::table('bom')->count();
        $no = 1;
        if($noUrutAkhir) {
            $no_urutbom = sprintf("%03s", abs($noUrutAkhir + 1)). '-BOM-' . $bulanRomawi[date('n')] .'-' . date('Y');
            return $no_urutbom;
        }
        else {
            $no_urutbom = sprintf("%03s", $no). '-BOM-' . $bulanRomawi[date('n')] .'-' . date('Y');
            return $no_urutbom;
        }
    }

    public function getkodebarang(){

        $bomkodebarang = DB::table('barang')->select('kode_barang','nama_barang','tipe_barang')->get();

        return response()->json($bomkodebarang);
    }





}
