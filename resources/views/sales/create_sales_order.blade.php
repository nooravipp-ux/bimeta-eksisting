@extends('adminlte::page')
@section('adminlte_css')
<style>
    .select2-offscreen {
        width:500px;
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
                    Sales Order 
                    <small class="float-right"><strong></strong></small>
                </h4>
            </div>

            <!-- Form Input Sales Order-->
            <div class="invoice p-3 mb-3">
              <div class="row header-so">
                <div class="col-sm-12">
                  <form class="dataHeader">
                      {{ csrf_field() }}
                    <div class="row">
                      <div class="col-sm-2 invoice-col">
                          <div class="form-group">
                              <label>No P.O Customer</label>
                              <input type="text" class="form-control" name="no_po_customer" id="no_po_customer">
                          </div>
                      </div>
                      <div class="col-sm-3 invoice-col">
                          <div class="form-group">
                              <label>ID Customer</label>
                              <select class="form-control" name="id_customer" id="id_customer">
                              </select>
                          </div>
                      </div>
                      <div class="form-group">
                              <label>Pajak</label>
                              <select class="pajak form-control" name="pajak" id="pajak">
                                  <option value="V0" selected>V0</option>
                                  <option value="V1">V1</option>
                                  <option value="V2">V2</option>
			                            <option value="sample">Sample</option>
                              </select>
                          </div>
                      <div class="col-sm-2 invoice-col">
                          <div class="form-group">
                              <label>Tgl Pemesanan</label>
                              <input type="date" name="tgl_pemesanan" class="form-control" required>
                          </div>
                      </div>
                      <div class="col-sm-2 invoice-col">
                          <div class="form-group">
                              <label>Tgl Pengiriman</label>
                              <input type="date" class="form-control" name="top" id="top">
                          </div>
                      </div>        
                      <div class="col-sm-2 invoice-col">
                          <div class="form-group">
                              <label>Status</label>
                              <select class="form-control" name="status">
                                  <option value="DRAFT" selected>DRAFT</option>
                                  <option value="ON PROGRESS">ON PROGRESS</option>
       				                    <option value="PROCEEDED">PROCEEDED</option>
                              </select>
                              <input type="hidden" name="total_penjualan" id="total" class="total form-control" readonly required>
                              <input type="hidden" class="tot-pajak form-control" name="tot_pajak">
                         </div>
                      </div>
                      <div class="col-sm-1 invoice-col">
                          <!--<div class="form-group">
                              <label>Pajak</label>
                              <select class="pajak form-control" name="pajak" id="pajak">
                                  <option value="V0" selected>V0</option>
                                  <option value="V1">V1</option>
                                  <option value="V2">V2</option>
			                            <option value="sample">Sample</option>
                              </select>
                          </div>-->
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
                    <table id="pengadaan" class="table table-sm">
                      <thead>
                          <tr class="text-center">
                            <th class="select2-offscreen">Nama Barang</th>
                            <th class="select2-offscreen-qty">Qty</th>
                            <th class="select2-offscreen-qty">Harga Satuan</th>
                            <th class="select2-offscreen-total-harga" align="center"><span id="amount" class="amount">Total</span> </th>
                            <th>Action</th>
                          </tr>
                      </thead>
                      <tbody class="table-body">
                          <tr class="dataDetail">
                              <td><select class="kode_barang form-control" name="kode_barang" id="kode_barang"></select></td>
                              <td><input type="number" class="qty form-control" name="qty" id="qty" required></td>
                              <td><input type="number" class="harga_satuan form-control" name="harga_satuan" value="0" required></td>
                              <td align="right"  class="jumlah" name="jumlah_item" id="jumlah"></td>
                              
                              <td><i class="btn btn-primary addRow">+</i></td>
                          </tr>
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
                        <button type="button" class="btn btn-primary float-right" id="simpan"></i>
                          simpan
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
              text: cs.id_customer+' / '+cs.nama_customer+' / '+cs.tipe_pajak
            
            }
          })
        };
      },
      cache: true
    }
  });

  $('.kode_barang').select2({
    placeholder: '- Cari Barang -',
    ajax: {
     
      url:  '{{url('/getKodeBarang')}}',
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results:  $.map(data, function (barang) {
            $nama = barang.nama_barang;
            return {
              id: barang.kode_barang,
              text: barang.kode_barang+'/'+barang.nama_barang+'/'+barang.ukuran+'/'+barang.spesifikasi_barang
            
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
                            '<td><input type="number" class="qty form-control" name="qty" id="qty" required></td>'+
                            '<td><input type="number" class="harga_satuan form-control" name="harga_satuan" value="0" required></td>'+
                            '<td align="right" class="jumlah" name="jumlah_item" id="jumlah" style="width: 159px;"></td>'+
                           
                            '<td><i class="btn btn-danger btn-sm fas fa-times-circle remove"> </i></td>'+
                        '</tr>';
              $('tbody.table-body').append(tr);
              //ajax for get kode barang on select box
              $('.kode_barang').select2({
    		  placeholder: '- Cari Barang -',
                  ajax: {
     
                      url:  '{{url('/getKodeBarang')}}',
                      dataType: 'json',
                      delay: 250,
                      processResults: function (data) {
                          return {
                              results:  $.map(data, function (barang) {
                                 $nama = barang.nama_barang;
                                  return {
                                      id: barang.kode_barang,
                                       text: barang.kode_barang+'/'+barang.nama_barang+'/'+barang.ukuran+'/'+barang.spesifikasi_barang             
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
        $('#simpan').click(function(e) {	      
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
                    //id_so: $(this).find('[name="id_so"]').val(),
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
                    //id_sales_order: $(this).find('[name="id_sales_order"]').val(),
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
                        url: '{{url('/sales/store_sales_order')}}',
                        type: 'post',
                        data: JSON.stringify(data),
                        dataType: "json",
		        beforeSend: function(){
			  $('#simpan').html("Processing ...").attr('disabled', true);
			},
                        success: function(data){
                          if(data.error){
                              alert(data.error)
			      $("#no_po_customer").val("").focus().css("border-color", "red");
			      $('#simpan').html("Simpan").attr('disabled', false);	
                          }else{
                              alert(data.status);
                              window.location = "{{url('/sales/sales-order')}}";
                          }
                          
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
