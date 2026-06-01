<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KeamananController extends Controller
{
   public function index()
{
    return view('keamanan.dashboard');
}
}
