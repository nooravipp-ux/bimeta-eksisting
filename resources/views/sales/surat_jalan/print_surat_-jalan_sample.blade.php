@extends('adminlte::page')

@section('adminlte_css')
<style>
    .text {
        font-size: 20px;
	font-family:sans-serif;
    }
    .space {
        margin-top: 35px;
    }
    .nama-barang {
        padding-left: 50px;
    }

    .table tr td{
        border:hidden;
	padding-top:0;
	padding-left:80px;
        padding-bottom:0px;
	text-align:left;
    }
	br,tr{
		line-height:2;	
	}

.nothing {
    border: 0;
    outline: none;
    font-weight:bold;
}
	#fontuk{
	   font-size:25px;
	}

</style>

@endsection
@section('content')
<section class="invoice">
    <div class="invoice p-3 mb-3" style="border:solid;border-color:white;height:1300px;margin-top: 82px;margin-left: 115px;">
        <!-- Header row -->
        <div class="row">
            <div class="col-6 text-left"  id="text" style="font-size: xx-large;">PT.BIMETA KARNUSA<p style="padding-left: 78px;">BANDUNG</p></div>
            <div class="col"> </div>
            <div class="col-4 text-left" id="text">____________________ Tgl. {{date('d-M-Y', strtotime($header_sj->tgl_surat_jalan))}} <br>Kepada Yth.<br>___________________________________________<br>___________________________________________</div>
        </div>
        <div class="row">
            <div class="col-8 text-right" id="SSJM">SURAT JALAN SAMPLE</div>
            <div class="col-4 line"></div>
        </div>
        <div class="row">
            <div class="col-4 text-left"><u>No.</u></div>
            <div class="col-4"></div>
            <div class="col-4"></div>
        </div>
        <div class="row">
            <div class="col-12 text-left">Bersama ini kendaraan ________________________ No. ____________ Kami kirim barang-barang tersebut di bawah ini</div>
        </div>
        <div class="row">
            <table class="table">
                <thead>
                    <tr class="head">
                        <th>Banyaknya</th>
                        <th>NAMA BARANG</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
		    @foreach($detail_sj as $det_sj)
                    <tr>
                        <td>{{$det_sj->qty}}</td>
                        <td>{{$det_sj->nama_barang}}<br>{{$det_sj->ukuran}}</td>
                        <td>{{$det_sj->spesifikasi_barang}}</td>
                    </tr>
		    @endforeach
                </tbody>
            </table>
        </div>
        <div class="footer">
            <div class="row">
                <div class="col">Yang Menerima</div>
                <div class="col"></div>
                <div class="col">Hormat kami</div>
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


