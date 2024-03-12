@extends('adminlte::page')
@section('adminlte_css')
    <style>
        .select2-offscreen {
            width:460px;
        }
        .select2-offscreen-qty {
            width:130px;
        }
        .select2-offscreen-total-harga {
            width: 150px;
        }
    </style>
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="callout callout-info">
                        <h4>
                            Buat Faktur
                            <small class="float-right"><strong></strong></small>
                        </h4>
                    </div>

                    <!-- Form Input Sales Order-->
                    <div class="invoice p-3 mb-3">
                        <div class="row header-so">
                            <div class="col-sm-12">
                                <form class="dataHeader" method="POST" action="/finance/store-faktur-pilihan">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-sm-2 invoice-col">
                                            <div class="form-group">
                                                <label>No Faktur</label>
                                                <input type="text" class="form-control" name="no_faktur" value="{{$no_urut_faktur}}" required readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 invoice-col">
                                            <div class="form-group">
                                                <label>No Surat Jalan</label>
                                                <input type="text" class="form-control" name="no_surat_jalan" value="{{$no_surat_jalan}}" required readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 invoice-col">
                                            <div class="form-group">
                                                <label>Customer</label>
                                                <input class="form-control" name="id_customer" value="{{$header_faktur->nama_customer}}" readonly>

                                            </div>
                                        </div>
                                        <div class="col-sm-2 invoice-col">
                                            <div class="form-group">
                                                <label>Tgl Faktur</label>
                                                <input type="date" name="tgl_faktur" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 invoice-col">
                                            <div class="form-group">
                                                <label>Keterangan</label>
                                                <textarea class="form-control" name="keterangan"></textarea>
                                                <input type="hidden" name="total_penjualan" class="form-control" id="total_penjualan">
                                                <input type="hidden" class="form-control" name="total_pajak" id="total_pajak">
                                                <input type="hidden" class="form-control" name="pajak" value="{{$header_faktur->pajak}}">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md">
                                            <button type="submit" class="btn btn-primary">Simpan & Cetak Faktur</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <h4>Isi detail pesanan :</h4>
                        </div>
                        <div class="row detail-so">
                            <form class="">
                                <table id="tabel_detail" class="table table-sm">
                                    <thead>
                                    <tr class="text-center">
                                        <th class="select2-offscreen">Nama Barang</th>
                                        <th class="select2-offscreen-qty">Qty</th>
                                        <th class="select2-offscreen-qty">Harga Satuan</th>
                                        <th class="select2-offscreen-total-harga" align="center"><span id="amount" class="amount">Total</span> </th>

                                    </tr>
                                    </thead>
                                    <tbody class="table-body">
                                    @foreach($detail_faktur as $df)
                                        <tr class="dataDetail">
                                            <td><input class="kode_barang form-control" name="kode_barang" value="{{$df->nama_barang}} {{$df->ukuran}}" readonly></td>
                                            <td><input type="number" class="harga form-control" name="qty" value="{{$df->qty}}" readonly></td>
                                            <td><input type="number" class="harga harga_satuan form-control" name="harga_satuan" value="{{$df->harga_satuan}}" readonly></td>
                                            <td align="right" class="total_item" name="jumlah_item"></td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr class="text-center"><td colspan="2"></td>
                                        <td align="right">
                                            <h5><span class="text-success">Sub Total</span></h3>
                                        </td>
                                        <td align="right" class="sub_total"></td>
                                    </tr class="text-center">
                                    <tr class="text-center"><td colspan="2"></td>
                                        <td align="right">
                                            <h5><span class="text-success">Pajak ({{$header_faktur->pajak}})</span></h3>
                                        </td>
                                        <td align="right" class="tot_pajak"></td>
                                    </tr class="text-center">
                                    <tr class="text-center"><td colspan="2"></td>
                                        <td align="right">
                                            <h5><span class="text-success">Grand Total</span></h3>
                                        </td>
                                        <td align="right" id="grand_total" class="grand_total"></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </form>
                        </div>
                        <!-- end of detal SO -->
                    </div>
                </div><!-- /.invoice -->
            </div><!-- /.col -->
        </div><!--row -->
        </div><!--container fluid-->
    </section>
@endsection

@section('plugin_js')

    <script src="{{asset('js/accounting.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#tabel_detail > tbody > tr').each(function () {
                var times = 1;
                $(this).find('.harga').each(function () {
                    var harga = $(this).val();
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

            $('#total_pajak').val($('.tot_pajak').text());
            $('#total_penjualan').val($('.grand_total').text());


        });

        function setTaxValue(){
            var pajak = "{{$header_faktur->pajak}}";
            var sub_total = parseFloat($('.sub_total').text());
            if(pajak == "V0"){
                var sub_tot =$('.sub_total').text().replace(/[.]+/g,"");
                var sub = parseFloat(sub_tot);
                $('.tot_pajak').text(accounting.formatMoney(sub*0));
                $('.grand_total').text(accounting.formatMoney((sub*0) + sub));

            }else{
                var sub_tot =$('.sub_total').text().replace(/[.]+/g,"");
                var sub = parseFloat(sub_tot);
                $('.tot_pajak').text(accounting.formatMoney(sub*11/100));
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
                precision : 2,  // default precision on numbers is 0
                thousand: ".",
                decimal : ","
            }
        }


    </script>

@endsection
