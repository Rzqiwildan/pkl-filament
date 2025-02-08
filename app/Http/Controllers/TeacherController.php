<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function index(){
        // / Ambil data teacher berdasarkan user yang login
        $teacher = Teacher::where('user_id', Auth::id())->first();
        
        // Ambil semua pelatihan yang dimiliki oleh teacher tersebut
        $pelatihans = Pelatihan::with(['category', 'materi', 'jadwalPelatihan'])
                ->where('teacher_id', $teacher->id)
                ->get();
        
        return view('teacher.dashboard', compact('pelatihans', 'teacher'));
    }
    public function courseT(){
        return view('teacher.courseT');
    }
    public function profile(){
        return view('teacher.profile');
    }
}