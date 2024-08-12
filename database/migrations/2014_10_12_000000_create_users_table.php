<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // Mendapatkan pengguna yang sedang login
        $user = Auth::user();

        // Memeriksa role_name pengguna
        if ($user->role_name === 'Admin') {
            // Arahkan ke halaman Admin
            return view('Admin.home');
        } elseif ($user->role_name === 'user') {
            // Arahkan ke halaman user
            return view('user.Home_user');
        }

        // Jika role_name tidak dikenali, arahkan ke halaman default atau error
        return abort(403, 'Unauthorized action.');
    }
}
