@extends('adminlte::page')

@section('content')

    <div class="card mt-5">
        <div class="card-body">
            <a href="{{route('bom.create')}}" class="btn btn-primary">Input Bill Of Material</a>
                <br/>
                <br/>
            <table id="bom" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>ID Bill Of Material</th>
                        <th>kode_barang</th>
                        <th>Deskripsi Material</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bom as $Bom)
                    <tr>
                        <td>{{ $Bom->id_bom }}</td>
                        <td>{{ $Bom->kode_barang }}</td>
                        <td>{{ $Bom->deskripsi_material }}</td>
                        <td><a href="{{route('bom.edit',$Bom->id_bom)}}" class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{route('bom.delete',$Bom->id_bom)}}" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau menghapus data')">Delete</a></<a>
                    </tr>
                    @endforeach
                </tbody>
                </table>
        </div>
    </div>
@endsection

@section('plugin_js')
    <script>
        $('#bom').DataTable();
    </script>

@endsection
