@extends('adminlte::page')

@section('adminlte_css')
<style>
@media print {
    @page {
        margin: auto 0;
    }
}

.header {
    border: 4px solid black;
    border-collapse: collapse;
    position: relative;
    text-align: center;
}

.header td {
    border: 3px solid black;
    border-collapse: collapse;
    height: 15px;
}

.header th {
    border: 3px solid black;
    border-collapse: collapse;
    height: 5px;
}

.info {
    border: 3px solid black;
    border-collapse: collapse;
    position: relative;
}

.info td {
    border: 3px solid black;
    border-collapse: collapse;
}

.info th {
    border: 3px solid black;
    border-collapse: collapse;
}

.text-spk {
    font-size: 24px;
}

.img {
    position: absolute;
    top: 155px;
    left: 25px;
    z-index: 1;
}

.invoice {
    font-size: 19px;
}

#fontuk {
    font-size: 28px;
    font-family: candara;
}

.opr {
  width:200px;

#data {
border: 0px;
}
}
</style>
@endsection
@section('content')
<section class="invoice">
    <div class="invoice p-3 mb-3">
        <div class="row"><br>
            <div class="col-sm">
                <strong>PT.BIMETA KARNUSA<br>BANDUNG</strong>
            </div>
            <div class="col-sm text-right" id="fontuk">
                <strong>NO.SO :{{$show_header->id_so}}</strong>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <input type="hidden" id="tipe_spk" value="{{$show_header->tipe_spk}}">
                <strong>NO SPK<strong>:<strong class="text-spk" id="fontuk"><span id="tipe_spk1"></span>
                            {{substr($show_header->no_spk,3)}}</strong>
            </div>
            <div class="col-sm">

            </div>
            <div class="col-sm">
                <strong style="font-size:22px;">TANGGAL: {{date('d-m-Y', strtotime($show_header->tgl_spk))}}</strong>
            </div>
        </div>
        <div style="border: solid;height: 100%">
            <!--<div class="row">
                <div class="col-sm" style="padding-left: 31px;" id="fontuk">
                    <strong>KONSUMEN: {{$show_header->nama_customer}}</strong><br>
                    <strong>NAMA BARANG: {{$show_header->nama_barang}}</strong>
                </div>

                <div class="col-sm" style="width:10px;">
                </div>

                <div class="col-sm" style="width:30%;">
                    <strong id="fontuk" style="">NO PO: {{$show_header->no_po_customer}}</strong><br>
                    <strong>TANGGAL PENGIRIMAN:</strong><br>
                    <br>
                </div>
            </div>-->
            <div class="row">
		    <table class="col-sm" id="data" style="margin-bottom:10px; margin-left:30px;">
               	
			<tr style="font-size:24px;">
				<td style="width:65%;"><strong>KONSUMEN: {{$show_header->nama_customer}}</strong><br></td>
				<td><strong id="fontuk" style=""> NO PO: {{$show_header->no_po_customer}}</strong><br></td>
			</tr>

			<tr>
				<td><strong>NAMA BARANG: {{$show_header->nama_barang}}</strong></td>
				<td><strong>TANGGAL PENGIRIMAN:</strong><br></td>
			</tr>
                </div>
		    </table>
	        </div>
            <div class="row-12">
                <div class="col-sm">
                    <table class="table header">
                        <thead>
                            <tr>
                                <th scope="col">BANYAK SHEET</th>
                                <th scope="col">KUANTITAS ORDER</th>
                                <th scope="col" style="border-top: hidden;border-bottom: hidden;width: 1%;"></th>
                                <th colspan="3" style="width: 175px;height: 15px;">UKURAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($detail_print as $dp)
                            <tr>
                                <td scope="row" style="height: 80px;width:22%;"></td>
                                <td scope="row" id="fontuk">{{$dp->qty}}</td>
                                <td scope="row" style="border-top: hidden;border-bottom: hidden;"></td>
                                <td colspan="3" id="fontuk">{{$dp->ukuran}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row-12">
                <div class="col-sm">
                    <table class="table info">
                        <thead>
                            <tr>
                                <th class="text-center" colspan="2" style="width:46.8%;">KUALITAS</th>
                                <th scope="col" style="border-top: hidden;border-bottom: hidden;width: 1%;"></th>
                                <th class="text-center" colspan="4">UKURAN SHEET</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($detail_print as $dp)
                            <tr>
                                <td colspan="2" class="text-center" id="fontuk">{{$dp->spesifikasi_barang}}</td>
                                <td scope="row"></td>
                                <td colspan="2" style="width:24%;height:80px;padding-left: 0px;padding-top: 0px;">
                                    NETTO:</td>
                                <td colspan="2" style="padding-left: 0px;padding-top: 0px;">BRUTO:</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="2" style="border-bottom: hidden;border-left: hidden;"></td>
                                <td scope="row" style="border-top: hidden;border-bottom: hidden;border-left: hidden;">
                                </td>
                                <td rowspan="4" style="width: 100px;border-left: hidden;border-bottom: hidden;"></td>
                                <th colspan="3">CETAKAN</th>
                            </tr>
                            <tr>
                                <td colspan="3" style="border-top: hidden;border-bottom: hidden;border-left: hidden;">
                                    <img class="img" id="img-box" src="{{asset('/img/kardus.png')}}" width="55%"
                                        height="60%">
                                </td>
                                <td colspan="3" style="width: 100px;height: 80px;"></td>
                            </tr>
                            <tr>
                                <td colspan="3" style="border-top: hidden;border-bottom: hidden;border-left: hidden;">
                                </td>
                                <th class="text-center" scope="row">STITCHING</th>
                                <th class="text-center" scope="row" style="width: 114px;">LEM</th>
                                <th class="text-center" scope="row">POUNCH</th>
                            </tr>
                            <tr>
                                <td colspan="3"
                                    style="border-top: hidden;border-bottom: hidden;border-left: hidden;border-right: hidden;">
                                </td>
                                <td scope="row"></td>
                                <td scope="row"></td>
                                <td scope="row" style="width: 100px;height: 80px;"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row-12">
                <div class="col-md-12">
                    <table class="table info">
                        <tr>
                            <th>BAGIAN</th>
                            <td>TGL</td>
                            <td class="opr" style="text-align: center">OPT</td>
                            <td>HSL</td>
                            <td>TGL</td>
                            <td class="opr" style="text-align: center">OPT</td>
                            <td>HSL</td>
                            <td>TGL</td>
                            <td class="opr" style="text-align: center">OPT</td>
                            <td>HSL</td>
                            <td>TGL</td>
                            <td class="opr" style="text-align: center">OPT</td>
                            <td>HSL</td>
                            <td>TOTAL</td>
                        </tr>
                        <tr>
                            <th>SLITTER</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>SLOTTER</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>PRINT</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <!--<tr>
                            <th>LONGWAY</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>-->
                        <tr>
                            <th>PRINT SLOT</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>COAK</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>POUNCH</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>TRIPLE</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>LAMINASI</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>KANCING</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <!--<tr>
                            <th>KUPAS</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>-->
                        <tr>
                            <th>LEM</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <!--<tr>
                            <th>MUAT</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>-->
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('plugin_js')

<script>
$(document).ready(function() {
    var satuan = $('#tipe_spk').val();
    console.log(satuan);
    if (satuan == "A") {
        $('#tipe_spk1').text("A");
    } else {
        $('#tipe_spk1').text("B");
        $('#img-box').hide();
    }

    window.print();
});
</script>
@endsection