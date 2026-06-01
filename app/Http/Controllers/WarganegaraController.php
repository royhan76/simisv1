<?php

namespace App\Http\Controllers;

use App\Http\Responses\SelectOptionResponse;
use Illuminate\Http\Request;
use App\WarganegaraModel;
use Illuminate\Support\Facades\DB;

class WarganegaraController extends Controller
{
    function WarganegaraController(Request $request) {
         $data = WarganegaraModel::select('id','warganegara as text')
        ->where(DB::raw('UPPER(warganegara)'), 'like', '%' . strtoupper($request->q) . '%')
        ->limit($request->page ?? 10)
        ->get();

    return new SelectOptionResponse($data);

    }
}
