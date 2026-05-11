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

    Route::get('/master-pembayaran/data','BendaharaController@getMasterPembayaran');
});
