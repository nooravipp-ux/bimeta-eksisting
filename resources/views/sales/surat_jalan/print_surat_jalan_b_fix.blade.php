@extends('adminlte::page')

@section('adminlte_css')


@endsection
@section('content')
    <style>
        table.center {
            margin-left: 0 ;
            margin-right: auto;
        }
        td {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 16px;
            color: black;
            text-align: left;

        }
        p.big {
            line-height: 1 ;
        }
        textarea {
            font-size: 15px;
        }

        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
        }
        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }
        .page {
            width: 220mm;
            min-height: 300mm;
            padding: 1mm;
            margin: 5mm auto;
            border: 3px black solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .subpage {
            padding: 10mm;
            border: 1px red solid;
            height: 300mm;
            outline: 2mm white solid;
        }

        @page {
            size: A4;
            margin: 0;
        }
        @media print {
            html, body{
                width: 220mm;
                height: 300mm;
            }
            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                background: initial;
                page-break-after: always;
            }
        }

    </style>
    <!--<p>&nbsp;</p>-->
    <!--<p>&nbsp;</p>-->

    <div class="page">
        <div class="subpage">

    <table class="center" style="border-collapse: collapse; width: 240mm; height: 260mm;" border="3" id="tabel_detail">
        <tbody>
        <tr style="height: 600px;">
            <td style="width: 100%; height: 10px;">
                <table style="height: 177px; width: 100%; border-collapse: collapse;" border="0">
                    <tbody>
                    <tr style="height: 18px;">
                        <td style="width: 100%; height: 18px; text-align: center; " colspan="4">
                            <p style="font-size: 30px;">SURAT JALAN</p>
                        </td>
                    </tr>
                    <tr style="height: 10px;">
                        <td style="height: 10%; width: 8%; text-align: center; vertical-align: middle;" rowspan="2"><img src="{{ asset(config('bimeta.logo_img', 'vendor/adminlte/dist/img/bimeta.png')) }}" alt="{{config('bimeta.logo_img_alt', 'bimeta')}}" class="brand-image" style="opacity: .8" width="75" height="40"></td>
                        <td style="height: 10px; width: 32%;" colspan="2">  <b>PT. BIMETA KARNUSA</b></td>
                        <td style="width: 60%; text-align: left; height: 28px;" rowspan="2">NO: <h3><strong>{{substr("$header_sj->no_surat_jalan",1,2).substr("$header_sj->no_surat_jalan",5,6)}}</strong></h3>
                    </tr>
                    <tr style="height: 10px;">
                        <td style="width: 32,5%; height: 18px;" colspan="2"><b>BANDUNG</b></td>
                    </tr>
                    <tr style="height: 18px;">
                        <td style="width: 75%; height: 18px;" colspan="3">&nbsp;</td>
                        <td style="width: 25%; height: 18px;">Kepada Yth :</td>
                    </tr>
                    <tr style="height: 21px;">
                        <td style="width: 8%; height: 21px;">DO. No.</td>
                        <td style="width: 8%; height: 21px;"> &amp; Tgl. : </td>
                        <td style="width: 54%; height: 21px;"><strong>{{substr("$header_sj->no_surat_jalan",1,2).substr("$header_sj->no_surat_jalan",5,6)}} /  {{date('d-m-Y', strtotime($header_sj->tgl_surat_jalan))}}</strong> </td>
                        <td style="width: 30%; height: 88px; vertical-align:top" rowspan="4"><strong>{{$header_sj->nama_customer}}</strong><br /><strong>{{$header_sj->alamat_customer}}</strong><br /><strong>{{$header_sj->kota}}</strong></td>
                    </tr>
                    <tr style="height: 23px;">
                        <td style="width: 8%; height: 23px;">PO. No.</td>
                        <td style="width: 8%; height: 23px;"> &amp; Tgl. : </td>
                        <td style="width: 54%; height: 23px;"><strong>{{$header_sj->no_po_customer}}</strong></td>
                    </tr>
                    <tr style="height: 44px;">
                        <td style="width: 25%; height: 44px;" colspan="3">Bersama ini kami kirimkan barang - barang seperti tercantum dibawah ini</td>
                    </tr>
                    <tr style="height: 25px;">
                        <td style="width: 33,3%; height: 25px;" colspan="2">Pengangkutan :</td>
                        <td style="width: 33,3%; height: 25px; text-align: center">No. Kendaraan :<strong style="font-size: 18px;">{{$header_sj->plat_nomor}}</strong></td>
                        <td style="width: 33,4%; height: 25px;">&nbsp;</td>
                        <!--<td style="width: 31.0662%; height: 25px;">&nbsp;</td>-->
                    </tr>
                    </tbody>
                </table>
                
                <table style="border-collapse: collapse; width: 100%; height: 480px; margin-top: 10px;" border="3">
                    <tbody>
                    <tr style="height: 33px;">
                        <td style="width: 5%; text-align: center; height: 33px;"><strong>NO.</strong></td>
                        <td style="width: 60%; text-align: center; height: 33px;"><strong>JENIS BARANG/ UKURAN</strong></td>
                        <td style="width: 1%; text-align: center; height: 33px;"><strong>Qty</strong></td>
                        <td style="width: 30%; text-align: center; height: 33px;"><strong>KETERANGAN</strong></td>
                    </tr>
                    <tr style="height: 154px;" border="1" rowspan="2">

                        <td style="width: 5.5147%; height: 326px;"valign="top">
                            <?php $no = 1; ?>
                            <!--@foreach($detail_sj as $det_sj)-->

                                <center><p class="big" margin-top:0%>{{$no++}}</p></center>



                                        <!--@if($det_sj->keterangan=='ada')  <textarea cols="5" rows="3" id="ket" style="border:solid 0px;"> </textarea>
                                        @else  <P class="big">&nbsp</P>
                                        @endif

                            @endforeach-->
                        </td>
                        <td style="width: 57.8318%; height: 326px;" valign="top">
                            @foreach($detail_sj as $det_sj)

                                <p class="big">&nbsp;{{$det_sj->nama_barang}}</p>
                                <P class="big"><b>&nbsp;{{$det_sj->ukuran}}</b></P>
                                @if($det_sj->keterangan=='ada')  <p><textarea cols="60" rows="1" id="ket" style="border:solid 0px;"> </textarea></p>
                                @endif
                            @endforeach

                        </td>
                        <td style="width: 11.6535%; height: 326px;" valign="top">
                            @foreach($detail_sj as $det_sj)

                                <center><p class="big" style="font-family:'Calibri'; font-size:20px"><b>{{$det_sj->qty}}</b><br></p></center>

                                @if($det_sj->keterangan=='ada')  <textarea cols="5" rows="1" id="ket" style="border:solid 0px;"> </textarea>
                                @else  <P class="big">&nbsp</P>
                                @endif
                            @endforeach
                        </td>
                        <td style="width: 25%; height: 326px;"valign="top">
                            @foreach($detail_sj as $det_sj)
                                <p class="big">&nbsp;{{$det_sj->spesifikasi_barang}}<br></p>
                                @if($det_sj->keterangan=='ada')  <textarea cols="5" rows="1" id="ket" style="border:solid 0px; height:auto;"> </textarea>
                                @else  <P class="big">&nbsp</P>
                                @endif
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <!--@foreach($detail_sj as $det_sj)
                        @if($det_sj->keterangan=='ada')  <textarea cols="5" rows="1" id="ket" style="border:solid 0px;"> </textarea>
                                        @else  <P class="big">&nbsp</P>
                                        @endif

                            @endforeach-->
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr style="height: 150px;">
            <td style="width: 100%; height: 150px;">
                <p style="margin-top: 4px; margin-bottom: 4px;">
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Atas nama Perusahaan kami telah menerima barang - barang tersebut dengan baik &amp; benar</p>
                <table style="border-collapse: collapse; width: 100%;" border="3">
                    <tbody>
                    <tr>
                        <td style="width: 33.3333%; text-align: center;">
                            <p>Diterima Tgl.  ...................</p>
                            <p>&nbsp;</p>
                            <p>&nbsp;</p>
                            <p>(______________________)</p>
                            <p>nama terang &amp; stempel perusahaan</p>
                        </td>
                        <td style="width: 33.3333%; text-align: center;">
                            <p>Pengemudi</p>
                            <p>&nbsp;</p>
                            <p>&nbsp;</p>
                            <p>(______________________)</p>
                            <p>nama terang</p>
                        </td>
                        <td style="width: 33.3333%; text-align: center;">
                            <p>Dibuat Tgl.<b> {{date('d-m-Y', strtotime($header_sj->tgl_surat_jalan))}}</b></p>
                            <p>&nbsp;</p>
                            <p>&nbsp;</p>
                            <p>(______________________)</p>
                            <p>nama terang </p>
                        </td>
                    </tr>
                    </tbody>
                </table>
                
                <p></p>
                <p style="font-size: 16px;"><strong><em>Catatan:</em></strong>&nbsp;&nbsp;Barang - barang yang keluar dari gudang diluar tanggung jawab pengirim Lembar ASLI dari surat jalan ini </p>
                <p style="font-size: 16px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;harap dikirim kembali ke pengirim dalam waktu 3 (tiga) hari sejak tanggal penerimaan barang.</p>
                <p style="font-size: 16px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hak kepemilikan barang - barang tersebut tetap pada kami.</p>
            </td>
        </tr>
        </tbody>
    </table>

    </div>
    </div>
    <p>&nbsp;</p>

@endsection
@section('plugin_js')
    <script type="text/javascript">
        if(document.getElementById("ket").getAttribute('value') == 'ada'){
            document.getElementById("ket").style.display = 'none';
        }
    </script>
@endsection