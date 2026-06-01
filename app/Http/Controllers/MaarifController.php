<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MaarifController extends Controller
{
    public function index()
{
    return view('maarif.dashboard');
}
}
