<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController; // Jangan lupa tambahkan ini
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\HolidayController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

     // RUTE UNTUK ABSENSI
     Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
     Route::post('/attendance/clock-in', [AttendanceController::class, 'clockIn'])->name('attendance.clockin');
     Route::post('/attendance/clock-out', [AttendanceController::class, 'clockOut'])->name('attendance.clockout');
     
     // RUTE BARU UNTUK IZIN/SAKIT
     Route::post('/attendance/permission', [AttendanceController::class, 'storePermission'])->name('attendance.store_permission');
 });


// === RUTE KHUSUS ADMIN UNTUK MANAJEMEN PENGGUNA ===
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Rute resource akan otomatis membuat semua URL CRUD untuk UserController
    // Contoh: /users, /users/create, /users/{user}/edit, dll.
    Route::resource('users', UserController::class);

    Route::get('/admin/reports/daily', [ReportController::class, 'dailyReport'])
    ->name('admin.reports.daily');

    // RUTE KHUSUS ADMIN: Menandai karyawan yang alpa
    Route::post('/admin/attendance/mark-alpa', [AttendanceController::class, 'markAlpa'])
            ->name('admin.attendance.mark_alpa');
    // ✨ RUTE BARU UNTUK CRUD HARI LIBUR
    // Satu baris ini = 7 rute sekaligus! 🤯
    Route::resource('/admin/holidays', HolidayController::class)
        ->except(['show']); // Method 'show' skip aja, gak kita pake
});

require __DIR__.'/auth.php';
