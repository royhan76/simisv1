<?php

namespace App\Http\Controllers;

use App\Http\Responses\SelectOptionResponse;
use Illuminate\Http\Request;
use App\StatusMukimModel;
use Illuminate\Support\Facades\DB;

class StatusMukimController extends Controller
{
    function StatusMukimController(Request $request)
    {
        $StatussantriController = StatusMukimModel::select('id', 'status', 'status as text')
        ->where(DB::raw('UPPER(id)'), 'like', '%' . strtoupper($request->q) . '%')
                ->limit($request->page)
                ->get();

                return new SelectOptionResponse($StatussantriController);
    }
}
