@extends('adminlte::page')

@section('adminlte_css')


@endsection
@section('content')
    <table style="border-collapse: collapse; width: 100.547%; height: 10px;" border="1">
        <tbody>
        <tr style="height: 583px;">
            <td style="width: 100%; height: 10px;">
                <table style="height: 177px; width: 100%; border-collapse: collapse;" border="0">
                    <tbody>
                    <tr style="height: 18px;">
                        <td style="width: 100%; height: 18px; text-align: center;" colspan="4">
                            <p style="font-size: 30px;">SURAT JALAN</p>
                        </td>
                    </tr>
                    <tr style="height: 10px;">
                        <td style="height: 10px; width: 68.9339%;" colspan="3">  <img src="{{ asset(config('bimeta.logo_img', 'vendor/adminlte/dist/img/bimeta.png')) }}" alt="{{config('bimeta.logo_img_alt', 'bimeta')}}" class="brand-image" style="opacity: .8" width="40" height="20">PT. BIMETA KARNUSA&nbsp;</td>
                        <td style="width: 31.0662%; text-align: left; height: 28px;" rowspan="2">NO: <strong>{{$header_sj->no_surat_jalan}}</strong></td>
                    </tr>
                    <tr style="height: 18px;">
                        <td style="width: 68.9339%; height: 18px;" colspan="3"> <img src="{{ asset(config('bimeta.logo_img', 'vendor/adminlte/dist/img/bimeta.png')) }}" alt="{{config('bimeta.logo_img_alt', 'bimeta')}}" class="brand-image" style="opacity: .0" width="40" height="20">BANDUNG</td>
                    </tr>
                    <tr style="height: 18px;">
                        <td style="width: 68.9339%; height: 18px;" colspan="3">&nbsp;</td>
                        <td style="width: 31.0662%; height: 18px;">Kepada Yth :</td>
                    </tr>
                    <tr style="height: 21px;">
                        <td style="width: 37.8677%; height: 21px;">DO. No. &amp; Tgl. : {{substr($header_sj->no_surat_jalan, 1)}} / {{date('d-m-Y')}}</td>
                        <td style="width: 23.3456%; height: 21px;">&nbsp;</td>
                        <td style="width: 7.72063%; height: 21px;">&nbsp;</td>
                        <td style="width: 31.0662%; height: 88px;" rowspan="3"><strong>{{$header_sj->nama_customer}}</strong><br /><strong>{{$header_sj->alamat_customer}}</strong><br /><strong>{{$header_sj->kota}}</strong></td>
                    </tr>
                    <tr style="height: 23px;">
                        <td style="width: 37.8677%; height: 23px;">PO. No. &amp; Tgl. : {{$header_sj->no_po_customer}}</td>
                        <td style="width: 23.3456%; height: 23px;">&nbsp;</td>
                        <td style="width: 7.72063%; height: 23px;">&nbsp;</td>
                    </tr>
                    <tr style="height: 44px;">
                        <td style="width: 37.8677%; height: 44px;" colspan="3">Bersama ini kami kirimkan barang - barang seperti tercantum dibawah ini dengan:</td>
                    </tr>
                    <tr style="height: 25px;">
                        <td style="width: 37.8677%; height: 25px;">Pegangkatan:</td>
                        <td style="width: 23.3456%; height: 25px;">No. Kendaraan :{{$header_sj->plat_nomor}}</td>
                        <td style="width: 7.72063%; height: 25px;">&nbsp;</td>
                        <td style="width: 31.0662%; height: 25px;">&nbsp;</td>
                    </tr>
                    </tbody>
                </table>
                <p>&nbsp;</p>
                <table style="border-collapse: collapse; width: 100%; height: 166px;" border="1">
                    <tbody>
                    <tr style="height: 33px;">
                        <td style="width: 5.5147%; text-align: center; height: 33px;"><strong>NO.</strong></td>
                        <td style="width: 57.8318%; text-align: center; height: 33px;"><strong>JENIS BARANG/ UKURAN</strong></td>
                        <td style="width: 11.6535%; text-align: center; height: 33px;"><strong>TOTAL (LBR / PCS)</strong></td>
                        <td style="width: 25%; text-align: center; height: 33px;"><strong>KETERANGAN</strong></td>
                    </tr>
                    <tr style="height: 154px;">
                        <td style="width: 5.5147%; height: 326px;">
                            <?php $no = 1; ?>
                            @foreach($detail_sj as $det_sj)

                                <center><p margin-top:0%>{{$no++}}</p></center>

                            @endforeach
                        </td>
                        <td style="width: 57.8318%; height: 326px;">
                            @foreach($detail_sj as $det_sj)

                                <p>{{$det_sj->nama_barang}} {{$det_sj->ukuran}}</p>

                            @endforeach
                        </td>
                        <td style="width: 11.6535%; height: 326px;">
                            @foreach($detail_sj as $det_sj)

                                <center><p>{{$det_sj->qty}}<br></p></center>

                            @endforeach
                        </td>
                        <td style="width: 25%; height: 326px;">
                            @foreach($detail_sj as $det_sj)

                                <p>{{$det_sj->spesifikasi_barang}}<br></p>

                            @endforeach
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr style="height: 147px;">
            <td style="width: 100%; height: 147px;">
                <p><strong><em>Catatan:</em></strong></p>
                <p>Barang - barang yang keluar dari gudang diluar tanggung jawab pengirim Lembar ASLI dari surat jalan ini harap dikirim kembali ke pengirim dalam waktu 3 (tiga) hari sejak tanggal penerimaan barang.</p>
                <p>Hak kepemilikan barang - barang tersebut tetap pada kami.</p>
            </td>
        </tr>
        </tbody>
    </table>
    <p>&nbsp;</p>

@endsection
