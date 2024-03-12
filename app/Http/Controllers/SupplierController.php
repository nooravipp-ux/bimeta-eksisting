<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Supplier;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $suppliers = Supplier::all();

        return view('suppliers.index', ['suppliers' => $suppliers]);

    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $messages = [
            'unique'    => 'Gagal Menyimpan Data, :attribute '.$request->kode_supplier.' sudah digunakan !!!',
            'regex' => 'Kode barang hanya boleh menggunakan huruf, angka, spasi, -, atau _ ',
        ];
        $request->validate([
            'kode_supplier'=>'required|unique:supplier,kode_supplier|regex:/^[0-9A-Za-z.\-_ ]+$/',
            'nama_supplier'=>'required',
            'alamat_supplier'=>'required',
            'telp_supplier'=>'required',
            'top'=>'required',
            'kota'=>'required',
            'provinsi'=>'required'
        ],$messages);

        $supplier = new Supplier([
            'kode_supplier' => $request->get('kode_supplier'),
            'nama_supplier' => $request->get('nama_supplier'),
            'pic_supplier' => $request->get('pic_supplier'),
            'alamat_supplier' => $request->get('alamat_supplier'),
            'telp_supplier' => $request->get('telp_supplier'),
            'top' => $request->get('top'),
            'kota' => $request->get('kota'),
            'provinsi' => $request->get('provinsi')
        ]);        $supplier->save();
        return redirect('/suppliers')->with('success', 'Contact saved!');
    }

    public function edit($id)
    {
        $supplier = Supplier::find($id);

        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_supplier'=>'required',
            'nama_supplier'=>'required',
            'alamat_supplier'=>'required',
            'telp_supplier'=>'required',
            'top'=>'required',
            'kota'=>'required',
            'provinsi'=>'required'
        ]);

        $supplier = Supplier::find($id);
        $supplier->kode_supplier = $request->get('kode_supplier');
        $supplier->nama_supplier = $request->get('nama_supplier');
        $supplier->pic_supplier = $request->get('pic_supplier');
        $supplier->alamat_supplier = $request->get('alamat_supplier');
        $supplier->telp_supplier = $request->get('telp_supplier');
        $supplier->top = $request->get('top');
        $supplier->kota = $request->get('kota');
        $supplier->provinsi = $request->get('provinsi');

        $supplier->save();

        return redirect('/suppliers')->with('success', 'Contact Updated!');
    }

    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();

        return redirect('/suppliers')->with('success', 'suplier deleted!');
    }

    public function getIdSupplier(){

        $supplier = DB::table('supplier')->select('kode_supplier', 'nama_supplier')->get();

        return response()->json($supplier);
    }
}
