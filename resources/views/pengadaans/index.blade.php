@extends('adminlte::page')

@section('content')
<!-- Content Wrapper. Contains page content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
                <h4>
                     Data Pengadaan  
                </h4>
            </div>
      
            <!-- Form Input pengadaan-->
            <div class="invoice p-3 mb-3">
                <div class="row">
                    <div class="col-sm-4">
                        <a href="{{ route('pengadaans.create') }}" class="btn btn-primary">Buat Pengadaan</a>
                        <br>
                        <br>
                    </div>
                    <div class="col-sm">
                    
                    </div>
                </div>
                <table id="data_pengadaan" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>ID Pengadaan</th>
                        <th>Kode Supplier</th>
                        <th>Nama Supplier</th>
                        <th>Tgl Pembelian</th>
                        <th>Status</th>
                        <th>Pajak</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengadaan as $pengadaan)
                    <tr>
                        <td>{{ $pengadaan->id_pengadaan }}</td>
                        <td>{{ $pengadaan->kode_supplier }}</td>
                        <td>{{ $pengadaan->nama_supplier }}</td>
                        <td>{{ $pengadaan->tgl_pembelian }}</td>
                        <td>{{ $pengadaan->status }}</td>
                        <td>{{ $pengadaan->pajak }}</td>
                        <td><a href="{{ route('pengadaans.edit',$pengadaan->id_pengadaan) }}" class="btn btn-warning btn-sm">Edit</a>
                        <a href="{{ route('pengadaans.show',$pengadaan->id_pengadaan) }}" class="btn btn-info btn-sm">Print P.O</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div>  
            
@endsection

@section('plugin_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $('#data_pengadaan').DataTable();
    </script>
@endsection


