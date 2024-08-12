@extends('adminlte.layouts.app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Reservations</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('reservations.index') }}">Reservations</a></li>
              <li class="breadcrumb-item active">List</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Reservations List</h3>
                <a href="{{ route('reservations.create') }}" class="btn btn-primary float-right">Create New Reservation</a>
              </div>
              <div class="card-body">
                @if (session('success'))
                  <div class="alert alert-success">
                    {{ session('success') }}
                  </div>
                @endif
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Event</th>
                      <th>User</th>
                      <th>Reservation Time</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($reservations as $reservation)
                      <tr>
                        <td>{{ $reservation->id }}</td>
                        <td>{{ $reservation->event->name }}</td>
                        <td>{{ $reservation->user->name }}</td>
                        <td>{{ $reservation->reservation_time }}</td>
                        <td>{{ $reservation->status }}</td>
                        <td>
                          <a href="{{ route('reservations.show', $reservation) }}" class="btn btn-info btn-sm">View</a>
                          <a href="{{ route('reservations.edit', $reservation) }}" class="btn btn-warning btn-sm">Edit</a>
                          <form action="{{ route('reservations.destroy', $reservation) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this reservation?')">Delete</button>
                          </form>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
