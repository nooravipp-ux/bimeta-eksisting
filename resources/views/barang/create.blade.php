@extends('adminlte::page')

@section('content')
<div class="container">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <strong>TAMBAH DATA</strong> 
                </div>
                <div class="card-body">
                    <form method="post" action="{{action('BarangController@store')}}">
 
                        {{ csrf_field() }}
                    
 
                        <div class="form-group">
                            <label>Kode Barang</label>
                            <input type="text" name="kode_barang" class="form-control" required>
 
                            @if($errors->has('kode_barang'))
                                <div class="text-danger">
                                    {{ $errors->first('kode_barang')}}
                                </div>
                            @endif
 
                        </div>
 
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control" required>
 
                             @if($errors->has('nama_barang'))
                                <div class="text-danger">
                                    {{ $errors->first('nama_barang')}}
                                </div>
                            @endif
 
                        </div>

                        <div class="form-group">
                            <label>Type Barang</label>
                            <select name="tipe_barang" class="form-control">
                                <option value="FG">FG</option>
                                <option value="RW">RW</option>
                                <option value="IG">IG</option>
                            </select>
 
                             @if($errors->has('tipe_barang'))
                                <div class="text-danger">
                                    {{ $errors->first('tipe_barang')}}
                                </div>
                            @endif
 
                        </div>

                        <div class="form-group">
                            <label>Satuan</label>
                            <input type="text" name="satuan" class="form-control" required>
 
                             @if($errors->has('satuan'))
                                <div class="text-danger">
                                    {{ $errors->first('satuan')}}
                                </div>
                            @endif
 
                        </div>

                        <div class="form-group">
                            <label>Harga</label>
                            <input type="text" name="harga" class="form-control" required>
 
                             @if($errors->has('harga'))
                                <div class="text-danger">
                                    {{ $errors->first('harga')}}
                                </div>
                            @endif
 
                        </div>

                        <div class="form-group">
                            <label>Spesifikasi </label>
                            <input type="text" name="spesifikasi_barang" class="form-control" required>
 
                             @if($errors->has('spesifikasi_barang'))
                                <div class="text-danger">
                                    {{ $errors->first('spesifikasi_barang')}}
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