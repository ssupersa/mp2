@extends('layouts.app')

@section('content')
    <h1>Detail Absensi</h1>

    <p><strong>Pendaftaran:</strong> {{ $absensi->pendaftaran->name }}</p>
    <p><strong>Tanggal Absen:</strong> {{ $absensi->tanggal_absen->format('d-m-Y') }}</p>
    <p><strong>Status Hadir:</strong> {{ $absensi->hadir ? 'Hadir' : 'Tidak Hadir' }}</p>
    <p><strong>Bukti Kegiatan:</strong></p>
    @if ($absensi->bukti_kegiatan)
        <a href="{{ $absensi->getBuktiKegiatanUrlAttribute() }}" target="_blank">Lihat Bukti</a>
    @else
        Tidak Ada
    @endif

    <a href="{{ route('absensi.index') }}" class="btn btn-secondary mt-3">Kembali</a>
@endsection
