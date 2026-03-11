<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();


Route::get('/', function () {
    return view('auth.login');
})->name('loginn')->middleware('guest');

Route::get('provinsi', 'AlamatsController@selectProvinsi');
Route::get('kabupaten', 'AlamatsController@selectKabupaten');
Route::get('kecamatan', 'AlamatsController@selectKecamatan');
Route::get('alamat', 'AlamatsController@selectKelurahan');
Route::get('pendidikan', 'PendidikanController@selectPendidikan');
Route::get('status_santri', 'StatussantriController@StatussantriController');
Route::get('warganegara', 'WarganegaraController@WarganegaraController');
Route::get('agama', 'AgamaController@AgamaController');


