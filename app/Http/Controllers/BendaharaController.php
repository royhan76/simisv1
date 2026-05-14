<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MasterPembayaran; // ✅ sesuai model kamu
use App\Santris;
use App\Pembayaran;
use App\PembayaranUnit;
use App\Syahriyah;
use Illuminate\Support\Facades\DB;


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

  public function storePembayaran(Request $request)
    {
        // dd($request);
        DB::beginTransaction();

        try {

            // =====================================
            // SIMPAN PEMBAYARAN UNIT
            // =====================================

            if ($request->unit_id) {

                foreach ($request->unit_id as $unitId) {

                    $unit = MasterPembayaran::find($unitId);

                    if ($unit) {

                        $cekUnit = PembayaranUnit::where('santri_id', $request->santri_id)
                            ->where('nama_unit', $unit->name)
                            ->first();

                        if (!$cekUnit) {

                            PembayaranUnit::create([
                                'santri_id'      => $request->santri_id,
                                'nama_unit'      => $unit->name,
                                'nominal'        => $unit->nominal,
                                'tanggal_bayar'  => now(),
                                'keterangan'     => $request->keterangan,
                            ]);

                        }

                    }

                }

            }

            // =====================================
            // SIMPAN SYAHRIYAH
            // =====================================

            if ($request->bulan) {

                foreach ($request->bulan as $bulan) {

                    // CEK DUPLIKAT
                    $cek = Syahriyah::where('santri_id', $request->santri_id)
                        ->where('tahun_hijriyah', $request->tahun_hijriyah)
                        ->where('bulan', $bulan)
                        ->first();

                    if (!$cek) {

                        Syahriyah::create([
                            'santri_id'        => $request->santri_id,
                            'tahun_hijriyah'   => $request->tahun_hijriyah,
                            'bulan'            => $bulan,
                            'nominal'          => $request->nominal_syahriyah,
                            'tanggal_bayar'    => now(),
                            'keterangan'       => $request->keterangan,
                        ]);

                    }

                }

            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pembayaran berhasil disimpan'
            ]);

        } catch (\Exception $e) {

            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);

        }
    }

    public function cekPembayaran($santri_id)
        {
            $data = Syahriyah::where('santri_id', $santri_id)
                ->select('bulan')
                ->get();

            return response()->json($data);
        }

    public function cekPembayaranUnit($santri_id)
    {
        $data = PembayaranUnit::where('santri_id', $santri_id)
            ->pluck('nama_unit');

        return response()->json($data);
    }

    public function getNominalSyahriyah()
    {
        $data = MasterPembayaran::where('name', 'Syahriyah')
            ->first();

        return response()->json($data);
    }

}
