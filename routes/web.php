<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DiskonController;
use App\Http\Controllers\AuditLogController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'role:admin,resepsionis'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/resepsionis/dashboard', function () {
        return view('resepsionis.dashboard');
    })->name('resepsionis.dashboard');

    Route::resource('kamar', KamarController::class);
    Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
    Route::patch('/booking/{booking}', [BookingController::class, 'update'])->name('booking.update');
    Route::delete('/booking/{booking}', [BookingController::class, 'destroy'])->name('booking.destroy');
    Route::post('/booking/{booking}/checkin', [BookingController::class, 'checkin'])->name('booking.checkin');
    Route::post('/booking/{booking}/checkout', [BookingController::class, 'checkout'])->name('booking.checkout');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::resource('user', UserController::class)->only(['index', 'edit', 'update', 'destroy']);
    Route::resource('diskon', DiskonController::class);
    Route::get('/audit-log', [AuditLogController::class, 'index'])->name('audit-log.index');
});

Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/customer/dashboard', function () {
        return view('customer.dashboard');
    })->name('customer.dashboard');

    Route::get('/booking/create', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/riwayat', [BookingController::class, 'riwayat'])->name('booking.riwayat');
});

require __DIR__ . '/auth.php';