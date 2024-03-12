@extends('adminlte::page')

@section('adminlte_css')
<style>
    #SSJM{
        font-size: xx-large;
        padding-right: 1rem;
    }
    #text{
        font-size: larger;
    }
    .line{
        border-bottom: 7px double;
    }
    .table{
        border-style: solid;
        border: solid 3px;
    }
    .head{
        border: solid 3px;
        border-bottom: solid;
    }
    th{
        border: 0px;
        border-left: solid;
        border-right: solid;
	    padding:0;
    }
    td{
        border: 0px;
        border-left: solid;
        border-right: solid;
        font-family: candara;
        font-size: 22px;
    }
    
    #text{
	font-size: 20px;	
    }
</style>
@endsection
@section('content')
<section class="invoice">
    <div class="invoice p-3 mb-3" style="border:solid; border-width: 1px;border-color:black;height:600px;margin-top: 35px;">
        <!-- Header row -->
        <div class="row">
            <div class="col-3 text-left"  id="text" style="font-size: 23px;"><b>PT. BIMETA KARNUSA<p>BANDUNG</p></b></div>
            <div class="col-6 text-center" id="SSJM"><u>SURAT JALAN SAMPLE</u><br><b style="font-size: 28px; font-family:candara;">No. {{substr($header_sj->no_surat_jalan, 1)}}</b></div>
            <!--<div class="col"> cek</div>-->
            <div class="col-3 text-left" id="text">Bandung, {{date('d-M-Y', strtotime($header_sj->tgl_surat_jalan))}}<br>Kepada Yth.<br><b>{{$header_sj->nama_customer}}</b><br>{{$header_sj->alamat_customer}}</div>
        </div>
        <!--<div class="row">
            <div class="col-8 text-right" id="SSJM"><u>SURAT JALAN SAMPLE</u></div>
        </div>-->
        <!--<div class="row">
            <div class="col-4 text-left" id="text"><u>No. <b>{{substr($header_sj->no_surat_jalan, 1)}}</b></u></div>
            <div class="col-4"></div>
            <div class="col-4"></div>
        </div>-->
        <div class="row">
            <div class="col-12 text-left" id="text">Bersama kendaraan dengan Nopol <b>{{$header_sj->plat_nomor}}</b>, Kami kirim barang-barang tersebut di bawah ini</div>
        </div>
        <div class="row">
            <table class="table">
                <thead>
                    <tr class="head">
                        <th>KUANTITAS</th>
                        <th>NAMA BARANG</th>
                        <th>KETERANGAN</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($detail_sj as $det_sj)
                    <tr>
                        <td><b>{{$det_sj->qty}}</b></td>
                        <td>{{$det_sj->nama_barang}} {{$det_sj->ukuran}}</td>
                        <td>{{$det_sj->spesifikasi_barang}}</td>
                    </tr>
		            @endforeach
                </tbody>
            </table>
        </div>
        <div class="footer" id="text">
            <div class="row">
                <div class="col">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yang Menerima</div>
                <div class="col"></div>
                <div class="col">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hormat kami</div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('plugin_js')

<script>
    $(document).ready(function() {
	$('#tabel_detail > tbody  > tr').each(function() {
        var ket = $(this).find('.ket').val();
        var text_ket = $(this).find('.nothing');
	
	if(ket != "ada"){
            text_ket.hide();
        }
});
	window.print();
});
</script>
@endsection


