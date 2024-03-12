@extends('adminlte::page')

@section('content')

    <div class="card mt-5">
        <div class="card-body">
                <a href="{{ route('finance.create') }}" class="btn btn-primary">Input Kode Perkiraan</a>
                <br/>
                
                <br/>
            <table id="Daftar Kode Perkiraan / Chart Of Account" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>Kode Perkiraan</th>
                        <th>Deskripsi Kode Perkiraan</th>
                        <th>Saldo Normal</th>
                        <th>Jenis</th>
                        <th>Sub</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($KodePerkiraan as $kodepr)
                    <tr>
                        <td>{{ $kodepr->NO_COA }}</td>
                        <td>{{ $kodepr->DESKRIPSI_COA }}</td>
                        <td>{{ $kodepr->HEADER }}</td>
                        <td>{{ $kodepr->JENIS }}</td>
                        <td>{{ $kodepr->SUB }}</td>
                      
                    </tr>
                    @endforeach
                </tbody>
                </table>
        </div>
    </div>
       
@endsection

@section('plugin_js')
    <script>
        $('#data_pengadaan').DataTable();
    </script>

@endsection



