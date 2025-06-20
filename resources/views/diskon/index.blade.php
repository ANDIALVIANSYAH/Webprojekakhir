@extends('layouts.app')

@section('title', 'Daftar Diskon')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4>Daftar Diskon</h4>
            <a href="{{ route('diskon.create') }}" class="btn btn-light btn-sm float-end"><i class="fas fa-plus"></i> Tambah Diskon</a>
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
                        <th>Kode Diskon</th>
                        <th>Persentase</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($diskons as $diskon)
                        <tr>
                            <td>{{ $diskon->kamar->nomor_kamar }} ({{ $diskon->kamar->tipe_kamar }})</td>
                            <td>{{ $diskon->kode_diskon }}</td>
                            <td>{{ $diskon->persentase_diskon }}%</td>
                            <td>{{ \Carbon\Carbon::parse($diskon->tanggal_mulai)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($diskon->tanggal_selesai)->format('d/m/Y') }}</td>
                            <td>{{ $diskon->is_active ? 'Aktif' : 'Nonaktif' }}</td>
                            <td>
                                <a href="{{ route('diskon.edit', $diskon) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
                                <form action="{{ route('diskon.destroy', $diskon) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus diskon ini?')"><i class="fas fa-trash"></i> Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection