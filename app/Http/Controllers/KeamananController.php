<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KeamananController extends Controller
{
    public function pengurusKeamanan()
    {
        return view('layouts.pages.admin.keamanan.dataKeamanan');
    }
}
