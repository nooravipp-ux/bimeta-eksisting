@extends('adminlte::page')

@section('content')

    <div class="card mt-5">
        <div class="card-body">
            <B><center><p style="font-size:30px"><I>Laporan Laba Rugi PT. Bimeta Karnusa</p></I></center></B>
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
                <tr>
                    <td><B><I><U>Penjualan</I></B></U></td>
                </tr>
                @foreach($LaporanPenjualan as $lappen)
                    <tr>
                        <td></td>
                        <td>{{ $lappen->DESKRIPSI_COA }}</td>
                        <td>{{ number_format($lappen->SALDO,0) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td><I><B>Total Penjualan</B></I>
                    <td><I><B>{{number_format($TotalLaporanPenjualan,0)}}</B></I></td>
                <tr>
                    <td><B><I><U>Harga Pokok Penjualan</U></I></B></td>
                </tr>
                @foreach($LaporanHpp as $laphpp)
                    <tr>
                    <td></td>
                        <td>{{ $laphpp->DESKRIPSI_COA,0 }}</td>
                        <td>{{ number_format($laphpp->SALDO,0) }}</td>
                    </tr>
                    @endforeach
                <tr>
                    <td></td>
                    <td><I><B>Total Harga Pokok Penjualan</B></I>
                    <td><I><B>{{number_format($TotalLaporanHpp,0)}}</B></I></td>
                </tr>
                <tr>
                    <td><B><I><U>Biaya Operasional</U></I></B></td>
                </tr>
                @foreach($LaporanBiayaOperasional as $laphpp)
                    <tr>
                        <td></td>
                        <td>{{ $laphpp->DESKRIPSI_COA,0 }}</td>
                        <td>{{ number_format($laphpp->SALDO,0) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td><I><B>Total Biaya Operasional</B></I>
                    <td><I><B>{{number_format($TotalBiayaOperasional,0)}}</B></I></td>
                </tr>
                <tr>
                    <td><I><U><B>Keuntungan Kotor (Gross Profit Margin)</B></U></I></td>
                    <td>
                    <td><I><B><U><U>{{number_format($TotalLaporanPenjualan - $TotalLaporanHpp,0)}}</U></B></I></td>
                </tr>
                <tr>
                    <td><I><B><U>Keuntungan Bersih (Net Profit Margin)</U></U><I><B></td>
                    <td><I><B></B></I>
                    <td><I><B><U><U>{{number_format($TotalLaporanPenjualan - ($TotalLaporanHpp + $TotalBiayaOperasional),0)}}<U></U></B></I></td>
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
