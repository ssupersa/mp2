@extends('adminlte.layouts.app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create Event</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('events.index') }}">Events</a></li>
              <li class="breadcrumb-item active">Create Event</li>
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
                <h3 class="card-title">Create New Event</h3>
              </div>
              <div class="card-body">
                <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea id="description" name="description" class="form-control" rows="4" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="event_type">Type:</label>
                        <select id="event_type" name="event_type" class="form-control" required>
                            <option value="webinar">Webinar</option>
                            <option value="bemawa">BEMAWA</option>
                            <option value="komunitas">Komunitas</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="start_time">Start Time:</label>
                        <input type="datetime-local" id="start_time" name="start_time" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="end_time">End Time:</label>
                        <input type="datetime-local" id="end_time" name="end_time" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select id="status" name="status" class="form-control" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                    <div class="form-group">
                      <label for="jenis_event">Jenis Event:</label>
                      <select id="jenis_event" name="jenis_event" class="form-control" required>
                          <option value="Online">Online</option>
                          <option value="Offline">Offline</option>
                      </select>
                  </div>
                  

                    <div class="form-group">
                        <label for="image">Image:</label>
                        <input type="file" id="image" name="image" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="organizer">Organizer:</label>
                        <input type="text" id="organizer" name="organizer" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="{{ route('events.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
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
