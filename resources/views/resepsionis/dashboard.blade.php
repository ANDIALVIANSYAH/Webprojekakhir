@extends('layouts.app')

@section('title', 'Dashboard Resepsionis')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4>Dashboard Resepsionis</h4>
        </div>
        <div class="card-body">
            <p>Selamat datang, {{ Auth::user()->nama }}!</p>
            <a href="{{ route('kamar.index') }}" class="btn btn-primary me-2">Kelola Kamar</a>
            <a href="{{ route('booking.index') }}" class="btn btn-primary">Kelola Booking</a>
        </div>
    </div>
@endsection