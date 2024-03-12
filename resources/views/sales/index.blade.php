@extends('adminlte::page')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
                <h4>
                    Sales Order
                    <div class="msg"></div>
                </h4>
            </div>
            <div class="invoice p-3 mb-3">
                <div class="row">
		    <div class="col-sm-6">
			<nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-draft" role="tab" aria-controls="nav-home" aria-selected="true">DRAFT</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-on-progress" role="tab" aria-controls="nav-profile" aria-selected="false">ON PROGRESS</a>
				                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-proceeded" role="tab" aria-controls="nav-profile" aria-selected="false">PROCEEDED</a>
                            </div>
                        </nav>
                    </div>
                    <div class="col-sm-6 text-right">
                    	<a href="{{ route('sales.create-sales-order') }}" class="btn btn-primary">Buat Sales Order</a>
                	<br/>
               		 <br/>
                    </div>
                    
                </div>
		<div class="row">
		    <div class="col-sm-12">
			<div class="tab-content" id="nav-tabContent">
  			   <div class="tab-pane fade show active" id="nav-draft" role="tabpanel" aria-labelledby="nav-home-tab">
			       <table id="data_draft" class="table table-bordered table-hover table-striped">
                		   <thead>
                                       <tr>
                                           <th>ID SO</th>
                                           <th>Tgl Pemesanan</th>
                                           <th>Nama Customer</th>
                                           <th>Status</th>
                                           <th>Pajak</th>
                                           <th>No P.O Customer</th>
                                           <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  @foreach($data_draft as $so)
                                      <tr>
                                      <td>{{$so->id_so}}</td>
                                      <td>{{$so->tgl_pemesanan}}</td>
                                      <td>{{$so->nama_customer}}</td>
                                      <td>{{$so->status}}</td>
                                      <td><div id="sortir">{{$so->pajak}}</div></td>
                                      <td>{{$so->no_po_customer}}</td>
                                      <td><a href="{{ route('sales.detail-sales-order',$so->id_so) }}" class="btn btn-warning btn-sm">Detail</a>
                                      
                                          <a href="{{ route('sales.edit-sales-order',$so->id_so) }}" class="btn btn-info btn-sm">Edit</a>
                                            @if(auth()->user()->role == 'superadmin')
                                          <a href="{{ route('surat-jalan.create',$so->id_so) }}" class="btn btn-secondary btn-sm">Buat SJ</a>
					                        @endif
                                      </td>
                                      <script>
                                        // var cc = document.getElementById('sortir');
                                        // if (cc.textContent == 'V2') {
                                        //  cc.style.color="green";
                                        //    } else {
                                        //    cc.style.color="red";
                                        // }
                                       </script>
                                      </tr>
                                 @endforeach
                                 </tbody>
                              </table>
			   </div>
                           <div class="tab-pane fade" id="nav-on-progress" role="tabpanel" aria-labelledby="nav-profile-tab">
			      <table id="data_on_progress" class="table table-bordered table-hover table-striped">
                		   <thead>
                                       <tr>
                                           <th>ID SO</th>
                                           <th>Tgl Pemesanan</th>
                                           <th>Nama Customer</th>
                                           <th>Status</th>
                                           <th>Pajak</th>
                                           <th>No P.O Customer</th>
                                           <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  @foreach($data_on_progress as $so)
                                      <tr>
                                      <td>{{$so->id_so}}</td>
                                      <td>{{$so->tgl_pemesanan}}</td>
                                      <td>{{$so->nama_customer}}</td>
                                      <td>{{$so->status}}</td>
                                      <td>{{$so->pajak}}</td>
                                      <td>{{$so->no_po_customer}}</td>
                                      <td><a href="{{ route('sales.detail-sales-order',$so->id_so) }}" class="btn btn-warning btn-sm">Detail</a>
                                       
                                      <a href="{{ route('sales.edit-sales-order',$so->id_so) }}" class="btn btn-info btn-sm">Edit</a>
                                      
                                          <a href="{{ route('surat-jalan.create',$so->id_so) }}" class="btn btn-secondary btn-sm">Buat SJ</a>
                                      </td>
                                      </tr>
                                 @endforeach
                                 </tbody>
                              </table>

			   </div>
       			   <div class="tab-pane fade" id="nav-proceeded" role="tabpanel" aria-labelledby="nav-contact-tab">
			      <table id="data_proceeded" class="table table-bordered table-hover table-striped">
                		   <thead>
                                       <tr>
                                           <th>ID SO</th>
                                           <th>Tgl Pemesanan</th>
                                           <th>Nama Customer</th>
                                           <th>Status</th>
                                           <th>Pajak</th>
                                           <th>No P.O Customer</th>
                                           <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  @foreach($data_proceeded as $so)
                                      <tr>
                                      <td>{{$so->id_so}}</td>
                                      <td>{{$so->tgl_pemesanan}}</td>
                                      <td>{{$so->nama_customer}}</td>
                                      <td>{{$so->status}}</td>
                                      <td>{{$so->pajak}}</td>
                                      <td>{{$so->no_po_customer}}</td>
                                      <td><a href="{{ route('sales.detail-sales-order',$so->id_so) }}" class="btn btn-warning btn-sm">Detail</a>
                                   
                                          <a href="{{ route('sales.edit-sales-order',$so->id_so) }}" class="btn btn-info btn-sm">Edit</a>
                                        
                                          <a href="{{ route('surat-jalan.create',$so->id_so) }}" class="btn btn-secondary btn-sm">Buat SJ</a>
                                      </td>
                                      </tr>
                                 @endforeach
                                 </tbody>
                              </table>

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
    $('#data_draft').DataTable({
            "order": [[0, 'desc' ]]
        });
	$('#data_on_progress').DataTable({
            "order": [[0, 'desc' ]]
        });
	// $('#data_waiting').DataTable();
	$('#data_proceeded').DataTable({
            "order": [[0, 'desc' ]]
        });
    </script>


@endsection



