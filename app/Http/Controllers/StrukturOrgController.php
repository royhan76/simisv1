<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StrukturOrgController extends Controller
{
    public function StrukturOrg()
    {
        return view('layouts.pages.admin.strukturorg');
    }
}
