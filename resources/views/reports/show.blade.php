<!-- resources/views/reports/show.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Laporan</h1>

    <div class="mb-3">
        <strong>Kegiatan:</strong> {{ $report->event->name }}
    </div>
    
    <div class="mb-3">
        <strong>Data Laporan:</strong>
        <pre>{{ $report->report_data }}</pre>
    </div>

    <a href="{{ route('reports.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
</div>
@endsection
