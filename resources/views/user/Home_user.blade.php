@extends('adminlte.layouts.app')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="container mt-4">
      <div class="row">
          <!-- About Us Card -->
          <div class="col-md-12 mb-4">
              <div class="card shadow-lg" style="border-radius: 15px; overflow: hidden; background: linear-gradient(135deg, #f8f9fa, #e2e6ea); transition: transform 0.3s, box-shadow 0.3s;">
                  <div class="card-header" style="background-color: #007bff; color: #ffffff; display: flex; align-items: center; padding: 1rem 1.5rem;">
                      <i class="fas fa-info-circle fa-2x" style="color: #ffffff; margin-right: 1rem;"></i>
                      <h3 class="card-title mb-0">Tentang Kami</h3>
                  </div>
                  <div class="card-body" style="padding: 1.5rem;">
                      <p style="color: #6c757d;">Event Stmik Bandung adalah platform yang berfokus pada pengembangan dan pengorganisasian acara-acara yang berbasis teknologi. Kami berkomitmen untuk memberikan pengalaman yang unik dan berkesan bagi para peserta.</p>
                      <a href="#" class="btn btn-primary mt-3" style="border-radius: 20px; transition: background-color 0.3s, border-color 0.3s; background-color: #007bff; border-color: #007bff; color: #ffffff; text-decoration: none; padding: 0.5rem 1rem;">Selengkapnya</a>
                  </div>
              </div>
          </div>
      </div>
  
      <div class="row">
          <!-- Latest Events Card -->
          <div class="col-md-6 mb-4">
              <div class="card shadow-lg" style="border-radius: 15px; overflow: hidden; background: linear-gradient(135deg, #e2e6ea, #f8f9fa); transition: transform 0.3s, box-shadow 0.3s;">
                  <div class="card-header" style="background-color: #28a745; color: #ffffff; display: flex; align-items: center; padding: 1rem 1.5rem;">
                      <i class="fas fa-calendar-alt fa-2x" style="color: #ffffff; margin-right: 1rem;"></i>
                      <h3 class="card-title mb-0">Event Terbaru</h3>
                  </div>
                  <div class="card-body">
                      <ul class="list-group">
                          @foreach($events as $event)
                              <li class="list-group-item d-flex justify-content-between align-items-center" style="border-radius: 10px; transition: background-color 0.3s;">
                                  {{ $event->name }}
                                  <a href="#" class="btn btn-info btn-sm" style="border-radius: 15px; transition: background-color 0.3s;">Detail</a>
                              </li>
                          @endforeach
                      </ul>
                  </div>
              </div>
          </div>
  
          <!-- Latest News Card -->
          <div class="col-md-6 mb-4">
              <div class="card shadow-lg" style="border-radius: 15px; overflow: hidden; background: linear-gradient(135deg, #f8f9fa, #e2e6ea); transition: transform 0.3s, box-shadow 0.3s;">
                  <div class="card-header" style="background-color: #dc3545; color: #ffffff; display: flex; align-items: center; padding: 1rem 1.5rem;">
                      <i class="fas fa-newspaper fa-2x" style="color: #ffffff; margin-right: 1rem;"></i>
                      <h3 class="card-title mb-0">Berita Terkini</h3>
                  </div>
                  <div class="card-body">
                      <ul class="list-group">
                          {{-- @foreach($news as $new)
                              <li class="list-group-item d-flex justify-content-between align-items-center" style="border-radius: 10px; transition: background-color 0.3s;">
                                  {{ $new->title }}
                                  <a href="#" class="btn btn-info btn-sm" style="border-radius: 15px; transition: background-color 0.3s;">Detail</a>
                              </li>
                          @endforeach --}}
                          <li class="list-group-item text-muted" style="border-radius: 10px;">Belum ada berita terbaru.</li>
                      </ul>
                  </div>
              </div>
          </div>
      </div>

      <div class="row">
          <!-- Featured Content Card 1 -->
          <div class="col-md-6 mb-4">
              <div class="card shadow-lg" style="border-radius: 15px; overflow: hidden; background: linear-gradient(135deg, #f8f9fa, #e2e6ea); transition: transform 0.3s, box-shadow 0.3s;">
                  <div class="card-header" style="background-color: #007bff; color: #ffffff; display: flex; align-items: center; padding: 1rem 1.5rem;">
                      <i class="fas fa-star fa-2x" style="color: #ffffff; margin-right: 1rem;"></i>
                      <h3 class="card-title mb-0">Konten Menarik</h3>
                  </div>
                  <div class="card-body" style="padding: 1.5rem;">
                      <p style="color: #6c757d;">Temukan berbagai konten menarik dan bermanfaat di sini. Dari berita terbaru hingga tips dan trik yang berguna untuk meningkatkan pengetahuan dan keterampilan Anda.</p>
                      <a href="#" class="btn btn-primary btn-sm" style="border-radius: 20px; transition: background-color 0.3s, border-color 0.3s; background-color: #007bff; border-color: #007bff; color: #ffffff; text-decoration: none; padding: 0.5rem 1rem;">Lihat Selengkapnya</a>
                  </div>
              </div>
          </div>    

          <!-- Featured Content Card 2 -->
          <div class="col-md-6 mb-4">
              <div class="card shadow-lg" style="border-radius: 15px; overflow: hidden; background: linear-gradient(135deg, #e2e6ea, #f8f9fa); transition: transform 0.3s, box-shadow 0.3s;">
                  <div class="card-header" style="background-color: #007bff; color: #ffffff; display: flex; align-items: center; padding: 1rem 1.5rem;">
                      <i class="fas fa-lightbulb fa-2x" style="color: #ffffff; margin-right: 1rem;"></i>
                      <h3 class="card-title mb-0">Konten Menarik</h3>
                  </div>
                  <div class="card-body" style="padding: 1.5rem;">
                      <p style="color: #6c757d;">Temukan berbagai konten menarik dan bermanfaat di sini. Dari berita terbaru hingga tips dan trik yang berguna untuk meningkatkan pengetahuan dan keterampilan Anda.</p>
                      <a href="#" class="btn btn-primary btn-sm" style="border-radius: 20px; transition: background-color 0.3s, border-color 0.3s; background-color: #007bff; border-color: #007bff; color: #ffffff; text-decoration: none; padding: 0.5rem 1rem;">Lihat Selengkapnya</a>
                  </div>
              </div>
          </div>
      </div>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
