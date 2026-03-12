<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {


        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();
// dd($user->role, $roles);
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        abort(403, 'ANDA TIDAK MEMILIKI AKSES KE HALAMAN INI');

    }
}
