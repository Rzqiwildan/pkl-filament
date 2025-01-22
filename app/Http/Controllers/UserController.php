<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return view('user.dashboard');
    }

    public function course()
    {
        // Logic untuk halaman My Course
        return view('user.course');
    }

    public function course1()
    {
        return view('user.course1');
    }

    public function course2()
    {
        return view('user.course2');
    }

    public function course3()
    {
        return view('user.course3');
    }

    public function offline()
    {
        return view('user.offline');
    }

    public function online()
    {
        return view('user.online');
    }

    public function quiz1()
    {
        return view('user.quiz1');
    }

    public function mycourse1()
    {
        return view('user.mycourse1');
    }

    public function banner3()
    {
        return view('user.banner3');
    }

    public function payment()
    {
        return view('user.payment');
    }

    public function history()
    {
        return view('user.history');
    }

    public function profil()
    {
        return view('user.profil');
    }
}