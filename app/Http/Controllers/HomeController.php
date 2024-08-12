<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Pendaftaran; // Pastikan model ini ada
use App\Models\Absensi; // Pastikan model ini ada
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
     * Show the application dashboard based on the user's role.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user(); // Mendapatkan pengguna yang sedang login

        // Ambil semua data dari database
        $events = Event::all(); // Gantilah dengan query yang sesuai jika perlu
        $pendaftarans = Pendaftaran::all(); // Ambil data pendaftaran
        $absensis = Absensi::all(); // Ambil data absensi

        // Mengolah data pendaftaran untuk grafik
        $monthlyData = $pendaftarans->groupBy(function ($date) {
            return $date->created_at->format('F Y'); // Format: January 2024
        })->map(function ($month) {
            return $month->count();
        });

        $labels = $monthlyData->keys();
        $data = $monthlyData->values();

        // Periksa peran pengguna dan arahkan ke halaman yang sesuai
        if ($user->role_name === 'Admin') {
            // Kirim semua variabel ke view
            return view('Admin.home', compact('events', 'pendaftarans', 'absensis', 'labels', 'data')); // Halaman untuk Admin
        } elseif ($user->role_name === 'user') {
            // Kirim variabel events ke view
            return view('user.Home_user', compact('events')); // Halaman untuk User
        }

        // Jika peran tidak sesuai, arahkan ke halaman default atau kesalahan
        return redirect('/')->with('error', 'You do not have permission to access this page.');
    }
}
