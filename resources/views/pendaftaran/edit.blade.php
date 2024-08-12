@extends('adminlte.layouts.app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Pendaftaran</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('pendaftaran.index') }}">Pendaftaran</a></li>
              <li class="breadcrumb-item active">Edit</li>
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
                <h3 class="card-title">Edit Pendaftaran Details</h3>
              </div>
              <div class="card-body">
                <form action="{{ route('pendaftaran.update', $pendaftaran->id) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')

                  <div class="form-group">
                    <label for="event_id">Event</label>
                    <select id="event_id" name="event_id" class="form-control" required>
                      @foreach($events as $event)
                        <option value="{{ $event->id }}" {{ $pendaftaran->event_id == $event->id ? 'selected' : '' }}>
                          {{ $event->name }}
                        </option>
                      @endforeach
                    </select>
                  </div>

                  <!-- Assuming 'name' and 'email' are not editable -->
                  <!-- <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $pendaftaran->name }}" required readonly>
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ $pendaftaran->email }}" required readonly>
                  </div> -->

                  <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" id="phone" name="phone" class="form-control" value="{{ $pendaftaran->phone }}" required>
                  </div>

                  <div class="form-group">
                    <label for="registration_time">Registration Time</label>
                    @php
                      // Convert to Carbon instance if needed
                      $registrationTime = $pendaftaran->registration_time;
                      if (!($registrationTime instanceof \Carbon\Carbon)) {
                        $registrationTime = \Carbon\Carbon::parse($registrationTime);
                      }
                      $formattedTime = $registrationTime->format('Y-m-d\TH:i');
                    @endphp
                    <input type="datetime-local" id="registration_time" name="registration_time" class="form-control" value="{{ $formattedTime }}" required>
                  </div>
                  
                  <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status" class="form-control" required>
                      <option value="pending" {{ $pendaftaran->status == 'pending' ? 'selected' : '' }}>Pending</option>
                      <option value="confirmed" {{ $pendaftaran->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                      <option value="canceled" {{ $pendaftaran->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="ticket">Ticket</label>
                    @if($pendaftaran->ticket)
                      <div class="mb-2">
                        <img src="{{ asset('storage/' . $pendaftaran->ticket) }}" alt="Ticket Image" class="img-thumbnail" style="max-width: 200px;">
                      </div>
                    @endif
                    <input type="file" id="ticket" name="ticket" class="form-control">
                    <small class="form-text text-muted">Upload a new ticket image if you want to replace the current one.</small>
                  </div>

                  <button type="submit" class="btn btn-primary">Update</button>
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
