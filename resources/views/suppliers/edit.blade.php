@extends('adminlte::page')

@section('content')
<div class="container">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <strong>EDIT DATA</strong> 
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('suppliers.update',$supplier->kode_supplier) }}">
 
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                    
 
                        <div class="form-group">
                            <label>kode Supplier</label>
                            <input type="text" name="kode_supplier" class="form-control" value=" {{ $supplier->kode_supplier }}" readonly required>
 
                            @if($errors->has('kode_supplier'))
                                <div class="text-danger">
                                    {{ $errors->first('kode_supplier')}}
                                </div>
                            @endif
 
                        </div>
 
                        <div class="form-group">
                            <label>Nama Supplier</label>
                            <input type="text" name="nama_supplier" class="form-control" value=" {{ $supplier->nama_supplier }}">
 
                             @if($errors->has('nama_supplier'))
                                <div class="text-danger">
                                    {{ $errors->first('nama_supplier')}}
                                </div>
                            @endif
 
                        </div>

                        <div class="form-group">
                            <label>Pic</label>
                            <input type="text" name="pic_supplier" class="form-control" value=" {{ $supplier->pic_supplier }}">
 
                             @if($errors->has('pic_supplier'))
                                <div class="text-danger">
                                    {{ $errors->first('pic_supplier')}}
                                </div>
                            @endif
 
                        </div>

                        <div class="form-group">
                            <label>Alamat Supplier</label>
                            <input type="text" name="alamat_supplier" class="form-control" value=" {{ $supplier->alamat_supplier }}">
 
                             @if($errors->has('alamat_supplier'))
                                <div class="text-danger">
                                    {{ $errors->first('alamat_supplier')}}
                                </div>
                            @endif
 
                        </div>

                        <div class="form-group">
                            <label>Telp Supplier</label>
                            <input type="text" name="telp_supplier" class="form-control" placeholder="Harga .." value=" {{ $supplier->telp_supplier }}">
 
                             @if($errors->has('telp_supplier'))
                                <div class="text-danger">
                                    {{ $errors->first('telp_supplier')}}
                                </div>
                            @endif
 
                        </div>

                        <div class="form-group">
                            <label>Top</label>
                            <input type="text" name="top" class="form-control" value=" {{ $supplier->top}}">
 
                             @if($errors->has('top'))
                                <div class="text-danger">
                                    {{ $errors->first('top')}}
                                </div>
                            @endif
 
                        </div>

                        <div class="form-group">
                            <label>Kota</label>
                            <input type="text" name="kota" class="form-control" value=" {{ $supplier->kota }}">
 
                             @if($errors->has('kota'))
                                <div class="text-danger">
                                    {{ $errors->first('kota')}}
                                </div>
                            @endif
 
                        </div>

                        <div class="form-group">
                            <label>Provinsi</label>
                            <input type="text" name="provinsi" class="form-control" value="{{ $supplier->provinsi }}">
 
                             @if($errors->has('provinsi'))
                                <div class="text-danger">
                                    {{ $errors->first('provinsi')}}
                                </div>
                            @endif
 
                        </div>
 
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Update">
                        </div>
 
                    </form>
 
                </div>
            </div>
        </div>
@endsection