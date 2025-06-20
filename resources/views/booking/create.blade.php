@extends('layouts.app')

@section('title', 'Buat Booking')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4>Buat Booking Kamar</h4>
        </div>
        <div class="card-body">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="kamar_id" class="form-label">Pilih Kamar</label>
                    <select name="kamar_id" id="kamar_id" class="form-select @error('kamar_id') is-invalid @enderror">
                        <option value="">-- Pilih Kamar --</option>
                        @foreach ($kamars as $kamar)
                            <option value="{{ $kamar->id }}">{{ $kamar->nomor_kamar }} - {{ $kamar->tipe_kamar }} (Rp {{ number_format($kamar->harga_per_malam, 0, ',', '.') }}/malam)</option>
                        @endforeach
                    </select>
                    @error('kamar_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tanggal_checkin" class="form-label">Tanggal Check-in</label>
                    <input type="date" name="tanggal_checkin" id="tanggal_checkin" class="form-control @error('tanggal_checkin') is-invalid @enderror" value="{{ old('tanggal_checkin') }}">
                    @error('tanggal_checkin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tanggal_checkout" class="form-label">Tanggal Check-out</label>
                    <input type="date" name="tanggal_checkout" id="tanggal_checkout" class="form-control @error('tanggal_checkout') is-invalid @enderror" value="{{ old('tanggal_checkout') }}">
                    @error('tanggal_checkout')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="kode_diskon" class="form-label">Kode Diskon (Opsional)</label>
                    <input type="text" name="kode_diskon" id="kode_diskon" class="form-control @error('kode_diskon') is-invalid @enderror" value="{{ old('kode_diskon') }}">
                    @error('kode_diskon')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                    <select name="metode_pembayaran" id="metode_pembayaran" class="form-select @error('metode_pembayaran') is-invalid @enderror">
                        <option value="">-- Pilih Metode Pembayaran --</option>
                        <option value="transfer_bank" {{ old('metode_pembayaran') == 'transfer_bank' ? 'selected' : '' }}>Transfer Bank</option>
                        <option value="kartu_kredit" {{ old('metode_pembayaran') == 'kartu_kredit' ? 'selected' : '' }}>Kartu Kredit</option>
                        <option value="tunai" {{ old('metode_pembayaran') == 'tunai' ? 'selected' : '' }}>Tunai</option>
                    </select>
                    @error('metode_pembayaran')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-book"></i> Buat Booking</button>
                <a href="{{ route('customer.dashboard') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
            </form>
        </div>
    </div>
@endsection