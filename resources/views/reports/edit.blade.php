<!-- resources/views/reports/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Laporan</h1>

    <form action="{{ route('reports.update', $report) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="event_id">Kegiatan</label>
            <select name="event_id" id="event_id" class="form-control" required>
                @foreach($events as $event)
                    <option value="{{ $event->id }}" {{ $report->event_id == $event->id ? 'selected' : '' }}>{{ $event->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="report_data">Data Laporan</label>
            <textarea name="report_data" id="report_data" class="form-control" rows="5" required>{{ $report->report_data }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
