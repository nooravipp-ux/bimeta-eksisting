@extends('adminlte::page')

@section('content')
<div class="container">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <strong>EDIT DATA</strong> 
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('customer.update',$customer->id_customer)}}">
 
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
 
                        <div class="form-group">
                            <label>Kode Customer</label>
                            <input type="text" name="id_customer" class="form-control" value="{{ $customer->id_customer }}">
 
                            @if($errors->has('id_customer'))
                                <div class="text-danger">
                                    {{ $errors->first('id_customer')}}
                                </div>
                            @endif
 
                        </div>
 
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama_customer" class="form-control" value="{{ $customer->nama_customer }}">
 
                             @if($errors->has('nama_customer'))
                                <div class="text-danger">
                                    {{ $errors->first=('nama_customer')}}
                                </div>
                            @endif
 
                        </div>

                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" name="alamat_customer" class="form-control" value="{{ $customer->alamat_customer}}">
 
                             @if($errors->has('alamat_customer'))
                                <div class="text-danger">
                                    {{ $errors->first('alamat_customer')}}
                                </div>
                            @endif
 
                        </div>

                        <div class="form-group">
                            <label>Kota</label>
                            <input type="text" name="kota" class="form-control" value="{{ $customer->kota}}">
 
                             @if($errors->has('kota'))
                                <div class="text-danger">
                                    {{ $errors->first('kota')}}
                                </div>
                            @endif
 
                        </div>

                        <div class="form-group">
                            <label>Provinsi</label>
                            <input type="text" name="provinsi" class="form-control" value="{{ $customer->provinsi}}">
 
                             @if($errors->has('provinsi'))
                                <div class="text-danger">
                                    {{ $errors->first('provinsi')}}
                                </div>
                            @endif
 
                        </div>

                        <div class="form-group">
                            <label>No Telp</label>
                            <input type="text" name="no_telp" class="form-control" value="{{ $customer->no_telp }}">
 
                             @if($errors->has('no_telp'))
                                <div class="text-danger">
                                    {{ $errors->first('no_telp')}}
                                </div>
                            @endif
 
                        </div>

                        <div class="form-group">
                            <label>PIC</label>
                            <input type="text" name="pic" class="form-control" value="{{ $customer->pic}}">
 
                             @if($errors->has('provinsi'))
                                <div class="text-danger">
                                    {{ $errors->first('pic')}}
                                </div>
                            @endif
 
                        </div>

                        <div class="form-group">
                            <label>Type Customer</label>
                            <input type="text" name="tipe_customer" class="form-control" value="{{ $customer->tipe_customer}}">
 
                             @if($errors->has('tipe_customer'))
                                <div class="text-danger">
                                    {{ $errors->first('tipe_customer')}}
                                </div>
                            @endif
 
                        </div>

                        <div class="form-group">
                            <label>Jenis Faktur</label>
                            <input type="text" name="tipe_pajak" class="form-control" value="{{ $customer->tipe_pajak}}">
 
                             @if($errors->has('tipe_pajak'))
                                <div class="text-danger">
                                    {{ $errors->first('tipe_pajak')}}
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