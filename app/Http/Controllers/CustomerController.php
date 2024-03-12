<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Customer;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $customer = Customer::all();

        return view('customer.index', ['customer' => $customer]);

    }

    public function create()
    {
        return view('customer.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'id_customer'=>'required|unique:customer,id_customer',
            'nama_customer'=>'required',
            'alamat_customer'=>'required',
            'kota'=>'required',
            'provinsi'=>'required',
            'no_telp'=>'required|numeric',
            'pic'=>'required',
            'tipe_pajak' => 'required'
        ]);

        $customer = new Customer([
            'id_customer' => $request->get('id_customer'),
            'nama_customer' => $request->get('nama_customer'),
            'alamat_customer' => $request->get('alamat_customer'),
            'kota' => $request->get('kota'),
            'provinsi' => $request->get('provinsi'),
            'no_telp' => $request->get('no_telp'),
            'pic' => $request->get('pic'),
            'tipe_customer' => $request->get('tipe_customer'),
            'tipe_pajak' => $request->get('tipe_pajak')
        ]);
        $customer->save();
        return redirect('/customer')->with('success', 'customer saved!');
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
            'tipe_customer' => 'required',
            'tipe_pajak' => 'required'
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
        $customer->tipe_pajak = $request->get('tipe_pajak');

        $customer->save();

        return redirect('/customer')->with('success', 'customer Updated!');
	
    }

    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();

        return redirect('/customer')->with('success', 'customer deleted!');
    }

    public function getIdCustomer(Request $request){
	if($request->has('q')){
	    $cari = $request->q;
	    $customer = DB::table('customer')->select('id_customer', 'nama_customer','tipe_pajak')->where('nama_customer', 'LIKE', '%'.$cari.'%')->get();
	    return response()->json($customer);
        }
	$customer = DB::table('customer')->select('id_customer', 'nama_customer','tipe_pajak')->get(); 
        return response()->json($customer);

    }
}
