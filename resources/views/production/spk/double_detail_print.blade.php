@extends('adminlte::page')

@section('adminlte_css')
<style>
@media print {
    @page {
        margin: 0;
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
    top: 166px;
    left: 5px;
    z-index: 1;
}

.invoice {
    font-size: 19px;
}

#fontuk {
    font-size: 25px;
}
</style>
@endsection
@section('content')
<section class="invoice">
    <div class="invoice p-3 mb-3">
        <br>
        <div class="row">
            <div class="col-sm">
                <strong>PT.BIMETA KARNUSA<br>BANDUNG</strong>
            </div>
            <div class="col-sm text-right">
                <strong>NO.SO :{{$show_header->id_so}}</strong>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <input type="hidden" id="tipe_spk" value="{{$show_header->tipe_spk}}">
                <strong>NO SPK<strong>:<strong class="text-spk"><span id="tipe_spk1"></span>
                            {{substr($show_header->no_spk, 3)}}</strong>
            </div>
            <div class="col-sm">

            </div>
            <div class="col-sm">
                <strong>TANGGAL: {{date('d-m-Y', strtotime($show_header->tgl_spk))}}</strong>
            </div>
        </div>
        <div style="border: solid;height: 100%">
            <div class="row">
                <div class="col-sm" style="padding-left: 31px;" id="fontuk">
                    <strong>NAMA PEMESAN: {{$show_header->nama_customer}}</strong><br>
                    <strong>KETERANGAN: {{substr($show_header->nama_barang,0, -8)}}</strong>
                </div>

                <div class="col-sm" style="width:50px;text-align:center;">
                    <strong id="fontuk" style="padding-right: 35px;">NO PO: {{$show_header->no_po_customer}}
                    </strong><br>
                    <strong>TANGGAL PENGIRIMAN: </strong><br>
                    <br>
                </div>
            </div>
            <div class="row-12">
                <div class="col-sm">
                    <table class="table header">
                        <thead>
                            <tr>
                                <th scope="col">BANYAK SHEET</th>
                                <th scope="col">QTY ORDER</th>
                                <th scope="col" style="border-top: hidden;border-bottom: hidden;width: 1%;"></th>
                                <th colspan="3" style="width: 175px;height: 15px;">UKURAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td scope="row" style="height: 80px;width:22%;"></td>
                                <td scope="row" id="fontuk"></td>
                                <td scope="row" style="border-top: hidden;border-bottom: hidden;"></td>
                                <td colspan="3" id="fontuk"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row-12">
                <div class="col-sm">
                    <table class="table info">
                        <thead>
                            <tr>
                                <th class="text-center" colspan="2" style="width:50%;">KUALITAS</th>
                                <th scope="col" style="border-top: hidden;border-bottom: hidden;width: 1%;"></th>
                                <th class="text-center" colspan="4">UKURAN SHEET</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="2" class="text-center" id="fontuk"></td>
                                <td scope="row"></td>
                                <td colspan="2" style="width:24%;height:80px;padding-left: 0px;padding-top: 0px;">
                                    NETTO:</td>
                                <td colspan="2" style="padding-left: 0px;padding-top: 0px;">BRUTO:</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="border-bottom: hidden;border-left: hidden;"></td>
                                <td scope="row" style="border-top: hidden;border-bottom: hidden;border-left: hidden;">
                                </td>
                                <td rowspan="4" style="width: 100px;border-left: hidden;border-bottom: hidden;"></td>
                                <th colspan="3">CETAKAN</th>
                            </tr>
                            <tr>
                                <td colspan="3" style="border-top: hidden;border-bottom: hidden;border-left: hidden;">
                                    <img class="img" id="img-box1" src="{{asset('/img/kardus.png')}}" height="55%"
                                        width="55%">
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
                            <td class="opr">OPT</td>
                            <td>HSL</td>
                            <td>TGL</td>
                            <td class="opr">OPT</td>
                            <td>HSL</td>
                            <td>TGL</td>
                            <td class="opr">OPT</td>
                            <td>HSL</td>
                            <td>TGL</td>
                            <td class="opr">OPT</td>
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
                            <th>FLEXO</th>
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
                        </tr>
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
                        <tr>
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
                        </tr>
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
                        <tr>
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
                        </tr>
                    </table>
                </div>
            </div>
        </div>
<br><br><br>
        <div class="row">
            <div class="col-sm">
                <strong>PT.BIMETA KARNUSA<br>BANDUNG</strong>
            </div>
            <div class="col-sm text-right" id="fontuk">
                <strong>NO.SO :{{$show_header->id_so}}</strong>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <strong>NO SPK<strong>:<strong class="text-spk"><span id="tipe_spk2"></span>
                            {{substr($show_header->no_spk, 3)}}</strong>
            </div>
            <div class="col-sm">

            </div>
            <div class="col-sm">
                <strong>TANGGAL: {{date('d-m-Y', strtotime($show_header->tgl_spk))}}</strong>
            </div>
        </div>
        <div style="border: solid;height: 100%">
            <div class="row">
                <div class="col-sm" style="padding-left: 31px;" id="fontuk">
                    <strong>NAMA PEMESAN: {{$show_header->nama_customer}}</strong><br>
                    <strong>KETERANGAN: {{$show_header->nama_barang}}</strong>
                </div>

                <div class="col-sm" style="width:50px;text-align:center;">
                    <strong id="fontuk" style="padding-right: 35px;">NO PO: {{$show_header->no_po_customer}}
                    </strong><br>
                    <strong>TANGGAL PENGIRIMAN: </strong><br>
                    <br>
                </div>
            </div>
            <div class="row-12">
                <div class="col-sm">
                    <table class="table header">
                        <thead>
                            <tr>
                                <th scope="col">BANYAK SHEET</th>
                                <th scope="col">QTY ORDER</th>
                                <th scope="col" style="border-top: hidden;border-bottom: hidden;width: 1%;"></th>
                                <th colspan="3" style="width: 175px;height: 15px;">UKURAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td scope="row" style="height: 80px;width:22%;"></td>
                                <td scope="row" id="fontuk"></td>
                                <td scope="row" style="border-top: hidden;border-bottom: hidden;"></td>
                                <td colspan="3" id="fontuk"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row-12">
                <div class="col-sm">
                    <table class="table info">
                        <thead>
                            <tr>
                                <th class="text-center" colspan="2" style="width:50%;">KUALITAS</th>
                                <th scope="col" style="border-top: hidden;border-bottom: hidden;width: 1%;"></th>
                                <th class="text-center" colspan="4">UKURAN SHEET</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="2" class="text-center" id="fontuk"></td>
                                <td scope="row"></td>
                                <td colspan="2" style="width:24%;height:80px;padding-left: 0px;padding-top: 0px;">
                                    NETTO:</td>
                                <td colspan="2" style="padding-left: 0px;padding-top: 0px;">BRUTO:</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="border-bottom: hidden;border-left: hidden;"></td>
                                <td scope="row" style="border-top: hidden;border-bottom: hidden;border-left: hidden;">
                                </td>
                                <td rowspan="4" style="width: 100px;border-left: hidden;border-bottom: hidden;"></td>
                                <th colspan="3">CETAKAN</th>
                            </tr>
                            <tr>
                                <td colspan="3" style="border-top: hidden;border-bottom: hidden;border-left: hidden;">
                                    <img class="img" id="img-box2" src="{{asset('/img/kardus.png')}}" height="55%"
                                        width="55%">
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
                            <td class="opr">OPT</td>
                            <td>HSL</td>
                            <td>TGL</td>
                            <td class="opr">OPT</td>
                            <td>HSL</td>
                            <td>TGL</td>
                            <td class="opr">OPT</td>
                            <td>HSL</td>
                            <td>TGL</td>
                            <td class="opr">OPT</td>
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
                            <th>FLEXO</th>
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
                        </tr>
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
                        <tr>
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
                        </tr>
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
                        <tr>
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
                        </tr>
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
    var tipe_spk = $('#tipe_spk').val();
    console.log(tipe_spk);
    if (tipe_spk == "AB") {
        $('#tipe_spk1').text("A");
        $('#img-box2').hide();
        $('#tipe_spk2').text("B");
    } else if (tipe_spk == "BA") {
        $('#tipe_spk2').text("A");
        $('#img-box1').hide();
        $('#tipe_spk1').text("B");
    } else if (tipe_spk == "AA") {
        $('#tipe_spk1').text("A");
        $('#tipe_spk2').text("A");
    } else if (tipe_spk == "BB") {
        $('#tipe_spk1').text("B");
        $('#tipe_spk2').text("B");
        $('#img-box2').hide();
        $('#img-box1').hide();
    }



    window.print();
});
</script>
@endsection