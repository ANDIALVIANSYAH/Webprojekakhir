@extends('layouts.app')

@section('title', 'Daftar Booking')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4>Daftar Booking</h4>
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
                        <th>Pelanggan</th>
                        <th>Kamar</th>
                        <th>Tanggal Check-in</th>
                        <th>Tanggal Check-out</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Metode Pembayaran</th>
                        <th>Bukti Transfer</th>
                        <th>Aksi</th>
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
                            <td>
                                <form action="{{ route('booking.update', $booking) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="form-select" onchange="this.form.submit()">
                                        <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="dikonfirmasi" {{ $booking->status == 'dikonfirmasi' ? 'selected' : '' }}>Dikonfirmasi</option>
                                        <option value="selesai" {{ $booking->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                        <option value="dibatalkan" {{ $booking->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                @if ($booking->checkin_at)
                                    {{ \Carbon\Carbon::parse($booking->checkin_at)->format('d/m/Y H:i') }}
                                @elseif ($booking->status == 'dikonfirmasi')
                                    <form action="{{ route('booking.checkin', $booking) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-sign-in-alt"></i> Check-in</button>
                                    </form>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if ($booking->checkout_at)
                                    {{ \Carbon\Carbon::parse($booking->checkout_at)->format('d/m/Y H:i') }}
                                @elseif ($booking->checkin_at)
                                    <form action="{{ route('booking.checkout', $booking) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-sign-out-alt"></i> Check-out</button>
                                    </form>
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ ucfirst(str_replace('_', ' ', $booking->transaksi->metode_pembayaran)) }}</td>
                            <td>
                                @if ($booking->transaksi->bukti_transfer)
                                    <a href="{{ Storage::url($booking->transaksi->bukti_transfer) }}" target="_blank">
                                        <img src="{{ Storage::url($booking->transaksi->bukti_transfer) }}" alt="Bukti Transfer" style="max-width: 100px;">
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('booking.destroy', $booking) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus booking ini?')"><i class="fas fa-trash"></i> Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection