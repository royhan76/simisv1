<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('role:admin,sekretaris')->group(function () {

    Route::get('/', 'AdminController@halamanDashboard')->name('admin');

    /*
    |-----------------------------
    | USER MANAGEMENT
    |-----------------------------
    */

    Route::get('/users','UserController@index');
    Route::post('/users/store','UserController@store');
    Route::get('/users/{id}/edit','UserController@edit');
    Route::post('/users/update-user','UserController@update');
    Route::delete('/users/{id}','UserController@destroy');


    /*
    |-----------------------------
    | DATA SANTRI
    |-----------------------------
    */

    Route::get('/alldatasantri', 'AdminController@index')->name('alldatasantri');
    Route::get('dataSantri', 'AdminController@getSantri')->name('dataSantri');
    Route::get('form_baru', 'AdminController@create')->name('form_baru');
    Route::get('form_lama', 'AdminController@createSantriLama')->name('form_lama');
    Route::post('add_santri_baru', 'AdminController@store')->name('add_santri_baru');
    Route::get('/exportSantri','AdminController@exportSantri');


    /*
    |-----------------------------
    | SANTRI ACTION
    |-----------------------------
    */

    Route::delete('{id}', 'AdminController@destroy')->name('santri.destroy');
    Route::get('{id}/edit', 'AdminController@edit');
    Route::get('{id}', 'AdminController@show');
    Route::put('update/{id}', 'AdminController@update');

});
