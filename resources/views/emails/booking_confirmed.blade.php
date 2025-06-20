<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px; }
        .header { background-color: #007bff; color: white; padding: 10px; text-align: center; border-radius: 5px 5px 0 0; }
        .content { padding: 20px; }
        .footer { text-align: center; font-size: 12px; color: #777; margin-top: 20px; }
        .btn { display: inline-block; padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Konfirmasi Booking HotelKu</h2>
        </div>
        <div class="content">
            <p>Halo {{ $booking->user->nama }},</p>
            <p>Booking Anda telah dikonfirmasi! Berikut detailnya:</p>
            <ul>
                <li><strong>Kamar:</strong> {{ $booking->kamar->nomor_kamar }} ({{ $booking->kamar->tipe_kamar }})</li>
                <li><strong>Check-in:</strong> {{ \Carbon\Carbon::parse($booking->iletanggal_checkin)->format('d/m/Y') }}</li>
                <li><strong>Check-out:</strong> {{ \Carbon\Carbon::parse($booking->tanggal_checkout)->format('d/m/Y') }}</li>
                <li><strong>Total Harga:</strong> Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</li>
                <li><strong>Status Pembayaran:</strong> {{ $booking->transaksi ? ucfirst($booking->transaksi->status_pembayaran) : 'Belum Dibayar' }}</li>
            </ul>
            <p>Terima kasih telah memilih HotelKu. Jika ada pertanyaan, hubungi kami di hotelku@example.com.</p>
            <a href="{{ url('/') }}" class="btn">Kunjungi Website</a>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} HotelKu. All rights reserved.</p>
        </div>
    </div>
</body>
</html>