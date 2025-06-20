@extends('layouts.app')

@section('title', 'Selamat Datang')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center mb-4">
                <h1 class="display-4 fw-bold">Selamat Datang di HotelKu</h1>
                <p class="lead">Pesan kamar impian Anda dengan mudah dan cepat!</p>
                @auth
                    @if (Auth::user()->role == 'customer')
                        <a href="{{ route('booking.create') }}" class="btn btn-primary btn-lg">Pesan Sekarang</a>
                    @else
                        <a href="{{ route(Auth::user()->role . '.dashboard') }}" class="btn btn-primary btn-lg">Ke Dashboard</a>
                    @endif
                @else
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg me-2">Daftar</a>
                    <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg">Login</a>
                @endauth
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-12">
                <form method="GET" action="{{ url('/') }}" class="mb-4">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <input type="text" name="tipe_kamar" class="form-control" placeholder="Cari berdasarkan tipe kamar..." value="{{ request()->tipe_kamar }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <input type="number" name="harga_max" class="form-control" placeholder="Harga maksimal per malam..." value="{{ request()->harga_max }}">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary w-100">Cari</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-12">
                <div id="kamarCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($kamars as $kamar)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <div class="card shadow-sm border-0">
                                    @if ($kamar->gambar)
                                        <img src="{{ Storage::url($kamar->gambar) }}" class="d-block w-100" alt="{{ $kamar->tipe_kamar }}" style="height: 400px; object-fit: cover;">
                                    @else
                                        <img src="https://via.placeholder.com/800x400?text={{ $kamar->tipe_kamar }}" class="d-block w-100" alt="{{ $kamar->tipe_kamar }}" style="height: 400px;">
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold"><i class="fas fa-bed me-2"></i>{{ $kamar->tipe_kamar }}</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">{{ $kamar->nomor_kamar }}</h6>
                                        <p class="card-text text-success fw-bold"><i class="fas fa-money-bill-wave me-2"></i>Rp {{ number_format($kamar->harga_per_malam, 0, ',', '.') }} / malam</p>
                                        <p class="card-text">{{ $kamar->deskripsi ?? 'Kamar nyaman dengan fasilitas lengkap.' }}</p>
                                        @auth
                                            @if (Auth::user()->role == 'customer')
                                                <a href="{{ route('booking.create') }}" class="btn btn-primary w-100"><i class="fas fa-bookmark me-2"></i>Pesan Kamar</a>
                                            @endif
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#kamarCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#kamarCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection