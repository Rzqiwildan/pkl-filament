<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;

Route::get('/',function(){
    return view('welcome');
});

// Rute untuk user tamu
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('register', [LoginController::class, 'showRegister'])->name('register');
    Route::post('register', [LoginController::class, 'register']);
});

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/unauthorized', function () {
    return view('unauthorized');
})->name('unauthorized');


// Rute setelah login untuk student
Route::middleware(['auth', 'check.role'])->group(function () {
    Route::get('/dashboard', [StudentController::class, 'index'])->name('dashboard');
    Route::get('/teacher', [TeacherController::class, 'index'])->name('teacher.dashboard');
});
// Rute setelah login untuk teacher
Route::middleware(['auth', 'check.role.teacher'])->group(function () {
    Route::get('/teacher', [TeacherController::class, 'index'])->name('teacher.dashboard');
});

Route::get('/test-admin', function () {
    return 'Welcome Admin!';
})->middleware('check.role.admin');