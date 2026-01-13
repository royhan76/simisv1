<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('layouts.login.index');
    }

    public function do_login(Request $request)
    {
        // $data = [

        //     'username'=> $request->username,
        //     'password'=> $request->password,
        // ];

        // return $data;

        $credentials = $request-> validate([
            'username'=> 'required',
            'password'=> 'required',
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('welcom');
        }

        return back()->with("loginError", 'Login Gagal, silahkan ulangi kembali');
    }

    public function logout(Request $request)
    {

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();

        return redirect('/login');
    }

    // untuk api

    // public function _invoke(Request $request)
    // {
    //     $validator = Validator::make($request->all(),
    //     [
    //         'username'     => 'required',
    //         'password'  => 'required'
    //         ]
    //     );

    //     //jika gagal validasi
    //     if ($validator->fails()) {
    //         return response()->json($validator->errors(), 422);
    //     }
    //     // jika auth gagal
    //     if(!$token = auth()->guard('api')->attempt($credentials)) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Email atau Password Anda salah'
    //         ], 401);
    //     }

    //     // jika auth sukses

    //     //if auth success
    //     return response()->json([
    //         'success' => true,
    //         'user'    => auth()->guard('api')->user(),
    //         'token'   => $token
    //     ], 200);
    // }
}
