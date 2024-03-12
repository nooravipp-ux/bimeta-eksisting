

@extends('adminlte::page')

@section('adminlte_css')
<style>
table{border-style: solid;
      border-color: white;
      font-size:17px;
      }

.table td{
  padding-left: 40px;
  /* padding-right: 0px; */
}

th{border-style:hidden;
    border-color: black;
    font-size:17px;}

tr{border-style:hidden;
    border-color: black;
    text-align: left;
    font-size:17px;}

td{border-style:hidden;
    border-color: black;
    text-align: left;
    font-size:17px;}



#total_item,#sub_total,#pajak,#grand_total{
  font-weight:bold;
  font-size:17px;
  padding-left: 0px;
}



.ft{
  font-weight:bold;
  font-size:17px;
}

.pj ul{
  list-style-type: none;
   
}

.jumlah-total {
    position: absolute;
    bottom: 0;
    right: 0;
    margin-right: 240px;
    margin-bottom: 170px;
}
    .space {
        margin-top: 35px;
    }
    .nama-barang {
        padding-left: 50px;
    }

    .table tr td{
        border: hidden;
        padding-bottom:0px;
    }

</style>

@endsection
@section('content')
<section class="invoice">
<div class="invoice p-3 mb-3" style="border:solid;border-color:white;height:1300px;">
              <!-- title row -->
              <div class="row">
                <div class="col-sm-4">
                  <br><br>
                  <address>
                      <!-- <strong style="font-size: 25px;">PT. BIMETA KARNUSA BANDUNG</strong><br> -->
                  </address>
                </div>
                <div class="col-sm-6 text-center">
                  <h2>
                    <!-- <strong style="text-decoration: underline;"> SURAT JALAN </strong>
                    <p><b>INVOICE</b></p> -->
                  </h2>
                </div>
                <div class="col-sm-2 text-center" style="padding-top: 45px;">
                    <br><br>
                    <!-- <strong style="font-size: 21px;">{{$header_sj->no_surat_jalan}}</strong><br> -->
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info header">
                <div class="col-sm-5 invoice-col" style="padding-top: 91px;margin-left: 0px;padding-left: 0px;">
                    <strong style="font-size: 21px;margin-bottom: 0px;">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<b>{{substr($header_sj->no_surat_jalan, 3)}} / {{date('d-m-Y')}}</b></strong><br>
                    <strong style="font-size: 21px;">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<b>{{$header_sj->no_po_customer}}</b></strong>
                    <!-- <p>Bersama ini kami kirimkan barang - barang seperti tercantum di bawah ini dengan :</p>
                    <p>Pengangkutan : _______________</p> -->
                </div>
                <!-- /.col -->
                <div class="col-sm-2 invoice-col text-center" style="margin-left:150px";>

                    <br>
                    <br>
                    <br>
                    <br>
                    <br>


                </div>
                <!-- /.col -->
                <div class="col-sm-3
 invoice-col text-left" style="font-size: 19px;margin-top: 95px;border-top-width: 15px";>
                <!-- <p>Kepada Yth:</p> -->
                  <strong>{{$header_sj->nama_customer}}</strong><br>
                  <strong>{{$header_sj->alamat_customer}}</strong><br>
                  <strong>{{$header_sj->kota}}</strong><br>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4 text-center" style="margin-top: 7px;">
                    <div class="surat_jalan">
                        <b><strong style="font-size: 21px;padding-left: 166px;">{{$header_sj->plat_nomor}}</strong></b>
                    </div>
                </div>
                <div class="col-sm-4"></div>
              </div>
              <!-- Table row -->
              <div class="row" style="margin-top:60px;">
                <div class="col-12 table-responsive" style="margin-top: 44px;">
                  <table class="table text-left" id="tabel_detail">
                    <thead>
                    <tr>
                      <!-- <th rowspan="2">NO//</th>
                      <th rowspan="2">JENIS BARANG / UKURAN</th>
                      <th rowspan="2" style="padding-left: 0px;padding-right: 0px;">TOTAL LBR/PCS</th>
                      <th colspan="2">HARGA</th>
                      <th rowspan="2">KETERANGAN</th> -->
                      <!-- <th rowspan="2"></th>
                      <th rowspan="2"></th>
                      <th rowspan="2" style="padding-left: 0px;padding-right: 0px;"></th>
                      <th colspan="2"></th>
                      <th rowspan="2"></th> -->
                    </tr>
                    <tr class="text-left">
                      <th></th>
                      <th></th>
                      <!-- <th>SATUAN</th>
                      <th>JUMLAH</th> -->
                    </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach($detail_sj as $det_sj)
                        <tr style="font-size: 21px;" class="text-right">
                          <td class="text font-weight-bold" style="padding-right: 50px; width: 35px;">{{$no++}}</td>
                          <td width="" class="text font-weight-bold" style="width: 341px;padding-left: 7px;">{{$det_sj->nama_barang}}<br>{{$det_sj->ukuran}}</td>
                          <td class="harga text font-weight-bold" style="padding-right: 50px;">{{$det_sj->qty}}</td>
                          <td class="harga text font-weight-bold">{{$det_sj->harga_satuan}}</td>
                          <td class="total_item text font-weight-bold" id="total_item" style="padding-left:50px";></td>
                          <td class="text font-weight-bold" style="padding-left:90px">{{$det_sj->spesifikasi_barang}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    
                  </table>

                  <!-- <p>Atas nama perusahaan kami telah menerima barang-barang tersebut dengan baik dan benar.</p> -->
                  <!-- <textarea name="note" id="" cols="60" rows="5"></textarea> -->
                </div>
                <!-- /.col -->
              </div>
              
              <div class="row jumlah-total">
                <div class="col-sm">
                  <br><br>
                  <address>
                      <!-- <strong style="font-size: 25px;">PT. BIMETA KARNUSA BANDUNG</strong><br> -->
                  </address>
                </div>
                <div class="col-sm">
                  <h2>
                    <!-- <strong style="text-decoration: underline;"> SURAT JALAN </strong>
                    <p><b>INVOICE</b></p> -->
                  </h2>
                </div>
                <div class="col-sm pj">
                        <ul style="padding-left: 55px;margin-bottom: 15px;">
                            <li id="sub_total" class="sub_total"></li>
                            <li id="pajak" class="pajak"></li>
                            <li id="grand_total" class="grand_total"></li>
                        </ul>
                </div>
                <!-- /.col -->
              </div>
  </section>


  <!-- /.content -->
@endsection

@section('plugin_js')

<script src="{{asset('js/accounting.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {
      $('#tabel_detail > tbody > tr').each(function () {
            var times = 1;
            $(this).find('.harga').each(function () {
                var harga = $(this).text();
                if (!isNaN(harga) && harga.length !== 0) {
                    times *= parseInt(harga);
                }
            });
            $('.total_item', this).html(accounting.formatMoney(times));

      });


      var sum = 0;
      $('#tabel_detail > tbody > tr').each(function () {

            $(this).find('.total_item').each(function () {
                var total_item = $(this).text().replace(/[.]+/g,"");
                    sum += parseInt(total_item);
            });
            $('.sub_total').text(accounting.formatMoney(sum));
      });


        setTaxValue();
        window.print();
    });

    function setTaxValue(){
        var pajak = "{{$header_sj->pajak}}";
        var sub_total = parseInt($('.sub_total').text());
        if(pajak == "V0"){
            var sub_tot =$('.sub_total').text().replace(/[.]+/g,"");
            var sub = parseInt(sub_tot);
            $('.pajak').text(accounting.formatMoney(sub*0));
            $('.grand_total').text(accounting.formatMoney((sub*0) + sub));
        }else{
            var sub_tot =$('.sub_total').text().replace(/[.]+/g,"");
            var sub = parseInt(sub_tot);
            $('.pajak').text(accounting.formatMoney(sub*11/100));
            $('.grand_total').text(accounting.formatMoney((sub*11/100) + sub));
        }
    }

    accounting.settings = {
        currency: {
          symbol : "",   // default currency symbol is '$'
          format: "%s%v", // controls output: %s = symbol, %v = value/number (can be object: see below)
          decimal : ",",  // decimal point separator
          thousand: ".",  // thousands separator
        },
        number: {
          precision : 0,  // default precision on numbers is 0
          thousand: ".",
          decimal : ","
        }
    } 
</script>

@endsection
