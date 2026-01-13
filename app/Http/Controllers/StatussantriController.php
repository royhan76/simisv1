<?php

namespace App\Http\Controllers;

use App\Http\Responses\SelectOptionResponse;
use Illuminate\Http\Request;
use App\StatussantriModel;
use Illuminate\Support\Facades\DB;


class StatussantriController extends Controller
{
    public function StatussantriController(Request $request)
    {
       $StatussantriController = StatussantriModel::select('id', 'status_santri', 'status_santri as text')
        ->where(DB::raw('UPPER(id)'), 'like', '%' . strtoupper($request->q) . '%')
                ->limit($request->page)
                ->get();

                return new SelectOptionResponse($StatussantriController);

    }

}
