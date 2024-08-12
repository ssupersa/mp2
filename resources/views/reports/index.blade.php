<!-- resources/views/reports/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Laporan</h1>
    <a href="{{ route('reports.create') }}" class="btn btn-primary mb-3">Tambah Laporan</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Kegiatan</th>
                <th>Data Laporan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $report)
                <tr>
                    <td>{{ $report->id }}</td>
                    <td>{{ $report->event->name }}</td>
                    <td>{{ $report->report_data }}</td>
                    <td>
                        <a href="{{ route('reports.show', $report) }}" class="btn btn-info btn-sm">Lihat</a>
                        <a href="{{ route('reports.edit', $report) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('reports.destroy', $report) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
