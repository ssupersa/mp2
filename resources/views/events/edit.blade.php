@extends('adminlte.layouts.app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Event</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('events.index') }}">Events</a></li>
              <li class="breadcrumb-item active">Edit Event</li>
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
                <h3 class="card-title">Edit Event</h3>
              </div>
              <div class="card-body">
                <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ $event->name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea id="description" name="description" class="form-control" rows="4" required>{{ $event->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="event_type">Type:</label>
                        <select id="event_type" name="event_type" class="form-control" required>
                            <option value="webinar" {{ $event->event_type == 'webinar' ? 'selected' : '' }}>Webinar</option>
                            <option value="bemawa" {{ $event->event_type == 'bemawa' ? 'selected' : '' }}>BEMAWA</option>
                            <option value="komunitas" {{ $event->event_type == 'komunitas' ? 'selected' : '' }}>Komunitas</option>
                        </select>
                    </div>

                    <div class="form-group">
                      <label for="jenis_event">Jenis Event:</label>
                      <select id="jenis_event" name="jenis_event" class="form-control" required>
                          <option value="Online" {{ $event->jenis_event == 'Online' ? 'selected' : '' }}>Online</option>
                          <option value="Offline" {{ $event->jenis_event == 'Offline' ? 'selected' : '' }}>Offline</option>
                      </select>
                  </div>
                  

                    <div class="form-group">
                        <label for="start_time">Start Time:</label>
                        <input type="datetime-local" id="start_time" name="start_time" class="form-control" value="{{ $event->start_time->format('Y-m-d\TH:i') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="end_time">End Time:</label>
                        <input type="datetime-local" id="end_time" name="end_time" class="form-control" value="{{ $event->end_time->format('Y-m-d\TH:i') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select id="status" name="status" class="form-control" required>
                            <option value="active" {{ $event->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $event->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="image">Image:</label>
                        <input type="file" id="image" name="image" class="form-control">
                        @if($event->image)
                            <img src="{{ asset('storage/' . $event->image) }}" alt="Event Image" class="mt-2" style="max-width: 200px;">
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="organizer">Organizer:</label>
                        <input type="text" id="organizer" name="organizer" class="form-control" value="{{ $event->organizer }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
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
