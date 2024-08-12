@extends('adminlte.layouts.app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Laporan Kegiatan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Laporan Kegiatan</li>
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
                <h3 class="card-title">Filter Kegiatan</h3>
              </div>
              <div class="card-body">
                <!-- Form filter -->
                <form method="GET" action="{{ route('laporan-kegiatan.index') }}" class="mb-4">
                  <div class="form-group">
                    <label for="event_name">Nama Event</label>
                    <input type="text" id="event_name" name="event_name" class="form-control" value="{{ request('event_name') }}">
                  </div>
                  <button type="submit" class="btn btn-primary">Filter</button>
                </form>

                <!-- Tabel laporan kegiatan -->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Daftar Kegiatan</h3>
                  </div>
                  <div class="card-body">
                    <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Nama Event</th>
                          <th>Jumlah Peserta</th>
                          <th>Deskripsi</th>
                          <th>Peserta</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($events as $event)
                          <tr>
                            <td>{{ $event->name }}</td>
                            <td>{{ $event->jumlah_peserta }}</td>
                            <td>{{ $event->description }}</td>
                            <td>
                              <ul>
                                @foreach($event->absensi as $absensi)
                                  <li>{{ $absensi->pendaftaran->name }} ({{ $absensi->tanggal_absen->format('d-m-Y') }})</li>
                                @endforeach
                              </ul>
                            </td>
                          </tr>
                        @empty
                          <tr>
                            <td colspan="4">Tidak ada data yang ditemukan</td>
                          </tr>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
                </div>
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
