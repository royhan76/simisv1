<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MaarifController extends Controller
{
    public function dataMaarif()
    {
        return view('layouts.pages.admin.maarif.dataMaarif');
    }
}
