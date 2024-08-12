@extends('adminlte.layouts.app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Daftar Absensi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('absensi.index') }}">Absensi</a></li>
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
                <h3 class="card-title">Daftar Absensi</h3>
                <a href="{{ route('absensi.create') }}" class="btn btn-primary float-right">Create New Absensi</a>
              </div>
              <div class="card-body">
                <!-- Display success message if any -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Table displaying absensi -->
                <div class="table-responsive">
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Nama</th>
                        <th>Event</th>
                        <th>Tanggal Absen</th>
                        <th>Status Hadir</th>
                        <th>Bukti Kegiatan</th>
                        @if(auth()->user()->role_name == 'Admin')
                          <th>Aksi</th>
                        @endif
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($absensies as $absensi)
                        <tr>
                          <td>{{ $absensi->pendaftaran->name }}</td>
                          <td>{{ $absensi->pendaftaran->event->name }}</td>
                          <td>{{ $absensi->tanggal_absen->format('d-m-Y') }}</td>
                          <td>{{ $absensi->hadir ? 'Hadir' : 'Tidak Hadir' }}</td>
                          <td>
                            @if ($absensi->bukti_kegiatan)
                              <a href="{{ asset('storage/' . $absensi->bukti_kegiatan) }}" target="_blank">Lihat Bukti</a>
                            @else
                              Tidak Ada
                            @endif
                          </td>
                          <td>
                            @if(auth()->user()->role_name == 'Admin')
                              <a href="{{ route('absensi.edit', $absensi->id) }}" class="btn btn-warning btn-sm">Edit</a>
                              <form action="{{ route('absensi.destroy', $absensi->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                              </form>
                            @endif
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div><!-- /.table-responsive -->
                
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
