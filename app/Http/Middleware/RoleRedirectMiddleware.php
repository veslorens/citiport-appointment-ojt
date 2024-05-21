<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleRedirectMiddleware
{
    public function handle(Request $request, Closure $next, $role)
{
    $user = Auth::user();

    if ($user && $user->role === $role) {
        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($role === 'superadmin') {
            return redirect()->route('superadmin.users.index');
        }
    }

    return $next($request);
}
}