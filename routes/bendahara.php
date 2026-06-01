<?php

use Illuminate\Support\Facades\Route;


// ================= BENDAHARA =================
Route::prefix('admin/bendahara')
    ->middleware(['auth', 'role:admin,bendahara'])
    ->group(function () {

    Route::get('/', 'BendaharaController@index')->name('bendahara');
    Route::get('/mBendahara', 'BendaharaController@index');

    Route::get('/data', 'BendaharaController@getData');

    Route::post('/store', 'BendaharaController@store');

    Route::get('/detail/{id}', 'BendaharaController@show')
        ->where('id', '[0-9]+');

    Route::get('/nominal/data', 'BendaharaController@getNominal');
    Route::post('/nominal/store', 'BendaharaController@storeNominal');
    Route::post('/nominal/update', 'BendaharaController@updateNominal');
    Route::post('/nominal/delete', 'BendaharaController@deleteNominal');


    Route::get('/pembayaran', 'BendaharaController@pembayaran');
    Route::get('/pembayaran/data', 'BendaharaController@getSantriPembayaran');

    Route::get('/pembayaran/detail/{santri_id}','BendaharaController@detailPembayaran');

    Route::get('/laporan-keuangan', 'BendaharaController@laporanKeuangan');
    Route::get('/laporan-keuangan/data', 'BendaharaController@getLaporanKeuangan');
    Route::get('/laporan-keuangan/export', 'BendaharaController@exportLaporanKeuangan');
    Route::get('/laporan-keuangan/detail/{santri_id}', 'BendaharaController@detailLaporanKeuangan');

    Route::get('/master-pembayaran/data','BendaharaController@getMasterPembayaran');

    Route::post('/pembayaran/store','BendaharaController@storePembayaran');

    Route::get('/pembayaran/cek/{santri_id}','BendaharaController@cekPembayaran');

    Route::get('/pembayaran/unit/cek/{santri_id}','BendaharaController@cekPembayaranUnit');

    Route::get(
    '/pembayaran/nominal/syahriyah',
    'BendaharaController@getNominalSyahriyah'
);


});
