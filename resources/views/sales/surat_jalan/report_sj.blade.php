@extends('adminlte::page')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
                <h4>
                    Data Report Pengiriman
                    <div class="msg"></div>
                </h4>
            </div>
            <div class="invoice p-3 mb-3">
                <div class="row">
                    <div class="col-sm-12">
			            <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">REPORT SURAT JALAN KECIL</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">REPORT SURAT JALAN BESAR</a>
                            </div>
                        </nav><br>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
				                <table id="data_surat_jalan_besar" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
					                        <th>TGL KIRIM</th>
                                            <th>NO SJ</th>
                                            <th>PESANAN </th>
                                            <th>NO PO</th>
                                            <th>NO SPK</th>
                                            <th>UKURAN JENIS</th>
                                            <th>QTY</th>
                                            <th>BIAYA</th>
                                            <th>HARGA</th>
                                            <th>JUMLAH TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
					@foreach($data_report as $dt)
                                        <tr>
					    <td>{{$dt->tgl_surat_jalan}}</td>
                                            <td>{{$dt->no_surat_jalan}}</td>
                                            <td>{{$dt->nama_customer}}</td>
                                            <td>{{$dt->no_po_customer}}</td>
                                            <td>{{$dt->no_spk}}</td>
                                            <td>{{$dt->ukuran}} {{$dt->spesifikasi_barang}}</td>
                                            <td>{{$dt->qty}}</td>
                                            <td></td>
                                            <td>{{$dt->harga_satuan}}</td>
                                            <td></td>
                                       </tr>
                                       @endforeach
                                    </tbody>
                                </table>
			    </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
			    	<table id="data_surat_jalan_kecil" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>TGL KIRIM</th>
                                            <th>NO SJ</th>
                                            <th>PESANAN </th>
                                            <th>NO PO</th>
                                            <th>NO SPK</th>
                                            <th>UKURAN JENIS</th>
                                            <th>QTY</th>
                                            <th>BIAYA</th>
                                            <th>HARGA</th>
                                            <th>JUMLAH TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data_report2 as $dt)
                                        <tr>
					    <td>{{$dt->tgl_surat_jalan}}</td>
                                            <td>{{$dt->no_surat_jalan}}</td>
                                            <td>{{$dt->nama_customer}}</td>
                                            <td>{{$dt->no_po_customer}}</td>
                                            <td>{{$dt->no_spk}}</td>
                                            <td>{{$dt->ukuran}} {{$dt->spesifikasi_barang}}</td>
                                            <td>{{$dt->qty}}</td>
                                            <td></td>
                                            <td>{{$dt->harga_satuan}}</td>
                                            <td></td>
                                       </tr>
                                       @endforeach
                                   </tbody>
                                </table>

	                    </div>
                        </div>
                        
                    </div>
                  </div>
               </div
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div>  
@endsection   

@section('plugin_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
<script>
                
        $('#data_surat_jalan_besar').DataTable({
            dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
        });
	$('#data_surat_jalan_kecil').DataTable({
        dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
        });

    </script>

    

@endsection



