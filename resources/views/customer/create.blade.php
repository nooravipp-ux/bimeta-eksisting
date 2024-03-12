@extends('adminlte::page')

@section('content')
<div class="container">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <strong>TAMBAH DATA</strong> 
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('customer.store') }}">
 
                        {{ csrf_field() }}
                    
 
                        <div class="form-group">
                            <label>ID Customer</label>
                            <input type="text" name="id_customer" class="form-control">
 
                            @if($errors->has('id_customer'))
                                <div class="text-danger">
                                    {{ $errors->first('id_customer')}}
                                </div>
                            @endif
 
                        </div>
 
                        <div class="form-group">
                            <label>Nama Customer</label>
                            <input type="text" name="nama_customer" class="form-control">
 
                             @if($errors->has('nama_customer'))
                                <div class="text-danger">
                                    {{ $errors->first=('nama_customer')}}
                                </div>
                            @endif
 
                        </div>

                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" name="alamat_customer" class="form-control">
 
                             @if($errors->has('alamat_customer'))
                                <div class="text-danger">
                                    {{ $errors->first('alamat_customer')}}
                                </div>
                            @endif
 
                        </div>

                        <div class="form-group">
                            <label>Kota</label>
                            <input type="text" name="kota" class="form-control">
 
                            @if($errors->has('kota'))
                                <div class="text-danger">
                                    {{ $errors->first('kota')}}
                                </div>
                            @endif
 
                        </div>

                        <div class="form-group">
                            <label>Provinsi</label>
                            <input type="text" name="provinsi" class="form-control">
 
                             @if($errors->has('provinsi'))
                                <div class="text-danger">
                                    {{ $errors->first('provinsi')}}
                                </div>
                            @endif
 
                        </div>

                        <div class="form-group">
                            <label>No Telp</label>
                            <input type="text" name="no_telp" class="form-control">
 
                             @if($errors->has('no_telp'))
                                <div class="text-danger">
                                    {{ $errors->first('no_telp')}}
                                </div>
                            @endif
 
                        </div>

                        <div class="form-group">
                            <label>PIC</label>
                            <input type="text" name="pic" class="form-control">
 
                             @if($errors->has('pic'))
                                <div class="text-danger">
                                    {{ $errors->first('pic')}}
                                </div>
                            @endif
 
                        </div>

                        <div class="form-group">
                            <label>Tipe Customer</label>
                            <input type="text" name="tipe_customer" class="form-control">
 
                             @if($errors->has('tipe_customer'))
                                <div class="text-danger">
                                    {{ $errors->first('tipe_customer')}}
                                </div>
                            @endif
 
                        </div>
                        <div class="form-group">
                            <label>Jenis Pajak</label>
                            <input type="text" name="tipe_customer" class="form-control">
 
                             @if($errors->has('tipe_pajak'))
                                <div class="text-danger">
                                    {{ $errors->first('tipe_pajak')}}
                                </div>
                            @endif
 
                        </div>
 
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Simpan">
                        </div>
 
                    </form>
 
                </div>
            </div>
        </div>
@endsection