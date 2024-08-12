@extends('adminlte.layouts.app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Absensi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('absensi.index') }}">Absensi</a></li>
              <li class="breadcrumb-item active">Tambah</li>
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
                <h3 class="card-title">Form Tambah Absensi</h3>
              </div>
              <div class="card-body">
                <form action="{{ route('absensi.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf

                  <div class="form-group">
                    <label for="pendaftaran_id">Pendaftaran</label>
                    <select id="pendaftaran_id" name="pendaftaran_id" class="form-control">
                      <option value="">Pilih Pendaftaran</option>
                      @foreach ($pendaftarans as $pendaftaran)
                        <option value="{{ $pendaftaran->id }}" data-event="{{ $pendaftaran->event->name }}">
                          {{ $pendaftaran->name }} - {{ $pendaftaran->event->name }}
                        </option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="event_name">Nama Event</label>
                    <input type="text" id="event_name" class="form-control" readonly>
                  </div>

                  <div class="form-group">
                    <label for="tanggal_absen">Tanggal Absen</label>
                    <input type="date" id="tanggal_absen" name="tanggal_absen" class="form-control" required>
                  </div>

                  <div class="form-group">
                    <label for="hadir">Hadir</label>
                    <select id="hadir" name="hadir" class="form-control" required>
                      <option value="1">Hadir</option>
                      <option value="0">Tidak Hadir</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="bukti_kegiatan">Bukti Kegiatan</label>
                    <input type="file" id="bukti_kegiatan" name="bukti_kegiatan" class="form-control">
                  </div>

                  <button type="submit" class="btn btn-primary">Simpan</button>
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

  <script>
    document.addEventListener('DOMContentLoaded', function () {
        const pendaftaranSelect = document.getElementById('pendaftaran_id');
        const eventNameInput = document.getElementById('event_name');

        pendaftaranSelect.addEventListener('change', function () {
            const selectedOption = pendaftaranSelect.options[pendaftaranSelect.selectedIndex];
            const eventName = selectedOption.getAttribute('data-event');
            eventNameInput.value = eventName || '';
        });

        // Trigger change event if there is a pre-selected option
        if (pendaftaranSelect.value) {
            pendaftaranSelect.dispatchEvent(new Event('change'));
        }
    });
  </script>
@endsection
