@extends('adminlte::page')
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
              <table id="progres_produksi" class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>NO SPK</th>
                        <th>Tgl Prod</th>
                        <th>Lebar</th>
			<th>Panjang</th>
                        <th>Kualitas</th>
                        <th>Jml Sheet</th>
			<th>Jml Box</th>
			<th>Cor</th>
                        <th>Slither</th>
                        <th>Pon</th>
			<th>Coak</th>
                        <th>Print</th>
                        <th>Slotter</th>
			<th>Lem</th>
			<th>Kancing</th>
			<th>Tgl Selesai</th>
                    </tr>
                </thead>
                <tbody>
		    @foreach($print_laporan as $dt)
		    <tr>
			<td>{{$dt->no_spk}}</td>
			<td>{{$dt->tgl_prod}}</td>
			<td>{{$dt->lebar}}</td>
			<td>{{$dt->panjang}}</td>
			<td>{{$dt->kwalitas}}</td>
			<td>{{$dt->jumlah_sheet}}</td>
			<td>{{$dt->jumlah_box}}</td>
			<td>{{$dt->cor}}</td>
			<td>{{$dt->slither}}</td>
			<td>{{$dt->pon}}</td>
			<td>{{$dt->coak}}</td>
			<td>{{$dt->print}}</td>
			<td>{{$dt->slotter}}</td>
			<td>{{$dt->lem}}</td>
			<td>{{$dt->kancing}}</td>
			<td>{{$dt->tgl_selesai}}</td>
		    </tr>
		    @endforeach
                </tbody>
           </table>
	   <!-- Modal -->
        </div>
    </div>
@endsection

@section('plugin_js')
    <script>
	window.print();
    </script>

@endsection
