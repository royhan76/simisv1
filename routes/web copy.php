<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;




Auth::routes();


Route::group(
    ['middleware' =>'is_admin'],
    function () {

    Route::prefix('admin')->group(
        function () {

        Route::get('/', 'AdminController@halamanDashboard')->name('admin');
        Route::get('/alldatasantri', 'AdminController@index')->name('alldatasantri');
        Route::get('dataSantri', 'AdminController@getSantri')->name('dataSantri');
        Route::get('form_baru', 'AdminController@create')->name('form_baru');
        Route::get('form_lama', 'AdminController@createSantriLama')->name('form_lama');

        Route::post('add_santri_baru', 'AdminController@store')->name('add_santri_baru');
        Route::get('/{id}', 'AdminController@show');
        Route::get('/{id}/edit', 'AdminController@edit');
        Route::delete('{id}', 'AdminController@destroy')->name('santri.destroy');
        // Route::get('/{id}/hapus', 'AdminController@destroy');
        Route::put('update/{id}', 'AdminController@update');
        // Route::get('admin/pengguna', 'PenggunaController@pengguna')->name('pengguna')->middleware('auth');
        Route::get('data/users', 'PenggunaController@pengguna');
        Route::get('datamaarif', 'PenggunaController@pengguna');


        // Keamanan
        Route::get('/keamanan/datakeamanan', 'KeamananController@pengurusKeamanan');
        Route::get('/maarif/datamaarif', 'MaarifController@dataMaarif');

        // data masyayikh


    });
});
        Route::group(['middleware' =>'is_admin'], function () {
            Route::prefix('masyayikh')->group(function () {
                // struktur org

                Route::get('/dataMasyayikh', 'DatamasyayikhContoller@index');
            });
        });


        Route::group(['middleware' =>'is_admin'], function () {
            Route::prefix('sekretaris')->group(function () {
                // struktur org

                Route::get('/strukturorg', 'StrukturOrgController@StrukturOrg');
            });
        });



Route::get('provinsi', 'AlamatsController@selectProvinsi');
Route::get('kabupaten', 'AlamatsController@selectKabupaten');
Route::get('kecamatan', 'AlamatsController@selectKecamatan');
Route::get('alamat', 'AlamatsController@selectKelurahan');
Route::get('pendidikan', 'PendidikanController@selectPendidikan');
Route::get('status_santri', 'StatussantriController@StatussantriController');

Route::group(['middleware' => 'auth'], function () {
    Route::prefix('santri')->group(function () {
        Route::get('/', 'SantrisController@index')->name('santri');
        Route::get('maarif', 'SantrisController@maarif')->name('maarif');
        Route::get('keamanan', 'SantrisController@keamanan')->name('keamanan');
        Route::get('keuangan', 'SantrisController@keuangan')->name('keuangan');
    });
});

// Route::get('/login','HomeController@login')->name('login')->middleware('guest');
Route::get('/', function () {
    return view('auth.login');
})->name('loginn')->middleware('guest');



// Route::get('datamaarif', 'KeamananController@pengurusKeamanan');
