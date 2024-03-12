@extends('adminlte::page')

@section('content')
<!-- Content Wrapper. Contains page content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
                <h4>
                     Data Barang 
                </h4>
            </div>
      
            <!-- Form Input pengadaan-->
            <div class="invoice p-3 mb-3">
                <div class="row">
                    <div class="col-sm-6">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Finish Goods</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Raw Material</a>
                                <a class="nav-item nav-link" id="nav-profile2-tab" data-toggle="tab" href="#nav-profile2" role="tab" aria-controls="nav-profile2" aria-selected="false">Intermediate Goods</a>
                            </div>
                        </nav>
                    <br/>
                    </div>
                    <div class="col-sm-6 text-right">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">Tambah Barang</button>
                    </div>
                </div>
		<div class="row">
      			@if($errors->has('kode_barang'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('kode_barang')}}
                            </div>
                        @endif

                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <!-- DATA MASTER BARANG -->
                                <table id="data_barang_fg" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
					                        <th>Ukuran</th>
                                            <th>Tipe Barang</th>
                                            <th>Satuan</th>
                                            <th>Harga</th>
                                            <th>Spesifikasi</th>
                                            <th>Action</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($barang_fg as $barang)
                                        <tr>
                                            <td>{{ $barang->kode_barang }}</td>
                                            <td>{{ $barang->nama_barang }}</td>
		                            <td>{{$barang->ukuran}}</td>
                                            <td>{{ $barang->tipe_barang }}</td>
                                            <td>{{ $barang->satuan }}</td>
                                            <td>{{ $barang->harga }}</td>
                                            <td>{{ $barang->spesifikasi_barang}}</td>
                                            <td><a href="{{ route('barang.edit',$barang->kode_barang) }}" class="btn btn-warning btn-sm">Edit</a></td>
                                            <td>
                                                <form action="{{ route('barang.destroy', $barang->kode_barang)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Yakin mau menghapus data')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <!-- DATA MASTER BARANG -->
                                <table id="data_barang_rw" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Kode Barang</th>
		                            <th>Nama Barang</th>
		                            <th>Ukuran</th>
                                            <th>Tipe Barang</th>
                                            <th>Satuan</th>
                                            <th>Harga</th>
                                            <th>Spesifikasi</th>
                                            <th>Action</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($barang_rw as $barang)
                                        <tr>
                                            <td>{{ $barang->kode_barang }}</td>
                                            <td>{{ $barang->nama_barang }}</td>
		                            <td>{{ $barang->ukuran}}</td>
                                            <td>{{ $barang->tipe_barang }}</td>
                                            <td>{{ $barang->satuan }}</td>
                                            <td>{{ $barang->harga }}</td>
                                            <td>{{ $barang->spesifikasi_barang}}</td>
                                            <td><a href="{{ route('barang.edit',$barang->kode_barang) }}" class="btn btn-warning btn-sm">Edit</a></td>
                                            <td>
                                                <form action="{{ route('barang.destroy', $barang->kode_barang)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Yakin mau menghapus data')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="nav-profile2" role="tabpanel" aria-labelledby="nav-profile2-tab">
                                <!-- DATA MASTER BARANG -->
                                <table id="data_barang_ig" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Kode Barang</th>
		                                    <th>Nama Barang</th>
		                                    <th>Ukuran</th>
                                            <th>Tipe Barang</th>
                                            <th>Satuan</th>
                                            <th>Harga</th>
                                            <th>Spesifikasi</th>
                                            <th>Action</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($barang_ig as $barang)
                                        <tr>
                                            <td>{{ $barang->kode_barang }}</td>
                                            <td>{{ $barang->nama_barang }}</td>
		                                    <td>{{ $barang->ukuran}}</td>
                                            <td>{{ $barang->tipe_barang }}</td>
                                            <td>{{ $barang->satuan }}</td>
                                            <td>{{ $barang->harga }}</td>
                                            <td>{{ $barang->spesifikasi_barang}}</td>
                                            <td><a href="{{ route('barang.edit',$barang->kode_barang) }}" class="btn btn-warning btn-sm">Edit</a></td>
                                            <td>
                                                <form action="{{ route('barang.destroy', $barang->kode_barang)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Yakin mau menghapus data')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Barang</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="card mt-5">
                    
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
                           			                <label>Ukuran</label>
                                                   <input type="text" name="ukuran" class="form-control" required>
                                                    <!-- <table style="text-align: center; font-weight: bold">
                                                        <tr>
                                                            <td style="width: 78px;">
                                                            Panjang
                                                            </td>
                                                            <td style="width: 78px;">
                                                            </td>
                                                            <td style="width: 78px;">
                                                            Lebar
                                                            </td>
                                                            <td style="width: 78px;">
                                                            </td>
                                                            <td style="width: 78px;">
                                                            Tinggi
                                                            </td>
                                                            <td style="width: 78px;">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                            <input type="text" name="panjang" class="form-control">
                                                            </td>
                                                            <td>
                                                             x 
                                                            </td>
                                                            <td>
                                                            <input type="text" name="lebar" class="form-control">
                                                            </td>
                                                            <td>
                                                             x 
                                                            </td>
                                                            <td>
                                                            <input type="text" name="tinggi" class="form-control">
                                                            </td>
                                                            <td>
                                                            CM
                                                            </td>
                                                        </tr>
                                                    </table> -->
                                                    @if($errors->has('ukuran'))
                                                   <div class="text-danger">
                                                      {{ $errors->first('ukuran')}}
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
                                                    <select name="satuan" class="form-control">
                                                        <option value="BOX">BOX</option>
                                                        <option value="SHEET">SHEET</option>
                                                        <option value="KG">KG</option>
                                                        <option value="M">M</option>
                                                        <option value="CM">CM</option>
                                                        <option value="INC">INC</option>
                                                        <option value="ROLL">ROLL</option>
                                                    </select>
                        
                                                    @if($errors->has('satuan'))
                                                        <div class="text-danger">
                                                            {{ $errors->first('satuan')}}
                                                        </div>
                                                    @endif
                        
                                                </div>

                                                <div class="form-group">
                                                    <label>Harga</label>
                                                    <input type="text" name="harga" class="form-control" value="0">
                        
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
                            
                            </div>
                        </div>
                    </div>

            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div>  
            
@endsection

@section('plugin_js')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $('#data_barang_fg').DataTable();
	    $('#data_barang_rw').DataTable();
        $('#data_barang_ig').DataTable();

    </script>

@endsection
