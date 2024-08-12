<?php
// app/Http/Controllers/LaporanKegiatanController.php
// app/Http/Controllers/LaporanKegiatanController.php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class LaporanKegiatanController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::query();

        // Filter berdasarkan nama event jika ada
        if ($request->filled('event_name')) {
            $query->where('name', 'like', '%' . $request->input('event_name') . '%');
        }

        $events = $query->withCount(['absensi as jumlah_peserta' => function ($query) {
            $query->where('hadir', true);
        }])
            ->with(['absensi' => function ($query) {
                $query->where('hadir', true)->select('pendaftaran_id', 'tanggal_absen');
            }])
            ->get();

        return view('laporan_kegiatan.index', compact('events'));
    }
}
