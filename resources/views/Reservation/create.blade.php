@extends('adminlte.layouts.app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create Reservation</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('reservations.index') }}">Reservations</a></li>
              <li class="breadcrumb-item active">Create</li>
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
                <h3 class="card-title">Create New Reservation</h3>
              </div>
              <div class="card-body">
                <form action="{{ route('reservations.store') }}" method="POST">
                  @csrf
                  <div class="form-group">
                    <label for="event_id">Event:</label>
                    <select name="event_id" id="event_id" class="form-control" required>
                      @foreach ($events as $event)
                        <option value="{{ $event->id }}">{{ $event->name }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="user_id">User:</label>
                    <select name="user_id" id="user_id" class="form-control" required>
                      @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="reservation_time">Reservation Time:</label>
                    <input type="datetime-local" name="reservation_time" id="reservation_time" class="form-control" required>
                  </div>

                  <div class="form-group">
                    <label for="status">Status:</label>
                    <select name="status" id="status" class="form-control" required>
                      <option value="reserved">Reserved</option>
                      <option value="canceled">Canceled</option>
                    </select>
                  </div>

                  <button type="submit" class="btn btn-primary">Create Reservation</button>
                </form>
                <a href="{{ route('reservations.index') }}" class="btn btn-secondary mt-2">Back to Reservations List</a>
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
