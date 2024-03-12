@extends('adminlte::page')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
                <h4>
                    Data Surat Jalan 
                    <div class="msg"></div>
                </h4>
            </div>
            <div class="invoice p-3 mb-3">
                <!--<div class="row">
                            <div class="col-sm-7">
                            <form action="{{ route('spk.batal') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">NO SURAT JALAN</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" id="no_surat_jalan" name="no_surat_jalan" required></select>
                                    </div>
                                    <button type="button" class="col-sm-2 col-form-label btn btn-danger btn-sm" id="btn-batal">BATAL</button>
                                </div>
                            </form>
                            </div>
                </div>-->
                <div class="row">
                    <div class="col-sm-12">
			            <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">SURAT JALAN BESAR</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">SURAT JALAN KECIL</a>
				                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-sj-sample" role="tab" aria-controls="nav-sj-sample" aria-selected="false">SURAT JALAN SAMPLE</a>
                            </div>
                        </nav>
                        
                        <!--<h6 style="text-align:right;color:red;"><i>*untuk mencari SJ Kecil terakhir, ketik K22</i></h6>-->
                        <br>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
				                <table id="data_surat_jalan_besar" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>NO SURAT JALAN</th>
                                            <th>NO P.O </th>
                                            <th>TGL SJ</th>
                                            <th>SUPIR</th>
                                            <th>NO KENDARAAN</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($dt_sj_besar as $dt)
                                        <tr>
                                            <td>{{$dt->no_surat_jalan}}</td>
                                            <td>{{$dt->no_po_customer}}</td>
                                            <td>{{date("d/m/Y",strtotime($dt->tgl_surat_jalan))}}</td>
                                            <td>{{$dt->supir}}</td>
                                            <td>{{$dt->plat_nomor}}</td>
                                            <td>
                                                <a href="{{route('print-sj',$dt->no_surat_jalan)}}" class="btn btn-warning btn-sm">Print SJ Besar</a>
                                                <!--<a href="{{route('print-sjb',$dt->no_surat_jalan)}}" class="btn btn-warning btn-sm">Print SJ fix</a>-->
                                                <a href="{{route('print-sj-v1',$dt->no_surat_jalan)}}" class="btn btn-warning btn-sm">Print SJ Invoice</a>
                                            </td>
                                       </tr>
                                       @endforeach
                                   </tbody>
                                </table>
			            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
			    	            <table id="data_surat_jalan_kecil" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>NO SURAT JALAN</th>
                                            <th>NO P.O </th>
                                            <th>TGL SJ</th>
                                            <th>SUPIR</th>
                                            <th>NO KENDARAAN</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($dt_sj_kecil as $dt)
                                        <tr>
                                            <td>{{$dt->no_surat_jalan}}</td>
                                            <td>{{$dt->no_po_customer}}</td>
                                            <td>{{date("d/m/Y",strtotime($dt->tgl_surat_jalan))}}</td>
                                            <td>{{$dt->supir}}</td>
                                            <td>{{$dt->plat_nomor}}</td>
                                            <td>
                                                <!--<a href="{{route('print-sj-besar-v0',$dt->no_surat_jalan)}}" class="btn btn-warning btn-sm">Print SJ Besar</a>-->
                                                <a href="{{route('print-sj-v0',$dt->no_surat_jalan)}}" class="btn btn-warning btn-sm">Print SJ Kecil</a>
                                                <a href="{{route('print-sj-v1-invoice',$dt->no_surat_jalan)}}" class="btn btn-warning btn-sm">Print SJ Invoice</a>
                                            </td>
                                       </tr>
                                       @endforeach
                                   </tbody>
                                </table>

	                    </div>
			                <div class="tab-pane fade" id="nav-sj-sample" role="tabpanel" aria-labelledby="nav-profile-tab">
			    	            <table id="data_surat_jalan_sample" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>NO SURAT JALAN</th>
                                            <th>NO P.O </th>
                                            <th>TGL SJ</th>
                                            <th>SUPIR</th>
                                            <th>NO KENDARAAN</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($dt_sj_sample as $dt)
                                        <tr>
                                            <td>{{$dt->no_surat_jalan}}</td>
                                            <td>{{$dt->no_po_customer}}</td>
                                            <td>{{date("d/m/Y",strtotime($dt->tgl_surat_jalan))}}</td>
                                            <td>{{$dt->supir}}</td>
                                            <td>{{$dt->plat_nomor}}</td>
                                            <td>
                                                <a href="{{route('print-sj-sample',$dt->no_surat_jalan)}}" class="btn btn-warning btn-sm">Print SJ</a>
                                            </td>
                                       </tr>
                                       @endforeach
                                   </tbody>
                                </table>

	                    </div>

                        </div>
                        
                    </div>
                  </div>
               </div>
            
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div>  
@endsection   

@section('plugin_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $url = '{{url('print-sj-v0')}}';
        console.log($url);
        
        $('#data_surat_jalan_besar').DataTable({
            "order": [[0, 'desc' ]]
        });
	    $('#data_surat_jalan_kecil').DataTable({
            "order": [[0, 'desc' ]]
        });
        $('#data_surat_jalan_sample').DataTable({
            "order": [[0, 'desc' ]]
        });

        $('#no_surat_jalan').select2({
            placeholder: '- Pilih Surat Jalan -',
            ajax: {
            url: '{{url('sales/surat-jalan/get-no-sj')}}',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                results:  $.map(data, function (id) {
                    return {
                    id: id.no_surat_jalan,
                    text: id.no_surat_jalan

                    }
                })
                };
            },
            cache: true
            }
        });

        $('#btn-batal').on('click', function(){
		alert('Fitur Batal Masih Dalam Development , Hehehehe ');
	});

    </script>

@endsection