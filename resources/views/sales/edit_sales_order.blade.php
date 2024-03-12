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
          <div class="col-sm-12">
            <div class="callout callout-info">
                <h4>
                    Edit Sales Order
                    <small class="float-right">NO.{{$header_so->id_so}}</small>
                </h4>
            </div>
            <!-- Form Input Sales Order-->
            <div class="invoice p-3 mb-3">
              <div class="row header-so">
                <form class="dataHeader">
                    {{ csrf_field() }}
                  <div class="row">
                    <div class="col-sm-3 invoice-col">
                        <div class="form-group">
                            <label>ID Customer</label>
			    <select type="text" class="form-control" name="id_customer" id="id_customer">
				<option value="{{$header_so->id_customer}}" selected="selected">{{$header_so->nama_customer}}</option>
			    </select>
                            <input type="hidden" name="id_so" class="form-control" value="{{$header_so->id_so}}" readonly required>
                        </div>
                    </div>
		    <div class="col-sm-2 invoice-col">
                        <div class="form-group">
                            <label>No P.O Customer</label>
                            <input class="form-control" name="no_po_customer" value="{{$header_so->no_po_customer}}">
                        </div>
                    </div>
                    <div class="col-sm-2 invoice-col">
                        <div class="form-group">
                            <label>Tgl Pemesanan</label>
                            <input type="date" name="tgl_pemesanan" class="form-control" value="{{$header_so->tgl_pemesanan}}" required>
                        </div>
                    </div>
		    <div class="col-sm-2 invoice-col">
                        <div class="form-group">
                            <label>Tgl Pengiriman</label>
                            <input type="date" class="form-control" name="top" id="top" value="{{$header_so->top}}">
                        </div>
                    </div>
                    <div class="col-sm-2 invoice-col">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status">
                                  <option value="DRAFT" <?php if ($header_so->status == 'DRAFT') echo "selected"; ?>>DRAFT</option>
                                  <option value="ON PROGRESS" <?php if ($header_so->status == 'ON PROGRESS') echo "selected"; ?>>ON PROGRESS</option>
      				  <option value="PROCEEDED" <?php if ($header_so->status == 'PROCEEDED') echo "selected"; ?>>PROCEEDED</option>
                            </select>
                        </div>
                    </div>
		    <div class="col-sm-1 invoice-col">
                        <div class="form-group">
                            <label>Pajak</label>
                            <select class="form-control" name="pajak" id="pajak">
                                <option value="V0" <?php if ($header_so->pajak == 'V0') echo "selected"; ?>>V0</option>
                                <option value="V1" <?php if ($header_so->pajak == 'V1') echo "selected"; ?>>V1</option>
				<option value="V2" <?php if ($header_so->pajak == 'V2') echo "selected"; ?>>V2</option>
				<option value="sample" <?php if ($header_so->pajak == 'sample') echo "selected"; ?>>Sample</option>
                          </select>
                          <input type="hidden" name="total_penjualan" id="total" class="total form-control" readonly required>
                          <input type="hidden" class="tot-pajak form-control" name="tot_pajak">
                        </div>
                    </div>

                  </div>
                </form> 
              </div>
              <div class="row">
                  <h4>Edit Detail Order :</h4>
              </div>
              <div class="row detail-so">
                  <form class=""> 
                    <table id="pengadaan" class="table table-responsive">
                      <thead>
                          <tr class="text-center">
                            <th class="select2-offscreen">Nama Barang</th>
                            <th class="select2-offscreen-qty">Qty</th>
                            <th class="select2-offscreen-qty">Harga Satuan</th>
                            <th class="select2-offscreen-total-harga amount" align="right"><span id="amount">Total</span> </th>
                            <th><i class="btn btn-primary addRow">+</i></th>
                          </tr>
                      </thead>
                      <tbody class="table-body">
                      @foreach($detail_so as $det)
                          <tr class="dataDetail">
                              <td><select class="kode_barang form-control" name="kode_barang">
				      <option value="{{$det->kode_barang}}" selected="selected">{{$det->nama_barang}} {{$det->ukuran}} {{$det->spesifikasi_barang}}</option>
				  </select>
			      </td>
                              <td><input type="number" class="qty form-control" name="qty" value="{{$det->qty}}" required></td>
                              <td><input type="number" class="harga_satuan form-control" name="harga_satuan" value="{{$det->harga_satuan}}" required></td>
                              <td align="right" class="jumlah" name="jumlah_item" id="jumlah"></td>
                              <input type="hidden" class="form-control" name="id_sales_order" value="{{$det->id_sales_order}}" required>
                              <td><i class="btn btn-danger btn-sm fas fa-times-circle remove"></i></td>
                          </tr>
                      @endforeach
                      </tbody>
                      <tfoot>
                          <tr class="text-center"><td colspan="2"></td>
                              <td align="right">
                                  <h5><span class="text-success">Sub Total</span></h3>
                              </td>
                              <td align="right" id="subtotal" class="subtotal"></td>
                          </tr class="text-center">
                          <tr class="text-center"><td colspan="2"></td>
                              <td align="right">
                                  <h5><span class="text-success">pajak (11%)</span></h3>
                              </td>
                              <td align="right" id="tot_pajak" class="tot_pajak"></td>
                          </tr class="text-center">
                          <tr class="text-center"><td colspan="2"></td>
                              <td align="right">
                                  <h5><span class="text-success">Grand Total</span></h3>
                              </td>
                              <td align="right" id="grand_total" class="grand_total"></td>
                          </tr>
                      </tfoot>
                    </table>
                    <div class="row no-print">
                      <div class="col-12">
                        <button type="button" class="btn btn-success float-right" id="update"></i>
                          Update
                        </button>
                      </div>
                    </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="{{asset('js/jautocalc.js')}}"></script>
<script type="text/javascript">
  //fetch data id pengadaan with ajax select2 jquery plugin
  $('#id_customer').select2({
    placeholder: '- Pilih Customer -',
    ajax: {
      url: '{{url('/getIdCustomer')}}',
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results:  $.map(data, function (cs) {
            return {
              id: cs.id_customer,
              text: cs.id_customer +"/"+ cs.nama_customer            
            }
          })
        };
      },
      cache: true
    }
  });

  $('.kode_barang').select2({
                  placeholder: 'Cari...',
                  ajax: {
                    url: '{{url('/getKodeBarang')}}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                      return {
                        results:  $.map(data, function (barang) {
                          $nama = barang.nama_barang;
                          return {
                            id: barang.kode_barang,
                            text: barang.nama_barang+'/'+barang.ukuran+'/'+barang.spesifikasi_barang
                           
                          }
                        })
                      };
                    },
                    cache: true
                  }
                });



</script>

<script type="text/JavaScript">
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

$(document).ready(function() {
        //add row of table
        $('.addRow').on('click', function() {
          addRow();
              total();
              $('.qty').on('keyup', function() {
                  total();
              });
              $('.harga_satuan').on('keyup', function() {
                  total();
              });
              pajak();
        });

        function addRow(params) {
              var tr = '<tr class="dataDetail">'+
                            '<td><select class="kode_barang form-control" name="kode_barang" id="kode_barang"></select></td>'+
                            '<td><input type="number" class="qty form-control" name="qty" id="qty" value="0" required></td>'+
                            '<td><input type="number" class="harga_satuan form-control" name="harga_satuan" required></td>'+
                            '<td align="right" class="jumlah" name="jumlah_item" id="jumlah" style="width: 159px;"></td>'+
                            '<input type="hidden" class="form-control" name="id_sales_order" id="id_sales_order" value="{{$det->id_sales_order}}" required>'+
                            '<td><i class="btn btn-danger btn-sm fas fa-times-circle remove"></i></td>'+
                        '</tr>';
              $('tbody.table-body').append(tr);
              //ajax for get kode barang on select box
              $('.kode_barang').select2({
                  placeholder: 'Cari...',
                  ajax: {
		    url: '{{url('/getKodeBarang')}}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                      return {
                        results:  $.map(data, function (barang) {
                          $nama = barang.nama_barang;
                          return {
                            id: barang.kode_barang,
                            text: barang.nama_barang+'/'+barang.ukuran+'/'+barang.spesifikasi_barang
                          
                          }
                        })
                      };
                    },
                    cache: true
                  }
                });
        };
        //remove row table
        $('tbody').on('click', '.remove', function(){
              $(this).parent().parent().remove();
              total();
              $('.qty').on('keyup', function() {
                  total();
              });
              $('.harga_satuan').on('keyup', function() {
                  total();
              });
              pajak();
        });
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //add data_detail with ajax
        $('#update').click(function(e) {
              e.preventDefault();
              var $fields = [ $('tr input')];
              var $emptyFields;
              
              for(var i=0;i< $fields.length;i++){
              $emptyFields = $fields[i].filter(function(i,element) {
                  return $.trim($(this).val()) === '';
              });
              }
              if (!$emptyFields.length) {
                  //collect data form input detail
                  var dataHeader = $('.dataHeader').map(function() {
                    return {
                    id_so: $(this).find('[name="id_so"]').val(),
                    id_customer: $(this).find('[name="id_customer"]').val(),
                    top: $(this).find('[name="top"]').val(),
                    tgl_pemesanan: $(this).find('[name="tgl_pemesanan"]').val(),
                    total_penjualan: $(this).find('[name="total_penjualan"]').val(),
                    status: $(this).find('[name="status"]').val(),
                    pajak: $(this).find('[name="pajak"]').val(),
                    no_po_customer: $(this).find('[name="no_po_customer"]').val(),
                    tot_pajak: $(this).find('[name="tot_pajak"]').val()
                };
                }).get(); 

                var dataDetail = $('.dataDetail').map(function() {
                    return {
                    id_sales_order: $(this).find('[name="id_sales_order"]').val(),
                    kode_barang: $(this).find('[name="kode_barang"]').val(),
                    qty: $(this).find('[name="qty"]').val(),
                    harga_satuan: $(this).find('[name="harga_satuan"]').val()
                };
                }).get();

                console.log(dataHeader);
                console.log(dataDetail);

                var data = dataHeader.concat(dataDetail);
                console.log(data);
                if(data){
                    $.ajax({
                        url: '{{url('/sales/update-sales-order')}}',
                        type: 'post',
                        data: JSON.stringify(data),
                        dataType: "json",
                        success: function(data){
                          alert('Data Berhasil di Update');
                          window.location = "{{url('/sales/sales-order')}}";
                        }
                    });
                }else{
                  alert("fill the data !!!");
                }  
              } else {
                  alert('Tidak bisa menyimpan data . Harap isi data dengan benar !!!');
              }
        });    

        //perhitungan sub_total
        total();
        $('.qty').on('keyup', function() {
            total();
        });
        $('.harga_satuan').on('keyup', function() {
            total();
        });

        pajak();
});
//fungsi untuk menghitung total item dan sub total
function total(){
    var sum = 0;
    $('#pengadaan > tbody  > tr').each(function() {
        var qty = $(this).find('.qty').val();
        var harga_satuan = $(this).find('.harga_satuan').val();
        var jumlah = (qty*harga_satuan)
        sum+=jumlah;
        $(this).find('.jumlah').text(''+jumlah);
    });
    $('#subtotal').text(sum);
    $('.total').val(sum);
}

function pajak(){
    $("#pajak").change(function(){
        if($(this).val() == "V0"){
            $('#tot_pajak').text(parseInt($('#subtotal').text())*0);
            $('.tot-pajak').val(parseInt($('#subtotal').text())*0);
            var sub_total = parseInt($('#subtotal').text());
            $('#grand_total').text(sub_total + parseInt($('#tot_pajak').text()));
        }else{
            var sub_total = parseInt($('#subtotal').text());
            $('#tot_pajak').text(sub_total*11/100);
            $('.tot-pajak').val(sub_total*11/100);
            var tot_pajak = parseInt($('#tot_pajak').text());
            $('#grand_total').text(sub_total+tot_pajak); 
                
        }
    });
}
</script>

@endsection

