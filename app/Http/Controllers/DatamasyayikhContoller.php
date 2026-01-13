<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DatamasyayikhContoller extends Controller
{
   public function index()
   {
    // retun "data masyayikh";
   return view('layouts.pages.admin.datamasyayikh.datamasyayikh');
   }
}
