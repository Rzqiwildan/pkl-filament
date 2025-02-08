<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function index()
{
    // Ambil data teacher berdasarkan user yang login
    $teacher = Teacher::where('user_id', Auth::id())->first();

    if (!$teacher) {
        return redirect()->back()->with('error', 'Anda belum terdaftar sebagai teacher');
    }

    // Ambil hanya pelatihan yang diikuti oleh teacher (relasi many-to-many)
    $pelatihans = $teacher->pelatihans()->with(['category', 'materi', 'jadwalPelatihan', 'photos'])->get();

    return view('teacher.dashboard', compact('pelatihans', 'teacher'));
}


    public function courseT()
    {
        return view('teacher.courseT');
    }

    public function profile()
    {
        return view('teacher.profile');
    }
}