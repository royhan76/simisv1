<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BendaharaController extends Controller
{
  public function index()
    {
        return view('layouts.pages.admin.bendahara.dashboard'); // ✅ beda folder
    }
}
