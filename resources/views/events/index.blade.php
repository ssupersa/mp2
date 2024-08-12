@extends('adminlte.layouts.app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Daftar Event</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Daftar Event</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row mb-3">
          @if(auth()->user()->role_name == 'Admin')
              <a href="{{ route('events.create') }}" class="btn btn-primary">Tambah Event Baru</a>
          @endif
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success mb-3">
                {{ $message }}
            </div>
        @endif

        <div class="row">
          @foreach ($events as $event)
              <div class="col-md-6 col-lg-4 mb-4">
                  <div class="card" style="
                      border: none;
                      border-radius: 10px;
                      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
                      overflow: hidden;
                      transition: transform 0.4s ease, box-shadow 0.4s ease;
                      max-width: 100%;
                      display: flex;
                      flex-direction: column;
                  ">
                      <div class="card-img-wrapper" style="
                          width: 100%;
                          height: 200px;
                          overflow: hidden;
                      ">
                          @if ($event->image)
                              <img src="{{ Storage::url($event->image) }}" class="card-img-top" alt="Event Image" style="
                                  width: 100%;
                                  height: 100%;
                                  object-fit: cover;
                                  transition: opacity 0.4s ease;
                              ">
                          @else
                              <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="No Image" style="
                                  width: 100%;
                                  height: 100%;
                                  object-fit: cover;
                                  transition: opacity 0.4s ease;
                              ">
                          @endif
                      </div>
                      <div class="card-body" style="
                          padding: 1.5rem;
                          background: #f9f9f9;
                          flex: 1;
                          display: flex;
                          flex-direction: column;
                          justify-content: space-between;
                          transition: background 0.4s ease;
                      ">
                          <h5 class="card-title" style="
                              font-size: 1.5rem; 
                              margin-bottom: 1rem;
                              color: #333;
                          ">{{ $event->name }}</h5>
                          <p class="card-text" style="
                              margin-bottom: 0.75rem;
                              color: #555;
                          "><strong>Jenis:</strong> {{ $event->event_type }}</p>
                          <p class="card-text" style="
                              margin-bottom: 0.75rem;
                              color: #555;
                          "><strong>Jenis Event:</strong> {{ $event->jenis_event }}</p>
                          <p class="card-text" style="
                              margin-bottom: 0.75rem;
                              color: #555;
                          "><strong>Waktu Mulai:</strong> {{ $event->start_time->format('d-m-Y H:i') }}</p>
                          <p class="card-text" style="
                              margin-bottom: 0.75rem;
                              color: #555;
                          "><strong>Waktu Selesai:</strong> {{ $event->end_time->format('d-m-Y H:i') }}</p>
                          <p class="card-text" style="
                              margin-bottom: 0.75rem;
                              color: #555;
                          "><strong>Status:</strong> {{ $event->status }}</p>
                          <p class="card-text" style="
                              margin-bottom: 0.75rem;
                              color: #555;
                          "><strong>Penyelenggara:</strong> {{ $event->organizer }}</p>
                          <div style="
                              display: flex;
                              justify-content: space-between;
                              align-items: center;
                          ">
                              <a href="{{ route('events.show', $event->id) }}" class="btn btn-info" style="
                                  transition: background-color 0.3s, border-color 0.3s;
                              ">Lihat</a>
                              @if(auth()->user()->role_name == 'Admin')
                                  <a href="{{ route('events.edit', $event->id) }}" class="btn btn-warning" style="
                                      transition: background-color 0.3s, border-color 0.3s;
                                  ">Edit</a>
                                  <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="
                                      display: inline;
                                  ">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-danger" style="
                                          background-color: #dc3545;
                                          border-color: #dc3545;
                                          transition: background-color 0.3s, border-color 0.3s;
                                      " onclick="return confirm('Apakah Anda yakin ingin menghapus event ini?')">Hapus</button>
                                  </form>
                              @endif
                          </div>
                      </div>
                  </div>
              </div>
          @endforeach
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Inline CSS for animations and effects -->
  <style>
    .card {
      transition: transform 0.4s ease, box-shadow 0.4s ease, background 0.4s ease;
    }
    .card:hover {
      transform: scale(1.05);
      box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
    }
    .card-img-wrapper {
      overflow: hidden;
    }
    .card-img-top {
      transition: opacity 0.4s ease;
    }
    .card-body:hover {
      background: #eaeaea;
    }
    .btn {
      transition: background-color 0.3s, border-color 0.3s, color 0.3s;
    }
    .btn-info {
      background-color: #17a2b8;
      border-color: #17a2b8;
    }
    .btn-info:hover {
      background-color: #138496;
      border-color: #117a8b;
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
  </style>
@endsection
