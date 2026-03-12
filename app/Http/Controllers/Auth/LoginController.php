<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
       return view('layouts.login.index');
    }
    public function login(Request $request)
{
    $input = $request->all();

    $this->validate($request, [
        'username' => 'required',
        'password' => 'required',
    ]);

    if(auth()->attempt([
        'username' => $input['username'],
        'password' => $input['password']
    ]))
    {

        $user = auth()->user();

        if ($user->role == 'admin') {
            return redirect('/admin');
        }

        if ($user->role == 'sekretaris') {
            return redirect('/sekretaris');
        }

        if ($user->role == 'bendahara') {
            return redirect('/bendahara');
        }

        if ($user->role == 'maarif') {
            return redirect('/maarif');
        }

        if ($user->role == 'keamanan') {
            return redirect('/keamanan');
        }

        if ($user->role == 'wali') {
            return redirect('/wali');
        }

        return redirect('/santri');

    }else{
        return redirect()->route('loginn')
            ->with('error','username And Password Are Wrong.');
    }
}
}

