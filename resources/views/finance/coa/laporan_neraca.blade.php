@extends('adminlte::page')

@section('content')

    <div class="card mt-5">
        <div class="card-body">
            <center><B><i><p style="font-size:30px">Neraca PT. Bimeta Karnusa</p></i></B></center>
            <br/>

            <br/>
            <table id="laporan_neraca" class="table table-borderless">
                <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>

                </tr>
                </thead>
                <tbody>

                    @php
                        $rowid = 0;
                        $rowspan = 0;
                    @endphp
                    @foreach($LaporanNeraca as $key => $data)
                        @php
                            $rowid += 1
                        @endphp
                        <tr>
                            @if ($key == 0 || $rowspan == $rowid)
                                @php

                                    $rowid = 0;
                                    $rowspan = $JumlahJenis;
                                @endphp
                                <td rowspan="{{ $rowspan }}">{{$data->JENIS}}</td>

                            @endif
                                <td>{{$data->DESKRIPSI_COA}}</td>

                            <td>{{number_format($data->SALDO,0)}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td><I><B><U>Total Aset (Asset)</U> </B></I></td>
                        <td><I><B><U>{{number_format($totalaset,0)}}</U></B></I></td>
                    </tr>
                    <tr>
                        <td><I><B><U>Total Kewajiban (Liabilities)</U></B></I></td>
                        <td><I><B><U>{{number_format($totalkewajiban,0)}}</U></B></I></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('plugin_js')
@section('plugin_js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script>

        $LaporanNeraca;
        $('#laporan_neraca').DataTable({
            rowGroup: {
                dataSrc: 'group'
            }
        });
    </script>
@endsection

@endsection
