@extends('layouts.app')

@section('title', 'Edit Diskon')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4>Edit Diskon</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('diskon.update', $diskon) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="kamar_id" class="form-label">Pilih Kamar</label>
                    <select name="kamar_id" id="kamar_id" class="form-select @error('kamar_id') is-invalid @enderror">
                        <option value="">-- Pilih Kamar --</option>
                        @foreach ($kamars as $kamar)
                            <option value="{{ $kamar->id }}" {{ $kamar->id == $diskon->kamar_id ? 'selected' : '' }}>{{ $kamar->nomor_kamar }} - {{ $kamar->tipe_kamar }}</option>
                        @endforeach
                    </select>
                    @error('kamar_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="kode_diskon" class="form-label">Kode Diskon</label>
                    <input type="text" name="kode_diskon" id="kode_diskon" class="form-control @error('kode_diskon') is-invalid @enderror" value="{{ old('kode_diskon', $diskon->kode_diskon) }}">
                    @error('kode_diskon')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="persentase_diskon" class="form-label">Persentase Diskon (%)</label>
                    <input type="number" name="persentase_diskon" id="persentase_diskon" class="form-control @error('persentase_diskon') is-invalid @enderror" value="{{ old('persentase_diskon', $diskon->persentase_diskon) }}" step="0.01">
                    @error('persentase_diskon')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control @error('tanggal_mulai') is-invalid @enderror" value="{{ old('tanggal_mulai', $diskon->tanggal_mulai->format('Y-m-d')) }}">
                    @error('tanggal_mulai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control @error('tanggal_selesai') is-invalid @enderror" value="{{ old('tanggal_selesai', $diskon->tanggal_selesai->format('Y-m-d')) }}">
                    @error('tanggal_selesai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="is_active" class="form-label">Status Aktif</label>
                    <select name="is_active" id="is_active" class="form-select @error('is_active') is-invalid @enderror">
                        <option value="1" {{ old('is_active', $diskon->is_active) == 1 ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ old('is_active', $diskon->is_active) == 0 ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                    @error('is_active')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                <a href="{{ route('diskon.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
            </form>
        </div>
    </div>
@endsection