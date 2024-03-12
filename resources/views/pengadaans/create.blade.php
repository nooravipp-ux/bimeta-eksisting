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
                    PENGADAAN 
                    <small class="float-right">NO. {{ $no_urut }}</small>
                </h4>
            </div>

            <!-- Form Input pengadaan-->
            <div class="invoice p-3 mb-3">
              <form class="dataHeader">
                  {{ csrf_field() }}
                <div class="row">          
                  <div class="col-sm-3 invoice-col">
                      <div class="form-group">
                          <label>Kode Supplier</label>
                          <select class="form-control" name="kode_supplier" id="kode_supplier">

                          </select>
			  <input type="hidden" name="id_pengadaan" class="form-control" value="{{ $no_urut }}" readonly required>
                      </div>
                  </div>
                  
                  <div class="col-sm-2 invoice-col">
                      <div class="form-group">
                          <label>Tgl Pembelian</label>
                          <input type="date" name="tgl_pembelian" class="form-control" required>
  
                      </div>
                  </div>
                  
                  <div class="col-sm-2 invoice-col">
                      <div class="form-group">
                          <label>Status</label>
                          <select class="form-control" name="status">
                              <option value="OPEN">OPEN</option>
                              <option value="CLOSE">CLOSE</option>
                              <option value="CANCEL">CANCEL</option>
                          </select>
                      </div>
                  </div>

                  <div class="col-sm-1 invoice-col">
                      <div class="form-group">
                          <label>Pajak</label>
                          <select class="form-control" name="pajak" id="pajak">
                            <option value="V0" selected="selected">V0</option>
                            <option value="V1">V1</option>
                          </select>
                      </div>
                  </div> 
                </div>
              </form> 
              <div class="row mt-4">
                  <div class="col-sm-12">
                    <h4>INPUT DETAIL</h4>
                  </div>
              </div>
              <!-- row detail pengadaan-->
              <div class="row detail-pengadaan">
                <form class=""> 
                  <table id="pengadaan" class="table table-responsive">
                    <thead class="">
                        <tr class="text-center">
                          <th class="select2-offscreen">Kode Barang</th>
                          <th class="select2-offscreen-qty">Qty</th>
                          <th class="select2-offscreen-qty">Harga Satuan</th>
                          <th align="center"><span id="amount" class="select2-offscreen-total-harga amount">Total</span> </th>
                          <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-body">
                        <tr class="dataDetail">
                            <td><select class="kode_barang form-control" name="kode_barang" id="kode_barang"></select></td>
                            <td><input type="number" class="qty form-control" name="qty" id="qty1" required></td>
                            <td><input type="number" class="harga_satuan form-control" name="harga_satuan" required></td>
                            <td align="right"  class="jumlah" name="jumlah_item" id="jumlah"></td>
                            <input type="hidden" class="form-control" name="kode_pembelian" value="{{ $no_urut }}">
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
                      <button type="button" class="btn btn-success float-right" id="simpan"></i>
                        simpan
                      </button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- end row detail pengadaan -->
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div>  
            
@endsection

@section('plugin_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="{{asset('js/jautocalc.js')}}"></script>
<script type="text/javascript">
  //format currency
  const formatter = new Intl.NumberFormat('en-IN');
  //fetch data id pengadaan with ajax select2 jquery plugin
  $('#kode_supplier').select2({
    placeholder: '- Pilih Supplier -',
    ajax: {
      data: function (params) {
       return {
        searchTerm: params.term // search term
       };
      },

      url: '{{url('/getDataSupplier')}}',
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results:  $.map(data, function (item) {
            return {
              id: item.kode_supplier,
              text: item.kode_supplier +"/"+ item.nama_supplier
            
            }
          })
        };
      },
      cache: true
    }
  });

  $('.kode_barang').select2({
    placeholder: '- Pilih Barang -',
    ajax: {
      url: '{{url('/getKodeBarangRW')}}',
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results:  $.map(data, function (barang) {
            $nama = barang.nama_barang;
            return {
              id: barang.kode_barang,
              text: barang.nama_barang+' '+barang.ukuran
            
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
                          '<td><input type="number" class="qty form-control" name="qty" id="qty1" required></td>'+
                          '<td><input type="number" class="harga_satuan form-control" name="harga_satuan" required></td>'+
                          '<td align="right" class="jumlah" name="jumlah_item" id="jumlah"></td>'+
                          '<input type="hidden" class="form-control" name="kode_pembelian" value="{{ $no_urut }}">'+
                          '<td><i class="btn btn-danger remove">-</i></td>'+
                      '</tr>';
              $('tbody.table-body').append(tr);
              //ajax for get kode barang on select box
              $('.kode_barang').select2({
                  placeholder: '- Pilih Barang -',
                  ajax: {
                    url: '{{url('/getKodeBarangRW')}}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                      return {
                        results:  $.map(data, function (barang) {
                          return {
                            id: barang.kode_barang,
                            text: barang.nama_barang+' '+barang.ukuran
                          
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
              var $fields = [ $('tr input.qty')];
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
                    id_pengadaan: $(this).find('[name="id_pengadaan"]').val(),
                    kode_supplier: $(this).find('[name="kode_supplier"]').val(),
                    tgl_pembelian: $(this).find('[name="tgl_pembelian"]').val(),
                    status: $(this).find('[name="status"]').val(),
                    pajak: $(this).find('[name="pajak"]').val(),
                    tax_total: $('.tot_pajak').text(),
                    sub_total: $('.subtotal').text()
                };
                }).get(); 

                var dataDetail = $('.dataDetail').map(function() {
                    return {
                    kode_pembelian: $(this).find('[name="kode_pembelian"]').val(),
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
                        url: '{{url('/addDetail')}}',
                        type: 'post',
                        data: JSON.stringify(data),
                        dataType: "json",
                        success: function(data){
                          window.location = "{{url('/pengadaans')}}";
                        }
                    });
                }else{
                  alert('Fill all fields');
                } 
              }else {
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
}

function pajak(){
    $("#pajak").change(function(){
        if($(this).val() == "V0"){
            $('#tot_pajak').text(parseInt($('#subtotal').text())*0);
            var sub_total = parseInt($('#subtotal').text());
            $('#grand_total').text(sub_total + parseInt($('#tot_pajak').text()));
        }else{
            var sub_total = parseInt($('#subtotal').text());
            $('#tot_pajak').text(sub_total*11/100);
            var tot_pajak = parseInt($('#tot_pajak').text());
            $('#grand_total').text(sub_total+tot_pajak); 
                
        }
    });
}
</script>

@endsection

