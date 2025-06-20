@extends('layouts.app')

@section('title', 'Edit Kamar')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4>Edit Kamar</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('kamar.update', $kamar) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nomor_kamar" class="form-label">Nomor Kamar</label>
                    <input type="text" name="nomor_kamar" id="nomor_kamar" class="form-control @error('nomor_kamar') is-invalid @enderror" value="{{ old('nomor_kamar', $kamar->nomor_kamar) }}">
                    @error('nomor_kamar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tipe_kamar" class="form-label">Tipe Kamar</label>
                    <input type="text" name="tipe_kamar" id="tipe_kamar" class="form-control @error('tipe_kamar') is-invalid @enderror" value="{{ old('tipe_kamar', $kamar->tipe_kamar) }}">
                    @error('tipe_kamar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="harga_per_malam" class="form-label">Harga per Malam</label>
                    <input type="number" name="harga_per_malam" id="harga_per_malam" class="form-control @error('harga_per_malam') is-invalid @endif" value="{{ old('harga_per_malam', $kamar->harga_per_malam) }}">
                    @error('harga_per_malam')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $kamar->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar Kamar</label>
                    <input type="file" name="gambar" id="gambar" class="form-control @error('gambar') is-invalid @enderror">
                    @if ($kamar->gambar)
                        <div class="mt-2">
                            <img src="{{ Storage::url($kamar->gambar) }}" alt="Gambar Kamar" style="max-width: 200px;">
                        </div>
                    @endif
                    @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="status_tersedia" class="form-label">Status Tersedia</label>
                    <select name="status_tersedia" id="status_tersedia" class="form-select @error('status_tersedia') is-invalid @enderror">
                        <option value="1" {{ old('status_tersedia', $kamar->status_tersedia) == 1 ? 'selected' : '' }}>Tersedia</option>
                        <option value="0" {{ old('status_tersedia', $kamar->status_tersedia) == 0 ? 'selected' : '' }}>Tidak Tersedia</option>
                    </select>
                    @error('status_tersedia')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('kamar.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@endsection