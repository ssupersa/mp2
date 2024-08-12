@extends('layouts.app') <!-- Assuming you have a base layout named 'app' -->

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-md-12">
            <h1>Detail Pendaftaran</h1>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h2>{{ $pendaftaran->event->name }}</h2> <!-- Displaying event name -->
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Nama:</dt>
                <dd class="col-sm-9">{{ $pendaftaran->name }}</dd>

                <dt class="col-sm-3">Email:</dt>
                <dd class="col-sm-9">{{ $pendaftaran->email }}</dd>

                <dt class="col-sm-3">Telepon:</dt>
                <dd class="col-sm-9">{{ $pendaftaran->phone }}</dd>

                <dt class="col-sm-3">Waktu Pendaftaran:</dt>
                <dd class="col-sm-9">{{ $pendaftaran->registration_time }}</dd>

                <dt class="col-sm-3">Status:</dt>
                <dd class="col-sm-9">{{ ucfirst($pendaftaran->status) }}</dd>

                @if ($pendaftaran->ticket)
                    <dt class="col-sm-3">Tiket:</dt>
                    <dd class="col-sm-9">
                        <img src="{{ asset('storage/' . $pendaftaran->ticket) }}" alt="Ticket" class="img-fluid" />
                    </dd>
                @endif
            </dl>
        </div>
        <div class="card-footer">
            <a href="{{ route('pendaftaran.index') }}" class="btn btn-primary">Kembali ke Daftar Pendaftaran</a>
        </div>
    </div>
</div>
@endsection
