@extends('adminlte::page')

@section('content')
<!-- Content Wrapper. Contains page content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
                <h4>
                     Data Stock  
                </h4>
            </div>
      
            <!-- Form Input pengadaan-->
            <div class="invoice p-3 mb-3">
                <div class="row">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Finish Goods</a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Raw Materials</a>
                            <a class="nav-item nav-link" id="nav-profile2-tab" data-toggle="tab" href="#nav-profile2" role="tab" aria-controls="nav-profile2" aria-selected="false">Intermediate Goods</a>
                        </div>
                    </nav>
                </div>
                <br><br>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <table id="data_pengadaan_FG" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>KODE BARANG</th>
                                    <th>NAMA BARANG</th>
                                    <th>QTY</th>
                                    <th>UKURAN</th>
                                    <th>TGL MASUK</th>
                                    <th>REFERENCES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data_stock_FG as $stock)
                                <tr>
                                    <td>{{ $stock->kode_barang}}</td>
                                    <td>{{$stock->nama_barang}}</td>
                                    <td>{{ $stock->qty}}</td>
                                    <td>{{ $stock->ukuran}}</td>
                                    <td>{{ $stock->tgl_masuk}}</td>
                                    <td>{{ $stock->references}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <table id="data_pengadaan_RW" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>KODE BARANG</th>
                                    <th>NAMA BARANG</th>
                                    <th>QTY</th>
                                    <th>UKURAN</th>
                                    <th>TGL MASUK</th>
                                    <th>REFERENCES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data_stock_RW as $stock)
                                <tr>
                                    <td>{{ $stock->kode_barang}}</td>
                                    <td>{{$stock->nama_barang}}</td>
                                    <td>{{ $stock->qty}}</td>
                                    <td>{{ $stock->ukuran}}</td>
                                    <td>{{ $stock->tgl_masuk}}</td>
                                    <td>{{ $stock->references}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="nav-profile2" role="tabpanel" aria-labelledby="nav-profile2-tab">
                        <table id="data_pengadaan_IG" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>KODE BARANG</th>
                                    <th>NAMA BARANG</th>
                                    <th>QTY</th>
                                    <th>UKURAN</th>
                                    <th>TGL MASUK</th>
                                    <th>REFERENCES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data_stock_IG as $stock)
                                <tr>
                                    <td>{{ $stock->kode_barang}}</td>
                                    <td>{{$stock->nama_barang}}</td>
                                    <td>{{ $stock->qty}}</td>
                                    <td>{{ $stock->ukuran}}</td>
                                    <td>{{ $stock->tgl_masuk}}</td>
                                    <td>{{ $stock->references}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div>  
            
@endsection

@section('plugin_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $('#data_pengadaan_FG').DataTable();
        $('#data_pengadaan_RW').DataTable();
        $('#data_pengadaan_IG').DataTable();
    </script>
@endsection


