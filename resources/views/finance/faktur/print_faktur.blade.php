@extends('adminlte::page')

@section('adminlte_css')
<style>
       hr{
            margin: 0;
            border-top: 5px double black;
        }
        p{
            margin: 0;
        }
        .header{
            border: solid 3px black;
            font-size: 24px;
        }
        table{
            border: solid 3px black;
            border-top: hidden;
        }
        .table thead th{
            border-right: solid 3px black;
            text-align: center;
            border-bottom: black 3px solid;
            vertical-align: middle;
        }
        .table tbody td{
            border: solid 3px black;
            font-size: 24px;
        }
        .table tfoot td{
            border-right: solid 3px black;
            margin: 0;
            padding: 0;
	    font-size: 24px;
        }
        #nom{
            text-align: right;
        }

        /* footer{
            position: absolute;
            margin-bottom: 0;
            margin-right: 0;
        } */    </style>
@endsection
@section('content')
<section class="invoice">
    <div class="invoice p-3 mb-3">
        <div class="row">
              <div class="col text-center" style="font-size: 50px;height: 5rem;"><strong>PT. BIMETA KARNUSA</strong></div>
          </div>
          <div class="row-24"><hr></div>
          <div class="row">
              <div class="col"></div>
              <div class="col" style="font-size: 27px; text-align: center;"><strong>FAKTUR PENJUALAN</strong></div>
              <div class="col" style="font-size: 25px;font-weight:bold;"><p>Nomor Seri : {{$header_faktur->no_surat_jalan}}<br>Nomor P.O&ensp;: {{$header_faktur->no_po_customer}}<br>Tanggal  &emsp;&ensp;: {{date('d/m/Y', strtotime($tgl_faktur))}} </p><br></div>
	  </div>
          <div class="row-24 header">
            <div class="col"><p><b>PEMBELI / PENERIMA : <br>Nama&emsp;: {{$header_faktur->nama_customer}}<br>Alamat&ensp;: {{$header_faktur->alamat_customer}}</b></p></div>
          </div>
          <table class="table" id="tabel_detail">
              <thead style="font-size: 24px;">
                  <tr>
                      <th scope="row"><strong>No.</strong></th>
                      <th scope="row"><strong>Nama Barang / Jasa Kena Pajak</strong></th>
                      <th scope="row"><strong>Qty</strong></th>
                      <th scope="row"><strong>Harga Satuan Rp.</strong></th>
                      <th scope="row"><strong>Harga Jual Rp.</strong></th>
                  </tr>
              </thead>
              <tbody>
		  <?php $no = 1; ?>
		  @foreach($detail_faktur as $df)
                  <tr>
                      <td class="text font-weight-bold" scope="row" style="text-align: center;">{{$no++}}</td>
                      <td class="text font-weight-bold" scope="row" style="text-align: left;">{{$df->nama_barang}} {{$df->ukuran}}</td>
                      <td class="harga text font-weight-bold" scope="row" style="text-align: center;">{{$df->qty}}</td>
                      <td class="harga text font-weight-bold" scope="row" style="text-align: center;">{{$df->harga_satuan}}</td>
                      <td class="total_item text font-weight-bold" scope="row" style="text-align: center;">a</td>
                  </tr>
		  @endforeach
              </tbody>
              <tfoot>
                  <tr>
                      <td colspan="4"><p><b>Jumlah Harga Jual/Penggantian Uang Muka</b></p></td>
                      <td scope="row" id="sub_total" class="sub_total font-weight-bold" style="text-align: center"></td>
                  </tr>
                  <tr>
                      <td colspan="4"><p><b>Dikurangi Potongan Harga/Uang Muka Yang Telah Diterima</b></p></td>
                      <td scope="row" id="nom"></td>
                  </tr>
                  <tr>
                      <td colspan="4"><p><b>Dasar Pengenaan Pajak</b></p></td>
                      <td scope="row" id="nom"></td>
                  </tr>
                  <tr>
                      <td colspan="4"><p><b>PPN x 11% x Dasar Pengenaan pajak</b></p></td>
                      <td scope="row" id="pajak" class="pajak font-weight-bold" style="text-align: center"></td>
                  </tr>
                  <tr>
                      <td colspan="4" style="text-align: right;"><p><strong>TOTAL Rp. &ensp;</strong></p></td>
                      <td scope="row" id="grand_total" class="grand_total font-weight-bold" style="text-align: center"></td>
                  </tr>
              </tfoot>
          </table>
          </table>
            <footer style="font-size: 22px;font-weight: bold;">
                <div class="row">
			<div class="col-lg-6">
				<p>Terbilang : <br><i>{{$terbilang}}</i></p>
			</div>
			<div class="col-lg-6">
	      			<div class="tanggal text-right">
	             			<span class="tanggal" style="padding-right: 59px;">Bandung, {{date('d/m/Y', strtotime($tgl_faktur))}}</span><br>
	      			</div>
			</div>
                </div>
		<div class="row">
			<div class="col-lg">
	      			<div class="text-right">
	             			<img src="{{asset('/img/ttd.png')}}" class="img" style="width:15%;">
	      			</div>
			</div>
         	</div>

        	<div class="row">
			<div class="col-lg">
	      			<div class="tanggal text-right">
	             			<span class="tanggal">(__________________________)</span>
	      			</div>
			</div>
         	</div>
	<div class="row">
	    <div class="col-md-12">
		<p> Pembayaran di Transfer </p>
	    </div>
	</div.
        <div class="row">
	    <div class="col-md-2">
	      <p>Nama Bank</p>
	      <p>Alamat Bank</p>
              <p>No Rekening</p>
              <p> Atas Nama</p>
	    </div>
            <div class="col-md">
	      <p></p>
	      <p>: BCA </p>
	      <p>: Jl.Asia Afrika Bandung</p>
              <p>: 0083009397 </p>
              <p>: PT.BIMETA KARNUSA </p>
	    </div>

        </div>
                
            </footer>
        </div>
    </div>
</section>
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
                    times *= parseFloat(harga);
                }
            });
            $('.total_item', this).html(accounting.formatMoney(times));

      });


      var sum = 0;
      $('#tabel_detail > tbody > tr').each(function () {

            $(this).find('.total_item').each(function () {
                var total_item = $(this).text().replace(/[.]+/g,"");
                    sum += parseFloat(total_item);
            });
            $('.sub_total').text(accounting.formatMoney(sum));
      });


        setTaxValue();
        window.print();
    });

    function setTaxValue(){
        var pajak = "{{$header_faktur->pajak}}";
        var sub_total = parseFloat($('.sub_total').text());
        if(pajak == "V0"){
            var sub_tot =$('.sub_total').text().replace(/[.]+/g,"");
            var sub = parseFloat(sub_tot);
            $('.pajak').text(accounting.formatMoney(sub*0));
            $('.grand_total').text(accounting.formatMoney((sub*0) + sub));
        }else{
            var sub_tot =$('.sub_total').text().replace(/[.]+/g,"");
            var sub = parseFloat(sub_tot);
            $('.pajak').text(accounting.formatMoney(sub*11/100));
            $('.grand_total').text(accounting.formatMoney((sub*11/100) + sub));
        }
    }

    function terbilang(bilangan) {

bilangan    = String(bilangan);
var angka   = new Array('0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');
var kata    = new Array('','Satu','Dua','Tiga','Empat','Lima','Enam','Tujuh','Delapan','Sembilan');
var tingkat = new Array('','Ribu','Juta','Milyar','Triliun');

var panjang_bilangan = bilangan.length;

/* pengujian panjang bilangan */
if (panjang_bilangan > 15) {
    kaLimat = "Diluar Batas";
    return kaLimat;
}

/* mengambil angka-angka yang ada dalam bilangan, dimasukkan ke dalam array */
for (i = 1; i <= panjang_bilangan; i++) {
    angka[i] = bilangan.substr(-(i),1);
}

i = 1;
j = 0;
kaLimat = "";


/* mulai proses iterasi terhadap array angka */
while (i <= panjang_bilangan) {

    subkaLimat = "";
    kata1 = "";
    kata2 = "";
    kata3 = "";

    /* untuk Ratusan */
    if (angka[i+2] != "0") {
        if (angka[i+2] == "1") {
            kata1 = "Seratus";
        } else {
            kata1 = kata[angka[i+2]] + " Ratus";
        }
    }

    /* untuk Puluhan atau Belasan */
    if (angka[i+1] != "0") {
        if (angka[i+1] == "1") {
            if (angka[i] == "0") {
                kata2 = "Sepuluh";
            } else if (angka[i] == "1") {
                kata2 = "Sebelas";
            } else {
                kata2 = kata[angka[i]] + " Belas";
            }
        } else {
            kata2 = kata[angka[i+1]] + " Puluh";
        }
    }

    /* untuk Satuan */
    if (angka[i] != "0") {
        if (angka[i+1] != "1") {
            kata3 = kata[angka[i]];
        }
    }

    /* pengujian angka apakah tidak nol semua, lalu ditambahkan tingkat */
    if ((angka[i] != "0") || (angka[i+1] != "0") || (angka[i+2] != "0")) {
        subkaLimat = kata1+" "+kata2+" "+kata3+" "+tingkat[j]+" ";
    }

    /* gabungkan variabe sub kaLimat (untuk Satu blok 3 angka) ke variabel kaLimat */
    kaLimat = subkaLimat + kaLimat;
    i = i + 3;
    j = j + 1;

}

/* mengganti Satu Ribu jadi Seribu jika diperlukan */
if ((angka[5] == "0") && (angka[6] == "0")) {
    kaLimat = kaLimat.replace("Satu Ribu","Seribu");
}

return kaLimat + "Rupiah";
}

    accounting.settings = {
        currency: {
          symbol : "",   // default currency symbol is '$'
          format: "%s%v", // controls output: %s = symbol, %v = value/number (can be object: see below)
          decimal : ",",  // decimal point separator
          thousand: ".",  // thousands separator
        },
        number: {
          precision : 2,  // default precision on numbers is 0
          thousand: ".",
          decimal : ","
        }
    }

    

</script>

@endsection


