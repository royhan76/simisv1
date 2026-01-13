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
        $selectPendidikan = PendidikanModel::select('id_pendidikan','id_pendidikan as id' , 'categori', 'categori as text')
        ->where(DB::raw('UPPER(id_pendidikan)'), 'like', '%' . strtoupper($request->q) . '%')
            ->limit($request->page)
            ->get();

            return new SelectOptionResponse($selectPendidikan);

    }


}
