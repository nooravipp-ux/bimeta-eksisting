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
                            DATA PROGRESS HARIAN
                            <div class="msg"></div>
                        </h4>
                    </div>

                    <!-- Form Input pengadaan-->
                    <div class="invoice p-3 mb-3">
       	                <table id="spk" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>TANGGAL PROD</th>
                        <th>NO SPK</th>
                        <th>NAMA OPERATOR</th>
			            <th>STATUS PROGRESS</th>
                        <th>HASIL</th>
                        <th>KETERANGAN</th>
			            <th>Action</th>
                    </tr>
                </thead>
                <tbody>
		    @foreach($produksi_harian as $prod)
		    <tr>
			<td>{{$prod->tgl_period}}</td>
			
			<td>{{$prod->no_spk}}</td>
			<td>{{$prod->nama_operator}}</td>
			<td>{{$prod->status_progres}}</td>
			<td>{{$prod->hasil}}</td>
			<td>{{$prod->keterangan}}</td>
			<td><a href="/production/progres-harian-edit/{{$prod->id_lap_produksi}}" class="btn btn-warning btn-sm">Edit</a></td>
		    </tr>
		    @endforeach
		    
                </tbody>
                </table>
        </div>
    </div>
@endsection

@section('plugin_js')
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script>
    	$('#spk').DataTable({
            "order": [[0, 'desc' ]]
        });
    </script>

@endsection
