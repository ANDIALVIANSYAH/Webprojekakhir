@extends('layouts.app')

@section('title', 'Dashboard Customer')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4>Dashboard Customer</h4>
        </div>
        <div class="card-body">
            <p>Selamat datang, {{ Auth::user()->nama }}!</p>
            <a href="{{ route('booking.create') }}" class="btn btn-primary me-2">Buat Booking</a>
            <a href="{{ route('booking.riwayat') }}" class="btn btn-primary">Riwayat Booking</a>
        </div>
    </div>
@endsection