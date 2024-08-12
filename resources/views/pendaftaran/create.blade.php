@extends('adminlte.layouts.app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create New Pendaftaran</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('pendaftaran.index') }}">Pendaftaran</a></li>
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
                <h3 class="card-title">Form Create New Pendaftaran</h3>
              </div>
              <div class="card-body">
                <form action="{{ route('pendaftaran.store') }}" method="POST">
                  @csrf

                  <div class="form-group">
                    <label for="event_id">Event</label>
                    <select id="event_id" name="event_id" class="form-control">
                      @foreach($events as $event)
                        <option value="{{ $event->id }}">{{ $event->name }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ auth()->user()->name }}" required>
                  </div>

                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ auth()->user()->email }}" required>
                  </div>

                  <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" id="phone" name="phone" class="form-control" required>
                  </div>

                  <div class="form-group">
                    <label for="registration_time">Registration Time</label>
                    <input type="datetime-local" id="registration_time" name="registration_time" class="form-control" required>
                  </div>

                  <button type="submit" class="btn btn-primary">Save</button>
                  <a href="{{ route('pendaftaran.index') }}" class="btn btn-secondary">Back</a>
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
