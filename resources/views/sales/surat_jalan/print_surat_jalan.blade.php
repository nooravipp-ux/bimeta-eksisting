@extends('adminlte::page')

@section('adminlte_css')


@endsection
@section('content')
    <style>
        td {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 18px;

            text-align: left;

        }
        p.big {
            line-height: 1 ;
        }
        textarea {
            font-family: Consolas;
            font-weight: bold;
            font-size: 20px;
        }
    </style>
    <p>&nbsp;</p>
    <p>&nbsp;</p>

    <table style="border-collapse: collapse; width: 101%; height: 10px;" border="3" id="tabel_detail">
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
                        <td style="height: 10px; width: 68.9339%;" colspan="3">  <img src="{{ asset(config('bimeta.logo_img', 'vendor/adminlte/dist/img/bimeta.png')) }}" alt="{{config('bimeta.logo_img_alt', 'bimeta')}}" class="brand-image" style="opacity: .8" width="60" height="30"><b>PT. BIMETA KARNUSA</b></td>

                        <td style="width: 31.0662%; text-align: left; height: 28px;" rowspan="2">NO:
                            <h3><strong>{{substr("$header_sj->no_surat_jalan",1,2).substr("$header_sj->no_surat_jalan",3,6)}}</strong></h3>
                    </tr>
                    <tr style="height: 18px;">
                        <td style="width: 68.9339%; height: 18px;" colspan="3"> <img src="{{ asset(config('bimeta.logo_img', 'vendor/adminlte/dist/img/bimeta.png')) }}" alt="{{config('bimeta.logo_img_alt', 'bimeta')}}" class="brand-image" style="opacity: .0" width="60" height="20"><b>BANDUNG</b></td>
                    </tr>
                    <tr style="height: 18px;">
                        <td style="width: 68.9339%; height: 18px;" colspan="3">&nbsp;</td>
                        <td style="width: 31.0662%; height: 18px;">Kepada Yth :</td>
                    </tr>
                    <tr style="height: 21px;">
                        <td style="width: 37.8677%; height: 21px;">DO. No. &amp; Tgl. : <strong>{{substr("$header_sj->no_surat_jalan",1,2).substr("$header_sj->no_surat_jalan",3,6)}} /  {{date('d-m-Y', strtotime($header_sj->tgl_surat_jalan))}}</strong> </td>
                        <td style="width: 23.3456%; height: 21px;">&nbsp;</td>
                        <td style="width: 7.72063%; height: 21px;">&nbsp;</td>
                        <!--<td style="width: 31.0662%; height: 88px;" rowspan="3"><strong>{{$header_sj->nama_customer}}</strong><br /><strong>{{$header_sj->alamat_customer}}</strong><br /><strong>{{$header_sj->kota}}</strong></td>-->
                        <td style="width: 31.0662%; height: 88px;" rowspan="3"><strong>{{$header_sj->nama_customer}}</strong><br />{{substr("$header_sj->alamat_customer",0,53)}}<br />{{$header_sj->kota}}</td>
                    </tr>
                    <tr style="height: 23px;">
                        <td style="width: 37.8677%; height: 23px;">PO. No. &amp; Tgl. : <strong>{{$header_sj->no_po_customer}}</strong></td>
                        <td style="width: 23.3456%; height: 23px;">&nbsp;</td>
                        <td style="width: 7.72063%; height: 23px;">&nbsp;</td>
                    </tr>
                    <tr style="height: 44px;">
                        <td style="width: 37.8677%; height: 44px;" colspan="3">Bersama ini kami kirimkan barang - barang seperti tercantum dibawah ini :</td>
                    </tr>
                    <tr style="height: 25px;">
                        <td style="width: 37.8677%; height: 25px;">Pengangkutan :</td>
                        <td style="width: 23.3456%; height: 25px;" colspan="2">No. Kendaraan : <strong>{{$header_sj->plat_nomor}}</strong></td>
                        <td style="width: 7.72063%; height: 25px;">&nbsp;</td>
                        <td style="width: 31.0662%; height: 25px;">&nbsp;</td>
                    </tr>
                    </tbody>
                </table>
                
                <table style="border-collapse: collapse; width: 100%; height: 459px; margin-top: 10px;" border="3">
                    <tbody>
                    <tr style="height: 33px;" border="3">
                        <td style="width: 5%; text-align: center; height: 33px;"><strong>NO.</strong></td>
                        <td style="width: 55%; text-align: center; height: 33px;" border="3"><strong>JENIS BARANG / UKURAN</strong></td>
                        <td style="width: 5%; text-align: center; height: 33px;" border="3"><strong>QTY</strong></td>
                        <td style="width: 35%; text-align: center; height: 33px;" border="3"><strong>KETERANGAN</strong></td>
        </tr>

        <tr style="height: 154px;">

                        <td style="width: 5%; height: 326px; font-family:'candara'; font-size:22px;" valign="top">
                            <?php $no = 1; ?>
                            @foreach($detail_sj as $det_sj)

                                <center><p class="big" margin-top:0%>{{$no++}}</p></center>



                                        @if($det_sj->keterangan=='ada')  <textarea cols="5" rows="1" id="ket" style="border:solid 0px;">
                                        </textarea> @else  <P class="big">&nbsp</P>
                                        @endif

                            @endforeach
                        </td>
                        <td style="width: 50%; height: 326px;" valign="top">
                            @foreach($detail_sj as $det_sj)

                                <p class="big" style="font-family:'candara'; font-size:22px;">&nbsp;{{$det_sj->nama_barang}}</p>
                                <P class="big" style="font-family:'Candara'; font-size:22px"><b>&nbsp;{{$det_sj->ukuran}}</b></P>
                                @if($det_sj->keterangan=='ada')  <textarea cols="30" rows="1" id="ket" style="border:solid 0px;"></textarea>
                                @endif
                            @endforeach

                        </td>
                        <td style="width: 10%; height: 326px;" valign="top">
                            @foreach($detail_sj as $det_sj)

                                <center><p class="big" style="font-family:'Candara'; font-size:25px;"><b>{{$det_sj->qty}}</b><br></p></center>

                                @if($det_sj->keterangan=='ada')  <textarea cols="5" rows="1" id="ket" style="border:solid 0px;"></textarea> 
                                @else  <P class="big">&nbsp</P>
                                @endif
                            @endforeach
                        </td>
                        <td style="width: 35%; height: 326px;"valign="top">
                            @foreach($detail_sj as $det_sj)
                                <p class="big" style=" font-family:'candara'; font-size:22px;">&nbsp;{{$det_sj->spesifikasi_barang}}<br></p>
                                @if($det_sj->keterangan=='ada')  <textarea cols="5" rows="1" id="ket" style="border:solid 0px;">  </textarea>
                                 @else  <P class="big">&nbsp</P>
                                @endif
                            @endforeach
                        </td>
                    </tr>

                    <!-- edited
                    @foreach($detail_sj as $det_sj)
                    <tr style="border-color: white;" border="1px">

                        <td style="width: 5%; height: 100%; font-family:'candara'; font-size:22px;"valign="top">
                        <?php $no = 1; ?>

                                <center><p class="big" margin-top:0%>{{$no++}}</p></center>

                        </td>

                        <td style="width: 50%;" valign="top">
                                <p class="big" style="font-family:'candara'; font-size:22px;">&nbsp;{{$det_sj->nama_barang}}</p>
                                <p class="big" style="font-family:'candara'; font-size:22px;"><b>&nbsp;{{$det_sj->ukuran}}</b></p>
                                @if($det_sj->keterangan=='ada')
                                <textarea cols="28" rows="1" id="ket" style="border:solid 0px;"></textarea>
                                @endif
                        </td>

                        <td style="width: 10%;" valign="top">
                                <center><p class="big" style="font-family:'Candara'; font-size:25px;"><b>{{$det_sj->qty}}</b></p></center>
                        </td>

                        <td style="width: 35%;"valign="top">
                                <p class="big" style=" font-family:'candara'; font-size:22px;">&nbsp;{{$det_sj->spesifikasi_barang}}</p>
                        </td>

                    </tr>
                    @endforeach-->
                    </tbody>
                </table>
            </td>
        </tr>
        <tr style="height: 147px;">
            <td style="width: 100%; height: 147px;">
                <p style="margin-top: 4px; margin-bottom: 4px;">
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Atas nama Perusahaan, kami telah menerima barang - barang tersebut dengan baik &amp; benar.</p>
                <table style="border-collapse: collapse; width: 100%;" border="3">
                    <tbody>
                    <tr>
                        <td style="width: 33.3333%; text-align: center;">
                            <p>Diterima Tgl. ...................</p>
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
                            <p>Dibuat Tgl.<b style=" font-family:candara; font-size:22px;"> {{date('d-m-Y', strtotime($header_sj->tgl_surat_jalan))}}</b></p>
                            <p>&nbsp;</p>
                            <p>&nbsp;</p>
                            <p>(______________________)</p>
                            <p>nama terang </p>
                        </td>
                    </tr>
                    </tbody>
                </table>
                
                <p></p>
                <p><strong><em>Catatan:</em></strong>&nbsp;&nbsp;Barang - barang yang keluar dari gudang diluar tanggung jawab pengirim Lembar ASLI dari surat jalan ini. </p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Harap dikirim kembali ke pengirim dalam waktu 3 (tiga) hari sejak tanggal penerimaan barang.</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hak kepemilikan barang - barang tersebut tetap pada kami.</p>
            </td>
        </tr>
        </tbody>
    </table>
    <p>&nbsp;</p>

@endsection
@section('plugin_js')
    <script type="text/javascript">
        if(document.getElementById("ket").getAttribute('value') == 'ada'){
            document.getElementById("ket").style.display = 'none';
        }
        window.print();
    </script>

    <script>
    /* To Disable Inspect Element */
    $(document).bind("contextmenu",function(e) {
     e.preventDefault();
    });

    $(document).keydown(function(e){
    if(e.which === 123){
       return false;
    }
    });
    </script>

<script>
document.onkeydown = function(e) {
if(event.keyCode == 123) {
return false;
}
if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)){
return false;
}
}
</script>

    <!--<script>
    $(document).ready(function() {
	$('#tabel_detail > tbody  > tr').each(function() {
        var ket = $(this).find('.ket').val();
        var text_ket = $(this).find('.nothing');
	
	if(ket != "ada"){
            ket.hide();
            }
        });
	window.print();
    });
    </script>-->

@endsection