<?php

namespace App\Http\Controllers;

use App\Photo;
use App\DokKkModel;
use App\Santris;
use App\WaliModel;
use App\AgamaModel;
use App\WarganegaraModel;
use App\ThnKeluarModel;
use App\ThnMasukModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use \Yajra\Datatables\Datatables;
use App\Exports\SantriExport;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layouts.pages.admin.santri');
    }
    public function halamanDashboard()
    {
       return view('layouts.pages.admin.halamanDashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.pages.admin.form_baru');
    }

    public function createSantriLama()
    {
       return view('layouts.pages.admin.form_lama');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    // cek apakah no_induk sudah ada
    $cek = Santris::where('no_induk', $request->no_induk)->first();

    if ($cek) {
        Alert::error('Maaf!', 'Data santri dengan No. Induk tersebut sudah tersedia');
        return redirect()->back()->withInput();
    }

    // format tanggal
    $tgl_lahir = $request->tgl_lahir
        ? date('Y-m-d', strtotime($request->tgl_lahir))
        : null;

    // simpan wali
    WaliModel::create([
        'santri_id' => $request->nik,
        'ayah' => $request->ayah,
    ]);

    $agamaValue = $request->agama;
    if ($agamaValue !== null && ctype_digit((string) $agamaValue)) {
        $agamaValue = optional(AgamaModel::find($agamaValue))->agama;
    }

    $warganegaraValue = $request->warganegara;
    if ($warganegaraValue !== null && ctype_digit((string) $warganegaraValue)) {
        $warganegaraValue = optional(WarganegaraModel::find($warganegaraValue))->warganegara;
    }

    // simpan santri
    Santris::create([
        'santri_id' => $request->nik,
        'no_induk' => $request->no_induk,
        'kk' => $request->kk,
        'nik' => $request->nik,
        'tempat_lahir' => $request->tempat_lahir,
        'tgl_lahir' => $tgl_lahir,
        'nama' => $request->nama_lengkap,
        'khos' => $request->khos,
        'status' => $request->status_santri,
        'jalan' => $request->jalan,
        'kelurahan' => $request->kelurahan_id,
        'kecamatan' => $request->kecamatan_id,
        'kabupaten' => $request->kabupaten_id,
        'provinsi' => $request->propinsi_id,
        'pend_terakhir' => $request->pendidikan_id,
        'no_tlp' => $request->no_tlp,
        'kelamin' => $request->jenis_kelamin,
        'agama' => $agamaValue,
        'warga_negara' => $warganegaraValue,
        'anak_ke' => $request->anak_ke,
        'j_saudara' => $request->j_saudara,
    ]);

    // upload foto
    if ($request->hasFile('image')) {

        $path = $request->file('image')->store('images', 'public');

        Photo::create([
            'name' => $request->file('image')->getClientOriginalName(),
            'path' => $path,
            'santri_id' => $request->nik,
        ]);
    }

    // upload dokumen kk
    if ($request->hasFile('dok_kk')) {

        $pathKK = $request->file('dok_kk')->store('dokkk', 'public');

        DokKkModel::create([
            'name' => $request->file('dok_kk')->getClientOriginalName(),
            'path' => $pathKK,
            'id_santri' => $request->nik,
        ]);
    }

    // tahun masuk
    ThnMasukModel::create([
        'id' => $request->nik,
        'id_santri' => $request->nik,
        'thn_masuk' => $request->tahun_masuk,
    ]);

    // tahun keluar
    ThnKeluarModel::create([
        'id' => $request->nik,
        'id_santri' => $request->nik,
        'thn_keluar' => $request->tahun_keluar,
    ]);

    Alert::success('Berhasil', 'Data santri berhasil disimpan');

    return redirect()->route('admin');
}

    public function getSantri(Request $request)
{

    if ($request->ajax()) {

        $query = Santris::query()

        ->leftJoin('thn_masuk', 'santri.santri_id', '=', 'thn_masuk.id_santri')

        ->select(
            'santri.*',
            'thn_masuk.thn_masuk'
        );


        /*
        =========================
        FILTER STATUS DATA
        =========================
        */

        if ($request->status == 'lengkap') {

            $query->whereNotNull('no_induk')
                  ->whereNotNull('kk')
                  ->whereNotNull('nik')
                  ->whereNotNull('tempat_lahir')
                  ->whereNotNull('tgl_lahir')
                  ->whereNotNull('nama')
                  ->whereNotNull('khos')
                  ->whereNotNull('status')
                  ->whereNotNull('jalan')
                  ->whereNotNull('kelurahan')
                  ->whereNotNull('kecamatan')
                  ->whereNotNull('kabupaten')
                  ->whereNotNull('provinsi');

        }

        if ($request->status == 'belum') {

            $query->where(function($q){

                 $q->whereNull('no_induk')
                  ->orWhereNull('kk')
                  ->orWhereNull('nik')
                  ->orWhereNull('tempat_lahir')
                  ->orWhereNull('tgl_lahir')
                  ->orWhereNull('nama')
                  ->orWhereNull('khos')
                  ->orWhereNull('status')
                  ->orWhereNull('jalan')
                  ->orWhereNull('kelurahan')
                  ->orWhereNull('kecamatan')
                  ->orWhereNull('kabupaten')
                  ->orWhereNull('provinsi');

            });

        }


        /*
        =========================
        FILTER TAHUN MASUK
        =========================
        */

        if ($request->tahun) {

            $query->whereYear('thn_masuk.thn_masuk', $request->tahun);

        }


        return DataTables::of($query)

        ->addColumn('action', function ($data) {

            $button = "<div class='btn-group'>";

            $button .= '<a href="' . url('/admin', $data->santri_id) . '" class="btn btn-success btn-xs">
            <i class="la flaticon-search-2"></i></a>';

            $button .= '<a href="' . url('/admin/' . $data->santri_id . '/edit') . '" class="btn btn-warning btn-xs">
            <i class="icon-note"></i></a>';

            $button .= '<a href="javascript:void(0)"
                data-id="'.$data->santri_id.'"
                class="btn-hapus btn btn-danger btn-xs">
                <i class="icon-trash"></i>
            </a>';

            $button .= "</div>";

            return $button;

        })

        ->addIndexColumn()
        ->rawColumns(['action'])
        ->make(true);

    }

}


    public function show($id)
    {
        $santri = Santris::where('santri_id', $id)->first();
        $wali = WaliModel::where('santri_id', $id)->first();

        $foto = Photo::where('santri_id', $id)->first();
        $thn_masuk = ThnMasukModel::where('id_santri', $id)->first();
        $thn_keluar = ThnKeluarModel::where('id_santri', $id)->first();
        $dok_kk =DokKkModel::where('id_santri', $id)->first();
        return view('layouts.pages.admin.detail')->with(compact('wali', 'santri', 'foto','thn_masuk', 'thn_keluar','dok_kk'));
    }

    public function edit($id)
    {
        $santri = Santris::where('santri_id', $id)->first();
        $wali = WaliModel::where('santri_id', $id)->first();
        $thn_masuk = ThnMasukModel::where('id_santri', $id)->first();
        $thn_keluar = ThnKeluarModel::where('id_santri', $id)->first();

        $foto = Photo::where('santri_id', $id)->first();
        $dok_kk =DokKkModel::where('id_santri', $id)->first();

        if ($santri) {
            if (!empty($santri->agama) && ctype_digit((string) $santri->agama)) {
                $santri->agama = optional(AgamaModel::find($santri->agama))->agama ?? $santri->agama;
            }

            if (!empty($santri->warga_negara) && ctype_digit((string) $santri->warga_negara)) {
                $santri->warga_negara = optional(WarganegaraModel::find($santri->warga_negara))->warganegara ?? $santri->warga_negara;
            }
        }

        return view('layouts.pages.admin.edit')->with(compact('santri', 'wali', 'foto','thn_masuk', 'thn_keluar','dok_kk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


public function update(Request $request, $id)
{

    $santri = Santris::findOrFail($id);
    $wali   = WaliModel::findOrFail($id);


// ================= PHOTO =================

    $data = Photo::where('santri_id', $id)->first();

    if ($request->hasFile('photo')) {

        if ($data && $data->path) {
            Storage::disk('public')->delete($data->path);
        }

        $path = $request->file('photo')->store('images', 'public');

        if (!$data) {
            $data = new Photo();
            $data->santri_id = $id;
        }

        $data->path = $path;
        $data->save();
    }


// ================= DOK KK =================

    $dok_kk = DokKkModel::where('id_santri', $id)->first();

    if ($request->hasFile('dok_kk')) {

        if ($dok_kk && $dok_kk->path) {
            Storage::disk('public')->delete($dok_kk->path);
        }

        $path = $request->file('dok_kk')->store('images', 'public');

        if (!$dok_kk) {
            $dok_kk = new DokKkModel();
            $dok_kk->id_santri = $id;
        }

        $dok_kk->path = $path;
        $dok_kk->save();
    }


// ================= UPDATE SANTRI =================

    $santri->no_induk  = $request->no_induk;
    $santri->nama = $request->nama_lengkap;
    $santri->status = $request->status_santri;
    $santri->khos = $request->khos;
    $santri->kk = $request->kk;
    $santri->nik = $request->nik;
    $santri->tempat_lahir = $request->tempat_lahir;
    $santri->tgl_lahir = $request->tgl_lahir;
    $santri->nisn = $request->nisn;
    $santri->pend_terakhir = $request->pendidikan_id;
    $santri->provinsi = $request->propinsi_id;
    $santri->kabupaten = $request->kabupaten_id;
    $santri->kecamatan = $request->kecamatan_id;
    $santri->kelurahan = $request->kelurahan_id;
    $santri->jalan = $request->jalan;
    $santri->kodepos = $request->kode_pos;
    $santri->no_tlp = $request->no_tlp;
    $santri->kelamin = $request->jenis_kelamin ?? $santri->kelamin;
    $santri->anak_ke = $request->anak_ke ?? $santri->anak_ke;
    $santri->j_saudara = $request->j_saudara ?? $santri->j_saudara;

    $agamaValue = $request->agama;
    if ($agamaValue !== null && ctype_digit((string) $agamaValue)) {
        $agamaValue = optional(AgamaModel::find($agamaValue))->agama ?? $agamaValue;
    }

    $santri->agama = $agamaValue;
    $santri->warga_negara = $request->warganegara;

    $santri->save();


// ================= UPDATE WALI =================

    $wali->ayah = $request->ayah;
    $wali->ayah_nik = $request->nik_ayah;
    $wali->pekerjaan_ayah = $request->pekerjaan_ayah;
    $wali->tempat_lahir_ayah = $request->tempat_lahir_ayah;
    $wali->tgl_lahir_ayah = $request->tgl_lahir_ayah;

    $wali->ibu = $request->ibu;
    $wali->nik_ibu = $request->nik_ibu;
    $wali->pekerjaan_ibu = $request->pekerjaan_ibu;
    $wali->tempat_lahir_ibu = $request->tempat_lahir_ibu;
    $wali->tgl_lahir_ibu = $request->tgl_lahir_ibu;

    $wali->save();


// ================= TAHUN MASUK =================

    ThnMasukModel::updateOrCreate(
        ['id_santri' => $id],
        ['thn_masuk' => $request->tahun_masuk]
    );


// ================= TAHUN KELUAR =================

    ThnKeluarModel::updateOrCreate(
        ['id_santri' => $id],
        ['thn_keluar' => $request->tahun_keluar]
    );


    return redirect()->route('admin')->with('success', 'Data Berhasil disimpan');

}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    // dd($id);
        DB::table('santri')->where('santri_id', $id)->delete();
        DB::table('wali')->where('santri_id', $id)->delete();
        DB::table('photos')->where('santri_id', $id)->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus'
        ]);
    }

    public function editFoto($id)
    {
        $data = Photo::find($id);
        return view('layouts.pages.admin.editfoto', compact('data'));
    }

    public function updateFoto(Request $request, $id)
    {
        $data = Photo::find($id);

        if ($request->hasFile('photo')) {
            // Hapus foto lama
            Storage::delete('public/images/' . $data->name);

            // Simpan foto baru
            $photo = $request->file('photo');
            $filename = $photo->getClientOriginalName();
            $path = $photo->storeAs('public/images', $filename);
            $data->path = $filename;
        }

        $data->save();
        return redirect('admin/santri')->with('success', 'Foto updated successfully');
    }
    public function pengguna()
    {
       return view('layouts.pages.admin.pengguna');
    }

    public function exportSantri(Request $request)
{
    // dd($request->tahun);

    $status = $request->status;
    $tahun  = $request->tahun;

    return Excel::download(
        new SantriExport($status,$tahun),
        'data_santri.xlsx'
    );

}
}
