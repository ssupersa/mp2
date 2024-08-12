<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Event; // Pastikan Anda mengimpor model Event
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Menampilkan daftar laporan.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = Report::with('event')->get();
        return view('reports.index', compact('reports'));
    }

    /**
     * Menampilkan form untuk membuat laporan baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $events = Event::all(); // Ambil semua data kegiatan
        return view('reports.create', compact('events')); // Kirim data kegiatan ke view
    }

    /**
     * Menyimpan laporan baru ke dalam database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'report_data' => 'required|string',
        ]);

        Report::create([
            'event_id' => $request->event_id,
            'report_data' => $request->report_data,
        ]);

        return redirect()->route('reports.index')->with('success', 'Laporan berhasil dibuat.');
    }

    /**
     * Menampilkan laporan tertentu.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        return view('reports.show', compact('report'));
    }

    /**
     * Menampilkan form untuk mengedit laporan tertentu.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        $events = Event::all(); // Ambil semua data kegiatan
        return view('reports.edit', compact('report', 'events')); // Kirim data kegiatan dan laporan ke view
    }

    /**
     * Memperbarui laporan tertentu di database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'report_data' => 'required|string',
        ]);

        $report->update([
            'event_id' => $request->event_id,
            'report_data' => $request->report_data,
        ]);

        return redirect()->route('reports.index')->with('success', 'Laporan berhasil diperbarui.');
    }

    /**
     * Menghapus laporan tertentu dari database.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        $report->delete();
        return redirect()->route('reports.index')->with('success', 'Laporan berhasil dihapus.');
    }
}
