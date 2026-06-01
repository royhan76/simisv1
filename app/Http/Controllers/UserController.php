<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{

public function index(Request $request)
{

    if ($request->ajax()) {

        $data = User::latest()->get();

        return DataTables::of($data)

            ->addIndexColumn()

            ->addColumn('action', function ($row) {

                $edit = '
                <button data-id="'.$row->id.'"
                class="btn btn-warning btn-sm btn-edit">
                <i class="fa fa-edit"></i>
                </button>
                ';

                $hapus = '';

                if($row->id != auth()->id()){

                $hapus = '
                <button data-id="'.$row->id.'"
                class="btn btn-danger btn-sm btn-hapus">
                <i class="fa fa-trash"></i>
                </button>
                ';

                }

                return $edit.$hapus;

            })

            ->rawColumns(['action'])

            ->make(true);
    }

    return view('admin.users.index');

}

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
{

    $request->validate([
        'name' => 'required',
        'username' => 'required|unique:users',
        'password' => 'required',
        'role' => 'required'
    ]);

    User::create([

        'name'=>$request->name,
        'username'=>$request->username,
        'role'=>$request->role,
        'status'=>$request->status,
        'password'=>bcrypt($request->password)

    ]);

    return response()->json([
        'message' => 'Pengguna berhasil ditambahkan'
    ]);

}

    public function edit($id)
    {
        $user=User::find($id);

        return response()->json($user);
    }
    public function update(Request $request)
    {

        $user=User::find($request->id);

        $user->update([

        'name'=>$request->name,
        'username'=>$request->username,
        'role'=>$request->role,
        'status'=>$request->status,
        'password'=>bcrypt($request->password)

        ]);

        return response()->json([
            'message'=>'Pengguna berhasil diupdate'
        ]);

    }
    public function destroy($id)
    {

        if ($id == auth()->id()) {

        return response()->json([
            'message' => 'Tidak bisa menghapus akun sendiri'
        ], 422);

    }

    User::destroy($id);

    return response()->json([
        'message' => 'Pengguna berhasil dihapus'
    ]);
    }
}
