<?php

namespace App\Http\Controllers;

use App\Alamat;
use App\KabupatenModel;
use App\KecamatanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Responses\SelectOptionResponse;
use App\PendidikanModel;

class PendidikanController extends Controller
{
    public function selectPendidikan(Request $request)
    {
        $selectPendidikan = PendidikanModel::select('categori','id_pendidikan as id' ,  'categori as text')
        ->where(DB::raw('UPPER(categori)'), 'like', '%' . strtoupper($request->q) . '%')
            ->limit($request->page)
            ->get();

            return new SelectOptionResponse($selectPendidikan);

    }


}
