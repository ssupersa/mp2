<!-- resources/views/reports/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Laporan</h1>

    <form action="{{ route('reports.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="event_id">Kegiatan</label>
            <select name="event_id" id="event_id" class="form-control" required>
                @foreach($events as $event)
                    <option value="{{ $event->id }}">{{ $event->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="report_data">Data Laporan</label>
            <textarea name="report_data" id="report_data" class="form-control" rows="5" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
