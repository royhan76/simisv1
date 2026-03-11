<?php
namespace App\Http\Controllers;

use App\Http\Responses\SelectOptionResponse;
use Illuminate\Http\Request;
use App\AgamaModel;
use Illuminate\Support\Facades\DB;

class AgamaController extends Controller
{
    function AgamaController(Request $request) {
        $AgamaController = AgamaModel::query()
                ->select('id', 'agama as text')
                ->when($request->q, function ($query) use ($request) {
                    $query->where(DB::raw('UPPER(agama)'), 'like', '%' . strtoupper($request->q) . '%');
                })
                ->limit($request->page ?? 30)
                ->get();

                return new SelectOptionResponse($AgamaController);



    }
}
