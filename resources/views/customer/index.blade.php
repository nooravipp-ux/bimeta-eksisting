@extends('adminlte::page')

@section('content')
<!-- Content Wrapper. Contains page content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
                <h4>
                    Data Customer 
                    <div class="msg"></div>
                </h4>
            </div>
      
            <!-- Form Input pengadaan-->
            <div class="invoice p-3 mb-3">
                <div class="row">
                    <div class="col-sm-6">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">Tambah Customer</button>
                    <br/>
                    <br/>
                    </div>
                    <div class="col-sm-6">
                        
                    </div>
                </div>
                <!-- Master Data Customer -->
                <table id="data_customer" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>ID Customer</th>
                                <th>Nama </th>
                                <th>Alamat</th>
                                <th>Kota</th>
                                <th>Provinsi</th>
                                <th>No Telp</th>
                                <th>PIC</th>
                                <th>tipe Customer</th>
				<th>Tipe Pajak</th>
                                <th>Action</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customer as $pelanggan)
                            <tr>
                                <td>{{ $pelanggan->id_customer }}</td>
                                <td>{{ $pelanggan->nama_customer }}</td>
                                <td>{{ $pelanggan->alamat_customer }}</td>
                                <td>{{ $pelanggan->kota }}</td>
                                <td>{{ $pelanggan->provinsi}}</td>
                                <td>{{ $pelanggan->no_telp}}</td>
                                <td>{{ $pelanggan->pic }}</td>
                                <td>{{ $pelanggan->tipe_customer}}</td>
				<td>{{ $pelanggan->tipe_pajak}}</td>
                                <td><a href="{{ route('customer.edit',$pelanggan->id_customer) }}" class="btn btn-warning btn-sm">Edit</a></td>
                                <td>
                                    <form action="{{ route('customer.destroy', $pelanggan->id_customer)}}" method="post">
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
                                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Customer</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="card mt-5">
                                        <div class="card-body">
                                            <form method="post" action="{{ route('customer.store') }}">

                                                {{ csrf_field() }}


                                                <div class="form-group">
                                                    <label>ID Customer</label>
                                                    <input type="text" name="id_customer" class="form-control" required>

                                                    @if($errors->has('id_customer'))
                                                        <div class="text-danger">
                                                            {{ $errors->first('id_customer')}}
                                                        </div>
                                                    @endif

                                                </div>

                                                <div class="form-group">
                                                    <label>Nama Customer</label>
                                                    <input type="text" name="nama_customer" class="form-control" required>

                                                    @if($errors->has('nama_customer'))
                                                        <div class="text-danger">
                                                            {{ $errors->first=('nama_customer')}}
                                                        </div>
                                                    @endif

                                                </div>

                                                <div class="form-group">
                                                    <label>Alamat</label>
                                                    <input type="text" name="alamat_customer" class="form-control" required>

                                                    @if($errors->has('alamat_customer'))
                                                        <div class="text-danger">
                                                            {{ $errors->first('alamat_customer')}}
                                                        </div>
                                                    @endif

                                                </div>

                                                <div class="form-group">
                                                    <label>Kota</label>
                                                    <input type="text" name="kota" class="form-control" required>

                                                    @if($errors->has('kota'))
                                                        <div class="text-danger">
                                                            {{ $errors->first('kota')}}
                                                        </div>
                                                    @endif

                                                </div>

                                                <div class="form-group">
                                                    <label>Provinsi</label>
                                                    <input type="text" name="provinsi" class="form-control" required>

                                                    @if($errors->has('provinsi'))
                                                        <div class="text-danger">
                                                            {{ $errors->first('provinsi')}}
                                                        </div>
                                                    @endif

                                                </div>

                                                <div class="form-group">
                                                    <label>No Telp</label>
                                                    <input type="text" name="no_telp" class="form-control" required>

                                                    @if($errors->has('no_telp'))
                                                        <div class="text-danger">
                                                            {{ $errors->first('no_telp')}}
                                                        </div>
                                                    @endif

                                                </div>

                                                <div class="form-group">
                                                    <label>PIC</label>
                                                    <input type="text" name="pic" class="form-control" required>

                                                    @if($errors->has('pic'))
                                                        <div class="text-danger">
                                                            {{ $errors->first('pic')}}
                                                        </div>
                                                    @endif

                                                </div>

                                                <div class="form-group">
                                                    <label>Tipe Pajak</label>
                                                    <select name="tipe_pajak" class="form-control">
							<option value="V0">V0</option>
							<option value="V1">V1</option>
							<option value="V2">V2</option>
						    </select>

                                                    @if($errors->has('tipe_customer'))
                                                        <div class="text-danger">
                                                            {{ $errors->first('tipe_customer')}}
                                                        </div>
                                                    @endif

                                                </div>

                                                <div class="form-group">
                                                    <input type="submit" class="btn btn-success" value="Simpan" required>
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
        $('#data_customer').DataTable();
    </script>

@endsection

