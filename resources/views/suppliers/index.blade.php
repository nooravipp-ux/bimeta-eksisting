@extends('adminlte::page')

@section('content')
<!-- Content Wrapper. Contains page content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
                <h4>
                     Data Supplier 
                </h4>
            </div>
      
            <!-- Form Input pengadaan-->
            <div class="invoice p-3 mb-3">
                <div class="row">
                    <div class="col-sm-4">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">Tambah Supplier</button>
                    
                    </div>
                    </div>
		<div class="row alert">
		    @if($errors->has('kode_supplier'))
                        <div class="alert alert-danger" role="alert">
                             {{ $errors->first('kode_supplier')}}
                         </div>
                    @endif
		</div>
                <table id="data_supplier" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Kode Supplier</th>
                                <th>Nama Supplier</th>
                                <th>PIC Supplier</th>
                                <th>Alamat</th>
                                <th>Telepon </th>
                                <th>Top</th>
                                <th>kota</th>
                                <th>Provinsi</th>
                                <th>Action</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($suppliers as $supplier)
                            <tr>
                                <td>{{ $supplier->kode_supplier }}</td>
                                <td>{{ $supplier->nama_supplier }}</td>
                                <td>{{ $supplier->pic_supplier }}</td>
                                <td>{{ $supplier->alamat_supplier }}</td>
                                <td>{{ $supplier->telp_supplier }}</td>
                                <td>{{ $supplier->top }}</td>
                                <td>{{ $supplier->kota }}</td>
                                <td>{{ $supplier->provinsi }}</td>
                                <td><a href="{{ route('suppliers.edit',$supplier->kode_supplier) }}" class="btn btn-warning btn-sm">Edit</a></td>
                                <td>
                                    <form action="{{ route('suppliers.destroy', $supplier->kode_supplier)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Yakin mau menghapus data')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Tambah supplier</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card mt-5">
                                <div class="card-body">
                                    <form method="post" action="{{ route('suppliers.store') }}">
                
                                        {{ csrf_field() }}
                                    
                
                                        <div class="form-group">
                                            <label>Kode Supplier</label>
                                            <input type="text" name="kode_supplier" class="form-control" required>
                
                                            @if($errors->has('kode_supplier'))
                                                <div class="text-danger">
                                                    {{ $errors->first('kode_supplier')}}
                                                </div>
                                            @endif
                
                                        </div>
                
                                        <div class="form-group">
                                            <label>Nama Supplier</label>
                                            <input type="text" name="nama_supplier" class="form-control" required>
                
                                            @if($errors->has('nama_supplier'))
                                                <div class="text-danger">
                                                    {{ $errors->first=('nama_supplier')}}
                                                </div>
                                            @endif
                
                                        </div>

                                        <div class="form-group">
                                            <label>Pic Supplier</label>
                                            <input type="text" name="pic_supplier" class="form-control" required>
                
                                            @if($errors->has('pic_supplier'))
                                                <div class="text-danger">
                                                    {{ $errors->first('pic_supplier')}}
                                                </div>
                                            @endif
                
                                        </div>

                                        <div class="form-group">
                                            <label>Alamat Supplier</label>
                                            <input type="text" name="alamat_supplier" class="form-control" required>
                
                                            @if($errors->has('alamat_supplier'))
                                                <div class="text-danger">
                                                    {{ $errors->first('alamat_supplier')}}
                                                </div>
                                            @endif
                
                                        </div>

                                        <div class="form-group">
                                            <label>Telepon </label>
                                            <input type="text" name="telp_supplier" class="form-control" required>
                
                                            @if($errors->has('telp_supplier'))
                                                <div class="text-danger">
                                                    {{ $errors->first('telp_supplier')}}
                                                </div>
                                            @endif
                
                                        </div>

                                        <div class="form-group">
                                            <label>Top </label>
                                            <input type="text" name="top" class="form-control" required>
                
                                            @if($errors->has('top'))
                                                <div class="text-danger">
                                                    {{ $errors->first('top')}}
                                                </div>
                                            @endif
                
                                        </div>

                                        <div class="form-group">
                                            <label>Kota </label>
                                            <input type="text" name="kota" class="form-control" required>
                
                                            @if($errors->has('kota'))
                                                <div class="text-danger">
                                                    {{ $errors->first('kota')}}
                                                </div>
                                            @endif
                
                                        </div>

                                        <div class="form-group">
                                            <label>Provinsi </label>
                                            <input type="text" name="provinsi" class="form-control" required>
                
                                            @if($errors->has('provinsi'))
                                                <div class="text-danger">
                                                    {{ $errors->first('provinsi')}}
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
        $('#data_supplier').DataTable();
    </script>

@endsection