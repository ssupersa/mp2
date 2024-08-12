@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Absensi</h1>

    <form action="{{ route('absensi.update', $absensi->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="pendaftaran_id">Pendaftaran</label>
            <select id="pendaftaran_id" name="pendaftaran_id" class="form-control">
                @foreach ($pendaftarans as $pendaftaran)
                    <option value="{{ $pendaftaran->id }}" data-event="{{ $pendaftaran->event->name }}" {{ $absensi->pendaftaran_id == $pendaftaran->id ? 'selected' : '' }}>
                        {{ $pendaftaran->name }} - {{ $pendaftaran->event->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="event_name">Nama Event</label>
            <input type="text" id="event_name" class="form-control" readonly value="{{ $absensi->pendaftaran->event->name }}">
        </div>

        <!-- Other form fields remain the same -->

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const pendaftaranSelect = document.getElementById('pendaftaran_id');
    const eventNameInput = document.getElementById('event_name');

    pendaftaranSelect.addEventListener('change', function () {
        const selectedOption = pendaftaranSelect.options[pendaftaranSelect.selectedIndex];
        const eventName = selectedOption.getAttribute('data-event');
        eventNameInput.value = eventName || '';
    });

    // Trigger change event if there is a pre-selected option
    if (pendaftaranSelect.value) {
        pendaftaranSelect.dispatchEvent(new Event('change'));
    }
});
</script>
@endsection
