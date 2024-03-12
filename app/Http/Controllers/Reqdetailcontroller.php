<?php

namespace App\Http\Controllers;
use App\MaterialRequest;
use App\DetailRequest;
use Illuminate\Http\Request;

class Reqdetailcontroller extends Controller
{
    public function storeDetail(Request $request){
        $data = $request->json()->all();
         //$jason = json_decode($data);
         $data2 = json_decode(json_encode($data),true);

        // DetailPengadaan::insert($data);
        foreach($data2 as $dt){
            if(array_key_exists('no_spk',$dt)) {
                $png = new MaterialRequest;
                $png->id_material_request = $dt['id_material_request'];
                $png->tgl_material_request = $dt['tgl_material_request'];
                $png->peminta = $dt['peminta'];
                $png->no_spk = $dt['no_spk'];
                $png->save();
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

    }
}
