@extends('layouts.app')

@section('title', 'Laporan Pendapatan')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4>Laporan Pendapatan</h4>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('laporan.index') }}" class="mb-4">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" value="{{ $tanggal_mulai }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" value="{{ $tanggal_selesai }}">
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
            <div class="alert alert-info">
                Total Pendapatan: Rp {{ number_format($total_pendapatan, 0, ',', '.') }}
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Pelanggan</th>
                        <th>Kamar</th>
                        <th>Tanggal Check-in</th>
                        <th>Tanggal Check-out</th>
                        <th>Total Harga</th>
                        <th>Status Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        <tr>
                            <td>{{ $booking->user->nama }}</td>
                            <td>{{ $booking->kamar->nomor_kamar }} ({{ $booking->kamar->tipe_kamar }})</td>
                            <td>{{ \Carbon\Carbon::parse($booking->tanggal_checkin)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->tanggal_checkout)->format('d/m/Y') }}</td>
                            <td>Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</td>
                            <td>{{ $booking->transaksi ? ucfirst($booking->transaksi->status_pembayaran) : 'Belum Dibayar' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection