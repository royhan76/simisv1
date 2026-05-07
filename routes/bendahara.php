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
});
