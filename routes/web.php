<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\TransaksiController;


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
    Route::get('/payment/{id}', [UserController::class, 'payment'])->name('payment.show');
    Route::get('/jadwal-pelatihan/{id}', [UserController::class, 'showJadwalPelatihan']);
    Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
    // Route::get('/mycourse', function () {
    //     return view('User.course');
    // })->name('user.course');

    // Route untuk history
    Route::get('/history', [UserController::class, 'history'])->name('user.history');

    // Route untuk payment
    Route::get('/user/payment', [UserController::class, 'showPaymentPage'])->name('user.payment');
    Route::post('/user/payment/upload', [UserController::class, 'uploadPaymentProof'])->name('payment.upload');
    Route::get('/user/payment/{transaction_code}', [UserController::class, 'showPaymentPage'])->name('user.payment.show');
    Route::post('/user/proses-pembayaran', [UserController::class, 'prosesPembayaran'])->name('user.proses.pembayaran');
    Route::get('/user/konfirmasi-pembayaran/{kode_transaksi}', [UserController::class, 'konfirmasiPembayaran'])->name('user.konfirmasi.pembayaran');

    
    
    // Route untuk profil
    Route::get('/profil', function () {
        return view('User.profil');
    })->name('user.profil');

    // Rute untuk POST
    Route::post('/ikut-pelatihan', [UserController::class, 'ikutPelatihan'])->name('ikut.pelatihan');
    Route::post('/pelatihan/ikut/{id}', [UserController::class, 'ikutPelatihanOn'])->name('pelatihan.ikut');
    // Rute untuk Put
    Route::put('/user/profile/update', [UserController::class, 'updateProfile'])->name('user.profile.update');
    // Rute untuk search
    Route::get('/search-pelatihan', [UserController::class, 'search']);
    
});


Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/unauthorized', function () {
    return view('unauthorized');
})->name('unauthorized');


// Rute setelah login untuk teacher
Route::middleware(['auth', 'check.role:teacher'])->group(function () {
    Route::get('/teacher', [TeacherController::class, 'index'])->name('teacher.index');
    Route::get('/teacher/profile', [TeacherController::class, 'profile'])->name('teacher.profile');
    Route::put('/teacher/profile', [TeacherController::class, 'updateProfile'])->name('teacher.profile.update');
    Route::get('/teacher/dashboard', [TeacherController::class, 'index'])->name('teacher.dashboard');
    Route::get('/teacher/courseT', [TeacherController::class, 'courseT'])->name('teacher.courseT');
    Route::get('/teacher/courseT/{pelatihan}', [TeacherController::class, 'showCourse'])->name('teacher.showCourse');
    Route::get('/teacher/courseT/{pelatihan}/upload-materi', [TeacherController::class, 'uploadMateri'])->name('teacher.uploadMateri');
    Route::get('/teacher/courseT/upload-materi/{materi}/edit', [TeacherController::class, 'editMateri'])->name('teacher.editMateri');       
    Route::delete('/teacher/courseT/upload-materi/{materi}', [TeacherController::class, 'deleteMateri'])->name('teacher.deleteMateri');
    Route::post('/teacher/courseT/{pelatihan}/upload-materi', [TeacherController::class, 'storeMateri'])->name('teacher.storeMateri');
    Route::post('/teacher/storeBagian/{pelatihanId}', [TeacherController::class, 'storeBagian'])->name('teacher.storeBagian');
    Route::delete('/teacher/deleteBagian/{bagianId}', [TeacherController::class, 'deleteBagian'])->name('teacher.deleteBagian');
    Route::get('/teacher/quiz/create/{bagianId}', [TeacherController::class, 'createQuiz'])->name('teacher.createQuiz');
    Route::post('/teacher/quiz/store/{bagianId}', [TeacherController::class, 'storeQuiz'])->name('teacher.storeQuiz');
    Route::get('/teacher/quiz/{quizId}', [TeacherController::class, 'showQuiz'])->name('teacher.showQuiz');
    Route::post('/teacher/quiz/{quizId}/question/store', [TeacherController::class, 'storeQuestion'])->name('teacher.storeQuestion');
    Route::delete('/teacher/quiz/{quizId}', [TeacherController::class, 'deleteQuiz'])->name('teacher.deleteQuiz');
    Route::post('/teacher/storeBagianQuiz/{pelatihanId}', [TeacherController::class, 'storeBagianQuiz'])->name('teacher.storeBagianQuiz');
    Route::get('/teacher/quiz/{quizId}/question/{questionId}/edit', [TeacherController::class, 'editQuestion'])->name('teacher.editQuiz');
    Route::put('/teacher/quiz/{quizId}/question/{questionId}', [TeacherController::class, 'updateQuestion'])->name('teacher.updateQuestion');
    Route::get('/teacher/pelatihan/{pelatihan}/peserta', [TeacherController::class, 'peserta'])->name('teacher.peserta');
});

// Route::middleware(['auth', 'check.role:mahasiswa'])->group(function () {
// Route::middleware('role:mahasiswa')->group(function () {
//     Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard.index');
//     // ... other user routes ...
// });
// });
// Route::middleware(['auth', 'check.role:umum'])->group(function () {
//     Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard.index');
//     // ... other user routes ...
// });


Route::get('/test-admin', function () {
    return 'Welcome Admin!';
})->middleware('check.role.admin');

// Route Quiz
Route::get('/quiz/{quiz_id}', [QuizController::class, 'soal'])->name('quiz.soal');
Route::get('/quiz/ulangi/{quiz_id}', [QuizController::class, 'ulangi'])->name('quiz.ulangi');
Route::post('/Quiz/save-answer', [QuizController::class, 'saveAnswer'])->name('quiz.saveAnswer');
Route::get('/Quiz/hasil/{quiz_id}', [QuizController::class, 'hasil'])->name('quiz.hasil');
Route::post('/quiz/submit', [QuizController::class, 'submitAnswer'])->name('quiz.submit');


// Route Sertif
Route::get('/sertifikat/{quiz_id}', [SertifikatController::class, 'show'])->name('sertifikat.show');
Route::get('/sertifikat/download/{quiz_id}', [SertifikatController::class, 'download'])->name('download.sertifikat');