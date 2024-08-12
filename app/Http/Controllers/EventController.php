<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'event_type' => 'required|in:webinar,bemawa,komunitas',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'status' => 'required|in:active,inactive',
            'jenis_event' => 'required|in:Online,Offline', // Validasi untuk kolom jenis_event
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi untuk kolom image
            'organizer' => 'required|string|max:255', // Validasi untuk kolom organizer
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('public/images'); // Menyimpan gambar dan mendapatkan path
        }

        Event::create([
            'name' => $request->name,
            'description' => $request->description,
            'event_type' => $request->event_type,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => $request->status,
            'jenis_event' => $request->jenis_event, // Menyimpan jenis_event
            'image' => $imagePath, // Menyimpan path gambar
            'organizer' => $request->organizer,
        ]);

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'event_type' => 'required|in:webinar,bemawa,komunitas',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'status' => 'required|in:active,inactive',
            'jenis_event' => 'required|in:Online,Offline', // Validasi untuk kolom jenis_event
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi untuk kolom image
            'organizer' => 'required|string|max:255', // Validasi untuk kolom organizer
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($event->image) {
                Storage::delete($event->image);
            }

            $image = $request->file('image');
            $imagePath = $image->store('public/images');
        } else {
            $imagePath = $event->image;
        }

        $event->update([
            'name' => $request->name,
            'description' => $request->description,
            'event_type' => $request->event_type,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => $request->status,
            'jenis_event' => $request->jenis_event, // Memperbarui jenis_event
            'image' => $imagePath,
            'organizer' => $request->organizer,
        ]);

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        // Delete image if exists
        if ($event->image) {
            Storage::delete($event->image);
        }

        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }
}
