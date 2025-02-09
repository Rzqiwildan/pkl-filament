<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;

Route::get('/', [Controller::class, 'index'])->name('welcome');

// Rute untuk user tamu
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('register', [LoginController::class, 'showRegister'])->name('register');
    Route::post('register', [LoginController::class, 'register']);
});

//Rute untuk user
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard.index');
    Route::get('/course1/{id}', [UserController::class, 'course1'])->name('course1.show');
    Route::get('/offline/{id}', [UserController::class, 'offline'])->name('offline.show');
    Route::get('/online/{id}', [UserController::class, 'online'])->name('online.show');
    Route::get('/banner3/{id}', [UserController::class, 'showBanner'])->name('banner3.show');
    Route::get('/kategori', [UserController::class, 'kategori'])->name('user.kategori');
    Route::get('/kategori/{id}', [UserController::class, 'showKategori'])->name('kategori.show');
    Route::get('/mycourse', [UserController::class, 'myCourses'])->name('user.course');
    
    // Rute pencarian
    Route::get('/hasil-pencarian', [UserController::class, 'hasilPencarian'])->name('hasil-pencarian');

    // Rute untuk POST request menyimpan pelatihan
    Route::get('/pelatihan', [UserController::class, 'getPelatihan'])->name('pelatihan.get');
    Route::get('/course', [UserController::class, 'getPelatihan'])->name('course.index');
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/user/course1/{id}', [UserController::class, 'course1'])->name('user.course1');
    Route::get('/user/course3', [UserController::class, 'course3'])->name('user.course3');
    Route::get('/user/offline', [UserController::class, 'offline'])->name('user.offline');
    Route::get('/user/online', [UserController::class, 'online'])->name('user.online');
    Route::get('/user/quiz1', [UserController::class, 'quiz1'])->name('user.quiz1');
    Route::get('/user/mycourse1', [UserController::class, 'mycourse1'])->name('user.mycourse1');
    Route::get('/user/banner3', [UserController::class, 'banner3'])->name('user.banner3');
    Route::get('/jadwal-pelatihan/{id}', [UserController::class, 'showJadwalPelatihan']);
    // Route::get('/mycourse', function () {
    //     return view('User.course');
    // })->name('user.course');
    Route::get('/payment', function () {
        return view('User.payment');
    })->name('user.payment');
    Route::get('/history', function () {
        return view('User.history');
    })->name('user.history');
    Route::get('/profil', function () {
        return view('User.profil');
    })->name('user.profil');

    // Rute untuk POST
    Route::post('/ikut-pelatihan', [UserController::class, 'ikutPelatihan'])->name('ikut.pelatihan');
    Route::post('/pelatihan/ikut/{id}', [UserController::class, 'ikutPelatihanOn'])->name('pelatihan.ikut');

    // Rute untuk search
    Route::get('/search-pelatihan', [UserController::class, 'search']);
    
});



Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/unauthorized', function () {
    return view('unauthorized');
})->name('unauthorized');


// Rute setelah login untuk student
// Route::middleware(['auth', 'check.role'])->group(function () {
//     // Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
//     Route::get('/teacher', [TeacherController::class, 'index'])->name('dashboard.index');
// });


// Rute setelah login untuk teacher
Route::middleware(['auth', 'check.role:teacher'])->group(function () {
    Route::get('/teacher', [TeacherController::class, 'index'])->name('teacher.index');
    Route::get('/teacher/dashboard', [TeacherController::class, 'index'])->name('teacher.dashboard');
    Route::get('/teacher/courseT', [TeacherController::class, 'courseT'])->name('teacher.courseT');
    Route::get('/teacher/courseT/{pelatihan}', [TeacherController::class, 'showCourse'])->name('teacher.showCourse');
    Route::get('/teacher/courseT/{pelatihan}/upload-materi', [TeacherController::class, 'uploadMateri'])->name('teacher.uploadMateri');
    Route::post('/teacher/courseT/{pelatihan}/upload-materi', [TeacherController::class, 'storeMateri'])->name('teacher.storeMateri');
    Route::post('/teacher/storeBagian/{pelatihanId}', [TeacherController::class, 'storeBagian'])->name('teacher.storeBagian');
    Route::delete('/teacher/deleteBagian/{bagianId}', [TeacherController::class, 'deleteBagian'])->name('teacher.deleteBagian');
    Route::get('/teacher/profile', [TeacherController::class, 'profile'])->name('teacher.profile');
});


// Mahasiswa & Umum routes

// Route::middleware('role:mahasiswa')->group(function () {
//     Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard.index');
//     // ... other user routes ...
// });
// Route::middleware('role:umum')->group(function () {
//     Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard.index');
//     // ... other user routes ...
// });


Route::middleware(['auth', 'check.role:mahasiswa'])->group(function () {
Route::middleware('role:mahasiswa')->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard.index');
    // ... other user routes ...
});
});
Route::middleware(['auth', 'check.role:umum'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard.index');
    // ... other user routes ...
});


Route::get('/test-admin', function () {
    return 'Welcome Admin!';
})->middleware('check.role.admin');