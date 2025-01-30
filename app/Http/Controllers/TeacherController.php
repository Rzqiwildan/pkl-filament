<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index(){
        return view('teacher.dashboard');
    }
    public function courseT(){
        return view('teacher.courseT');
    }
    public function profile(){
        return view('teacher.dashboard');
    }
}