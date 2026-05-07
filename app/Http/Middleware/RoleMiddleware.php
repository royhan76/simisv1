<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
{

    $userRole = strtolower(auth()->user()->role);

    $roles = array_map('strtolower', $roles);

    if (!in_array($userRole, $roles)) {
        abort(403, 'ANDA TIDAK MEMILIKI AKSES KE HALAMAN INI');
    }

    return $next($request);
}
}
