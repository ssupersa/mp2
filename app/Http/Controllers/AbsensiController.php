<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Event;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the absensis.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Check if the logged-in user is an Admin
        if (auth()->user()->role_name === 'Admin') {
            // If Admin, retrieve all absensi data
            $absensies = Absensi::with('pendaftaran.event')->get();
        } else {
            // If not Admin, retrieve absensi data related to the logged-in user
            $absensies = Absensi::whereHas('pendaftaran', function ($query) {
                $query->where('email', auth()->user()->email);
            })->with('pendaftaran.event')->get();
        }

        return view('absensi.index', compact('absensies'));
    }

    /**
     * Show the form for creating a new absensi.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Check if the logged-in user is an Admin
        if (auth()->user()->role_name === 'Admin') {
            // If Admin, retrieve all pendaftarans
            $pendaftarans = Pendaftaran::all();
        } else {
            // If not Admin, retrieve pendaftarans related to the logged-in user
            $pendaftarans = Pendaftaran::where('email', auth()->user()->email)->get();
        }

        // Get all events
        $events = Event::all();

        return view('absensi.create', compact('pendaftarans', 'events'));
    }

    /**
     * Store a newly created absensi in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'pendaftaran_id' => 'required|exists:pendaftarans,id',
            'tanggal_absen' => 'required|date',
            'hadir' => 'required|boolean',
            'bukti_kegiatan' => 'nullable|file|mimes:jpeg,png,pdf|max:2048',
        ]);

        // Handle file upload if present
        $buktiKegiatanPath = null;
        if ($request->hasFile('bukti_kegiatan')) {
            $buktiKegiatanPath = $request->file('bukti_kegiatan')->store('bukti_kegiatan', 'public');
        }

        // Create a new absensi record
        Absensi::create([
            'pendaftaran_id' => $request->pendaftaran_id,
            'tanggal_absen' => Carbon::parse($request->tanggal_absen),
            'hadir' => $request->hadir,
            'bukti_kegiatan' => $buktiKegiatanPath,
        ]);

        return redirect()->route('absensi.index')->with('success', 'Absensi berhasil dibuat.');
    }

    /**
     * Display the specified absensi.
     *
     * @param \App\Models\Absensi $absensi
     * @return \Illuminate\Http\Response
     */
    public function show(Absensi $absensi)
    {
        // No access restrictions, all users can view any absensi
        return view('absensi.show', compact('absensi'));
    }

    /**
     * Show the form for editing the specified absensi.
     *
     * @param \App\Models\Absensi $absensi
     * @return \Illuminate\Http\Response
     */
    public function edit(Absensi $absensi)
    {
        // Check if the logged-in user is an Admin
        if (auth()->user()->role_name !== 'Admin') {
            // Ensure users can only edit their own absensi
            if ($absensi->pendaftaran->email !== auth()->user()->email) {
                abort(403, 'Unauthorized access.');
            }
        }

        $events = Event::all(); // Or filter if necessary
        $pendaftarans = Pendaftaran::all(); // Admin can see all pendaftarans

        return view('absensi.edit', compact('absensi', 'events', 'pendaftarans'));
    }

    /**
     * Update the specified absensi in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Absensi $absensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absensi $absensi)
    {
        // Check if the logged-in user is an Admin
        if (auth()->user()->role_name !== 'Admin') {
            // Ensure users can only update their own absensi
            if ($absensi->pendaftaran->email !== auth()->user()->email) {
                abort(403, 'Unauthorized access.');
            }
        }

        // Validate the request
        $request->validate([
            'pendaftaran_id' => 'required|exists:pendaftarans,id',
            'tanggal_absen' => 'required|date',
            'hadir' => 'required|boolean',
            'bukti_kegiatan' => 'nullable|file|mimes:jpeg,png,pdf|max:2048',
        ]);

        // Handle file upload if present
        $buktiKegiatanPath = $absensi->bukti_kegiatan;
        if ($request->hasFile('bukti_kegiatan')) {
            // Delete the old file if exists
            if ($buktiKegiatanPath && Storage::disk('public')->exists($buktiKegiatanPath)) {
                Storage::disk('public')->delete($buktiKegiatanPath);
            }
            $buktiKegiatanPath = $request->file('bukti_kegiatan')->store('bukti_kegiatan', 'public');
        }

        // Update the absensi record
        $absensi->update([
            'pendaftaran_id' => $request->pendaftaran_id,
            'tanggal_absen' => Carbon::parse($request->tanggal_absen),
            'hadir' => $request->hadir,
            'bukti_kegiatan' => $buktiKegiatanPath,
        ]);

        return redirect()->route('absensi.index')->with('success', 'Absensi berhasil diperbarui.');
    }

    /**
     * Remove the specified absensi from storage.
     *
     * @param \App\Models\Absensi $absensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absensi $absensi)
    {
        // Check if the logged-in user is an Admin
        if (auth()->user()->role_name !== 'Admin') {
            // Ensure users can only delete their own absensi
            if ($absensi->pendaftaran->email !== auth()->user()->email) {
                abort(403, 'Unauthorized access.');
            }
        }

        // Delete the file if exists
        if ($absensi->bukti_kegiatan && Storage::disk('public')->exists($absensi->bukti_kegiatan)) {
            Storage::disk('public')->delete($absensi->bukti_kegiatan);
        }

        $absensi->delete();

        return redirect()->route('absensi.index')->with('success', 'Absensi berhasil dihapus.');
    }
}
