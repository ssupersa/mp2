<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the pendaftarans.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Check if the user is an Admin
        if (auth()->user()->role_name === 'Admin') {
            // Admin sees all registrations
            $pendaftarans = Pendaftaran::all();
        } else {
            // Non-admin users see only their own registrations
            $pendaftarans = Pendaftaran::where('email', auth()->user()->email)->get();
        }

        return view('pendaftaran.index', compact('pendaftarans'));
    }

    /**
     * Show the form for creating a new pendaftaran.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $events = Event::all(); // Mengambil semua event
        return view('pendaftaran.create', compact('events'));
    }

    /**
     * Store a newly created pendaftaran in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi inputan
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'phone' => 'required|string|max:20',
            'registration_time' => 'required|date',
        ]);

        // Set status berdasarkan role pengguna
        $status = auth()->user()->role_name === 'Admin' ? 'pending' : 'pending';

        // Membuat pendaftaran baru
        Pendaftaran::create([
            'event_id' => $request->event_id,
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'phone' => $request->phone,
            'registration_time' => Carbon::parse($request->registration_time), // Parsing ke Carbon
            'status' => $status,
            // Tiket belum diset pada saat pendaftaran dibuat
        ]);

        return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran berhasil dibuat.');
    }

    /**
     * Display the specified pendaftaran.
     *
     * @param \App\Models\Pendaftaran $pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function show(Pendaftaran $pendaftaran)
    {
        // Ensure users can only view their own registrations or Admins can view any
        if (auth()->user()->role_name !== 'Admin' && $pendaftaran->email !== auth()->user()->email) {
            abort(403, 'Unauthorized access.');
        }

        return view('pendaftaran.show', compact('pendaftaran'));
    }

    /**
     * Show the form for editing the specified pendaftaran.
     *
     * @param \App\Models\Pendaftaran $pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Pendaftaran $pendaftaran)
    {
        // Ensure users can only edit their own registrations or Admins can edit any
        if (auth()->user()->role_name !== 'Admin' && $pendaftaran->email !== auth()->user()->email) {
            abort(403, 'Unauthorized access.');
        }

        $events = Event::all(); // Assuming you have an Event model
        return view('pendaftaran.edit', compact('pendaftaran', 'events'));
    }

    /**
     * Update the specified pendaftaran in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Pendaftaran $pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pendaftaran $pendaftaran)
    {
        // Ensure users can only update their own registrations or Admins can update any
        if (auth()->user()->role_name !== 'Admin' && $pendaftaran->email !== auth()->user()->email) {
            abort(403, 'Unauthorized access.');
        }

        $request->validate([
            'event_id' => 'required|exists:events,id',
            'phone' => 'required|string|max:20',
            'registration_time' => 'required|date',
            'status' => 'nullable|in:pending,confirmed,canceled', // Status can be null for Admin
            'ticket' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validate tiket gambar
        ]);

        $data = [
            'event_id' => $request->event_id,
            'phone' => $request->phone,
            'registration_time' => Carbon::parse($request->registration_time), // Parse to Carbon
            'status' => $request->status ?? 'pending', // Default to 'pending' if null
        ];

        // Handle ticket upload if present
        if ($request->hasFile('ticket')) {
            // Upload ticket
            $file = $request->file('ticket');
            $path = $file->store('tickets', 'public'); // Store in public/tickets
            $data['ticket'] = $path;
        }

        $pendaftaran->update($data);

        return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran berhasil diperbarui.');
    }

    /**
     * Remove the specified pendaftaran from storage.
     *
     * @param \App\Models\Pendaftaran $pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pendaftaran $pendaftaran)
    {
        // Ensure users can only delete their own registrations or Admins can delete any
        if (auth()->user()->role_name !== 'Admin' && $pendaftaran->email !== auth()->user()->email) {
            abort(403, 'Unauthorized access.');
        }

        $pendaftaran->delete();

        return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran berhasil dihapus.');
    }

    /**
     * Get the list of pendaftarans for absensi.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPendaftaranListForAbsensi()
    {
        // Check if the user is an Admin
        if (auth()->user()->role_name === 'Admin') {
            // Admin sees all registrations
            $pendaftarans = Pendaftaran::all();
        } else {
            // Non-admin users see only their own registrations
            $pendaftarans = Pendaftaran::where('email', auth()->user()->email)->get();
        }

        return response()->json($pendaftarans);
    }
}
