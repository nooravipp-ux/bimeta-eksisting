@extends('adminlte::page')

@section('adminlte_css')

@endsection
@section('content')
    <table style="height: 198px; width: 100%; border-collapse: collapse;" border="0">
        <tbody>
        <tr style="height: 18px;">
            <td style="width: 100%; height: 18px; font-size: 25px" colspan="2"><strong>PT. BIMETA KARNUSA</strong></td>
        </tr>
        <tr style="height: 18px;">
            <td style="width: 100%; height: 18px;font-size: 20px" colspan="2"><strong>BANDUNG</td>
        </tr>
        <tr style="height: 18px;">
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr style="height: 18px;">
            <td style="width: 100%; height: 18px;font-size: 20px" colspan="2">Kepada</td>
        </tr>
        <tr style="height: 18px;">
            <td style="width: 100%; height: 18px;font-size: 18px" colspan="2"><strong>{{$header_faktur->nama_customer}}</strong></td>
        </tr>
        <tr style="height: 18px;">
            <td style="width: 100%; height: 18px;font-size: 18px"" colspan="2">{{$header_faktur->alamat_customer}}</td>
        </tr>
        <tr style="height: 18px;">
            <td colspan="2">&nbsp;</td>
        </tr>
        <!--tr style="height: 18px;">
            <td style="width: 25.365%; height: 18px;font-size: 20px"><strong>Nomor Faktur : {{$no_urut_faktur}}</strong></td>
            <td style="width: 74.635%; height: 18px;"></td>
        </tr>
        <tr style="height: 18px;">
            <td style="width: 25.365%; height: 18px;font-size: 18px">Nomor PO : {{$header_faktur->no_po_customer}}</td>

        </tr>
        <tr style="height: 18px;">
            <td style="width: 25.365%; height: 18px;font-size: 18px">Tanggal : {{date('d/m/Y', strtotime($tgl_faktur))}}</td>

        </tr>-->

        <tr style="height: 18px;font-size: 20px">
            <td style="width: 15%; height: 18px;"><strong>No. Faktur</strong></td>
            <td style="width: 85%; height: 18px;"><strong>: {{$no_urut_faktur}}</strong></td>
        </tr>
        <tr style="height: 18px;font-size: 20px">
            <td style="width: 15%; height: 18px;">No. Surat Jalan </td>
            <td style="width: 85%; height: 18px;">: {{$string}}</td>
        </tr>
        <tr style="height: 18px;font-size: 20px">
            <td style="width: 15%; height: 18px;">No. PO </td>
            <td style="width: 85%; height: 18px;">: {{$header_faktur->no_po_customer}}</td>
        </tr>
        <tr style="height: 18px;font-size: 20px">
            <td style="width: 15%; height: 18px;">Tanggal Faktur </td>
            <td style="width: 85%; height: 18px;">: {{date('d/m/Y', strtotime($tgl_faktur))}}</td>
        </tr>

        </tbody>
    </table>
    <p>&nbsp;</p>

    
    <!--<table style="border-collapse: collapse; width: 100%; height: 36px;" border="1" id="tabel_detail">
        <tbody>
        <tr style="height: 18px;">
            <td style="text-align: center; width: 6.56934%;font-size: 18px"><strong>NO</strong></td>
            <td style="text-align: center; width: 46.5329%;font-size: 18px"><strong>NAMA BARANG</strong></td>
            <td style="text-align: center; width: 6.75181%;font-size: 18px"><strong>QTY</strong></td>
            <td style="text-align: center; width: 16.0584%;font-size: 18px"><strong>HARGA Rp.</strong></td>
            <td style="text-align: center; width: 23.7226%;font-size: 18px"><strong>TOTAL Rp.</strong></td>
        </tr>
        <?php $no = 1; ?>
        @foreach($detail_faktur as $df)
        <tr style="height: 18px;">
            <td style="width: 6.56934%; height: 18px;font-size: 18px"><center>{{$no++}}</center></td>
            <td style="width: 46.5329%; height: 18px;font-size: 18px"><center>{{$df->nama_barang}} {{$df->ukuran}}</center></td>
            <td class="harga" style="width: 6.75181%; height: 18px;font-size: 18px"><center>{{$df->qty}}</center></td>
            <td class="harga" style="width: 16.0584%; height: 18px;font-size: 18px"><center>{{$df->harga_satuan}}</center></td>
            <td class="total_item" style="width: 23.7226%; height: 18px;font-size: 18px;text-align: center"><center>a</center></td>
        </tr>
        @endforeach
        <tr>
            <td style="width: 79.7445%; text-align: right;font-size: 18px" colspan="4"><strong>Total Rp.</strong></td>
            <td style="font-size: 22px; text-align: center" id="sub_total" class="sub_total" style="width: 19.8905%;"><b>&nbsp;</b></td>
        </tr>
        </tbody>
    </table>-->
    <table style="border-collapse: collapse; width: 100%; height: 36px;" border="1" id="tabel_detail">
        <tbody>
        <tr style="height: 18px;">
            <td style="text-align: center; width: 4%;font-size: 18px"><strong>NO</strong></td>
            <td style="text-align: center; width: 60%;font-size: 18px"><strong>NAMA BARANG</strong></td>
            <td style="text-align: center; width: 6%;font-size: 18px"><strong>QTY</strong></td>
            <td style="text-align: center; width: 12%;font-size: 18px"><strong>HARGA Rp.</strong></td>
            <td style="text-align: center; width: 18%;font-size: 18px"><strong>TOTAL Rp.</strong></td>
        </tr>
        <?php $no = 1; ?>
        @foreach($detail_faktur as $df)
        <tr style="height: 18px;">
            <td style="text-align: center; width: 4%; height: 18px;font-size: 18px">{{$no++}}</td>
            <td style="text-align: left; width: 60%; height: 18px;font-size: 18px"> &nbsp;{{$df->nama_barang}} {{$df->ukuran}}</td>
            <td style="text-align: right; width: 6%; height: 18px;font-size: 18px" class="harga">{{$df->qty}}&nbsp;</td>
            <td style="text-align: right; width: 12%; height: 18px;font-size: 18px" class="harga">{{$df->harga_satuan}}&nbsp;</td>
            <td style="text-align: right; width: 18%; height: 18px;font-size: 18px;" class="total_item">&nbsp;</td>
        </tr>
        @endforeach
        <tr>
            <td style="width: 82%; text-align: right; font-size: 18px" colspan="4"><strong>TOTAL Rp.</strong></td>
            <td style="width: 18%; text-align: right; font-size: 22px" id="sub_total" class="sub_total"><b>&nbsp;</b></td>
        </tr>
        </tbody>
    </table>
    <p>&nbsp;</p>
    <table style="width: 100%; border-collapse: collapse;" border="0">
        <!--<tbody>
        <tr>
            <td>
                <strong> Terbilang : </strong><i><p style="font-size:18px" id="terbilang_ajah"><br><i>{{$terbilang}}</i></p>
            </td>
            <td style="width: 50%;font-size: 18px">
                <p style="text-align: center;">Hormat Kami</p>
            </td>
        </tr>
        <tr>
            <td>
                <p style="font-size:18px">Nama Bank : BCA</p>
            </td>
            <td style="width: 50%;font-size: 18px">
                <p style="text-align: center;">&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td>
                <p style="font-size:18px">Alamat Bank : Jl.Asia Afrika Bandung</p>
            </td>
            <td style="width: 50%;font-size: 18px">
                <p style="text-align: center;">&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td>
                <p style="font-size:18px">No Rekening : 0083009397</p>
            </td>
            <td style="width: 50%;font-size: 18px">
                <p style="text-align: center;">(____________________)</p>
            </td>
        </tr>
        <tr>
            <td>
                <p style="font-size:18px">Atas Nama : PT.BIMETA KARNUSA</p>
            </td>
            <td style="width: 50%;font-size: 18px">

            </td>
        </tr>

        </tbody>-->

        <tbody>
        <tr>
            <td colspan="3">
                <strong> Terbilang : </strong><i><p style="font-size:18px" id="terbilang_ajah">{{$terbilang}}</i></p>
            </i></td>
        </tr><tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        
        <tr>
            <td style="width: 12%;font-size:18px">
                <p>Nama Bank</p>
            </td>
            <td style="width: 33%;font-size: 18px">
                <p style="text-align: Left;">: BCA</p>
            </td>
            <td style="width: 55%;font-size: 18px">
                <p style="text-align: center;">Hormat Kami</p>
            </td>
        </tr>
        <tr>
            <td style="width: 12%;font-size:18px">
                <p>Alamat Bank</p>
            </td>
            <td style="width: 33%;font-size:18px">
                <p>: Jl. Asia Afrika - Bandung</p>
            </td>
            <td style="width: 55%;font-size: 18px;text-align: center;">
                <p>&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td style="width: 12%;font-size:18px">
                <p>No Rekening</p>
            </td>
            <td style="width: 33%;font-size:18px">
                <p>: 0083009397</p>
            </td>
            <td style="width: 55%;font-size: 18px;text-align: center;">
                <p>&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td style="width: 12%;font-size:18px">
                <p>Atas Nama</p>
            </td>
            <td style="width: 33%;font-size:18px">
                <p>: BIMETA KARNUSA PT.</p>
            </td>
            <td style="width: 55%;font-size: 18px;text-align: center;">
                <p>(____________________)</p>
            </td>
        </tr>
        </tbody>

    </table>
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

                var sub_tot =$('.sub_total').text().replace(/[.]+/g,"");
                var sub = parseFloat(sub_tot);

                $('.grand_total').text(accounting.formatMoney((sub) + sub_tot));
                var terbilang_bilangin = terbilang(sub);
                $('.terbilang_bilang').text(terbilang_bilangin);
            document.getElementById("terbilang_ajah").innerHTML = terbilang_bilangin;

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


