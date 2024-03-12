@extends('adminlte::page')
@section('adminlte_css')
<style>
    .cari-so {
        width:330px;
    }
</style>
@endsection
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="callout callout-info">
                        <h4>
                            Progress Produksi
                          
                        </h4>
			
                    </div>

                    <!-- Form Input pengadaan-->
                    <div class="invoice p-3 mb-3">
                        <div class="row">
			   <div class="col-lg-6">
				<a href="{{url('/production/progres-produksi/create')}}" class="btn btn-primary">Input Header</a>
				<a href="{{url('/production/progres-produksi/create_progres_harian')}}" class="btn btn-success">Input Hasil Produksi</a>
				
			   </div>
			   <div class="col-lg-6 text-right">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#COR">Export Progress COR</button>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Export Laporan Produksi</button>
			   </div>
                        </div>
			<br>
			 <div class="col-sm-6">
			<nav>

                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-global-tab" data-toggle="tab" href="#nav-global" role="tab" aria-controls="nav-home" aria-selected="true">GLOBAL</a>
				<a class="nav-item nav-link" id="nav-ali-tab" data-toggle="tab" href="#nav-ali" role="tab" aria-controls="nav-profile" aria-selected="false">ALI</a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-gofar" role="tab" aria-controls="nav-profile" aria-selected="false">GOFAR</a>
				<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-ahmad" role="tab" aria-controls="nav-profile" aria-selected="false">AHMAD</a>
				<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-david" role="tab" aria-controls="nav-profile" aria-selected="false">DAVID</a>
				<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-deden" role="tab" aria-controls="nav-profile" aria-selected="false">DEDEN</a>
                            </div>
                        </nav>
                    </div>
			<br>
		<div class="row">
		    <div class="col-sm-12">
			<div class="tab-content" id="nav-tabContent">
  			   <div class="tab-pane fade show active" id="nav-global" role="tabpanel" aria-labelledby="nav-global-tab">
				<table id="progres_produksi_global" class="table table-bordered table-sm table-hover table-striped">
                			<thead>
                    				<tr>
                        	<th>Tgl Prod</th>
                        	<th>PO</th>
                        	<th>No spk</th>
							<th>Customer</th>
                        	<th>Lebar</th>
                        	<th>Panjang</th>
							<th>Kualitas</th>
							<th>Sheet</th>
                        	<th>Box</th>
<!--                        	
							<th>Cor</th>
							<th>Slitter</th>
                        	<th>Pon</th>
                        	<th>Coak</th>
							<th>Print</th>
							<th>Slotter</th>
							<th>Lem</th>
							<th>Kancing</th>
							<th>Laminasi</th>
							<th>Kupas</th>
							<th>Triple</th>
							<th>Tgl</th>
-->
							<th>INV</th>
							<th>JML</th>
							<th>Prsntse</th>
							<th>Action</th>
                    				</tr>
                			</thead>
                			<tbody>
		    				@foreach($datapro as $dt)
		    				<tr>
							<td>{{date("Y/m/d",strtotime($dt->tgl_prod))}}</td>
							<td>{{$dt->no_po_customer}}</td>
							<td>{{$dt->tipe_spk}} {{substr($dt->no_spk,3)}}</td>
							<td>{{$dt->nama_customer}}</td>
							<td>{{$dt->lebar}}</td>
							<td>{{$dt->panjang}}</td>
							<td>{{$dt->kwalitas}}</td>
							<td>{{$dt->jumlah_sheet}}</td>
							<td>{{$dt->jumlah_box}}</td>
<!--
							<td>{{$dt->cor}}</td>
							<td>{{$dt->slitter}}</td>
							<td>{{$dt->pon}}</td>
							<td>{{$dt->coak}}</td>
							<td>{{$dt->print}}</td>
							<td>{{$dt->slotter}}</td>
							<td>{{$dt->lem}}</td>
							<td>{{$dt->kancing}}</td>
							<td>{{$dt->laminasi}}</td>
							<td>{{$dt->kupas}}</td>
							<td>{{$dt->triple}}</td>
							<td>{{$dt->tgl_pengiriman}}</td>
-->
							<td>{{$dt->no_inv}}</td>
							<td>{{$dt->jml_kirim}}</td>
							<td>{{$dt->persentase}}</td>
							<td>
								<a href="/production/progres-produksi/edit/{{$dt->no_spk}}" class="btn btn-warning">Edit</a>
								<a href="/production/progres-produksi/delete/{{$dt->no_spk}}" class="btn btn-danger">Delete</a>
							</td>
		    				</tr>
		    				@endforeach
                			</tbody>
           			</table>
			    </div>
			    <div class="tab-pane fade show" id="nav-ali" role="tabpanel" aria-labelledby="nav-ali-tab">
				<table id="data_ali" class="table table-bordered table-sm table-hover table-striped">
				<thead>
                    				<tr>
                        	<th>Tgl Prod</th>
                        	<th>PO</th>
                        	<th>No spk</th>
							<th>Customer</th>
                        	<th>Lebar</th>
                        	<th>Panjang</th>
							<th>Kualitas</th>
							<th>Sheet</th>
                        	<th>Box</th>
<!--                        	
							<th>Cor</th>
							<th>Slitter</th>
                        	<th>Pon</th>
                        	<th>Coak</th>
							<th>Print</th>
							<th>Slotter</th>
							<th>Lem</th>
							<th>Kancing</th>
							<th>Laminasi</th>
							<th>Kupas</th>
							<th>Triple</th>
							<th>Tgl</th>
-->
							<th>INV</th>
							<th>JML</th>
							<th>Prsntse</th>
							<th>Action</th>
                    				</tr>
                			</thead>
                			<tbody>
						@foreach($dataproali as $dt)
		    				<tr>
							<td>{{date("Y/m/d",strtotime($dt->tgl_prod))}}</td>
							<td>{{$dt->no_po_customer}}</td>
							<td>{{$dt->no_spk}}</td>
							<td>{{$dt->nama_customer}}</td>
							<td>{{$dt->lebar}}</td>
							<td>{{$dt->panjang}}</td>
							<td>{{$dt->kwalitas}}</td>
							<td>{{$dt->jumlah_sheet}}</td>
							<td>{{$dt->jumlah_box}}</td>
<!--
							<td>{{$dt->cor}}</td>
							<td>{{$dt->slitter}}</td>
							<td>{{$dt->pon}}</td>
							<td>{{$dt->coak}}</td>
							<td>{{$dt->print}}</td>
							<td>{{$dt->slotter}}</td>
							<td>{{$dt->lem}}</td>
							<td>{{$dt->kancing}}</td>
							<td>{{$dt->laminasi}}</td>
							<td>{{$dt->kupas}}</td>
							<td>{{$dt->triple}}</td>
							<td>{{date("d/m",strtotime($dt->tgl_pengiriman))}}</td>
-->
							<td>{{$dt->no_inv}}</td>
							<td>{{$dt->jml_kirim}}</td>
							<td>{{$dt->persentase}}</td>
							<td>
								<a href="/production/progres-produksi/edit/{{$dt->no_spk}}" class="btn btn-warning">Edit</a>
								<a href="/production/progres-produksi/delete/{{$dt->no_spk}}" class="btn btn-danger">Delete</a>
							</td>
		    				</tr>
						@endforeach
                			</tbody>
           			</table>
			    </div>
			    <div class="tab-pane fade show" id="nav-gofar" role="tabpanel" aria-labelledby="nav-gofar-tab">
				<table id="data_gofar" class="table table-bordered table-sm table-hover table-striped">
				<thead>
                    				<tr>
                        	<th>Tgl Prod</th>
                        	<th>PO</th>
                        	<th>No spk</th>
							<th>Customer</th>
                        	<th>Lebar</th>
                        	<th>Panjang</th>
							<th>Kualitas</th>
							<th>Sheet</th>
                        	<th>Box</th>
<!--                        	
							<th>Cor</th>
							<th>Slitter</th>
                        	<th>Pon</th>
                        	<th>Coak</th>
							<th>Print</th>
							<th>Slotter</th>
							<th>Lem</th>
							<th>Kancing</th>
							<th>Laminasi</th>
							<th>Kupas</th>
							<th>Triple</th>
							<th>Tgl</th>
-->
							<th>INV</th>
							<th>JML</th>
							<th>Prsntse</th>
							<th>Action</th>
                    				</tr>
                			</thead>
                			<tbody>
		    				@foreach($dataprogopar as $dt)
		    				<tr>
							<td>{{date("Y/m/d",strtotime($dt->tgl_prod))}}</td>
							<td>{{$dt->no_po_customer}}</td>
							<td>{{$dt->no_spk}}</td>
							<td>{{$dt->nama_customer}}</td>
							<td>{{$dt->lebar}}</td>
							<td>{{$dt->panjang}}</td>
							<td>{{$dt->kwalitas}}</td>
							<td>{{$dt->jumlah_sheet}}</td>
							<td>{{$dt->jumlah_box}}</td>
<!--
							<td>{{$dt->cor}}</td>
							<td>{{$dt->slitter}}</td>
							<td>{{$dt->pon}}</td>
							<td>{{$dt->coak}}</td>
							<td>{{$dt->print}}</td>
							<td>{{$dt->slotter}}</td>
							<td>{{$dt->lem}}</td>
							<td>{{$dt->kancing}}</td>
							<td>{{$dt->laminasi}}</td>
							<td>{{$dt->kupas}}</td>
							<td>{{$dt->triple}}</td>
							<td>{{date("d/m",strtotime($dt->tgl_pengiriman))}}</td>
-->
							<td>{{$dt->no_inv}}</td>
							<td>{{$dt->jml_kirim}}</td>
							<td>{{$dt->persentase}}</td>
							<td>
								<a href="/production/progres-produksi/edit/{{$dt->no_spk}}" class="btn btn-warning">Edit</a>
								<a href="/production/progres-produksi/delete/{{$dt->no_spk}}" class="btn btn-danger">Delete</a>
							</td>
		    				</tr>
						@endforeach                			
				        </tbody>
           			</table>
			    </div>
			    <div class="tab-pane fade show" id="nav-ahmad" role="tabpanel" aria-labelledby="nav-ahmad-tab">
				<table id="data_ahmad" class="table table-bordered table-sm table-hover table-striped">
				<thead>
                    				<tr>
                        	<th>Tgl Prod</th>
                        	<th>PO</th>
                        	<th>No spk</th>
							<th>Customer</th>
                        	<th>Lebar</th>
                        	<th>Panjang</th>
							<th>Kualitas</th>
							<th>Sheet</th>
                        	<th>Box</th>
<!--                        	
							<th>Cor</th>
							<th>Slitter</th>
                        	<th>Pon</th>
                        	<th>Coak</th>
							<th>Print</th>
							<th>Slotter</th>
							<th>Lem</th>
							<th>Kancing</th>
							<th>Laminasi</th>
							<th>Kupas</th>
							<th>Triple</th>
							<th>Tgl</th>
-->
							<th>INV</th>
							<th>JML</th>
							<th>Prsntse</th>
							<th>Action</th>
                    				</tr>
                			</thead>
                			<tbody>
		    				@foreach($dataproahmad as $dt)
		    				<tr>
							<td>{{date("Y/m/d",strtotime($dt->tgl_prod))}}</td>
							<td>{{$dt->no_po_customer}}</td>
							<td>{{$dt->no_spk}}</td>
							<td>{{$dt->nama_customer}}</td>
							<td>{{$dt->lebar}}</td>
							<td>{{$dt->panjang}}</td>
							<td>{{$dt->kwalitas}}</td>
							<td>{{$dt->jumlah_sheet}}</td>
							<td>{{$dt->jumlah_box}}</td>
<!--
							<td>{{$dt->cor}}</td>
							<td>{{$dt->slitter}}</td>
							<td>{{$dt->pon}}</td>
							<td>{{$dt->coak}}</td>
							<td>{{$dt->print}}</td>
							<td>{{$dt->slotter}}</td>
							<td>{{$dt->lem}}</td>
							<td>{{$dt->kancing}}</td>
							<td>{{$dt->laminasi}}</td>
							<td>{{$dt->kupas}}</td>
							<td>{{$dt->triple}}</td>
							<td>{{date("d/m",strtotime($dt->tgl_pengiriman))}}</td>
-->
							<td>{{$dt->no_inv}}</td>
							<td>{{$dt->jml_kirim}}</td>
							<td>{{$dt->persentase}}</td>
							<td>
								<a href="/production/progres-produksi/edit/{{$dt->no_spk}}" class="btn btn-warning">Edit</a>
								<a href="/production/progres-produksi/delete/{{$dt->no_spk}}" class="btn btn-danger">Delete</a>
							</td>
		    				</tr>
						@endforeach
                			</tbody>
           			</table>
			    </div>
			    <div class="tab-pane fade show" id="nav-david" role="tabpanel" aria-labelledby="nav-david-tab">
				<table id="data_david" class="table table-bordered table-sm table-hover table-striped">
				<thead>
                    				<tr>
                        	<th>Tgl Prod</th>
                        	<th>PO</th>
                        	<th>No spk</th>
							<th>Customer</th>
                        	<th>Lebar</th>
                        	<th>Panjang</th>
							<th>Kualitas</th>
							<th>Sheet</th>
                        	<th>Box</th>
<!--                        	
							<th>Cor</th>
							<th>Slitter</th>
                        	<th>Pon</th>
                        	<th>Coak</th>
							<th>Print</th>
							<th>Slotter</th>
							<th>Lem</th>
							<th>Kancing</th>
							<th>Laminasi</th>
							<th>Kupas</th>
							<th>Triple</th>
							<th>Tgl</th>
-->
							<th>INV</th>
							<th>JML</th>
							<th>Prsntse</th>
							<th>Action</th>
                    				</tr>
                			</thead>
                			<tbody>
		    				@foreach($dataprodavid as $dt)
		    				<tr>
							<td>{{date("Y/m/d",strtotime($dt->tgl_prod))}}</td>
							<td>{{$dt->no_po_customer}}</td>
							<td>{{$dt->no_spk}}</td>
							<td>{{$dt->nama_customer}}</td>
							<td>{{$dt->lebar}}</td>
							<td>{{$dt->panjang}}</td>
							<td>{{$dt->kwalitas}}</td>
							<td>{{$dt->jumlah_sheet}}</td>
							<td>{{$dt->jumlah_box}}</td>
<!--
							<td>{{$dt->cor}}</td>
							<td>{{$dt->slitter}}</td>
							<td>{{$dt->pon}}</td>
							<td>{{$dt->coak}}</td>
							<td>{{$dt->print}}</td>
							<td>{{$dt->slotter}}</td>
							<td>{{$dt->lem}}</td>
							<td>{{$dt->kancing}}</td>
							<td>{{$dt->laminasi}}</td>
							<td>{{$dt->kupas}}</td>
							<td>{{$dt->triple}}</td>
							<td>{{date("d/m",strtotime($dt->tgl_pengiriman))}}</td>
-->
							<td>{{$dt->no_inv}}</td>
							<td>{{$dt->jml_kirim}}</td>
							<td>{{$dt->persentase}}</td>
							<td>
								<a href="/production/progres-produksi/edit/{{$dt->no_spk}}" class="btn btn-warning">Edit</a>
								<a href="/production/progres-produksi/delete/{{$dt->no_spk}}" class="btn btn-danger">Delete</a>
							</td>
		    				</tr>
						@endforeach
                			</tbody>
           			</table>
			    </div>
			    <div class="tab-pane fade show" id="nav-deden" role="tabpanel" aria-labelledby="nav-deden-tab">
				<table id="data_deden" class="table table-bordered table-sm table-hover table-striped">
				<thead>
                    				<tr>
                        	<th>Tgl Prod</th>
                        	<th>PO</th>
                        	<th>No spk</th>
							<th>Customer</th>
                        	<th>Lebar</th>
                        	<th>Panjang</th>
							<th>Kualitas</th>
							<th>Sheet</th>
                        	<th>Box</th>
<!--                        	
							<th>Cor</th>
							<th>Slitter</th>
                        	<th>Pon</th>
                        	<th>Coak</th>
							<th>Print</th>
							<th>Slotter</th>
							<th>Lem</th>
							<th>Kancing</th>
							<th>Laminasi</th>
							<th>Kupas</th>
							<th>Triple</th>
							<th>Tgl</th>
-->
							<th>INV</th>
							<th>JML</th>
							<th>Prsntse</th>
							<th>Action</th>
                    				</tr>
                			</thead>
                			<tbody>
		    				@foreach($dataprodeden as $dt)
		    				<tr>
							<td>{{date("Y/m/d",strtotime($dt->tgl_prod))}}</td>
							<td>{{$dt->no_po_customer}}</td>
							<td>{{$dt->no_spk}}</td>
							<td>{{$dt->nama_customer}}</td>
							<td>{{$dt->lebar}}</td>
							<td>{{$dt->panjang}}</td>
							<td>{{$dt->kwalitas}}</td>
							<td>{{$dt->jumlah_sheet}}</td>
							<td>{{$dt->jumlah_box}}</td>
<!--
							<td>{{$dt->cor}}</td>
							<td>{{$dt->slitter}}</td>
							<td>{{$dt->pon}}</td>
							<td>{{$dt->coak}}</td>
							<td>{{$dt->print}}</td>
							<td>{{$dt->slotter}}</td>
							<td>{{$dt->lem}}</td>
							<td>{{$dt->kancing}}</td>
							<td>{{$dt->laminasi}}</td>
							<td>{{$dt->kupas}}</td>
							<td>{{$dt->triple}}</td>
							<td>{{date("d/m",strtotime($dt->tgl_pengiriman))}}</td>
-->
							<td>{{$dt->no_inv}}</td>
							<td>{{$dt->jml_kirim}}</td>
							<td>{{$dt->persentase}}</td>
							<td>
								<a href="/production/progres-produksi/edit/{{$dt->no_spk}}" class="btn btn-warning">Edit</a>
								<a href="/production/progres-produksi/delete/{{$dt->no_spk}}" class="btn btn-danger">Delete</a>
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

	   <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Export Laporan Produksi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <form action="{{route('export.progres')}}" method="get">
                            {{ csrf_field() }}
                            <div class="modal-body">
                            <label for="">TGL PRODUKSI :</label>
                                <div class="from-group input-daterange">
                                    <input type="date" class="form-control" name="date_form">
                                    <div class="input-group-addon">to</div>
                                    <input type="date" class="form-control" name="date_to">
                            </div>
                            <label for="PIC">PIC :</label>
                            <div class="form-group">
                                <div class="form-group">
                                    <select class="form-control" name="pic">
                                    <option value="">- Pilih PIC -</option>
                                    <option value="ALI">ALI</option>
                                    <option value="DAVID">DAVID</option>
                                    <option value="GOFAR">GOFAR</option>
                                    <option value="AHMAD">AHMAD</option>
                                    <option value="DEDEN">DEDEN</option>
                                    </select>
                                </div>
                            </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <input class="btn btn-sm btn-primary" type="submit" value="Print Laporan">
                            </div>
                        </form>
                        </div>
                </div>
            </div>
            <div class="modal fade" id="COR" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Export Laporan Produksi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <form action="/production/progres-produksi/export-excel-Progres-COR" method="get">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <label for="">TGL PRODUKSI :</label>
                                <div class="from-group input-daterange">
                                    <input type="date" class="form-control" name="date_form">
                                    <div class="input-group-addon">to</div>
                                    <input type="date" class="form-control" name="date_to">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <input class="btn btn-sm btn-primary" type="submit" value="Print Laporan">
                            </div>
                        </form>
                        </div>
                </div>
            </div>
	
        </div>
    </div>
@endsection


@section('plugin_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script>
    	$('#progres_produksi_global').DataTable({
            "order": [[2, 'desc' ]],
        });
		$('#data_ali').DataTable({
            "order": [[2, 'desc' ]],
        });
		$('#data_gofar').DataTable({
            "order": [[2, 'desc' ]],
        });
		$('#data_ahmad').DataTable({
            "order": [[2, 'desc' ]],
        });
		$('#data_david').DataTable({
            "order": [[2, 'desc' ]],
        });
		$('#data_deden').DataTable({
            "order": [[2, 'desc' ]],
        });
        $('#no_spk').select2({
            placeholder: '- Pilih Kode SPK -',
            ajax: {
            url: '{{url('/production/get_no_spk')}}',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                results:  $.map(data, function (spk) {
                    return {
                    id: spk.no_spk,
                    text: spk.no_spk+' / '+spk.no_po_customer
                    
                    }
                })
                };
            },
            cache: true
            }
        });

	$('#data_produksi_global').DataTable();
	$('#data_ali').DataTable();
	$('#data_gofar').DataTable();
	$('#data_ahmad').DataTable();
	$('#data_david').DataTable();
	$('#data_deden').DataTable();
    </script>

@endsection
