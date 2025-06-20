@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4>Dashboard Admin</h4>
        </div>
        <div class="card-body">
            <p>Selamat datang, {{ Auth::user()->nama }}!</p>
            <a href="{{ route('kamar.index') }}" class="btn btn-primary me-2"><i class="fas fa-bed"></i> Kelola Kamar</a>
            <a href="{{ route('booking.index') }}" class="btn btn-primary me-2"><i class="fas fa-book"></i> Kelola Booking</a>
            <a href="{{ route('laporan.index') }}" class="btn btn-primary me-2"><i class="fas fa-chart-bar"></i> Laporan Pendapatan</a>
            <a href="{{ route('user.index') }}" class="btn btn-primary me-2"><i class="fas fa-users"></i> Kelola Pengguna</a>
            <a href="{{ route('diskon.index') }}" class="btn btn-primary me-2"><i class="fas fa-tags"></i> Kelola Diskon</a>
            <a href="{{ route('audit-log.index') }}" class="btn btn-primary"><i class="fas fa-history"></i> Audit Log</a>
        </div>
    </div>
@endsection