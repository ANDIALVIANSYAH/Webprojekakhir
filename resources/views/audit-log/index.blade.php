@extends('layouts.app')

@section('title', 'Audit Log')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4>Audit Log</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Pengguna</th>
                        <th>Aksi</th>
                        <th>Model</th>
                        <th>ID</th>
                        <th>Deskripsi</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($auditLogs as $log)
                        <tr>
                            <td>{{ $log->user->nama }}</td>
                            <td>{{ ucfirst($log->action) }}</td>
                            <td>{{ $log->model }}</td>
                            <td>{{ $log->model_id }}</td>
                            <td>{{ $log->description }}</td>
                            <td>{{ \Carbon\Carbon::parse($log->created_at)->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection