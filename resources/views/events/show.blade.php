@extends('adminlte.layouts.app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detail Event</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('events.index') }}">Events</a></li>
              <li class="breadcrumb-item active">Detail Event</li>
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
            <div class="card" style="
                border: none;
                border-radius: 10px;
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
                overflow: hidden;
                transition: box-shadow 0.3s ease;
            ">
              <div class="card-body" style="
                  padding: 0;
                  background-color: #ffffff;
              ">
                <div class="event-image" style="
                    position: relative;
                    width: 100%;
                    height: auto;
                ">
                  @if ($event->image)
                      <img src="{{ Storage::url($event->image) }}" alt="Event Image" style="
                          width: 100%;
                          height: auto;
                          object-fit: cover;
                          display: block;
                      ">
                  @else
                      <img src="https://via.placeholder.com/800x400" alt="No Image" style="
                          width: 100%;
                          height: auto;
                          object-fit: cover;
                          display: block;
                      ">
                  @endif
                </div>
                <div class="details" style="
                    padding: 1.5rem;
                ">
                  <p><strong>Nama:</strong> {{ $event->name }}</p>
                  <p><strong>Deskripsi:</strong> {{ $event->description }}</p>
                  <p><strong>Jenis:</strong> {{ $event->event_type }}</p>
                  <p><strong>Waktu Mulai:</strong> {{ $event->start_time->format('d-m-Y H:i') }}</p>
                  <p><strong>Waktu Selesai:</strong> {{ $event->end_time->format('d-m-Y H:i') }}</p>
                  <p><strong>Status:</strong> {{ $event->status }}</p>
                </div>
              </div>
                <a href="{{ route('events.index') }}" class="btn btn-secondary" style="
                    transition: background-color 0.3s, border-color 0.3s;
                ">Back to Events List</a>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Inline CSS for additional styling -->
  <style>
    .card {
      transition: box-shadow 0.3s ease;
    }
    .card:hover {
      box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
    }
    .btn {
      transition: background-color 0.3s, border-color 0.3s, color 0.3s;
    }
    .btn-warning {
      background-color: #ffc107;
      border-color: #ffc107;
    }
    .btn-warning:hover {
      background-color: #e0a800;
      border-color: #d39e00;
    }
    .btn-danger {
      background-color: #dc3545;
      border-color: #dc3545;
    }
    .btn-danger:hover {
      background-color: #c82333;
      border-color: #bd2130;
    }
    .btn-secondary {
      background-color: #6c757d;
      border-color: #6c757d;
    }
    .btn-secondary:hover {
      background-color: #5a6268;
      border-color: #545b62;
    }
  </style>
@endsection
