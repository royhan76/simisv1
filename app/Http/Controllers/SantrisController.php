<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use App\Photo;
use App\Santris;
use App\WaliModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
// use DataTables;
use \Yajra\Datatables\Datatables;


class SantrisController extends Controller
{
    public function index()
    {
        $santri_id =Auth::user()->santri_id;
        $santri = Santris::find($santri_id);
        $wali = WaliModel::find($santri_id);
        $foto = Photo::find($santri_id);

        return view('layouts.pages.santri.santri')->with(compact('wali','foto', 'santri'));
    }


    public function maarif()
    {
        return view('layouts.pages.santri.maarif');
    }
    public function keamanan()
    {
        return view('layouts.pages.santri.keamanan');
    }
    public function keuangan()
    {
        return view('layouts.pages.santri.keuangan');
    }

    public function cekNoInduk(Request $request)
    {
        $exists = Santris::where('no_induk', $request->no_induk)->exists();

        return response()->json([
            'exists' => $exists
        ]);
    }



}
