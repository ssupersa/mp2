<!-- resources/views/reservation/edit.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Edit Reservation</title>
</head>
<body>
    <h1>Edit Reservation</h1>
    <form action="{{ route('reservations.update', $reservation) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="event_id">Event:</label>
        <select name="event_id" id="event_id">
            @foreach ($events as $event)
                <option value="{{ $event->id }}" {{ $event->id == $reservation->event_id ? 'selected' : '' }}>{{ $event->name }}</option>
            @endforeach
        </select>
        <br>

        <label for="user_id">User:</label>
        <select name="user_id" id="user_id">
            @foreach ($users as $user)
                <option value="{{ $user->id }}" {{ $user->id == $reservation->user_id ? 'selected' : '' }}>{{ $user->name }}</option>
            @endforeach
        </select>
        <br>

        <label for="reservation_time">Reservation Time:</label>
        <input type="datetime-local" name="reservation_time" id="reservation_time" value="{{ $reservation->reservation_time->format('Y-m-d\TH:i') }}" required>
        <br>

        <label for="status">Status:</label>
        <select name="status" id="status">
            <option value="reserved" {{ $reservation->status == 'reserved' ? 'selected' : '' }}>Reserved</option>
            <option value="canceled" {{ $reservation->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
        </select>
        <br>

        <button type="submit">Update Reservation</button>
    </form>
    <a href="{{ route('reservations.index') }}">Back to Reservations List</a>
</body>
</html>
