<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuditLogController extends Controller
{
    public function index()
    {
        try {
            $auditLogs = AuditLog::with('user')->get();
            return view('audit-log.index', compact('auditLogs'));
        } catch (\Exception $e) {
            Log::error('Gagal memuat audit log: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memuat audit log.');
        }
    }
}