<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MasterPembayaran; // ✅ sesuai model kamu

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
}
