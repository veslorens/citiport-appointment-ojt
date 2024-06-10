<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected function redirectTo()
    {
        if (auth()->user()->isAdmin()) {
            return route('appointment.index');
        } elseif (auth()->user()->isSuperAdmin()) {
            return route('appointment.index');
        } else {
            return '/'; 
        }
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');

        $this->middleware(function ($request, $next) {
            $response = $next($request);
            $response->header('Cache-Control', 'no-cache, no-store, must-revalidate');
            $response->header('Pragma', 'no-cache');
            $response->header('Expires', '0');
            return $response;
        });
    }

    public function logout(Request $request): RedirectResponse
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

      
        return redirect()->route('login');
    }

    public function username()
    {
        return 'email_or_name';
    }

    protected function credentials(Request $request)
    {
        $login = $request->input($this->username());
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        return [$field => $login, 'password' => $request->password];
    }
}
