<?php

use Illuminate\Support\Facades\Route;

Route::prefix('sekretaris')->group(function () {

    Route::get('/', 'SekretarisController@index');

    Route::get('/strukturorg', 'StrukturOrgController@StrukturOrg');

});
