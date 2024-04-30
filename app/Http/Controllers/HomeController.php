<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('appointment.schedule');
    }
    protected function authenticated(Request $request, $user)
{
    if ($user->isAdmin()) {
        return redirect()->route('appointment.index'); 
    }

    return redirect()->route('appointment.schedule'); 

}
}