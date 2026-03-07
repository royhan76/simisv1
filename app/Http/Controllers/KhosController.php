<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KhosModel;
use Illuminate\Support\Facades\DB;
use App\Http\Responses\SelectOptionResponse;


class KhosController extends Controller
{
     function khos(Request $request)
     {
        $khosController = KhosModel::select('id', 'nama_khos', 'nama_khos as text')
        ->where(DB::raw('UPPER(id)'), 'like', '%' . strtoupper($request->q) . '%')

                ->get();

                return new SelectOptionResponse($khosController);
     }
}
