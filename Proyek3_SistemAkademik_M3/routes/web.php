<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Login & Logout
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard Umum (untuk admin & mahasiswa)
Route::middleware('auth.role:admin,mahasiswa')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Route Mahasiswa (dengan prefix /mahasiswa)
Route::middleware('auth.role:mahasiswa')->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('/enroll', [DashboardController::class, 'enrollView'])->name('enroll');
    Route::post('/enroll', [DashboardController::class, 'enroll'])->name('enroll.process');

     // Lihat Mata Kuliah Terdaftar
    Route::get('/view-courses', [DashboardController::class, 'viewCourses'])->name('view-courses');
});


// Route Admin
Route::middleware('auth.role:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/courses', [AdminController::class, 'courses'])->name('courses');
    Route::get('/courses/create', [AdminController::class, 'coursesCreate'])->name('courses.create');
    Route::post('/courses', [AdminController::class, 'coursesStore'])->name('courses.store');

    // CRUD Mahasiswa
    Route::get('/students', [AdminController::class, 'students'])->name('students');
    Route::get('/students/create', [AdminController::class, 'studentsCreate'])->name('students.create');     // ← BARU
    Route::post('/students', [AdminController::class, 'studentsStore'])->name('students.store');           // ← BARU
    Route::get('/students/{student}/edit', [AdminController::class, 'studentsEdit'])->name('students.edit'); // ← BARU
    Route::put('/students/{student}', [AdminController::class, 'studentsUpdate'])->name('students.update'); // ← BARU
    Route::delete('/students/{student}', [AdminController::class, 'studentsDelete'])->name('students.delete');
});