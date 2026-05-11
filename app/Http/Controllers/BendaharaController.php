<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MasterPembayaran; // ✅ sesuai model kamu
use App\Santris;


class BendaharaController extends Controller
{
    public function index()
    {
        return view('layouts.pages.admin.bendahara.dashboard');
    }

    // ✅ STORE
    public function storeNominal(Request $request)
{
    MasterPembayaran::create([
        'name' => $request->name,
        'nominal' => (int) $request->nominal
    ]);

    return response()->json(['success' => true]);
}

    // ✅ UPDATE
    public function updateNominal(Request $request)
    {
        $data = MasterPembayaran::find($request->id);

    $data->update([
        'name' => $request->name,
        'nominal' => (int) $request->nominal
    ]);

    return response()->json(['success' => true]);
    }

    // ✅ GET
    public function getNominal()
    {
        return response()->json([
        'data' => MasterPembayaran::latest()->get()
    ]);
    }

    public function deleteNominal(Request $request)
    {
        MasterPembayaran::find($request->id)->delete();

        return response()->json(['success' => true]);
    }

    public function pembayaran()
    {
        return view('layouts.pages.admin.bendahara.pembayaran.index');
    }

    public function getSantriPembayaran()
    {
        return response()->json([
            'data' => Santris::latest()->get()
        ]);
    }

    public function detailPembayaran($santri_id)
{
    $santri = Santris::where('santri_id',$santri_id)->first();

    return response()->json([
    'nama'  => $santri->nama,
    'nik'   => $santri->nik,
    'khos'  => $santri->khos,
    'kamar' => $santri->kamar,
    'foto'  => $santri->foto ?? 'assets/images/muslim.png', //https://sim.ppmissarang.com/storage/images/muslim.png
]);
}

    public function getMasterPembayaran()
    {
        return response()->json([
            'data' => MasterPembayaran::all()
        ]);
    }
}
