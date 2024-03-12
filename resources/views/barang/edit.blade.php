@extends('adminlte::page')

@section('content')
<div class="container">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <strong>EDIT DATA</strong> 
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('barang.update',$barang->kode_barang) }}">
 
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                    
 
                        <div class="form-group row">
                            <label>Kode Barang</label>
                            <input type="text" name="kode_barang" class="form-control" value=" {{ $barang->kode_barang }}" readonly>
 
                            @if($errors->has('kode_barang'))
                                <div class="text-danger">
                                    {{ $errors->first('kode_barang')}}
                                </div>
                            @endif
 
                        </div>
 
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control" value="{{ $barang->nama_barang }}">
 
                             @if($errors->has('nama_barang'))
                                <div class="text-danger">
                                    {{ $errors->first('nama_barang')}}
                                </div>
                            @endif
 
                        </div>
			<div class="form-group">
                           <label>Ukuran</label>
                           <input type="text" name="ukuran" class="form-control" value="{{ $barang->ukuran }}" required>
                        
                               @if($errors->has('ukuran'))
                               <div class="text-danger">
                                     {{ $errors->first('ukuran')}}
                               </div>
                               @endif
                        
                        </div>


                        <div class="form-group">
                            <label>Type Barang</label>
                            <select name="tipe_barang" class="form-control">
                                <option value="FG" <?php if ($barang->tipe_barang == 'FG') echo "selected"; ?>>FG</option>
                                <option value="RW" <?php if ($barang->tipe_barang == 'RW') echo "selected"; ?>>RW</option>
                                <option value="IG" <?php if ($barang->tipe_barang == 'IG') echo "selected"; ?>>IG</option>
                            </select>

                             @if($errors->has('tipe_barang'))
                                <div class="text-danger">
                                    {{ $errors->first('tipe_barang')}}
                                </div>
                            @endif
 
                        </div>

                        <div class="form-group">
                            <label>Satuan</label>
                         
 			    <select name="satuan" class="form-control">
                                 <option value="BOX" <?php if ($barang->satuan == 'BOX') echo "selected"; ?>>BOX</option>
                                 <option value="SHEET" <?php if ($barang->satuan == 'SHEET') echo "selected"; ?>>SHEET</option>
                                 <option value="KG" <?php if ($barang->satuan == 'KG') echo "selected"; ?>>KG</option>
                                 <option value="M" <?php if ($barang->satuan == 'M') echo "selected"; ?>>M</option>
                                 <option value="CM" <?php if ($barang->satuan == 'CM') echo "selected"; ?>>CM</option>
                                 <option value="INC" <?php if ($barang->satuan == 'INC') echo "selected"; ?>>INC</option>
                                 <option value="ROLL" <?php if ($barang->satuan == 'ROLL') echo "selected"; ?>>ROLL</option>
                             </select>

                             @if($errors->has('satuan'))
                                <div class="text-danger">
                                    {{ $errors->first('satuan')}}
                                </div>
                            @endif
 
                        </div>

                        <div class="form-group">
                            <label>Harga</label>
                            <input type="text" name="harga" class="form-control" value=" {{ $barang->harga }}">
 
                             @if($errors->has('harga'))
                                <div class="text-danger">
                                    {{ $errors->first('harga')}}
                                </div>
                            @endif
 
                        </div>

                        <div class="form-group">
                            <label>Spesifikasi </label>
                            <input type="text" name="spesifikasi_barang" class="form-control" value="{{ $barang->spesifikasi_barang}}">
 
                             @if($errors->has('spesifikasi_barang'))
                                <div class="text-danger">
                                    {{ $errors->first('spesifikasi_barang')}}
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