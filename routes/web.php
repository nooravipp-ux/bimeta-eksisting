<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth','checkrole:admin,produksi,gudang,superadmin']], function () {
	Route::resource('barang','BarangController');
	Route::get('/getKodeBarang', 'BarangController@getKodeBarang');
	Route::get('/getKodeBarangRW', 'BarangController@getKodeBarangRW');
	Route::resource('suppliers', 'SupplierController');
	Route::get('/getDataSupplier', 'SupplierController@getIdSupplier');
	Route::resource('customer', 'CustomerController');
	Route::get('/getIdCustomer','CustomerController@getIdCustomer');
	//Modul Procurement
	Route::resource('pengadaans', 'PengadaanController');
	Route::post('pengadaans/update-detail', 'PengadaanController@update');
	Route::post('/addDetail', 'DetailPengadaanController@storeDetailPengadaan');

	//Modul Logistik
	Route::get('/logistik', 'LogistikController@getAllDataGR');
	Route::get('/logistik/detail_gr/{id}', 'LogistikController@detail_gr')->name('gr.detail','{id}');
	Route::post('/logistik/store_detail_gr','LogistikController@store_detail_gr');
	Route::get('/logistik/create-gr','LogistikController@createGR')->name('logistik.create-gr');
	Route::get('/logistik/get-id-pengadaan', 'LogistikController@get_id_pengadaan');
	Route::get('/logistik/stok','LogistikController@stok');
	Route::get('/logistik/adjustment_stock_lebih','LogistikController@adjustment_stock_lebih');
	Route::post('/logistik/store_adjustment','LogistikController@store_adjusment')->name('logistik.store_adjustment');

	//modul spk
	Route::get('spk','spkcontroller@index');
	Route::get('spk/create','spkcontroller@create')->name('spk.create');
	Route::get('/spk/get-kd-so', 'spkcontroller@kd_so');
	Route::get('/spk/get-kd-barang', 'spkcontroller@kd_barang');
	Route::post('/spk/store_detail_spk','spkcontroller@store_detail_spk');
	Route::post('/spk/simpan-masal','spkcontroller@simpan_spk_masal');
	Route::get('/production/spk/show/{id}','spkcontroller@show')->name('spk.show','{id}');
	Route::get('/production/spk/convert/{id}','spkcontroller@convert')->name('spk.convert','{id}');
	Route::get('/production/spk/detail-print/{id}','spkcontroller@detail_print')->name('spk.detail-print','{id}');
	Route::get('/production/spk/double-detail-print/{id}','spkcontroller@double_detail_print')->name('spk.double-detail-print','{id}');
	Route::post('/production/spk/update-spk','spkcontroller@update_spk');
	Route::get('/production/spk/get-id-so', 'spkcontroller@get_id_so');
	Route::get('/production/spk/{id}/delete','spkcontroller@delete')->name('spk.delete','{id}');
	Route::post('/spk/batal','spkcontroller@spk_batal')->name('spk.batal');

	//production
	Route::get('/production/finish-goods','FinishGoodsController@index');
	Route::get('/production/get-spk-pemakaian','FinishGoodsController@get_no_spk_pemakaian');
	Route::get('/production/get_id_so', 'FinishGoodsController@get_id_so');
	Route::get('/production/finish-goods/create','FinishGoodsController@create')->name('input.fg');
	Route::post('/production/finish-goods/store','FinishGoodsController@store');
	Route::get('/production/finish-goods/show/{id}','FinishGoodsController@show')->name('finish-goods.show','{id}');

	//calc pemakaian spk

	Route::post('/production/pemakaian-material/get-data-qty-spk','PemakaianMaterialController@get_data_qty_spk');

	Route::get('/production/pemakaian-material','PemakaianMaterialController@index');
	Route::get('/production/get_no_spk', 'PemakaianMaterialController@get_no_spk');
	Route::get('/production/pemakaian-material/get_qty_spk', 'PemakaianMaterialController@get_qty_spk');
	Route::get('/production/pemakaian-material/get-barang-from-stock', 'PemakaianMaterialController@get_barang_from_stock');
	Route::get('/production/pemakaian-material/create','PemakaianMaterialController@create')->name('input.pemakaian');
	Route::post('/production/pemakaian-material/store','PemakaianMaterialController@store');
	Route::post('/production/pemakaian-material/store-pemakaian','PemakaianMaterialController@store_pemakaian');
	Route::get('/production/pemakaian-material/show/{id}','PemakaianMaterialController@show')->name('material.show','{id}');
	Route::get('/production/progres-produksi','ProgresProduksiController@index');
	Route::get('/production/report-pemakaian/{id}','PemakaianMaterialController@report_pemakaian')->name('material.report','{id}');
	

	Route::get('/production/progres-produksi-harian','ProgresProduksiController@produksi_harian');
	Route::get('/production/progres-harian-edit/{id}','ProgresProduksiController@edit_progres_harian');	
	Route::post('/production/progres-harian-update','ProgresProduksiController@update_progres_harian');

	Route::get('/production/progres-produksi/create','ProgresProduksiController@create');
	Route::get('/production/progres-produksi/create_progres_harian','ProgresProduksiController@create_progres_harian');
	Route::post('/production/progres-produksi/store','ProgresProduksiController@store');
	Route::post('/production/progres-produksi/store_progres_harian','ProgresProduksiController@store_progres_harian');
	Route::get('/production/progres-produksi/get-no-spk','ProgresProduksiController@get_no_spk');
	Route::post('/production/print-laporan-produksi','ProgresProduksiController@print_laporan_produksi')->name('production.print_laporan');

	Route::get('/production/progres-produksi/export-excel','ProgresProduksiController@export_excel')->name('export.progres');
	Route::get('/production/progres-produksi/export-excel-Progres-COR','ProgresProduksiController@export_COR');

	Route::get('/production/progres-produksi/edit/{id}','ProgresProduksiController@edit');
	Route::post('/production/progres-produksi/update','ProgresProduksiController@update');
	Route::get('/production/progres-produksi/delete/{no_spk}','ProgresProduksiController@delete_progres');
	
	Route::get('sales/surat-jalan/report','SuratJalanController@report_sj');
	
});

Route::group(['middleware' => ['auth','checkrole:admin,produksi,gudang,superadmin']], function () {
	//Modul Sales
	Route::get('/sales/create_sales_order','SalesController@create_sales_order')->name('sales.create-sales-order');
	Route::post('/sales/store_sales_order', 'SalesController@store_sales_order');
	Route::get('/sales/sales-order','SalesController@indexSO');
	Route::get('/sales/detail-sales-order/{id}','SalesController@detailSO')->name('sales.detail-sales-order','{id}');
	Route::get('/sales/edit-sales-order/{id}', 'SalesController@editSO')->name('sales.edit-sales-order', '{id}');
	Route::post('/sales/update-sales-order', 'SalesController@updateSO');
});

Route::group(['middleware' => ['auth','checkrole:admin,gudang,superadmin']], function () {
	//surat jalan
	Route::get('sales/surat-jalan','SuratJalanController@indexSJ');
	Route::get('sales/surat-jalan/create/{id}','SuratJalanController@createSJ')->name('surat-jalan.create','{$id}');
	Route::get('sales/surat-jalan/print/{id}','SuratJalanController@printSJ')->name('print-surat-jalan','{id}');
	Route::post('sales/surat-jalan/store','SuratJalanController@storeSuratJalan');
	Route::get('sales/surat-jalan/getNoSO', 'SuratJalanController@getNoSO');
	Route::get('sales/surat-jalan/printSJ/{id}','SuratJalanController@printSJ')->name('print-sj', '{id}');
	Route::get('sales/surat-jalan/printSJ-besar-v0/{id}','SuratJalanController@printSJ_besar_v0')->name('print-sj-besar-v0', '{id}');
	Route::get('sales/surat-jalan/printSJ-V0/{id}','SuratJalanController@printSJ_v0')->name('print-sj-v0', '{id}');
	Route::get('sales/surat-jalan/printSJ-sample/{id}','SuratJalanController@printSJ_sample')->name('print-sj-sample', '{id}');
	Route::get('sales/surat-jalan/printSJ-V1/{id}','SuratJalanController@printSJ_invoice')->name('print-sj-v1', '{id}');
	Route::get('sales/surat-jalan/printSJ-V0-invoice/{id}','SuratJalanController@printSJ_invoice_sj_kecil')->name('print-sj-v1-invoice', '{id}');
	Route::get('sales/surat-jalan/printSJb/{id}','SuratJalanController@printSJb')->name('print-sjb', '{id}');

	Route::get('sales/surat-jalan/get-no-sj', 'SuratJalanController@get_no_sj');

});



//Modul Bill of materials
Route::get('/bom','BomController@index')->name('bom.index');
Route::get('/bom/create','BomController@create')->name('bom.create');
Route::get('/bomKodeBarang', 'BomController@getkodebarang');
Route::post('/bomaddDetail', 'BomdetailController@storeDetailBom');
Route::get('/bom/edit/{id_bom}', 'BomController@edit')->name('bom.edit','{id_bom}');
Route::post('/bom/update', 'BomController@update');
Route::get('/bom/delete/{id_bom}','BomController@delete')->name('bom.delete','{id_bom}');

//modul Request
Route::get('/request','ReqController@index')->name('request.index');
Route::get('/request/create','ReqController@create')->name('request.create');
Route::get('/reqKodeBarang', 'ReqController@getKodeBarang');
Route::post('/reqaddDetail', 'Reqdetailcontroller@storeDetail');
Route::get('/request/edit/{id_material_request}', 'ReqController@edit')->name('request.edit','{id_material_request}');
Route::post('/request/update', 'ReqController@update');
Route::get('/request/delete/{id_material_request}','ReqController@delete')->name('request.delete','{id_material_request}');





Route::group(['middleware' => ['auth','checkrole:keuangan,superadmin']], function () {
	// //modul Finance lama

	// Route::get('/finance/input_jurnal_harian','FinanceController@input_jurnal_harian');
	// Route::get('/finance/index','FinanceController@index');
	// Route::post('/finance/get_coa_number','FinanceController@getCoanumber');
	// //Route::get('/finance/get_coa_number','FinanceController@getCoanumber');
	// Route::get('/finance/getnopo','FinanceController@getpo');
	// Route::get('/finance/getnoso','FinanceController@getso');
	// Route::post('/finance/storejurnal','FinanceController@storeData_Jurnal')->name('finance.storejurnal');
	// Route::post('/finance/storejurnalpiutang','FinanceController@storeData_jurnalpiutang')->name('finance.storejurnalpiutang');
	// Route::get('/finance/create','FinanceController@create')->name('finance.create');
	// Route::get('/finance/store','FinanceController@store')->name('finance.store');
	// //faktur
	// Route::get('/finance/faktur','FinanceController@faktur');
	// Route::get('/finance/create-faktur','FinanceController@create_faktur');
	// Route::post('/finance/store-faktur','FinanceController@store_data_faktur');
	// Route::get('/finance/get-no-sj','FinanceController@get_no_sj');
	// Route::get('/finance/print-faktur/{id}','FinanceController@print_faktur')->name('print-faktur', '{id}');;

	// // Route::resource('finance', 'FinanceController');
	// Route::get('/finance/index','FinanceController@index')->name('finance.index');
	// Route::get('/finance/input_pelunasan_supplier','FinanceController@input_pelunasan_piutang_supplier');
	// Route::get('/finance/pelunasan_piutang','FinanceController@pelunasan_piutang');

	Route::get('/finance/input_jurnal_harian','FinanceController@input_jurnal_harian');
	Route::get('/finance/index','FinanceController@index');
	Route::post('/finance/get_coa_number','FinanceController@getCoanumber');
	Route::get('/finance/get_coa_number','FinanceController@getCoanumber');
	Route::get('/finance/getnopo','FinanceController@getpo');
	Route::get('/finance/getnoso','FinanceController@getso');
	Route::post('/finance/storejurnal','FinanceController@storeData_Jurnal')->name('finance.storejurnal');
	Route::post('/finance/storejurnalpiutang','FinanceController@storeData_jurnalpiutang')->name('finance.storejurnalpiutang');
	Route::get('/finance/create','FinanceController@create')->name('finance.create');
	Route::post('/finance/store','FinanceController@store')->name('finance.store');
	//faktur
	Route::get('/finance/faktur','FinanceController@faktur');
	Route::get('/finance/create-faktur','FinanceController@create_faktur');
	Route::post('/finance/store-faktur','FinanceController@store_data_faktur');
	Route::get('/finance/get-no-sj','FinanceController@get_no_sj');
	Route::get('/finance/print-faktur/{id}','FinanceController@print_faktur')->name('print-faktur', '{id}');
	//--tambahan modul faktur baru
    Route::get('/finance/membuat_faktur_pilihan','FinanceController@membuat_faktur_dengan_pilihan');
    Route::get('finance/index_pilihan_faktur','FinanceController@index_pilihan_faktur');
    Route::post('/finance/store-faktur-pilihan','FinanceController@store_data_faktur_pilihan');
	//--

	// Route::resource('finance', 'FinanceController');
	Route::get('/finance/index','FinanceController@index')->name('finance.index');
	Route::get('/finance/input_pelunasan_supplier','FinanceController@input_pelunasan_piutang_supplier');
	Route::get('/finance/pelunasan_piutang','FinanceController@pelunasan_piutang');
    Route::post('/finance/storefinance','FinanceController@storefinance')->name('finance.storefinance');
    Route::post('/finance/simpan_pengeluaran_kas','FinanceController@simpan_pengeluaran_kas')->name('finance.simpan_pengeluaran_kas');

	//pelunasan supplier
    Route::get('finance/get_sisa_hutang_supplier','FinanceController@load_data_sisa_hutang_supplier');
    Route::post('finance/pelunasan_hutang_ supplier','FinanceController@pelunasan_hutang_supplier')->name('finance.pelunasan_hutang_supplier');
    Route::get('finance/daftar_hutang_supplier','FinanceController@daftar_hutang_supplier')->name('finance.daftar_hutang_supplier');
    Route::get('finanace/daftar_hutang_pembayaran_supplier','FinanceController@daftar_hutang_pembayaran_supplier')->name('finance.daftar_hutang_pembayaran_supplier');
    //Route::get('finance/d')

    //pelunasan piutang customer
    Route::get('finance/get_sisa_piutang_customer','FinanceController@load_data_sisa_piutang_customer');

	 //laporan keuangan
	 Route::get('finance/laporan_neraca','FinanceController@laporanneraca');
	 Route::get('finance/laporan_rugi_laba','FinanceController@laporan_rugi_laba');
	 Route::get('finance/get_data_jurnal_laporan','FinanceController@get_data_jurnal_laporan');
	 Route::get('finance/get_laporan_data_jurnal','FinanceController@laporan_data_jurnal');
	 Route::get('finance/posting_finance','FinanceController@posting_finance')->name('finance.posting_finance');
	 Route::get('finance/posting_laporan_keuangan','FinanceController@posting_laporan_keuangan');



});