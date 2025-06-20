@extends('layouts.app')

@section('title', 'Daftar Kamar')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4>Daftar Kamar</h4>
            <a href="{{ route('kamar.create') }}" class="btn btn-light">Tambah Kamar</a>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nomor Kamar</th>
                        <th>Tipe Kamar</th>
                        <th>Harga per Malam</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kamars as $kamar)
                        <tr>
                            <td>{{ $kamar->nomor_kamar }}</td>
                            <td>{{ $kamar->tipe_kamar }}</td>
                            <td>Rp {{ number_format($kamar->harga_per_malam, 0, ',', '.') }}</td>
                            <td>{{ $kamar->status_tersedia ? 'Tersedia' : 'Tidak Tersedia' }}</td>
                            <td>
                                <a href="{{ route('kamar.edit', $kamar) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('kamar.destroy', $kamar) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus kamar ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection