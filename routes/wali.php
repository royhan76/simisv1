<?php

use Illuminate\Support\Facades\Route;

Route::prefix('wali')->group(function () {

    Route::get('/', 'WaliController@index');



});
