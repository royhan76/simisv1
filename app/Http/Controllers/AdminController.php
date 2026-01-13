<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Santris;
use App\WaliModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use \Yajra\Datatables\Datatables;

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

        $tgl_lahir_ayah = date('Y-m-d', strtotime($request->tgl_lahir_ayah));
        $tgl_lahir_ibu = date('Y-m-d', strtotime($request->tgl_lahir_ibu));
        $tgl_lahir = date('Y-m-d', strtotime($request->tgl_lahir));
        $insertDataWali = WaliModel::create(
            [

                // 'santri_id','ayah_id','ayah_nik','ayah','pend_terakhir_id_ayah','ttl_ayah','pekerjaan_ayah','nik_ibu','ibu','ttl_ibu','pekerjaan_ibu','pend_terakhir_id_ibu'
                'santri_id'  => $request->nik,
                'ayah_nik' => $request->nik_ayah,
                'ayah' => $request->ayah,
                'pend_terakhir_id_ayah' => $request->pendidikan_id_ayah,
                'tempat_lahir_ayah' => $request->tempat_lahir_ayah,
                'tgl_lahir_ayah' => $tgl_lahir_ayah,
                'pekerjaan_ayah' => $request->pekerjaan_ayah,
                'nik_ibu' => $request->nik_ibu,
                'ibu' => $request->ibu,
                'tempat_lahir_ibu' => $request->tempat_lahir_ibu,
                'tgl_lahir_ibu' => $tgl_lahir_ibu,
                'pekerjaan_ibu' => $request->pekerjaan_ibu,
                'pend_terakhir_id_ibu' => $request->pend_id_ibu,
            ]
        );

        $insertSantri = Santris::create([
            'santri_id' => $request->nik,
            'no_induk' => $request->no_induk,
            'kk' => $request->kk,
            'nik' => $request->nik,
            'nisn' => $request->nisn,
            'tempat_lahir'  => $request->tempat_lahir,
            'tgl_lahir'  => $tgl_lahir,
            'nama' => $request->nama_lengkap,
            'khos' => $request->khos,
            'status' => $request->status_santri,
            "jalan" => $request->jalan,
            "kelurahan" => $request->kelurahan_id,
            "kecamatan" => $request->kecamatan_id,
            "kabupaten" => $request->kabupaten_id,
            "provinsi" => $request->propinsi_id,
            'kodepos' => $request->kode_pos,
            'pend_terakhir' => $request->pendidikan_id,
            'wali_id' => $request->nik_ayah
        ]);


        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',

        ]);

        $insertPhotos = Photo::create([
            'name' => $request->file('image')->getClientOriginalName(),
            'path' => $request->file('image')->getClientOriginalName(),
            'santri_id' => $request->nik,
        ]);
        $dataPhoto = ([
            'name' => $request->file('image')->getClientOriginalName(),
            'path' => $request->file('image')->store('public/images'),
            'santri_id' => $request->nik,
        ]);


        $save = new Photo();
        // $save->id_santri => $santri_id;
        // $save->name => $name;
        // $save->path => $path;

        // return $insertPhotos->save();
        // $save->save();

        return redirect()->route('admin');
        // return $data;
    }

    public function getSantri(Request $request)
    {
        if ($request->ajax()) {
            $data = Santris::all();

            return DataTables::of($data)
                ->addColumn(
                    'action',
                    function ($data) {
                        $button = "<div class='btn-group'>";
                        $button .= '<a href="' . url('/admin', $data->santri_id) . '" class="btn btn-success btn-xs"><i class="la flaticon-search-2"></i></a>';
                        $button .= '<a href="' . url('/admin/' . $data->santri_id . '/edit') . '" class="btn btn-warning btn-xs"><i class="icon-note"></i></a>';
                        $button .= '<a href="' . url('/admin/' . $data->santri_id . '/hapus') . '" class="btn btn-danger btn-xs"><i class="icon-trash"></i></a>';
                        $button .= '<button type="submit"  id="btn-simpan"  class="btn btn-xs btn-danger" data-id="'    . $data->santri_id               . '" ></button>';
                        // $button .= '<button id="btn-hapus" class="btn btn-xs btn-danger"
                        // data-id="'    . $data->santri_id               . '"
                        // ><i class="icon-trash"></i></button>';
                        // $button .= '<button class="btn btn-danger btn-xs" id="btn-hapus" data-id="'+$data->santri_id+'"><i class="icon-trash"></i></button>';
                        $button .= "</div>";
                        return $button;

                    }
                )
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        // return view('layouts.pages.santri.detail');
    }


    public function show($id)
    {
        $santri = Santris::where('santri_id', $id)->first();
        $wali = WaliModel::where('santri_id', $id)->first();

        $foto = Photo::where('santri_id', $id)->first();

        return view('layouts.pages.admin.detail')->with(compact('wali', 'santri', 'foto'));
    }

    public function edit($id)
    {
        $santri = Santris::where('santri_id', $id)->first();
        $wali = WaliModel::where('santri_id', $id)->first();

        $foto = Photo::where('santri_id', $id)->first();
        return view('layouts.pages.admin.edit')->with(compact('santri', 'wali', 'foto'));
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
        $santri = Santris::find($id);
        $wali = WaliModel::find($id);


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
        $wali->ayah = $request->ayah;
        $wali->ayah_nik = $request->nik_ayah;
        $wali->pekerjaan_ayah = $request->pekerjaan_ayah;
        $wali->tempat_lahir_ayah = $request->tempat_lahir_ayah;
        $wali->tgl_lahir_ayah = $request->tgl_lahir_ayah;
        $wali->pend_terakhir_id_ayah = $request->pendidikan_id_ayah;
        $wali->ibu = $request->ibu;
        $wali->nik_ibu = $request->nik_ibu;
        $wali->pekerjaan_ibu = $request->pekerjaan_ibu;
        $wali->tempat_lahir_ibu = $request->tempat_lahir_ibu;
        $wali->tgl_lahir_ibu = $request->tgl_lahir_ibu;

        $save = $santri->save();
        $save = $wali->save();



        if ($save) {
            return redirect()->route('admin')->with('success', 'Data Berhasil disimpan');
        } else {
            return redirect()->route('admin')->with('failed', 'Data Gagal disimpan');
        }

        // return redirect()->route('admin');
        // return $foto;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

       $data = DB::table('santri')->where('santri_id', $id)->delete();
       $data = DB::table('wali')->where('santri_id', $id)->delete();
       $data = DB::table('photos')->where('santri_id', $id)->delete();

       return redirect()->route('admin')->with('success', 'Foto updated successfully');
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
}
