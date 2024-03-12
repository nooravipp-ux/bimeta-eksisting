@extends('adminlte::page')

@section('adminlte_css')
<style>
    .text {
        font-size: 24px;
	font-family:Candara;
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
		line-height:1.7;	
	}

.nothing {
    border: 0;
    outline: none;
    font-weight:bold;
}
	#fontuk{
	   font-size:28px;
	}

</style>

@endsection
@section('content')
<section class="invoice">
    <div class="invoice p-3 mb-3" style="border:solid;border-color:white;height:1300px;margin-top: 75px;margin-left: 115px;">
        <!-- Header row -->
        <div class="row">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-1">
                <div class="text font-weight-bold" style:"font-size:25px;">Bandung</div>
            </div>
            <div class="col-sm-5 text-center">
                <div class="tgl-sj text font-weight-bold" style:"font-size:25px;">{{date('d-M-Y', strtotime($header_sj->tgl_surat_jalan))}}</div>
            </div>
        </div>
        <div class="space"></div>
        <div class="row">
            <div class="col-sm-6" style="padding-top: 15px;padding-right:15px;">

            </div>
            <div class="col-sm-6" style="padding-top: 6px;">
                <div class="nama-customer text font-weight-bold">{{$header_sj->nama_customer}}</div>
                <div class="alamat-customer text font-weight-bold">{{$header_sj->alamat_customer}}</div>
            </div>
        </div>
        <!-- Row No SJ -->
        <div class="row no-sj">
            <div class="col-sm-6" style="padding-top: 25px; font-size:28px;">
                <div class="no-sj text font-weight-bold" id="fontuk">{{substr($header_sj->no_surat_jalan, 1)}}</div>
            </div>
            <div class="col-sm-6 text-center" style="padding-top: 15px;">
                <div class="kota text font-weight-bold">{{$header_sj->kota}}</div>
            </div>
        </div>
        <!-- Row no kendaraan -->
        <div class="row no-kendaraan">
            <div class="col-sm-12 text-center">
                <div class="plat-nomor text font-weight-bold" style="padding-right: 8rem;margin-top: 3px;">{{$header_sj->plat_nomor}}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 table-responsive" style="margin-top: 60px;">
                <table class="table text-left" id="tabel_detail">
                    <thead>
                        <!-- <th></th>
                        <th></th>
                        <th></th> -->
                        </tr>
                    </thead>
                    <tbody>
	  <tr>
	     <td></td>
                     	     <td class="nama-barang text font-weight-bold">PO: {{$header_sj->no_po_customer}}</td>
                           <td></td>
	  </tr>
                        @foreach($detail_sj as $det_sj)
                        <tr>
                          <!--<td class="qty text font-weight-bold" style="padding-left:2px; font-size:26px; ">{{$det_sj->qty}}<br><textarea type="text" class="nothing" cols="7"></textarea></td>-->
                          <td class="qty text font-weight-bold" style="padding-left:2px; font-size:28px; width:10%;">{{$det_sj->qty}}</td>
                          <td class="nama-barang text font-weight-bold" style="width:48%;">{{$det_sj->nama_barang}}<br>{{$det_sj->ukuran}}<br><textarea type="text" class="nothing"></textarea></td>
                          <td class="tipe-barang text font-weight-bold">{{$det_sj->spesifikasi_barang}}</td>
			                <input type="hidden" class="ket" value="{{$det_sj->keterangan}}">
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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

@endsection


