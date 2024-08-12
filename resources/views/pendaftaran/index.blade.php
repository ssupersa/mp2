@extends('adminlte.layouts.app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pendaftaran List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Pendaftaran</li>
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
                <h3 class="card-title">Pendaftaran List</h3>
                  <a href="{{ route('pendaftaran.create') }}" class="btn btn-primary float-right">Add New</a>

              </div>
              <div class="card-body">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Event Name</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Registration Time</th>
                      <th>Status</th>
                      <th>Ticket</th> <!-- New Column for Ticket -->
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($pendaftarans as $pendaftaran)
                      <tr>
                        <td>{{ $pendaftaran->id }}</td>
                        <td>{{ $pendaftaran->event->name }}</td>
                        <td>{{ $pendaftaran->name }}</td>
                        <td>{{ $pendaftaran->email }}</td>
                        <td>{{ $pendaftaran->phone }}</td>
                        <td>{{ $pendaftaran->registration_time }}</td>
                        <td>{{ $pendaftaran->status }}</td>
                        <td>
                          @if($pendaftaran->ticket)
                            <img src="{{ asset('storage/' . $pendaftaran->ticket) }}" alt="Ticket Image" class="img-thumbnail" style="max-width: 100px;">
                          @else
                            Harap Tunggu
                          @endif
                        </td>
                        <td>
                          <a href="{{ route('pendaftaran.show', $pendaftaran->id) }}" class="btn btn-info btn-sm">Show</a>
                          @if(Auth::user()->role_name == 'Admin')
                            
                            <a href="{{ route('pendaftaran.edit', $pendaftaran->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('pendaftaran.destroy', $pendaftaran->id) }}" method="POST" style="display:inline;">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this registration?')">Delete</button>
                            </form>
                          @endif
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
