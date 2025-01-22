<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;

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

//rute untuk user
Route::middleware('role:user')->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/user/course1', [UserController::class, 'course1'])->name('user.course1');
    Route::get('/user/course2', [UserController::class, 'course2'])->name('user.course2');
    Route::get('/user/course3', [UserController::class, 'course3'])->name('user.course3');
    Route::get('/user/offline', [UserController::class, 'offline'])->name('user.offline');
    Route::get('/user/online', [UserController::class, 'online'])->name('user.online');
    Route::get('/user/quiz1', [UserController::class, 'quiz1'])->name('user.quiz1');
    Route::get('/mycourse', function () {
        return view('User.course');
    })->name('user.course');
    Route::get('/payment', function () {
        return view('User.payment');
    })->name('user.payment');
    Route::get('/history', function () {
        return view('User.history');
    })->name('user.history');
});

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/unauthorized', function () {
    return view('unauthorized');
})->name('unauthorized');


// Rute setelah login untuk student
Route::middleware(['auth', 'check.role'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::get('/teacher', [TeacherController::class, 'index'])->name('teacher.dashboard');
});
// Rute setelah login untuk teacher
Route::middleware(['auth', 'check.role.teacher'])->group(function () {
    Route::get('/teacher', [TeacherController::class, 'index'])->name('teacher.dashboard');
});

Route::get('/test-admin', function () {
    return 'Welcome Admin!';
})->middleware('check.role.admin');