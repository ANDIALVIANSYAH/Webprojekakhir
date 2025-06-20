@extends('layouts.app')

@section('title', 'Riwayat Booking')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4>Riwayat Booking</h4>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Kamar</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Total Harga</th>
                        <th>Metode Pembayaran</th>
                        <th>Status Pembayaran</th>
                        <th>Status Booking</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        <tr>
                            <td>{{ $booking->kamar->nomor_kamar }} ({{ $booking->kamar->tipe_kamar }})</td>
                            <td>{{ \Carbon\Carbon::parse($booking->tanggal_checkin)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->tanggal_checkout)->format('d/m/Y') }}</td>
                            <td>Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</td>
                            <td>{{ str_replace('_', ' ', ucfirst($booking->transaksi->metode_pembayaran)) }}</td>
                            <td>{{ ucfirst($booking->transaksi->status_pembayaran) }}</td>
                            <td>{{ ucfirst($booking->status) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection