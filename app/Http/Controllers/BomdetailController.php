<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetailBom;
use App\Bom;

class BomdetailController extends Controller
{
    public function storeDetailBom(Request $request){
        $data = $request->json()->all();
         //$jason = json_decode($data);
         $data2 = json_decode(json_encode($data),true);

        foreach($data2 as $dt){
            if(array_key_exists('deskripsi_material',$dt)) {
                $png = new Bom;
                $png->id_bom = $dt['id_bom'];
                $png->kode_barang = $dt['kode_barang'];
                $png->deskripsi_material = $dt['deskripsi_material'];
                $png->save();
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


    }


}
