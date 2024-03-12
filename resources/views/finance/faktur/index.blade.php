
@extends('adminlte::page')
@section('adminlte_css')
<style>
    .png {
	width:330px;
    }

</style>
@endsection


@section('content')
<!-- Content Wrapper. Contains page content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
                <h4>
                     Faktur  
                    <div class="msg"></div>
                </h4>
            </div>
      
            <!-- Form Input GR  -->
            <div class="invoice p-3 mb-3">
                <div class="row">
                    <div class="col-sm-12">
                        <form action="/finance/create-faktur" method="get">
			                <div class="form-group row">
                                <label for="no_so" class="col-sm-1 col-form-label">NO FAKTUR</label>
                                <div class="col-sm-2">
                                    <select type="text" class="form-control" id="no_faktur" name="no_surat_jalan" required></select>
                                </div>
                                <button type="submit" class="btn btn-primary">Buat faktur</button>
                            </div>
                        </form>
                    </div>
		        </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                                @if(session('message'))
                                    <div class="alert alert-danger" role="alert">
                                        {{session('message')}}
                                    </div>
                                @endif
                    </div>
                </div>
		<div class="row">
			<div class="col"> <br>
				<table id="faktur" class="table table-bordered table-hover table-striped">
					<thead>
                    				<tr>
                        			 <th>NO FAKTUR</th>
                                     <!--<th>PELANGGAN</th>-->
                        			 <th>TANGGAL FAKTUR</th>
						 <th>ACTION</th>
                       				</tr>
                			</thead>
                			<tbody>
					@foreach($faktur_penjualan as $faktur)
                    				<tr>
                        			 <td>{{$faktur->no_faktur}}</td>
                                     <!--<td>{{$faktur->no_faktur}}</td>-->
                        			 <td>{{$faktur->tgl_faktur}}</td>
						 <td><a href="{{route('print-faktur',$faktur->no_faktur)}}" class="btn btn-sm btn-primary">Print Faktur</a>
                         <!--<a href="{{route('print-faktur',$faktur->no_faktur)}}" class="btn btn-warning btn-sm">Print Faktur</a>--></td>
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
	$('#faktur').DataTable();
        $('#no_faktur').select2({
            placeholder: '- Pilih No Surat Jalan -',
            ajax: {
            url: '{{url('/finance/get-no-sj')}}',
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
    </script>

@endsection

