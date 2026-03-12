<?php

use Illuminate\Support\Facades\Route;

Route::prefix('bendahara')->group(function () {

    Route::get('/', 'BendaharaController@index');

});
