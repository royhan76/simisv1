<?php

namespace App\Http\Controllers;

use App\Alamat;
use App\KabupatenModel;
use App\KecamatanModel;
use App\ProvinsiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Responses\SelectOptionResponse;

class AlamatsController extends Controller
{
    public function selectProvinsi(Request $request)
    {
        $dataWilayahProvinsi = ProvinsiModel::select('id', 'nama', 'nama as text')
        ->where(DB::raw('UPPER(nama)'), 'like', '%' . strtoupper($request->q) . '%')
            ->limit($request->page)
            ->get();

            return new SelectOptionResponse($dataWilayahProvinsi);

    }
    public function selectKabupaten(Request $request)
    {
        $dataWilayahKota = KabupatenModel::select('id', 'nama', 'provinsi_id', 'nama as text')
            ->with('wilayah_provinsi:id,nama')
            ->where(DB::raw('UPPER(nama)'), 'like', '%' . strtoupper($request->q) . '%')
            ->where('provinsi_id', 'like', '%' . $request->provinsi_id . '%')
            // ->offset(0)
            ->limit($request->page)
            ->get();

        return new SelectOptionResponse($dataWilayahKota);
    }
    public function selectKecamatan(Request $request)
    {
        $dataWilayahKecamatan = KecamatanModel::select('id', 'nama', 'kota_id', 'nama as text')
        ->with('wilayah_kota')
        ->with('wilayah_kota.wilayah_provinsi')
        ->where(DB::raw('UPPER(nama)'), 'like', '%' . strtoupper($request->q) . '%')
        ->where('kota_id', 'like', '%' . $request->kabupaten_id . '%')
        // ->offset(0)
        ->limit($request->page)
        ->get();

        return new SelectOptionResponse($dataWilayahKecamatan);
    }
    public function selectKelurahan(Request $request)
    {
        $dataWilayahKelurahan = Alamat::select('id', 'nama', 'kecamatan_id', 'nama as text')
        ->with('wilayah_kecamatan')
        ->with('wilayah_kecamatan.wilayah_kota')
        ->with('wilayah_kecamatan.wilayah_kota.wilayah_provinsi')
            ->where(DB::raw('UPPER(nama)'), 'like', '%' . strtoupper($request->q) . '%')
            ->where('kecamatan_id', 'like', '%' . $request->kecamatan_id . '%')

            ->limit($request->page)
            ->get();

            return new SelectOptionResponse($dataWilayahKelurahan);
    }
    public function selectTempatLahir(Request $request)
    {
        $dataWilayahKota = KabupatenModel::select('id', 'nama', 'provinsi_id', 'nama as text')
            // ->with('wilayah_provinsi:id,nama')
            // ->where(DB::raw('UPPER(nama)'), 'like', '%' . strtoupper($request->q) . '%')
            // ->where('provinsi_id', 'like', '%' . $request->provinsi_id . '%')
            // ->offset(0)
            ->limit($request->page)
            ->get();

        return new SelectOptionResponse($dataWilayahKota);
    }
}
