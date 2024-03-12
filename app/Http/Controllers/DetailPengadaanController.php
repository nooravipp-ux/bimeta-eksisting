<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetailPengadaan;
use App\Pengadaan;

class DetailPengadaanController extends Controller
{
    public function storeDetailPengadaan(Request $request){
        $data = $request->json()->all();
         //$jason = json_decode($data);
         $data2 = json_decode(json_encode($data),true);
        
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
                $detail = new DetailPengadaan;
                $detail->kode_pembelian = $dt['kode_pembelian'];
                $detail->kode_barang = $dt['kode_barang'];
                $detail->qty = $dt['qty'];
                $detail->harga_satuan = $dt['harga_satuan'];

                $detail->save();

                
            }
        }

        return response()->json($data, 200);

        
    }

    
}
