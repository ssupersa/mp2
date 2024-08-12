<!-- resources/views/reservation/show.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Show Reservation</title>
</head>
<body>
    <h1>Reservation Details</h1>
    <p><strong>ID:</strong> {{ $reservation->id }}</p>
    <p><strong>Event:</strong> {{ $reservation->event->name }}</p>
    <p><strong>User:</strong> {{ $reservation->user->name }}</p>
    <p><strong>Reservation Time:</strong> {{ $reservation->reservation_time }}</p>
    <p><strong>Status:</strong> {{ $reservation->status }}</p>

    <a href="{{ route('reservations.index') }}">Back to Reservations List</a>
    <a href="{{ route('reservations.edit', $reservation) }}">Edit</a>
    <form action="{{ route('reservations.destroy', $reservation) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
</body>
</html>
